<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle(GetMessage("DEMO_IBLOCK_ESTORE_AUTHORS_DETAIL_TITLE"));
?>


 <?$APPLICATION->IncludeComponent("bitrix:news.detail", ".default", array(
	"IBLOCK_TYPE" => "books",
	"IBLOCK_ID" => "#IBLOCK.ID(XML_ID=books-authors)#",
	"ELEMENT_ID" => $_REQUEST["AUTHOR"],
	"ELEMENT_CODE" => "",
	"CHECK_DATES" => "Y",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "BIRTHDATE",
		1 => "",
	),
	"IBLOCK_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_SHADOW" => "Y",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"META_KEYWORDS" => "-",
	"META_DESCRIPTION" => "-",
	"BROWSER_TITLE" => "BROWSER_TITLE",
	"DISPLAY_PANEL" => "Y",
	"SET_TITLE" => "Y",
	"SET_STATUS_404" => "Y",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "Y",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"USE_PERMISSIONS" => "N",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => GetMessage("DEMO_IBLOCK_ESTORE_AUTHORS_DETAIL_PAGER_TITLE"),
	"PAGER_TEMPLATE" => "",
	"PAGER_SHOW_ALL" => "N",
	"DISPLAY_DATE" => "N",
	"DISPLAY_NAME" => "N",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
<h3>GetMessage('DEMO_IBLOCK_ESTORE_AUTHORS_DETAIL_BOOKS')</h3>
 <?$APPLICATION->IncludeComponent("bitrix:catalog.link.list", ".default", array(
	"IBLOCK_TYPE" => "books",
	"IBLOCK_ID" => "#IBLOCK.ID(XML_ID=books-books)#",
	"LINK_PROPERTY_SID" => "AUTHORS",
	"ELEMENT_ID" => $_REQUEST["AUTHOR"],
	"ELEMENT_SORT_FIELD" => "name",
	"ELEMENT_SORT_ORDER" => "desc",
	"FILTER_NAME" => "arrFilter",
	"PAGE_ELEMENT_COUNT" => "30",
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"SECTION_URL" => "/e-store/books/#SECTION_ID#/",
	"DETAIL_URL" => "/e-store/books/#SECTION_ID#/#ELEMENT_ID#/",
	"BASKET_URL" => "/personal/cart/",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_SHADOW" => "Y",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"DISPLAY_PANEL" => "N",
	"SET_TITLE" => "N",
	"CACHE_FILTER" => "N",
	"PRICE_CODE" => array(
		0 => "BASE",
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => GetMessage("DEMO_IBLOCK_ESTORE_AUTHORS_DETAIL_BOOKS_PAGER_TITLE"),
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>