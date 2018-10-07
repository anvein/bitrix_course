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

//Install themes iblock
DEMO_IBlock_ImportXML("010_services_services-themes_".LANGUAGE_ID.".xml", $arParams["site_id"], false, true);

//Import XML
if($IBLOCK_ID = DEMO_IBlock_ImportXML("020_news_content-news_".LANGUAGE_ID.".xml", $arParams["site_id"], false, true))
{
	//Set Some IBLOCK FIELDS
	CIBlock::SetFields($IBLOCK_ID, array(
		"ACTIVE_FROM" => array(
			"DEFAULT_VALUE" => "=now",
		),
		"PREVIEW_PICTURE" => array(
			"DEFAULT_VALUE" => array(
				"FROM_DETAIL" => "Y",
				"SCALE" => "Y",
				"WIDTH" => 200,
				"HEIGHT" => 200,
				"IGNORE_ERRORS" => "N",
			),
		),
		"DETAIL_PICTURE" => array(
			"DEFAULT_VALUE" => array(
				"SCALE" => "Y",
				"WIDTH" => 400,
				"HEIGHT" => 400,
				"IGNORE_ERRORS" => "N",
			),
		),
	));

	DEMO_IBlock_EditFormLayout($IBLOCK_ID, array(
		"edit1" => array(
			"TITLE" => GetMessage("DEMO_IBLOCK_CONTENT_NEWS_TAB_TITLE"),
			"FIELDS" => array(
				"ACTIVE" => GetMessage("DEMO_IBLOCK_CONTENT_NEWS_FIELD_ACTIVE"),
				"ACTIVE_FROM" => GetMessage("DEMO_IBLOCK_CONTENT_NEWS_FIELD_ACTIVE_FROM"),
				"SECTIONS" => GetMessage("DEMO_IBLOCK_CONTENT_NEWS_FIELD_SECTIONS"),
				"NAME" => GetMessage("DEMO_IBLOCK_CONTENT_NEWS_FIELD_NAME"),
				"PREVIEW_TEXT" => GetMessage("DEMO_IBLOCK_CONTENT_NEWS_FIELD_PREVIEW_TEXT"),
				"DETAIL_TEXT" => GetMessage("DEMO_IBLOCK_CONTENT_NEWS_FIELD_DETAIL_TEXT"),
				"DETAIL_PICTURE" => GetMessage("DEMO_IBLOCK_CONTENT_NEWS_FIELD_DETAIL_PICTURE"),
				"TAGS" => GetMessage("DEMO_IBLOCK_CONTENT_NEWS_FIELD_TAGS"),
				"PROPERTY_".CIBlockCMLImport::GetPropertyByXML_ID($IBLOCK_ID, "content-news-property-themes") => GetMessage("DEMO_IBLOCK_CONTENT_NEWS_FIELD_PROPERTY_THEMES"),
				"PROPERTY_".CIBlockCMLImport::GetPropertyByXML_ID($IBLOCK_ID, "content-news-property-source") => GetMessage("DEMO_IBLOCK_CONTENT_NEWS_FIELD_PROPERTY_SOURCE"),
				"edit1_csection1" => GetMessage("DEMO_IBLOCK_CONTENT_NEWS_FIELD_edit1_csection1"),
				"PROPERTY_".CIBlockCMLImport::GetPropertyByXML_ID($IBLOCK_ID, "content-news-property-keywords") => GetMessage("DEMO_IBLOCK_CONTENT_NEWS_FIELD_PROPERTY_KEYWORDS"),
				"PROPERTY_".CIBlockCMLImport::GetPropertyByXML_ID($IBLOCK_ID, "content-news-property-description") => GetMessage("DEMO_IBLOCK_CONTENT_NEWS_FIELD_PROPERTY_DESCRIPTION"),
				"PROPERTY_".CIBlockCMLImport::GetPropertyByXML_ID($IBLOCK_ID, "content-news-property-browser_title") => GetMessage("DEMO_IBLOCK_CONTENT_NEWS_FIELD_PROPERTY_BROWSER_TITLE"),
				"edit1_csection2" => GetMessage("DEMO_IBLOCK_CONTENT_NEWS_FIELD_edit1_csection2"),
				"WF_STATUS_ID" => GetMessage("DEMO_IBLOCK_CONTENT_NEWS_FIELD_WF_STATUS_ID"),
			),
		),
	));

	//Create directory and copy files
	$search = array(
		"#IBLOCK.ID(XML_ID=content-news)#",
	);
	$replace = array(
		$IBLOCK_ID,
	);
	DEMO_IBlock_CopyFiles("/public/content/news/", "/content/news/", false, $search, $replace);

	//Add menu item
	DEMO_IBlock_AddMenuItem("/content/.left.menu.php", Array(
		GetMessage("DEMO_IBLOCK_CONTENT_NEWS_MENU"),
		"/content/news/",
		Array(),
		Array(),
		"",
	));

	CUrlRewriter::Add(array(
		"CONDITION" => "#^/content/news/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/content/news/index.php"
	));
}
?>