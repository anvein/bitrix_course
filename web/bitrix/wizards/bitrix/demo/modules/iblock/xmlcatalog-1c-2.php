<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

if(LANGUAGE_ID !== "ru")
	return;

//Library
include_once(dirname(__FILE__)."/iblock_tools.php");

//Parameters
if(!is_array($arParams)) $arParams = array();
if(strlen($arParams["site_id"]) <= 0)
	$arParams["site_id"] = "s1";

//Import XML
if($_SESSION["DEMO_IBLOCK_1C_CATALOG"] === false)
	DEMO_IBlock_ImportXML("102_xmlcatalog_FUTURE-1C-CATALOG_ru.xml", $arParams["site_id"], true);
?>