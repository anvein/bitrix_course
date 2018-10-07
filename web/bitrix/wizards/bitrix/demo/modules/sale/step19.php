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

	CSaleDelivery::Add(
		Array(
			"NAME" => GetMessage("SALE_WIZARD_MAIL_A"),
			"LID" => $siteID,
			"PERIOD_FROM" => 9,
			"PERIOD_TO" => 15,
			"PERIOD_TYPE" => "D",
			"WEIGHT_FROM" => 0,
			"WEIGHT_TO" => 4999,
			"ORDER_PRICE_FROM" => 0,
			"ORDER_PRICE_TO" => 0,
			"ORDER_CURRENCY" => ($bRus ? "RUB" : "USD"),
			"ACTIVE" => "N",
			"PRICE" => "75",
			"CURRENCY" => ($bRus ? "RUB" : "USD"),
			"SORT" => 100,
			"DESCRIPTION" => GetMessage("SALE_WIZARD_MAIL_A_DESC"),
		   "LOCATIONS" => $arLocation4Delivery,
		)
	);
}
?>