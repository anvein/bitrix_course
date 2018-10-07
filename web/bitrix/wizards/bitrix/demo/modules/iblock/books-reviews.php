<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

//Library
include_once(dirname(__FILE__)."/iblock_tools.php");

//Parameters
if(!is_array($arParams)) $arParams = array();
if(strlen($arParams["site_id"]) <= 0)
	$arParams["site_id"] = "s1";

//Import XML
DEMO_IBlock_ImportXML("090_books_books-reviews_".LANGUAGE_ID.".xml", $arParams["site_id"], false, true);

CUrlRewriter::Add(array(
	"CONDITION" => "#^/e-store/books/reviews/#",
	"RULE" => "",
	"ID" => "bitrix:news",
	"PATH" => "/e-store/books/reviews/index.php"
));

?>