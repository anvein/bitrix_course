<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

require_once("utils.php");

class InstallTemplateData extends CWizardStep
{
	function InitStep()
	{
		$this->SetTitle(GetMessage("DEMO_SITE_INSTALL_THEME_TITLE"));
		$this->SetNextStep("install_services");
		$this->SetAutoSubmit();
	}

	function OnPostForm()
	{
		$wizard =& $this->GetWizard();
		$templateID = $wizard->GetSiteTemplateID();
		$templatePath = BX_PERSONAL_ROOT."/templates/".$templateID;

		$arReplace = Array(
			"COMPANY_NAME" => $wizard->GetVar("company_name"),
			"COMPANY_SLOGAN" => $wizard->GetVar("company_slogan"),
		);

		CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"].$templatePath."/include_areas/company_name.php", $arReplace);

		$server_name = ($_SERVER["HTTP_HOST"] <> ''? $_SERVER["HTTP_HOST"]:$_SERVER["SERVER_NAME"]);
		if($_SERVER["SERVER_PORT"] <> 80 && $_SERVER["SERVER_PORT"] <> 443 && $_SERVER["SERVER_PORT"] > 0 && strpos($_SERVER["HTTP_HOST"], ":") === false)
			$server_name .= ":".$_SERVER["SERVER_PORT"];

		COption::SetOptionString("main", "server_name", $server_name);
		COption::SetOptionString("main", "site_name", htmlspecialcharsEx($wizard->GetVar("company_name")));
		COption::SetOptionString("main", "wizard_company_slogan", $wizard->GetVar("company_slogan"));

		$themeVarName = $templateID."_themeID";
		$themeID = $wizard->GetVar($themeVarName);
		$themeID = Rel2Abs("/", $themeID);

		$themePath = $_SERVER["DOCUMENT_ROOT"].DemoSiteUtil::GetTemplatesPath($wizard->GetPath())."/".$templateID."/themes/".$themeID;

		CopyDirFiles(
			$themePath,
			$_SERVER["DOCUMENT_ROOT"].$templatePath,
			$rewrite = true, 
			$recursive = true,
			$delete_after_copy = false,
			$exclude = "description.php"
		);

		$companyLogo = $wizard->GetVar("company_logo");
		CWizardUtil::CopyFile($companyLogo, $templatePath."/images/logo.gif", false);
		COption::SetOptionString("main", "wizard_site_logo", $companyLogo);
	}

	function ShowStep()
	{
		$this->content .= '
			<table border="0" cellspacing="4" cellpadding="6" width="550">
				<tr>
					<td>'.GetMessage("DEMO_SITE_INSTALL_THEME_CONTENT").'</td>
				</tr>
				<tr>
					<td><br />
							<table width=200 cellspacing="0" cellpadding="0" border="0" style="border:1px solid #EFCB69" bgcolor="#FFF7D7" align="center">
								<tr>
									<td height="50" width="50" valign="middle" align=center><img src="/bitrix/wizards/bitrix/demo/images/wait.gif"></td>
									<td height="50" width="150">'.GetMessage("MAIN_WIZARD_WAIT_WINDOW_TEXT").'</td>
								</tr>
							</table>
					</td>
				</tr>
			</table>';
	}

}

class InstallServices extends CWizardStep
{
	function InitStep()
	{
		$this->SetTitle(GetMessage("INSTALL_SERVICE_TITLE"));
	}

