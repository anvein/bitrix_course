<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $DBType;
require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/classes/".strtolower($DBType)."/favorites.php");

__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", "/".basename(__FILE__)));

//Change site name
$obSite = new CSite();
$obSite->Update("s1", Array("NAME" => COption::GetOptionString("main", "site_name", GetMessage("DEFAULT_SITE_NAME"))));

//Edit profile task
$editProfileTask = false;
$dbResult = CTask::GetList(Array(), Array("NAME" => "main_change_profile"));
if ($arTask = $dbResult->Fetch())
	$editProfileTask = $arTask["ID"];

//admin security policy
$z = CGroup::GetByID(1);
if($res = $z->Fetch())
{
	if($res["SECURITY_POLICY"] == "")
	{
		$group = new CGroup;
		$arGroupPolicy = array(
			"SESSION_TIMEOUT" => 15, //minutes
			"SESSION_IP_MASK" => "255.255.255.255",
			"MAX_STORE_NUM" => 1,
			"STORE_IP_MASK" => "255.255.255.255",
			"STORE_TIMEOUT" => 60*24*3, //minutes
			"CHECKWORD_TIMEOUT" => 60,  //minutes
			"PASSWORD_LENGTH" => 10,
			"PASSWORD_UPPERCASE" => "Y",
			"PASSWORD_LOWERCASE" => "Y",
			"PASSWORD_DIGITS" => "Y",
			"PASSWORD_PUNCTUATION" => "Y",
			"LOGIN_ATTEMPTS" => 3,
		);
		$arFields = array(
			"SECURITY_POLICY" => serialize($arGroupPolicy)
		);
		$group->Update(1, $arFields);
	}
}

//Registered users group
$dbResult = CGroup::GetList($by, $order, Array("STRING_ID" => "REGISTERED_USERS"));
if ($dbResult->Fetch())
	return;

$group = new CGroup;
$arFields = Array(
	"ACTIVE" => "Y",
	"C_SORT" => 3,
	"NAME" => GetMessage("REGISTERED_GROUP_NAME"),
	"STRING_ID" => "REGISTERED_USERS",
);

$groupID = $group->Add($arFields);
if ($groupID > 0)
{
	COption::SetOptionString("main", "new_user_registration_def_group", $groupID);
	if ($editProfileTask)
		CGroup::SetTasks($groupID, Array($editProfileTask), true);
}

//Control panel users
$dbResult = CGroup::GetList($by, $order, Array("STRING_ID" => "CONTROL_PANEL_USERS"));
$arGroup = $dbResult->Fetch();
if (!$arGroup)
{
	$group = new CGroup;
	$arFields = Array(
		"ACTIVE" => "Y",
		"C_SORT" => 4,
		"NAME" => GetMessage("CONTROL_PANEL_GROUP_NAME"),
		"STRING_ID" => "CONTROL_PANEL_USERS",
	);

	$groupID = $group->Add($arFields);
	if ($groupID > 0)
	{
		DemoSiteUtil::SetFilePermission(Array("s1", "/bitrix/admin"), Array($groupID => "R"));
		if ($editProfileTask)
			CGroup::SetTasks($groupID, Array($editProfileTask), true);
	}
}
else
{
	$groupID = $arGroup["ID"];
}


if($groupID > 0 && !strlen(COption::GetOptionString("main", "show_panel_for_users", "")))
	COption::SetOptionString("main", "show_panel_for_users", serialize(array("G".$groupID)));

//Options
$server_name = ($_SERVER["HTTP_HOST"] <> ''? $_SERVER["HTTP_HOST"]:$_SERVER["SERVER_NAME"]);
if($_SERVER["SERVER_PORT"] <> 80 && $_SERVER["SERVER_PORT"] <> 443 && $_SERVER["SERVER_PORT"] > 0 && strpos($_SERVER["HTTP_HOST"], ":") === false)
	$server_name .= ":".$_SERVER["SERVER_PORT"];

COption::SetOptionString("main", "server_name", $server_name);
COption::SetOptionString("main", "upload_dir", "upload");
COption::SetOptionString("main", "component_cache_on","Y");

COption::SetOptionString("main", "save_original_file_name", "Y");
COption::SetOptionString("main", "captcha_registration", "Y");
COption::SetOptionString("main", "use_secure_password_cookies", "Y");
COption::SetOptionString("main", "new_user_registration", "Y");
COption::SetOptionString("main", "auth_comp2", "Y");
COption::SetOptionString("main", "update_autocheck", "7");

COption::SetOptionString("main", "map_top_menu_type", "top");
COption::SetOptionString("main", "map_left_menu_type", "left");

