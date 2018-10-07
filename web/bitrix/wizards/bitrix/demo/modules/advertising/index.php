<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

if(!CModule::IncludeModule('advertising'))
	return;

__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", "/".basename(__FILE__)));

$dbResult = CAdvContract::GetByID(1);
if (!$dbResult->Fetch())
	return;

//Types
$arTypes = Array(
	Array(
		"SID" => "LEFT",
		"ACTIVE" => "Y",
		"SORT" => 1,
		"NAME" => GetMessage("DEMO_ADV_LEFT_TYPE"),
		"DESCRIPTION" => ""
	),
	Array(
		"SID" => "BOTTOM",
		"ACTIVE" => "Y",
		"SORT" => 1,
		"NAME" => GetMessage("DEMO_ADV_BOTTOM_TYPE"),
		"DESCRIPTION" => ""
	),
);

foreach ($arTypes as $arFields)
{
	$dbResult = CAdvType::GetByID($arTypes["SID"], $CHECK_RIGHTS="N");
	if ($dbResult && $dbResult->Fetch())
		continue;

	CAdvType::Set($arFields, "", $CHECK_RIGHTS="N");
}

//Matrix
$arWeekday = Array(
	"SUNDAY" => Array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23),
	"MONDAY" => Array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23),
	"TUESDAY" => Array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23),
	"WEDNESDAY" => Array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23),
	"THURSDAY" => Array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23),
	"FRIDAY" => Array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23),
	"SATURDAY" => Array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23)
);

$pathToBanner = str_replace("\\", "/", dirname(__FILE__));
$pathToBanner = $pathToBanner."/banners/".LANGUAGE_ID;

$arBanners = Array(
	Array(
		"CONTRACT_ID" => 1,
		"TYPE_SID" => "LEFT",
		"STATUS_SID"		=> "PUBLISHED",
		"NAME" => GetMessage("DEMO_ADV_100_100_NAME"),
		"ACTIVE" => "Y",
		"arrSITE" => Array("s1"),
		"WEIGHT"=> 100,
		"FIX_SHOW" => "Y",
		"FIX_CLICK" => "Y",
		"AD_TYPE" => "image",
		"arrIMAGE_ID" => Array(
			"name" => "100x100.gif",
			"type" => "image/gif",
			"tmp_name" => $pathToBanner."/100x100.gif",
			"error" => "0",
			"size" => @filesize($pathToBanner."/100x100.gif"),
			"MODULE_ID" => "advertising"
		),
		"IMAGE_ALT" => GetMessage("DEMO_ADV_100_100_NAME"),
		"URL" => GetMessage("DEMO_ADV_BANNER_URL"),
		"URL_TARGET" => "_blank",
		"STAT_EVENT_1" => "banner",
		"STAT_EVENT_2" => "click",
		"arrWEEKDAY" => $arWeekday,
		"COMMENTS" => "100x100.gif",
	),

	Array(
		"CONTRACT_ID" => 1,
		"TYPE_SID" => "BOTTOM",
		"STATUS_SID"		=> "PUBLISHED",
		"NAME" => GetMessage("DEMO_ADV_468_1_NAME"),
		"ACTIVE" => "Y",
		"FIX_SHOW" => "Y",
		"FIX_CLICK" => "Y",
		"arrSITE" => Array("s1"),
		"WEIGHT"=> 100,
		"AD_TYPE" => "image",
		"arrIMAGE_ID" => Array(
			"name" => "banner468_1.gif",
			"type" => "image/gif",
			"tmp_name" => $pathToBanner."/banner468_1.gif",
			"error" => "0",
			"size" => @filesize($pathToBanner."/banner468_1.gif"),
			"MODULE_ID" => "advertising"
		),
		"IMAGE_ALT" => GetMessage("DEMO_ADV_468_1_NAME"),
		"URL" => GetMessage("DEMO_ADV_BANNER_URL"),
		"URL_TARGET" => "_blank",
		"STAT_EVENT_1" => "banner",
		"STAT_EVENT_2" => "click",
		"arrWEEKDAY" => $arWeekday,
		"COMMENTS" => "banner468_1.gif",
	),


	Array(
		"CONTRACT_ID" => 1,
		"TYPE_SID" => "BOTTOM",
		"STATUS_SID"		=> "PUBLISHED",
		"NAME" => GetMessage("DEMO_ADV_468_2_NAME"),
		"ACTIVE" => "Y",
		"FIX_SHOW" => "Y",
		"FIX_CLICK" => "Y",
		"arrSITE" => Array("s1"),
		"WEIGHT"=> 100,
		"AD_TYPE" => "image",
		"arrIMAGE_ID" => Array(
			"name" => "banner468_2.gif",
			"type" => "image/gif",
			"tmp_name" => $pathToBanner."/banner468_2.gif",
			"error" => "0",
			"size" => @filesize($pathToBanner."/banner468_2.gif"),
			"MODULE_ID" => "advertising"
		),
		"IMAGE_ALT" => GetMessage("DEMO_ADV_468_2_NAME"),
		"URL" => GetMessage("DEMO_ADV_BANNER_URL"),
		"URL_TARGET" => "_blank",
		"STAT_EVENT_1" => "banner",
		"STAT_EVENT_2" => "click",
		"arrWEEKDAY" => $arWeekday,
		"COMMENTS" => "banner468_2.gif",
	),


	Array(
		"CONTRACT_ID" => 1,
		"TYPE_SID" => "BOTTOM",
		"STATUS_SID"		=> "PUBLISHED",
		"NAME" => GetMessage("DEMO_ADV_468_3_NAME"),
		"ACTIVE" => "Y",
		"FIX_SHOW" => "Y",
		"FIX_CLICK" => "Y",
		"arrSITE" => Array("s1"),
		"WEIGHT"=> 100,
		"AD_TYPE" => "image",
		"arrIMAGE_ID" => Array(
			"name" => "banner468_3.gif",
			"type" => "image/gif",
			"tmp_name" => $pathToBanner."/banner468_3.gif",
			"error" => "0",
			"size" => @filesize($pathToBanner."/banner468_3.gif"),
			"MODULE_ID" => "advertising"
		),
		"IMAGE_ALT" => GetMessage("DEMO_ADV_468_3_NAME"),
		"URL" => GetMessage("DEMO_ADV_BANNER_URL"),
		"URL_TARGET" => "_blank",
		"STAT_EVENT_1" => "banner",
		"STAT_EVENT_2" => "click",
		"arrWEEKDAY" => $arWeekday,
		"COMMENTS" => "banner468_3.gif",
	),

);

