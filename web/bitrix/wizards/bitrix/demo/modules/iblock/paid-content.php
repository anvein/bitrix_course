<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

//Library
include_once(dirname(__FILE__)."/iblock_tools.php");
__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", "/".basename(__FILE__)));

//Parameters
if(!is_array($arParams)) $arParams = array();
if(strlen($arParams["site_id"]) <= 0)
	$arParams["site_id"] = "s1";

//Import XML
if($IBLOCK_ID = DEMO_IBlock_ImportXML("110_paid_paid-articles_".LANGUAGE_ID.".xml", $arParams["site_id"], false, true))
{
	$_SESSION["DEMO_IBLOCK_PAID"] = CIBlockCMLImport::GetIBlockByXML_ID("paid-subscribe");
	if($SUBSCR_ID = DEMO_IBlock_ImportXML("120_paid_paid-subscribe_".LANGUAGE_ID.".xml", $arParams["site_id"], false, true))
	{

		$SUBSCR_GROUP_ID = DEMO_IBlock_AddUserGroup("subscribers", GetMessage("DEMO_IBLOCK_ESTORE_PAID_GROUP_NAME"), GetMessage("DEMO_IBLOCK_ESTORE_PAID_GROUP_DESC"));

		//Create directory and copy files
		$search = array(
			"#IBLOCK.ID(XML_ID=paid-articles)#",
			"#IBLOCK.ID(XML_ID=paid-subscribe)#",
			"#USER_GROUP.ID(STRING_ID=subscribers)#",
		);
		$replace = array(
			$IBLOCK_ID,
			$SUBSCR_ID,
			$SUBSCR_GROUP_ID,
		);

		DEMO_IBlock_CopyFiles("/public/e-store/paid/","/e-store/paid/", false, $search, $replace);
		CopyDirFiles(dirname(__FILE__)."/public/language/".LANGUAGE_ID."/e-store/paid/", $_SERVER["DOCUMENT_ROOT"]."/e-store/paid", false, true);

		//Add menu item
		DEMO_IBlock_AddMenuItem("/e-store/.left.menu.php", Array(
			GetMessage("DEMO_IBLOCK_ESTORE_PAID_MENU"),
			"/e-store/paid/",
			Array(),
			Array(),
			"",
		));

		if($_SESSION["DEMO_IBLOCK_PAID"] === false)
		{
			DEMO_IBlock_ImportXML("120_paid_paid-subscribe-offers_".LANGUAGE_ID.".xml", $arParams["site_id"], true, false);
			if(CModule::IncludeModule('catalog'))
				CCatalog::Update($SUBSCR_ID, array("SUBSCRIPTION"=>"Y"));
		}
	}
}
?>