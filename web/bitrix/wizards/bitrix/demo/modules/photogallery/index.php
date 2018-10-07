<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if (!CModule::IncludeModule("iblock"))
	return;

if (!function_exists("__GetMessageArray"))
{
	function __GetMessageArray($lang)
	{
		static $arMESS = array();
		if (empty($arMESS[$lang]))
		{
			$MESS = array();
			if(file_exists(dirname(__FILE__)."/lang/".$lang."/".basename(__FILE__)))
				include_once(dirname(__FILE__)."/lang/".$lang."/".basename(__FILE__));
			$arMESS[$lang] = $MESS;
		}
		return $arMESS[$lang];
	}
}

$SITE_ID = (defined("SITE_ID") && strLen(SITE_ID) > 0 ? SITE_ID : "s1");
$arLangs = array();
$arMess = array();
__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", "/".basename(__FILE__)));
// Get language
$db_res = CLangAdmin::GetList(($b="sort"), ($o="asc"));
while ($res = $db_res->Fetch())
	$arLangs[] = $res["LID"];

// 1. Create iblock type
$iblockType = CIBlockType::GetByID("gallery");
if (!($iblockType && $iblockType->Fetch()))
{
	$arFields = Array(
		'ID'=>'gallery',
		'SECTIONS'=>'Y',
		'IN_RSS'=>'N',
		'SORT'=>100,
		'LANG'=>Array());
	foreach ($arLangs as $lang_id)
	{
		$res = array(
			'NAME' => GetMessage("P_NAME"),
			'SECTION_NAME' => GetMessage("P_SECTION_NAME"),
			'ELEMENT_NAME'=> GetMessage("P_ELEMENT_NAME"));
		if ($lang_id != LANGUAGE_ID)
		{
			$arMess[$lang_id] = __GetMessageArray($lang_id);
			$res['NAME'] = trim($arMess[$lang_id]["P_NAME"]);
			$res['SECTION_NAME'] = trim($arMess[$lang_id]["P_SECTION_NAME"]);
			$res['ELEMENT_NAME'] = trim($arMess[$lang_id]["P_ELEMENT_NAME"]);
		}
		$res['NAME'] = (!empty($res['NAME']) ? $res['NAME'] : 'Gallery');
		$res['SECTION_NAME'] = (!empty($res['SECTION_NAME']) ? $res['SECTION_NAME'] : 'Albums');
		$res['ELEMENT_NAME'] = (!empty($res['ELEMENT_NAME']) ? $res['ELEMENT_NAME'] : 'Photos');
		$arFields["LANG"][$lang_id] = $res;
	}
	$obBlocktype = new CIBlockType;
	$success = (bool)$obBlocktype->Add($arFields);
	if (!$success)
		return;
}
// 2. Import iblock
$iBlockId = 0;
$db_res = CIBlock::GetList(array(), array("CODE" => "photo", "XML_ID" => "photo-gallery"));
if ($db_res && $res = $db_res->Fetch())
{
	$iBlockId = intVal($res["ID"]);
}
else
{
	$source_base = dirname(__FILE__);
	$documentRoot = rtrim(str_replace(Array("\\\\", "//", "\\"), Array("\\", "/", "/"), $_SERVER["DOCUMENT_ROOT"]), "\\/");
	$source_base = substr($source_base, strLen($documentRoot));
	$source_base = str_replace(array("\\", "//"), "/", "/".$source_base."/");
	require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/iblock/classes/".$DBType."/cml2.php");
	$res = ImportXMLFile($source_base."xml/".LANGUAGE_ID."/photogallery.xml", "gallery", $SITE_ID);

	$db_res = CIBlock::GetList(array(), array("CODE" => "photo", "XML_ID" => "photo-gallery"));
	if ($db_res && $res = $db_res->Fetch())
		$iBlockId = intVal($res["ID"]);
}
if ($iBlockId <= 0)
	return false;
CIBlock::SetPermission($iBlockId, Array("1" => "W", "2" => "R"));

// 3. Add Forum
$arParams = array(
	"USE_COMMENTS" => "N",
	"COMMENTS_TYPE" => "none",
	"FORUM_ID" => "", 
	"BLOG_URL" => "",
	"PATH_TO_SMILE" => "");
