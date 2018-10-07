<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$index = $index1 = $index2 = 0;

$arFormFields = array(
	array(
		'SID' => 'VS_NAME',
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
		'SID' => 'VS_BIRTHDAY',
		'REQUIRED' => 'Y',
		'arANSWER' => array(
			array(
				'MESSAGE' => ' ',
				'VALUE' => '',
				'C_SORT' => 100,
				'ACTIVE' => 'Y',
				'FIELD_TYPE' => 'date',
			),
		),
		'arFILTER_USER' => array('date'),
	),
	
	array(
		'SID' => 'VS_ADDRESS',
		'REQUIRED' => 'Y',
		'arANSWER' => array(
			array(
				'MESSAGE' => ' ',
				'VALUE' => '',
				'C_SORT' => 100,
				'ACTIVE' => 'Y',
				'FIELD_TYPE' => 'textarea',
				'FIELD_HEIGHT' => 6,
				'FIELD_WIDTH' => 30,
			),
		),
		'arFILTER_USER' => array('text'),
	),

	array(
		'SID' => 'VS_MARRIED',
		'REQUIRED' => 'Y',
		'arANSWER' => array(
			array(
				'MESSAGE' => GetMessage('WIZDEMO_FORM_ANKETA_VS_MARRIED_V1'),
				'VALUE' => '',
				'C_SORT' => 100,
				'ACTIVE' => 'Y',
				'FIELD_TYPE' => 'radio',
				'FIELD_PARAM' => 'SELECTED',
			),
			array(
				'MESSAGE' => GetMessage('WIZDEMO_FORM_ANKETA_VS_MARRIED_V2'),
				'VALUE' => '',
				'C_SORT' => 200,
				'ACTIVE' => 'Y',
				'FIELD_TYPE' => 'radio',
			),
		),
		'arFILTER_ANSWER_TEXT' => array('dropdown'),
	),

	array(
		'SID' => 'VS_INTEREST',
		'REQUIRED' => 'N',
		'arANSWER' => array(
			array(
				'MESSAGE' => GetMessage('WIZDEMO_FORM_ANKETA_VS_INTEREST_V'.(++$index)),
				'VALUE' => $index,
				'C_SORT' => $index * 100,
				'ACTIVE' => 'Y',
				'FIELD_TYPE' => 'checkbox',
				'FIELD_PARAM' => '',
			),
			array(
				'MESSAGE' => GetMessage('WIZDEMO_FORM_ANKETA_VS_INTEREST_V'.(++$index)),
				'VALUE' => $index,
				'C_SORT' => $index * 100,
				'ACTIVE' => 'Y',
				'FIELD_TYPE' => 'checkbox',
				'FIELD_PARAM' => '',
			),
			array(
				'MESSAGE' => GetMessage('WIZDEMO_FORM_ANKETA_VS_INTEREST_V'.(++$index)),
				'VALUE' => $index,
				'C_SORT' => $index * 100,
				'ACTIVE' => 'Y',
				'FIELD_TYPE' => 'checkbox',
				'FIELD_PARAM' => '',
			),
			array(
				'MESSAGE' => GetMessage('WIZDEMO_FORM_ANKETA_VS_INTEREST_V'.(++$index)),
				'VALUE' => $index,
				'C_SORT' => $index * 100,
				'ACTIVE' => 'Y',
				'FIELD_TYPE' => 'checkbox',
				'FIELD_PARAM' => '',
			),
			array(
				'MESSAGE' => GetMessage('WIZDEMO_FORM_ANKETA_VS_INTEREST_V'.(++$index)),
				'VALUE' => $index,
				'C_SORT' => $index * 100,
				'ACTIVE' => 'Y',
				'FIELD_TYPE' => 'checkbox',
				'FIELD_PARAM' => 'CHECKED',
			),
		),
		'arFILTER_ANSWER_TEXT' => array('text', 'dropdown'),
	),
	
	array(
		'SID' => 'VS_AGE',
		'REQUIRED' => 'Y',
		'arANSWER' => array(
			array(
				'MESSAGE' => '-',
				'VALUE' => '',
				'C_SORT' => (++$index1) * 100,
				'ACTIVE' => 'Y',
				'FIELD_TYPE' => 'dropdown',
				'FIELD_PARAM' => 'NOT_ANSWER'
			),
			array(
				'MESSAGE' => (++$index1).'0-'.$index1.'9',
				'VALUE' => $index1.'0',
				'C_SORT' => $index1 * 100,
				'ACTIVE' => 'Y',
				'FIELD_TYPE' => 'dropdown',
			),
			array(
				'MESSAGE' => (++$index1).'0-'.$index1.'9',
				'VALUE' => $index1.'0',
				'C_SORT' => $index1 * 100,
				'ACTIVE' => 'Y',
				'FIELD_TYPE' => 'dropdown',
				'FIELD_PARAM' => 'SELECTED'
			),
			array(
				'MESSAGE' => (++$index1).'0-'.$index1.'9',
				'VALUE' => $index1.'0',
				'C_SORT' => $index1 * 100,
				'ACTIVE' => 'Y',
				'FIELD_TYPE' => 'dropdown',
			),
			array(
				'MESSAGE' => (++$index1).'0-'.$index1.'9',
				'VALUE' => $index1.'0',
				'C_SORT' => $index1 * 100,
				'ACTIVE' => 'Y',
				'FIELD_TYPE' => 'dropdown',
			),
			array(
				'MESSAGE' => str_replace('#AGE#', (++$index1).'0', GetMessage('WIZDEMO_FORM_ANKETA_VS_AGE_FINAL')),
				'VALUE' => $index1.'0',
				'C_SORT' => $index1 * 100,
				'ACTIVE' => 'Y',
				'FIELD_TYPE' => 'dropdown',
			),
		),
		'arFILTER_ANSWER_VALUE' => array('text', 'dropdown'),
	),

	array(
		'SID' => 'VS_EDUCATION',
		'REQUIRED' => 'N',
		'arANSWER' => array(
			array(
				'MESSAGE' => GetMessage('WIZDEMO_FORM_ANKETA_VS_EDUCATION_V'.(++$index2)),
				'VALUE' => $index2,
				'C_SORT' => $index2 * 100,
				'ACTIVE' => 'Y',
				'FIELD_TYPE' => 'multiselect',
			),
			array(
				'MESSAGE' => GetMessage('WIZDEMO_FORM_ANKETA_VS_EDUCATION_V'.(++$index2)),
				'VALUE' => $index2,
				'C_SORT' => $index2 * 100,
				'ACTIVE' => 'Y',
				'FIELD_TYPE' => 'multiselect',
			),
			array(
				'MESSAGE' => GetMessage('WIZDEMO_FORM_ANKETA_VS_EDUCATION_V'.(++$index2)),
				'VALUE' => $index2,
				'C_SORT' => $index2 * 100,
				'ACTIVE' => 'Y',
				'FIELD_TYPE' => 'multiselect',
				'FIELD_PARAM' => 'SELECTED',
			),
			array(
				'MESSAGE' => GetMessage('WIZDEMO_FORM_ANKETA_VS_EDUCATION_V'.(++$index2)),
				'VALUE' => 0,
				'C_SORT' => $index2 * 100,
				'ACTIVE' => 'Y',
				'FIELD_TYPE' => 'multiselect',
			),
		),
		'arFILTER_ANSWER_TEXT' => array('text', 'dropdown'),
	),
	
	array(
		'SID' => 'VS_INCOME',
		'REQUIRED' => 'N',
		'arANSWER' => array(
			array(
				'MESSAGE' => ' ',
				'VALUE' => '',
				'C_SORT' => 100,
				'ACTIVE' => 'Y',
				'FIELD_TYPE' => 'text',
				'FIELD_WIDTH' => '10',
			),
		),
		'arFILTER_USER' => array('text'),
	),
	
	array(
		'SID' => 'VS_PHOTO',
		'REQUIRED' => 'N',
		'arANSWER' => array(
			array(
				'MESSAGE' => ' ',
				'VALUE' => '',
				'C_SORT' => 100,
				'ACTIVE' => 'Y',
				'FIELD_TYPE' => 'file',
			),
		),
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

	$arFormFields[$key]['TITLE'] = GetMessage('WIZDEMO_FORM_ANKETA_'.$arField['SID']);
}
?>