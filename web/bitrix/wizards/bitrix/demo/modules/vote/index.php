<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)
	die();
if(!CModule::IncludeModule('vote'))
	return;
__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", '/'.basename(__FILE__)));


if (!is_object($DB))
	global $DB;
global $CACHE_MANAGER;
$CACHE_MANAGER->CleanDir("b_vote_channel");
$CACHE_MANAGER->Clean("b_vote_channel_2_site");

$arFieldsVC = array(
	"TIMESTAMP_X"		=> $DB->GetNowFunction(),
	"C_SORT"			=> "'100'",
	"FIRST_SITE_ID"		=> "'s1'",
	"ACTIVE"			=> "'Y'",
	"VOTE_SINGLE"		=> "'Y'",
	"TITLE"				=> "'".$DB->ForSql(GetMessage('VOTING_INSTALL_CHANNEL_ANKETA'))."'",
	"SYMBOLIC_NAME"		=> "'ANKETA'");

$rsVoteChan = CVoteChannel::GetList($by, $order, array('SYMBOLIC_NAME' => 'ANKETA', 'SYMBOLIC_NAME_EXACT_MATCH' => 'Y'), $is_filtered);
if (!$rsVoteChan->Fetch())
{
	$ID = $DB->Insert("b_vote_channel", $arFieldsVC);
	if ($ID > 0)
	{
		$CACHE_MANAGER->CleanDir("b_vote_perm_".$ID);

		//site
		$DB->Query("DELETE FROM b_vote_channel_2_site WHERE CHANNEL_ID='".$ID."'", false);
		$DB->Query("INSERT INTO b_vote_channel_2_site (CHANNEL_ID, SITE_ID) VALUES ($ID, 's1')", false);

		//groups
		$DB->Query("DELETE FROM b_vote_channel_2_group WHERE CHANNEL_ID='$ID'", false);
		$rsGroups = CGroup::GetList($by, $order, array());
		while ($arGroup = $rsGroups->Fetch())
		{
			$arFieldsPerm = array(
				"CHANNEL_ID"	=> "'".intval($ID)."'",
				"GROUP_ID"		=> "'".intval($arGroup["ID"])."'",
				"PERMISSION"	=> "'2'"
			);
			$DB->Insert("b_vote_channel_2_group", $arFieldsPerm);
		}

		$arFieldsVote = array(
			"CHANNEL_ID"		=> "'".$ID."'",
			"C_SORT"			=> "'100'",
			"ACTIVE"			=> "'Y'",
			"TIMESTAMP_X"		=> $DB->GetNowFunction(),
			"DATE_START"		=> $DB->CharToDateFunction(GetTime(mktime(0,0,0,1,1,2000),"FULL")),
			"DATE_END"			=> $DB->CharToDateFunction(GetTime(mktime(23,59,59,12,31,2030),"FULL")),
			"TITLE"				=> "'".$DB->ForSql(GetMessage('VOTING_INSTALL_VOTE_ANKETA_TITLE'))."'",
			"DESCRIPTION"		=> "NULL",
			"DESCRIPTION_TYPE"	=> "'html'",
			"EVENT1"			=> "'vote'",
			"EVENT2"			=> "'anketa'",
			"EVENT3"			=> "NULL",
			"UNIQUE_TYPE"		=> "'1'",
			"KEEP_IP_SEC"		=> "'0'",
			"TEMPLATE"			=> "'default.php'",
			"RESULT_TEMPLATE"	=> "'default.php'",
			"NOTIFY"			=> "'N'"
			);

		$VOTE_ID = $DB->Insert("b_vote", $arFieldsVote);

		$arFieldsQuest = array(
			"TIMESTAMP_X"		=> $DB->GetNowFunction(),
			"C_SORT"			=> "'100'",
			"ACTIVE"			=> "'Y'",
			'QUESTION_TYPE'		=> "'text'",
			'DIAGRAM'			=> "'Y'",
			'DIAGRAM_TYPE'		=> "'histogram'",
			'VOTE_ID'			=> "'$VOTE_ID'",
			'QUESTION'			=> "'".$DB->ForSql(GetMessage('VOTING_INSTALL_VOTE_QUESTION1'))."'",
			'COUNTER'			=> "'0'",
		);

		$Q_ID = $DB->Insert("b_vote_question", $arFieldsQuest);

		$arAnswers = array(
			array(
				'C_SORT' => "'100'",
				'MESSAGE' => "'".$DB->ForSql(GetMessage('VOTING_INSTALL_VOTE_ANSWER1_1'))."'",
				'FIELD_TYPE' => "'0'",
				'COLOR' => "'".$DB->ForSql('#66FF00')."'",
				'QUESTION_ID' => "'$Q_ID'",
				"TIMESTAMP_X" => $DB->GetNowFunction(),
				"ACTIVE" => "'Y'",
				'FIELD_WIDTH' => "'0'",
				'FIELD_HEIGHT' => "'0'",
			),
			array(
				'C_SORT' => "'200'",
				'MESSAGE' => "'".$DB->ForSql(GetMessage('VOTING_INSTALL_VOTE_ANSWER1_2'))."'",
				'FIELD_TYPE' => "'0'",
				'COLOR' => "'".$DB->ForSql('#3333FF')."'",
				'QUESTION_ID' => "'$Q_ID'",
				"TIMESTAMP_X" => $DB->GetNowFunction(),
				"ACTIVE" => "'Y'",
				'FIELD_WIDTH' => "'0'",
				'FIELD_HEIGHT' => "'0'",
			),
			array(
				'C_SORT' => "'300'",
				'MESSAGE' => "'".$DB->ForSql(GetMessage('VOTING_INSTALL_VOTE_ANSWER1_3'))."'",
				'FIELD_TYPE' => "'0'",
				'COLOR' => "'".$DB->ForSql('#FF3300')."'",
				'QUESTION_ID' => "'$Q_ID'",
				"TIMESTAMP_X" => $DB->GetNowFunction(),
				"ACTIVE" => "'Y'",
				'FIELD_WIDTH' => "'0'",
				'FIELD_HEIGHT' => "'0'",
			),
			array(
				'C_SORT' => "'400'",
				'MESSAGE' => "'".$DB->ForSql(GetMessage('VOTING_INSTALL_VOTE_ANSWER1_4'))."'",
				'FIELD_TYPE' => "'0'",
				'COLOR' => "'".$DB->ForSql('#FFFF00')."'",
				'QUESTION_ID' => "'$Q_ID'",
				"TIMESTAMP_X" => $DB->GetNowFunction(),
				"ACTIVE" => "'Y'",
				'FIELD_WIDTH' => "'0'",
				'FIELD_HEIGHT' => "'0'",
			),
			array(
				'C_SORT' => "'500'",
				'MESSAGE' => "'".$DB->ForSql(GetMessage('VOTING_INSTALL_VOTE_ANSWER1_5'))."'",
				'FIELD_TYPE' => "'0'",
				'COLOR' => "'".$DB->ForSql('#339966')."'",
				'QUESTION_ID' => "'$Q_ID'",
				"TIMESTAMP_X" => $DB->GetNowFunction(),
				"ACTIVE" => "'Y'",
				'FIELD_WIDTH' => "'0'",
				'FIELD_HEIGHT' => "'0'",
			),
		);

		foreach ($arAnswers as $answ)
		{
			$DB->Insert("b_vote_answer", $answ);
		}

		$arFieldsQuest = array(
			"TIMESTAMP_X"		=> $DB->GetNowFunction(),
			"C_SORT"			=> "'300'",
			"ACTIVE"			=> "'Y'",
			'QUESTION_TYPE'		=> "'text'",
			'DIAGRAM'			=> "'Y'",
			'DIAGRAM_TYPE'		=> "'circle'",
			'VOTE_ID'			=> "'$VOTE_ID'",
			'QUESTION'			=> "'".$DB->ForSql(GetMessage('VOTING_INSTALL_VOTE_QUESTION2'))."'",
			'COUNTER'			=> "'0'",
		);

		$Q_ID = $DB->Insert("b_vote_question", $arFieldsQuest);

		$arAnswers = array(
			array(
				'C_SORT' => "'100'",
				'MESSAGE' => "'".$DB->ForSql(GetMessage('VOTING_INSTALL_VOTE_ANSWER2_1'))."'",
				'FIELD_TYPE' => "'1'",
				'COLOR' => "'".$DB->ForSql('#66CC00')."'",
				'QUESTION_ID' => "'$Q_ID'",
				"TIMESTAMP_X" => $DB->GetNowFunction(),
				"ACTIVE" => "'Y'",
				'FIELD_WIDTH' => "'0'",
				'FIELD_HEIGHT' => "'0'",
			),
			array(
				'C_SORT' => "'200'",
				'MESSAGE' => "'".$DB->ForSql(GetMessage('VOTING_INSTALL_VOTE_ANSWER2_2'))."'",
				'FIELD_TYPE' => "'1'",
				'COLOR' => "'".$DB->ForSql('#FFFF00')."'",
				'QUESTION_ID' => "'$Q_ID'",
				"TIMESTAMP_X" => $DB->GetNowFunction(),
				"ACTIVE" => "'Y'",
				'FIELD_WIDTH' => "'0'",
				'FIELD_HEIGHT' => "'0'",
			),
			array(
				'C_SORT' => "'300'",
				'MESSAGE' => "'".$DB->ForSql(GetMessage('VOTING_INSTALL_VOTE_ANSWER2_3'))."'",
				'FIELD_TYPE' => "'1'",
				'COLOR' => "'".$DB->ForSql('#FF6600')."'",
				'QUESTION_ID' => "'$Q_ID'",
				"TIMESTAMP_X" => $DB->GetNowFunction(),
				"ACTIVE" => "'Y'",
				'FIELD_WIDTH' => "'0'",
				'FIELD_HEIGHT' => "'0'",
			),
			array(
				'C_SORT' => "'400'",
				'MESSAGE' => "'".$DB->ForSql(GetMessage('VOTING_INSTALL_VOTE_ANSWER2_4'))."'",
				'FIELD_TYPE' => "'1'",
				'COLOR' => "'".$DB->ForSql('#6666FF')."'",
				'QUESTION_ID' => "'$Q_ID'",
				"TIMESTAMP_X" => $DB->GetNowFunction(),
				"ACTIVE" => "'Y'",
				'FIELD_WIDTH' => "'0'",
				'FIELD_HEIGHT' => "'0'",
			),
			array(
				'C_SORT' => "'500'",
				'MESSAGE' => "'".$DB->ForSql(GetMessage('VOTING_INSTALL_VOTE_ANSWER2_5'))."'",
				'FIELD_TYPE' => "'4'",
				'COLOR' => "'".$DB->ForSql('#FFCC66')."'",
				'QUESTION_ID' => "'$Q_ID'",
				"TIMESTAMP_X" => $DB->GetNowFunction(),
				"ACTIVE" => "'Y'",
				'FIELD_WIDTH' => "'20'",
				'FIELD_HEIGHT' => "'0'",
			),
		);

		foreach ($arAnswers as $answ)
		{
			$DB->Insert("b_vote_answer", $answ);
		}
	}
}

