<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

if(LANGUAGE_ID !== "ru")
	return;

//Library
include_once(dirname(__FILE__)."/iblock_tools.php");
__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", "/".basename(__FILE__)));

//Parameters
if(!is_array($arParams)) $arParams = array();
if(strlen($arParams["site_id"]) <= 0)
	$arParams["site_id"] = "s1";

$search = array(
	"#IBLOCK.ID(XML_ID=FUTURE-1C-CATALOG)#",
);
$replace = array(
	CIBlockCMLImport::GetIBlockByXML_ID("FUTURE-1C-CATALOG"),
);

//Create directory and copy files
DEMO_IBlock_CopyFiles("/public/e-store/xml_catalog/", "/e-store/xml_catalog/", false, $search, $replace);
CopyDirFiles(dirname(__FILE__)."/public/language/".LANGUAGE_ID."/e-store/xml_catalog/", $_SERVER["DOCUMENT_ROOT"]."/e-store/xml_catalog", false, true);

//Add menu item
DEMO_IBlock_AddMenuItem("/e-store/.left.menu.php", Array(
	GetMessage("DEMO_IBLOCK_ESTORE_XMLCAT_MENU"),
	"/e-store/xml_catalog/",
	Array(),
	Array(),
	"",
));

if(IsModuleInstalled('catalog'))
{
	//Create group and add it to importers
	$XMLCATALOG_GROUP_ID = DEMO_IBlock_AddUserGroup("1c_integration", GetMessage("DEMO_IBLOCK_XMLCATALOG_GROUP_NAME"), GetMessage("DEMO_IBLOCK_XMLCATALOG_GROUP_DESC"));

	//Tune 1C exchange
	if($XMLCATALOG_GROUP_ID)
	{
		DemoSiteUtil::SetFilePermission(Array($arParams["site_id"], "/bitrix/admin"), Array($XMLCATALOG_GROUP_ID => "R"));
		COption::SetOptionString("catalog", "1C_GROUP_PERMISSIONS", $XMLCATALOG_GROUP_ID);
		COption::SetOptionString("catalog", "1C_SITE_LIST", $arParams["site_id"]);
	}
}
?>