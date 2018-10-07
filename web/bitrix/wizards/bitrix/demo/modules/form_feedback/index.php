<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$currentDir = dirname(__FILE__);

include($currentDir.'/../form/lib.php');

$dataDir = $currentDir.'/data';

__IncludeLang($currentDir."/lang/".LANGUAGE_ID.'/'.basename(__FILE__));

if ($FORM_ID = __form_CreateForm('FEEDBACK', $dataDir))
{
	$search = array(
		"#FORM.ID(ID=form-feedback)#",
	);
	$replace = array(
		$FORM_ID,
	);

	//Create directory and copy files
	__form_CopyFiles($currentDir."/public/communication/", "/communication/");
	__form_CopyFiles($currentDir."/public/communication/web-forms/", "/communication/web-forms/");
	__form_CopyFiles($currentDir."/public/communication/web-forms/feedback/", "/communication/web-forms/feedback/", false, $search, $replace);
	
	$arMenuItems = array(
		array(
			'menu' => '/communication/.left.menu.php',
			'item' => array(
				GetMessage('WIZDEMO_FORM_FEEDBACK_PUBLIC_SECTION_TITLE'), 
				"/communication/web-forms/", 
				array(), 
				array(), 
				"" 
			),
		),
		array(
			'menu' => '/communication/web-forms/.left.menu.php',
			'item' => array(
				GetMessage('WIZDEMO_FORM_FEEDBACK_NAME'), 
				"/communication/web-forms/feedback/", 
				array(), 
				array(), 
				"" 
			),
		)
	);
	
	foreach ($arMenuItems as $arMenuItem)
		DemoSiteUtil::AddMenuItem($arMenuItem['menu'], $arMenuItem['item']);

	//Communication section
	include(dirname(__FILE__)."/../communication/install.php");
}
?>