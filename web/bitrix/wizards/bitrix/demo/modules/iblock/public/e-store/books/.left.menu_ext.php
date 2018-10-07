<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksExt=$APPLICATION->IncludeComponent("bitrix:menu.sections", "", array(
	"IS_SEF" => "Y",
	"SEF_BASE_URL" => "/e-store/books/",
	"SECTION_PAGE_URL" => "#SECTION_ID#/",
	"DETAIL_PAGE_URL" => "#SECTION_ID#/#ELEMENT_ID#",
	"IBLOCK_TYPE" => "books",
	"IBLOCK_ID" => "#IBLOCK.ID(XML_ID=books-books)#",
	"DEPTH_LEVEL" => "1",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600"
	),
	false
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>