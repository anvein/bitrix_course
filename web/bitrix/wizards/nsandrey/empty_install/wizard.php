<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

global $arModNames;

$arModNames = array(
	'advertising' => GetMessage("NAS_EMPTYINSTALL_REKLAMA_BANNERY"),
	'bitrixcloud' => GetMessage("NAS_OBLAKO_1C_BITRIX"),
	'bizproc' => GetMessage("NAS_EMPTYINSTALL_BIZNES_PROCESSY"),
	'bizprocdesigner' => GetMessage("NAS_EMPTYINSTALL_DIZAYNER_BIZNES_PROC"),
	'blog' => GetMessage("NAS_EMPTYINSTALL_BLOGI"),
	'calendar' => GetMessage("NAS_EMPTYINSTALL_CALENDAR"),
	'catalog' => GetMessage("NAS_EMPTYINSTALL_TORGOVYY_KATALOG"),
	'cluster' => GetMessage("NAS_EMPTYINSTALL_VEB_KLASTER"),
	'clouds' => GetMessage("NAS_EMPTYINSTALL_OBLACNYE_HRANILISA"),
	'compression' => GetMessage("NAS_EMPTYINSTALL_KOMPRESSIA"),
	'controller' => GetMessage("NAS_EMPTYINSTALL_KONTROLLER"),
	'crm' => 'CRM',
	'currency' => GetMessage("NAS_EMPTYINSTALL_VALUTY"),
	'DAV' => 'DAV',
	'extranet' => GetMessage("NAS_EMPTYINSTALL_EKSTRANET"),
	'form' => GetMessage("NAS_EMPTYINSTALL_VEB_FORMY"),
	'forum' => GetMessage("NAS_EMPTYINSTALL_FORUM"),
	'iblock' => GetMessage("NAS_EMPTYINSTALL_INFORMACIONNYE_BLOKI"),
	'idea' => GetMessage("NAS_EMPTYINSTALL_MENEDJER_IDEY"),
	'im' => GetMessage("NAS_EMPTYINSTALL_IM"),
	'intranet' => GetMessage("NAS_EMPTYINSTALL_INTRANET"),
	'ldap' => 'AD/LDAP',
	'learning' => GetMessage("NAS_EMPTYINSTALL_OBUCENIE"),
	'lists' => GetMessage("NAS_EMPTYINSTALL_UNIVERSALQNYE_SPISKI"),
	'mail' => GetMessage("NAS_EMPTYINSTALL_POCTA"),
	'meeting' => GetMessage("NAS_EMPTYINSTALL_PLANERKI_I_SOBRANIA"),
	'perfmon' => GetMessage("NAS_EMPTYINSTALL_MODULQ_PROIZVODITELQ"),
	'photogallery' => GetMessage("NAS_EMPTYINSTALL_FOTOGALEREA"),
	'report' => GetMessage("NAS_EMPTYINSTALL_KONSTRUKTOR_OTCETOV"),
	'sale' => GetMessage("NAS_EMPTYINSTALL_INTERNET_MAGAZIN"),
	'search' => GetMessage("NAS_EMPTYINSTALL_POISK"),
	'security' => GetMessage("NAS_EMPTYINSTALL_PROAKTIVNAA_ZASITA"),
	'seo' => GetMessage("NAS_EMPTYINSTALL_POISKOVAA_OPTIMIZACI"),
	'socialnetwork' => GetMessage("NAS_EMPTYINSTALL_SOCIALQNAA_SETQ"),
	'socialservices' => GetMessage("NAS_EMPTYINSTALL_SOCIALQNYE_SERVISY"),
	'statistic' => GetMessage("NAS_EMPTYINSTALL_VEB_ANALITIKA"),
	'subscribe' => GetMessage("NAS_EMPTYINSTALL_PODPISKA_RASSYLKI"),
	'support' => GetMessage("NAS_EMPTYINSTALL_TEHPODDERJKA"),
	'tasks' => GetMessage("NAS_EMPTYINSTALL_ZADACI"),
	'timeman' => GetMessage("NAS_EMPTYINSTALL_UCET_RABOCEGO_VREMEN"),
	'translate' => GetMessage("NAS_EMPTYINSTALL_PEREVOD"),
	'video' => GetMessage("NAS_EMPTYINSTALL_VIDEOKONFERENCII"),
	'videoport' => GetMessage("NAS_EMPTYINSTALL_VIDEOPORT"),
	'vote' => GetMessage("NAS_EMPTYINSTALL_OPROSY_GOLOSOVANIA"),
	'webdav' => GetMessage("NAS_EMPTYINSTALL_BIBLIOTEKA_DOKUMENTO"),
	'webservice' => GetMessage("NAS_EMPTYINSTALL_VEB_SERVISY"),
	'wiki' => 'Wiki',
	'workflow' => GetMessage("NAS_EMPTYINSTALL_DOKUMENTOOBOROT"),
	'xdimport' => GetMessage("NAS_EMPTYINSTALL_IMPORT_DANNYH_IZ_VNE"),
	'xmpp' => 'XMPP '.GetMessage("NAS_EMPTYINSTALL_SERVER")
);

