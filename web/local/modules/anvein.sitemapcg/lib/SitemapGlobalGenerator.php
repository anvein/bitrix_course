<?php

namespace Anvein\SitemapCG;

use CModule;
use CIBlock;
use CIBlockResult;
use CIBlockElement;
use CIBlockSection;
use CForumNew;
use CForumTopic;
use CSeoUtils;
use Exception;
use Bitrix\Main\IO\File;
use Bitrix\Main\IO\Path;
use Bitrix\Main\Loader;
use Bitrix\Main\SiteTable;
use Bitrix\Seo\RobotsFile;
use Bitrix\Seo\SitemapTable;
use Bitrix\Seo\SitemapIndex;
use Bitrix\Seo\SitemapIblock;
use Bitrix\Seo\SitemapRuntime;
use Bitrix\Seo\SitemapRuntimeTable;
use Bitrix\Main\Type\DateTime;

// TODO: переделать, чтобы не по шагам было
// TODO: проработать, чтобы можно было гибко управлять элементами, которые будут попадать в sitemap, а какие нет

/**
 * Отвечает за пересоздание sitemap для всего сайта
 * @package Anvein\SitemapCG
 */
class SitemapGlobalGenerator
{
    /**
     * ID карты сайта
     * @var int|null
     */
    private $id = null;

    /**
     * Хранит данные для сохранения статуса
     * @var array
     */
    private $ns = [];

    /**
     * Хранит "процент загрузки" (или подобное згначение)
     * @var null
     */
    protected $value = 0;


    /**
     * @return int|null
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return SitemapGlobalGenerator
     */
    public function setId(int $id): SitemapGlobalGenerator
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null
     */
    public function getNs(): array
    {
        return $this->ns;
    }

    /**
     * @param null $ns
     * @return SitemapGlobalGenerator
     */
    public function setNs(array $ns): SitemapGlobalGenerator
    {
        $this->ns = $ns;
        return $this;
    }

    /**
     * @return null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param null $value
     * @return SitemapGlobalGenerator
     */
    public function setValue($value): SitemapGlobalGenerator
    {
        $this->value = $value;
        return $this;
    }


    /**
     * SitemapGlobalGenerator constructor.
     */
    public function __construct(int $id = null)
    {
        $this->id = $id;
    }


