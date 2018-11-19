<?php

namespace Anvein\SitemapCG;

use Bitrix\Seo\SitemapIblockTable;
use Bitrix\Seo\SitemapRuntime;
use Bitrix\Seo\SitemapIblock;
use Bitrix\Seo\SitemapIndex;
use Bitrix\Seo\SitemapFile;
use Bitrix\Seo\RobotsFile;
use Bitrix\Main\SiteTable;
use CIBlockSection;
use CIBlockElement;
use DateTime;
use CIBlock;


class SitemapIblockGenerator extends SitemapIblock
{
    private static $beforeActions = [
        'BEFOREDELETEELEMENT' => [[], []],
        'BEFOREDELETESECTION' => [[], []],
        'BEFOREUPDATEELEMENT' => [[], []],
        'BEFOREUPDATESECTION' => [[], []],
    ];


    /**
     * @inheritdoc
     */
    public static function __callStatic($name, $arguments)
    {
        $name = ToUpper($name);

        switch ($name) {
            case 'ADDELEMENT':
            case 'ADDSECTION':
                $fields = reset($arguments);

                if ($fields['ID'] > 0 && $fields['IBLOCK_ID'] > 0
                    && (!isset($fields['ACTIVE']) || $fields['ACTIVE'] == 'Y')) {
                    // we recieve array reference here
                    if (!isset($fields['EXTERNAL_ID']) && isset($fields['XML_ID'])) {
                        $fields['EXTERNAL_ID'] = $fields['XML_ID'];
                    }

                    self::actionAdd($name, $fields);
                }
                break;

            case 'BEFOREDELETEELEMENT':
            case 'BEFOREDELETESECTION':
            case 'BEFOREUPDATEELEMENT':
            case 'BEFOREUPDATESECTION':
                $ID = reset($arguments);
                if (is_array($ID)) {
                    $ID = $ID['ID'];
                }

                if ($ID > 0) {
                    $element = $name == 'BEFOREDELETEELEMENT' || $name == 'BEFOREUPDATEELEMENT';

                    $dbFields = $element
                        ? CIBlockElement::getByID($ID)
                        : CIBlockSection::getByID($ID);

                    $fields = $dbFields->getNext();
                    if ($fields) {
                        if ($element && !self::checkElement($fields)) {
                            return;
                        }

                        $sitemaps = SitemapIblockTable::getByIblock(
                            $fields,
                            $element ? SitemapIblockTable::TYPE_ELEMENT : SitemapIblockTable::TYPE_SECTION
                        );

                        if (count($sitemaps) > 0) {
//							URL from $fields may be incorrect, if using #SERVER_NAME# template in iblock URL-template
//							And we must generate true URL
                            $dbIblock = CIBlock::GetByID($fields['IBLOCK_ID']);
                            $iblock = $dbIblock->GetNext();
                            $url = $element
                                ? $iblock['~DETAIL_PAGE_URL']
                                : $iblock['~SECTION_PAGE_URL'];
                            $url = self::prepareUrlToReplace($url);
                            $url = CIBlock::replaceDetailUrl($url, $fields, false, $element ? 'E' : 'S');

                            // TODO: понять, что тут делается (возможно переписать)
                            self::$beforeActions[$name][intval($element)][$ID] = [
                                'URL' => $url,
                                'FIELDS' => $fields,
                                'SITEMAPS' => $sitemaps,
                            ];
                        }
                    }
                }
                break;

            case 'DELETEELEMENT':
            case 'DELETESECTION':
            case 'UPDATEELEMENT':
            case 'UPDATESECTION':
                $fields = reset($arguments);
                $element = $name == 'DELETEELEMENT' || $name == 'UPDATEELEMENT';

                if (is_array($fields) && $fields['ID'] > 0
                    && isset(self::$beforeActions['BEFORE' . $name][intval($element)][$fields['ID']])) {
                    if ($fields['RESULT'] !== false) {
                        if ($name == 'DELETEELEMENT' || $name == 'DELETESECTION') {
                            self::actionDelete(self::$beforeActions['BEFORE' . $name][intval($element)][$fields['ID']]);
                        } else {
                            self::actionUpdate(self::$beforeActions['BEFORE' . $name][intval($element)][$fields['ID']],
                                $element);
                        }
                    }

                    unset(self::$beforeActions['BEFORE' . $name][intval($element)][$fields['ID']]);
                }

                break;
        }
    }