COption::SetOptionString("main", "event_log_logout", "Y");
COption::SetOptionString("main", "event_log_login_success", "Y");
COption::SetOptionString("main", "event_log_login_fail", "Y");
COption::SetOptionString("main", "event_log_register", "Y");
COption::SetOptionString("main", "event_log_register_fail", "Y");
COption::SetOptionString("main", "event_log_password_request", "Y");
COption::SetOptionString("main", "event_log_password_change", "Y");
COption::SetOptionString("main", "event_log_user_delete", "Y");

COption::SetOptionString("main", 'CAPTCHA_presets', '2');
COption::SetOptionString("main", 'CAPTCHA_transparentTextPercent', '0');
COption::SetOptionString("main", 'CAPTCHA_arBGColor_1', 'FFFFFF');
COption::SetOptionString("main", 'CAPTCHA_arBGColor_2', 'FFFFFF');
COption::SetOptionString("main", 'CAPTCHA_numEllipses', '0');
COption::SetOptionString("main", 'CAPTCHA_numLines', '0');
COption::SetOptionString("main", 'CAPTCHA_textStartX', '40');
COption::SetOptionString("main", 'CAPTCHA_textFontSize', '26');
COption::SetOptionString("main", 'CAPTCHA_arTextColor_1', '000000');
COption::SetOptionString("main", 'CAPTCHA_arTextColor_2', '000000');
COption::SetOptionString("main", 'CAPTCHA_textAngel_1', '-15');
COption::SetOptionString("main", 'CAPTCHA_textAngel_2', '15');
COption::SetOptionString("main", 'CAPTCHA_textDistance_1', '-2');
COption::SetOptionString("main", 'CAPTCHA_textDistance_2', '-2');
COption::SetOptionString("main", 'CAPTCHA_bWaveTransformation', 'N');
COption::SetOptionString("main", 'CAPTCHA_arBorderColor', '000000');
COption::SetOptionString("main", 'CAPTCHA_arTTFFiles', 'bitrix_captcha.ttf');

SetMenuTypes(Array("left" => GetMessage("LEFT_MENU_NAME"), "top" => GetMessage("TOP_MENU_NAME")),"s1");
SetMenuTypes(Array("left" => GetMessage("LEFT_MENU_NAME"), "top" => GetMessage("TOP_MENU_NAME")),"");

COption::SetOptionString("fileman", "default_edit", "html");
COption::SetOptionString("fileman", "propstypes", serialize(array("description"=>GetMessage("MAIN_OPT_DESCRIPTION"), "keywords"=>GetMessage("MAIN_OPT_KEYWORDS"), "title"=>GetMessage("MAIN_OPT_TITLE"), "keywords_inner"=>GetMessage("MAIN_OPT_KEYWORDS_INNER"))));

if(LANGUAGE_ID!='ru' && COption::GetOptionString('seo', 'counters', '') == '')
	COption::SetOptionString('seo', 'counters', '<a href="http://www.webdew.ro/utils.php"><img src="http://www.webdew.ro/pagerank/free-pagerank-display.php?a=getCode&amp;s=goo" title="Free PageRank Display Code" border="0px" alt="PageRank" /></a>');

//user options
DemoSiteUtil::SetUserOption("global", "settings", array(
	"start_menu_preload"=>"Y",
	"start_menu_title" => "N",
), $common = true);

//Gadgets
CUserOptions::SetOption('intranet', '~gadgets_holder1', unserialize(GetMessage("MAIN_SETTINGS_GADGETS")), true);

//Print template
$pathToService = str_replace("\\", "/", dirname(__FILE__));
CopyDirFiles(
	$wizardPath."/misc/print_template/".LANGUAGE_ID,
	$_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/templates/print",
	$rewrite = true,
	$recursive = true
);
$obSite = CSite::GetByID("s1");
if (!$arSite = $obSite->Fetch())
	return;

$arTemplates = Array();
$obTemplate = CSite::GetTemplateList("s1");
while($arTemplate = $obTemplate->Fetch())
	$arTemplates[]= $arTemplate;

$arTemplates[]= Array("CONDITION" => "\$_GET['print']=='Y'", "SORT" => 150, "TEMPLATE" => "print");

$obSite = new CSite();
$obSite->Update("s1", Array("TEMPLATE" => $arTemplates, "NAME" => COption::GetOptionString("main", "site_name", $arSite["NAME"])));

//socialservices
$bRu = (LANGUAGE_ID == 'ru');
$arServices = array(
	"VKontakte" => "N",
	"MyMailRu" => "N",
	"Twitter" => "N",
	"Facebook" => "N",
	"Livejournal" => "Y",
	"YandexOpenID" => ($bRu? "Y":"N"),
	"Rambler" => ($bRu? "Y":"N"),
	"MailRuOpenID" => ($bRu? "Y":"N"),
	"Liveinternet" => ($bRu? "Y":"N"),
	"Blogger" => "Y",
	"OpenID" => "Y",
	"LiveID" => "N",
);
COption::SetOptionString("socialservices", "auth_services", serialize($arServices));

?>