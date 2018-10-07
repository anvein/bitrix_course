<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

//Communication section
include(dirname(__FILE__)."/../communication/install.php");

if(!CModule::IncludeModule('support'))
	return;

__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", "/".basename(__FILE__)));

$pathToService = str_replace("\\", "/", dirname(__FILE__));

//Left menu
DemoSiteUtil::AddMenuItem("/communication/.left.menu.php", Array(
	GetMessage("SUPP_DEMO_INSTALL_MENUITEM"),
	"/communication/support/?show_wizard=Y",
	Array("/communication/support/"),
	Array(),
	"",
));

$arCategories = Array(
	GetMessage('SUPP_DEMO_INSTALL_COMMON_QUESTION') =>
	Array(
		'NAME'		=> GetMessage('SUPP_DEMO_INSTALL_COMMON_QUESTION'),
		'arrSITE'	=> Array('s1'),
		'C_TYPE'  	=> 'C',
		'C_SORT'	=> 100,
		'EVENT1'	=> 'ticket',
	),
	GetMessage('SUPP_DEMO_INSTALL_ESTORE_QUESTION') =>
	Array(
		'NAME'		=> GetMessage('SUPP_DEMO_INSTALL_ESTORE_QUESTION'),
		'arrSITE'	=> Array('s1'),
		'C_TYPE'  	=> 'C',
		'C_SORT'	=> 100,
		'EVENT1'	=> 'ticket',
	)

);

$dbCategory = CTicketDictionary::GetList($by = "s_id", $order = "asc", Array("TYPE" => "C", "TYPE_EXACT_MATCH" => "Y"), $is_filtered);
while ($arCategory = $dbCategory->Fetch())
{
	if(array_key_exists($arCategory["NAME"], $arCategories))
		unset($arCategories[$arCategory["NAME"]]);
}

foreach ($arCategories as $arCategory)
{
	$categoryID = (int)CTicketDictionary::Add($arCategory);
}

COption::SetOptionString("support","SUPPORT_MAX_FILESIZE","10000");

$dbResult = CGroup::GetList($by, $order, Array("STRING_ID" => "REGISTERED_USERS"));
if($arGroup = $dbResult->Fetch())
	$APPLICATION->SetGroupRight("support", $arGroup["ID"], "R");

//Create support admins group if needed
$rsGroup = CGroup::GetList($by = "c_sort", $order = "asc", array(
	"STRING_ID_EXACT_MATCH" => "Y",
	"STRING_ID" => "SUPPORT_ADMINISTRATORS",
));
if($arGroup = $rsGroup->Fetch())
{
	$group_id = $arGroup["ID"];
}
else
{
	$obGroup = new CGroup;
	$group_id = $obGroup->Add(array(
		"ACTIVE" => "Y",
		"C_SORT" => 500,
		"NAME" => GetMessage("SUPP_DEMO_INSTALL_GROUP_NAME"),
		"DESCRIPTION" => GetMessage("SUPP_DEMO_INSTALL_GROUP_DESCRIPTION"),
		"STRING_ID" => "SUPPORT_ADMINISTRATORS",
	));
}
if($group_id)
	$APPLICATION->SetGroupRight("support", $group_id, "W");

//WizardServices::SetFilePermission(Array(WIZARD_SITE_ID, WIZARD_SITE_DIR), Array($groupID => 'R'));
//Public files
if(CModule::IncludeModule('iblock'))
{
	$IBLOCK_ID = include(dirname(__FILE__)."/../iblock/services-master.php");
	if($IBLOCK_ID)
	{
		DEMO_IBlock_CopyFiles(array(dirname(__FILE__), "/public/".LANGUAGE_ID."/"), "/communication/support/", false, array("#IBLOCK.ID(XML_ID=services-master)#"), array($IBLOCK_ID));
	}
}
?>