<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arFormFields = array(
	array(
		'SID' => 'NAME',
		'REQUIRED' => 'Y',
		'arANSWER' => array(
			array(
				'MESSAGE' => ' ',
				'VALUE' => '',
				'C_SORT' => 100,
				'ACTIVE' => 'Y',
				'FIELD_TYPE' => 'text',
			),
		),
		'arFILTER_USER' => array('text'),
	),

	array(
		'SID' => 'COMPANY',
		'REQUIRED' => 'N',
		'arANSWER' => array(
			array(
				'MESSAGE' => ' ',
				'VALUE' => '',
				'C_SORT' => 100,
				'ACTIVE' => 'Y',
				'FIELD_TYPE' => 'text',
			),
		),
		'arFILTER_USER' => array('text'),
	),
	
	array(
		'SID' => 'POSITION',
		'REQUIRED' => 'N',
		'arANSWER' => array(
			array(
				'MESSAGE' => ' ',
				'VALUE' => '',
				'C_SORT' => 100,
				'ACTIVE' => 'Y',
				'FIELD_TYPE' => 'text',
			),
		),
		'arFILTER_USER' => array('text'),
	),

	array(
		'SID' => 'EMAIL',
		'REQUIRED' => 'Y',
		'arANSWER' => array(
			array(
				'MESSAGE' => ' ',
				'VALUE' => '',
				'C_SORT' => 100,
				'ACTIVE' => 'Y',
				'FIELD_TYPE' => 'email',
			),
		),
		'arFILTER_ANSWER_TEXT' => array('text'),
	),

	array(
		'SID' => 'PHONE',
		'REQUIRED' => 'N',
		'arANSWER' => array(
			array(
				'MESSAGE' => ' ',
				'VALUE' => '',
				'C_SORT' => 100,
				'ACTIVE' => 'Y',
				'FIELD_TYPE' => 'text',
			),
		),
		'arFILTER_ANSWER_TEXT' => array('text'),
	),
	
	array(
		'SID' => 'QUESTIONS',
		'REQUIRED' => 'Y',
		'arANSWER' => array(
			array(
				'MESSAGE' => ' ',
				'VALUE' => '',
				'C_SORT' => 100,
				'ACTIVE' => 'Y',
				'FIELD_TYPE' => 'textarea',
				'FIELD_HEIGHT' => 10,
				'FIELD_WIDTH' => 30,
			),
		),
		'arFILTER_ANSWER_VALUE' => array('text'),
	),
);

// set defaults
$arFieldDefaults = array(
	'FORM_ID' => $FORM_ID,
	'ACTIVE' => 'Y',
	'C_SORT' => 0,
	'ADDITIONAL' => 'N',
	'TITLE_TYPE' => 'text',
	'IN_RESULTS_TABLE' => 'Y',
	'IN_EXCEL_TABLE' => 'Y',
);

foreach ($arFormFields as $key => $arField)
{
	$arFieldDefaults['C_SORT'] += 100;
	$arFormFields[$key] = array_merge($arField, $arFieldDefaults);
	
	$arFormFields[$key]['TITLE'] = GetMessage('WIZDEMO_FORM_FEEDBACK_FLD_'.$arField['SID']);
}
?>