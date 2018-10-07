<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle(GetMessage("DEMO_IBLOCK_CONTENT_MEDIA_TITLE"));
?>
<h2>GetMessage('DEMO_IBLOCK_CONTENT_MEDIA_VIDEO')</h2>
<?$APPLICATION->IncludeComponent("bitrix:iblock.tv", ".default", array(
	"IBLOCK_TYPE" => "services",
	"IBLOCK_ID" => "#IBLOCK.ID(XML_ID=services-video)#",
	"PATH_TO_FILE" => "#IBLOCK_PROPERTY.ID(XML_ID=services-video-property-file)#",
	"DURATION" => "#IBLOCK_PROPERTY.ID(XML_ID=services-video-property-duration)#",
	"SECTION_ID" => "#IBLOCK_SECTION.ID(XML_ID=examples)#",
	"ELEMENT_ID" => "#IBLOCK_ELEMENT.ID(XML_ID=intro)#",
	"WIDTH" => "400",
	"HEIGHT" => "300",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600"
	),
	false
);?>
<br />

<h2>GetMessage('DEMO_IBLOCK_CONTENT_MEDIA_AUDIO')</h2>
<?$APPLICATION->IncludeComponent("bitrix:player", ".default", array(
	"PATH" => "/bitrix/sounds/main/bitrix_tune_mobile.mp3",
	"WIDTH" => "400",
	"HEIGHT" => "24",
	"AUTOSTART" => "N",
	"REPEAT" => "N",
	"VOLUME" => "90",
	"ADVANCED_MODE_SETTINGS" => "N",
	"PLAYER_TYPE" => "auto",
	"USE_PLAYLIST" => "N",
	"PREVIEW" => "",
	"DISPLAY_CLICK" => "play",
	"MUTE" => "N",
	"HIGH_QUALITY" => "Y",
	"BUFFER_LENGTH" => "10",
	"DOWNLOAD_LINK" => "",
	"DOWNLOAD_LINK_TARGET" => "_self",
	"LOGO" => "",
	"FULLSCREEN" => "Y",
	"SKIN_PATH" => "/bitrix/components/bitrix/player/mediaplayer/skins",
	"SKIN" => "bitrix.swf",
	"CONTROLBAR" => "bottom",
	"WMODE" => "transparent",
	"HIDE_MENU" => "N"
	),
	false
);?>
<br />

<br />
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>