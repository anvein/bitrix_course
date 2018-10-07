<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if (!CModule::IncludeModule("forum")):
	return 0;
elseif (!$DB->TableExists("b_forum") && !$DB->TableExists("B_FORUM")):
	return 1;
endif;
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
if (!function_exists("__CopyForumFiles"))
{
	function __CopyForumFiles($source_abs, $target_abs, $bReWriteAdditionalFiles = true, $arParams = array())
	{
		$source_base = dirname(__FILE__);
		$source_base = str_replace(array("\\", "//"), "/", $source_base."/");

		$source_abs = str_replace(array("\\", "//"), "/", $source_abs."/");
		$target_abs = str_replace(array("\\", "//"), "/", $target_abs."/");
		$source = substr($source_abs, strLen($source_base));
		$source = str_replace("//", "/", "/".$source."/");
		$arParams = (is_array($arParams) ? $arParams : array());
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
				if (is_dir($source_abs.$file))
				{
					__CopyForumFiles($source_abs.$file, $target_abs.$file, $bReWriteAdditionalFiles);
				}
				else
				{
					$target_file = $target_abs.$file;
					if($bReWriteAdditionalFiles || !file_exists($target_file))
					{
						//Here we will write public data
						$source_file = $source_abs.$file;
						$fh = fopen($source_file, "rb");
						$php_source = fread($fh, filesize($source_file));
						fclose($fh);

						$arParamsForReplace = array();
						foreach ($arParams as $key => $val)
							$arParamsForReplace["#".$key."#"] = $val;
						$php_source = str_replace(array_keys($arParamsForReplace), $arParamsForReplace, $php_source);

						//Parse localization
						if(preg_match_all('/GetMessage\("(.*?)"\)/', $php_source, $matches))
						{
							//Include LANGUAGE_ID file
							$path = $source_base."lang/".LANGUAGE_ID.$source.$file;
							__IncludeLang($path);
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
		}
	}
}

$arLangs = array();
$arMess = array();
$SITE_ID = "s1";
__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", "/".basename(__FILE__)));
// Get language
$db_res = CLangAdmin::GetList(($b="sort"), ($o="asc"));
while ($res = $db_res->Fetch())
	$arLangs[] = $res["LID"];
// PointS
$db_res = CForumPoints::GetListEx();
if (!$db_res)
{
	$arFieldsG = array(
		array("MIN_POINTS" => 0, "CODE" => "visitor", "VOTES" => 1, "LANG" => array()),
		array("MIN_POINTS" => 5, "CODE" => "resident", "VOTES" => 2, "LANG" => array()),
		array("MIN_POINTS" => 50, "CODE" => "user", "VOTES" => 4, "LANG" => array()),
		array("MIN_POINTS" => 200, "CODE" => "honored", "VOTES" => 7, "LANG" => array()));
	foreach ($arFieldsG as $arFields)
	{
		foreach ($arLangs as $lang)
		{
			$name = GetMessage("F_POINTS_".strToUpper($arFields["CODE"]));
			if ($lang != LANGUAGE_ID)
			{
				$arMess[$lang] = __GetMessageArray($lang);
				if (!empty($arMess[$lang]["F_POINTS_".strToUpper($arFields["CODE"])]))
					$name = $arMess[$lang]["F_POINTS_".strToUpper($arFields["CODE"])];
			}
			$arFields["LANG"][$lang] = array("LID" => $lang, "NAME" => $name);
		}
		$res = CForumPoints::Add($arFields);
	}
}
$db_res = CForumPoints2Post::GetList();
if (!($db_res && $res = $db_res->Fetch()))
{
	$arFields = array(
		"MIN_NUM_POSTS" => 1,
		"POINTS_PER_POST" => "0.5000");
	CForumPoints2Post::Add($arFields);
	$arFields = array(
		"MIN_NUM_POSTS" => 50,
		"POINTS_PER_POST" => "0.8000");
	CForumPoints2Post::Add($arFields);
}
/* User */
$res = CForumUser::GetByUSER_ID(1);
if (empty($res) || !is_array($res))
{
	$arFields = array(
		"=LAST_VISIT" => $DB->GetNowFunction(),
		"USER_ID" => 1);
	$ID = CForumUser::Add($arUserFields);
}
/* Vote */
$res = CForumUserPoints::GetByID(1, 1);
if (!$res)
{
	$arFields = array(
		"POINTS" => 1000,
		"FROM_USER_ID" => 1,
		"TO_USER_ID" => 1);
	$ID = CForumUserPoints::Add($arFields);
}

// Forum group
$arGroup = array(
	"PUBLIC" => 0,
	"PARTNER" => 0,
	"COMMENTS" => 0);

$db_res = CForumGroup::GetListEx(array(), array("LID" => LANGUAGE_ID));
if ($db_res && $res = $db_res->Fetch())
{
	do
	{
		if (GetMessage("F_GROUP_PUBLIC") == $res["NAME"]):
			$arGroup["PUBLIC"] = intVal($res["ID"]);
		elseif (GetMessage("F_GROUP_PARTNER") == $res["NAME"]):
			$arGroup["PARTNER"] = intVal($res["ID"]);
		elseif (GetMessage("F_GROUP_COMMENTS") == $res["NAME"]):
			$arGroup["COMMENTS"] = intVal($res["ID"]);
		endif;
	} while ($res = $db_res->Fetch());
}

if (array_sum($arGroup) <= 0)
{
// Set Group
	foreach ($arGroup as $key => $res)
	{
		if ($res > 0)
			continue;
		$arFields = array("SORT" => 150);
		foreach ($arLangs as $lang)
		{
			$name = GetMessage("F_GROUP_".$key);
//			$description = GetMessage("F_GROUP_".$key."_DESCRIPTION");

			if ($lang != LANGUAGE_ID)
			{
				$arMess[$lang] = __GetMessageArray($lang);
				if (!empty($arMess[$lang]["F_GROUP_".$key]))
				{
					$name = $arMess[$lang]["F_GROUP_".$key];
//					$description = $arMess[$lang]["F_GROUP_".$key."_DESCRIPTION"];
				}
			}

			$arFields["LANG"][] = array(
				"LID" => $lang,
				"NAME" => $name,
				"DESCRIPTION" => $description);
		}
		$arGroup[$key] = CForumGroup::Add($arFields);
	}
}
$arFieldsParams = array(
	"SHOW_VOTE" => "N",
	"VOTE_CHANNEL_ID" => 0,
	"VOTE_GROUP_ID" => 0,
	"VOTE_ID" => 0,
	"FORUMS_ID" => "");
if (CModule::IncludeModule("vote"))
{
	$db_res = CVoteChannel::GetList($by, $order, array('SYMBOLIC_NAME' => 'FORUM', 'SYMBOLIC_NAME_EXACT_MATCH' => 'Y'), $is_filtered);
	if ($db_res && $res = $db_res->Fetch()):
		$arFieldsParams = array(
			"SHOW_VOTE" => "Y",
			"VOTE_CHANNEL_ID" => $res["ID"],
			"VOTE_GROUP_ID" => 0);
		//Registered users group
		$dbResult = CGroup::GetList($by, $order, array("STRING_ID" => "REGISTERED_USERS"));
		if ($dbResult && $res = $dbResult->Fetch()):
			$arFieldsParams["VOTE_GROUP_ID"] = $res["ID"];
		endif;
		$db_res = CVote::GetList($by, $order, array("CHANNEL_ID" => $arFieldsParams["VOTE_CHANNEL_ID"]), $is_filtered);
		if ($db_res && $res = $db_res->Fetch()):
			$arFieldsParams["VOTE_ID"] = intVal($res["ID"]);
		endif;
	endif;
}

// Forums
$arForums = array();
$arReplaceForums = array();

$db_res = CForumNew::GetList(array(), array("SITE_ID" => $SITE_ID));
if ($db_res && $res = $db_res->Fetch())
{
	do
	{
		$arForums[$res["ID"]] = $res["NAME"];
	}while ($res = $db_res->Fetch());
}
// Forum № 1
if (in_array(GetMessage("F_FORUM_1_NAME"), $arForums)):
	foreach ($arForums as $key => $val):
		if ($val == GetMessage("F_FORUM_1_NAME")):
			$arReplaceForums[] = $key;
		endif;
	endforeach;
else:
	$arFields = Array(
		"NAME" => GetMessage("F_FORUM_1_NAME"),
		"DESCRIPTION" => GetMessage("F_FORUM_1_DECRIPTION"),
		"SORT" => 100,
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
		"ALLOW_NL2BR" => "N",
		"MODERATION" => "N",
		"ALLOW_MOVE_TOPIC" => "Y",
		"ORDER_BY" => "P",
		"ORDER_DIRECTION" => "DESC",
		"LID" => LANGUAGE_ID,
		"PATH2FORUM_MESSAGE" => "",
		"ALLOW_UPLOAD_EXT" => "",
		"FORUM_GROUP_ID" => $arGroup["PUBLIC"],
		"ASK_GUEST_EMAIL" => "N",
		"USE_CAPTCHA" => "Y",
		"SITES" => array(
			$SITE_ID => "/communication/forum/messages/forum#FID#/message#MID#/#TITLE_SEO#"),
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
	if ($FID > 0)
	{
		$arReplaceForums[] = $FID;
		$arFields = Array(
			"FORUM_ID" => $FID,
			"TITLE"			=> GetMessage("F_FORUM_1_TOPIC_1_TITLE"),
			"DESCRIPTION"	=> GetMessage("F_FORUM_1_TOPIC_1_DESCRIPTION"),
			"ICON_ID"		=> 0,
			"TAGS"			=> GetMessage("F_FORUM_1_TOPIC_1_TAGS"),
			"USER_START_ID" => 1,
			"USER_START_NAME" => GetMessage("F_FORUM_1_TOPIC_1_AUTHOR"),
			"LAST_POSTER_NAME" => GetMessage("F_FORUM_1_TOPIC_1_AUTHOR"),
			"APPROVED" => "Y");
		$TID = intVal(CForumTopic::Add($arFields));
		if ($TID > 0)
		{
			$arFields = Array(
				"POST_MESSAGE"	=> GetMessage("F_FORUM_1_TOPIC_1_MESSAGE_1_POSTMESS"),
				"USE_SMILES"	=> "Y",
				"APPROVED"		=> "Y",
				"AUTHOR_NAME"	=> GetMessage("F_FORUM_1_TOPIC_1_AUTHOR"),
				"AUTHOR_EMAIL"	=> "",
				"AUTHOR_ID"		=> "1",
				"FORUM_ID"		=> $FID,
				"TOPIC_ID"		=> $TID,
				"AUTHOR_IP"	=> "SWAMP",
				"AUTHOR_REAL_IP"=> "SWAMP",
				"NEW_TOPIC"		=> "Y",
				"GUEST_ID"		=> 58);
			$MID = CForumMessage::Add($arFields, false);
			if (IntVal($MID)<=0)
				CForumTopic::Delete($TID);
		}
		if ($arFieldsParams["VOTE_ID"] > 0)
		{
			$arFields = Array(
				"FORUM_ID" => $FID,
				"TITLE"			=> GetMessage("F_FORUM_1_TOPIC_2_TITLE"),
				"DESCRIPTION"	=> GetMessage("F_FORUM_1_TOPIC_2_DESCRIPTION"),
				"ICON_ID"		=> 0,
				"TAGS"			=> GetMessage("F_FORUM_1_TOPIC_2_TAGS"),
				"USER_START_ID" => 1,
				"USER_START_NAME" => GetMessage("F_FORUM_1_TOPIC_2_AUTHOR"),
				"LAST_POSTER_NAME" => GetMessage("F_FORUM_1_TOPIC_2_AUTHOR"),
				"APPROVED" => "Y");
			$TID = intVal(CForumTopic::Add($arFields));
			if ($TID > 0)
			{
				$arFields = Array(
					"POST_MESSAGE"	=> GetMessage("F_FORUM_1_TOPIC_2_MESSAGE_1_POSTMESS"),
					"USE_SMILES"	=> "Y",
					"APPROVED"		=> "Y",
					"AUTHOR_NAME"	=> GetMessage("F_FORUM_1_TOPIC_2_AUTHOR"),
					"AUTHOR_EMAIL"	=> "",
					"AUTHOR_ID"		=> "1",
					"FORUM_ID"		=> $FID,
					"TOPIC_ID"		=> $TID,
					"AUTHOR_IP"	=> "SWAMP",
					"AUTHOR_REAL_IP"=> "SWAMP",
					"NEW_TOPIC"		=> "Y",
					"GUEST_ID"		=> 58,
					"PARAM1" 		=> "VT",
					"PARAM2" 		=> $arFieldsParams["VOTE_ID"]);
				$MID = CForumMessage::Add($arFields, false);
				if (IntVal($MID)<=0)
					CForumTopic::Delete($TID);
			}
		}
	}
endif;

// Forum № 2
if (in_array(GetMessage("F_FORUM_2_NAME"), $arForums)):
	foreach ($arForums as $key => $val):
		if ($val == GetMessage("F_FORUM_2_NAME")):
			$arReplaceForums[] = $key;
		endif;
	endforeach;
else:
	$arFields = Array(
		"NAME" => GetMessage("F_FORUM_2_NAME"),
		"DESCRIPTION" => GetMessage("F_FORUM_2_DECRIPTION"),
		"SORT" => 250,
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
		"ALLOW_NL2BR" => "N",
		"MODERATION" => "N",
		"ALLOW_MOVE_TOPIC" => "Y",
		"ORDER_BY" => "P",
		"ORDER_DIRECTION" => "DESC",
		"LID" => LANGUAGE_ID,
		"PATH2FORUM_MESSAGE" => "",
		"ALLOW_UPLOAD_EXT" => "",
		"FORUM_GROUP_ID" => $arGroup["PUBLIC"],
		"ASK_GUEST_EMAIL" => "N",
		"USE_CAPTCHA" => "Y",
		"SITES" => array(
			$SITE_ID => "/communication/forum/messages/forum#FID#/message#MID#/#TITLE_SEO#"),
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
	if ($FID > 0)
	{
		$arReplaceForums[] = $FID;
		$arFields = Array(
			"FORUM_ID" => $FID,
			"TITLE"			=> GetMessage("F_FORUM_2_TOPIC_1_TITLE"),
			"DESCRIPTION"	=> GetMessage("F_FORUM_2_TOPIC_1_DESCRIPTION"),
			"ICON_ID"		=> 0,
			"TAGS"			=> GetMessage("F_FORUM_2_TOPIC_1_TAGS"),
			"USER_START_ID" => 1,
			"USER_START_NAME" => GetMessage("F_FORUM_2_TOPIC_1_AUTHOR"),
			"LAST_POSTER_NAME" => GetMessage("F_FORUM_2_TOPIC_1_AUTHOR"),
			"APPROVED" => "Y");
		$TID = intVal(CForumTopic::Add($arFields));
		if ($TID > 0)
		{
			$arFields = Array(
				"POST_MESSAGE"	=> GetMessage("F_FORUM_2_TOPIC_1_MESSAGE_1_POSTMESS"),
				"USE_SMILES"	=> "Y",
				"APPROVED"		=> "Y",
				"AUTHOR_NAME"	=> GetMessage("F_FORUM_2_TOPIC_1_AUTHOR"),
				"AUTHOR_EMAIL"	=> "",
				"AUTHOR_ID"		=> "1",
				"FORUM_ID"		=> $FID,
				"TOPIC_ID"		=> $TID,
				"AUTHOR_IP"	=> "SWAMP",
				"AUTHOR_REAL_IP"=> "SWAMP",
				"NEW_TOPIC"		=> "Y",
				"GUEST_ID"		=> 58);
			$MID = CForumMessage::Add($arFields, false);
			if (IntVal($MID)<=0)
				CForumTopic::Delete($TID);
		}
	}
endif;

// Forum № 3
if (in_array(GetMessage("F_FORUM_3_NAME"), $arForums)):
	foreach ($arForums as $key => $val):
		if ($val == GetMessage("F_FORUM_3_NAME")):
			$arReplaceForums[] = $key;
		endif;
	endforeach;
else:
	$arFields = Array(
		"NAME" => GetMessage("F_FORUM_3_NAME"),
		"DESCRIPTION" => GetMessage("F_FORUM_3_DECRIPTION"),
		"SORT" => 200,
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
		"ALLOW_NL2BR" => "N",
		"MODERATION" => "N",
		"ALLOW_MOVE_TOPIC" => "Y",
		"ORDER_BY" => "P",
		"ORDER_DIRECTION" => "DESC",
		"LID" => LANGUAGE_ID,
		"PATH2FORUM_MESSAGE" => "",
		"ALLOW_UPLOAD_EXT" => "",
		"FORUM_GROUP_ID" => $arGroup["PARTNER"],
		"ASK_GUEST_EMAIL" => "N",
		"USE_CAPTCHA" => "Y",
		"SITES" => array(
			$SITE_ID => "/communication/forum/messages/forum#FID#/message#MID#/#TITLE_SEO#"),
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
	if ($FID > 0)
	{
		$arReplaceForums[] = $FID;
		$arFields = Array(
			"FORUM_ID" => $FID,
			"TITLE"			=> GetMessage("F_FORUM_3_TOPIC_1_TITLE"),
			"DESCRIPTION"	=> GetMessage("F_FORUM_3_TOPIC_1_DESCRIPTION"),
			"ICON_ID"		=> 0,
			"TAGS"			=> GetMessage("F_FORUM_3_TOPIC_1_TAGS"),
			"USER_START_ID" => 1,
			"USER_START_NAME" => GetMessage("F_FORUM_3_TOPIC_1_AUTHOR"),
			"LAST_POSTER_NAME" => GetMessage("F_FORUM_3_TOPIC_1_AUTHOR"),
			"APPROVED" => "Y");
		$TID = intVal(CForumTopic::Add($arFields));
		if ($TID > 0)
		{
			$arFields = Array(
				"POST_MESSAGE"	=> GetMessage("F_FORUM_3_TOPIC_1_MESSAGE_1_POSTMESS"),
				"USE_SMILES"	=> "Y",
				"APPROVED"		=> "Y",
				"AUTHOR_NAME"	=> GetMessage("F_FORUM_3_TOPIC_1_AUTHOR"),
				"AUTHOR_EMAIL"	=> "",
				"AUTHOR_ID"		=> "1",
				"FORUM_ID"		=> $FID,
				"TOPIC_ID"		=> $TID,
				"AUTHOR_IP"	=> "SWAMP",
				"AUTHOR_REAL_IP"=> "SWAMP",
				"NEW_TOPIC"		=> "Y",
				"GUEST_ID"		=> 58);
			$MID = CForumMessage::Add($arFields, false);
			if (IntVal($MID)<=0)
				CForumTopic::Delete($TID);
		}
	}
endif;

//Copy public files with "on the fly" translation
$source = "/public/forum/";
$target = "/communication/forum/";

$source_base = dirname(__FILE__);
$source_abs = $source_base.$source;
$source_abs = str_replace(array("\\", "//"), "/", $source_base.$source."/");
$target_abs = $_SERVER['DOCUMENT_ROOT'].$target;
if (!empty($arReplaceForums)):
	$tmp = array();
	$ii = 0;
	foreach ($arReplaceForums as $val):
		$tmp[] = "".$ii." => ".$val."";
		$ii++;
	endforeach;
	if (!empty($tmp)):
		$arFieldsParams["FORUMS_ID"] = implode(", ", $tmp);
	endif;
endif;
__CopyForumFiles($source_abs, $target_abs, false, $arFieldsParams);

$arFields = array(
	"CONDITION" => "#^/communication/forum/#",
	"RULE" => "",
	"ID" => "bitrix:forum",
	"PATH" => "/communication/forum/index.php");

CUrlRewriter::Add($arFields);

//Left menu
DemoSiteUtil::AddMenuItem("/communication/.left.menu.php", Array(
	GetMessage("F_FORUM"),
	"/communication/forum/",
	Array(),
	Array(),
	"",
));

//Communication section
include(dirname(__FILE__)."/../communication/install.php");

return true;
?>