    /**
     * Проверяет активеен ли элемент
     * @param $isElement
     * @param $fields
     * @return bool
     */
    protected static function checkActivity($isElement, $fields)
    {
        if (array_key_exists('ACTIVE', $fields) && $fields['ACTIVE'] == 'N') {
            return false;
        }

        // for iblock element and iblock section we check different fields
        if ($isElement) {
            // проверяем мероприятие, canonical оно или нет (т.е. есть ли у этого события
            // ссылка на основное событие, если есть то оно не основное т.е. оно canonical и в sitamap попасть не должно)
            if (empty($fields['IBLOCK_ID']) || empty($fields['ID'])) {
                return false;
            }

            $result = CIBlockElement::GetProperty(
                $fields['IBLOCK_ID'],
                $fields['ID'],
                null,
                null,
                ['CODE' => 'main_event']
            );
            $arPropMainEvent = $result->Fetch();

            if (!empty($arPropMainEvent)) {
                if (empty($arPropMainEvent['VALUE'])) {
                    return true;
                } else {
                    return false;
                }
            }

            // если свойства main_evet у элемента вообще нет (это не мероприятие),
            // то активность проверяем как обычно
            // activity may be in field DATE_ACTIVE_ or ACTIVE_, check both
            if (array_key_exists('DATE_ACTIVE_FROM', $fields) && $fields['DATE_ACTIVE_FROM'] &&
                new DateTime($fields['DATE_ACTIVE_FROM']) > new DateTime($fields['TIMESTAMP_X'])) {
                return false;
            }
            if (array_key_exists('ACTIVE_FROM', $fields) && $fields['ACTIVE_FROM'] &&
                new DateTime($fields['ACTIVE_FROM']) > new DateTime($fields['TIMESTAMP_X'])) {
                return false;
            }

            if (array_key_exists('DATE_ACTIVE_TO', $fields) && $fields['DATE_ACTIVE_TO'] &&
                new DateTime($fields['DATE_ACTIVE_TO']) < new DateTime($fields['TIMESTAMP_X'])) {
                return false;
            }
            if (array_key_exists('ACTIVE_TO', $fields) && $fields['ACTIVE_TO'] &&
                new DateTime($fields['ACTIVE_TO']) < new DateTime($fields['TIMESTAMP_X'])) {
                return false;
            }
        } else {
            if (array_key_exists('GLOBAL_ACTIVE', $fields) && $fields['GLOBAL_ACTIVE'] == 'N') {
                return false;
            }
        }

        return true;
    }


    protected static function createSiteDirs()
    {
        $siteDirs = [];
        $dbSite = SiteTable::getList(['select' => ['LID', 'DIR', 'SERVER_NAME']]);
        while ($site = $dbSite->fetch()) {
            $siteDirs[$site['LID']] = $site['DIR'];
        }

        return $siteDirs;
    }