if (CModule::IncludeModule("forum"))
{
// 3.1 Add group 
	$iGroupId = 0;
	$db_res = CForumGroup::GetListEx(array(), array("LID" => LANGUAGE_ID));
	if ($db_res && $res = $db_res->Fetch())
	{
		do
		{
			if (GetMessage("P_FORUM_GROUP_COMMENTS") == $res["NAME"])
			{
				$iGroupId = intVal($res["ID"]);
				break;
			}
		}while ($res = $db_res->Fetch());
	}
	if ($iGroupId <= 0)
	{
		// Set Group
		$arFields = array("SORT" => 150);
		foreach ($arLangs as $lang)
		{
			$name = GetMessage("P_FORUM_GROUP_COMMENTS");
			$description = GetMessage("P_FORUM_GROUP_COMMENTS_DESCRIPTION");

			if ($lang != LANGUAGE_ID)
			{
				$arMess[$lang] = __GetMessageArray($lang);
				if (!empty($arMess[$lang]["P_FORUM_GROUP_COMMENTS"]))
				{
					$name = $arMess[$lang]["P_FORUM_GROUP_COMMENTS"];
					$description = $arMess[$lang]["P_FORUM_GROUP_COMMENTS_DESCRIPTION"];
				}
			}
			
			$arFields["LANG"][] = array(
				"LID" => $lang,
				"NAME" => $name,
				"DESCRIPTION" => $description);
		}
		$iGroupId = CForumGroup::Add($arFields);
	}
// 3.2 Add Forum
	$FID = 0;
	$db_res = CForumNew::GetList();
	if ($db_res && $res = $db_res->Fetch())
	{
		do 
		{
			if ($res["NAME"] == GetMessage("P_FORUM_NAME"))
			{
				$FID = intVal($res["ID"]);
				break;
			}
		}while ($res = $db_res->Fetch());
	}
	if ($FID <= 0):
		$arFields = Array(
			"NAME" => GetMessage("P_FORUM_NAME"),
			"DESCRIPTION" => GetMessage("P_FORUM_DECRIPTION"),
			"SORT" => 100,
			"ACTIVE" => "Y",
			"ALLOW_HTML" => "N",
			"ALLOW_ANCHOR" => "N",
			"ALLOW_BIU" => "Y",
			"ALLOW_IMG" => "Y",
			"ALLOW_LIST" => "Y",
			"ALLOW_QUOTE" => "Y",
			"ALLOW_CODE" => "Y",
			"ALLOW_FONT" => "Y",
			"ALLOW_SMILES" => "Y",
			"ALLOW_UPLOAD" => "N",
			"ALLOW_NL2BR" => "N",
			"MODERATION" => "N",
			"ALLOW_MOVE_TOPIC" => "Y",
			"ORDER_BY" => "P",
			"ORDER_DIRECTION" => "DESC",
			"LID" => LANGUAGE_ID,
			"PATH2FORUM_MESSAGE" => "",
			"ALLOW_UPLOAD_EXT" => "",
			"FORUM_GROUP_ID" => $iGroupId,
			"ASK_GUEST_EMAIL" => "N",
			"USE_CAPTCHA" => "Y",
			"SITES" => array(
				$SITE_ID => "/communication/forum/messages/forum#FORUM_ID#/topic#TOPIC_ID#/message#MESSAGE_ID#/"),
			"EVENT1" => "forum", 
			"EVENT2" => "message",
			"EVENT3" => "",
			"GROUP_ID" => array(
				"2" => "M",
				"4" => "A",
				"5" => "A",
				"11" => "A",
				"15" => "A",
				"16" => "A",
				"17" => "A",
				"18" => "A",
				"19" => "Q",
				"20" => "A"));
		$FID = CForumNew::Add($arFields);
	endif;
	if (intVal($FID) > 0)
	{
		$arParams = array(
			"USE_COMMENTS" => "Y",
			"COMMENTS_TYPE" => "forum",
			"FORUM_ID" => $FID, 
			"BLOG_URL" => "",
			"PATH_TO_SMILE" => "/bitrix/images/forum/smile/");
	}
}
elseif (CModule::IncludeModule("blog"))
{
	$iBlogId = "";
	$res = CBlog::GetByUrl("gallery");
	if ($res && !empty($res) && is_array($res)):
		$iBlogId = intVal($res["ID"]);
	else:
		$iBlogGroupId = 0;
		$arFields = array("NAME" => GetMessage("P_BLOG_GROUP_NAME"));
		$db_res = CBlogGroup::GetList(array(), $arFields, false, false, array("ID"));
		if ($db_res && $res = $db_res->Fetch())
		{
			$iBlogGroupId = intVal($res["ID"]);
		}
		else 
		{
			$arFields["SITE_ID"] = $SITE_ID;
			$iBlogGroupId = CBlogGroup::Add($arFields);
		}
		
		if ($iBlogGroupId > 0)
		{
			$arFields = array(
				"ACTIVE" => "N",
				"NAME" => GetMessage("P_BLOG_NAME"),
				"DESCRIPTION" => GetMessage("P_BLOG_DESCRIPTION"),
				"=DATE_UPDATE" => $GLOBALS["DB"]->CurrentTimeFunction(),
				"=DATE_CREATE" => $GLOBALS["DB"]->CurrentTimeFunction(),
				"URL" => "gallery",
				"OWNER_ID" => $GLOBALS["USER"]->GetId(),
				"GROUP_ID" => $iBlogGroupId);
			$iBlogId = CBlog::Add($arFields);
		}
	endif;
	
	if (intVal($iBlogId) > 0)
	{
		$arParams = array(
			"USE_COMMENTS" => "Y",
			"COMMENTS_TYPE" => "blog",
			"FORUM_ID" => 0, 
			"BLOG_URL" => "gallery",
			"PATH_TO_SMILE" => "/bitrix/images/blog/smile/");
	}
}
$arParams["IBLOCK_ID"] = $iBlockId;
// 4. Copy public files with "on the fly" translation
$source = "/public/photogallery/";
$target = "/content/photo/";

