<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)
{
	die();
}

/** @var array $arParams */
/** @var array $arResult */
/** @global CAllMain $APPLICATION */
/** @global CAllUser $USER */
/** @global CAllDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

use Bitrix\Main\Web\Json;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arParams['ID'] = $arParams['ID'] ?: 'def';
$containerId = 'main-user-selector-' . $arParams['ID'];
?>
<span id="<?=htmlspecialcharsbx($containerId)?>" class="main-user-selector-wrap">
	<?if ($arResult['IS_INPUT_MULTIPLE']):?>
		<?foreach ($arResult['LIST_USER'] as $id):?>
			<input type="hidden" name="<?=$arParams['INPUT_NAME']?>"
				value="<?=htmlspecialcharsbx($id)?>"
			>
		<?endforeach;?>
	<?else:?>
		<input type="hidden" id="<?=$arParams['INPUT_NAME']?>"
			name="<?=$arParams['INPUT_NAME']?>"
			value="<?=htmlspecialcharsbx(implode(',', $arResult['LIST_USER']))?>"
		>
	<?endif;?>

	<?
	$APPLICATION->IncludeComponent('bitrix:ui.tile.selector', '', array(
		'ID' => $arParams['ID'],
		'LIST' => $arResult['LIST'],
		'SHOW_BUTTON_ADD' => false,
		'READONLY' => $arParams['READONLY'],
		'BUTTON_SELECT_CAPTION' => Loc::getMessage('MAIN_USER_SELECTOR_SELECT')
	));
	?>

	<?
	$APPLICATION->IncludeComponent(
		"bitrix:main.ui.selector",
		".default",
		array(
			'ID' => $arParams['ID'],
			'BIND_ID' => $containerId,
			'ITEMS_SELECTED' => [],
			'CALLBACK' => array(
				'select' => 'BX.Main.User.SelectorController.select',
				'unSelect' => 'BX.Main.User.SelectorController.unSelect',
				'openDialog' => "BX.Main.User.SelectorController.openDialog",
				'closeDialog' => "BX.Main.User.SelectorController.closeDialog",
				'openSearch' => "BX.Main.User.SelectorController.openSearch"
			),
			'OPTIONS' => [
					'useNewCallback' => 'Y',
					'eventInit' => 'BX.Main.User.SelectorController::init',
					'eventOpen' => 'BX.Main.User.SelectorController::open',
				]
				+
				$arParams['SELECTOR_OPTIONS']
				+
				[
					'extranetContext' => false,
					'context' => null,
					'contextCode' => 'U',
					'useSearch' => 'N',
					'userNameTemplate' => CUtil::JSEscape($arParams["NAME_TEMPLATE"]),
					'useClientDatabase' => 'Y',
					'allowEmailInvitation' => 'N',
					'enableAll' => 'N',
					'enableDepartments' => 'N',
					'enableSonetgroups' => 'N',
					'departmentSelectDisable' => 'Y',
					'allowAddUser' => 'N',
					'allowAddCrmContact' => 'N',
					'allowAddSocNetGroup' => 'N',
					'allowSearchEmailUsers' => 'N',
					'allowSearchCrmEmailUsers' => 'N',
					'allowSearchNetworkUsers' => 'N',
					'allowSonetGroupsAjaxSearchFeatures' => 'N'
			]
		),
		false,
		array("HIDE_ICONS" => "Y")
	);?>

	<script type="text/javascript">
		BX.ready(function () {
			new BX.Main.User.Selector(<?=Json::encode(array(
				'containerId' => $containerId,
				'id' => $arParams['ID'],
				'duplicates' => false,
				'inputName' => $arParams['INPUT_NAME'],
				'isInputMultiple' => $arResult['IS_INPUT_MULTIPLE']
			))?>);
		});
	</script>
</span>