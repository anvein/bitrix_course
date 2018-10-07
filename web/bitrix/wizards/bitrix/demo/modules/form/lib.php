<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
if(!CModule::IncludeModule('form'))
	return;

function __form_LoadMess($__current_file)
{
	$__current_dir = dirname($__current_file);
	$__current_file = basename($__current_file);
	
	$arMess = array();
	$dbLang = CLanguage::GetList($by = 'SORT', $order='ASC');

	while ($arLang = $dbLang->Fetch())
	{
		$arMess[$arLang['LID']] = __IncludeLang($__current_dir."/../lang/".$arLang['LID'].'/'.$__current_file, true);
	}

	return $arMess;
}
	
function __form_LoadTemplate($tpl_name, $__current_dir)
{
	$templateFile = $__current_dir.'/'.$tpl_name.".php"; 
	if (file_exists($templateFile))
	{
		$fp = fopen($templateFile, 'r');
		$tpl = fread($fp, filesize($templateFile));
		fclose($fp);
		
		return $tpl;
	}
	else
		return false;
}

function __form_CreateForm($SID, $__current_dir)
{
	// check collisions
	$dbTmpForm = CForm::GetBySID($SID);
	if ($arTmpForm = $dbTmpForm->Fetch())
	{
		return false;
	}
	
	//$dirName = ToLower($SID);
	
	$formConfigFile = $__current_dir.'/form.php'; 
	$fieldsConfigFile = $__current_dir.'/fields.php'; 
	
	// check config existence
	if (!file_exists($formConfigFile) || !file_exists($fieldsConfigFile))
	{
		return false;
	}
	
	// load form config
	$arForm = array();
	require($formConfigFile);

	// setup form
	if ($FORM_ID = CForm::Set($arForm, false, 'N'))
	{
		// load fields config
		$arFormFields = array();

		require($fieldsConfigFile);

		// setup form fields
		foreach ($arFormFields as $key => $arField)
		{
			CFormField::Set($arField, false, 'N');
		}
		
		$arStatus = array(
			'FORM_ID' => $FORM_ID,
			'TITLE' => 'DEFAULT',
			'CSORT' => 100,
			'ACTIVE' => 'Y',
			'DEFAULT_VALUE' => 'Y',
			'arPERMISSION_MOVE' => array(0),
		);
		
		CFormStatus::Set($arStatus, false, 'N');
	}
	
	return $FORM_ID;
}

function __form_CopyFiles($source_abs, $target, $bReWriteAdditionalFiles = false, $search = false, $replace = false)
{
	$source_base = dirname(__FILE__);
	//$source_abs = $source_base.$source;
	$target_abs = $_SERVER['DOCUMENT_ROOT'].$target;

	if(file_exists($source_abs) && is_dir($source_abs))
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
				if(is_dir($source_file))
					continue;
				$fh = fopen($source_file, "rb");
				$php_source = fread($fh, filesize($source_file));
				fclose($fh);
				//Replace real IDs
				if(is_array($search) && is_array($replace))
				{
					$php_source = str_replace($search, $replace, $php_source);
				}
				//Parse GetMessage("MESSAGE_ID") with double quotes
				if(preg_match_all('/GetMessage\("(.*?)"\)/', $php_source, $matches))
				{
					//Include LANGUAGE_ID file
					//__IncludeLang(GetLangFileName($source_base."/lang/", $source.$file));
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
				//Parse GetMessage('MESSAGE_ID') with single quotes
				//embedded html
				if(preg_match_all('/GetMessage\(\'(.*?)\'\)/', $php_source, $matches))
				{
					//Include LANGUAGE_ID file
					//__IncludeLang(GetLangFileName($source_base."/lang/", $source.$file));
					//Substite the stuff
					foreach($matches[0] as $i => $text)
					{
						$php_source = str_replace(
							$text,
							GetMessage($matches[1][$i]),
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

function __form_AddMenuItem($menuFile, $menuItem)
{
	if(CModule::IncludeModule('fileman'))
	{
		$arResult = CFileMan::GetMenuArray($_SERVER["DOCUMENT_ROOT"].$menuFile);
		$arMenuItems = $arResult["aMenuLinks"];
		$menuTemplate = $arResult["sMenuTemplate"];

		$bFound = false;
		foreach($arMenuItems as $item)
			if($item[1] == $menuItem[1])
				$bFound = true;

		if(!$bFound)
		{
			$arMenuItems[] = $menuItem;
			CFileMan::SaveMenu(Array($arParams["site_id"], $menuFile), $arMenuItems, $menuTemplate);
		}
	}
}
?>