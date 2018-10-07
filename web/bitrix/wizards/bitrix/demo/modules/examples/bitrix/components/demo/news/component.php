<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arDefaultUrlTemplates404 = array(
	"news" => "",
	"detail" => "#ELEMENT_ID#/",
);

$arDefaultVariableAliases404 = Array(
	"news"=>array(),
	"detail"=>array(),
);

$arComponentVariables = Array(
	"SECTION_ID",
	"ELEMENT_ID",
);

$arDefaultVariableAliases = Array(
	"SECTION_ID"=>"SECTION_ID",
	"ELEMENT_ID"=>"ELEMENT_ID",
);

if($arParams["SEF_MODE"] == "Y")
{
	$arUrlTemplates = CComponentEngine::MakeComponentUrlTemplates($arDefaultUrlTemplates404, $arParams["SEF_URL_TEMPLATES"]);
	$arVariableAliases = CComponentEngine::MakeComponentVariableAliases($arDefaultVariableAliases404, $arParams["VARIABLE_ALIASES"]);

	$componentPage = CComponentEngine::ParseComponentPath(
		$arParams["SEF_FOLDER"],
		$arUrlTemplates,
		$arVariables
	);

	if(!$componentPage)
		$componentPage = "news";

	CComponentEngine::InitComponentVariables($componentPage, $arComponentVariables, $arVariableAliases, $arVariables);
	$arResult = array(
			"FOLDER" => $arParams["SEF_FOLDER"],
			"URL_TEMPLATES" => $arUrlTemplates,
			"VARIABLES" => $arVariables,
			"ALIASES" => $arVariableAliases
		);
}
else
{
	$arVariableAliases = CComponentEngine::MakeComponentVariableAliases($arDefaultVariableAliases, $arParams["VARIABLE_ALIASES"]);
	CComponentEngine::InitComponentVariables(false, $arComponentVariables, $arVariableAliases, $arVariables);

	$componentPage = "";

	if(isset($arVariables["ELEMENT_ID"]) && intval($arVariables["ELEMENT_ID"]) > 0)
		$componentPage = "detail";
	else
		$componentPage = "news";

	$arResult = array(
			"FOLDER" => "",
			"URL_TEMPLATES" => Array(
				"news" => htmlspecialchars($APPLICATION->GetCurPage()),
				"detail" => htmlspecialchars($APPLICATION->GetCurPage())."?".$arVariableAliases["ELEMENT_ID"]."=#ELEMENT_ID#",
			),
			"VARIABLES" => $arVariables,
			"ALIASES" => $arVariableAliases
		);
}

$this->IncludeComponentTemplate($componentPage);
?>