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

//Install themes iblock
DEMO_IBlock_ImportXML("010_services_services-themes_".LANGUAGE_ID.".xml", $arParams["site_id"], false, true);

//Import XML
if($IBLOCK_ID = DEMO_IBlock_ImportXML("030_articles_content-articles_".LANGUAGE_ID.".xml", $arParams["site_id"], false, "bizproc"))
{
	//Forum creation
	if(CModule::IncludeModule('forum'))
	{
		$rsForums = CForumNew::GetList();
		while($arForum = $rsForums->Fetch())
		{
			if($arForum["NAME"] == GetMessage("DEMO_IBLOCK_CONTENT_ARTICLES_FORUM_NAME"))
				break;
		}

		if(!$arForum)
		{
			$rsForumGroups = CForumGroup::GetList();
			while($arForumGroup = $rsForumGroups->Fetch())
			{
				$arForumGroup = CForumGroup::GetLangByID($arForumGroup["ID"], LANGUAGE_ID);
				if($arForumGroup["NAME"] === GetMessage("DEMO_IBLOCK_CONTENT_ARTICLES_FORUM_GROUP_NAME"))
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
					$file = dirname(__FILE__)."/lang/".$arLang["LANGUAGE_ID"]."/content-articles.php";
					include($file);
					$arFields["LANG"][] = array(
						"LID" => $arLang["LANGUAGE_ID"],
						"NAME" => GetMessage("DEMO_IBLOCK_CONTENT_ARTICLES_FORUM_GROUP_NAME"),
						"DESCRIPTION" => "",
					);
				}
				$arForumGroup = array("FORUM_GROUP_ID" => CForumGroup::Add($arFields));
			}
			if($arForumGroup["FORUM_GROUP_ID"])
			{
				$arFields = Array(
					"NAME" => GetMessage("DEMO_IBLOCK_CONTENT_ARTICLES_FORUM_NAME"),
					"DESCRIPTION" => "",
					"SORT" => 150,
					"ACTIVE" => "Y",
					"ALLOW_HTML" => "N",
					"ALLOW_ANCHOR" => "Y",
					"ALLOW_BIU" => "Y",
					"ALLOW_IMG" => "N",
					"ALLOW_LIST" => "Y",
					"ALLOW_QUOTE" => "Y",
					"ALLOW_CODE" => "Y",
					"ALLOW_FONT" => "Y",
					"ALLOW_SMILES" => "Y",
					"ALLOW_UPLOAD" => "N",
					"ALLOW_UPLOAD_EXT" => "",
					"ALLOW_NL2BR" => "Y",
					"MODERATION" => "N",
					"ALLOW_MOVE_TOPIC" => "Y",
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

	if(CModule::IncludeModule('bizproc'))
	{
		if(CBPDocument::GetNumberOfWorkflowTemplatesForDocumentType(array("iblock", "CIBlockDocument", "iblock_".$IBLOCK_ID)) <= 0)
			CBPDocument::AddDefaultWorkflowTemplates(array("iblock", "CIBlockDocument", "iblock_".$IBLOCK_ID));

		$TEMPLATE_ID = 0;
		
		$dbWorkflowTemplate = CBPWorkflowTemplateLoader::GetList(
			array(),
			array(
				"DOCUMENT_TYPE" => array("iblock", "CIBlockDocument", "iblock_".$IBLOCK_ID), 
				"SYSTEM_CODE"=>"status.php", 
				"ACTIVE"=>"Y"
			),
			false,
			false,
			array("ID")
		);

		if($arWorkflowTemplate = $dbWorkflowTemplate->Fetch())
			$TEMPLATE_ID = $arWorkflowTemplate["ID"];

		$arElement = array(
			"IBLOCK_ID" => $IBLOCK_ID,
			"NAME" => GetMessage("DEMO_IBLOCK_CONTENT_ARTICLES_NAME"),
			"PREVIEW_TEXT" => GetMessage("DEMO_IBLOCK_CONTENT_ARTICLES_PREVIEW_TEXT"),
			"WF_STATUS_ID" => 2,
			"WF_NEW" => "Y",
			"PROPERTY_VALUES" => array(
				"KEYWORDS" => GetMessage("DEMO_IBLOCK_CONTENT_ARTICLES_KEYWORDS"),
				"THEMES" => 4,
			)
		);
		$obElement = new CIBlockElement;
		$element_id = $obElement->Add($arElement);
		if($element_id && $TEMPLATE_ID>0)
		{
			$arErrorsTmp = array();
			$bpId = CBPDocument::StartWorkflow(
				$TEMPLATE_ID,
				array("iblock", "CIBlockDocument", $element_id),
				array(
					"Creators" => array("author"),
					"Approvers" => array(1),
				),
				$arErrorsTmp
			);
			if(count($arErrorsTmp) <= 0)
			{
				$arDocumentStates = CBPDocument::GetDocumentStates(
					array("iblock", "CIBlockDocument", "iblock_".$IBLOCK_ID),
					array("iblock", "CIBlockDocument", $element_id)
				);
				$arCurrentUserGroups = $GLOBALS["USER"]->GetUserGroupArray();
				$arCurrentUserGroups[] = "Author";
				$arEvents = CBPDocument::GetAllowableEvents(
					$GLOBALS["USER"]->GetID(),
					$arCurrentUserGroups,
					array_pop($arDocumentStates)
				);
				CBPDocument::SendExternalEvent(
					$bpId,
					$arEvents[0]["NAME"],
					array("Groups" => $arCurrentUserGroups, "User" => $GLOBALS["USER"]->GetID()),
					$arErrorTmp
				);
			}
		}
	}

	//Include language one more time (after forum creation)
	__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", "/".basename(__FILE__)));

	//Create directory and copy files
	$search = array(
		"#IBLOCK.ID(XML_ID=content-articles)#",
		"#IBLOCK.ID(XML_ID=content-news)#",
		"#MODULE.INSTALLED(ID=forum)#",
		"#FORUM.ID(NAME=content-articles)#",
	);
	$replace = array(
		$IBLOCK_ID,
		CIBlockCMLImport::GetIBlockByXML_ID("content-news"),
		(IsModuleInstalled("forum")? "Y": "N"),
		$arForum["ID"],
	);
	DEMO_IBlock_CopyFiles("/public/content/articles/","/content/articles/", false, $search, $replace);
	CopyDirFiles(dirname(__FILE__)."/public/language/".LANGUAGE_ID."/content/articles/", $_SERVER["DOCUMENT_ROOT"]."/content/articles", false, true);

	//Add menu item
	DEMO_IBlock_AddMenuItem("/content/.left.menu.php", Array(
		GetMessage("DEMO_IBLOCK_CONTENT_ARTICLES_MENU"),
		"/content/articles/",
		Array(),
		Array(),
		"",
	));

	CUrlRewriter::Add(array(
		"CONDITION" => "#^/content/articles/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/content/articles/index.php"
	));

}
?>