$arFieldsVC = array(
	"TIMESTAMP_X"		=> $DB->GetNowFunction(),
	"C_SORT"			=> "'100'",
	"FIRST_SITE_ID"		=> "'s1'",
	"ACTIVE"			=> "'Y'",
	"VOTE_SINGLE"		=> "'Y'",
	"TITLE"				=> "'".$DB->ForSql(GetMessage('VOTING_INSTALL_CHANNEL_BOOKS_VOTE'))."'",
	"SYMBOLIC_NAME"		=> "'BOOKS_VOTE'");

$rsVoteChan = CVoteChannel::GetList($by, $order, array('SYMBOLIC_NAME' => 'BOOKS_VOTE', 'SYMBOLIC_NAME_EXACT_MATCH' => 'Y'), $is_filtered);
if (!$rsVoteChan->Fetch())
{
	$ID = $DB->Insert("b_vote_channel", $arFieldsVC);
	if ($ID > 0)
	{
		$CACHE_MANAGER->CleanDir("b_vote_perm_".$ID);

		//site
		$DB->Query("DELETE FROM b_vote_channel_2_site WHERE CHANNEL_ID='".$ID."'", false);
		$DB->Query("INSERT INTO b_vote_channel_2_site (CHANNEL_ID, SITE_ID) VALUES ($ID, 's1')", false);

		//groups
		$DB->Query("DELETE FROM b_vote_channel_2_group WHERE CHANNEL_ID='$ID'", false);
		$rsGroups = CGroup::GetList($by, $order, array());
		while ($arGroup = $rsGroups->Fetch())
		{
			$arFieldsPerm = array(
				"CHANNEL_ID"	=> "'".intval($ID)."'",
				"GROUP_ID"		=> "'".intval($arGroup["ID"])."'",
				"PERMISSION"	=> "'2'"
			);
			$DB->Insert("b_vote_channel_2_group", $arFieldsPerm);
		}

		$arFieldsVote = array(
			"CHANNEL_ID"		=> "'".$ID."'",
			"C_SORT"			=> "'100'",
			"ACTIVE"			=> "'Y'",
			"TIMESTAMP_X"		=> $DB->GetNowFunction(),
			"DATE_START"		=> $DB->CharToDateFunction(GetTime(mktime(0,0,0,1,1,2000),"FULL")),
			"DATE_END"			=> $DB->CharToDateFunction(GetTime(mktime(23,59,59,12,31,2030),"FULL")),
			"TITLE"				=> "'".$DB->ForSql(GetMessage('VOTING_INSTALL_VOTE_BOOKS_VOTE_TITLE'))."'",
			"DESCRIPTION"		=> "NULL",
			"DESCRIPTION_TYPE"	=> "'html'",
			"EVENT1"			=> "'vote'",
			"EVENT2"			=> "'books_vote'",
			"EVENT3"			=> "NULL",
			"UNIQUE_TYPE"		=> "'2'",
			"KEEP_IP_SEC"		=> "'0'",
			"NOTIFY"			=> "'N'"
			);

		$VOTE_ID = $DB->Insert("b_vote", $arFieldsVote);

		$arFieldsQuest = array(
			"TIMESTAMP_X"		=> $DB->GetNowFunction(),
			"C_SORT"			=> "'100'",
			"ACTIVE"			=> "'Y'",
			'QUESTION_TYPE'		=> "'text'",
			'DIAGRAM'			=> "'Y'",
			'DIAGRAM_TYPE'		=> "'histogram'",
			'VOTE_ID'			=> "'$VOTE_ID'",
			'QUESTION'			=> "'".$DB->ForSql(GetMessage('VOTING_INSTALL_VOTE_QUESTION3'))."'",
			'COUNTER'			=> "'0'",
		);

		$Q_ID = $DB->Insert("b_vote_question", $arFieldsQuest);

		for ($i = 1; $i <= 8; $i++)
		{
			$answ = array(
				'C_SORT' => "'".($i*100)."'",
				'MESSAGE' => "'".$DB->ForSql(GetMessage('VOTING_INSTALL_VOTE_ANSWER3_' . $i))."'",
				'FIELD_TYPE' => "'0'",
				'QUESTION_ID' => "'$Q_ID'",
				"TIMESTAMP_X" => $DB->GetNowFunction(),
				"ACTIVE" => "'Y'",
				'FIELD_WIDTH' => "'0'",
				'FIELD_HEIGHT' => "'0'",
			);
			$DB->Insert("b_vote_answer", $answ);
		}
	}
}

