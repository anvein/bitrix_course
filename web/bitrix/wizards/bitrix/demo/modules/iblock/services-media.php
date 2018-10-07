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
if($IBLOCK_ID = DEMO_IBlock_ImportXML("010_services_services-video_".LANGUAGE_ID.".xml", $arParams["site_id"], false, true))
{
	$obImport = new CIBlockCMLImport;
	//Create directory and copy files
	$search = array(
		"#IBLOCK.ID(XML_ID=services-video)#",
		"#IBLOCK_PROPERTY.ID(XML_ID=services-video-property-file)#",
		"#IBLOCK_PROPERTY.ID(XML_ID=services-video-property-duration)#",
		"#IBLOCK_SECTION.ID(XML_ID=examples)#",
		"#IBLOCK_ELEMENT.ID(XML_ID=intro)#",
	);
	$replace = array(
		$IBLOCK_ID,
		$obImport->GetPropertyByXML_ID($IBLOCK_ID, "services-video-property-file"),
		$obImport->GetPropertyByXML_ID($IBLOCK_ID, "services-video-property-duration"),
		$obImport->GetSectionByXML_ID($IBLOCK_ID, "examples"),
		$obImport->GetElementByXML_ID($IBLOCK_ID, "intro"),
	);
	DEMO_IBlock_CopyFiles("/public/content/media/", "/content/media/", false, $search, $replace);

	DEMO_IBlock_EditFormLayout($IBLOCK_ID, array(
		"edit1" => array(
			"TITLE" => GetMessage("DEMO_IBLOCK_CONTENT_MEDIA_TAB_TITLE"),
			"FIELDS" => array(
				"ACTIVE" => GetMessage("DEMO_IBLOCK_CONTENT_MEDIA_FIELD_ACTIVE"),
				"ACTIVE_FROM" => GetMessage("DEMO_IBLOCK_CONTENT_MEDIA_FIELD_ACTIVE_FROM"),
				"SORT" => GetMessage("DEMO_IBLOCK_CONTENT_MEDIA_FIELD_SORT"),
				"NAME" => GetMessage("DEMO_IBLOCK_CONTENT_MEDIA_FIELD_NAME"),
				"PROPERTY_".$replace[1] => GetMessage("DEMO_IBLOCK_CONTENT_MEDIA_FIELD_PROPERTY_FILE"),
				"PROPERTY_".$replace[2] => GetMessage("DEMO_IBLOCK_CONTENT_MEDIA_FIELD_PROPERTY_DURATION"),
			),
		),
		"edit2" =>  array(
			"TITLE" => GetMessage("DEMO_IBLOCK_CONTENT_MEDIA_TAB2_TITLE"),
			"FIELDS" => array(
				"SECTIONS" => GetMessage("DEMO_IBLOCK_CONTENT_MEDIA_FIELD_SECTIONS"),
			),
		),
		"edit3" =>  array(
			"TITLE" => GetMessage("DEMO_IBLOCK_CONTENT_MEDIA_TAB3_TITLE"),
			"FIELDS" => array(
				"CODE" => GetMessage("DEMO_IBLOCK_CONTENT_MEDIA_FIELD_CODE"),
				"TAGS" => GetMessage("DEMO_IBLOCK_CONTENT_MEDIA_FIELD_TAGS"),
			),
		),
	));

	//Add menu item
	DEMO_IBlock_AddMenuItem("/content/.left.menu.php", Array(
		GetMessage("DEMO_IBLOCK_CONTENT_MEDIA_MENU"),
		"/content/media/",
		Array(),
		Array(),
		"",
	));
}
?>