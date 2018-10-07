<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", "/".basename(__FILE__)));

$pathToService = str_replace("\\", "/", dirname(__FILE__));

//Public files
CopyDirFiles(
	$pathToService."/public/".LANGUAGE_ID, 
	$_SERVER["DOCUMENT_ROOT"]."/communication/",
	$rewrite = false,
	$recursive = true
);

//Top menu
DemoSiteUtil::AddMenuItem("/.top.menu.php", Array(
	GetMessage("COMMUNICATION_MENU_NAME"),
	"/communication/",
	Array(),
	Array(),
	"",
));

?>