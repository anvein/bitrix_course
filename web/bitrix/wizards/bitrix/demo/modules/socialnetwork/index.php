<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

if(!CModule::IncludeModule('socialnetwork'))
	return;
__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", "/".basename(__FILE__)));

$siteID = $arParams["site_id"];
if(strlen($arParams["site_id"]) <= 0)
	$siteID = "s1";

$dbSite = CSite::GetByID($siteID);
if($arSite = $dbSite -> Fetch())
	$LID = $arSite["LANGUAGE_ID"];
if(strlen($LID) <= 0)
	$LID = "ru";

//options
COption::SetOptionString("socialnetwork", "group_path_template", "/club/group/#group_id#/");

$installSiteID = $siteID;
$installPath = "club";
$install404 = true;
$installRewrite = true;

include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/socialnetwork/install/install_demo.php");

//top menu
DemoSiteUtil::AddMenuItem("/.top.menu.php", Array(
	GetMessage("SOCNET_TOP_MENU"),
	"/club/",
	Array(),
	Array(),
	"",
));

//component into site template
$arReplace = Array(
	"<!-- SOCIALNETWORK -->" => '<div class="socnet-informer"><? 
$APPLICATION->IncludeComponent("bitrix:socialnetwork.events_dyn", ".default", Array( 
	"PATH_TO_USER"   =>   "/club/user/#user_id#/", 
	"PATH_TO_GROUP"   =>   "/club/group/#group_id#/", 
	"PATH_TO_MESSAGE_FORM"   =>   "/club/messages/form/#user_id#/", 
	"PATH_TO_MESSAGE_FORM_MESS"   =>   "/club/messages/form/#user_id#/#message_id#/", 
	"PATH_TO_MESSAGES_CHAT"   =>   "/club/messages/chat/#user_id#/", 
	"PATH_TO_SMILE"   =>   "/bitrix/images/socialnetwork/smile/", 
	"MESSAGE_VAR"   =>   "message_id", 
	"PAGE_VAR"   =>   "page", 
	"USER_VAR"   =>   "user_id" 
   ) 
); 
?></div>',
);
CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/templates/".$templateID."/header.php", $arReplace, $skipSharp = true);

//groups to the include area for /index.php
$strIndexIncGroup = '<div class="information-block">
<div class="information-block-head">'.GetMessage('SOCNET_GROUPS').'</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:socialnetwork.group_top",
	"",
	Array(
		"GROUP_VAR" => "group_id", 
		"PATH_TO_GROUP" => "/club/group/#group_id#/", 
		"PATH_TO_GROUP_SEARCH" => "/club/group/search/", 
		"ITEMS_COUNT" => "4", 
		"DATE_TIME_FORMAT" => "d.m.Y H:i:s", 
		"DISPLAY_IMAGE" => "Y", 
		"DISPLAY_DESCRIPTION" => "N", 
		"DISPLAY_NUMBER_OF_MEMBERS" => "Y", 
		"DISPLAY_SUBJECT" => "Y", 
		"CACHE_TIME" => "180" 
	)
);?>
</div>';
CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/index_inc.php", array('<!-- SOCNETWORK_GROUPS -->' => $strIndexIncGroup), $skipSharp = true);

//welcome message
$arMessageFields = array(
	"FROM_USER_ID" => 1,
	"TO_USER_ID" => 1,
	"MESSAGE" => GetMessage("SOCNET_WELCOME_MESSAGE"),
	"=DATE_CREATE" => $GLOBALS["DB"]->CurrentTimeFunction(),
	"MESSAGE_TYPE" => SONET_MESSAGE_SYSTEM
);
CSocNetMessages::Add($arMessageFields);

//gallery, forum and blog examples
$source_base = dirname(__FILE__);
if(IsModuleInstalled('blog') && file_exists($_SERVER["DOCUMENT_ROOT"]."/communication/blog"))
{
	CopyDirFiles($source_base."/public/".$LID."/blogs", $_SERVER["DOCUMENT_ROOT"]."/club/blogs", false, true);
	DemoSiteUtil::AddMenuItem("/club/.left.menu.php", Array(
		GetMessage("SOCNET_MENU_BLOG"),
		"blogs/",
		Array(),
		Array(),
		"",
	));
}
if(IsModuleInstalled('photogallery') && file_exists($_SERVER["DOCUMENT_ROOT"]."/content/gallery") && CModule::IncludeModule("iblock"))
{
	CopyDirFiles($source_base."/public/".$LID."/gallery", $_SERVER["DOCUMENT_ROOT"]."/club/gallery", false, true);

	//replace default gallery infoblock with user gallery
	$res = CIBlock::GetList(array(), array("CODE"=>"gallery"));
	$res_arr = $res->Fetch();
	$photo_id = $res_arr["ID"];

	$res = CIBlock::GetList(array(), array("CODE"=>"car_photo_user_demo"));
	$res_arr = $res->Fetch();
	$socnet_photo_id = $res_arr["ID"];

	$photo_forum_id = 0;
	
	if (CModule::IncludeModule("forum"))
	{
		$db_res = CForumNew::GetList(
			array("SORT"=>"ASC"), 
			array("XML_ID" => "multiuser")
		);
		if ($db_res && $res = $db_res->Fetch())
			$photo_forum_id = intVal($res["ID"]);
	}

	CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/club/gallery/index.php", array(
			'IBLOCK_ID_GALLERY' => $photo_id,
			'FORUM_ID' => $photo_forum_id
		)
	);

	CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/club/index.php", array(
		'"PHOTO_USER_IBLOCK_TYPE" => "car_gallery_demo"' => '"PHOTO_USER_IBLOCK_TYPE" => "gallery"', 
		'"PHOTO_USER_IBLOCK_ID" => "'.$socnet_photo_id.'"' => '"PHOTO_USER_IBLOCK_ID" => "'.$photo_id.'"', 
		'"PHOTO_USE_COMMENTS" => "N"' => '"PHOTO_USE_COMMENTS" => "Y",
	"PHOTO_FORUM_ID" => "'.$photo_forum_id.'"'), 
		$skipSharp = true);

	DemoSiteUtil::AddMenuItem("/club/.left.menu.php", Array(
		GetMessage("SOCNET_MENU_GALLERY"),
		"gallery/",
		Array(),
		Array(),
		"",
	));
	$arFields = array(
		"CONDITION" => "#^/club/gallery/#",
		"RULE" => "",
		"ID" => "bitrix:photogallery_user",
		"PATH" => "/club/gallery/index.php"
	);
	CUrlRewriter::Add($arFields);
}
if(IsModuleInstalled('forum') && file_exists($_SERVER["DOCUMENT_ROOT"]."/communication/forum"))
{
	CopyDirFiles($source_base."/public/".$LID."/forum", $_SERVER["DOCUMENT_ROOT"]."/club/forum", false, true);
	DemoSiteUtil::AddMenuItem("/club/.left.menu.php", Array(
		GetMessage("SOCNET_MENU_FORUM"),
		"forum/",
		Array(),
		Array(),
		"",
	));
	$arFields = array(
		"CONDITION" => "#^/club/forum/#",
		"RULE" => "",
		"ID" => "bitrix:forum",
		"PATH" => "/club/forum/index.php"
	);
	CUrlRewriter::Add($arFields);
}

return true;
?>