<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

if(!CModule::IncludeModule('sale'))
	return;

$arGeneralInfo = Array();

$siteID = $arParams["site_id"];
if(strlen($arParams["site_id"]) <= 0)
	$siteID = "s1";
$dbSite = CSite::GetByID($siteID);
if($arSite = $dbSite -> Fetch())
	$lang = $arSite["LANGUAGE_ID"];
if(strlen($lang) <= 0)
	$lang = "ru";
$bRus = false;
if($lang == "ru")
	$bRus = true;

__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", "/".basename(__FILE__), $lang));
	
$dbPerson = CSalePersonType::GetList(Array());
if(!$dbPerson->Fetch())//if there are no data in module
{
	//Person Types
	$arGeneralInfo["personType"]["fiz"] = CSalePersonType::Add(Array(
				"LID" => $siteID,
				"NAME" => GetMessage("SALE_WIZARD_PERSON_1"),
				"SORT" => "100"
				)
			);
	$arGeneralInfo["personType"]["ur"] = CSalePersonType::Add(Array(
				"LID" => $siteID,
				"NAME" => GetMessage("SALE_WIZARD_PERSON_2"),
				"SORT" => "150"
				)
			);

	//currecny to site
	$dbUserAccount = CSaleUserAccount::GetList(Array(), Array("USER_ID" => 1));
	if(!$dbUserAccount->Fetch())
	{
	if($bRus)
	{
		CSaleLang::Add(Array("LID" => $siteID, "CURRENCY" => "RUB"));
		CSaleUserAccount::Add(Array("USER_ID" => 1, "CURRENT_BUDGET" => 1000, "CURRENCY" => "RUB"));
	}
	else
	{
		CSaleLang::Add(Array("LID" => $siteID, "CURRENCY" => "USD"));
		CSaleUserAccount::Add(Array("USER_ID" => 1, "CURRENT_BUDGET" => 100, "CURRENCY" => "USD"));
	}
	}
	//Sale administrators
	$userGroupID = "";
	$dbGroup = CGroup::GetList($by = "", $order = "", Array("STRING_ID" => "sale_administrator"));
	if($arGroup = $dbGroup -> Fetch())
	{
		$userGroupID = $arGroup["ID"];
	}
	else
	{
		$group = new CGroup;
		$arFields = Array(
		  "ACTIVE"       => "Y",
		  "C_SORT"       => 800,
		  "NAME"         => GetMessage("SALE_WIZARD_ADMIN_SALE"),
		  "DESCRIPTION"  => GetMessage("SALE_WIZARD_ADMIN_SALE_DESCR"),
		  "USER_ID"      => array(),
		  "STRING_ID"      => "sale_administrator",
		  );
		$userGroupID = $group->Add($arFields);
	}

	if(IntVal($userGroupID) > 0)
	{
		DemoSiteUtil::SetFilePermission(Array($siteID, "/bitrix/admin"), Array($userGroupID => "R"));
		CSaleGroupAccessToSite::Add(array("SITE_ID" => $siteID, "GROUP_ID" => $userGroupID));
	}
	
	if($bRus)
	{
		$dbGroup = CGroup::GetList($by = "", $order = "", Array("STRING_ID" => "1c_integration"));
		if($arGroup = $dbGroup -> Fetch())
		{
			$user1CGroupID = $arGroup["ID"];
		}
		else
		{
			$group = new CGroup;
			$arFields = Array(
			  "ACTIVE"       => "Y",
			  "C_SORT"       => 900,
			  "NAME"         => GetMessage("SALE_WIZARD_1C_GROUP"),
			  "DESCRIPTION"  => GetMessage("SALE_WIZARD_1C_GROUP_DESCR"),
			  "USER_ID"      => array(),
			  "STRING_ID"      => "1c_integration",
			  );
			$user1CGroupID = $group->Add($arFields);
		}

		if(IntVal($user1CGroupID) > 0)
			DemoSiteUtil::SetFilePermission(Array($siteID, "/bitrix/admin"), Array($userGroupID => "R"));
	}
		
	//Set options 
	if($bRus)
		COption::SetOptionString('sale','default_currency','RUB');
	else
		COption::SetOptionString('sale','default_currency','USD');
	COption::SetOptionString('sale','delete_after','30');
	COption::SetOptionString('sale','path2user_ps_files','/bitrix/php_interface/include/sale_payment/');
	COption::SetOptionString('sale','lock_catalog','Y');
	COption::SetOptionString('sale','order_list_fields','ID,USER,PAY_SYSTEM,PRICE,STATUS,PAYED,PS_STATUS,CANCELED,BASKET');
	COption::SetOptionString('sale','GROUP_DEFAULT_RIGHT','D');
	COption::SetOptionString('sale','affiliate_param_name','partner');
	COption::SetOptionString('sale','show_order_sum','N');
	COption::SetOptionString('sale','affiliate_plan_type','N');
	if($bRus)
	{
		COption::SetOptionString('sale','1C_SALE_SITE_LIST',$siteID);
		COption::SetOptionString('sale','1C_EXPORT_PAYED_ORDERS','N');
		COption::SetOptionString('sale','1C_EXPORT_ALLOW_DELIVERY_ORDERS','N');
		COption::SetOptionString('sale','1C_EXPORT_FINAL_ORDERS','');
		COption::SetOptionString('sale','1C_FINAL_STATUS_ON_DELIVERY','F');
		COption::SetOptionString('sale','1C_REPLACE_CURRENCY',GetMessage("SALE_WIZARD_PS_BILL_RUB"));
		COption::SetOptionString('sale','1C_SALE_GROUP_PERMISSIONS','1,'.$user1CGroupID);
		COption::SetOptionString('sale','1C_SALE_USE_ZIP','Y');
	}
	COption::SetOptionString('sale','weight_unit', GetMessage("SALE_WIZARD_WEIGHT_UNIT"));
	COption::SetOptionString('sale','WEIGHT_different_set','N');
	COption::SetOptionString('sale','ADDRESS_different_set','N');
	COption::SetOptionString('sale','measurement_path','/bitrix/modules/sale/measurements.php');
	COption::SetOptionString('sale','delivery_handles_custom_path','/bitrix/php_interface/include/sale_delivery/');
	COption::SetOptionString('sale','location_zip','101000');
	COption::SetOptionString('sale','weight_koef','1');
	COption::SetOptionString('sale','location','547');
	COption::SetOptionString('sale','recalc_product_list','Y');
	COption::SetOptionString('sale','recalc_product_list_period','7');

	//Order Prop Group
	$arGeneralInfo["propGroup"]["adres_fiz"] = CSaleOrderPropsGroup::Add(Array("PERSON_TYPE_ID" => $arGeneralInfo["personType"]["fiz"], "NAME" => GetMessage("SALE_WIZARD_PROP_GROUP_FIZ1"), "SORT" => 100));
	$arGeneralInfo["propGroup"]["compl_fiz"] = CSaleOrderPropsGroup::Add(Array("PERSON_TYPE_ID" => $arGeneralInfo["personType"]["fiz"], "NAME" => GetMessage("SALE_WIZARD_PROP_GROUP_FIZ2"), "SORT" => 50));
	$arGeneralInfo["propGroup"]["adres_ur"] = CSaleOrderPropsGroup::Add(Array("PERSON_TYPE_ID" => $arGeneralInfo["personType"]["ur"], "NAME" => GetMessage("SALE_WIZARD_PROP_GROUP_UR1"), "SORT" => 100));

	$arProps = Array(
			Array(
				"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["fiz"],
				"NAME" => GetMessage("SALE_WIZARD_PROP_1"),
				"TYPE" => "RADIO",
				"REQUIED" => "Y",
				"DEFAULT_VALUE" => "F",
				"SORT" => 100,
				"USER_PROPS" => "N",
				"IS_LOCATION" => "N",
				"PROPS_GROUP_ID" => $arGeneralInfo["propGroup"]["compl_fiz"],
				"SIZE1" => 0,
				"SIZE2" => 0,
				"DESCRIPTION" => "",
				"IS_EMAIL" => "N",
				"IS_PROFILE_NAME" => "N",
				"IS_PAYER" => "N",
				"IS_LOCATION4TAX" => "N",
				"CODE" => "",
				"IS_FILTERED" => "N",
				"VARIANTS" => Array(
					Array(
						"NAME" => GetMessage("SALE_WIZARD_PROP_1_VAL_1"),
						"VALUE" => "F",
						"SORT" => 100
					),
					Array(
						"NAME" => GetMessage("SALE_WIZARD_PROP_1_VAL_2"),
						"VALUE" => "P",
						"SORT" => 200
					),
				)
			),
			Array(
				"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["fiz"],
				"NAME" => GetMessage("SALE_WIZARD_PROP_2"),
				"TYPE" => "LOCATION",
				"REQUIED" => "Y",
				"DEFAULT_VALUE" => "",
				"SORT" => 50,
				"USER_PROPS" => "Y",
				"IS_LOCATION" => "Y",
				"PROPS_GROUP_ID" => $arGeneralInfo["propGroup"]["adres_fiz"],
				"SIZE1" => 3,
				"SIZE2" => 0,
				"DESCRIPTION" => "",
				"IS_EMAIL" => "N",
				"IS_PROFILE_NAME" => "N",
				"IS_PAYER" => "N",
				"IS_LOCATION4TAX" => "N",
				"CODE" => "LOCATION",
				"IS_FILTERED" => "N",
			),
			Array(
				"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["ur"],
				"NAME" => GetMessage("SALE_WIZARD_PROP_2"),
				"TYPE" => "LOCATION",
				"REQUIED" => "Y",
				"DEFAULT_VALUE" => "",
				"SORT" => 1800,
				"USER_PROPS" => "Y",
				"IS_LOCATION" => "Y",
				"PROPS_GROUP_ID" => $arGeneralInfo["propGroup"]["adres_ur"],
				"SIZE1" => 3,
				"SIZE2" => 0,
				"DESCRIPTION" => "",
				"IS_EMAIL" => "N",
				"IS_PROFILE_NAME" => "N",
				"IS_PAYER" => "N",
				"IS_LOCATION4TAX" => "Y",
				"CODE" => "F_LOCATION",
				"IS_FILTERED" => "N",
			),
			Array(
				"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["fiz"],
				"NAME" => GetMessage("SALE_WIZARD_PROP_3"),
				"TYPE" => "TEXT",
				"REQUIED" => "Y",
				"DEFAULT_VALUE" => "",
				"SORT" => 60,
				"USER_PROPS" => "Y",
				"IS_LOCATION" => "Y",
				"PROPS_GROUP_ID" => $arGeneralInfo["propGroup"]["adres_fiz"],
				"SIZE1" => 1,
				"SIZE2" => 40,
				"DESCRIPTION" => GetMessage("SALE_WIZARD_PROP_3_DESCR"),
				"IS_EMAIL" => "N",
				"IS_PROFILE_NAME" => "N",
				"IS_PAYER" => "N",
				"IS_LOCATION4TAX" => "N",
				"CODE" => "",
				"IS_FILTERED" => "N",
			),		
			Array(
				"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["fiz"],
				"NAME" => GetMessage("SALE_WIZARD_PROP_4"),
				"TYPE" => "TEXT",
				"REQUIED" => "Y",
				"DEFAULT_VALUE" => "",
				"SORT" => 70,
				"USER_PROPS" => "Y",
				"IS_LOCATION" => "N",
				"PROPS_GROUP_ID" => $arGeneralInfo["propGroup"]["adres_fiz"],
				"SIZE1" => 8,
				"SIZE2" => 0,
				"DESCRIPTION" => "",
				"IS_EMAIL" => "N",
				"IS_PROFILE_NAME" => "N",
				"IS_PAYER" => "N",
				"IS_LOCATION4TAX" => "N",
				"CODE" => "INDEX",
				"IS_FILTERED" => "N",
			),
			Array(
				"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["fiz"],
				"NAME" => GetMessage("SALE_WIZARD_PROP_5"),
				"TYPE" => "TEXTAREA",
				"REQUIED" => "Y",
				"DEFAULT_VALUE" => "",
				"SORT" => 80,
				"USER_PROPS" => "Y",
				"IS_LOCATION" => "N",
				"PROPS_GROUP_ID" => $arGeneralInfo["propGroup"]["adres_fiz"],
				"SIZE1" => 30,
				"SIZE2" => 2,
				"DESCRIPTION" => "",
				"IS_EMAIL" => "N",
				"IS_PROFILE_NAME" => "N",
				"IS_PAYER" => "N",
				"IS_LOCATION4TAX" => "N",
				"CODE" => "ADDRESS",
				"IS_FILTERED" => "N",
			),		
			Array(
				"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["fiz"],
				"NAME" => "E-Mail",
				"TYPE" => "TEXT",
				"REQUIED" => "Y",
				"DEFAULT_VALUE" => "",
				"SORT" => 40,
				"USER_PROPS" => "Y",
				"IS_LOCATION" => "N",
				"PROPS_GROUP_ID" => $arGeneralInfo["propGroup"]["adres_fiz"],
				"SIZE1" => 40,
				"SIZE2" => 0,
				"DESCRIPTION" => "",
				"IS_EMAIL" => "Y",
				"IS_PROFILE_NAME" => "N",
				"IS_PAYER" => "N",
				"IS_LOCATION4TAX" => "N",
				"CODE" => "EMAIL",
				"IS_FILTERED" => "N",
			),		
			Array(
				"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["fiz"],
				"NAME" => GetMessage("SALE_WIZARD_PROP_6"),
				"TYPE" => "TEXT",
				"REQUIED" => "Y",
				"DEFAULT_VALUE" => "",
				"SORT" => 100,
				"USER_PROPS" => "Y",
				"IS_LOCATION" => "N",
				"PROPS_GROUP_ID" => $arGeneralInfo["propGroup"]["adres_fiz"],
				"SIZE1" => 40,
				"SIZE2" => 0,
				"DESCRIPTION" => "",
				"IS_EMAIL" => "N",
				"IS_PROFILE_NAME" => "Y",
				"IS_PAYER" => "Y",
				"IS_LOCATION4TAX" => "N",
				"CODE" => "CONTACT_PERSON",
				"IS_FILTERED" => "N",
			),
			Array(
				"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["ur"],
				"NAME" => GetMessage("SALE_WIZARD_PROP_7"),
				"TYPE" => "TEXTAREA",
				"REQUIED" => "Y",
				"DEFAULT_VALUE" => "",
				"SORT" => 1100,
				"USER_PROPS" => "Y",
				"IS_LOCATION" => "N",
				"PROPS_GROUP_ID" => $arGeneralInfo["propGroup"]["adres_ur"],
				"SIZE1" => 40,
				"SIZE2" => 0,
				"DESCRIPTION" => "",
				"IS_EMAIL" => "N",
				"IS_PROFILE_NAME" => "N",
				"IS_PAYER" => "N",
				"IS_LOCATION4TAX" => "N",
				"CODE" => "F_ADDRESS_FULL",
				"IS_FILTERED" => "N",
			),
			Array(
				"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["ur"],
				"NAME" => "E-Mail",
				"TYPE" => "TEXT",
				"REQUIED" => "Y",
				"DEFAULT_VALUE" => "",
				"SORT" => 2200,
				"USER_PROPS" => "Y",
				"IS_LOCATION" => "N",
				"PROPS_GROUP_ID" => $arGeneralInfo["propGroup"]["adres_ur"],
				"SIZE1" => 40,
				"SIZE2" => 0,
				"DESCRIPTION" => "",
				"IS_EMAIL" => "Y",
				"IS_PROFILE_NAME" => "N",
				"IS_PAYER" => "N",
				"IS_LOCATION4TAX" => "N",
				"CODE" => "F_EMAIL",
				"IS_FILTERED" => "N",
			),
			Array(
				"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["ur"],
				"NAME" => GetMessage("SALE_WIZARD_PROP_8"),
				"TYPE" => "TEXT",
				"REQUIED" => "Y",
				"DEFAULT_VALUE" => "",
				"SORT" => 1000,
				"USER_PROPS" => "Y",
				"IS_LOCATION" => "N",
				"PROPS_GROUP_ID" => $arGeneralInfo["propGroup"]["adres_ur"],
				"SIZE1" => 40,
				"SIZE2" => 0,
				"DESCRIPTION" => "",
				"IS_EMAIL" => "N",
				"IS_PROFILE_NAME" => "Y",
				"IS_PAYER" => "N",
				"IS_LOCATION4TAX" => "N",
				"CODE" => "F_COMPANY_NAME",
				"IS_FILTERED" => "N",
			),
			Array(
				"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["ur"],
				"NAME" => GetMessage("SALE_WIZARD_PROP_9"),
				"TYPE" => "TEXT",
				"REQUIED" => "Y",
				"DEFAULT_VALUE" => "",
				"SORT" => 1600,
				"USER_PROPS" => "Y",
				"IS_LOCATION" => "N",
				"PROPS_GROUP_ID" => $arGeneralInfo["propGroup"]["adres_ur"],
				"SIZE1" => 0,
				"SIZE2" => 0,
				"DESCRIPTION" => "",
				"IS_EMAIL" => "N",
				"IS_PROFILE_NAME" => "N",
				"IS_PAYER" => "N",
				"IS_LOCATION4TAX" => "N",
				"CODE" => "F_PHONE",
				"IS_FILTERED" => "N",
			),
			Array(
				"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["ur"],
				"NAME" => GetMessage("SALE_WIZARD_PROP_10"),
				"TYPE" => "TEXT",
				"REQUIED" => "Y",
				"DEFAULT_VALUE" => "",
				"SORT" => 2000,
				"USER_PROPS" => "Y",
				"IS_LOCATION" => "N",
				"PROPS_GROUP_ID" => $arGeneralInfo["propGroup"]["adres_ur"],
				"SIZE1" => 0,
				"SIZE2" => 0,
				"DESCRIPTION" => "",
				"IS_EMAIL" => "N",
				"IS_PROFILE_NAME" => "N",
				"IS_PAYER" => "Y",
				"IS_LOCATION4TAX" => "N",
				"CODE" => "F_NAME",
				"IS_FILTERED" => "N",
			),
			Array(
				"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["ur"],
				"NAME" => GetMessage("SALE_WIZARD_PROP_11"),
				"TYPE" => "TEXT",
				"REQUIED" => "Y",
				"DEFAULT_VALUE" => "",
				"SORT" => 1700,
				"USER_PROPS" => "Y",
				"IS_LOCATION" => "N",
				"PROPS_GROUP_ID" => $arGeneralInfo["propGroup"]["adres_ur"],
				"SIZE1" => 0,
				"SIZE2" => 0,
				"DESCRIPTION" => "",
				"IS_EMAIL" => "N",
				"IS_PROFILE_NAME" => "N",
				"IS_PAYER" => "N",
				"IS_LOCATION4TAX" => "N",
				"CODE" => "F_FAX",
				"IS_FILTERED" => "N",
			),
			Array(
				"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["ur"],
				"NAME" => GetMessage("SALE_WIZARD_PROP_12"),
				"TYPE" => "TEXT",
				"REQUIED" => "Y",
				"DEFAULT_VALUE" => "",
				"SORT" => 1900,
				"USER_PROPS" => "Y",
				"IS_LOCATION" => "N",
				"PROPS_GROUP_ID" => $arGeneralInfo["propGroup"]["adres_ur"],
				"SIZE1" => 0,
				"SIZE2" => 0,
				"DESCRIPTION" => "",
				"IS_EMAIL" => "N",
				"IS_PROFILE_NAME" => "N",
				"IS_PAYER" => "N",
				"IS_LOCATION4TAX" => "N",
				"CODE" => "F_ADDRESS",
				"IS_FILTERED" => "N",
			),
		);
	if($bRus)
	{
		$arProps[] = 
			Array(
				"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["ur"],
				"NAME" => GetMessage("SALE_WIZARD_PROP_13"),
				"TYPE" => "TEXT",
				"REQUIED" => "Y",
				"DEFAULT_VALUE" => "",
				"SORT" => 1200,
				"USER_PROPS" => "Y",
				"IS_LOCATION" => "N",
				"PROPS_GROUP_ID" => $arGeneralInfo["propGroup"]["adres_ur"],
				"SIZE1" => 0,
				"SIZE2" => 0,
				"DESCRIPTION" => "",
				"IS_EMAIL" => "N",
				"IS_PROFILE_NAME" => "N",
				"IS_PAYER" => "N",
				"IS_LOCATION4TAX" => "N",
				"CODE" => "F_INN",
				"IS_FILTERED" => "N",
			);
		$arProps[] = 
			Array(
				"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["ur"],
				"NAME" => GetMessage("SALE_WIZARD_PROP_14"),
				"TYPE" => "TEXT",
				"REQUIED" => "Y",
				"DEFAULT_VALUE" => "",
				"SORT" => 1300,
				"USER_PROPS" => "Y",
				"IS_LOCATION" => "N",
				"PROPS_GROUP_ID" => $arGeneralInfo["propGroup"]["adres_ur"],
				"SIZE1" => 0,
				"SIZE2" => 0,
				"DESCRIPTION" => "",
				"IS_EMAIL" => "N",
				"IS_PROFILE_NAME" => "N",
				"IS_PAYER" => "N",
				"IS_LOCATION4TAX" => "N",
				"CODE" => "F_KPP",
				"IS_FILTERED" => "N",
			);
	}

	foreach($arProps as $prop)
	{
		$variants = Array();
		if(!empty($prop["VARIANTS"]))
		{
			$variants = $prop["VARIANTS"];
			unset($prop["VARIANTS"]);
		}
		$id = CSaleOrderProps::Add($prop);
		
		if(strlen($prop["CODE"]) > 0)
		{
			$arGeneralInfo["propCode"][$prop["CODE"]] = $prop["CODE"];
			$arGeneralInfo["propCodeID"][$prop["CODE"]] = $id;
		}
		
		if(!empty($variants))
		{	
			foreach($variants as $val)
			{
				$val["ORDER_PROPS_ID"] = $id;
				CSaleOrderPropsVariant::Add($val);
			}
		}
	}

	//PaySystem
	if($bRus)
	{
		$arPaySystems = Array(
				Array(
					"NAME" => GetMessage("SALE_WIZARD_PS_CASH"),
					"SORT" => 50,
					"DESCRIPTION" => GetMessage("SALE_WIZARD_PS_CASH_DESCR"),
					"CODE_TEMP" => "cash",
					"ACTION" => Array(
						Array(
							"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["fiz"],
							"NAME" => GetMessage("SALE_WIZARD_PS_CASH"),
							"ACTION_FILE" => "/bitrix/modules/sale/payment/cash",
							"RESULT_FILE" => "",
							"NEW_WINDOW" => "N",
							"PARAMS" => "",
							"HAVE_PAYMENT" => "Y",
							"HAVE_ACTION" => "N",
							"HAVE_RESULT" => "N",
							"HAVE_PREPAY" => "N",
							"HAVE_RESULT_RECEIVE" => "N",
						),
						Array(
							"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["ur"],
							"NAME" => GetMessage("SALE_WIZARD_PS_CASH"),
							"ACTION_FILE" => "/bitrix/modules/sale/payment/cash",
							"RESULT_FILE" => "",
							"NEW_WINDOW" => "N",
							"PARAMS" => "",
							"HAVE_PAYMENT" => "Y",
							"HAVE_ACTION" => "N",
							"HAVE_RESULT" => "N",
							"HAVE_PREPAY" => "N",
							"HAVE_RESULT_RECEIVE" => "N",
						),
					)
				),		
				Array(
					"NAME" => GetMessage("SALE_WIZARD_PS_CC"),
					"SORT" => 60,
					"DESCRIPTION" => GetMessage("SALE_WIZARD_PS_CC"),
					"CODE_TEMP" => "card",
					"ACTION" => Array(Array(
						"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["fiz"],
						"NAME" => GetMessage("SALE_WIZARD_PS_CC"),
						"ACTION_FILE" => "/bitrix/modules/sale/payment/assist",
						"RESULT_FILE" => "/bitrix/modules/sale/payment/assist_res.php",
						"NEW_WINDOW" => "N",
						"PARAMS" => serialize(Array(
							"FIRST_NAME" => Array("TYPE" => "USER", "VALUE" => "NAME"),
							"LAST_NAME" => Array("TYPE" => "USER", "VALUE" => "LAST_NAME"),
							"EMAIL" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["EMAIL"]),
							"ADDRESS" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["ADDRESS"]),
						)),
						"HAVE_PAYMENT" => "Y",
						"HAVE_ACTION" => "N",
						"HAVE_RESULT" => "Y",
						"HAVE_PREPAY" => "N",
						"HAVE_RESULT_RECEIVE" => "N",
					))

				),		
				Array(
					"NAME" => GetMessage("SALE_WIZARD_PS_WM"),
					"SORT" => 70,
					"DESCRIPTION" => GetMessage("SALE_WIZARD_PS_WM_DESCR"),
					"CODE_TEMP" => "webmoney",
					"ACTION" => Array(Array(
						"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["fiz"],
						"NAME" => GetMessage("SALE_WIZARD_PS_WM"),
						"ACTION_FILE" => "/bitrix/modules/sale/payment/webmoney_web",
						"RESULT_FILE" => "",
						"NEW_WINDOW" => "Y",
						"PARAMS" => "",
						"HAVE_PAYMENT" => "Y",
						"HAVE_ACTION" => "N",
						"HAVE_RESULT" => "Y",
						"HAVE_PREPAY" => "N",
						"HAVE_RESULT_RECEIVE" => "N",
					))

				),		
				Array(
					"NAME" => GetMessage("SALE_WIZARD_PS_PC"),
					"SORT" => 80,
					"DESCRIPTION" => "",
					"CODE_TEMP" => "paycash",
					"ACTION" => Array(Array(
						"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["fiz"],
						"NAME" => GetMessage("SALE_WIZARD_PS_PC"),
						"ACTION_FILE" => "/bitrix/modules/sale/payment/yandex",
						"RESULT_FILE" => "/bitrix/modules/sale/payment/assist_res.php",
						"NEW_WINDOW" => "N",
						"PARAMS" => serialize(Array(
							"ORDER_ID" => Array("TYPE" => "ORDER", "VALUE" => "ID"),
							"USER_ID" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["CONTACT_PERSON"]),
							"ORDER_DATE" => Array("TYPE" => "ORDER", "VALUE" => "DATE_INSERT"),
							"SHOULD_PAY" => Array("TYPE" => "ORDER", "VALUE" => "PRICE"),
						)),
						"HAVE_PAYMENT" => "Y",
						"HAVE_ACTION" => "N",
						"HAVE_RESULT" => "N",
						"HAVE_PREPAY" => "N",
						"HAVE_RESULT_RECEIVE" => "Y",
					))
				),		
				Array(
					"NAME" => GetMessage("SALE_WIZARD_PS_SB"),
					"SORT" => 90,
					"DESCRIPTION" => GetMessage("SALE_WIZARD_PS_SB_DESCR"),
					"CODE_TEMP" => "sberbank",
					"ACTION" => Array(Array(
						"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["fiz"],
						"NAME" => GetMessage("SALE_WIZARD_PS_SB"),
						"ACTION_FILE" => "/bitrix/modules/sale/payment/sberbank_new",
						"RESULT_FILE" => "",
						"NEW_WINDOW" => "Y",
						"PARAMS" => serialize(Array(
							"COMPANY_NAME" => Array("TYPE" => "", "VALUE" => GetMessage("SALE_WIZARD_PS_SB_CN")),
							"INN" => Array("TYPE" => "", "VALUE" => GetMessage("SALE_WIZARD_PS_SB_INN")),
							"KPP" => Array("TYPE" => "", "VALUE" => GetMessage("SALE_WIZARD_PS_SB_KPP")),
							"SETTLEMENT_ACCOUNT" => Array("TYPE" => "", "VALUE" => GetMessage("SALE_WIZARD_PS_SB_NC")),
							"BANK_NAME" => Array("TYPE" => "", "VALUE" => GetMessage("SALE_WIZARD_PS_SB_NB")),
							"BANK_BIC" => Array("TYPE" => "", "VALUE" => GetMessage("SALE_WIZARD_PS_SB_BR")),
							"BANK_COR_ACCOUNT" => Array("TYPE" => "", "VALUE" => GetMessage("SALE_WIZARD_PS_SB_NCB")),
							"ORDER_ID" => Array("TYPE" => "ORDER", "VALUE" => "ID"),
							"DATE_INSERT" => Array("TYPE" => "ORDER", "VALUE" => "DATE_INSERT_DATE"),
							"PAYER_CONTACT_PERSON" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["CONTACT_PERSON"]),
							"PAYER_ZIP_CODE" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["INDEX"]),
							"PAYER_COUNTRY" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["LOCATION"]."_COUNTRY"),
							"PAYER_CITY" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["LOCATION"]."_CITY"),
							"PAYER_ADDRESS_FACT" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["ADDRESS"]),
							"SHOULD_PAY" => Array("TYPE" => "ORDER", "VALUE" => "PRICE"),
						)),
						"HAVE_PAYMENT" => "Y",
						"HAVE_ACTION" => "N",
						"HAVE_RESULT" => "N",
						"HAVE_PREPAY" => "N",
						"HAVE_RESULT_RECEIVE" => "N",
					))

				),		
				Array(
					"NAME" => GetMessage("SALE_WIZARD_PS_BILL"),
					"SORT" => 100,
					"DESCRIPTION" => "",
					"CODE_TEMP" => "bill",
					"ACTION" => Array(Array(
						"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["ur"],
						"NAME" => GetMessage("SALE_WIZARD_PS_BILL"),
						"ACTION_FILE" => "/bitrix/modules/sale/payment/bill",
						"RESULT_FILE" => "",
						"NEW_WINDOW" => "Y",
						"PARAMS" => serialize(Array(
							"DATE_INSERT" => Array("TYPE" => "ORDER", "VALUE" => "DATE_INSERT_DATE"),
							"SELLER_NAME" => Array("TYPE" => "", "VALUE" => GetMessage("SALE_WIZARD_PS_BILL_BITRIX")),
							"SELLER_ADDRESS" => Array("TYPE" => "", "VALUE" => GetMessage("SALE_WIZARD_PS_BILL_ADDRESS")),
							"SELLER_PHONE" => Array("TYPE" => "", "VALUE" => "+74012510564"),
							"SELLER_INN" => Array("TYPE" => "", "VALUE" => GetMessage("SALE_WIZARD_PS_BILL_INN")),
							"SELLER_KPP" => Array("TYPE" => "", "VALUE" => GetMessage("SALE_WIZARD_PS_BILL_KPP")),
							"SELLER_RS" => Array("TYPE" => "", "VALUE" => GetMessage("SALE_WIZARD_PS_BILL_RS")),
							"SELLER_KS" => Array("TYPE" => "", "VALUE" => GetMessage("SALE_WIZARD_PS_BILL_KS")),
							"SELLER_BIK" => Array("TYPE" => "", "VALUE" => GetMessage("SALE_WIZARD_PS_BILL_BIK")),
							"BUYER_NAME" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["F_COMPANY_NAME"]),
							"BUYER_INN" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["F_INN"]),
							"BUYER_ADDRESS" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["F_ADDRESS_FULL"]),
							"BUYER_PHONE" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["F_PHONE"]),
							"BUYER_FAX" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["F_FAX"]),
							"BUYER_PAYER_NAME" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["F_NAME"]),
							"PATH_TO_STAMP" => Array("TYPE" => "", "VALUE" => "/images/pechat.gif"),
						)),
						"HAVE_PAYMENT" => "Y",
						"HAVE_ACTION" => "N",
						"HAVE_RESULT" => "N",
						"HAVE_PREPAY" => "N",
						"HAVE_RESULT_RECEIVE" => "N",
					))

				),
			);
	}
	else
	{
		$arPaySystems = Array(
			Array(
				"NAME" => "Cash",
				"SORT" => 50,
				"DESCRIPTION" => "You can pay in cash to our courier.",
				"CODE_TEMP" => "cash",
				"ACTION" => Array(
					Array(
						"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["fiz"],
						"NAME" => "Cash",
						"ACTION_FILE" => "/bitrix/modules/sale/payment/cash",
						"RESULT_FILE" => "",
						"NEW_WINDOW" => "N",
						"PARAMS" => "",
						"HAVE_PAYMENT" => "Y",
						"HAVE_ACTION" => "N",
						"HAVE_RESULT" => "N",
						"HAVE_PREPAY" => "N",
						"HAVE_RESULT_RECEIVE" => "N",
					),
					Array(
						"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["ur"],
						"NAME" => "Cash",
						"ACTION_FILE" => "/bitrix/modules/sale/payment/cash",
						"RESULT_FILE" => "",
						"NEW_WINDOW" => "N",
						"PARAMS" => "",
						"HAVE_PAYMENT" => "Y",
						"HAVE_ACTION" => "N",
						"HAVE_RESULT" => "N",
						"HAVE_PREPAY" => "N",
						"HAVE_RESULT_RECEIVE" => "N",
					),
				)
			),		

			Array(
				"NAME" => "Authorize.Net",
				"SORT" => 60,
				"DESCRIPTION" => "",
				"CODE_TEMP" => "authorizenet",
				"ACTION" => Array(Array(
					"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["fiz"],
					"NAME" => "Authorize.Net",
					"ACTION_FILE" => "/bitrix/modules/sale/payment/authorizenet",
					"NEW_WINDOW" => "N",
					"PARAMS" => serialize(Array(
					    "PS_LOGIN" => Array("TYPE" => "", "VALUE" => "Login ID"),
					    "PS_TRANSACTION_KEY" => Array("TYPE" => "", "VALUE" => "Transaction key"),
					    "HASH_VALUE" => Array("TYPE" => "", "VALUE" => "Hash value"),
					    "TEST_TRANSACTION" => Array("TYPE" => "", "VALUE" => "Test transaction"),
					    "FIRST_NAME" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["CONTACT_PERSON"]),
					    "LAST_NAME" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["CONTACT_PERSON"]),
						"ADDRESS" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["ADDRESS"]),
					    "CITY" => Array("TYPE" =>  "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["F_LOCATION"]."_CITY"),
					    "ZIP" => Array("TYPE" =>  "PROPERTY", "VALUE" =>  $arGeneralInfo["propCode"]["INDEX"]),
					    "COUNTRY" => Array("TYPE" =>  "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["F_LOCATION"]."_COUNTRY"),
					    "EMAIL" => Array("TYPE" => "USER", "VALUE" => "EMAIL"),
					    "SHIP_FIRST_NAME" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["CONTACT_PERSON"]),
					    "SHIP_LAST_NAME" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["CONTACT_PERSON"]),
					    "SHIP_ADDRESS" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["ADDRESS"]),
					    "SHIP_CITY" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["F_LOCATION"]."_CITY"),
					    "SHIP_ZIP" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["INDEX"]),
					    "SHIP_COUNTRY" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["F_LOCATION"]."_COUNTRY"),
						"SHOULD_PAY" => Array("TYPE" => "ORDER", "VALUE" => "PRICE"),
					)),
					"HAVE_PAYMENT" => "Y",
					"HAVE_ACTION" => "Y",
					"HAVE_RESULT" => "N",
					"HAVE_PREPAY" => "Y",
					"HAVE_RESULT_RECEIVE" => "N",
				))
			),		
			
			Array(
				"NAME" => "Payflow Pro",
				"SORT" => 70,
				"DESCRIPTION" => "",
				"CODE_TEMP" => "payflow",
				"ACTION" => Array(Array(
					"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["fiz"],
					"NAME" => "Payflow Pro",
					"ACTION_FILE" => "/bitrix/modules/sale/payment/payflow_pro",
					"NEW_WINDOW" => "N",
					"PARAMS" => serialize(Array(
					    "PAYFLOW_URL" => Array("TYPE" => "", "VALUE" => "test-payflow.verisign.com"),
					    "PAYFLOW_PORT" => Array("TYPE" => "", "VALUE" => 443),
					    "PAYFLOW_USER" => Array("TYPE" => "", "VALUE" => "User code"),
					    "PAYFLOW_PASSWORD" => Array("TYPE" => "", "VALUE" => "Password"),
					    "PAYFLOW_PARTNER" => Array("TYPE" => "", "VALUE" => "Partner"),
					    "PAYFLOW_EXE_PATH" => Array("TYPE" => "", "VALUE" => "/verisign/win32/bin/pfpro.exe"),
					    "PAYFLOW_CERT_PATH" => Array("TYPE" => "", "VALUE" => "/verisign/win32/certs/"),
					    "NOC" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["CONTACT_PERSON"]),
					    "ADDRESS" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["ADDRESS"]),
					    "ZIP" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["INDEX"]),
						"SHOULD_PAY" => Array("TYPE" => "ORDER", "VALUE" => "PRICE"),
					)),
					"HAVE_PAYMENT" => "Y",
					"HAVE_ACTION" => "Y",
					"HAVE_RESULT" => "N",
					"HAVE_PREPAY" => "Y",
					"HAVE_RESULT_RECEIVE" => "N",
					),
				Array(
					"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["ur"],
					"NAME" => "Payflow Pro",
					"ACTION_FILE" => "/bitrix/modules/sale/payment/payflow_pro",
					"NEW_WINDOW" => "N",
					"PARAMS" => serialize(Array(
					    "PAYFLOW_URL" => Array("TYPE" => "", "VALUE" => "test-payflow.verisign.com"),
					    "PAYFLOW_PORT" => Array("TYPE" => "", "VALUE" => 443),
					    "PAYFLOW_USER" => Array("TYPE" => "", "VALUE" => "User code"),
					    "PAYFLOW_PASSWORD" => Array("TYPE" => "", "VALUE" => "Password"),
					    "PAYFLOW_PARTNER" => Array("TYPE" => "", "VALUE" => "Partner"),
					    "PAYFLOW_EXE_PATH" => Array("TYPE" => "", "VALUE" => "/verisign/win32/bin/pfpro.exe"),
					    "PAYFLOW_CERT_PATH" => Array("TYPE" => "", "VALUE" => "/verisign/win32/certs/"),
					    "NOC" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["F_COMPANY_NAME"]),
					    "ADDRESS" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["F_ADDRESS_FULL"]),
					    "SHOULD_PAY" => Array("TYPE" => "ORDER", "VALUE" => "PRICE"),
					)),
					"HAVE_PAYMENT" => "Y",
					"HAVE_ACTION" => "Y",
					"HAVE_RESULT" => "N",
					"HAVE_PREPAY" => "Y",
					"HAVE_RESULT_RECEIVE" => "N",
					)
				)
			),		
	
			Array(
				"NAME" => "WorldPay",
				"SORT" => 80,
				"DESCRIPTION" => "",
				"CODE_TEMP" => "worldpay",
				"ACTION" => Array(Array(
					"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["fiz"],
					"NAME" => "WorldPay",
					"ACTION_FILE" => "/bitrix/modules/sale/payment/worldpay",
					"NEW_WINDOW" => "N",
					"PARAMS" => serialize(Array(
					    "TEST_TRANSACTION" => Array("TYPE" => "", "VALUE" => 101),
					    "SHOP_ID" => Array("TYPE" => "", "VALUE" => "WorldPay ID"),
					    "PAYER_NAME" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["CONTACT_PERSON"]),
					    "PHONE" => Array("TYPE" => "USER", "VALUE" => "PERSONAL_MOBILE"),
					    "EMAIL" => Array("TYPE" => "USER", "VALUE" => "EMAIL"),
					    "ADDRESS" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["ADDRESS"]),
					    "ZIP" => Array("TYPE" =>  "PROPERTY", "VALUE" =>  $arGeneralInfo["propCode"]["INDEX"]),
					    "COUNTRY" => Array("TYPE" =>  "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["F_LOCATION"]."_COUNTRY"),
					    "CALLBACK_PASSWORD" => Array("TYPE" => "", "VALUE" => ""),
						"SHOULD_PAY" => Array("TYPE" => "ORDER", "VALUE" => "PRICE"),
					)),
					"HAVE_PAYMENT" => "Y",
					"HAVE_ACTION" => "N",
					"HAVE_RESULT" => "Y",
					"HAVE_PREPAY" => "N",
					"HAVE_RESULT_RECEIVE" => "N",
					),
				Array(
					"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["ur"],
					"NAME" => "WorldPay",
					"ACTION_FILE" => "/bitrix/modules/sale/payment/worldpay",
					"NEW_WINDOW" => "N",
					"PARAMS" => serialize(Array(
					    "TEST_TRANSACTION" => Array("TYPE" => "", "VALUE" => 101),
					    "SHOP_ID" => Array("TYPE" => "", "VALUE" => "WorldPay ID"),
					    "PAYER_NAME" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["F_NAME"]),
					    "PHONE" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["F_PHONE"]),
					    "EMAIL" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["F_EMAIL"]),
					    "ADDRESS" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["F_ADDRESS_FULL"]),
					    "COUNTRY" => Array("TYPE" =>  "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["F_LOCATION"]."_COUNTRY"),
					    "CALLBACK_PASSWORD" => Array("TYPE" => "", "VALUE" => ""),
						"SHOULD_PAY" => Array("TYPE" => "ORDER", "VALUE" => "PRICE"),
					)),
					"HAVE_PAYMENT" => "Y",
					"HAVE_ACTION" => "N",
					"HAVE_RESULT" => "Y",
					"HAVE_PREPAY" => "N",
					"HAVE_RESULT_RECEIVE" => "N",
					)
				)
			),		
			Array(
			"NAME" => "PayPal",
			"SORT" => 90,
			"DESCRIPTION" => "",
			"CODE_TEMP" => "paypal",
			"ACTION" => Array(Array(
				"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["fiz"],
				"NAME" => "PayPal",
				"ACTION_FILE" => "/bitrix/modules/sale/payment/paypal",
				"NEW_WINDOW" => "Y",
				"PARAMS" => serialize(Array(
					"TEST_TRANSACTION" => Array("TYPE" => "", "VALUE" => 101),
					"SHOP_ID" => Array("TYPE" => "", "VALUE" => "WorldPay ID"),
					"PAYER_NAME" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["CONTACT_PERSON"]),
					"PHONE" => Array("TYPE" => "USER", "VALUE" => "PERSONAL_MOBILE"),
					"EMAIL" => Array("TYPE" => "USER", "VALUE" => "EMAIL"),
					"ADDRESS" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["ADDRESS"]),
					"ZIP" => Array("TYPE" =>  "PROPERTY", "VALUE" =>  $arGeneralInfo["propCode"]["INDEX"]),
					"COUNTRY" => Array("TYPE" =>  "PROPERTY", "VALUE" => $arGeneralInfo["propCode"]["F_LOCATION"]."_COUNTRY"),
					"CALLBACK_PASSWORD" => Array("TYPE" => "", "VALUE" => ""),
					"SHOULD_PAY" => Array("TYPE" => "ORDER", "VALUE" => "PRICE"),
				)),
				"HAVE_PAYMENT" => "Y",
				"HAVE_ACTION" => "N",
				"HAVE_RESULT" => "N",
				"HAVE_PREPAY" => "N",
				"HAVE_RESULT_RECEIVE" => "Y",
				),
				)
			),		
			Array(
			"NAME" => "Betalink",
			"SORT" => 90,
			"DESCRIPTION" => "",
			"CODE_TEMP" => "betalink",
			"ACTION" => Array(Array(
				"PERSON_TYPE_ID" => $arGeneralInfo["personType"]["fiz"],
				"NAME" => "betalink",
				"ACTION_FILE" => "/bitrix/modules/sale/payment/betalink",
				"NEW_WINDOW" => "Y",
				"PARAMS" => serialize(Array(
					"TEST_TRANSACTION" => Array("TYPE" => "", "VALUE" => "Test transaction"),
					"SHOP_CODE" => Array("TYPE" => "", "VALUE" => "Shop code"),
					"SHOULD_PAY" => Array("TYPE" => "ORDER", "VALUE" => "PRICE"),
				)),
				"HAVE_PAYMENT" => "Y",
				"HAVE_ACTION" => "N",
				"HAVE_RESULT" => "N",
				"HAVE_PREPAY" => "N",
				"HAVE_RESULT_RECEIVE" => "N",
				),
				)
			)
		);
	}
		
	foreach($arPaySystems as $val)
	{
		$id = CSalePaySystem::Add(
			Array(
				"LID" => $siteID,
				"CURRENCY" => ($bRus ? "RUB" : "USD"),
				"NAME" => $val["NAME"],
				"ACTIVE" => "Y",
				"SORT" => $val["SORT"],
				"DESCRIPTION" => $val["DESCRIPTION"]
			)
		);
		foreach($val["ACTION"] as $action)
		{
			$action["PAY_SYSTEM_ID"] = $id;
			CSalePaySystemAction::Add($action);
		}
	}



	//discounts
	CSaleDiscount::Add(
		Array(
			"LID" => $siteID,
			"PRICE_FROM" => 800,
			"PRICE_TO" => 1500,
			"CURRENCY" => ($bRus ? "RUB" : "USD"),
			"DISCOUNT_VALUE" => 20,
			"DISCOUNT_TYPE" => "P",
			"ACTIVE" => "Y",
			"SORT" => 200,
			"ACTIVE_FROM" => "",
			"ACTIVE_TO" => "",
		)
	);
	CSaleDiscount::Add(
		Array(
			"LID" => $siteID,
			"PRICE_FROM" => 500,
			"PRICE_TO" => 800,
			"CURRENCY" => ($bRus ? "RUB" : "USD"),
			"DISCOUNT_VALUE" => 15,
			"DISCOUNT_TYPE" => "P",
			"ACTIVE" => "Y",
			"SORT" => 100,
			"ACTIVE_FROM" => "",
			"ACTIVE_TO" => "",
		)
	);
	CSaleDiscount::Add(
		Array(
			"LID" => $siteID,
			"PRICE_FROM" => 1500,
			"PRICE_TO" => 0,
			"CURRENCY" => ($bRus ? "RUB" : "USD"),
			"DISCOUNT_VALUE" => 25,
			"DISCOUNT_TYPE" => "P",
			"ACTIVE" => "Y",
			"SORT" => 300,
			"ACTIVE_FROM" => "",
			"ACTIVE_TO" => "",
		)
	);

	if($bRus)
	{
		//1C export
		$val = serialize(Array(
				"AGENT_NAME" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCodeID"]["CONTACT_PERSON"]),
				"FULL_NAME" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCodeID"]["CONTACT_PERSON"]),
				"SURNAME" => Array("TYPE" => "USER", "VALUE" => "LAST_NAME"),
				"NAME" => Array("TYPE" => "USER", "VALUE" => "NAME"),
				"ADDRESS_FULL" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCodeID"]["ADDRESS"]),
				"INDEX" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCodeID"]["INDEX"]),
				"COUNTRY" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCodeID"]["LOCATION"]."_COUNTRY"),
				"CITY" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCodeID"]["LOCATION"]."_CITY"),
				"STREET" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCodeID"]["STREET"]),
				"EMAIL" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCodeID"]["EMAIL"]),
				"CONTACT_PERSON" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCodeID"]["CONTACT_PERSON"]),
				"IS_FIZ" => "Y",
			));
		CSaleExport::Add(Array("PERSON_TYPE_ID" => $arGeneralInfo["personType"]["fiz"], "VARS" => $val));

		$val = serialize(Array(
				"AGENT_NAME" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCodeID"]["F_COMPANY_NAME"]),
				"FULL_NAME" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCodeID"]["F_COMPANY_NAME"]),
				"ADDRESS_FULL" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCodeID"]["F_ADDRESS_FULL"]),
				"COUNTRY" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCodeID"]["F_LOCATION"]."_COUNTRY"),
				"CITY" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCodeID"]["F_LOCATION"]."_CITY"),
				"STREET" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCodeID"]["F_ADDRESS_FULL"]),
				"INN" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCodeID"]["F_INN"]),
				"KPP" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCodeID"]["F_KPP"]),
				"PHONE" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCodeID"]["F_PHONE"]),
				"EMAIL" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCodeID"]["F_EMAIL"]),
				"CONTACT_PERSON" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCodeID"]["F_NAME"]),
				"F_ADDRESS_FULL" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCodeID"]["F_ADDRESS"]),
				"F_COUNTRY" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCodeID"]["F_LOCATION"]."_COUNTRY"),
				"F_CITY" => Array("TYPE" => "PROPERTY", "VALUE" => $arGeneralInfo["propCodeID"]["F_LOCATION"]."_CITY"),
				"IS_FIZ" =>  "N",
			));
		CSaleExport::Add(Array("PERSON_TYPE_ID" => $arGeneralInfo["personType"]["ur"], "VARS" => $val));
	}

	$affiliatePlan = CSaleAffiliatePlan::Add(
		Array(
			"SITE_ID" => $siteID, 
			"NAME" => GetMessage("SALE_WIZARD_AFFILIATE_PLAN"),
			"ACTIVE" => "Y",
			"BASE_RATE" => 5,
			"BASE_RATE_TYPE" => "P",
			"MIN_PAY" => 0,
			"MIN_PAY_VALUE" => 1,
			)
		);
		
	
	CSaleAffiliate::Add(
		Array(
			"SITE_ID" => $siteID,
			"USER_ID" => 1,
			"PLAN_ID" => $affiliatePlan,
			"ACTIVE" => "Y",
			"DATE_CREATE" => ConvertTimeStamp(),
			"AFF_SITE" => "www.bitrixsoft.com",
			"AFF_DESCRIPTION" => GetMessage("SALE_WIZARD_AFFILIATE"),
			"FIX_PLAN" => "N"
			)
		);
}

