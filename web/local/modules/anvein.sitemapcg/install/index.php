<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\EventManager;
use Bitrix\Main\Application;
use Exception;
use CAgent;
use DateTime;

Loc::loadMessages(__FILE__);

class anvein_sitemapcg extends CModule
{
    public $MODULE_ID;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;

    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;

    public $MODULE_GROUP_RIGHTS;

    public $PARTNER_NAME;
    public $PARTNER_URI;

    private $PARTNER_DIR;

    /**
     * Точка входа
     */
    public function __construct()
    {
        $arModuleVersion = [];
        include __DIR__.'/version.php';

        $this->PARTNER_DIR = 'anvein';
        $this->MODULE_ID = 'anvein.sitemapcg';
        $this->MODULE_NAME = Loc::getMessage('anvein_sitemapcg_name');
        $this->MODULE_DESCRIPTION = Loc::getMessage('anvein_sitemapcg_description');

        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];

        $this->PARTNER_NAME = Loc::getMessage('anvein_sitemapcg_partner_name');
        $this->PARTNER_URI = '/';
    }

    /**
     * Точка входа при установке
     * @return bool
     * @throws Exception ошибка, если стандартный модуль seo не установлен
     */
    public function DoInstall()
    {
        if (!ModuleManager::isModuleInstalled('seo')) {
            global $APPLICATION;
            $APPLICATION->ThrowException('Модуль seo не установлен. Устанавливаемый модуль является надстройкой над модулем seo.');
            return false;
        }

        if (!ModuleManager::isModuleInstalled($this->MODULE_ID)) {
            ModuleManager::registerModule($this->MODULE_ID);
            $this->InstallFiles();
            $this->InstallEvents();

            return true;
        }
    }

    /**
     * Точка входа при удалении
     * @return bool
     */
    public function DoUninstall()
    {
        if (ModuleManager::isModuleInstalled($this->MODULE_ID)) {
            $this->UnInstallFiles();
            $this->UnInstallEvents();
            ModuleManager::unregisterModule($this->MODULE_ID);

            return true;
        }
    }


    /**
     * Установка файлов и компонентов
     * @return bool
     */
    public function InstallFiles()
    {
        // установка компонентов
        $path = __DIR__ . "/components/{$this->PARTNER_DIR}";
        if (is_dir($path)) {
            if ($dir = opendir($path)) {
                while (false !== $item = readdir($dir)) {
                    if ($item === '..' || $item === '.') {
                        continue;
                    }

                    CopyDirFiles(
                        "{$path}/{$item}",
                        "{$_SERVER['DOCUMENT_ROOT']}/local/components/{$this->PARTNER_DIR}/{$item}",
                        $rewrite = true,
                        $recursive = true
                    );
                }
                closedir($dir);
            }
        }

        // установка файлов админки
        $path = __DIR__ . '/admin';
        if (is_dir($path)) {
            if ($dir = opendir($path)) {
                while (false !== $item = readdir($dir)) {
                    if ($item === '..' || $item === '.') {
                        continue;
                    }

                    copy(
                        "{$path}/{$item}",
                        "{$_SERVER['DOCUMENT_ROOT']}/bitrix/admin/{$item}"
                    );
                }
                closedir($dir);
            }
        }

        return true;
    }

    /**
     * Удаление файлов и компонентов
     * @return bool
     */
    public function UnInstallFiles()
    {
        // удаление компонентов
        $path = __DIR__ . "/components/{$this->PARTNER_DIR}";
        if (is_dir($path)) {
            if ($dir = opendir($path)) {
                while (false !== $item = readdir($dir)) {
                    if ($item === '..' || $item === '.') {
                        continue;
                    }

                    $compInBitrix = "/bitrix/components/{$this->PARTNER_DIR}/{$item}";
                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $compInBitrix)) {
                        DeleteDirFilesEx($compInBitrix);
                    }

                    $compInLocal = "/local/components/{$this->PARTNER_DIR}/{$item}";
                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $compInLocal)) {
                        DeleteDirFilesEx($compInLocal);
                    }
                }
                closedir($dir);
            }
        }

        // удаление файлов админки
        $path = __DIR__ . '/admin';
        if (is_dir($path)) {
            if ($dir = opendir($path)) {
                while (false !== $item = readdir($dir)) {
                    if ($item === '..' || $item === '.') {
                        continue;
                    }

                    $pathFile = "{$_SERVER['DOCUMENT_ROOT']}/bitrix/admin/{$item}";
                    if (file_exists($pathFile)) {
                        unlink($pathFile);
                    }
                }
                closedir($dir);
            }
        }

        return true;
    }


    /**
     * Операции над БД при установке модуля
     * @return bool
     */
    public function InstallDB()
    {
        //$connection = Application::getConnection();

        return true;
    }

    /**
     * Операции над БД при удалении модуля
     * @return bool
     */
    public function UnInstallDB()
    {
        return true;
    }


    /**
     * Создание событий при установке
     * @return bool
     */
    public function InstallEvents()
    {
        $eventManager = EventManager::getInstance();

        // удаление событий генерации sitemap стандартного модуля SEO
        $seoSitemapIblockClass = '\Bitrix\Seo\SitemapIblock';
        $seoSitemapForumClass = '\Bitrix\Seo\SitemapForum';
        $eventManager->unRegisterEventHandler('iblock', 'OnAfterIBlockSectionAdd', 'seo', $seoSitemapIblockClass, 'addSection');
        $eventManager->unRegisterEventHandler('iblock', 'OnAfterIBlockElementAdd', 'seo', $seoSitemapIblockClass, 'addElement');

        $eventManager->unRegisterEventHandler('iblock', 'OnBeforeIBlockSectionDelete', 'seo', $seoSitemapIblockClass, 'beforeDeleteSection');
        $eventManager->unRegisterEventHandler('iblock', 'OnBeforeIBlockElementDelete', 'seo', $seoSitemapIblockClass, 'beforeDeleteElement');
        $eventManager->unRegisterEventHandler('iblock', 'OnAfterIBlockSectionDelete', 'seo', $seoSitemapIblockClass, 'deleteSection');
        $eventManager->unRegisterEventHandler('iblock', 'OnAfterIBlockElementDelete', 'seo', $seoSitemapIblockClass, 'deleteElement');

        $eventManager->unRegisterEventHandler('iblock', 'OnBeforeIBlockSectionUpdate', 'seo', $seoSitemapIblockClass, 'beforeUpdateSection');
        $eventManager->unRegisterEventHandler('iblock', 'OnBeforeIBlockElementUpdate', 'seo', $seoSitemapIblockClass, 'beforeUpdateElement');
        $eventManager->unRegisterEventHandler('iblock', 'OnAfterIBlockSectionUpdate', 'seo', $seoSitemapIblockClass, 'updateSection');
        $eventManager->unRegisterEventHandler('iblock', 'OnAfterIBlockElementUpdate', 'seo', $seoSitemapIblockClass, 'updateElement');

        $eventManager->unRegisterEventHandler('forum', 'onAfterTopicAdd', 'seo', $seoSitemapForumClass, 'addTopic');
        $eventManager->unRegisterEventHandler('forum', 'onAfterTopicUpdate', 'seo', $seoSitemapForumClass, 'updateTopic');
        $eventManager->unRegisterEventHandler('forum', 'onAfterTopicDelete', 'seo', $seoSitemapForumClass, 'deleteTopic');


        // создание событий на функции генерации sitemap в классах для кастомизации
        $anveinSitemapIblockGener = '\Anvein\SitemapCG\SitemapIblockGenerator';
        $anveinSitemapForumGener = '\Bitrix\Seo\SitemapForumGenerator';

        $eventManager->registerEventHandler('iblock', 'OnAfterIBlockSectionAdd', $this->MODULE_ID, $anveinSitemapIblockGener, 'addSection');
        $eventManager->registerEventHandler('iblock', 'OnAfterIBlockElementAdd', $this->MODULE_ID, $anveinSitemapIblockGener, 'addElement');

        $eventManager->registerEventHandler('iblock', 'OnBeforeIBlockSectionDelete', $this->MODULE_ID, $anveinSitemapIblockGener, 'beforeDeleteSection');
        $eventManager->registerEventHandler('iblock', 'OnBeforeIBlockElementDelete', $this->MODULE_ID, $anveinSitemapIblockGener, 'beforeDeleteElement');
        $eventManager->registerEventHandler('iblock', 'OnAfterIBlockSectionDelete', $this->MODULE_ID, $anveinSitemapIblockGener, 'deleteSection');
        $eventManager->registerEventHandler('iblock', 'OnAfterIBlockElementDelete', $this->MODULE_ID, $anveinSitemapIblockGener, 'deleteElement');

        $eventManager->registerEventHandler('iblock', 'OnBeforeIBlockSectionUpdate', $this->MODULE_ID, $anveinSitemapIblockGener, 'beforeUpdateSection');
        $eventManager->registerEventHandler('iblock', 'OnBeforeIBlockElementUpdate', $this->MODULE_ID, $anveinSitemapIblockGener, 'beforeUpdateElement');
        $eventManager->registerEventHandler('iblock', 'OnAfterIBlockSectionUpdate', $this->MODULE_ID, $anveinSitemapIblockGener, 'updateSection');
        $eventManager->registerEventHandler('iblock', 'OnAfterIBlockElementUpdate', $this->MODULE_ID, $anveinSitemapIblockGener, 'updateElement');

        $eventManager->registerEventHandler('forum', 'onAfterTopicAdd', $this->MODULE_ID, $anveinSitemapForumGener, 'addTopic');
        $eventManager->registerEventHandler('forum', 'onAfterTopicUpdate', $this->MODULE_ID, $anveinSitemapForumGener, 'updateTopic');
        $eventManager->registerEventHandler('forum', 'onAfterTopicDelete', $this->MODULE_ID, $anveinSitemapForumGener, 'deleteTopic');

        return true;
    }

    /**
     * Удаление событий модуля
     * @return bool
     */
    public function UnInstallEvents()
    {
        CAgent::RemoveModuleAgents($this->MODULE_ID);

        $eventManager = EventManager::getInstance();
        $seoSitemapIblockClass = '\Bitrix\Seo\SitemapIblock';
        $seoSitemapForumClass = '\Bitrix\Seo\SitemapForum';
        $eventManager->registerEventHandler('iblock', 'OnAfterIBlockSectionAdd', 'seo', $seoSitemapIblockClass, 'addSection');
        $eventManager->registerEventHandler('iblock', 'OnAfterIBlockElementAdd', 'seo', $seoSitemapIblockClass, 'addElement');

        $eventManager->registerEventHandler('iblock', 'OnBeforeIBlockSectionDelete', 'seo', $seoSitemapIblockClass, 'beforeDeleteSection');
        $eventManager->registerEventHandler('iblock', 'OnBeforeIBlockElementDelete', 'seo', $seoSitemapIblockClass, 'beforeDeleteElement');
        $eventManager->registerEventHandler('iblock', 'OnAfterIBlockSectionDelete', 'seo', $seoSitemapIblockClass, 'deleteSection');
        $eventManager->registerEventHandler('iblock', 'OnAfterIBlockElementDelete', 'seo', $seoSitemapIblockClass, 'deleteElement');

        $eventManager->registerEventHandler('iblock', 'OnBeforeIBlockSectionUpdate', 'seo', $seoSitemapIblockClass, 'beforeUpdateSection');
        $eventManager->registerEventHandler('iblock', 'OnBeforeIBlockElementUpdate', 'seo', $seoSitemapIblockClass, 'beforeUpdateElement');
        $eventManager->registerEventHandler('iblock', 'OnAfterIBlockSectionUpdate', 'seo', $seoSitemapIblockClass, 'updateSection');
        $eventManager->registerEventHandler('iblock', 'OnAfterIBlockElementUpdate', 'seo', $seoSitemapIblockClass, 'updateElement');

        $eventManager->registerEventHandler('forum', 'onAfterTopicAdd', 'seo', $seoSitemapForumClass, 'addTopic');
        $eventManager->registerEventHandler('forum', 'onAfterTopicUpdate', 'seo', $seoSitemapForumClass, 'updateTopic');
        $eventManager->registerEventHandler('forum', 'onAfterTopicDelete', 'seo', $seoSitemapForumClass, 'deleteTopic');
        return true;
    }

}
