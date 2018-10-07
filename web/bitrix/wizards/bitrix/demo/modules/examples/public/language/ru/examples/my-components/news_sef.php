<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новости");?><?$APPLICATION->IncludeComponent(
	"demo:news",
	"",
	Array(
		"SEF_MODE" => "Y",
		"IBLOCK_TYPE" => "news",
		"IBLOCK_ID" => "#IBLOCK.ID(XML_ID=content-news)#",
		"NEWS_COUNT" => "5",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"SET_TITLE" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"SEF_FOLDER" => "/examples/my-components/news/",
		"SEF_URL_TEMPLATES" => Array(
			"news" => "",
			"detail" => "#ELEMENT_ID#/"
		),
		"VARIABLE_ALIASES" => Array(
			"news" => Array(),
			"detail" => Array(),
		)
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>