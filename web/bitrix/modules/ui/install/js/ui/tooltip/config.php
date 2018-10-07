<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

return (
	(\Bitrix\Main\Config\Option::get("socialnetwork", "allow_tooltip", "Y") == "Y")
		? array(
			"js" => "/bitrix/js/ui/tooltip/tooltip.js",
			"css" => "/bitrix/js/ui/tooltip/tooltip.css"
		)
		: array()
);