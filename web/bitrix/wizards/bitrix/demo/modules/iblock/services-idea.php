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
if($IBLOCK_ID = DEMO_IBlock_ImportXML("300_services_services_idea_".LANGUAGE_ID.".xml", $arParams["site_id"], false, false))
{
	//Create directory and copy files
	$search = array(
		"#IBLOCK.ID(XML_ID=services-idea)#",
	);
	$replace = array(
		$IBLOCK_ID,
	);
	DEMO_IBlock_CopyFiles("/public/content/idea/", "/content/idea/", false, $search, $replace);

	//Add menu item
	DEMO_IBlock_AddMenuItem("/content/.left.menu.php", Array(
		GetMessage("DEMO_IBLOCK_CONTENT_IDEA_MENU"),
		"/content/idea/",
		Array(),
		Array(),
		"",
	));
}
?>