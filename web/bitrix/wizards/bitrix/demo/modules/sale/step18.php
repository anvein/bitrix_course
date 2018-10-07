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
	
__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", "/".basename(__FILE__), $lang));

$dbLocation = CSaleLocation::GetList(Array("ID" => "ASC"), Array("LID" => $lang));
if($arLocation = $dbLocation->Fetch())//if there are no data in module
{
	$arLocationArr = Array();
	$arLocation4Delivery = Array();
	do
	{
		$arLocationArr[] = $arLocation["ID"];
	}
	while($arLocation = $dbLocation->Fetch());
	//Location group
	$groupLang = array(
				  array("LID" => "en", "NAME" => "Group 1")
				);

	if($bRus)
		$groupLang[] = array("LID" => "ru", "NAME" => GetMessage("SALE_WIZARD_GROUP"));
		
	$locationGroupID = CSaleLocationGroup::Add(
			array(
			   "SORT" => 150,
			   "LOCATION_ID" => $arLocationArr,
			   "LANG" => $groupLang
			)
		);
}
?>