$arFieldsVC = array(
	"TIMESTAMP_X"		=> $DB->GetNowFunction(),
	"C_SORT"			=> "'200'",
	"FIRST_SITE_ID"		=> "'s1'",
	"ACTIVE"			=> "'Y'",
	"VOTE_SINGLE"		=> "'N'",
	"TITLE"				=> "'".$DB->ForSql(GetMessage('VOTING_INSTALL_CHANNEL_FORUM'))."'",
	"SYMBOLIC_NAME"		=> "'FORUM'");

$rsVoteChan = CVoteChannel::GetList($by, $order, array('SYMBOLIC_NAME' => 'FORUM', 'SYMBOLIC_NAME_EXACT_MATCH' => 'Y'), $is_filtered);
if (!$rsVoteChan->Fetch())
{
	$ID = $DB->Insert("b_vote_channel", $arFieldsVC);
	if ($ID > 0)
	{
		$CACHE_MANAGER->CleanDir("b_vote_perm_".$ID);

		//site
		$DB->Query("DELETE FROM b_vote_channel_2_site WHERE CHANNEL_ID='".$ID."'", false);
		$DB->Query("INSERT INTO b_vote_channel_2_site (CHANNEL_ID, SITE_ID) VALUES ($ID, 's1')", false);

		//groups
		$DB->Query("DELETE FROM b_vote_channel_2_group WHERE CHANNEL_ID='$ID'", false);
		$rsGroups = CGroup::GetList($by, $order, array());
		while ($arGroup = $rsGroups->Fetch())
		{
			$arFieldsPerm = array(
				"CHANNEL_ID"	=> "'".intval($ID)."'",
				"GROUP_ID"		=> "'".intval($arGroup["ID"])."'",
				"PERMISSION"	=> "'2'");
			$DB->Insert("b_vote_channel_2_group", $arFieldsPerm);
		}

		$arFieldsVote = array(
			"CHANNEL_ID"		=> "'".$ID."'",
			"C_SORT"			=> "'100'",
			"ACTIVE"			=> "'Y'",
			"TIMESTAMP_X"		=> $DB->GetNowFunction(),
			"DATE_START"		=> $DB->CharToDateFunction(GetTime(mktime(0,0,0,1,1,2009),"FULL")),
			"DATE_END"			=> $DB->CharToDateFunction(GetTime(mktime(23,59,59,12,31,2030),"FULL")),
			"TITLE"				=> "'".$DB->ForSql(GetMessage('VOTING_INSTALL_VOTE_FORUM_TITLE'))."'",
			"DESCRIPTION"		=> "NULL",
			"DESCRIPTION_TYPE"	=> "'html'",
			"EVENT1"			=> "'vote'",
			"EVENT2"			=> "'forum'",
			"EVENT3"			=> "NULL",
			"UNIQUE_TYPE"		=> "'1'",
			"KEEP_IP_SEC"		=> "'0'",
			"TEMPLATE"			=> "'default.php'",
			"RESULT_TEMPLATE"	=> "'default.php'",
			"NOTIFY"			=> "'N'"
			);

		$VOTE_ID = $DB->Insert("b_vote", $arFieldsVote);

		$arFieldsQuest = array(
			"TIMESTAMP_X"		=> $DB->GetNowFunction(),
			"C_SORT"			=> "'100'",
			"ACTIVE"			=> "'Y'",
			'QUESTION_TYPE'		=> "'text'",
			'DIAGRAM'			=> "'Y'",
			'DIAGRAM_TYPE'		=> "'histogram'",
			'VOTE_ID'			=> "'$VOTE_ID'",
			'QUESTION'			=> "'".$DB->ForSql(GetMessage('VOTING_INSTALL_VOTE_FORUM_QUESTION1'))."'",
			'COUNTER'			=> "'0'",
		);

		$Q_ID = $DB->Insert("b_vote_question", $arFieldsQuest);

		$arAnswers = array(
			array(
				'C_SORT' => "'100'",
				'MESSAGE' => "'".$DB->ForSql(GetMessage('VOTING_INSTALL_VOTE_FORUM_ANSWER1_1'))."'",
				'FIELD_TYPE' => "'0'",
				'COLOR' => "'".$DB->ForSql('#66FF00')."'",
				'QUESTION_ID' => "'$Q_ID'",
				"TIMESTAMP_X" => $DB->GetNowFunction(),
				"ACTIVE" => "'Y'",
				'FIELD_WIDTH' => "'0'",
				'FIELD_HEIGHT' => "'0'",
			),
			array(
				'C_SORT' => "'200'",
				'MESSAGE' => "'".$DB->ForSql(GetMessage('VOTING_INSTALL_VOTE_FORUM_ANSWER1_2'))."'",
				'FIELD_TYPE' => "'0'",
				'COLOR' => "'".$DB->ForSql('#3333FF')."'",
				'QUESTION_ID' => "'$Q_ID'",
				"TIMESTAMP_X" => $DB->GetNowFunction(),
				"ACTIVE" => "'Y'",
				'FIELD_WIDTH' => "'0'",
				'FIELD_HEIGHT' => "'0'",
			),
			array(
				'C_SORT' => "'300'",
				'MESSAGE' => "'".$DB->ForSql(GetMessage('VOTING_INSTALL_VOTE_FORUM_ANSWER1_3'))."'",
				'FIELD_TYPE' => "'0'",
				'COLOR' => "'".$DB->ForSql('#FF3300')."'",
				'QUESTION_ID' => "'$Q_ID'",
				"TIMESTAMP_X" => $DB->GetNowFunction(),
				"ACTIVE" => "'Y'",
				'FIELD_WIDTH' => "'0'",
				'FIELD_HEIGHT' => "'0'",
			),
			array(
				'C_SORT' => "'400'",
				'MESSAGE' => "'".$DB->ForSql(GetMessage('VOTING_INSTALL_VOTE_FORUM_ANSWER1_4'))."'",
				'FIELD_TYPE' => "'0'",
				'COLOR' => "'".$DB->ForSql('#FFFF00')."'",
				'QUESTION_ID' => "'$Q_ID'",
				"TIMESTAMP_X" => $DB->GetNowFunction(),
				"ACTIVE" => "'Y'",
				'FIELD_WIDTH' => "'0'",
				'FIELD_HEIGHT' => "'0'",
			),
		);

		foreach ($arAnswers as $answ)
		{
			$DB->Insert("b_vote_answer", $answ);
		}

		$arFieldsQuest = array(
			"TIMESTAMP_X"		=> $DB->GetNowFunction(),
			"C_SORT"			=> "'300'",
			"ACTIVE"			=> "'Y'",
			'QUESTION_TYPE'		=> "'text'",
			'DIAGRAM'			=> "'Y'",
			'DIAGRAM_TYPE'		=> "'circle'",
			'VOTE_ID'			=> "'$VOTE_ID'",
			'QUESTION'			=> "'".$DB->ForSql(GetMessage('VOTING_INSTALL_VOTE_FORUM_QUESTION2'))."'",
			'COUNTER'			=> "'0'",
		);

		$Q_ID = $DB->Insert("b_vote_question", $arFieldsQuest);

		$arAnswers = array(
			array(
				'C_SORT' => "'100'",
				'MESSAGE' => "'".$DB->ForSql(GetMessage('VOTING_INSTALL_VOTE_FORUM_ANSWER2_1'))."'",
				'FIELD_TYPE' => "'1'",
				'COLOR' => "'".$DB->ForSql('#66CC00')."'",
				'QUESTION_ID' => "'$Q_ID'",
				"TIMESTAMP_X" => $DB->GetNowFunction(),
				"ACTIVE" => "'Y'",
				'FIELD_WIDTH' => "'0'",
				'FIELD_HEIGHT' => "'0'",
			),
			array(
				'C_SORT' => "'200'",
				'MESSAGE' => "'".$DB->ForSql(GetMessage('VOTING_INSTALL_VOTE_FORUM_ANSWER2_2'))."'",
				'FIELD_TYPE' => "'1'",
				'COLOR' => "'".$DB->ForSql('#FFFF00')."'",
				'QUESTION_ID' => "'$Q_ID'",
				"TIMESTAMP_X" => $DB->GetNowFunction(),
				"ACTIVE" => "'Y'",
				'FIELD_WIDTH' => "'0'",
				'FIELD_HEIGHT' => "'0'",
			),
			array(
				'C_SORT' => "'300'",
				'MESSAGE' => "'".$DB->ForSql(GetMessage('VOTING_INSTALL_VOTE_FORUM_ANSWER2_3'))."'",
				'FIELD_TYPE' => "'1'",
				'COLOR' => "'".$DB->ForSql('#FF6600')."'",
				'QUESTION_ID' => "'$Q_ID'",
				"TIMESTAMP_X" => $DB->GetNowFunction(),
				"ACTIVE" => "'Y'",
				'FIELD_WIDTH' => "'0'",
				'FIELD_HEIGHT' => "'0'",
			),
			array(
				'C_SORT' => "'400'",
				'MESSAGE' => "'".$DB->ForSql(GetMessage('VOTING_INSTALL_VOTE_FORUM_ANSWER2_4'))."'",
				'FIELD_TYPE' => "'1'",
				'COLOR' => "'".$DB->ForSql('#6666FF')."'",
				'QUESTION_ID' => "'$Q_ID'",
				"TIMESTAMP_X" => $DB->GetNowFunction(),
				"ACTIVE" => "'Y'",
				'FIELD_WIDTH' => "'0'",
				'FIELD_HEIGHT' => "'0'",
			)
		);

		foreach ($arAnswers as $answ)
		{
			$DB->Insert("b_vote_answer", $answ);
		}
	}
}

