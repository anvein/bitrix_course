<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

if (!CModule::IncludeModule('learning'))
	return;

__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", "/".basename(__FILE__)));


$dbResult = CCourse::GetList(Array(), Array("CODE" => "BX-ADM001"));
$pathToService = str_replace("\\", "/", dirname(__FILE__));

if (!$arCourse = $dbResult->Fetch())
{
	$pathToCourse = $serviceRelativePath."/".LANGUAGE_ID."/course/";
	$package = new CCourseImport($pathToCourse, Array("s1"));

	if (strlen($package->LAST_ERROR) > 0)
		return;

	$success = $package->ImportPackage();

	if ($success)
	{
		$dbResult = CCourse::GetList(Array(), Array("CODE" => "BX-ADM001"));
		$arCourse = $dbResult->Fetch();
	}

}

if (isset($arCourse["ID"]))
	CCourse::SetPermission($arCourse["ID"], Array("2"=>"R"));

//Public files
CopyDirFiles(
	$pathToService."/".LANGUAGE_ID."/public", 
	$_SERVER["DOCUMENT_ROOT"]."/communication/learning",
	$rewrite = false,
	$recursive = true
);

//Left menu
DemoSiteUtil::AddMenuItem("/communication/.left.menu.php", Array(
	GetMessage("SERVICE_LEARNING"),
	"/communication/learning/",
	Array(),
	Array(),
	"",
));

//Template
CopyDirFiles(
	$pathToService."/".LANGUAGE_ID."/template", 
	$_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/templates/learning",
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

$arTemplates[]= Array("CONDITION" => "CSite::InDir('/communication/learning/course/')", "SORT" => 150, "TEMPLATE" => "learning");

$obSite = new CSite();
$obSite->Update("s1", Array("TEMPLATE" => $arTemplates, "NAME" => $arSite["NAME"]));

//Communication section
include(dirname(__FILE__)."/../communication/install.php");
?>