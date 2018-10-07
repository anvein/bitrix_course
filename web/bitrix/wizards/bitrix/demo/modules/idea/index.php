<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

if(!CModule::IncludeModule('blog'))
	return;

if(!CModule::IncludeModule('iblock'))
	return;

if(!CModule::IncludeModule('idea'))
	return;

//Install Iblock
include(dirname(__FILE__)."/../content/index.php");
include(dirname(__FILE__)."/../iblock/services-idea.php");

//Install Blog
__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", "/".basename(__FILE__)));

$siteID = $arParams["site_id"];
if(strlen($arParams["site_id"]) <= 0)
	$siteID = "s1";

$SocNetGroupID = false;
$IdeaBlogGroupName = "[".$siteID."] ".GetMessage("IDEA_DEMO_BLOG_GROUP_NAME");
$IdeaBlogUrl = "idea_".$siteID;

$db_blog_group = CBlogGroup::GetList(array("ID" => "ASC"), array("SITE_ID" => $siteID, "NAME" => $IdeaBlogGroupName));
if ($res_blog_group = $db_blog_group->Fetch())
     $SocNetGroupID = $res_blog_group["ID"];

if (!$SocNetGroupID)
    $SocNetGroupID = CBlogGroup::Add(
        array(
            "SITE_ID" => $siteID, 
            "NAME" => $IdeaBlogGroupName
        )
    );

