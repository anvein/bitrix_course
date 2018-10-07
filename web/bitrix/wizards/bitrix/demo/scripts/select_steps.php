<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

require_once("utils.php");

class CustomizeSiteTheme extends CWizardStep
{
	function InitStep()
	{
		$this->SetTitle(GetMessage("DEMO_SITE_SELECT_THEME_TITLE"));
		$this->SetSubTitle(GetMessage("DEMO_SITE_SELECT_THEME_SUBTITLE"));
		$this->SetNextStep("customize_data");
		$this->SetStepID("customize_theme");
	}

	function OnPostForm()
	{
		$wizard =& $this->GetWizard();
		$templateID = $wizard->GetSiteTemplateID();

		$themeVarName = $templateID."_themeID";
		$themeID = $wizard->GetVar($themeVarName);

		$themePath = $_SERVER["DOCUMENT_ROOT"].DemoSiteUtil::GetTemplatesPath($wizard->GetPath())."/".$templateID."/themes";

		if (strlen($themeID) <= 0 || !array_key_exists($themeID, DemoSiteUtil::GetThemes($themePath)))
			$this->SetError(GetMessage("DEMO_SITE_SELECT_THEME_ERROR"), $themeVarName);
	}

	function ShowStep()
	{
		$wizard =& $this->GetWizard();
		$templateID = $wizard->GetSiteTemplateID();

		$themePath = DemoSiteUtil::GetTemplatesPath($wizard->GetPath())."/".$templateID."/themes";
		$arThemes = DemoSiteUtil::GetThemes($_SERVER["DOCUMENT_ROOT"].$themePath);

		$this->content .= '<table cellspacing="0" cellpadding="2" width="540"><tr>';

		$colsNumber = 3;
		$counter = 1;
		$cellSize = count($arThemes);


		foreach ($arThemes as $arTheme)
		{
			$path = $themePath."/".$arTheme["ID"];

			$this->content .= '<td valign="top" style="padding-bottom:0px;" width="33%">';

			if ($arTheme["SCREENSHOT"] && $arTheme["PREVIEW"])
				$this->content .= CFile::Show2Images($path."/preview.gif", $path."/screen.gif", 150, 150, ' border="0"')."<br />";
			else
				$this->content .= CFile::ShowImage($path."/screen.gif", 150, 150, ' border="0"', "", true)."<br />";

			$themeVarName = $templateID."_themeID";

			if (isset($arTheme["DEFAULT"]) && $arTheme["DEFAULT"] == "Y")
				$wizard->SetDefaultVar($themeVarName,$arTheme["ID"]);

			$this->content .= '<table><tr><td valign="top">';
			$this->content .= $this->ShowRadioField($themeVarName, $arTheme["ID"], Array("id" => $arTheme["ID"]));
			$this->content .= '</td><td>';
			$this->content .= '<label for="'.$arTheme["ID"].'">';
			$this->content .= $arTheme["NAME"];
			$this->content .= '</label>';
			$this->content .= '</td></tr></table>';

			$this->content .= "</td>";

			//Close table cells
			if (!($counter % $colsNumber) && $cellSize != $counter)
				$this->content .= "</tr><tr>";

			if ($cellSize == $counter && ($cellSize % $colsNumber)>0)
			{
				for ($a=1;$a<=($colsNumber - ($cellSize % $colsNumber) );$a++)
					$this->content .= "<td>&nbsp;</td>";
			}

			$counter++;
		}

		$this->content .= "</tr></table>";
	}
}


class CustomizeSiteData extends CWizardStep
{
	function InitStep()
	{
		$this->SetTitle(GetMessage("DEMO_SITE_CUSTOMIZE_DATA_TITLE"));
		$this->SetSubTitle(GetMessage("DEMO_SITE_CUSTOMIZE_DATA_SUBTITLE"));
		$this->SetPrevStep("customize_theme");
		$this->SetStepID("customize_data");

		$wizard =& $this->GetWizard();
		$wizard->SetDefaultVars(
			Array(
				"company_name" => COption::GetOptionString("main", "site_name", GetMessage("DEMO_SITE_COMPANY_NAME_DEFAULT")),
				"company_slogan" => COption::GetOptionString("main", "wizard_company_slogan", GetMessage("DEMO_SITE_COMPANY_SLOGAN_DEFAULT")),
			)
		);
	}