	function OnPostForm()
	{
		$wizard =& $this->GetWizard();
		$serviceID = $wizard->GetVar("nextStep");
		$serviceStage = $wizard->GetVar("nextStepStage");

		if ($serviceID == "__finish")
		{
			$wizard->SetCurrentStep("__finish");
			//$wizard->SetCurrentStep("__install_structure");
			return;
		}

		$servicePath = $_SERVER["DOCUMENT_ROOT"].$wizard->GetPath()."/modules/";

		$arServiceSelected = $wizard->GetVar("services");
		if (!$arServiceSelected)
			$arServiceSelected = Array();
		$arServices = DemoSiteUtil::GetServices($servicePath, $arFilter = Array("SERVICES" => $arServiceSelected));

		/*$package =& $wizard->GetPackage();
		$arStructureServices = DemoSiteUtil::GetSelectedServices($package->GetSiteStructureID());
		$arServicePath = (array_key_exists($serviceID, $arStructureServices) ? $arStructureServices[$serviceID] : Array());*/

		if ($serviceStage == "skip")
			$success = true;
		else
			$success = $this->InstallDemoService($serviceID, $serviceStage);

		list($nextService, $nextServiceStage, $stepsComplete, $status) = $this->GetNextStep($arServices, $serviceID, $serviceStage);

		if ($nextService == "__finish")
		{
			$formName = $wizard->GetFormName();
			$nextButtonID = $wizard->GetNextButtonID();
			$response = "window.ajaxForm.StopAjax(); window.ajaxForm.SetStatus('100'); window.ajaxForm.Post('".$nextService."', '".$nextServiceStage."','".$status."');";
		}
		else
		{
			$arServiceID = array_keys($arServices);
			$lastService = array_pop($arServiceID);
			$stepsCount = $arServices[$lastService]["POSITION"];
			if (array_key_exists("STAGES", $arServices[$lastService]) && is_array($arServices[$lastService]))
				$stepsCount += count($arServices[$lastService]["STAGES"])-1;

			$percent = round($stepsComplete/$stepsCount * 100);
			$response = "window.ajaxForm.SetStatus('".$percent."'); window.ajaxForm.Post('".$nextService."', '".$nextServiceStage."','".$status."');";
		}

		die("[response]".$response."[/response]");
	}

	function InstallDemoService($serviceID, $serviceStage)
	{
		@set_time_limit(3600);

		$wizard =& $this->GetWizard();

		$templateID = $wizard->GetSiteTemplateID();
		$servicePath = $_SERVER["DOCUMENT_ROOT"].$wizard->GetPath()."/modules/".$serviceID."/".$serviceStage;
		$serviceRelativePath = $wizard->GetPath()."/modules/".$serviceID;
		$wizardPath = $_SERVER["DOCUMENT_ROOT"].$wizard->GetPath();

		if (!file_exists($servicePath))
			return false;

		global $DB, $DBType, $APPLICATION, $USER;
		include($servicePath);
	}


	function GetNextStep(&$arServices, &$currentService, &$currentStage)
	{
		$nextService = "__finish";
		$nextServiceStage = "__finish";
		$status = GetMessage("INSTALL_SERVICE_FINISH_STATUS");

		if (!array_key_exists($currentService, $arServices))
			return Array($nextService, $nextServiceStage, 0, $status); //Finish

		if ($currentStage != "skip" && array_key_exists("STAGES", $arServices[$currentService]) && is_array($arServices[$currentService]["STAGES"]))
		{
			$stageIndex = array_search($currentStage, $arServices[$currentService]["STAGES"]);
			if ($stageIndex !== false && isset($arServices[$currentService]["STAGES"][$stageIndex+1]))
				return Array(
					$currentService, 
					$arServices[$currentService]["STAGES"][$stageIndex+1], 
					$arServices[$currentService]["POSITION"]+ $stageIndex, 
					$arServices[$currentService]["NAME"]
				); //Current step, next stage
		}

		$arServiceID = array_keys($arServices);
		$serviceIndex = array_search($currentService, $arServiceID);

		if (!isset($arServiceID[$serviceIndex+1]))
			return Array($nextService, $nextServiceStage, 0, $status); //Finish

		$nextServiceID = $arServiceID[$serviceIndex+1];
		$nextServiceStage = "index.php";
		if (array_key_exists("STAGES", $arServices[$nextServiceID]) && is_array($arServices[$nextServiceID]["STAGES"]) && isset($arServices[$nextServiceID]["STAGES"][0]))
			$nextServiceStage = $arServices[$nextServiceID]["STAGES"][0];

		return Array($nextServiceID, $nextServiceStage, $arServices[$nextServiceID]["POSITION"]-1, $arServices[$nextServiceID]["NAME"]); //Next service
	}

