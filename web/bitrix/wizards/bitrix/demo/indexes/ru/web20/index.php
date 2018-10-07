<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Демонстрационная версия продукта «1С-Битрикс: Управление сайтом»");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("#TITLE#");
?>

<!-- #ARTICLES# -->
<!-- #NEWS# -->

<h2>Видео-новости</h2>

<?$APPLICATION->IncludeComponent(
	"bitrix:player",
	"",
	Array(
		"PLAYER_TYPE" => "auto", 
		"USE_PLAYLIST" => "N", 
		"PATH" => "/upload/intro.flv", 
		"WIDTH" => "400", 
		"HEIGHT" => "324", 
		"FULLSCREEN" => "Y", 
		"SKIN_PATH" => "/bitrix/components/bitrix/player/mediaplayer/skins", 
		"SKIN" => "bitrix.swf", 
		"CONTROLBAR" => "bottom", 
		"WMODE" => "transparent", 
		"HIDE_MENU" => "N", 
		"SHOW_CONTROLS" => "Y", 
		"SHOW_STOP" => "N", 
		"SHOW_DIGITS" => "Y", 
		"CONTROLS_BGCOLOR" => "FFFFFF", 
		"CONTROLS_COLOR" => "000000", 
		"CONTROLS_OVER_COLOR" => "000000", 
		"SCREEN_COLOR" => "000000", 
		"WMODE_WMV" => "window", 
		"AUTOSTART" => "N", 
		"REPEAT" => "N", 
		"VOLUME" => "90", 
		"DISPLAY_CLICK" => "play", 
		"MUTE" => "N", 
		"HIGH_QUALITY" => "Y", 
		"ADVANCED_MODE_SETTINGS" => "N", 
		"BUFFER_LENGTH" => "10", 
		"DOWNLOAD_LINK_TARGET" => "_self" 
	),
false
);?>

<!-- #NEW_PHOTO# -->

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>