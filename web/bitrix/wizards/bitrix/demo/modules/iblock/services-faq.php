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
if($IBLOCK_ID = DEMO_IBlock_ImportXML("060_services_services-faq_".LANGUAGE_ID.".xml", $arParams["site_id"], false, true))
{
	//Create directory and copy files
	$search = array(
		"#IBLOCK.ID(XML_ID=services-faq)#",
	);
	$replace = array(
		$IBLOCK_ID,
	);
	DEMO_IBlock_CopyFiles("/public/content/faq/", "/content/faq/", false, $search, $replace);

	//Add menu item
	DEMO_IBlock_AddMenuItem("/content/.left.menu.php", Array(
		GetMessage("DEMO_IBLOCK_CONTENT_FAQ_MENU"),
		"/content/faq/",
		Array(),
		Array(),
		"",
	));

	CUrlRewriter::Add(array(
		"CONDITION" => "#^/content/faq/#",
		"RULE" => "",
		"ID" => "bitrix:support.faq",
		"PATH" => "/content/faq/index.php"
	));
}
?>