function on_shutdown(&$install_steps, &$currentStep)
{
	//ob_end_clean();

	if(!isset($install_steps[$currentStep + 1]))
	$response = "window.ajaxForm.StopAjax(); window.ajaxForm.SetStatus('100'); window.ajaxForm.Post('".($currentStep + 1)."', 'skip', '".($currentStep < 2 ? $install_steps[$currentStep] : $install_steps[$currentStep]['status'])."');";
	else
	{
		$progress = round($currentStep / sizeof($install_steps) * 100);
		$response = "window.ajaxForm.SetStatus('".$progress."'); window.ajaxForm.Post('".($currentStep + 1)."', 'skip', '".($currentStep < 2 ? $install_steps[$currentStep] : $install_steps[$currentStep]['status'])."');";
	}
	die("[response]".$response."[/response]");
}

class SelectTemplateStep extends CWizardStep
{
	private $s_count = 0;

	function InitStep()
	{
		$wizard =& $this->GetWizard();
		$wizard->solutionName = 'empty';

		$this->SetStepID('set_template');
		$this->SetTitle(GetMessage('WIZ_TEMPLATE_SETTINGS'));

		$sites = CSite::GetList($by = "sort", $order = "desc");
		while($sites_f = $sites->Fetch())
			$this->s_count++;

		if($this->s_count < 2)
		{
			$this->SetNextStep('set_site');
			$this->SetNextCaption(GetMessage('WIZ_MAIN_SETTINGS'));

			$wizard->SetDefaultVars(
				Array(
					'templateDescription' => GetMessage('WIZ_TEMPLATE_DESCRIPTION_DEFAULT'),
					'templateName' => GetMessage('WIZ_TEMPLATE_NAME_DEFAULT'),
					'templateDir' => GetMessage('WIZ_TEMPLATE_DIR_DEFAULT')
				)
			);
		}
		else
		{
			$site_wizard = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/bitrix/wizards/nsandrey/empty_install/site/_index.php');
			$site_wizard = strtr($site_wizard, array('#SITE_ID#' => SITE_ID, '#SITE_ENCODING#' => SITE_CHARSET));
			file_put_contents($_SERVER['DOCUMENT_ROOT'].SITE_DIR.'index.php', $site_wizard);

			$this->SetNextStep('success');
			$this->SetNextCaption(GetMessage('WIZ_FINISH'));
		}
	}

	function OnPostForm()
	{
		if($this->s_count < 2)
		{
			$wizard =& $this->GetWizard();
			$templateDir = $wizard->GetVar('templateDir');

			if(!preg_match('#^[A-Za-z0-9_]+$#is', $templateDir))
				$this->SetError(GetMessage('WIZ_TEMPLATE_DIR_ERROR'));
		}
	}

	function ShowStep()
	{
		$wizard =& $this->GetWizard();
		if($this->s_count < 2)
			$this->content .= 	'<div class="wizard-input-form">
									<div class="wizard-input-form-block">
										<h4><label for="siteName">'.GetMessage('WIZ_TEMPLATE_NAME').'</label></h4>
										<div class="wizard-input-form-block-content">
											<div class="wizard-input-form-field wizard-input-form-field-text">
												'.$this->ShowInputField('text', 'templateName').'
											</div>
										</div>
									</div>
									<div class="wizard-input-form-block">
										<h4><label for="siteName">'.GetMessage('WIZ_TEMPLATE_DESCRIPTION').'</label></h4>
										<div class="wizard-input-form-block-content">
											<div class="wizard-input-form-field wizard-input-form-field-text">
												'.$this->ShowInputField('text', 'templateDescription').'
											</div>
										</div>
									</div>
									<div class="wizard-input-form-block">
										<h4><label for="siteName">'.GetMessage('WIZ_TEMPLATE_DIR').'</label></h4>
										<div class="wizard-input-form-block-content">
											<div class="wizard-input-form-field wizard-input-form-field-text">
												'.$this->ShowInputField('text', 'templateDir').'
											</div>
										</div>
									</div>
								</div>';
		else
		$this->content .= GetMessage('WIZ_NOT_FIRST');
	}
}

