<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("MY_NEWS_LINE_NAME"),
	"DESCRIPTION" => GetMessage("MY_NEWS_LINE_DESC"),
	"ICON" => "/images/news_line.gif",
	"SORT" => 10,
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "my_components",
		"SORT" => 2000,
		"NAME" => GetMessage("MY_COMPONENTS"),
		"CHILD" => array(
			"ID" => "my_news",
			"NAME" => GetMessage("MY_NEWS"),
			"SORT" => 10,
		)
	),
);

?>