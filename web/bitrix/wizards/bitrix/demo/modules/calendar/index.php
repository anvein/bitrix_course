<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

if(!CModule::IncludeModule("calendar") || (defined(WIZARD_IS_RERUN) && WIZARD_IS_RERUN))
	return;

//Library
include_once(dirname(__FILE__)."/../iblock/iblock_tools.php");
__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", "/".basename(__FILE__)));

COption::SetOptionString("intranet", "calendar_2", "Y");

// calendar type
$arTypes = CCalendarType::GetList(array("arFilter" => array("XML_ID" => 'events')));
if (!$arTypes || count($arTypes) <= 0)
{
	CCalendarType::Edit(array(
		'NEW' => true,
		'arFields' => array(
			'XML_ID' => 'events',
			'NAME' => GetMessage('CAL_DEFAULT_TYPE'),
			'ACCESS' => array(
				'G2' => CCalendar::GetAccessTasksByName('calendar_type', 'calendar_type_view')
			)
		)
	));
}

// Sections
$sectId0 = CCalendar::SaveSection(
	array(
		'arFields' => Array(
			'CAL_TYPE' => 'events',
			'ID' => 0,
			'NAME' => GetMessage("CAL_TYPE_COMPANY_NAME"),
			'DESCRIPTION' => "",
			'COLOR' => '#855CC5',
			'TEXT_COLOR' => '',
			'OWNER_ID' => '',
			'EXPORT' => array(
				'ALLOW' => true,
				'SET' => '3_9'
			),
			'ACCESS' => array(),
			'IS_EXCHANGE' => false
		)
	)
);

// Events for company_calendar
CCalendar::SaveEvent(array(
	'arFields' => array(
		'CAL_TYPE' => 'events',
		'OWNER_ID' => 0,
		'NAME' => GetMessage("CAL_EVENT_1_NAME"),
		'DESCRIPTION' => "",
		'DT_FROM' => GetTime(mktime(0, 0, 0, date("m"), date("d") + 4, date("Y")) , "FULL"),
		'DT_TO' => GetTime(mktime(0, 0, 0, date("m"), date("d") + 4, date("Y")) , "FULL"),
		'RRULE' => array(),
		'SECTIONS' => $sectId0
	),
	'userId' => 1
));

CCalendar::SaveEvent(array(
	'arFields' => array(
		'CAL_TYPE' => 'events',
		'OWNER_ID' => 0,
		'NAME' => GetMessage("CAL_EVENT_2_NAME"),
		'DESCRIPTION' => "",
		'COLOR' => '#FFFF80',
		'DT_FROM' => GetTime(mktime(0, 0, 0, date("m"), date("d"), date("Y")) , "SHORT"),
		'DT_TO' => GetTime(mktime(0, 0, 0, date("m"), date("d"), date("Y")) , "SHORT"),
		'RRULE' => array(
			'FREQ' => 'WEEKLY',
			'INTERVAL' => 3,
			'BYDAY' => 'SA'
		),
		'SECTIONS' => $sectId0
	),
	'userId' => 1
));

// Copy public files
CopyDirFiles(dirname(__FILE__)."/public/language/".LANGUAGE_ID."/calendar/", $_SERVER["DOCUMENT_ROOT"]."/content/calendar", false, false);;

//Add menu item
DEMO_IBlock_AddMenuItem("/content/.left.menu.php", Array(
	GetMessage('CAL_MENU_ITEM'),
	"/content/calendar/",
	Array(),
	Array(),
	"",
));

?>