class SiteSettingsStep extends CWizardStep
{
	function InitStep()
	{
		$wizard =& $this->GetWizard();
		$wizard->solutionName = 'empty';

		$this->SetStepID('set_site');
		$this->SetTitle(GetMessage('WIZ_MAIN_SETTINGS'));
		$this->SetNextStep('set_modules');
		$this->SetNextCaption(GetMessage('WIZ_MODULE_SETTINGS'));

		$wizard->SetDefaultVars(
			Array(
				'siteName' => GetMessage('WIZ_SETTINGS_SITE_NAME_DEFAULT'),
				'siteMetaTitle' => GetMessage('WIZ_SETTINGS_TITLE_DEFAULT'),
				'siteMetaDescription' => GetMessage('WIZ_SETTINGS_DESCRIPTION_DEFAULT'),
				'siteMetaKeywords' => GetMessage('WIZ_SETTINGS_KEYWORDS_DEFAULT')
			)
		);
	}

	function OnPostForm()
	{
	}

	function ShowStep()
	{
		$this->content .= 	'<div class="wizard-input-form">
								<div class="wizard-input-form-block">
									<h4><label for="siteName">'.GetMessage('WIZ_SETTINGS_SITE_NAME').'</label></h4>
									<div class="wizard-input-form-block-content">
										<div class="wizard-input-form-field wizard-input-form-field-text">
											'.$this->ShowInputField('text', 'siteName').'
										</div>
									</div>
								</div>
								<div class="wizard-input-form-block">
									<h4><label for="siteName">'.GetMessage('WIZ_SETTINGS_TITLE').'</label></h4>
									<div class="wizard-input-form-block-content">
										<div class="wizard-input-form-field wizard-input-form-field-text">
											'.$this->ShowInputField('text', 'siteMetaTitle').'
										</div>
									</div>
								</div>
								<div class="wizard-input-form-block">
									<h4><label for="siteName">'.GetMessage('WIZ_SETTINGS_DESCRIPTION').'</label></h4>
									<div class="wizard-input-form-block-content">
										<div class="wizard-input-form-field wizard-input-form-field-text">
											'.$this->ShowInputField('text', 'siteMetaDescription').'
										</div>
									</div>
								</div>
								<div class="wizard-input-form-block">
									<h4><label for="siteName">'.GetMessage('WIZ_SETTINGS_KEYWORDS').'</label></h4>
									<div class="wizard-input-form-block-content">
										<div class="wizard-input-form-field wizard-input-form-field-text">
											'.$this->ShowInputField('text', 'siteMetaKeywords').'
										</div>
									</div>
								</div>
							</div>';
	}
}

class ModuleSettingsStep extends CWizardStep
{
	private $arModules = array();

	function InitStep()
	{
		global $arModNames;

		$wizard =& $this->GetWizard();
		$wizard->solutionName = 'empty';

		$this->SetStepID('set_modules');
		$this->SetTitle(GetMessage('WIZ_MODULE_SETTINGS'));
		$this->SetNextStep('install_step');
		$this->SetNextCaption(GetMessage('WIZ_MAIN_SETTINGS'));


		foreach($arModNames as $m_id => $m_name)
			if(is_dir($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$m_id))
				$this->arModules[$m_id] = $m_name;

		asort($this->arModules);

		$wizard->SetVar('b_modules', $this->arModules);

		$wizard->SetDefaultVars(array('install' => array()));
	}

	function OnPostForm()
	{
	}

