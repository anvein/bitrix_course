<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arWizardTemplates = Array(
	"TEMPLATES" => Array(

		"books" => Array(
			"DEFAULT" => "Y",
			"SORT" => 1,
			"SELECT_STEPS" => Array(
				"SCRIPT" => "scripts/select_steps.php",
				"STEPS" => Array(
					"customize_theme" => "CustomizeSiteTheme",
					"customize_data" => "CustomizeSiteData",
				)
			),
			"INSTALL_STEPS" => Array(
				"SCRIPT" => "scripts/install_steps.php",
				"STEPS" => Array(
					"install_demo_template" => "InstallTemplateData",
					"install_services" => "InstallServices",
				)
			),
		),

		"web20" => Array(
			"SORT" => 2,
			"SELECT_STEPS" => Array(
				"SCRIPT" => "scripts/select_steps.php",
				"STEPS" => Array(
					"customize_theme" => "CustomizeSiteTheme",
					"customize_data" => "CustomizeSiteData",
				)
			),
			"INSTALL_STEPS" => Array(
				"SCRIPT" => "scripts/install_steps.php",
				"STEPS" => Array(
					"install_demo_template" => "InstallTemplateData",
					"install_services" => "InstallServices",
				)
			),

			"FILES" => Array(
				Array("FROM" => "misc/web20_to_print/".LANGUAGE_ID, "TO" => BX_PERSONAL_ROOT."/templates/print", "REWRITE" => "N")
			),
		),

		"xml_catalog" => Array(
			"SORT" => 3,
			"SELECT_STEPS" => Array(
				"SCRIPT" => "scripts/select_steps.php",
				"STEPS" => Array(
					"customize_theme" => "CustomizeSiteTheme",
					"customize_data" => "CustomizeSiteData",
				)
			),
			"INSTALL_STEPS" => Array(
				"SCRIPT" => "scripts/install_steps.php",
				"STEPS" => Array(
					"install_demo_template" => "InstallTemplateData",
					"install_services" => "InstallServices",
				)
			),
		),
	)
);

?>