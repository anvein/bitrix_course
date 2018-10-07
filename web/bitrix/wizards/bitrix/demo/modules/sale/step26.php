<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
  require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
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

$dbLocation = CSaleLocation::GetList(Array("ID" => "ASC"), Array("LID" => $lang));
if($arLocation = $dbLocation->Fetch())//if there are no data in module
{
	do
	{
		$arLocationMap[ToUpper($arLocation["CITY_NAME"])] = $arLocation["ID"];
	}
	while($arLocation = $dbLocation->Fetch());
	
	$DB->StartTransaction();
    include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/csv_data.php");
	$csvFile = new CCSVData();
	$csvFile->LoadFile(dirname(__FILE__)."/data/".$lang."/zip.csv");
	$csvFile->SetPos(IntVal($_SESSION["ZIP_POST"]));
	$csvFile->SetFieldsType("R");
	$csvFile->SetFirstHeader(false);
	$csvFile->SetDelimiter(";");
	while ($arRes = $csvFile->Fetch())
	{
		$CITY = ToUpper($arRes[1]);
		
		if (array_key_exists($CITY, $arLocationMap))
		{
			$ID = $arLocationMap[$CITY];
			CSaleLocation::AddLocationZIP($ID, $arRes[2]);
		}
	}

	$DB->Commit();	
}
?>