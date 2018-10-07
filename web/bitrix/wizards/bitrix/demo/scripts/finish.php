<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class Finish extends CWizardStep
{
	function InitStep()
	{
		$this->SetStepID("finish");
		$this->SetCancelStep("finish");
		$this->SetTitle(GetMessage("FINISH_STEP_TITLE"));
		$this->SetCancelCaption(GetMessage("FINISH_STEP_BUTTON_NAME"));
	}


	function OnPostForm()
	{
	}

	function ShowStep()
	{
		$wizard =& $this->GetWizard();
		$wizard->SetFormActionScript("/?finish");

		$this->CreateNewIndex();
		$this->content .= GetMessage("FINISH_STEP_CONTENT");
	}


	function CreateNewIndex()
	{
		if ($_SERVER["PHP_SELF"] != "/index.php")
			return;

		$wizard =& $this->GetWizard();
		$templateID = $wizard->GetSiteTemplateID();

		$arReplace = array();
		$replacePhoto = '';
		if(($iblockID = $this->GetIBlockID("photo-gallery-user", "/content/gallery/index.php")))
		{
			$replacePhoto = '<h2>'.GetMessage("INDEX_NEW_PHOTO").'</h2>
<?$APPLICATION->IncludeComponent(
	"bitrix:photogallery.detail.list",
	".default",
	Array(
		"IBLOCK_TYPE" => "photos",
		"IBLOCK_ID" => "'.$iblockID.'",
		"BEHAVIOUR" => "USER",
		"USER_ALIAS" => $_REQUEST["USER_ALIAS"],
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"ELEMENT_LAST_TYPE" => "none",
		"USE_DESC_PAGE" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"PAGE_ELEMENTS" => "6",
		"DETAIL_URL" => "/content/gallery/#USER_ALIAS#/#SECTION_ID#/#ELEMENT_ID#/",
		"DETAIL_SLIDE_SHOW_URL" => "/content/gallery/#USER_ALIAS#/#SECTION_ID#/#ELEMENT_ID#/slide_show/",
		"SEARCH_URL" => "/content/gallery/search/",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"PAGE_NAVIGATION_TEMPLATE" => "",
		"USE_PERMISSIONS" => "N",
		"GROUP_PERMISSIONS" => array(0=>"1",1=>"",),
		"COMMENTS_TYPE" => "none",
		"SET_TITLE" => "N",
		"DATE_TIME_FORMAT" => "d.m.Y",
		"ADDITIONAL_SIGHTS" => array(),
		"PICTURES_SIGHT" => "",
		"THUMBNAIL_SIZE" => "90",
		"SHOW_PAGE_NAVIGATION" => "none",
		"SHOW_CONTROLS" => "N",
		"SHOW_RATING" => "N",
		"SHOW_SHOWS" => "N",
		"SHOW_COMMENTS" => "N",
		"SHOW_TAGS" => "N",
		"MAX_VOTE" => "5",
		"VOTE_NAMES" => array(0=>"1",1=>"2",2=>"3",3=>"4",4=>"5",5=>"",)
	)
);?>';
		}
		$arReplace["NEW_PHOTO"] = "-->".$replacePhoto."<!--";

		if ($templateID == "books" && ($iblockID = $this->GetIBlockID("books-books", "/e-store/books/index.php")) )
		{
			$arReplace["SERVICE_IBLOCK_ID"] = $iblockID;
			$index = "books";
		}
		elseif ($templateID == "xml_catalog" && ($iblockID = $this->GetIBlockID("FUTURE-1C-CATALOG", "/e-store/xml_catalog/index.php")) )
		{
			$arReplace["SERVICE_IBLOCK_ID"] = $iblockID;
			$index = "xml_catalog";
		}
		elseif ($templateID == "xml_catalog" && LANGUAGE_ID == "en" && ($iblockID = $this->GetIBlockID("books-books", "/e-store/books/index.php")) )
		{
			$arReplace["SERVICE_IBLOCK_ID"] = $iblockID;
			$index = "xml_catalog";
		}
		elseif ($templateID == "web20" && $this->GetIBlockID("content-news", "/content/news/index.php") || $this->GetIBlockID("content-articles", "/content/articles/index.php"))
		{

			$newsID = $this->GetIBlockID("content-news", "/content/news/index.php");
			$articlesID = $this->GetIBlockID("content-articles", "/content/articles/index.php");

			$articleReplace = "";
			if ($articlesID)
			{
				$title = GetMessage("INDEX_ARTICLES_TITLE");

				$articleReplace = '
				<?$APPLICATION->IncludeComponent("bitrix:news.list", "articles", Array(
					"IBLOCK_TYPE"	=>	"articles",
					"IBLOCK_ID"	=>	"'.$articlesID.'",
					"NEWS_COUNT"	=>	"5",
					"SORT_BY1"	=>	"ACTIVE_FROM",
					"SORT_ORDER1"	=>	"DESC",
					"SORT_BY2"	=>	"SORT",
					"SORT_ORDER2"	=>	"ASC",
					"FILTER_NAME"	=>	"",
					"FIELD_CODE"	=>	array(
					),
					"PROPERTY_CODE"	=>	array(
						0	=>	"FORUM_MESSAGE_CNT",
						1	=>	"rating",
					),
					"DETAIL_URL"	=>	"/content/articles/#ELEMENT_ID#/",
					"CACHE_TYPE"	=>	"A",
					"CACHE_TIME"	=>	"3600",
					"CACHE_FILTER"	=>	"N",
					"PREVIEW_TRUNCATE_LEN"	=>	"0",
					"ACTIVE_DATE_FORMAT"	=>	"M j, Y, H:m",
					"DISPLAY_PANEL"	=>	"N",
					"SET_TITLE"	=>	"N",
					"INCLUDE_IBLOCK_INTO_CHAIN"	=>	"Y",
					"ADD_SECTIONS_CHAIN"	=>	"Y",
					"HIDE_LINK_WHEN_NO_DETAIL"	=>	"N",
					"PARENT_SECTION"	=>	"",
					"DISPLAY_TOP_PAGER"	=>	"N",
					"DISPLAY_BOTTOM_PAGER"	=>	"N",
					"PAGER_TITLE"	=>	"'.GetMessage("INDEX_ARTICLES_TITLE").'",
					"PAGER_SHOW_ALWAYS"	=>	"N",
					"PAGER_TEMPLATE"	=>	"",
					"PAGER_DESC_NUMBERING"	=>	"N",
					"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	"36000",
					"PAGER_SHOW_ALL" => "N",
					"DISPLAY_DATE"	=>	"Y",
					"DISPLAY_NAME"	=>	"Y",
					"DISPLAY_PICTURE"	=>	"N",
					"DISPLAY_PREVIEW_TEXT"	=>	"Y"
					)
					);?>
				';
			}

			$newsReplace = "";
			if ($newsID)
			{
				$newsReplace = '
					<?$APPLICATION->IncludeComponent(
						"bitrix:news.list",
						"",
						Array(
							"DISPLAY_DATE" => "Y",
							"DISPLAY_NAME" => "Y",
							"DISPLAY_PICTURE" => "N",
							"DISPLAY_PREVIEW_TEXT" => "Y",
							"IBLOCK_TYPE" => "news",
							"IBLOCK_ID" => "'.$newsID.'",
							"NEWS_COUNT" => "5",
							"SORT_BY1" => "ACTIVE_FROM",
							"SORT_ORDER1" => "DESC",
							"SORT_BY2" => "SORT",
							"SORT_ORDER2" => "ASC",
							"FILTER_NAME" => "",
							"FIELD_CODE" => Array("",""),
							"PROPERTY_CODE" => Array("",""),
							"DETAIL_URL" => "/content/news/#SECTION_ID#/#ELEMENT_ID#/",
							"PREVIEW_TRUNCATE_LEN" => "0",
							"ACTIVE_DATE_FORMAT" => "d.m.Y",
							"DISPLAY_PANEL" => "N",
							"SET_TITLE" => "N",
							"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
							"CACHE_TIME" => "3600",
							"CACHE_FILTER" => "N",
							"DISPLAY_TOP_PAGER" => "N",
							"DISPLAY_BOTTOM_PAGER" => "N",
							"PAGER_TITLE" => "'.GetMessage("INDEX_NEWS_TITLE").'",
							"PAGER_SHOW_ALWAYS" => "N",
							"PAGER_TEMPLATE" => "",
							"PAGER_DESC_NUMBERING" => "N",
							"PAGER_SHOW_ALL" => "N",
						)
					);?>
				';

				if ($articlesID)
					$newsReplace = "<h1>".GetMessage("INDEX_NEWS_TITLE")."</h1>".$newsReplace;
				else
					$title = GetMessage("INDEX_NEWS_TITLE");
			}

			$arReplace["TITLE"] = $title;
			$arReplace["ARTICLES"] = "-->".$articleReplace."<!--";
			$arReplace["NEWS"] = "-->".$newsReplace."<!--";

			$index = "web20";
		}
		else
		{
			$arReplace = false;
			$index = "static_page";
		}

		//Copy index page
		CopyDirFiles(
			$_SERVER["DOCUMENT_ROOT"].$wizard->GetPath()."/indexes/".LANGUAGE_ID."/".$index,
			$_SERVER["DOCUMENT_ROOT"],
			$rewrite = true,
			$recursive = true
		);

		CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/index.php", $arReplace);

		//For "start" enable HTML caching
		$bExtraModule = false;
		$arModulesInstalled = array();
		$arStartModules = array("main", "iblock", "search", "fileman", "compression", "perfmon", "seo");
		$rsModules = CModule::GetDropDownList();
		while($arModule = $rsModules->Fetch())
		{
			if(!in_array($arModule["REFERENCE_ID"], $arStartModules))
				$bExtraModule = true;
			$arModulesInstalled[] = $arModule["REFERENCE_ID"];
		}
		if(!$bExtraModule)
			CHTMLPagesCache::SetEnabled(true);

		//Let's pretend we just optimized all the tables
		COption::SetOptionInt("main", "LAST_DB_OPTIMIZATION_TIME", time());
	}


	function GetIBlockID($xmlID, $filePath)
	{
		if (!CModule::IncludeModule("iblock"))
			return false;

		if (!file_exists($_SERVER["DOCUMENT_ROOT"].$filePath))
			return false;

		return CIBlockCMLImport::GetIBlockByXML_ID($xmlID);
	}

}

?>