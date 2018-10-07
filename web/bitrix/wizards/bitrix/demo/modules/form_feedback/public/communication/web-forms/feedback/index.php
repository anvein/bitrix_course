<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle(GetMessage("WIZDEMO_FORM_FEEDBACK_NAME"));
?><?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new",
	"",
	Array(
		"WEB_FORM_ID" => "#FORM.ID(ID=form-feedback)#", 
		"LIST_URL" => "", 
		"EDIT_URL" => "", 
		"CHAIN_ITEM_TEXT" => "", 
		"CHAIN_ITEM_LINK" => "", 
		"SET_TITLE" => "Y", 
		"CACHE_TIME" => "3600" 
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>