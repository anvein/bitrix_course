<?php

use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\ModuleManager;
use \Bitrix\Main\Application;
use CAgent;
use DateTime;

Loc::loadMessages(__FILE__);

class anvein_geotarget extends CModule
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
        $this->MODULE_ID = 'anvein.geotarget';
        $this->MODULE_NAME = Loc::getMessage('anvein_geotarget_name');
        $this->MODULE_DESCRIPTION = Loc::getMessage('anvein_geotarget_description');

        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];

        $this->PARTNER_NAME = Loc::getMessage('anvein_geotarget_partner_name');
        $this->PARTNER_URI = '/';
    }

    /**
     * Точка входа при установке
     * @return bool
     */
    public function DoInstall()
    {
        if (!IsModuleInstalled($this->MODULE_ID)) {
            ModuleManager::registerModule($this->MODULE_ID);
            $this->InstallFiles();

            return true;
        }
    }

    /**
     * Точка входа при удалении
     * @return bool
     */
    public function DoUninstall()
    {
        if (IsModuleInstalled($this->MODULE_ID)) {
            $this->UnInstallFiles();
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
        return true;
    }

    /**
     * Удаление событий модуля
     * @return bool
     */
    public function UnInstallEvents()
    {
        CAgent::RemoveModuleAgents($this->MODULE_ID);
        return true;
    }

}