$source_base = dirname(__FILE__);
$source_abs = $source_base.$source;
$source_abs = str_replace(array("\\", "//"), "/", $source_base.$source."/");
$target_abs = $_SERVER['DOCUMENT_ROOT'].$target;

$bReWriteAdditionalFiles = false;
if (file_exists($source_abs))
{
	//Create target directory
	CheckDirPath($target_abs);
	$dh = opendir($source_abs);
	//Read the source
	while($file = readdir($dh))
	{
		if($file == "." || $file == "..")
			continue;
		$target_file = $target_abs.$file;
		if($bReWriteAdditionalFiles || !file_exists($target_file))
		{
			//Here we will write public data
			$source_file = $source_abs.$file;
			$fh = fopen($source_file, "rb");
			$php_source = fread($fh, filesize($source_file));
			fclose($fh);
			//Parse localization
			$arParamsForReplace = array();
			foreach ($arParams as $key => $val)
				$arParamsForReplace["#".$key."#"] = $val;
			$php_source = str_replace(array_keys($arParamsForReplace), $arParamsForReplace, $php_source);
			if(preg_match_all('/GetMessage\("(.*?)"\)/', $php_source, $matches))
			{
				//Include LANGUAGE_ID file
				__IncludeLang(GetLangFileName($source_base."/lang/", $source.$file));
				//Substite the stuff
				foreach($matches[0] as $i => $text)
				{
					$php_source = str_replace(
						$text,
						'"'.GetMessage($matches[1][$i]).'"',
						$php_source
					);
				}
			}
			//Write to the destination directory
			$fh = fopen($target_file, "wb");
			fwrite($fh, $php_source);
			fclose($fh);
			@chmod($target_file, BX_FILE_PERMISSIONS); 
		}
	}
}

$arFields = array(
	"CONDITION" => "#^".$target."#",
	"RULE" => "",
	"ID" => "bitrix:photogallery",
	"PATH" => $target."index.php");

CUrlRewriter::Add($arFields);

$PhotoRandom = '
	<div class="information-block">
		<div class="information-block-head">'.GetMessage("P_DAY_PHOTO").'</div>
		<?$APPLICATION->IncludeComponent(
	"bitrix:photo.random",
	"",
	Array("IBLOCK_TYPE" => "gallery", 
		"IBLOCKS" => Array("'.$iBlockId.'"), 
		"DETAIL_URL" => "'.$target.'#SECTION_ID#/#ELEMENT_ID#/", 
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "180")
	);?></div>';

$arReplace = Array("<!--PHOTO_RANDOM-->" => $PhotoRandom);
CWizardUtil::ReplaceMacros($_SERVER['DOCUMENT_ROOT']."/index_inc.php", $arReplace, $skipSharp = true);

//Left menu
DemoSiteUtil::AddMenuItem("/content/.left.menu.php", Array(
	GetMessage("P_MENU_ITEM"),
	"/content/photo/",
	Array(),
	Array(),
	"",
));

//Content section
include(dirname(__FILE__)."/../content/index.php");

return true;
?>
