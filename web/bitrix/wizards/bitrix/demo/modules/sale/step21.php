<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

if(!CModule::IncludeModule('sale'))
	return;

$siteID = $arParams["site_id"];
if(strlen($arParams["site_id"]) <= 0)
	$siteID = "s1";
$dbSite = CSite::GetByID($siteID);
if($arSite = $dbSite -> Fetch())
	$lang = $arSite["LANGUAGE_ID"];
if(strlen($lang) <= 0)
	$lang = "ru";
$bRus = false;
if($lang == "ru")
	$bRus = true;
	
__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", "/step8.php", $lang));

$dbLocation = CSaleLocation::GetList(Array("ID" => "ASC"), Array("LID" => $lang));
if($arLocation = $dbLocation->Fetch())//if there are no data in module
{
	$arLocation4Delivery = Array();
	do
	{
		$arLocation4Delivery[] = Array("LOCATION_ID" => $arLocation["ID"], "LOCATION_TYPE"=>"L");
	}
	while($arLocation = $dbLocation->Fetch());
	//Location group
	$dblocationGroupID = CSaleLocationGroup::GetList(Array("ID" => "DESC"));
	if($arLocationGroupID = $dblocationGroupID->Fetch())
		$locationGroupID = $arLocationGroupID["ID"];
		
	$arLocation4Delivery[] = Array("LOCATION_ID" => $locationGroupID, "LOCATION_TYPE"=>"G");
		
	//delivery handler
	CSaleDeliveryHandler::Set("simple", 
		Array(
			"LID" => "",
			"ACTIVE" => "Y",
			"HID" => "simple",
			"NAME" => GetMessage("SALE_WIZARD_COUR1"),
			"SORT" => 100,
			"DESCRIPTION" => "",
			"HANDLERS" => "/bitrix/modules/sale/delivery/delivery_simple.php",
			"SETTINGS" => "",
			"PROFILES" => "",
			"TAX_RATE" => 0,
			"CONFIG" => Array("price_".$locationGroupID => "100"),
		)
	);
	//Tax
	$taxID = CSaleTax::Add(Array(
				"LID" => $siteID,
				"NAME" => GetMessage("SALE_WIZARD_VAT"),
				"CODE" => "NDS",
			)
		);

	$dbPerson = CSalePersonType::GetList(Array("SORT" => "DESC"));
	if($arPerson = $dbPerson->Fetch())
	{
		//Tax rate
		CSaleTaxRate::Add(
		  Array(
			"TAX_ID" => $taxID,
			"PERSON_TYPE_ID" => $arPerson["ID"],
			"VALUE" => 18,
			"CURRENCY" => ($bRus ? "RUB" : "USD"),
			"IS_PERCENT" => "Y",
			"IS_IN_PRICE" => "Y",
			"APPLY_ORDER" => 100,
			"ACTIVE" => "Y",
			"TAX_LOCATION" => $arLocation4Delivery,
		  )
		);
	}
}
?>