    /**
     * Запуск перегенерации карты карты sitemap
     */
    public function run()
    {
        if (!Loader::includeModule('seo')) {
            throw new Exception('Не установлен модуль seo.');
        }

        if (!Loader::includeModule('iblock')) {
            throw new Exception('Не установлен модуль iblock.');
        }

        $arSitemap = null;
        if ($this->id > 0) {
            $dbSitemap = SitemapTable::getById($this->id);
            $arSitemap = $dbSitemap->fetch();

            $dbSite = SiteTable::getByPrimary($arSitemap['SITE_ID']);
            $arSitemap['SITE'] = $dbSite->fetch();
        }

        if (!is_array($arSitemap)) {
            throw new Exception('Sitemap не найден');
        } else {
            $arSitemap['SETTINGS'] = unserialize($arSitemap['SETTINGS']);

            $arSitemapSettings = [
                'SITE_ID' => $arSitemap['SITE_ID'],
                'PROTOCOL' => ($arSitemap['SETTINGS']['PROTO'] == 1) ? 'https' : 'http',
                'DOMAIN' => $arSitemap['SETTINGS']['DOMAIN'],
            ];
        }

        $arValueSteps = [
            'init' => 0,
            'files' => 40,
            'iblock_index' => 50,
            'iblock' => 60,
            'forum_index' => 70,
            'forum' => 80,
            'index' => 100,
        ];


        if ($this->value == $arValueSteps['init']) {
            SitemapRuntimeTable::clearByPid($this->id);

            $this->ns['time_start'] = microtime(true);
            $this->ns['files_count'] = 0;
            $this->ns['steps_count'] = 0;

            $bRootChecked = isset($arSitemap['SETTINGS']['DIR']['/']) && $arSitemap['SETTINGS']['DIR']['/'] == 'Y';

            $arRuntimeData = [
                'PID' => $this->id,
                'ITEM_TYPE' => SitemapRuntimeTable::ITEM_TYPE_DIR,
                'ITEM_PATH' => '/',
                'PROCESSED' => SitemapRuntimeTable::UNPROCESSED,
                'ACTIVE' => $bRootChecked ? SitemapRuntimeTable::ACTIVE : SitemapRuntimeTable::INACTIVE,
            ];

            SitemapRuntimeTable::add($arRuntimeData);
//            $msg = Loc::getMessage('SITEMAP_RUN_FILES', ['#PATH#' => '/']);
            $sitemapFile = new SitemapRuntime($this->id, $arSitemap['SETTINGS']['FILENAME_FILES'], $arSitemapSettings);

            $this->value++;
        } elseif ($this->value < $arValueSteps['files']) {
            $this->ns['steps_count']++;

            $sitemapFile = new SitemapRuntime($this->id, $arSitemap['SETTINGS']['FILENAME_FILES'], $arSitemapSettings);

            $stepDuration = 15;
            $ts_finish = microtime(true) + $stepDuration * 0.95;

            $bFinished = false;
            $bCheckFinished = false;

            $dbRes = null;

            while (!$bFinished && microtime(true) <= $ts_finish) {
                if (!$dbRes) {
                    $dbRes = SitemapRuntimeTable::getList([
                        'order' => ['ITEM_PATH' => 'ASC'],
                        'filter' => [
                            'PID' => $this->id,
                            'ITEM_TYPE' => SitemapRuntimeTable::ITEM_TYPE_DIR,
                            'PROCESSED' => SitemapRuntimeTable::UNPROCESSED,
                        ],
                        'limit' => 1000
                    ]);
                }

                if ($arRes = $dbRes->Fetch()) {
                    $this->seoSitemapGetFilesData($arSitemap, $arRes, $sitemapFile);
                    $bCheckFinished = false;
                } elseif (!$bCheckFinished) {
                    $dbRes = null;
                    $bCheckFinished = true;
                } else {
                    $bFinished = true;
                }
            }

            if (!$bFinished) {
                if ($this->value < $arValueSteps['files'] - 1) {
                    $this->value++;
                }

//                $msg = Loc::getMessage('SITEMAP_RUN_FILES', ['#PATH#' => $arRes['ITEM_PATH']]);
            } else {
                if (!is_array($this->ns['XML_FILES'])) {
                    $this->ns['XML_FILES'] = [];
                }

                if ($sitemapFile->isNotEmpty()) {
                    if ($sitemapFile->isCurrentPartNotEmpty()) {
                        $sitemapFile->finish();
                    } else {
                        $sitemapFile->delete();
                    }

                    $xmlFiles = $sitemapFile->getNameList();
                    $directory = $sitemapFile->getPathDirectory();
                    foreach ($xmlFiles as &$xmlFile) {
                        $xmlFile = $directory . $xmlFile;
                    }
                    $this->ns['XML_FILES'] = array_unique(array_merge($this->ns['XML_FILES'], $xmlFiles));
                } else {
                    $sitemapFile->delete();
                }

                $this->value = $arValueSteps['files'];
//                $msg = Loc::getMessage('SITEMAP_RUN_FILE_COMPLETE',
//                    ['#FILE#' => $arSitemap['SETTINGS']['FILENAME_FILES']]);
            }

        } elseif ($this->value < $arValueSteps['iblock_index']) {
            // генерируем имена для файлов sitemap'ов инфоблоков и создаем объект Файла FileSystemEntry
            $this->ns['time_start'] = microtime(true);

            $arIBlockList = [];
            if (Loader::includeModule('iblock')) {
                $arIBlockList = $arSitemap['SETTINGS']['IBLOCK_ACTIVE'];
                if (count($arIBlockList) > 0) {
                    $arIBlocks = [];
                    $dbIBlock = CIBlock::GetList([], ['ID' => array_keys($arIBlockList)]);
                    while ($arIBlock = $dbIBlock->Fetch()) {
                        $arIBlocks[$arIBlock['ID']] = $arIBlock;
                    }

                    foreach ($arIBlockList as $iblockId => $iblockActive) {
                        if ($iblockActive !== 'Y' || !array_key_exists($iblockId, $arIBlocks)) {
                            unset($arIBlockList[$iblockId]);
                        } else {
                            SitemapRuntimeTable::add([
                                'PID' => $this->id,
                                'PROCESSED' => SitemapRuntimeTable::UNPROCESSED,
                                'ITEM_ID' => $iblockId,
                                'ITEM_TYPE' => SitemapRuntimeTable::ITEM_TYPE_IBLOCK,
                            ]);

                            $fileName = str_replace(
                                ['#IBLOCK_ID#', '#IBLOCK_CODE#', '#IBLOCK_XML_ID#'],
                                [$iblockId, $arIBlocks[$iblockId]['CODE'], $arIBlocks[$iblockId]['XML_ID']],
                                $arSitemap['SETTINGS']['FILENAME_IBLOCK']
                            );

                            $sitemapFile = new SitemapRuntime($this->id, $fileName, $arSitemapSettings);
                        }
                    }
                }
            }

            $this->ns['LEFT_MARGIN'] = 0;
            $this->ns['IBLOCK_LASTMOD'] = 0;

            $this->ns['IBLOCK'] = [];
            $this->ns['IBLOCK_MAP'] = [];

            if (count($arIBlockList) <= 0) {
                $this->value = $arValueSteps['iblock'];
            } else {
                $this->value = $arValueSteps['iblock_index'];
            }
        } else {
            if ($this->value < $arValueSteps['iblock']) {
                $stepDuration = 10;
                $ts_finish = microtime(true) + $stepDuration * 0.95;

                $bFinished = false;
                $bCheckFinished = false;

                $currentIblock = false;
                $iblockId = 0;

                $dbOldIblockResult = null;
                $dbIblockResult = null;

                if (isset($_SESSION["SEO_SITEMAP_{$this->id}"])) {
                    $this->ns['IBLOCK_MAP'] = $_SESSION["SEO_SITEMAP_{$this->id}"];
                    unset($_SESSION["SEO_SITEMAP_{$this->id}"]);
                }

                while (!$bFinished && microtime(true) <= $ts_finish) {
                    if (!$currentIblock) {
                        $arCurrentIBlock = false;
                        $dbRes = SitemapRuntimeTable::getList([
                            'order' => ['ID' => 'ASC'],
                            'filter' => [
                                'PID' => $this->id,
                                'ITEM_TYPE' => SitemapRuntimeTable::ITEM_TYPE_IBLOCK,
                                'PROCESSED' => SitemapRuntimeTable::UNPROCESSED,
                            ],
                            'limit' => 1
                        ]);

                        $currentIblock = $dbRes->fetch();

                        if ($currentIblock) {
                            $iblockId = intval($currentIblock['ITEM_ID']);

                            $dbIBlock = CIBlock::GetByID($iblockId);
                            $arCurrentIBlock = $dbIBlock->Fetch();

                            if (!$arCurrentIBlock) {
                                SitemapRuntimeTable::update($currentIblock['ID'], ['PROCESSED' => SitemapRuntimeTable::PROCESSED]);

                                $this->ns['LEFT_MARGIN'] = 0;
                                $this->ns['IBLOCK_LASTMOD'] = 0;
                                $this->ns['LAST_ELEMENT_ID'] = 0;
                                unset($this->ns['CURRENT_SECTION']);
                            } else {
                                if (strlen($arCurrentIBlock['LIST_PAGE_URL']) <= 0) {
                                    $arSitemap['SETTINGS']['IBLOCK_LIST'][$iblockId] = 'N';
                                }
                                if (strlen($arCurrentIBlock['SECTION_PAGE_URL']) <= 0) {
                                    $arSitemap['SETTINGS']['IBLOCK_SECTION'][$iblockId] = 'N';
                                }
                                if (strlen($arCurrentIBlock['DETAIL_PAGE_URL']) <= 0) {
                                    $arSitemap['SETTINGS']['IBLOCK_ELEMENT'][$iblockId] = 'N';
                                }

                                $this->ns['IBLOCK_LASTMOD'] = max($this->ns['IBLOCK_LASTMOD'],
                                    MakeTimeStamp($arCurrentIBlock['TIMESTAMP_X']));

                                if ($this->ns['LEFT_MARGIN'] <= 0 && $arSitemap['SETTINGS']['IBLOCK_ELEMENT'][$iblockId] != 'N') {
                                    $this->ns['CURRENT_SECTION'] = 0;
                                }

                                $fileName = str_replace(
                                    ['#IBLOCK_ID#', '#IBLOCK_CODE#', '#IBLOCK_XML_ID#'],
                                    [$iblockId, $arCurrentIBlock['CODE'], $arCurrentIBlock['XML_ID']],
                                    $arSitemap['SETTINGS']['FILENAME_IBLOCK']
                                );
                                $sitemapFile = new SitemapRuntime($this->id, $fileName, $arSitemapSettings);
                            }
                        }
                    }

                    if (!$currentIblock) {
                        $bFinished = true;
                    } elseif (is_array($arCurrentIBlock)) {
                        if ($dbIblockResult == null) {
                            if (isset($this->ns['CURRENT_SECTION'])) {
                                $dbIblockResult = $this->getCIBlockElements((int)$iblockId, $arSitemap['SITE_ID']);
                            } else {
                                $this->ns['LAST_ELEMENT_ID'] = 0;
                                $dbIblockResult = CIBlockSection::GetList(
                                    ['LEFT_MARGIN' => 'ASC'],
                                    [
                                        'IBLOCK_ID' => $iblockId,
                                        'GLOBAL_ACTIVE' => 'Y',
                                        '>LEFT_BORDER' => intval($this->ns['LEFT_MARGIN']),
                                    ],
                                    false,
                                    [
                                        'ID',
                                        'TIMESTAMP_X',
                                        'SECTION_PAGE_URL',
                                        'LEFT_MARGIN',
                                        'IBLOCK_SECTION_ID'
                                    ],
                                    ['nTopCount' => 100]
                                );
                            }
                        }

                        if (isset($this->ns['CURRENT_SECTION'])) {
                            $arElement = $dbIblockResult->fetch();

                            if ($arElement) {
                                if (!is_array($this->ns['IBLOCK_MAP'][$iblockId])) {
                                    $this->ns['IBLOCK_MAP'][$iblockId] = [];
                                }

                                if (!array_key_exists($arElement['ID'], $this->ns['IBLOCK_MAP'][$iblockId])) {
                                    $arElement['LANG_DIR'] = $arSitemap['SITE']['DIR'];

                                    $bCheckFinished = false;
                                    $elementLastmod = MakeTimeStamp($arElement['TIMESTAMP_X']);
                                    $this->ns['IBLOCK_LASTMOD'] = max($this->ns['IBLOCK_LASTMOD'], $elementLastmod);
                                    $this->ns['LAST_ELEMENT_ID'] = $arElement['ID'];

                                    $this->ns['IBLOCK'][$iblockId]['E']++;
                                    $this->ns['IBLOCK_MAP'][$iblockId][$arElement["ID"]] = 1;

                                    // remove or replace SERVER_NAME
                                    $url = SitemapIblock::prepareUrlToReplace($arElement['DETAIL_PAGE_URL'], $arSitemap['SITE_ID']);
                                    $url = CIBlock::ReplaceDetailUrl($url, $arElement, false, 'E');

                                    $sitemapFile->addIBlockEntry($url, $elementLastmod);
                                }
                            } elseif (!$bCheckFinished) {
                                $bCheckFinished = true;
                                $dbIblockResult = null;
                            } else {
                                $bCheckFinished = false;
                                unset($this->ns['CURRENT_SECTION']);
                                $this->ns['LAST_ELEMENT_ID'] = 0;

                                $dbIblockResult = null;
                                if ($dbOldIblockResult) {
                                    $dbIblockResult = $dbOldIblockResult;
                                    $dbOldIblockResult = null;
                                }
                            }
                        } else {
                            $arSection = $dbIblockResult->fetch();

                            if ($arSection) {
                                $bCheckFinished = false;
                                $sectionLastmod = MakeTimeStamp($arSection['TIMESTAMP_X']);
                                $this->ns['LEFT_MARGIN'] = $arSection['LEFT_MARGIN'];
                                $this->ns['IBLOCK_LASTMOD'] = max($this->ns['IBLOCK_LASTMOD'], $sectionLastmod);

                                $bActive = false;
                                $bActiveElement = false;

                                if (isset($arSitemap['SETTINGS']['IBLOCK_SECTION_SECTION'][$iblockId][$arSection['ID']])) {
                                    $bActive = $arSitemap['SETTINGS']['IBLOCK_SECTION_SECTION'][$iblockId][$arSection['ID']] == 'Y';
                                    $bActiveElement = $arSitemap['SETTINGS']['IBLOCK_SECTION_ELEMENT'][$iblockId][$arSection['ID']] == 'Y';
                                } elseif ($arSection['IBLOCK_SECTION_ID'] > 0) {
                                    $dbRes = SitemapRuntimeTable::getList([
                                        'filter' => [
                                            'PID' => $this->id,
                                            'ITEM_TYPE' => SitemapRuntimeTable::ITEM_TYPE_SECTION,
                                            'ITEM_ID' => $arSection['IBLOCK_SECTION_ID'],
                                            'PROCESSED' => SitemapRuntimeTable::PROCESSED,
                                        ],
                                        'select' => ['ACTIVE', 'ACTIVE_ELEMENT'],
                                        'limit' => 1
                                    ]);

                                    $parentSection = $dbRes->fetch();
                                    if ($parentSection) {
                                        $bActive = $parentSection['ACTIVE'] == SitemapRuntimeTable::ACTIVE;
                                        $bActiveElement = $parentSection['ACTIVE_ELEMENT'] == SitemapRuntimeTable::ACTIVE;
                                    }
                                } else {
                                    $bActive = $arSitemap['SETTINGS']['IBLOCK_SECTION'][$iblockId] == 'Y';
                                    $bActiveElement = $arSitemap['SETTINGS']['IBLOCK_ELEMENT'][$iblockId] == 'Y';
                                }

                                $arRuntimeData = [
                                    'PID' => $this->id,
                                    'ITEM_ID' => $arSection['ID'],
                                    'ITEM_TYPE' => SitemapRuntimeTable::ITEM_TYPE_SECTION,
                                    'ACTIVE' => $bActive ? SitemapRuntimeTable::ACTIVE : SitemapRuntimeTable::INACTIVE,
                                    'ACTIVE_ELEMENT' => $bActiveElement ? SitemapRuntimeTable::ACTIVE : SitemapRuntimeTable::INACTIVE,
                                    'PROCESSED' => SitemapRuntimeTable::PROCESSED,
                                ];

                                if ($bActive) {
                                    $this->ns['IBLOCK'][$iblockId]['S']++;

                                    $arSection['LANG_DIR'] = $arSitemap['SITE']['DIR'];

                                    // remove or replace SERVER_NAME
                                    $url = SitemapIblock::prepareUrlToReplace($arSection['SECTION_PAGE_URL'],
                                        $arSitemap['SITE_ID']);
                                    $url = CIBlock::ReplaceDetailUrl($url, $arSection, false, "S");

                                    $sitemapFile->addIBlockEntry($url, $sectionLastmod);
                                }

                                SitemapRuntimeTable::add($arRuntimeData);

                                if ($bActiveElement) {
                                    $this->ns['CURRENT_SECTION'] = $arSection['ID'];
                                    $this->ns['LAST_ELEMENT_ID'] = 0;

                                    $dbOldIblockResult = $dbIblockResult;
                                    $dbIblockResult = null;
                                }

                            } elseif (!$bCheckFinished) {
                                unset($this->ns['CURRENT_SECTION']);
                                $bCheckFinished = true;
                                $dbIblockResult = null;
                            } else {
                                $bCheckFinished = false;
                                // we have finished current iblock

                                SitemapRuntimeTable::update($currentIblock['ID'], [
                                    'PROCESSED' => SitemapRuntimeTable::PROCESSED,
                                ]);

                                if ($arSitemap['SETTINGS']['IBLOCK_LIST'][$iblockId] == 'Y' && strlen($arCurrentIBlock['LIST_PAGE_URL']) > 0) {
                                    $this->ns['IBLOCK'][$iblockId]['I']++;

                                    $arCurrentIBlock['IBLOCK_ID'] = $arCurrentIBlock['ID'];
                                    $arCurrentIBlock['LANG_DIR'] = $arSitemap['SITE']['DIR'];

                                    // remove or replace SERVER_NAME
                                    $url = SitemapIblock::prepareUrlToReplace($arCurrentIBlock['LIST_PAGE_URL'],
                                        $arSitemap['SITE_ID']);
                                    $url = CIBlock::ReplaceDetailUrl($url, $arCurrentIBlock, false, "");

                                    $sitemapFile->addIBlockEntry($url, $this->ns['IBLOCK_LASTMOD']);
                                }

                                if ($sitemapFile->isNotEmpty()) {
                                    if ($sitemapFile->isCurrentPartNotEmpty()) {
                                        $sitemapFile->finish();
                                    } else {
                                        $sitemapFile->delete();
                                    }

                                    if (!is_array($this->ns['XML_FILES'])) {
                                        $this->ns['XML_FILES'] = [];
                                    }

                                    $xmlFiles = $sitemapFile->getNameList();
                                    $directory = $sitemapFile->getPathDirectory();
                                    foreach ($xmlFiles as &$xmlFile) {
                                        $xmlFile = $directory . $xmlFile;
                                    }
                                    $this->ns['XML_FILES'] = array_unique(array_merge($this->ns['XML_FILES'],
                                        $xmlFiles));
                                } else {
                                    $sitemapFile->delete();
                                }

                                $currentIblock = false;
                                $this->ns['LEFT_MARGIN'] = 0;
                                $this->ns['IBLOCK_LASTMOD'] = 0;
                                unset($this->ns['CURRENT_SECTION']);
                                $this->ns['LAST_ELEMENT_ID'] = 0;
                            }
                        }
                    }
                }
                if ($this->value < $arValueSteps['iblock'] - 1) {
//                    $msg = Loc::getMessage('SITEMAP_RUN_IBLOCK_NAME', ['#IBLOCK_NAME#' => $arCurrentIBlock['NAME']]);
                    $this->value++;
                }

                if ($bFinished) {
                    $this->value = $arValueSteps['iblock'];
//                    $msg = Loc::getMessage('SITEMAP_RUN_FINALIZE');
                }
            } elseif ($this->value < $arValueSteps['forum_index']) {
                $this->ns['time_start'] = microtime(true);

                $arForumList = [];
                if (!empty($arSitemap['SETTINGS']['FORUM_ACTIVE'])) {
                    foreach ($arSitemap['SETTINGS']['FORUM_ACTIVE'] as $forumId => $active) {
                        if ($active == "Y") {
                            $arForumList[$forumId] = "Y";
                        }
                    }
                }
                if (count($arForumList) > 0 && Loader::includeModule('forum')) {
                    $arForums = [];
                    $db_res = CForumNew::GetListEx(
                        [],
                        [
                            '@ID' => array_keys($arForumList),
                            "ACTIVE" => "Y",
                            "SITE_ID" => $arSitemap['SITE_ID'],
                            "!TOPICS" => 0
                        ]
                    );
                    while ($res = $db_res->Fetch()) {
                        $arForums[$res['ID']] = $res;
                    }
                    $arForumList = array_intersect_key($arForums, $arForumList);

                    foreach ($arForumList as $id => $forum) {
                        SitemapRuntimeTable::add([
                                'PID' => $this->id,
                                'PROCESSED' => SitemapRuntimeTable::UNPROCESSED,
                                'ITEM_ID' => $id,
                                'ITEM_TYPE' => SitemapRuntimeTable::ITEM_TYPE_FORUM
                            ]
                        );

                        $fileName = str_replace('#FORUM_ID#', $forumId, $arSitemap['SETTINGS']['FILENAME_FORUM']);
                        $sitemapFile = new SitemapRuntime($this->id, $fileName, $arSitemapSettings);
                    }
                }

                $this->ns['FORUM_CURRENT_TOPIC'] = 0;

                if (count($arForumList) <= 0) {
                    $this->value = $arValueSteps['forum'];
//                    $msg = Loc::getMessage('SITEMAP_RUN_FORUM_EMPTY');
                } else {
                    $this->value = $arValueSteps['forum_index'];
//                    $msg = Loc::getMessage('SITEMAP_RUN_FORUM');
                }
            } else {
                if ($this->value < $arValueSteps['forum']) {
                    $stepDuration = 10;
                    $ts_finish = microtime(true) + $stepDuration * 0.95;

                    $bFinished = false;
                    $bCheckFinished = false;

                    $currentForum = false;
                    $forumId = 0;

                    $dbTopicResult = null;
                    $arTopic = null;

                    while (!$bFinished && microtime(true) <= $ts_finish && CModule::IncludeModule('forum')) {
                        if (!$currentForum) {
                            $arCurrentForum = false;
                            $dbRes = SitemapRuntimeTable::getList([
                                'order' => ['ID' => 'ASC'],
                                'filter' => [
                                    'PID' => $this->id,
                                    'ITEM_TYPE' => SitemapRuntimeTable::ITEM_TYPE_FORUM,
                                    'PROCESSED' => SitemapRuntimeTable::UNPROCESSED,
                                ],
                                'limit' => 1
                            ]);

                            $currentForum = $dbRes->fetch();

                            if ($currentForum) {
                                $forumId = intval($currentForum['ITEM_ID']);

                                $db_res = CForumNew::GetListEx(
                                    [],
                                    [
                                        'ID' => $forumId,
                                        "ACTIVE" => "Y",
                                        "SITE_ID" => $arSitemap['SITE_ID'],
                                        "!TOPICS" => 0
                                    ]
                                );
                                $arCurrentForum = $db_res->Fetch();
                                if (!$arCurrentForum) {
                                    SitemapRuntimeTable::update($currentForum['ID'], [
                                        'PROCESSED' => SitemapRuntimeTable::PROCESSED
                                    ]);
                                } else {
                                    $fileName = str_replace('#FORUM_ID#', $forumId,
                                        $arSitemap['SETTINGS']['FILENAME_FORUM']);
                                    $sitemapFile = new SitemapRuntime($this->id, $fileName, $arSitemapSettings);
                                }
                            }
                        }

                        if (!$currentForum) {
                            $bFinished = true;
                        } elseif (is_array($arCurrentForum)) {
                            $bActive = (array_key_exists($forumId,
                                    $arSitemap['SETTINGS']['FORUM_TOPIC']) && $arSitemap['SETTINGS']['FORUM_TOPIC'][$forumId] == "Y");
                            if ($bActive) {
                                if ($dbTopicResult == null) {
                                    $dbTopicResult = CForumTopic::GetList(
                                        ['LAST_POST_DATE' => 'DESC'],
                                        array_merge([
                                            "FORUM_ID" => $forumId,
                                            "APPROVED" => "Y"
                                        ],
                                            ($this->ns['FORUM_CURRENT_TOPIC'] > 0 ? [
                                                ">ID" => $this->ns["FORUM_CURRENT_TOPIC"]
                                            ] : [])
                                        ),
                                        false,
                                        0,
                                        ['nTopCount' => 100]
                                    );
                                }
                                if (($arTopic = $dbTopicResult->fetch()) && $arTopic) {
                                    $this->ns['FORUM_CURRENT_TOPIC'] = $arTopic['ID'];
                                    $url = CForumNew::PreparePath2Message(
                                        $arCurrentForum['PATH2FORUM_MESSAGE'],
                                        [
                                            'FORUM_ID' => $arCurrentForum['ID'],
                                            'TOPIC_ID' => $arTopic['ID'],
                                            'TITLE_SEO' => $arTopic['TITLE_SEO'],
                                            'MESSAGE_ID' => 's',
                                            'SOCNET_GROUP_ID' => $arTopic['SOCNET_GROUP_ID'],
                                            'OWNER_ID' => $arTopic['OWNER_ID'],
                                            'PARAM1' => $arTopic['PARAM1'],
                                            'PARAM2' => $arTopic['PARAM2']
                                        ]
                                    );
                                    $sitemapFile->addIBlockEntry($url, MakeTimeStamp($arTopic['LAST_POST_DATE']));
                                }
                            } else {
                                $url = CForumNew::PreparePath2Message(
                                    $arCurrentForum["PATH2FORUM_MESSAGE"],
                                    [
                                        'FORUM_ID' => $arCurrentForum['ID'],
                                        'TOPIC_ID' => $arCurrentForum['TID'],
                                        'TITLE_SEO' => $arCurrentForum['TITLE_SEO'],
                                        'MESSAGE_ID' => 's',
                                        'SOCNET_GROUP_ID' => $arCurrentForum['SOCNET_GROUP_ID'],
                                        'OWNER_ID' => $arCurrentForum['OWNER_ID'],
                                        'PARAM1' => $arCurrentForum['PARAM1'],
                                        'PARAM2' => $arCurrentForum['PARAM2']
                                    ]
                                );
                                $sitemapFile->addIBlockEntry($url, MakeTimeStamp($arCurrentForum['LAST_POST_DATE']));
                            }
                            if (empty($arTopic)) {
                                $bCheckFinished = false;
                                // we have finished current forum

                                SitemapRuntimeTable::update($currentForum['ID'], [
                                    'PROCESSED' => SitemapRuntimeTable::PROCESSED,
                                ]);

                                if ($sitemapFile->isNotEmpty()) {
                                    if ($sitemapFile->isCurrentPartNotEmpty()) {
                                        $sitemapFile->finish();
                                    } else {
                                        $sitemapFile->delete();
                                    }

                                    if (!is_array($this->ns['XML_FILES'])) {
                                        $this->ns['XML_FILES'] = [];
                                    }

                                    $xmlFiles = $sitemapFile->getNameList();
                                    $directory = $sitemapFile->getPathDirectory();
                                    foreach ($xmlFiles as &$xmlFile) {
                                        $xmlFile = $directory . $xmlFile;
                                    }
                                    $this->ns['XML_FILES'] = array_unique(array_merge($this->ns['XML_FILES'],
                                        $xmlFiles));
                                } else {
                                    $sitemapFile->delete();
                                }

                                $currentForum = false;
                                $dbTopicResult = null;
                                $this->ns['FORUM_CURRENT_TOPIC'] = 0;
                            }
                        }
                    }
                    if ($this->value < $arValueSteps['forum'] - 1) {
//                        $msg = Loc::getMessage('SITEMAP_RUN_FORUM_NAME', ['#FORUM_NAME#' => $arCurrentForum['NAME']]);
                        $this->value++;
                    }

                    if ($bFinished) {
                        $this->value = $arValueSteps['forum'];
//                        $msg = Loc::getMessage('SITEMAP_RUN_FINALIZE');
                    }
                } else {
                    SitemapRuntimeTable::clearByPid($this->id);

                    $arFiles = [];

                    $sitemapFile = new SitemapIndex($arSitemap['SETTINGS']['FILENAME_INDEX'], $arSitemapSettings);

                    if (count($this->ns['XML_FILES']) > 0) {
                        foreach ($this->ns['XML_FILES'] as $xmlFile) {
                            $arFiles[] = new File(Path::combine(
                                $sitemapFile->getSiteRoot(),
                                $xmlFile
                            ), $arSitemap['SITE_ID']);
                        }
                    }

                    $sitemapFile->createIndex($arFiles);

                    $arExistedSitemaps = [];

                    if ($arSitemap['SETTINGS']['ROBOTS'] == 'Y') {
                        $sitemapUrl = $sitemapFile->getUrl();

                        $robotsFile = new RobotsFile($arSitemap['SITE_ID']);
                        $robotsFile->addRule(
                            [RobotsFile::SITEMAP_RULE, $sitemapUrl]
                        );

                        $arSitemapLinks = $robotsFile->getRules(RobotsFile::SITEMAP_RULE);
                        if (count($arSitemapLinks) > 1) // 1 - just added rule
                        {
                            foreach ($arSitemapLinks as $rule) {
                                if ($rule[1] != $sitemapUrl) {
                                    $arExistedSitemaps[] = $rule[1];
                                }
                            }
                        }
                    }

                    $this->value = $arValueSteps['index'];
                }
            }
        }

        if ($this->value == $arValueSteps['index']) {
//            $msg = Loc::getMessage('SITEMAP_RUN_FINISH');
            SitemapTable::update($this->id, ['DATE_RUN' => new DateTime()]);
        }

//        echo SitemapRuntime::showProgress($msg, Loc::getMessage('SEO_SITEMAP_RUN_TITLE'), $this->value);

        if ($this->value < $arValueSteps['index']) {
            if (isset($NS['IBLOCK_MAP'])) {
                $_SESSION["SEO_SITEMAP_{$this->id}"] = $this->ns['IBLOCK_MAP'];
                unset($this->ns['IBLOCK_MAP']);
            }

            $recursiveThis = new self($this->id);
            $recursiveThis->value = $this->value;
            $recursiveThis->ns = $this->ns;
            $return = $recursiveThis->run();
            return $return;
        } else {
            return true;
        }
    }