	function GetFirstStep(&$arServices)
	{
		foreach ($arServices as $serviceID => $arService)
		{
			$stage = "index.php";
			if (array_key_exists("STAGES", $arService) && is_array($arService["STAGES"]) && isset($arService["STAGES"][0]))
				$stage = $arService["STAGES"][0];
			return Array($serviceID, $stage, $arService["NAME"]);
		}

		return Array("service_not_found", "__finish", GetMessage("INSTALL_SERVICE_FINISH_STATUS"));
	}

	function ShowStep()
	{
		$this->SetAutoSubmit(false);

		$wizard =& $this->GetWizard();
		$servicePath = $_SERVER["DOCUMENT_ROOT"].$wizard->GetPath()."/modules/";

		$arServiceSelected = $wizard->GetVar("services");
		if (!$arServiceSelected)
			$arServiceSelected = Array();

		$arServices = DemoSiteUtil::GetServices($servicePath, $arFilter = Array("SERVICES" => $arServiceSelected));

		/*$package =& $wizard->GetPackage();
		$arServiceSelected = array_keys(DemoSiteUtil::GetSelectedServices($package->GetSiteStructureID()));
		*/
		//$this->content .= "<pre>".print_r($wizard->GetVar("services"), true)."</pre>";

		list($firstService, $stage, $status) = $this->GetFirstStep($arServices);

		$this->content .= '
			<table border="0" cellspacing="0" cellpadding="2" width="550">
				<tr>
					<td colspan="2"><div id="status"></div></td>
				</tr>
				<tr>
					<td width="90%" height="10">
						<div style="border:1px solid #B9CBDF; width:100%;"><div id="indicator" style="height:10px; width:0%; background-color:#B9CBDF"></div></div>
					</td>
					<td width="10%">&nbsp;<span id="percent">0%</span></td>
				</tr>
			</table>
			<div id="wait" align=center>
			<br />
			<table width=200 cellspacing=0 cellpadding=0 border=0 style="border:1px solid #EFCB69" bgcolor="#FFF7D7">
				<tr>
					<td height=50 width="50" valign="middle" align=center><img src="/bitrix/wizards/bitrix/demo/images/wait.gif"></td>
					<td height=50 width=150>'.GetMessage("MAIN_WIZARD_WAIT_WINDOW_TEXT").'</td>
				</tr>
			</table>
		</div><br />
			<br />
			<div id="error_container" style="display:none">
				<div id="error_notice"><span style="color:red;">'.GetMessage("INST_ERROR_OCCURED").'<br />'.GetMessage("INST_TEXT_ERROR").':</span></div>
				<div id="error_text"></div>
				<div><span style="color:red;">'.GetMessage("INST_ERROR_NOTICE").'</span></div>
				<div id="error_buttons" align="center">
				<br /><input type="button" value="'.GetMessage("INST_RETRY_BUTTON").'" id="error_retry_button" onclick="" />&nbsp;<input type="button" id="error_skip_button" value="'.GetMessage("INST_SKIP_BUTTON").'" onclick="" />&nbsp;</div>
			</div>

		'.$this->ShowHiddenField("nextStep", $firstService).'
		'.$this->ShowHiddenField("nextStepStage", $stage).'
		<iframe style="display:none;" id="iframe-post-form" name="iframe-post-form" src="javascript:\'\'"></iframe>';

		$wizard =& $this->GetWizard();

		$formName = $wizard->GetFormName();
		$nextButtonID = $wizard->GetNextButtonID();
		$NextStepVarName = $wizard->GetRealName("nextStep");


		$this->content .= '
		<script type="text/javascript">
			var ajaxForm = new CAjaxForm("'.$formName.'", "iframe-post-form", "'.$NextStepVarName.'");
			ajaxForm.Post("'.$firstService.'", "'.$stage.'", "'.$status.'");
		</script>';

		$package =& $wizard->GetPackage();
		//$this->content = print_r($package->GetSiteStructureID(), true);
		//$this->content .= "<pre>".print_r($arServices, true)."</pre>";
		//setTimeout(function () {document.forms["'.$formName.'"].elements["'.$nextButtonID.'"].style.display = "none"}, 1000);
	}
}


?>