<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
?><?$APPLICATION->IncludeComponent("bitrix:sale.order.ajax", ".default", array(
	"PAY_FROM_ACCOUNT" => "Y",
	"COUNT_DELIVERY_TAX" => "Y",
	"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
	"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
	"ALLOW_AUTO_REGISTER" => "N",
	"SEND_NEW_USER_NOTIFY" => "Y",
	"PATH_TO_BASKET" => "/personal/cart/",
	"PATH_TO_PERSONAL" => "/personal/order/",
	"PATH_TO_PAYMENT" => "/personal/order/payment/",
	"SET_TITLE" => "Y",
	"DELIVERY_NO_SESSION" => "Y"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>