	function OnPostForm()
	{
		$this->SaveFile("company_logo", Array("max_file_size" => 1.5*1024*1024, "extensions" => "gif,jpg,jpeg,png", "max_height" => 87, "max_width" => 87, "make_preview" => "Y"));
		COption::SetOptionString("main", "wizard_site_logo", "");
	}

	function ShowStep()
	{
		$wizard =& $this->GetWizard();

		$this->content .= GetMessage("DEMO_SITE_CUSTOMIZE_DATA_HINT")."<br /><br />";

		$this->content .= "<table><tr>";
		$this->content .= "<td>".GetMessage("DEMO_SITE_COMPANY_NAME").":</td>";
		$this->content .= "<td>".$this->ShowInputField("text", "company_name", Array("size" => "35"))."</td>";
		$this->content .= "</tr>";

		$this->content .= "<tr><td>".GetMessage("DEMO_SITE_COMPANY_SLOGAN").":</td>";
		$this->content .= "<td>".$this->ShowInputField("text", "company_slogan", Array("size" => "35"))."</td>";
		$this->content .= "</tr>";

		$fileID = COption::GetOptionString("main", "wizard_site_logo", "");
		if (intval($fileID) > 0)
			$wizard->SetVar("company_logo", $fileID);
		$companyLogo = $wizard->GetVar("company_logo");

		$this->content .= '<tr><td valign="top">'.GetMessage("DEMO_SITE_COMPANY_LOGO").': </td>';
		$this->content .= "<td>".$this->ShowFileField("company_logo", Array("max_file_size" => 1.5*1024*1024, "show_file_info" => "N"));
		$this->content .= "<br />".CFile::ShowImage($companyLogo, 200, 200, "border=0", "", true);
		$this->content .= "</td></tr>";
		$this->content .= "</table>";

	}
}

class SelectServices extends CWizardStep
{
	function InitStep()
	{
		$this->SetTitle(GetMessage("SELECT_SERVICES_TITLE"));
		$this->SetSubTitle(GetMessage("SELECT_SERVICES_SUBTITLE"));
		$this->SetStepID("select_services");
		$this->SetNextCaption(GetMessage("SELECT_SERVICES_BUTTON_INSTALL"));
	}

	function OnPostForm()
	{
	}

	function ShowStep()
	{
		$wizard =& $this->GetWizard();
		$package =& $wizard->GetPackage();
		$servicePath = $_SERVER["DOCUMENT_ROOT"].$wizard->GetPath()."/modules/";
		$arServices = DemoSiteUtil::GetServices($servicePath, $skipFilter = Array("SKIP_INSTALL_ONLY" => "Y"));

		//$this->content .= "<pre>".print_r($arServices, true)."</pre>";

		$this->content .= '<table width="100%" cellspacing="1" cellpadding="0">';

		foreach ($arServices as $serviceID => $arService)
		{
			$this->content .= '<tr>';

			if (!isset($arService["DEFAULT"]) || $arService["DEFAULT"] != "N")
				$wizard->SetDefaultVar("services[]",$serviceID);

			$this->content .= '<td valign="top">'.$this->ShowCheckboxField("services[]", $serviceID, Array("id" => $serviceID)).'</td>';

			$this->content .= '<td valign="top">';
				if (isset($arService["ICON"]) && strlen($arService["ICON"]) > 0)
					$this->content .= '<label for="'.$serviceID.'"><img src="'.$package->GetPath().'/'.$arService["ICON"].'" /></label>';
			$this->content .= '</td>';

			$this->content .= '<td valign="top" width="100%">';
			$this->content .= '<label for="'.$serviceID.'">&nbsp;'.$arService["NAME"].'</label><br />';

			if (isset($arService["DESCRIPTION"]) && strlen($arService["DESCRIPTION"]) > 0)
				$this->content .= '<div style="margin-left:20px;"><label for="'.$serviceID.'"><i>'.$arService["DESCRIPTION"].'</i></label></div>';

			$this->content .= '</td>';

			$this->content .= '</tr>';
		}

		$this->content .= '</table>';
	}

}
?>