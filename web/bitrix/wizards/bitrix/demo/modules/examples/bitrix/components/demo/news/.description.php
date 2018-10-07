<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("NEWS_COMPOSITE_NAME"),
	"DESCRIPTION" => GetMessage("NEWS_COMPOSITE_DESCRIPTION"),
	"ICON" => "/images/news_all.gif",
	"COMPLEX" => "Y",
	"PATH" => array(
		"ID" => "my_components",
		"SORT" => 2000,
		"NAME" => GetMessage("MY_COMPONENTS"),
		"CHILD" => array(
			"ID" => "my_news",
			"NAME" => GetMessage("MY_NEWS"),
			"SORT" => 10,
		),
	),
);

?>