    /**
     * @inheritdoc
     */
    protected static function actionAdd($name, $fields)
    {
        if ($name == 'ADDELEMENT') {
            if (!self::checkElement($fields)) {
                return;
            }

            // we don't have the GLOBAL_ACTIVE flag in fields so we should check it manually
            if (is_array($fields['IBLOCK_SECTION']) && count($fields['IBLOCK_SECTION']) > 0) {
                $newSections = array();
                $filter = array(
                    'ID' => $fields['IBLOCK_SECTION'],
                    'IBLOCK_ID' => $fields['IBLOCK_ID'],
                    'GLOBAL_ACTIVE' => 'Y'
                );

                $dbRes = \CIBlockSection::getList(array(), $filter, false,
                    array('ID', 'IBLOCK_TYPE_ID', 'IBLOCK_CODE'));
                while ($ar = $dbRes->fetch()) {
                    $newSections[] = $ar['ID'];
                    $iblockTypeId = $ar['IBLOCK_TYPE_ID'] ? $ar['IBLOCK_TYPE_ID'] : null;
                    $iblockCode = $ar['IBLOCK_CODE'] ? $ar['IBLOCK_CODE'] : null;
                }

                if (count($newSections) <= 0) {
                    // element is added to inactive sections
                    return;
                }

                $fields['IBLOCK_SECTION'] = $newSections;
            }
        } elseif ($name == 'ADDSECTION') {
            $dbRes = \CIBlockSection::getList(
                array(),
                array('ID' => $fields['ID'], 'GLOBAL_ACTIVE' => 'Y'),
                false,
                array('ID', 'IBLOCK_TYPE_ID', 'IBLOCK_CODE')
            );

            $inactiveBranch = true;
            while ($ar = $dbRes->fetch()) {
                $iblockTypeId = $ar['IBLOCK_TYPE_ID'] ? $ar['IBLOCK_TYPE_ID'] : null;
                $iblockCode = $ar['IBLOCK_CODE'] ? $ar['IBLOCK_CODE'] : null;
                $inactiveBranch = false;
            }

            if ($inactiveBranch) {
                // section is added to inactive branch
                return;
            }
        }

        $fields['IBLOCK_TYPE_ID'] = $iblockTypeId;
        $fields['IBLOCK_CODE'] = $iblockCode;

        $sitemaps = SitemapIblockTable::getByIblock(
            $fields,
            $name == 'ADDSECTION' ? SitemapIblockTable::TYPE_SECTION : SitemapIblockTable::TYPE_ELEMENT
        );

        $fields['TIMESTAMP_X'] = ConvertTimeStamp(false, "FULL");

        if (isset($fields['IBLOCK_SECTION']) && is_array($fields['IBLOCK_SECTION']) && count($fields['IBLOCK_SECTION']) > 0) {
            $fields['IBLOCK_SECTION_ID'] = min($fields['IBLOCK_SECTION']);
        }

        if (count($sitemaps) > 0) {
            $siteDirs = self::createSiteDirs();

            foreach ($sitemaps as $sitemap) {
                $fileName = str_replace(
                    array('#IBLOCK_ID#', '#IBLOCK_CODE#', '#IBLOCK_XML_ID#'),
                    array($fields['IBLOCK_ID'], $sitemap['IBLOCK_CODE'], $sitemap['IBLOCK_XML_ID']),
                    $sitemap['SITEMAP_FILE_IBLOCK']
                );

                $sitemapFile = new SitemapFile($fileName, $sitemap);

//				write changes to temp file to preserve collisions
                $sitemapRuntimeId = $sitemap['SITE_ID'] . '-' . uniqid();
                $sitemapRuntimeId .= isset($fields['ID']) ? '-' . $fields['ID'] . '-' : '';
                $sitemapRuntimeFile = new SitemapRuntime($sitemapRuntimeId, $fileName, $sitemap);

                if (self::checkActivity($name == 'ADDELEMENT' ? true : false, $fields)) {
                    $fields['LANG_DIR'] = $siteDirs[$sitemap['SITE_ID']];

                    $url = $name == 'ADDSECTION' ? $sitemap['SECTION_PAGE_URL'] : $sitemap['DETAIL_PAGE_URL'];
                    $urlType = $name == 'ADDSECTION' ? 'S' : 'E';
//					remove or replace SERVER_NAME
                    $url = self::prepareUrlToReplace($url, $sitemap['SITE_ID']);
                    $rule = array(
                        'url' => \CIBlock::replaceDetailUrl($url, $fields, false, $urlType),
                        'lastmod' => MakeTimeStamp($fields['TIMESTAMP_X']),
                    );

                    $sitemapRuntimeFile->setOriginalFile($sitemapFile);
                    $sitemapRuntimeFile->appendIblockEntry($rule['url'], $rule['lastmod']);
                }

//				after this in original file will be added always changes
                if ($sitemapRuntimeFile->isNotEmpty() && $sitemapRuntimeFile->isCurrentPartNotEmpty()) {
                    $sitemapRuntimeFile->finish();
                } else {
                    $sitemapRuntimeFile->delete();
                }

                $sitemapIndex = new SitemapIndex($sitemap['SITEMAP_FILE'], $sitemap);
                $sitemapIndex->appendIndexEntry($sitemapFile);

                if ($sitemap['ROBOTS'] == 'Y') {
                    $robotsFile = new RobotsFile($sitemap['SITE_ID']);
                    $robotsFile->addRule(
                        array(RobotsFile::SITEMAP_RULE, $sitemapIndex->getUrl())
                    );
                }
            }
        }
    }

    /**
     * @inheritdoc
     */
    protected static function actionDelete($data)
    {
        $fields = $data['FIELDS'];
        foreach ($data['SITEMAPS'] as $sitemap) {
            $fileName = str_replace(
                ['#IBLOCK_ID#', '#IBLOCK_CODE#', '#IBLOCK_XML_ID#'],
                [$fields['IBLOCK_ID'], $sitemap['IBLOCK_CODE'], $sitemap['IBLOCK_XML_ID']],
                $sitemap['SITEMAP_FILE_IBLOCK']
            );

            $sitemapFile = new SitemapFile($fileName, $sitemap);
            $sitemapFile->removeEntry($data['URL']);

            $sitemapIndex = new SitemapIndex($sitemap['SITEMAP_FILE'], $sitemap);
            $sitemapIndex->appendIndexEntry($sitemapFile);
        }
    }