    /**
     * Получение файлов карт сайта (не точно)
     * @param $arSitemap
     * @param $arCurrentDir
     * @param $sitemapFile
     */
    protected function seoSitemapGetFilesData($arSitemap, $arCurrentDir, $sitemapFile)
    {
        $arDirList = [];

        if ($arCurrentDir['ACTIVE'] == SitemapRuntimeTable::ACTIVE) {
            $list = CSeoUtils::getDirStructure(
                $arSitemap['SETTINGS']['logical'] == 'Y',
                $arSitemap['SITE_ID'],
                $arCurrentDir['ITEM_PATH']
            );

            foreach ($list as $dir) {
                $dirKey = '/' . ltrim($dir['DATA']['ABS_PATH'], '/');

                if ($dir['TYPE'] == 'F') {
                    if (!isset($arSitemap['SETTINGS']['FILE'][$dirKey]) || $arSitemap['SETTINGS']['FILE'][$dirKey] == 'Y') {
                        if (preg_match($arSitemap['SETTINGS']['FILE_MASK_REGEXP'], $dir['FILE'])) {
                            $f = new File($dir['DATA']['PATH'], $arSitemap['SITE_ID']);
                            $sitemapFile->addFileEntry($f);
                            $this->ns['files_count']++;
                        }
                    }
                } else {
                    if (!isset($arSitemap['SETTINGS']['DIR'][$dirKey]) || $arSitemap['SETTINGS']['DIR'][$dirKey] == 'Y') {
                        $arDirList[] = $dirKey;
                    }
                }
            }
        } else {
            $len = strlen($arCurrentDir['ITEM_PATH']);
            if (!empty($arSitemap['SETTINGS']['DIR'])) {
                foreach ($arSitemap['SETTINGS']['DIR'] as $dirKey => $checked) {
                    if ($checked == 'Y') {
                        if (strncmp($arCurrentDir['ITEM_PATH'], $dirKey, $len) === 0) {
                            $arDirList[] = $dirKey;
                        }
                    }
                }
            }

            if (!empty($arSitemap['SETTINGS']['FILE'])) {
                foreach ($arSitemap['SETTINGS']['FILE'] as $dirKey => $checked) {
                    if ($checked == 'Y') {
                        if (strncmp($arCurrentDir['ITEM_PATH'], $dirKey, $len) === 0) {
                            $fileName = Path::combine(
                                SiteTable::getDocumentRoot($arSitemap['SITE_ID']),
                                $dirKey
                            );

                            if (!is_dir($fileName)) {
                                $f = new File($fileName, $arSitemap['SITE_ID']);
                                if ($f->isExists()
                                    && !$f->isSystem()
                                    && preg_match($arSitemap['SETTINGS']['FILE_MASK_REGEXP'], $f->getName())
                                ) {
                                    $sitemapFile->addFileEntry($f);
                                    $this->ns['files_count']++;
                                }
                            }
                        }
                    }
                }
            }
        }

        if (count($arDirList) > 0) {
            foreach ($arDirList as $dirKey) {
                $arRuntimeData = [
                    'PID' => $this->id,
                    'ITEM_PATH' => $dirKey,
                    'PROCESSED' => SitemapRuntimeTable::UNPROCESSED,
                    'ACTIVE' => SitemapRuntimeTable::ACTIVE,
                    'ITEM_TYPE' => SitemapRuntimeTable::ITEM_TYPE_DIR,
                ];
                SitemapRuntimeTable::add($arRuntimeData);
            }
        }

        SitemapRuntimeTable::update($arCurrentDir['ID'], [
            'PROCESSED' => SitemapRuntimeTable::PROCESSED
        ]);
    }

