<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arWizardDescription = Array(
	"NAME" => GetMessage("DEMO_SITE_WIZARD_NAME"), 
	"DESCRIPTION" => GetMessage("DEMO_SITE_WIZARD_DESC"), 
	"VERSION" => "1.0.0",
	"WIZARD_TYPE" => "INSTALL_ONCE",
	"START_TYPE" => "WINDOW",
	"IMAGE" => "images/".LANGUAGE_ID."/demo.gif",
	"TEMPLATES" => Array(
		Array("SCRIPT" => "scripts/template.php", "CLASS" => "DemoSiteTemplate")
	),

	"STEPS_SETTINGS" => Array(
		"WELCOME" => Array(
			"TITLE" => GetMessage("DEMO_SITE_WELCOME_TITLE"),
			"CONTENT" => GetMessage("DEMO_SITE_WELCOME_CONTENT")
		),

		"SELECT_TEMPLATE" => Array(
			"TITLE" => GetMessage("DEMO_SITE_SELECT_TEMPLATE_TITLE"),
			"SUBTITLE" => GetMessage("DEMO_SITE_SELECT_TEMPLATE_SUBTITLE"),
			"CONTENT" => GetMessage("DEMO_SITE_SELECT_TEMPLATE_CONTENT")."<br><br>"
		),

		"START_INSTALL" => Array(
			"SCRIPT" => "scripts/select_steps.php",
			"CLASS" => "SelectServices",
		),

		"INSTALL_TEMPLATE" => Array(
			"CONTENT" => '
			<table border="0" cellspacing="4" cellpadding="6" width="550">
				<tr>
					<td>'.GetMessage("MAIN_WIZARD_TEMPLATE_INSTALL").'</td>
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
			</table>
			'
		),

		"FINISH" => Array(
			"SCRIPT" => "scripts/finish.php",
			"CLASS" => "Finish",
		),

		"CANCEL" => Array(
			"SCRIPT" => "scripts/cancel.php",
			"CLASS" => "CancelStep",
		),

	),
);

?>