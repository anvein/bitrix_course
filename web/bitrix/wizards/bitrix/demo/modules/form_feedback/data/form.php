<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arLangMess = __form_LoadMess(__FILE__);

$arForm = array(
	'NAME' => GetMessage('WIZDEMO_FORM_FEEDBACK_NAME'),
	'SID' => 'FEEDBACK',
	'C_SORT' => 200,
	'BUTTON' => GetMessage('WIZDEMO_FORM_FEEDBACK_BUTTON'),
	'DESCRIPTION' => GetMessage('WIZDEMO_FORM_FEEDBACK_DESCRIPTION'),
	'DESCRIPTION_TYPE' => 'text',
	
	'USE_CAPTCHA' => 'Y',
	'USE_RESTRICTIONS' => 'N',
	
	'STAT_EVENT1' => 'form',
	'STAT_EVENT2' => 'feedback',
	'STAT_EVENT4' => '',
	
	'arSITE' => array('s1'),
	'arMENU' => array(),
);

foreach ($arLangMess as $key => $arMess)
{
	$arForm['arMENU'][$key] = $arMess['WIZDEMO_FORM_FEEDBACK_MENU'];
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