	function ShowStep()
	{
		$wizard =& $this->GetWizard();

		$this->content .= 	'<div class="wizard-input-form">
								<div class="wizard-input-form-block">
									<h4><label for="siteName">'.GetMessage('WIZ_MODULE_INSTALL').'</label></h4>
									<div class="wizard-input-form-block-content">';

		foreach($this->arModules as $m_id => $m_name)
			$this->content .= 	$this->ShowCheckboxField('install[]', $m_id).' '.$m_name.'<br />';

		$this->content .= 				'<br><a href="" onclick="checkAllModules(); return false;">'.GetMessage("NAS_EMPTYINSTALL_INSTALL_ALL").'</a> | <a href="" onclick="uncheckAllModules(); return false;">'.GetMessage("NAS_EMPTYINSTALL_INSTALL_NONE").'</a>
									</div>
								</div>
							</div>
							<script type="text/javascript">
								function checkAllModules()
								{
									var inputs = document.getElementsByTagName("input");
									for (var i = 0; i < inputs.length; i++)
									{
										if (inputs[i].type == "checkbox")
										{
											if (!inputs[i].checked)
												inputs[i].checked = true;
										}
									}
								}

								function uncheckAllModules()
								{
									var inputs = document.getElementsByTagName("input");
									for (var i = 0; i < inputs.length; i++)
									{
										if (inputs[i].type == "checkbox")
										{
											if (inputs[i].checked)
												inputs[i].checked = false;
										}
									}
								}
							</script>';
	}
}

class InstallStep extends CWizardStep
{
	function InitStep()
	{
		global $arModNames;

		$wizard =& $this->GetWizard();
		$wizard->solutionName = 'empty';

		$this->SetStepID('install_step');
		$this->SetTitle(GetMessage('WIZ_INSTALL'));
	}

	function OnPostForm()
	{
		$wizard =& $this->GetWizard();

		$currentStep = $wizard->GetVar('nextStep');
		$install_mod = $wizard->GetVar('install');
		$all_mod = $wizard->GetVar('b_modules');

		if($currentStep < 1)
			$currentStep = 0;

		$install_steps = array(
			GetMessage('WIZ_TEMPLATE_INSTALL'),
			GetMessage('WIZ_SETTINGS_INSTALL')
		);

		foreach($all_mod as $m_id => $m_name)
			$install_steps[] = in_array($m_id, $install_mod) ? array('module' => array('install', $m_id), 'status' => GetMessage('WIZ_MODULE_INSTALLING').$m_name) : array('module' => array('uninstall', $m_id), 'status' => GetMessage('WIZ_MODULE_UNINSTALLING').$m_name);

		if(!isset($install_steps[$currentStep]))
		{
			$wizard->SetCurrentStep('success');
			return;
		}

		$arVars = $wizard->GetVars();

		switch($currentStep)
		{
			case 0:
				//�������� ������
				CopyDirFiles($_SERVER['DOCUMENT_ROOT'].'/bitrix/wizards/nsandrey/empty_install/site/template/', $_SERVER['DOCUMENT_ROOT'].'/bitrix/templates/'.$arVars['templateDir'].'/', true, true, false);
				$templ_desc = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/bitrix/templates/'.$arVars['templateDir'].'/description.php');
				$templ_desc = strtr($templ_desc, array('#TEMPLATE_NAME#' => $arVars['templateName'], '#TEMPLATE_DESCRIPTION#' => $arVars['templateDescription']));
				file_put_contents($_SERVER['DOCUMENT_ROOT'].'/bitrix/templates/'.$arVars['templateDir'].'/description.php', $templ_desc);
				break;
			case 1:
				//�������� � ����������� ������
				CopyDirFiles($_SERVER['DOCUMENT_ROOT'].'/bitrix/wizards/nsandrey/empty_install/site/public/'.LANGUAGE_ID.'/', $_SERVER['DOCUMENT_ROOT'].'/', true, true, false);
				$site_meta = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/.section.php');
				$site_meta = strtr($site_meta, array('#SITE_TITLE#' => $arVars['siteMetaTitle'], '#SITE_DESCRIPTION#' => $arVars['siteMetaDescription'], '#SITE_KEYWORDS#' => $arVars['siteMetaKeywords']));
				file_put_contents($_SERVER['DOCUMENT_ROOT'].'/.section.php', $site_meta);
				$obSite = new CSite;
				$obSite->Update(SITE_ID, array('NAME' => $arVars['siteName'], 'TEMPLATE' => array(array('CONDITION' => '', 'SORT' => 1, 'TEMPLATE' => $arVars['templateDir']))));
				break;
			default:
				ob_start();
				if(@file_exists($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$install_steps[$currentStep]['module'][1].'/install/index.php'))
				{
					include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$install_steps[$currentStep]['module'][1].'/install/index.php');

					register_shutdown_function('on_shutdown', $install_steps, $currentStep);

					$module = new $install_steps[$currentStep]['module'][1];

					global $step;
					$_REQUEST['sessid'] = bitrix_sessid();
					if($install_steps[$currentStep]['module'][1] == 'wiki' || $install_steps[$currentStep]['module'][1] == 'photogallery')
						$_REQUEST['step'] = $step = 3;
					else
						$_REQUEST['step'] = $step = 2;

					if($install_steps[$currentStep]['module'][0] == 'install' && !$module->IsInstalled())
						$module->DoInstall();
					elseif($install_steps[$currentStep]['module'][0] == 'uninstall' && $module->IsInstalled())
						$module->DoUninstall();
				}
				ob_end_clean();
				break;
		}

