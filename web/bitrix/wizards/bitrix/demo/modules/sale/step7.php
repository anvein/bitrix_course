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
	
//Locations
include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/csv_data.php");
$csvFile = new CCSVData();
$csvFile->LoadFile(dirname(__FILE__)."/data/".$lang."/loc.csv");
$csvFile->SetPos($_SESSION["LOC_POST"]);
$csvFile->SetFieldsType("R");
$csvFile->SetFirstHeader(false);
$csvFile->SetDelimiter(",");

$arLocation = Array();
$arLocationMap = Array();

	$arSysLangs = Array();
	$db_lang = CLangAdmin::GetList(($b="sort"), ($o="asc"), array("ACTIVE" => "Y"));
	while ($arLang = $db_lang->Fetch())
	{
		$arSysLangs[] = $arLang["LID"];
	}
	$i = 0;
	while ($arRes = $csvFile->Fetch())
	{
		$i++;
		if($i >=1000)
		{
			$_SESSION["LOC_POST"] = $csvFile->GetPos();
			break;
		}
		if(IntVal($CurCountryID)<=0)
		{
			$dbCountry = CSaleLocation::GetCountryList(Array("ID"=>"DESC"));
			if($arCountry = $dbCountry->Fetch())
				$CurCountryID = $arCountry["ID"];
		}
		
		$arArrayTmp = array();
		for ($ind = 1; $ind < count($arRes); $ind+=2)
		{
			if (in_array($arRes[$ind], $arSysLangs))
			{
				$arArrayTmp[$arRes[$ind]] = array(
						"LID" => $arRes[$ind],
						"NAME" => $arRes[$ind + 1]
					);

				if ($arRes[$ind] == $lang)
				{
					$arArrayTmp["NAME"] = $arRes[$ind + 1];
				}
			}
		}

		if (is_array($arArrayTmp) && strlen($arArrayTmp["NAME"])>0)
		{
			if (ToUpper($arRes[0])=="S")
			{
				$CurCountryID = CSaleLocation::AddCountry($arArrayTmp);
				$CurCountryID = IntVal($CurCountryID);
				if ($CurCountryID>0)
				{
					$LLL = CSaleLocation::AddLocation(array("COUNTRY_ID" => $CurCountryID));
				}
			}
			elseif (ToUpper($arRes[0])=="T" && $CurCountryID>0)
			{
				$city_id = 0;
				$LLL = 0;

				if ($city_id <= 0)
				{
					$city_id = CSaleLocation::AddCity($arArrayTmp);
					$city_id = IntVal($city_id);
					$arLocationMap[ToUpper($arArrayTmp["NAME"])] = $city_id;
				}
				
				if ($city_id > 0)
				{
					if (IntVal($LLL) <= 0)
					{
						$LLL = CSaleLocation::AddLocation(
							array(
								"COUNTRY_ID" => $CurCountryID,
								"CITY_ID" => $city_id
							));
						$arLocation[] = $LLL;
					}
				}
			}
		}
	}
	$_SESSION["LOC_POST"] = $csvFile->GetPos();
?>