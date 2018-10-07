<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 3600;

$arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);
if(strlen($arParams["IBLOCK_TYPE"])<=0)
	$arParams["IBLOCK_TYPE"] = "news";

$arParams["ELEMENT_ID"] = intval($arParams["ELEMENT_ID"]);

$arParams["IBLOCK_URL"]=trim($arParams["IBLOCK_URL"]);
if(strlen($arParams["IBLOCK_URL"])<=0)
	$arParams["IBLOCK_URL"] = "news.php?ID=#IBLOCK_ID#";

$arParams["ADD_SECTIONS_CHAIN"] = $arParams["ADD_SECTIONS_CHAIN"]!="N";
$arParams["SET_TITLE"]=$arParams["SET_TITLE"]!="N";
$arParams["DISPLAY_PANEL"] = $arParams["DISPLAY_PANEL"]=="Y";

if($this->StartResultCache(false, array($USER->GetGroups())))
{
	if(!CModule::IncludeModule("iblock"))
	{
		$this->AbortResultCache();
		ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
		return;
	}

	$arSelect = Array(
		"ID",
		"NAME",
		"IBLOCK_ID",
		"IBLOCK_SECTION_ID",
		"DETAIL_TEXT",
		"DETAIL_TEXT_TYPE",
		"PREVIEW_TEXT",
		"PREVIEW_TEXT_TYPE",
		"DETAIL_PICTURE",
		"ACTIVE_FROM",
		"LIST_PAGE_URL",
	);

	$arFilter = array(
		"ID" => $arParams["ELEMENT_ID"],
		"IBLOCK_LID" => SITE_ID,
		"IBLOCK_ACTIVE" => "Y",
		"ACTIVE_DATE" => "Y",
		"ACTIVE" => "Y",
		"CHECK_PERMISSIONS" => "Y",
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"SHOW_HISTORY" => "N",
	);

	$rsElement = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
	if($obElement = $rsElement->GetNextElement())
	{
		$arResult = $obElement->GetFields();

		$arResult["LIST_PAGE_URL"] = htmlspecialchars(str_replace(
			array("#SERVER_NAME#", "#SITE_DIR#", "#IBLOCK_ID#"),
			array(SITE_SERVER_NAME, SITE_DIR, $arResult["IBLOCK_ID"]),
			$arParams["IBLOCK_URL"]
		));

		if(isset($arResult["PREVIEW_PICTURE"]))
			$arResult["PREVIEW_PICTURE"] = CFile::GetFileArray($arResult["PREVIEW_PICTURE"]);
		if(isset($arResult["DETAIL_PICTURE"]))
			$arResult["DETAIL_PICTURE"] = CFile::GetFileArray($arResult["DETAIL_PICTURE"]);

		$arResult["IBLOCK"] = GetIBlock($arResult["IBLOCK_ID"], $arResult["IBLOCK_TYPE"]);

		$arResult["SECTION"] = array("PATH" => array());

		if($arParams["ADD_SECTIONS_CHAIN"] && $arResult["IBLOCK_SECTION_ID"]>0)
		{
			$rsPath = GetIBlockSectionPath($arResult["IBLOCK_ID"], $arResult["IBLOCK_SECTION_ID"]);
			while($arPath=$rsPath->GetNext())
			{
				if(strlen($arParams["SECTION_URL"]) > 0)
					$arPath["SECTION_PAGE_URL"] = htmlspecialchars(str_replace(
					array("#SERVER_NAME#", "#SITE_DIR#", "#IBLOCK_ID#", "#SECTION_ID#"),
					array(SITE_SERVER_NAME, SITE_DIR, $arPath["IBLOCK_ID"], $arPath["ID"]),
						$arParams["SECTION_URL"]
					));
				$arResult["SECTION"]["PATH"][] = $arPath;
			}
		}

		$this->IncludeComponentTemplate();
	}
	else
	{
		$this->AbortResultCache();
		ShowError(GetMessage("T_NEWS_DETAIL_NF"));
		@define("ERROR_404", "Y");
	}
}

if(isset($arResult["ID"]))
{
	if(CModule::IncludeModule("iblock"))
	{
		CIBlockElement::CounterInc($arParams["ELEMENT_ID"]);
		if($GLOBALS["APPLICATION"]->GetShowIncludeAreas())
		{
			$this->AddIncludeAreaIcons(CIBlock::ShowPanel($arResult["IBLOCK_ID"], $arResult["ID"], 0, $arParams["IBLOCK_TYPE"], true));
			if($arParams["DISPLAY_PANEL"])
				CIBlock::ShowPanel($arResult["IBLOCK_ID"], $arResult["ID"], 0, $arParams["IBLOCK_TYPE"]);
		}
	}

	if($arParams["SET_TITLE"])
		$APPLICATION->SetTitle($arResult["NAME"]);

	if($arParams["ADD_SECTIONS_CHAIN"] && is_array($arResult["SECTION"]))
	{
		foreach($arResult["SECTION"]["PATH"] as $arPath)
		{
			$APPLICATION->AddChainItem($arPath["NAME"], $arPath["SECTION_PAGE_URL"]);
		}
	}

	return $arResult["ID"];
}
else
{
	return 0;
}
?>