foreach ($arBanners as $arFields)
{
	$dbResult = CAdvBanner::GetList($by, $order, Array("COMMENTS" => $arFields["COMMENTS"], "COMMENTS_EXACT_MATCH" => "Y"), $is_filtered, "N");
	if ($dbResult && $dbResult->Fetch())
		continue;

	CAdvBanner::Set($arFields, "", $CHECK_RIGHTS="N");
}


$leftBanner = "";
$bottomBanner = "";

if ($templateID == "books")
{
	$leftBanner = '
	<div class="content-block">
		<div class="content-block-head">'.GetMessage("DEMO_ADV_TEMPLATE_TITLE").'</div>
		<div class="content-block-body" align="center"><'.'?'.'$'.'APPLICATION->IncludeComponent(
			"bitrix:advertising.banner",
			".default",
			Array(
				"TYPE" => "LEFT", 
				"CACHE_TYPE" => "A", 
				"CACHE_TIME" => "0" 
			)
			);?>
	</div>';
}
elseif ($templateID == "xml_catalog")
{
	$leftBanner = '
		<div class="content-block"><div class="content-block-head-corner"><div class="content-block-head">'.GetMessage("DEMO_ADV_TEMPLATE_TITLE").'</div></div>
		<div class="content-block-body" align="center">
			<'.'?'.'$'.'APPLICATION->IncludeComponent(
					"bitrix:advertising.banner",
					".default", Array("TYPE" => "LEFT", "CACHE_TYPE" => "A", "CACHE_TIME" => "0" ));?>
		</div></div>
	';
}

if (in_array($templateID, Array("books", "xml_catalog", "web20")))
	$bottomBanner = '<div id="bottom_banner"><'.'?'.'$'.'APPLICATION->IncludeComponent("bitrix:advertising.banner",".default",Array("TYPE" => "BOTTOM"));?></div>';

if ($leftBanner != "" || $bottomBanner != "")
{
	$arReplace = Array(
		"<!--BANNER_LEFT-->" => $leftBanner,
		"<!--BANNER_BOTTOM-->" => $bottomBanner,
	);

	CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/templates/".$templateID."/header.php", $arReplace, $skipSharp = true);
	CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/templates/".$templateID."/footer.php", $arReplace, $skipSharp = true);
}
?>