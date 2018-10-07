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

//Forum creation
if(CModule::IncludeModule('forum'))
{
	$rsForums = CForumNew::GetList();
	while($arForum = $rsForums->Fetch())
	{
		if($arForum["NAME"] == GetMessage("DEMO_IBLOCK_ESTORE_BOOKS_FORUM_NAME"))
			break;
	}
	if(!$arForum)
	{
		$rsForumGroups = CForumGroup::GetList();
		while($arForumGroup = $rsForumGroups->Fetch())
		{
			$arForumGroup = CForumGroup::GetLangByID($arForumGroup["ID"], LANGUAGE_ID);
			if($arForumGroup["NAME"] === GetMessage("DEMO_IBLOCK_ESTORE_BOOKS_FORUM_GROUP_NAME"))
				break;
		}
		if(!$arForumGroup)
		{
			$arFields = array(
				"SORT" => 150,
				"LANG" => array(),
			);
			$rsLanguages = CLanguage::GetList(($b="sort"), ($o="asc"));
			while($arLang = $rsLanguages->Fetch())
			{
				$file = dirname(__FILE__)."/lang/".$arLang["LANGUAGE_ID"]."/books-files.php";
				include($file);
				$arFields["LANG"][] = array(
					"LID" => $arLang["LANGUAGE_ID"],
					"NAME" => GetMessage("DEMO_IBLOCK_ESTORE_BOOKS_FORUM_GROUP_NAME"),
					"DESCRIPTION" => "",
				);
			}
			$arForumGroup = array("FORUM_GROUP_ID" => CForumGroup::Add($arFields));
		}
		if($arForumGroup["FORUM_GROUP_ID"])
		{
			$arFields = Array(
				"NAME" => GetMessage("DEMO_IBLOCK_ESTORE_BOOKS_FORUM_NAME"),
				"DESCRIPTION" => "",
				"SORT" => 150,
				"ACTIVE" => "Y",
				"ALLOW_HTML" => "N",
				"ALLOW_ANCHOR" => "Y",
				"ALLOW_BIU" => "Y",
				"ALLOW_IMG" => "Y",
				"ALLOW_LIST" => "Y",
				"ALLOW_QUOTE" => "Y",
				"ALLOW_CODE" => "Y",
				"ALLOW_FONT" => "Y",
				"ALLOW_SMILES" => "Y",
				"ALLOW_UPLOAD" => "N",
				"ALLOW_UPLOAD_EXT" => "",
				"ALLOW_NL2BR" => "N",
				"MODERATION" => "N",
				"ALLOW_MOVE_TOPIC" => "N",
				"ORDER_BY" => "P",
				"ORDER_DIRECTION" => "DESC",
				"PATH2FORUM_MESSAGE" => "",
				"FORUM_GROUP_ID" => $arForumGroup["FORUM_GROUP_ID"],
				"ASK_GUEST_EMAIL" => "N",
				"USE_CAPTCHA" => "N",
				"SITES" => array(
					$arParams["site_id"] => "/communication/forum/messages/forum#FORUM_ID#/topic#TOPIC_ID#/message#MESSAGE_ID#/",
				),
			);

			$arFields["GROUP_ID"] = array(
				"2" => "M",
				"19" => "Q",
			);

			if (CModule::IncludeModule("statistic"))
			{
				$arFields["EVENT1"] = "forum";
				$arFields["EVENT2"] = "message";
				$arFields["EVENT3"] = "";
			}

			$arForum = array("ID" => CForumNew::Add($arFields));
		}
	}
}
else
{
	$arForum = array("ID" => "");
}

//Include language one more time (after forum creation)
__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", "/".basename(__FILE__)));

$search = array(
	"#IBLOCK.ID(XML_ID=books-authors)#",
	"#IBLOCK.ID(XML_ID=books-books)#",
	"#IBLOCK.ID(XML_ID=books-reviews)#",
	"#FORUM.ID(NAME=books-reviews)#",
	"#MODULE.INSTALLED(ID=forum)#",
);
$replace = array(
	CIBlockCMLImport::GetIBlockByXML_ID("books-authors"),
	CIBlockCMLImport::GetIBlockByXML_ID("books-books"),
	CIBlockCMLImport::GetIBlockByXML_ID("books-reviews"),
	$arForum["ID"],
	(IsModuleInstalled("forum")? "Y": "N"),
);

//Create directory and copy files
DEMO_IBlock_CopyFiles("/public/e-store/books/", "/e-store/books/", false, $search, $replace);
DEMO_IBlock_CopyFiles("/public/e-store/books/authors/", "/e-store/books/authors/", false, $search, $replace);
DEMO_IBlock_CopyFiles("/public/e-store/books/reviews/", "/e-store/books/reviews/", false, $search, $replace);
CopyDirFiles(dirname(__FILE__)."/public/language/".LANGUAGE_ID."/e-store/books/", $_SERVER["DOCUMENT_ROOT"]."/e-store/books", false, true);

//Add menu item
DEMO_IBlock_AddMenuItem("/e-store/.left.menu.php", Array(
	GetMessage("DEMO_IBLOCK_ESTORE_BOOKS_MENU"),
	"/e-store/books/",
	Array(),
	Array(),
	"",
));
?>