    /**
     * Какие элемнты будут попадать в карту сайта<br>
     * (управляется фильтром CIBlockElement, но и можно продолжить проверки<br>
     * те элементы, которые будут в итоге возвращены в результирующем CIBlockResult и попадут в sitemap)
     */
    protected function getCIBlockElements(int $iblockId, string $siteId): CIBlockResult
    {
        $sectionId = intval($this->ns['CURRENT_SECTION']);
        $lastElementId = intval($this->ns['LAST_ELEMENT_ID']);

        $dbIblockPreResult = CIBlockElement::GetList(
            ['ID' => 'ASC'],
            [
                'IBLOCK_ID' => $iblockId,
                'ACTIVE' => 'Y',
                'SECTION_ID' => $sectionId,
                '>ID' => $lastElementId,
                'SITE_ID' => $siteId,
//                'ACTIVE_DATE' => 'Y'
            ],
            false,
            ['nTopCount' => 1000],
            ['ID', 'IBLOCK_ID', 'CODE','TIMESTAMP_X', 'DETAIL_PAGE_URL', 'GLOBAL_ACTIVE', 'ACTIVE_FROM', 'ACTIVE_TO']
        );

        $arElementsIds = [];
        while ($element = $dbIblockPreResult->Fetch()) {
            // тут можно сделать проверку по свойствам и т.д.
            if (empty($element['IBLOCK_ID']) || empty($element['ID'])) {
                continue;
            }

            $dbPropMainEvent = CIBlockElement::GetProperty(
                $element['IBLOCK_ID'],
                $element['ID'],
                null,
                null,
                ['CODE' => 'main_event']
            );
            $arPropMainEvent = $dbPropMainEvent->Fetch();

            // есть свойство main_event
            if (!empty($arPropMainEvent)) {
                if (empty($arPropMainEvent['VALUE'])) {
                    $arElementsIds[] = $element['ID'];
                }
            } else {
                // нет свойства main_event
                // проверяем по датам активности
                if (array_key_exists('ACTIVE_FROM', $element) && !empty($element['ACTIVE_FROM']) &&
                    new DateTime($element['ACTIVE_FROM']) > new DateTime()) {
                    continue;
                }

                if (array_key_exists('ACTIVE_TO', $element) && !empty($element['ACTIVE_TO']) &&
                    new DateTime($element['ACTIVE_TO']) < new DateTime()) {
                    continue;
                }

                $arElementsIds[] = $element['ID'];
            }
        }


        $dbResult = CIBlockElement::GetList(
            ['ID' => 'ASC'],
            [
                'IBLOCK_ID' => $iblockId,
                'ACTIVE' => 'Y',
                'SECTION_ID' => $sectionId,
                '>ID' => $lastElementId,
                'ID' => !empty($arElementsIds) ? $arElementsIds : false,
                'SITE_ID' => $siteId,
//                'ACTIVE_DATE' => 'Y'
            ],
            false,
            ['nTopCount' => 1000],
            ['ID', 'IBLOCK_ID', 'TIMESTAMP_X', 'DETAIL_PAGE_URL', 'GLOBAL_ACTIVE', 'ACTIVE_FROM', 'ACTIVE_TO']
        );

        return $dbResult;
    }

}
