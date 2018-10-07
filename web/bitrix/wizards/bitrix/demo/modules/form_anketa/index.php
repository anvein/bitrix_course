<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$currentDir = dirname(__FILE__);

include($currentDir.'/../form/lib.php');

$dataDir = $currentDir.'/data';

__IncludeLang($currentDir."/lang/".LANGUAGE_ID.'/'.basename(__FILE__));

if ($FORM_ID = __form_CreateForm('ANKETA', $dataDir))
{
	$search = array(
		"#FORM.ID(ID=form-anketa)#",
	);
	$replace = array(
		$FORM_ID,
	);

	//Create directory and copy files
	__form_CopyFiles($currentDir."/public/communication/", "/communication/", false);
	__form_CopyFiles($currentDir."/public/communication/web-forms/", "/communication/web-forms/", false);
	__form_CopyFiles($currentDir."/public/communication/web-forms/anketa/", "/communication/web-forms/anketa/", false, $search, $replace);

	$arMenuItems = array(
		array(
			'menu' => '/communication/.left.menu.php',
			'item' => array(
				GetMessage('WIZDEMO_FORM_ANKETA_PUBLIC_SECTION_TITLE'), 
				"/communication/web-forms/", 
				array(), 
				array(), 
				"" 
			),
		),
		array(
			'menu' => '/communication/web-forms/.left.menu.php',
			'item' => array(
				GetMessage('WIZDEMO_FORM_ANKETA_NAME'), 
				"/communication/web-forms/anketa/", 
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