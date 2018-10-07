<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

//Library
include_once(dirname(__FILE__)."/../iblock/iblock_tools.php");
__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", "/".basename(__FILE__)));

CopyDirFiles(dirname(__FILE__)."/public/language/".LANGUAGE_ID."/content/", $_SERVER["DOCUMENT_ROOT"]."/content", false, false);

DEMO_IBlock_AddMenuItem("/.top.menu.php", Array(
	GetMessage("DEMO_CONTENT_MENU"),
	"/content/",
	Array(),
	Array(),
	"",
));
?>