$arBlog = CBlog::GetByUrl($arParams["BLOG_URL"]);
if(!$arBlog)
{
    $blogID = CBlog::Add(
            Array(
                    "NAME" =>  GetMessage("IDEA_DEMO_BLOG_NAME")." [".$siteID."]",
                    "DESCRIPTION" => "",
                    "GROUP_ID" => $SocNetGroupID,
                    "ENABLE_IMG_VERIF" => 'Y',
                    "EMAIL_NOTIFY" => 'Y',
                    "ENABLE_RSS" => "Y",
                    "ALLOW_HTML" => "Y",
                    "URL" => $IdeaBlogUrl,
                    "ACTIVE" => "Y",
                    "=DATE_CREATE" => $DB->GetNowFunction(),
                    "=DATE_UPDATE" => $DB->GetNowFunction(),
                    "SOCNET_GROUP_ID" => 1,
                    "PERMS_POST" => Array("1" => BLOG_PERMS_READ, "2" => BLOG_PERMS_WRITE), 
                    "PERMS_COMMENT" => array("1" => BLOG_PERMS_WRITE , "2" => BLOG_PERMS_WRITE),
                    "PATH" => '/content/idea/',
            )
    );

    //UF
    $arUFIdByName = array();
    $arStatusList = CIdeaManagment::getInstance()->GetStatusList();
    foreach($arStatusList as $UF)
        $arUFIdByName[$UF["XML_ID"]] = $UF["ID"];

    //Categories
    $categoryID = array();

    $categoryID[0][] = CBlogCategory::Add(Array("BLOG_ID" => $blogID, "NAME" => GetMessage("IDEA_BLOG_DEMO_CATEGORY_1")));
    $categoryID[0][] = CBlogCategory::Add(Array("BLOG_ID" => $blogID, "NAME" => GetMessage("IDEA_BLOG_DEMO_CATEGORY_2")));

    $categoryID[1][] = $categoryID[0][1];
    $categoryID[1][] = CBlogCategory::Add(Array("BLOG_ID" => $blogID, "NAME" => GetMessage("IDEA_BLOG_DEMO_CATEGORY_3")));

    $categoryID[2][] = $categoryID[0][1];
    $categoryID[2][] = CBlogCategory::Add(Array("BLOG_ID" => $blogID, "NAME" => GetMessage("IDEA_BLOG_DEMO_CATEGORY_4")));

    $categoryID[3][] = CBlogCategory::Add(Array("BLOG_ID" => $blogID, "NAME" => GetMessage("IDEA_BLOG_DEMO_CATEGORY_5")));

    //Post messages
    $arBlogPostFields = array();
    $arBlogPostFields[] = Array(
            "TITLE" => GetMessage("IDEA_BLOG_DEMO_MESSAGE_TITLE_1"),
            "DETAIL_TEXT" => GetMessage("IDEA_BLOG_DEMO_MESSAGE_BODY_1"),
            "DETAIL_TEXT_TYPE" => "text",
            "BLOG_ID" => $blogID,
            "AUTHOR_ID" => 1,
            "=DATE_CREATE" => $DB->GetNowFunction(),
            "=DATE_PUBLISH" => $DB->GetNowFunction(),
            "PUBLISH_STATUS" => BLOG_PUBLISH_STATUS_PUBLISH,
            "ENABLE_TRACKBACK" => 'N',
            "ENABLE_COMMENTS" => 'Y',
            "CATEGORY_ID" =>  implode(",", $categoryID[0]),
            "UF_CATEGORY_CODE" => ToUpper(GetMessage("IDEA_UF_CATEGORY_CODE_1")),
            "UF_STATUS" => $arUFIdByName["NEW"],
            "PERMS_POST" => Array(1 => BLOG_PERMS_READ, 2 => BLOG_PERMS_READ),
            "PERMS_COMMENT" => Array(1 => BLOG_PERMS_WRITE, 2 => BLOG_PERMS_WRITE),
            "PATH" => '/content/idea/#post_id#/',
            "CODE" => "mahogany_furniture",
    );

    $arBlogPostFields[] = Array(
            "TITLE" => GetMessage("IDEA_BLOG_DEMO_MESSAGE_TITLE_2"),
            "DETAIL_TEXT" => GetMessage("IDEA_BLOG_DEMO_MESSAGE_BODY_2"),
            "DETAIL_TEXT_TYPE" => "text",
            "BLOG_ID" => $blogID,
            "AUTHOR_ID" => 1,
            "=DATE_CREATE" => $DB->GetNowFunction(),
            "=DATE_PUBLISH" => $DB->GetNowFunction(),
            "PUBLISH_STATUS" => BLOG_PUBLISH_STATUS_PUBLISH,
            "ENABLE_TRACKBACK" => 'N',
            "ENABLE_COMMENTS" => 'Y',
            "CATEGORY_ID" =>  implode(",", $categoryID[1]),
            "UF_CATEGORY_CODE" => ToUpper(GetMessage("IDEA_UF_CATEGORY_CODE_2")),
            "UF_STATUS" => $arUFIdByName["PROCESSING"],
            "PERMS_POST" => Array(1 => BLOG_PERMS_READ, 2 => BLOG_PERMS_READ),
            "PERMS_COMMENT" => Array(1 => BLOG_PERMS_WRITE, 2 => BLOG_PERMS_WRITE),
            "PATH" => '/content/idea/#post_id#/',
            "CODE" => "courier_delivery",
    );

    $arBlogPostFields[] = Array(
            "TITLE" => GetMessage("IDEA_BLOG_DEMO_MESSAGE_TITLE_3"),
            "DETAIL_TEXT" => GetMessage("IDEA_BLOG_DEMO_MESSAGE_BODY_3"),
            "DETAIL_TEXT_TYPE" => "text",
            "BLOG_ID" => $blogID,
            "AUTHOR_ID" => 1,
            "=DATE_CREATE" => $DB->GetNowFunction(),
            "=DATE_PUBLISH" => $DB->GetNowFunction(),
            "PUBLISH_STATUS" => BLOG_PUBLISH_STATUS_PUBLISH,
            "ENABLE_TRACKBACK" => 'N',
            "ENABLE_COMMENTS" => 'Y',
            "CATEGORY_ID" =>  implode(",", $categoryID[2]),
            "UF_CATEGORY_CODE" => ToUpper(GetMessage("IDEA_UF_CATEGORY_CODE_3")),
            "UF_STATUS" => $arUFIdByName["COMPLETED"],
            "PERMS_POST" => Array(1 => BLOG_PERMS_READ, 2 => BLOG_PERMS_READ),
            "PERMS_COMMENT" => Array(1 => BLOG_PERMS_WRITE, 2 => BLOG_PERMS_WRITE),
            "PATH" => '/content/idea/#post_id#/',
            "CODE" => "thanks",
    );

    $arBlogPostFields[] = Array(
            "TITLE" => GetMessage("IDEA_BLOG_DEMO_MESSAGE_TITLE_4"),
            "DETAIL_TEXT" => GetMessage("IDEA_BLOG_DEMO_MESSAGE_BODY_4"),
            "DETAIL_TEXT_TYPE" => "text",
            "BLOG_ID" => $blogID,
            "AUTHOR_ID" => 1,
            "=DATE_CREATE" => $DB->GetNowFunction(),
            "=DATE_PUBLISH" => $DB->GetNowFunction(),
            "PUBLISH_STATUS" => BLOG_PUBLISH_STATUS_PUBLISH,
            "ENABLE_TRACKBACK" => 'N',
            "ENABLE_COMMENTS" => 'Y',
            "CATEGORY_ID" =>  implode(",", $categoryID[3]),
            "UF_CATEGORY_CODE" => ToUpper(GetMessage("IDEA_UF_CATEGORY_CODE_4")),
            "UF_STATUS" => $arUFIdByName["NEW"],
            "PERMS_POST" => Array(1 => BLOG_PERMS_READ, 2 => BLOG_PERMS_READ),
            "PERMS_COMMENT" => Array(1 => BLOG_PERMS_WRITE, 2 => BLOG_PERMS_WRITE),
            "PATH" => '/content/idea/#post_id#/',
            "CODE" => "redesign",
    );

    $arBlogPostId = array();
    foreach($arBlogPostFields as $BlogPostFields)
        $arBlogPostId[] = CBlogPost::Add($BlogPostFields);

    foreach($arBlogPostId as $key=>$BlogPostId)
    {
        if(!is_array($categoryID[$key])) continue;

        foreach($categoryID[$key] as $v)
            CBlogPostCategory::Add(Array("BLOG_ID" => $blogID, "POST_ID" => $BlogPostId, "CATEGORY_ID" => $v));
    }

    //Post Comments
    $arBlogCommentFields = array();
    $arBlogCommentFields[] = Array(
            "TITLE" => '',
            "POST_TEXT" => GetMessage("IDEA_BLOG_DEMO_COMMENT_BODY_1"),
            "BLOG_ID" => $blogID,
            "POST_ID" => $arBlogPostId[2],
            "PARENT_ID" => 0,
            "AUTHOR_ID" => 1,
            "DATE_CREATE" => ConvertTimeStamp(false, "FULL"), 
            "AUTHOR_IP" => "192.168.0.108",
            "PATH" => "/content/idea/#post_id#/?commentId=#comment_id###comment_id#"
    );
    $arBlogCommentFields[] = Array(
            "TITLE" => '',
            "POST_TEXT" => GetMessage("IDEA_BLOG_DEMO_COMMENT_BODY_3"),
            "BLOG_ID" => $blogID,
            "POST_ID" => $arBlogPostId[2],
            "PARENT_ID" => 0,
            "AUTHOR_ID" => 1,
            "DATE_CREATE" => ConvertTimeStamp(false, "FULL"), 
            "AUTHOR_IP" => "192.168.0.108",
            "PATH" => "/content/idea/#post_id#/?commentId=#comment_id###comment_id#"
    );
    $arBlogCommentFields[] = Array(
            "TITLE" => '',
            "POST_TEXT" => GetMessage("IDEA_BLOG_DEMO_COMMENT_BODY_2"),
            "BLOG_ID" => $blogID,
            "POST_ID" => $arBlogPostId[1],
            "PARENT_ID" => 0,
            "AUTHOR_ID" => 1,
            "DATE_CREATE" => ConvertTimeStamp(false, "FULL"), 
            "AUTHOR_IP" => "192.168.0.108",
            "PATH" => "/content/idea/#post_id#/?commentId=#comment_id###comment_id#"
    );

    $arCommentId = array();
    foreach($arBlogCommentFields as $BlogCommentFields)
        $arCommentId[] = CBlogComment::Add($BlogCommentFields);

    CIdeaManagment::getInstance()->IdeaComment($arCommentId[0])->Bind();
    CIdeaManagment::getInstance()->IdeaComment($arCommentId[2])->Bind();
}
else
    $blogID = $arBlog["ID"];

$file = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/content/idea/index.php");
if ($file)
{
	$file = str_replace("#IDEA_BLOG_CODE#", $IdeaBlogUrl, $file);
        $file = str_replace("#IDEA_BIND_STATUS_DEFAULT#", $arUFIdByName["NEW"], $file);
        $file = str_replace("#SITE_DIR#", '/', $file);
	if ($f = fopen($_SERVER["DOCUMENT_ROOT"]."/content/idea/index.php", "w"))
	{
		@fwrite($f, $file);
		@fclose($f);
	}
}

CUrlRewriter::Add(array(
        "CONDITION" => "#^/content/idea/#",
        "RULE" => "",
        "ID" => "bitrix:idea",
        "PATH" => "/content/idea/index.php"
));
?>