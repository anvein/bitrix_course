<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Инструкции");
?><?$APPLICATION->IncludeComponent(
	"bitrix:sale.affiliate.instructions",
	"",
	Array(
		"REGISTER_PAGE" => "/e-store/affiliates/register.php", 
		"SHOP_NAME" => "", 
		"SHOP_URL" => "", 
		"AFF_REG_PAGE" => "/e-store/affiliates/register.php", 
		"SET_TITLE" => "Y", 
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>