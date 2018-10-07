<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

//Library
include_once(dirname(__FILE__)."/../iblock/iblock_tools.php");
__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", "/".basename(__FILE__)));

//Parameters
if(!is_array($arParams)) $arParams = array();
if(strlen($arParams["site_id"]) <= 0)
	$arParams["site_id"] = "s1";

//Import XML
if($IBLOCK_ID = CIBlockCMLImport::GetIBlockByXML_ID("content-news"))
{
	//Create directory and copy files
	$rsElements = CIBlockElement::GetList(array(), array("IBLOCK_ID" => $IBLOCK_ID), false, array("nTopSize" => 1), array("ID"));
	$arElement = $rsElements->Fetch();
	$search = array(
		"#IBLOCK.ID(XML_ID=content-news)#",
		"#IBLOCK_ELEMENT.ID(IBLOCK_XML_ID=content-news)#",
	);
	$replace = array(
		$IBLOCK_ID,
		$arElement["ID"],
	);

	CopyDirFiles(dirname(__FILE__)."/public/language/".LANGUAGE_ID."/examples/", $_SERVER["DOCUMENT_ROOT"]."/examples", false, false);
	CopyDirFiles(dirname(__FILE__)."/public/language/".LANGUAGE_ID."/examples/custom-registration/", $_SERVER["DOCUMENT_ROOT"]."/examples/custom-registration", false, true);
	CopyDirFiles(dirname(__FILE__)."/public/language/".LANGUAGE_ID."/examples/download/", $_SERVER["DOCUMENT_ROOT"]."/examples/download", false, true);
	CopyDirFiles(dirname(__FILE__)."/public/language/".LANGUAGE_ID."/examples/menu/", $_SERVER["DOCUMENT_ROOT"]."/examples/menu", false, true);
	CopyDirFiles(dirname(__FILE__)."/public/language/".LANGUAGE_ID."/examples/rss/", $_SERVER["DOCUMENT_ROOT"]."/examples/rss", false, true);
	CopyDirFiles(dirname(__FILE__)."/public/language/".LANGUAGE_ID."/examples/sef/", $_SERVER["DOCUMENT_ROOT"]."/examples/sef", false, true);
	CopyDirFiles(dirname(__FILE__)."/public/language/".LANGUAGE_ID."/examples/feedback/", $_SERVER["DOCUMENT_ROOT"]."/examples/feedback", false, true);

	CopyDirFiles(dirname(__FILE__)."/bitrix/", $_SERVER["DOCUMENT_ROOT"]."/bitrix", false, true);
	DEMO_IBlock_CopyFiles(array(dirname(__FILE__), "/public/language/".LANGUAGE_ID."/examples/my-components/"), "/examples/my-components/", false, $search, $replace);
	CopyDirFiles(dirname(__FILE__)."/public/language/".LANGUAGE_ID."/upload/", $_SERVER["DOCUMENT_ROOT"]."/upload", false, true);

	$CONDITION = "#^/examples/my-components/news/#";
	$arResult = CUrlRewriter::GetList(array("SITE_ID" => $arParams["site_id"], "CONDITION" => $CONDITION));
	if(count($arResult) <= 0)
	{
		CUrlRewriter::Add(
			array(
				"SITE_ID" => $arParams["site_id"],
				"CONDITION" => $CONDITION,
				"ID" => "demo:news",
				"PATH" => "/examples/my-components/news_sef.php",
			)
		);
	}

	//Add menu item
	DEMO_IBlock_AddMenuItem("/.top.menu.php", Array(
		GetMessage("DEMO_EXAMPLES_MENU"),
		"/examples/",
		Array(),
		Array(),
		"",
	));
}
?>