    /**
     * @inheritdoc
     */
    protected static function actionUpdate($data, $element)
    {
        $fields = $data['FIELDS'];
        $siteDirs = self::createSiteDirs();

        foreach ($data['SITEMAPS'] as $sitemap) {
            $fileName = str_replace(
                array('#IBLOCK_ID#', '#IBLOCK_CODE#', '#IBLOCK_XML_ID#'),
                array($fields['IBLOCK_ID'], $sitemap['IBLOCK_CODE'], $sitemap['IBLOCK_XML_ID']),
                $sitemap['SITEMAP_FILE_IBLOCK']
            );

            if ($element) {
                $dbRes = CIBlockElement::getByID($fields["ID"]);
            } else {
                $dbRes = CIBlockSection::getByID($fields["ID"]);
            }

            $newFields = $dbRes->fetch();

            $sitemapFile = new SitemapFile($fileName, $sitemap);
            // try remove entry from original file, to not create temp files to all parts
            // name may was changed in removeEntry
            $fileName = $sitemapFile->removeEntry($data['URL']);

            // write changes to temp file to preserve collisions
            $sitemapRuntimeId = $sitemap['SITE_ID'] . '-' . uniqid();
            $sitemapRuntimeId .= isset($fields['ID']) ? '-' . $fields['ID'] . '-' : '';
            $sitemapRuntimeFile = new SitemapRuntime($sitemapRuntimeId, $fileName, $sitemap);

            // check ACTIVITY by active, date or etc, add entry only for active
            if (self::checkActivity($element, $newFields)) {
                $newFields['LANG_DIR'] = $siteDirs[$sitemap['SITE_ID']];

                // use just date(). it is not true, but because we use BEFORE event, we cant use real lastmod date, only previous value
                $date = date('d.m.Y H:i:s');

                $url = $element ? $sitemap['DETAIL_PAGE_URL'] : $sitemap['SECTION_PAGE_URL'];
                $urlType = $element ? 'E' : 'S';
                // remove or replace SERVER_NAME
                $url = self::prepareUrlToReplace($url, $sitemap['SITE_ID']);
                $rule = array(
                    'url' => CIBlock::replaceDetailUrl($url, $newFields, false, $urlType),
                    'lastmod' => MakeTimeStamp($date),
                );

                $sitemapRuntimeFile->setOriginalFile($sitemapFile);
                $sitemapRuntimeFile->appendIblockEntry($rule['url'], $rule['lastmod']);
            }

            // rename RUNTIME file to original SITEMAPFILE name, or just remove TMP file
            // after this in original file will be added always changes
            if ($sitemapRuntimeFile->isNotEmpty() && $sitemapRuntimeFile->isCurrentPartNotEmpty()) {
                $sitemapRuntimeFile->finish();
            } else {
                $sitemapRuntimeFile->delete();
            }

            $sitemapIndex = new SitemapIndex($sitemap['SITEMAP_FILE'], $sitemap);
            $sitemapIndex->appendIndexEntry($sitemapFile);

            if ($sitemap['ROBOTS'] == 'Y') {
                $robotsFile = new RobotsFile($sitemap['SITE_ID']);
                $robotsFile->addRule(
                    array(RobotsFile::SITEMAP_RULE, $sitemapIndex->getUrl())
                );
            }
        }
    }



    // на стулчай если надо будет каждоый метод кастомизировать по своему
//    public static function addSection($arg)
//    {
//        parent::addSection($arg);
//    }
//
//
//    public static function addElement($arg)
//    {
//        parent::addElement($arg);
//    }
//
//
//    public static function beforeDeleteSection($arg)
//    {
//        parent::beforeDeleteSection($arg);
//    }
//
//    public static function beforeDeleteElement($arg)
//    {
//        parent::beforeDeleteElement($arg);
//    }
//
//
//    public static function deleteSection($arg)
//    {
//        parent::deleteSection($arg);
//    }
//
//    public static function deleteElement($arg)
//    {
//        parent::deleteElement($arg);
//    }
//
//    public static function beforeUpdateSection($arg)
//    {
//        parent::beforeUpdateSection($arg);
//    }
//
//    public static function beforeUpdateElement($arg)
//    {
//        parent::beforeUpdateElement($arg);
//    }
//
//    public static function updateSection($arg)
//    {
//        parent::updateSection($arg);
//    }
//
//    public static function updateElement($arg)
//    {
//        parent::updateElement($arg);
//    }


}