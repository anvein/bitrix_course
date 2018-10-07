<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
if(!CModule::IncludeModule('search'))
	return;

__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", "/".basename(__FILE__)));

//Input parameters:
//public_rewrite - when set to Y will force public files overwite

//Set options which will overwrite defaults
COption::SetOptionString("search", "use_word_distance", "Y");
COption::SetOptionString("search", "use_social_rating", "Y");
COption::SetOptionString("search", "use_stemming", "Y");
COption::SetOptionString("search", "use_tf_cache", "Y");
COption::SetOptionString("search", "exclude_mask", "/bitrix/*;/404.php;/upload/*;/auth*;*/search*;*/tags*;/personal/*;/e-store/affiliates/*;/content/*/my/*;/examples/*;/map.php;*/detail.php;/communication/voting/*;/club/index.php");

//Copy public files with "on the fly" translation
$bReWriteAdditionalFiles = ($arParams["public_rewrite"] == "Y");

$source = "/public/search/";
$target = "/search/";

$source_base = dirname(__FILE__);
$source_abs = $source_base.$source;
$target_abs = $_SERVER['DOCUMENT_ROOT'].$target;

if(file_exists($source_abs))
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
?>