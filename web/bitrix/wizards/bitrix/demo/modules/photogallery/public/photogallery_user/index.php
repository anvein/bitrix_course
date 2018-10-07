<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle(GetMessage("P_GALLERY"));
?><?$APPLICATION->IncludeComponent(
	"bitrix:photogallery_user",
	"",
	Array(
		"USE_LIGHT_VIEW" => "Y",
		"IBLOCK_TYPE" => "gallery", 
		"IBLOCK_ID" => "#IBLOCK_ID#", 
		
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/content/gallery/",
		"SEF_URL_TEMPLATES" => array(
			"index" => "index.php",
			"galleries" => "galleries/#USER_ID#/",
			"gallery" => "#USER_ALIAS#/",
			"gallery_edit" => "#USER_ALIAS#/action/#ACTION#/",
			"section" => "#USER_ALIAS#/#SECTION_ID#/",
			"section_edit" => "#USER_ALIAS#/#SECTION_ID#/action/#ACTION#/",
			"section_edit_icon" => "#USER_ALIAS#/#SECTION_ID#/icon/action/#ACTION#/",
			"upload" => "#USER_ALIAS#/#SECTION_ID#/action/upload/",
			"detail" => "#USER_ALIAS#/#SECTION_ID#/#ELEMENT_ID#/",
			"detail_edit" => "#USER_ALIAS#/#SECTION_ID#/#ELEMENT_ID#/action/#ACTION#/",
			"detail_slide_show" => "#USER_ALIAS#/#SECTION_ID#/#ELEMENT_ID#/slide_show/",
			"detail_list" => "list/",
			"search" => "search/",
			"tags" => "tags/",
		), 
		
		"GALLERY_GROUPS" => Array("11"), 
		"MODERATION" => "Y",
		
		"ANALIZE_SOCNET_PERMISSION" => "N",
		"GALLERY_AVATAR_SIZE" => "70",
		
		"WATERMARK_RULES" => "USER",
		"PATH_TO_FONT" => "",
		
		"ONLY_ONE_GALLERY" => "Y", 
		"SECTION_SORT_BY" => "UF_DATE",
		"SECTION_SORT_ORD" => "ASC", 
		"ELEMENT_SORT_FIELD" => "id", 
		"ELEMENT_SORT_ORDER" => "desc", 
		
		"SECTION_PAGE_ELEMENTS" => "25", 
		"ELEMENTS_PAGE_ELEMENTS" => "50", 
		"PAGE_NAVIGATION_TEMPLATE" => "", 
		"ELEMENTS_USE_DESC_PAGE" => "Y", 
		
		"DATE_TIME_FORMAT_SECTION" => "d.m.Y", 
		"DATE_TIME_FORMAT_DETAIL" => "d.m.Y", 
		
		"ALBUM_PHOTO_THUMBS_SIZE" => "100",
		"ALBUM_PHOTO_SIZE" => "100", 
		"THUMBNAIL_SIZE" => "90", 
		"JPEG_QUALITY1" => "95",
		"ORIGINAL_SIZE" => "1280",
		"JPEG_QUALITY" => "95",
		"UPLOADER_TYPE" => "form",
		"WATERMARK_MIN_PICTURE_SIZE" => "501", 
		"ADDITIONAL_SIGHTS" => Array(), 
		
		"USE_RATING" => "Y", 
		"MAX_VOTE" => "5", 
		"VOTE_NAMES" => array(
			0 => "1",
			1 => "2",
			2 => "3",
			3 => "4",
			4 => "5"
		),
		"DISPLAY_AS_RATING" => "rating",
		
		"SHOW_TAGS" => "Y", 
		"TAGS_PAGE_ELEMENTS" => "50", 
		"TAGS_PERIOD" => "", 
		"TAGS_INHERIT" => "Y", 
		"TAGS_FONT_MAX" => "30", 
		"TAGS_FONT_MIN" => "14", 
		"TAGS_COLOR_NEW" => "486DAA", 
		"TAGS_COLOR_OLD" => "486DAA", 
		"TAGS_SHOW_CHAIN" => "Y", 
		
		"USE_COMMENTS" => "#USE_COMMENTS#", 
		"COMMENTS_TYPE" => "#COMMENTS_TYPE#", 
		"FORUM_ID" => "#FORUM_ID#",
		"BLOG_URL" => "#BLOG_URL#",
		"PATH_TO_SMILE" => "#PATH_TO_SMILE#",
		
		"MODERATE" => "N", 
		"SHOW_ONLY_PUBLIC" => "Y", 
		"WATERMARK" => "Y",
		"USE_WATERMARK" => "Y",
		"TEMPLATE_LIST" => ".default", 
		"CELL_COUNT" => "0", 
		"SLIDER_COUNT_CELL" => "3", 
		
		"INDEX_PAGE_TOP_ELEMENTS_COUNT" => "10",
		"INDEX_PAGE_TOP_ELEMENTS_PERCENT" => "70",
		
		"DISPLAY_PANEL" => "N", 
		"SET_TITLE" => "Y", 
		"CACHE_TYPE" => "A", 
		"CACHE_TIME" => "3600", 
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>