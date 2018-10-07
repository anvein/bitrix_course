<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arLangMess = __form_LoadMess(__FILE__);

$arForm = array(
	'NAME' => GetMessage('WIZDEMO_FORM_ANKETA_NAME'),
	'SID' => 'ANKETA',
	'C_SORT' => 100,
	'BUTTON' => GetMessage('WIZDEMO_FORM_ANKETA_BUTTON'),
	'DESCRIPTION' => '',
	'DESCRIPTION_TYPE' => 'text',
	
	'USE_CAPTCHA' => 'Y',
	'USE_RESTRICTIONS' => 'N',
	
	'STAT_EVENT1' => 'form',
	'STAT_EVENT2' => 'anketa',
	'STAT_EVENT4' => '',
	
	'arSITE' => array('s1'),
	'arMENU' => array(),
);

foreach ($arLangMess as $key => $arMess)
{
	$arForm['arMENU'][$key] = $arMess['WIZDEMO_FORM_ANKETA_MENU'];
}

$tpl = __form_LoadTemplate('form', dirname(__FILE__).'/'.LANGUAGE_ID);
if (false !== $tpl)
{
	$arForm['FORM_TEMPLATE'] = $tpl;
	$arForm['USE_DEFAULT_TEMPLATE'] = 'N';
}
else
{
	$arForm['FORM_TEMPLATE'] = '';
	$arForm['USE_DEFAULT_TEMPLATE'] = 'Y';
}
?>