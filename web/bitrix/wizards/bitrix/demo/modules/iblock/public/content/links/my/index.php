<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle(GetMessage("DEMO_IBLOCK_CONTENT_LINKS_MY_TITLE"));
?><?$APPLICATION->IncludeComponent("bitrix:iblock.element.add", ".default", Array(
	"IBLOCK_TYPE"	=>	"services",
	"IBLOCK_ID"	=>	"#IBLOCK.ID(XML_ID=services-links)#",
	"NAV_ON_PAGE"	=>	"10",
	"USE_CAPTCHA"	=>	"N",
	"USER_MESSAGE_ADD"	=>	GetMessage("DEMO_IBLOCK_CONTENT_LINKS_MY_USER_MESSAGE_ADD"),
	"USER_MESSAGE_EDIT"	=>	GetMessage("DEMO_IBLOCK_CONTENT_LINKS_MY_USER_MESSAGE_EDIT"),
	"PROPERTY_CODES"	=>	array(
		0	=>	"NAME",
		1	=>	"IBLOCK_SECTION",
		2	=>	"PREVIEW_TEXT",
		3	=>	"DETAIL_TEXT",
		4	=>	"#IBLOCK_PROPERTY.ID(XML_ID=services-links-property-email)#",
		5	=>	"#IBLOCK_PROPERTY.ID(XML_ID=services-links-property-url)#",
	),
	"PROPERTY_CODES_REQUIRED"	=>	array(
		0	=>	"NAME",
		1	=>	"IBLOCK_SECTION",
		2	=>	"PREVIEW_TEXT",
		3	=>	"DETAIL_TEXT",
		4	=>	"#IBLOCK_PROPERTY.ID(XML_ID=services-links-property-email)#",
		5	=>	"#IBLOCK_PROPERTY.ID(XML_ID=services-links-property-url)#",
	),
	"GROUPS"	=>	array(
		0	=>	"2",
	),
	"STATUS"	=>	"ANY",
	"STATUS_NEW"	=>	"NEW",
	"ELEMENT_ASSOC"	=>	"PROPERTY_ID",
	"ELEMENT_ASSOC_PROPERTY"	=>	"#IBLOCK_PROPERTY.ID(XML_ID=services-links-property-user_id)#",
	"ALLOW_EDIT"	=>	"Y",
	"ALLOW_DELETE"	=>	"N",
	"MAX_USER_ENTRIES"	=>	"10",
	"MAX_LEVELS"	=>	"2",
	"LEVEL_LAST"	=>	"Y",
	"MAX_FILE_SIZE"	=>	"0",
	"SEF_MODE"	=>	"N",
	"CUSTOM_TITLE_NAME"	=>	GetMessage("DEMO_IBLOCK_CONTENT_LINKS_MY_CUSTOM_TITLE_NAME"),
	"CUSTOM_TITLE_IBLOCK_SECTION"	=>	GetMessage("DEMO_IBLOCK_CONTENT_LINKS_MY_CUSTOM_TITLE_IBLOCK_SECTION"),
	"CUSTOM_TITLE_PREVIEW_TEXT"	=>	GetMessage("DEMO_IBLOCK_CONTENT_LINKS_MY_CUSTOM_TITLE_PREVIEW_TEXT"),
	"CUSTOM_TITLE_DETAIL_TEXT"	=>	GetMessage("DEMO_IBLOCK_CONTENT_LINKS_MY_CUSTOM_TITLE_DETAIL_TEXT")
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>