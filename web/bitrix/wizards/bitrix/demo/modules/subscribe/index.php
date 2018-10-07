<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
if(!CModule::IncludeModule('subscribe'))
	return;

//Library
include_once(dirname(__FILE__)."/../iblock/iblock_tools.php");
__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", "/".basename(__FILE__)));

//Input parameters:
//public_rewrite - when set to Y will force public files overwite
if(strlen($arParams["site_id"]) <= 0)
	$arParams["site_id"] = "s1";

//Set options which will overwrite defaults
COption::SetOptionString("subscribe", "subscribe_section", "#SITE_DIR#personal/subscribe/");
COption::SetOptionString("subscribe", "posting_use_editor", "Y");
COption::SetOptionString("subscribe", "attach_images", "Y");

//Copy template
CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/subscribe/install/php_interface", $_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/php_interface", false, true);

$fname = $_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/php_interface/subscribe/templates/news/template.php";
if(file_exists($fname) && is_file($fname) && ($fh = fopen($fname, "rb")))
{
	$php_source = fread($fh, filesize($fname));
	$php_source = preg_replace("#([\"'])(SITE_ID)(\\1)(\\s*=>\s*)([\"'])(.*?)(\\5)#", "\\1\\2\\3\\4\\5".$arParams["site_id"]."\\7", $php_source);
	fclose($fh);
	$fh = fopen($fname, "wb");
	if($fh)
	{
		fwrite($fh, $php_source);
		fclose($fh);
	}
}

$rsRubric = CRubric::GetList(array(), array("NAME" => GetMessage("DEMO_SUBSCR_RIBRIC1_NAME")));
if(!$rsRubric->Fetch())
{
	//Database actions
	$arFields = Array(
		"ACTIVE"	=> "Y",
		"NAME"		=> GetMessage("DEMO_SUBSCR_RIBRIC1_NAME"),
		"SORT"		=> 100,
		"DESCRIPTION"	=> GetMessage("DEMO_SUBSCR_RIBRIC1_DESCRIPTION"),
		"LID"		=> $arParams["site_id"],
		"AUTO"		=> "Y",
		"DAYS_OF_MONTH"	=> "",
		"DAYS_OF_WEEK"	=> "7",  //Sunday
		"TIMES_OF_DAY"	=> "05:00",
		"TEMPLATE"	=> substr(BX_PERSONAL_ROOT, 1)."/php_interface/subscribe/templates/news",
		"VISIBLE"	=> "Y",
		"FROM_FIELD"	=> COption::GetOptionString("main", "email_from", "info@ourtestsite.com"),
		"LAST_EXECUTED"	=> ConvertTimeStamp(false, "FULL"), // now
	);
	$obRubric = new CRubric;
	$ID = $obRubric->Add($arFields);
	if($ID)
	{
	}
}

$rsRubric = CRubric::GetList(array(), array("NAME" => GetMessage("DEMO_SUBSCR_RIBRIC2_NAME")));
if(!$rsRubric->Fetch())
{
	$arFields = Array(
		"ACTIVE"	=> "Y",
		"NAME"		=> GetMessage("DEMO_SUBSCR_RIBRIC2_NAME"),
		"SORT"		=> 200,
		"DESCRIPTION"	=> GetMessage("DEMO_SUBSCR_RIBRIC2_DESCRIPTION"),
		"LID"		=> $arParams["site_id"],
		"AUTO"		=> "N",
	);
	$obRubric = new CRubric;
	$ID = $obRubric->Add($arFields);
	if($ID)
	{
		$arFields = Array(
			"FROM_FIELD"	=> COption::GetOptionString("main", "email_from", "info@ourtestsite.com"),
			"TO_FIELD"	=> COption::GetOptionString("main", "email_from", "info@ourtestsite.com"),
			"EMAIL_FILTER"	=> "%%",
			"SUBJECT"	=> GetMessage("DEMO_SUBSCR_RIBRIC2_NAME"),
			"BODY_TYPE"	=> "html",
			"BODY"		=> GetMessage("DEMO_SUBSCR_RIBRIC2_POSTING1_BODY"),
			"DIRECT_SEND"	=> "Y",
			"CHARSET"	=> LANG_CHARSET,
			"SUBSCR_FORMAT"	=> "text",
			"RUB_ID"	=> array($ID),
			"STATUS"	=> "D", //Draft
		);
		$obPosting = new CPosting();
		$obPosting->Add($arFields);

		$arFields = Array(
			"FROM_FIELD"	=> COption::GetOptionString("main", "email_from", "info@ourtestsite.com"),
			"TO_FIELD"	=> COption::GetOptionString("main", "email_from", "info@ourtestsite.com"),
			"EMAIL_FILTER"	=> "%%",
			"SUBJECT"	=> GetMessage("DEMO_SUBSCR_RIBRIC2_NAME"),
			"BODY_TYPE"	=> "text",
			"BODY"		=> GetMessage("DEMO_SUBSCR_RIBRIC2_POSTING2_BODY"),
			"DIRECT_SEND"	=> "Y",
			"CHARSET"	=> LANG_CHARSET,
			"SUBSCR_FORMAT"	=> "text",
			"RUB_ID"	=> array($ID),
			"STATUS"	=> "D", //Draft
		);
		$obPosting = new CPosting();
		$obPosting->Add($arFields);
	}
}

//Copy public files with "on the fly" translation
$search = false;
$replace = false;
DEMO_IBlock_CopyFiles(array(dirname(__FILE__), "/public/personal/subscribe/"), "/personal/subscribe/", false, $search, $replace);

//Add menu item
DEMO_IBlock_AddMenuItem("/personal/.left.menu.php", Array(
	GetMessage("DEMO_SUBSCR_MENU"),
	"/personal/subscribe/",
	Array(),
	Array(),
	"",
));


$replace = "";
if ($templateID == "books")
{
	$replace = '
<div class="content-block">
	<div class="content-block-head">'.GetMessage("DEMO_SUBSCR_TEMPLATE_TITLE").'</div>
		<div class="content-block-body"><'.'?'.'$'.'APPLICATION->IncludeComponent(
			"bitrix:subscribe.form",
			".default",
			Array(
				"PAGE" => "#SITE_DIR#personal/subscribe/subscr_edit.php",
				"SHOW_HIDDEN" => "N",
				"USE_PERSONALIZATION"	=>	"N",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "3600"
			)
			);?>
	</div>
</div>';

}
elseif ($templateID == "xml_catalog")
{
	$replace = '
	<div class="content-block">
		<div class="content-block-head-corner"><div class="content-block-head">'.GetMessage("DEMO_SUBSCR_TEMPLATE_TITLE").'</div></div>
		<div class="content-block-body">
			<'.'?'.'$'.'APPLICATION->IncludeComponent(
				"bitrix:subscribe.form",
				".default",
				Array(
					"PAGE" => "#SITE_DIR#personal/subscribe/subscr_edit.php",
					"SHOW_HIDDEN" => "N",
					"USE_PERSONALIZATION"	=> "N",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "3600"
				)
			);?>
		</div>
	</div>
	';
}

if ($replace != "")
{
	CWizardUtil::ReplaceMacros(
		$_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/templates/".$templateID."/header.php",
		Array("<!--SUBSCRIBE-->" => $replace),
		$skipSharp = true
	);
}

?>