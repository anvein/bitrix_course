<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

if (CModule::IncludeModule('catalog'))
{
	include_once(dirname(__FILE__)."/lib.php");

	__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", "/".basename(__FILE__)));

	$defaultGroup = COption::GetOptionString("main", "new_user_registration_def_group", "2");
	$defaultGroup = explode(",", $defaultGroup);

	$arPriceTypes = array(
		'BASE' => array(
			'NAME' => 'BASE',
			'BASE' => 'Y',
			'SORT' => 100,
			'USER_GROUP' => array(1),
			'USER_GROUP_BUY' => array(1),
			'USER_LANG' => array(),
		),
		'WHOLESALE' => array(
			'NAME' => 'WHOLESALE',
			'BASE' => 'N',
			'SORT' => 200,
			'USER_GROUP' => $defaultGroup,
			'USER_GROUP_BUY' => $defaultGroup,
			'USER_LANG' => array(),
		),
		'RETAIL' => array(
			'NAME' => 'RETAIL',
			'BASE' => 'N',
			'SORT' => 300,
			'USER_GROUP' => array(2),
			'USER_GROUP_BUY' => array(2),
			'USER_LANG' => array(),
		),
	);

	$arVAT = array(
		array(
			'ACTIVE' => 'Y',
			'RATE' => 0,
			'NAME' => GetMessage('CAT_VAT_NOVAT'),
			'C_SORT' => 100,
		),
		array(
			'ACTIVE' => 'Y',
			'RATE' => 18,
			'NAME' => GetMessage('CAT_VAT_VAT18'),
			'C_SORT' => 200,
		),
	);

	__cat_setPriceTypes($arPriceTypes);
	__cat_setVAT($arVAT);
}
?>