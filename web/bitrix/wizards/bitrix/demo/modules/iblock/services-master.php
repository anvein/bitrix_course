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
if($IBLOCK_ID = DEMO_IBlock_ImportXML("010_services_services-master_".LANGUAGE_ID.".xml", $arParams["site_id"], false, true))
{

	$replace = array(
		$IBLOCK_ID,
		CIBlockCMLImport::GetPropertyByXML_ID($IBLOCK_ID, "services-master-property-type"),
		CIBlockCMLImport::GetPropertyByXML_ID($IBLOCK_ID, "services-master-property-values"),
	);

	DEMO_IBlock_EditFormLayout($IBLOCK_ID, array(
		"edit1" => array(
			"TITLE" => GetMessage("DEMO_IBLOCK_MASTER_TAB_TITLE"),
			"FIELDS" => array(
				"ACTIVE" => GetMessage("DEMO_IBLOCK_MASTER_FIELD_ACTIVE"),
				"NAME" => GetMessage("DEMO_IBLOCK_MASTER_FIELD_NAME"),
				"SORT" => GetMessage("DEMO_IBLOCK_MASTER_FIELD_SORT"),
				"IBLOCK_ELEMENT_PROP_VALUE" => GetMessage("DEMO_IBLOCK_MASTER_FIELD_IBLOCK_ELEMENT_PROP_VALUE"),
				"PROPERTY_".$replace[1] => GetMessage("DEMO_IBLOCK_MASTER_FIELD_PROPERTY_TYPE"),
				"PROPERTY_".$replace[2] => GetMessage("DEMO_IBLOCK_MASTER_FIELD_PROPERTY_VALUES"),
				"PREVIEW_TEXT" => GetMessage("DEMO_IBLOCK_MASTER_FIELD_PREVIEW_TEXT"),
			),
		),
		"edit6" =>  array(
			"TITLE" => GetMessage("DEMO_IBLOCK_MASTER_TAB2_TITLE"),
			"FIELDS" => array(
				"DETAIL_TEXT" => GetMessage("DEMO_IBLOCK_MASTER_FIELD_DETAIL_TEXT"),
			),
		),
		"edit2" =>  array(
			"TITLE" => GetMessage("DEMO_IBLOCK_MASTER_TAB3_TITLE"),
			"FIELDS" => array(
				"SECTIONS" => GetMessage("DEMO_IBLOCK_MASTER_FIELD_SECTIONS"),
			),
		),
	));
}
return $IBLOCK_ID;
?>