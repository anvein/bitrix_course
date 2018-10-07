<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle(GetMessage("DEMO_IBLOCK_LISTS_PAGE_TITLE"));
?>

<?$APPLICATION->IncludeComponent("bitrix:lists", ".default", array(
	"IBLOCK_TYPE_ID" => "lists",
	"SEF_MODE" => "Y",
	"SEF_FOLDER" => "/personal/lists/",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"SEF_URL_TEMPLATES" => array(
		"lists" => "",
		"list" => "#list_id#/view/#section_id#/",
		"list_sections" => "#list_id#/edit/#section_id#/",
		"list_edit" => "#list_id#/edit/",
		"list_fields" => "#list_id#/fields/",
		"list_field_edit" => "#list_id#/field/#field_id#/",
	)
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>