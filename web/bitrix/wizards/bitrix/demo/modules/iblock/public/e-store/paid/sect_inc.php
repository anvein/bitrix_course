<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="information-block"><?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"",
	Array(
		"IBLOCK_TYPE" => "paid",
		"IBLOCK_ID" => "#IBLOCK.ID(XML_ID=paid-subscribe)#",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"FILTER_NAME" => "arrFilter",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"BASKET_URL" => "/personal/cart/",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"DISPLAY_PANEL" => "N",
		"DISPLAY_COMPARE" => "N",
		"SET_TITLE" => "N",
		"PAGE_ELEMENT_COUNT" => "3",
		"LINE_ELEMENT_COUNT" => "1",
		"PROPERTY_CODE" => Array("",""),
		"PRICE_CODE" => Array("RETAIL"),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_FILTER" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000"
	)
);?></div>

<?if(IsModuleInstalled('sale')):?>
<div class="information-block"><?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line",
	"",
	Array(
		"PATH_TO_BASKET" => "/personal/cart/",
		"PATH_TO_PERSONAL" => "/personal/",
		"SHOW_PERSONAL_LINK" => "N"
	)
);?></div>
<?endif?>