DemoSiteUtil::AddMenuItem("/personal/.left.menu.php", Array(
	GetMessage("SALE_WIZARD_MENU_ORDERS"), 
	"/personal/order/", 
	Array(), 
	Array(), 
	"" 
));

DemoSiteUtil::AddMenuItem("/personal/.left.menu.php", Array(
	GetMessage("SALE_WIZARD_MENU_CART"), 
	"/personal/cart/", 
	Array(), 
	Array(), 
	"" 
));

DemoSiteUtil::AddMenuItem("/personal/.left.menu.php", Array(
	GetMessage("SALE_WIZARD_MENU_REGULAR_PAYMENT"), 
	"/personal/regular-payment/", 
	Array(), 
	Array(), 
	"" 
));

DemoSiteUtil::AddMenuItem("/personal/.left.menu.php", Array(
	GetMessage("SALE_WIZARD_MENU_PROFILES"), 
	"/personal/customer-profiles/", 
	Array(), 
	Array(), 
	"" 
));

DemoSiteUtil::AddMenuItem("/personal/.left.menu.php", Array(
	GetMessage("SALE_WIZARD_MENU_ACCOUNTS"), 
	"/personal/account/", 
	Array(), 
	Array(), 
	"" 
));

DemoSiteUtil::AddMenuItem("/e-store/.left.menu.php", Array(
	GetMessage("SALE_WIZARD_MENU_AFFILIATE"), 
	"/e-store/affiliates/", 
	Array(), 
	Array(), 
	"" 
));

$source_base = dirname(__FILE__);
CopyDirFiles($source_base."/public/personal/".$lang, $_SERVER["DOCUMENT_ROOT"]."/personal/", false, true);

CopyDirFiles($source_base."/public/affiliate/".$lang, $_SERVER["DOCUMENT_ROOT"]."/e-store", $rewrite = false, $recursive = true);

include(dirname(__FILE__)."/../e-store/index.php");

return true;
?>