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
	if($bRus)
	{
		CSaleDeliveryHandler::Set("cpcr", 
			Array(
				"LID" => "",
				"ACTIVE" => "Y",
				"HID" => "cpcr",
				"NAME" => GetMessage("SALE_WIZARD_SPSR"),
				"SORT" => 150,
				"DESCRIPTION" => GetMessage("SALE_WIZARD_SPSR_DESCR"),
				"HANDLERS" => "/bitrix/modules/sale/delivery/delivery_cpcr.php",
				"SETTINGS" => "8",
				"PROFILES" => "",
				"TAX_RATE" => 0,
			)
		);

		CSaleDeliveryHandler::Set("russianpost", 
			Array(
				"LID" => "",
				"ACTIVE" => "Y",
				"HID" => "russianpost",
				"NAME" => GetMessage("SALE_WIZARD_MAIL"),
				"SORT" => 200,
				"DESCRIPTION" => GetMessage("SALE_WIZARD_MAIL_DESCR"),
				"HANDLERS" => "/bitrix/modules/sale/delivery/delivery_russianpost.php",
				"SETTINGS" => "23",
				"PROFILES" => "",
				"TAX_RATE" => 0,
			)
		);
	}

	CSaleDeliveryHandler::Set("ups", 
		Array(
			"LID" => "",
			"ACTIVE" => "Y",
			"HID" => "ups",
			"NAME" => "UPS",
			"SORT" => 200,
			"DESCRIPTION" => GetMessage("SALE_WIZARD_UPS"),
			"HANDLERS" => "/bitrix/modules/sale/delivery/delivery_ups.php",
			"SETTINGS" => "/bitrix/modules/sale/delivery/ups/ru_csv_zones.csv;/bitrix/modules/sale/delivery/ups/ru_csv_export.csv",
			"PROFILES" => "",
			"TAX_RATE" => 0,
		)
	);
}
?>