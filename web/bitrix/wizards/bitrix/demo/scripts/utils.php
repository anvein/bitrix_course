<?
class DemoSiteUtil
{
	public static function GetServices($servicePath, $arFilter = Array())
	{
		$arServices = Array();
		include($servicePath.".services.php");

		if (empty($arServices))
			return $arServices;

		$servicePosition = 1;
		foreach ($arServices as $serviceID => $arService)
		{
			if (isset($arFilter["SKIP_INSTALL_ONLY"]) && array_key_exists("INSTALL_ONLY", $arService) && $arService["INSTALL_ONLY"] == $arFilter["SKIP_INSTALL_ONLY"])
			{
				unset($arServices[$serviceID]);
				continue;
			}

			if (isset($arFilter["SERVICES"]) && is_array($arFilter["SERVICES"]) && !in_array($serviceID, $arFilter["SERVICES"]) && !array_key_exists("INSTALL_ONLY", $arService))
			{
				unset($arServices[$serviceID]);
				continue;
			}

			//Check service dependencies
			$modulesCheck = Array($serviceID);
			if (array_key_exists("MODULE_ID", $arService))
				$modulesCheck = (is_array($arService["MODULE_ID"]) ? $arService["MODULE_ID"] : Array($arService["MODULE_ID"]));

			foreach ($modulesCheck as $moduleID)
			{
				if (!IsModuleInstalled($moduleID))
				{
					unset($arServices[$serviceID]);
					continue 2;
				}
			}

			$arServices[$serviceID]["POSITION"] = $servicePosition;
			$servicePosition += (isset($arService["STAGES"]) && !empty($arService["STAGES"]) ? count($arService["STAGES"]) : 1);
		}

		return $arServices;
	}

	public static function GetSelectedServices($string)
	{
		$arServices = Array();
		$arRootCnt = Array();

		if (strlen($string) <= 0)
			return $arServices;

		$arItems = explode(";", $string);
		foreach ($arItems as $itemPathID)
		{
			if (strlen($itemPathID) <= 0)
				continue;

			@list($itemID, $rootPathID) = explode(":", $itemPathID);

			if ( ($position = strrpos($itemID, "-")) !== false)
				$itemID = substr($itemID, $position+1);

			if ($rootPathID)
			{
				if ( ($position = strrpos($rootPathID, "-")) !== false)
					$rootPathID = substr($rootPathID, $position+1);

				if (array_key_exists($rootPathID, $arRootCnt))
					$rootPathID .= $arRootCnt[$rootPathID];

				$itemPath = "/".$rootPathID."/".$itemID;
			}
			else
			{
				if (array_key_exists($itemID, $arRootCnt))
					$arRootCnt[$itemID] += 1;
				else
					$arRootCnt[$itemID] = "";

				$itemPath = "/".$itemID.$arRootCnt[$itemID];
			}

			if (!array_key_exists($itemID, $arServices))
				$arServices[$itemID] = Array();

			$number = 1;
			$currentItemPath = $itemPath;
			while (array_search($currentItemPath, $arServices[$itemID]) !== false)
				$currentItemPath = $itemPath.$number++;

			$arServices[$itemID][] = $currentItemPath;
		}

		return $arServices;
	}


	public static function GetThemes($themePath)
	{
		$arThemes = Array();

		if (!is_dir($themePath))
			return $arThemes;

		if ($handle = @opendir($themePath))
		{
			while (($file = readdir($handle)) !== false)
			{
				if ($file == "." || $file == ".." || !is_dir($themePath."/".$file))
					continue;

				$arTemplate = Array();
				if (is_file($themePath."/".$file."/description.php"))
					@include($themePath."/".$file."/description.php");

				$arThemes[$file] = $arTemplate + Array(
					"ID" => $file,
					"SORT" => (isset($arTemplate["SORT"]) && intval($arTemplate["SORT"]) > 0 ? intval($arTemplate["SORT"]) : 10),
					"NAME" => (isset($arTemplate["NAME"]) ? $arTemplate["NAME"] : $file),
					"PREVIEW" => (file_exists($themePath."/".$file."/preview.gif")),
					"SCREENSHOT" => (file_exists($themePath."/".$file."/screen.gif")),
				);
			}
			@closedir($handle);
		}

		uasort($arThemes, Array("DemoSiteUtil", "__SortTheme"));
		return $arThemes;
	}

	public static function __SortTheme($a, $b)
	{
		if ($a["SORT"] > $b["SORT"])
			return 1;
		elseif ($a["SORT"] < $b["SORT"])
			return -1;
		else
			return 0;
	}

	public static function SetFilePermission($path, $permissions)
	{
		$originalPath = $path;

		CMain::InitPathVars($site, $path);
		$documentRoot = CSite::GetSiteDocRoot($site);

		$path = rtrim($path, "/");

		if (strlen($path) <= 0)
			$path = "/";

		if( ($position = strrpos($path, "/")) !== false)
		{
			$pathFile = substr($path, $position+1);
			$pathDir = substr($path, 0, $position);
		}
		else
			return false;

		if ($pathFile == "" && $pathDir == "")
			$pathFile = "/";

		$PERM = Array();
		if(file_exists($documentRoot.$pathDir."/.access.php"))
			@include($documentRoot.$pathDir."/.access.php");

		if (!isset($PERM[$pathFile]) || !is_array($PERM[$pathFile]))
			$arPermisson = $permissions;
		else
			$arPermisson = $PERM[$pathFile] + $permissions;

		return $GLOBALS["APPLICATION"]->SetFileAccessPermission($originalPath, $arPermisson);
	}

	public static function AddMenuItem($menuFile, $menuItem)
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
				CFileMan::SaveMenu(Array("s1", $menuFile), $arMenuItems, $menuTemplate);
			}
		}
	}

	public static function GetTemplatesPath($wizardPath)
	{
		$templatesPath = $wizardPath."/templates";

		if (file_exists($_SERVER["DOCUMENT_ROOT"].$templatesPath."/".LANGUAGE_ID))
			$templatesPath .= "/".LANGUAGE_ID;

		return $templatesPath;
	}

	public static function SetUserOption($category, $option, $settings, $common = false, $userID = false)
	{
		global $DBType;
		require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/classes/".strtolower($DBType)."/favorites.php");

		CUserOptions::SetOption(
			$category, 
			$option, 
			$settings, 
			$common, 
			$userID
		);
	}
}
