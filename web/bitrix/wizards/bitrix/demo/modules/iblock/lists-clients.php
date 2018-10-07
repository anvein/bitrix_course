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
if($IBLOCK_ID = DEMO_IBlock_ImportXML("200_lists_lists-clients_".LANGUAGE_ID.".xml", $arParams["site_id"], false, true))
{
	//Create directory and copy files
	$search = array(
		"#IBLOCK.ID(XML_ID=lists-clients_)#",
	);
	$replace = array(
		$IBLOCK_ID,
	);
	DEMO_IBlock_CopyFiles("/public/personal/lists/", "/personal/lists/");

	//Add menu item
	DEMO_IBlock_AddMenuItem("/personal/.left.menu.php", Array(
		GetMessage("DEMO_IBLOCK_LISTS_MENU"),
		"/personal/lists/",
		Array(),
		Array(),
		"",
	));

	CUrlRewriter::Add(array(
		"CONDITION" => "#^/personal/lists/#",
		"RULE" => "",
		"ID" => "bitrix:lists",
		"PATH" => "/personal/lists/index.php"
	));

	$arProperties = Array("PERSON", "PHONE");
	foreach ($arProperties as $propertyName)
	{
		${$propertyName."_PROPERTY_ID"} = 0;
		$properties = CIBlockProperty::GetList(Array(), Array("ACTIVE"=>"Y", "IBLOCK_ID" => $IBLOCK_ID, "CODE" => $propertyName));
		if ($arProperty = $properties->Fetch())
			${$propertyName."_PROPERTY_ID"} = $arProperty["ID"];
	}

	CUserOptions::SetOption(
		"form",
		"form_element_".$IBLOCK_ID,
		array(
			'tabs' => GetMessage("DEMO_IBLOCK_LISTS_CLIENT_TAB", array(
				"PROPERTY_PERSON" => "PROPERTY_".$PERSON_PROPERTY_ID,
				"PROPERTY_PHONE" => "PROPERTY_".$PHONE_PROPERTY_ID,
			)),
		),
		true
	);
}
?>