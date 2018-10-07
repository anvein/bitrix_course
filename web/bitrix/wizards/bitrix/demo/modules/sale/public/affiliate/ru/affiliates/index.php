<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отчет");
?><?$APPLICATION->IncludeComponent(
	"bitrix:sale.affiliate.account",
	"",
	Array(
		"REGISTER_PAGE" => "/e-store/affiliates/register.php", 
		"SET_TITLE" => "Y", 
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>