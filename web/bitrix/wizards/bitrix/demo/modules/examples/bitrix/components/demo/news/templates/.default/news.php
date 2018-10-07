<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$APPLICATION->IncludeComponent("demo:news.line", "", Array(
	"IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
	"IBLOCK_ID"	=>	$arParams["IBLOCK_ID"],
	"NEWS_COUNT"	=>	$arParams["NEWS_COUNT"],
	"SORT_BY1"	=>	$arParams["SORT_BY1"],
	"SORT_ORDER1"	=>	$arParams["SORT_ORDER1"],
	"SORT_BY2"	=>	$arParams["SORT_BY2"],
	"SORT_ORDER2"	=>	$arParams["SORT_ORDER2"],
	"DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
	"CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
	"CACHE_TIME"	=>	$arParams["CACHE_TIME"],
	),
	$component
);?>