$pathToService = str_replace("\\", "/", dirname(__FILE__));

//Public files
CopyDirFiles(
	$pathToService."/public/".LANGUAGE_ID,
	$_SERVER["DOCUMENT_ROOT"]."/communication/voting",
	$rewrite = false,
	$recursive = true
);

$strIndexIncVote = '<div class="information-block">
  <div class="information-block-head">'.GetMessage('VOTING_INSTALL_II_VOTE').'</div>
 	<?$APPLICATION->IncludeComponent(
	"bitrix:voting.current",
	"main_page",
	Array(
		"CHANNEL_SID" => "ANKETA",
		"CACHE_TYPE"	=>	"A",
		"CACHE_TIME"	=>	"3600",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "Y",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
	)
);?> </div>';


CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/index_inc.php", array('<!--VOTE_FORM-->' => $strIndexIncVote), $skipSharp = true);

$strBooksIndexIncVote = '<div class="information-block"><?$APPLICATION->IncludeComponent(
	"bitrix:voting.current",
	"main_page",
	Array(
		"CHANNEL_SID" => "BOOKS_VOTE",
		"CACHE_TYPE"	=>	"A",
		"CACHE_TIME"	=>	"3600",
	)
);?> </div>';


CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/e-store/books/index_inc.php", array('<!--VOTE_FORM-->' => $strBooksIndexIncVote), $skipSharp = true);

DemoSiteUtil::AddMenuItem('/communication/.left.menu.php', Array(
		GetMessage('VOTING_INSTALL_MENU_ITEM'),
		'/communication/voting/',
		Array(),
		Array(),
		''
));

//Communication section
include(dirname(__FILE__)."/../communication/install.php");
?>
