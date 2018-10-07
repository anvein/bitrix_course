<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arServices = Array(

	"main" => Array(
		"NAME" => GetMessage("SERVICE_MAIN_BASE"),
		"STAGES" => Array("files.php", "rating.php", "settings.php"),
		"INSTALL_ONLY" => "Y",
	),

	"search" => Array(
		"NAME" => GetMessage("SERVICE_SEARCH"),
		"INSTALL_ONLY" => "Y",
	),

	"statistic" => Array(
		"NAME" => GetMessage("SERVICE_STATISTICS"),
		"INSTALL_ONLY" => "Y",
	),

	"catalog" => Array(
		"NAME" => GetMessage("SERVICE_CATALOG"),
		"INSTALL_ONLY" => "Y",
	),

	"articles" => Array(
		"NAME" => GetMessage("SERVICE_ARTICLES"),
		"MODULE_ID" => "iblock",
		"ICON" => "images/services/content.gif",
	),

	"news" => Array(
		"NAME" => GetMessage("SERVICE_NEWS"),
		"MODULE_ID" => "iblock",
		"ICON" => "images/services/content.gif",
	),

	"media" => Array(
		"NAME" => GetMessage("SERVICE_MEDIA"),
		"MODULE_ID" => "iblock",
		"ICON" => "images/services/content.gif",
	),

	"books" => Array(
		"NAME" => GetMessage("SERVICE_BOOKS"),
		"STAGES" => Array("step1.php", "step2.php", "step3.php", "step4.php", "step5.php", "step6.php"),
		"MODULE_ID" => "iblock",
		"ICON" => "images/services/content.gif",
	),

	"xmlcatalog" => Array(
		"NAME" => GetMessage("SERVICE_XML_CATALOG"),
		"STAGES" => Array("step1.php", "step2.php", "step3.php", "step4.php", "step5.php", "step6.php", "step7.php", "step8.php", "step9.php"),
		"MODULE_ID" => "iblock",
		"ICON" => "images/services/content.gif",
	),

	"lists" => Array(
		"NAME" => GetMessage("SERVICE_LISTS"),
		"INSTALL_ONLY" => "Y",
	),

	"subscribe" => Array(
		"NAME" => GetMessage("SERVICE_SUBSCRIBE"),
		"ICON" => "images/services/subscribe.gif",
	),

	'vote' => array(
		'NAME' => GetMessage("SERVICE_VOTE"),
		"ICON" => "images/services/vote.gif",
	),

	"forum" => array(
		'NAME' => GetMessage("SERVICE_FORUM"),
		"ICON" => "images/services/forum.gif",
	),

	"sale" => array(
		"NAME" => GetMessage("SERVICE_SALE"),
		"MODULE_ID" => Array("sale", "currency"),
		"STAGES" => Array("step1.php", "step2.php", "step3.php", "step4.php", "step5.php", "step6.php", "step7.php", "step8.php", "step9.php", "step10.php", "step11.php", "step12.php", "step13.php", "step14.php", "step15.php", "step16.php", "step17.php", "step18.php", "step19.php", "step20.php", "step21.php", "step22.php", "step23.php", "step24.php", "step25.php"),
		"ICON" => "images/services/sale.gif",
	),

	"advertising" => Array(
		"NAME" => GetMessage("SERVICE_ADVERTISING"),
		"ICON" => "images/services/advertising.gif",
	),

	"photogallery" => Array(
		"NAME" => GetMessage("SERVICE_PHOTOGALLERY"),
		"ICON" => "images/services/photogallery.gif",
		'MODULE_ID' => Array("photogallery", "iblock"),
		"STAGES" => Array("index.php", "index1.php"),
	),


	'form' => array(
		'NAME' => GetMessage("SERVICE_FORM"),
		'MODULE_ID' => 'form',
		"STAGES" => Array("anketa.php", "feedback.php"),
		"ICON" => "images/services/form.gif",
	),

	'blog' => array(
		'NAME' => GetMessage("SERVICE_BLOGS"),
		"ICON" => "images/services/blog.gif",
	),
    
	'idea' => array(
		'NAME' => GetMessage("SERVICE_IDEA"),
		"ICON" => "images/services/blog.gif",
                'MODULE_ID' => Array("blog", "iblock"),
	),

	'support' => array(
		'NAME' => GetMessage("SERVICE_SUPPORT"),
		"ICON" => "images/services/support.gif",
	),

	"learning" => Array(
		"NAME" => GetMessage("SERVICE_LEARNING"),
		"ICON" => "images/services/learning.gif",
	),

	'socialnetwork' => array(
		'NAME' => GetMessage("SERVICE_SOCIALNETWORK"),
		"ICON" => "images/services/socialnetwork.gif",
	),

	"examples" => Array(
		"NAME" => GetMessage("SERVICE_EXAMPLES"),
		"MODULE_ID" => Array("main", "iblock"),
		"ICON" => "images/services/other.gif",
		"STAGES" => Array("index.php", "board.php", "links.php", "faq.php", "paid.php"),
		"DESCRIPTION" => GetMessage("SERVICE_EXAMPLES_DESC")
	),

	"medialibrary" => Array(
		"NAME" => GetMessage("SERVICE_MEDIALIBRARY"),
		"MODULE_ID" => Array("fileman"),
		"ICON" => "images/services/other.gif",
		"STAGES" => Array("index.php"),
		"DESCRIPTION" => GetMessage("SERVICE_MEDIALIBRARY_DESC")
	),
	
	"calendar" => Array(
		"NAME" => GetMessage("SERVICE_CALENDAR"),
		"MODULE_ID" => Array("calendar"),
		"ICON" => "images/services/other.gif",
		"STAGES" => Array("index.php"),
		"DESCRIPTION" => ""
	),

	"last_step" => Array(
		"NAME" => GetMessage("SERVICE_LAST_STEP"),
		"MODULE_ID" => "main",
		"STAGES" => Array("wokflow_inst.php"),
		"INSTALL_ONLY" => "Y",
	),
);


?>