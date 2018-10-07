<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

function __cat_LoadMess($__current_file)
{
	$__current_dir = dirname($__current_file);
	$__current_file = basename($__current_file);
	
	$arMess = array();
	$dbLang = CLanguage::GetList($by = 'SORT', $order='ASC');

	while ($arLang = $dbLang->Fetch())
	{
		$arMess[$arLang['LID']] = __IncludeLang($__current_dir."/lang/".$arLang['LID'].'/'.$__current_file, true);
	}

	return $arMess;
}

function __cat_setPriceTypes($arPriceTypes)
{
	$arCurrentPriceTypes = array();
	$dbRes = CCatalogGroup::GetList();
	while ($arRes = $dbRes->Fetch())
	{
		$arCurrentPriceTypes[$arRes['NAME']] = $arRes;
	}

	$arLang = __cat_LoadMess(dirname(__FILE__).'/types.php');
	foreach ($arPriceTypes as $type_id => $arFields)
	{
		if (isset($arCurrentPriceTypes[$type_id]))
			continue;
		
		foreach ($arLang as $LANG => $arMess)
		{
			$arFields['USER_LANG'][$LANG] = $arMess['CAT_PRICE_TYPE_'.$type_id];
		}

		// errors're goin by forest
		CCatalogGroup::Add($arFields);
	}
}

function __cat_setVAT($arVAT)
{
	$arCurrentVAT = array();
	$dbRes = CCatalogVAT::GetList();
	while ($arRes = $dbRes->Fetch())
	{
		$arCurrentVAT[floatval($arRes['RATE'])] = $arRes;
	}
	
	foreach ($arVAT as $arFields)
	{
		if (isset($arCurrentVAT[floatval($arFields['RATE'])]))
			continue;
		
		// errors're goin by forest
		CCatalogVAT::Set($arFields);
	}
}
?>