		if(!isset($install_steps[$currentStep + 1]))
			$response = "window.ajaxForm.StopAjax(); window.ajaxForm.SetStatus('100'); window.ajaxForm.Post('".($currentStep + 1)."', 'skip', '".($currentStep < 2 ? $install_steps[$currentStep] : $install_steps[$currentStep]['status'])."');";
		else
		{
			$progress = round($currentStep / sizeof($install_steps) * 100);
			$response = "window.ajaxForm.SetStatus('".$progress."'); window.ajaxForm.Post('".($currentStep + 1)."', 'skip', '".($currentStep < 2 ? $install_steps[$currentStep] : $install_steps[$currentStep]['status'])."');";
		}
		die("[response]".$response."[/response]");
	}

	function ShowStep()
	{
		$wizard =& $this->GetWizard();

		$this->content .= '
		<table border="0" cellspacing="0" cellpadding="2" width="100%">
			<tr>
				<td colspan="2"><div id="status"></div></td>
			</tr>
			<tr>
				<td width="90%" height="10">
					<div style="border:1px solid #B9CBDF; width:100%;"><div id="indicator" style="height:10px; width:0%; background-color:#B9CBDF"></div></div>
				</td>
				<td width="10%">&nbsp;<span id="percent">0%</span><span id="percent2" style="display: none;">0%</span></td>
			</tr>
		</table>
		<div id="wait" align=center>
			<br />
			<table width=200 cellspacing=0 cellpadding=0 border=0 style="border:1px solid #EFCB69" bgcolor="#FFF7D7">
				<tr>
					<td height=50 width="50" valign="middle" align=center><img src="/bitrix/images/main/wizard_sol/wait.gif"></td>
					<td height=50 width=150>'.GetMessage("WIZARD_WAIT_WINDOW_TEXT").'</td>
				</tr>
			</table>
		</div><br /><br />
		<div id="error_container" style="display:none">
			<div id="error_notice"><span style="color:red;">'.GetMessage("INST_ERROR_OCCURED").'<br />'.GetMessage("INST_TEXT_ERROR").':</span></div>
			<div id="error_text"></div>
			<div><span style="color:red;">'.GetMessage("INST_ERROR_NOTICE").'</span></div>
			<div id="error_buttons" align="center"><br />
			<input type="button" value="'.GetMessage("INST_RETRY_BUTTON").'" id="error_retry_button" onclick="" />&nbsp;<input type="button" id="error_skip_button" value="'.GetMessage("INST_SKIP_BUTTON").'" onclick="" />&nbsp;</div>
		</div>
		'.$this->ShowHiddenField("nextStep", $firstService).'
		'.$this->ShowHiddenField("nextStepStage", $stage).'
		<iframe style="display:none;" id="iframe-post-form" name="iframe-post-form" src="javascript:\'\'"></iframe>';

		$formName = $wizard->GetFormName();
		$NextStepVarName = $wizard->GetRealName("nextStep");

		$this->content .= '
		<script type="text/javascript">
			var ajaxForm = new CAjaxForm("'.$formName.'", "iframe-post-form", "'.$NextStepVarName.'");
			ajaxForm.Post("0", "skip", "'.GetMessage("WIZ_START_INSTALL").'");
		</script>';
	}
}

class SuccessStep extends CWizardStep
{
	function InitStep()
	{
		$wizard =& $this->GetWizard();
		$wizard->solutionName = 'empty';

		$this->SetStepID('success');
		$this->SetTitle(GetMessage('WIZ_FINISH'));
		$this->SetNextStep('success');
		$this->SetNextCaption(GetMessage('WIZ_GO'));
	}

	function ShowStep()
	{
		CopyDirFiles($_SERVER['DOCUMENT_ROOT'].'/_index.php', $_SERVER['DOCUMENT_ROOT'].'/index.php', true, true, true);
		bx_accelerator_reset();
	}
}

?>
