<?
define("B_PROLOG_INCLUDED", true);
define("WIZARD_DEFAULT_SITE_ID", "#SITE_ID#");
define("WIZARD_DEFAULT_TONLY", true);
define("PRE_LANGUAGE_ID", "ru");
define("PRE_INSTALL_CHARSET", "#SITE_ENCODING#");
include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/install/wizard/wizard.php");
?>