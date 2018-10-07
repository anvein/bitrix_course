<?
define("NEED_AUTH",true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Техническая поддержка");
?><p>Для просмотра созданных обращений в службу технической поддержки и дальнейшего обсуждения вопросов воспользуйтесь ссылкой "Мои обращения". Создание нового обращения выполняется по шагам с помощью специальной формы внизу.</p>


<p><?$APPLICATION->IncludeComponent("bitrix:support.wizard", ".default", Array(
	"IBLOCK_TYPE"	=>	"services",
	"IBLOCK_ID"	=>	"#IBLOCK.ID(XML_ID=services-master)#",
	"PROPERTY_FIELD_TYPE"	=>	"type",
	"PROPERTY_FIELD_VALUES"	=>	"values",
	"AJAX_MODE"	=>	"Y",
	"AJAX_OPTION_SHADOW"	=>	"Y",
	"AJAX_OPTION_JUMP"	=>	"N",
	"AJAX_OPTION_STYLE"	=>	"Y",
	"AJAX_OPTION_HISTORY"	=>	"N",
	"INCLUDE_IBLOCK_INTO_CHAIN"	=>	"N",
	"TICKETS_PER_PAGE"	=>	"50",
	"MESSAGES_PER_PAGE"	=>	"20",
	"SET_PAGE_TITLE"	=>	"N",
	"TEMPLATE_TYPE"	=>	"standard",
	"SHOW_RESULT"	=>	"Y",
	"SHOW_COUPON_FIELD"	=>	"N",
	"SECTIONS_TO_CATEGORIES"	=>	"N",
	"VARIABLE_ALIASES"	=>	array(
		"ID"	=>	"ID",
	)
	)
);?></p>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>