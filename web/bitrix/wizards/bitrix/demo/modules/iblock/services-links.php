<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

//Library
include_once(dirname(__FILE__)."/iblock_tools.php");
__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", "/".basename(__FILE__)));

//Parameters
if(!is_array($arParams)) $arParams = array();
if(strlen($arParams["site_id"]) <= 0)
	$arParams["site_id"] = "s1";

//Import XML
if($IBLOCK_ID = DEMO_IBlock_ImportXML("040_services_services-links_".LANGUAGE_ID.".xml", $arParams["site_id"], false, true))
{
	//Create directory and copy files
	$search = array(
		"#IBLOCK.ID(XML_ID=services-links)#",
		"#IBLOCK_PROPERTY.ID(XML_ID=services-links-property-url)#",
		"#IBLOCK_PROPERTY.ID(XML_ID=services-links-property-email)#",
		"#IBLOCK_PROPERTY.ID(XML_ID=services-links-property-user_id)#",
	);
	$replace = array(
		$IBLOCK_ID,
		CIBlockCMLImport::GetPropertyByXML_ID($IBLOCK_ID, "services-links-property-url"),
		CIBlockCMLImport::GetPropertyByXML_ID($IBLOCK_ID, "services-links-property-email"),
		CIBlockCMLImport::GetPropertyByXML_ID($IBLOCK_ID, "services-links-property-user_id"),
	);
	DEMO_IBlock_CopyFiles("/public/content/links/", "/content/links/", false, $search, $replace);
	DEMO_IBlock_CopyFiles("/public/content/links/my/", "/content/links/my/", false, $search, $replace);

	//Add menu item
	DEMO_IBlock_AddMenuItem("/content/.left.menu.php", Array(
		GetMessage("DEMO_IBLOCK_CONTENT_LINKS_MENU"),
		"/content/links/",
		Array(),
		Array(),
		"",
	));
}
?>