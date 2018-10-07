<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Loader;
use Bitrix\Main\Error;

Loc::loadMessages(__FILE__);

/**
 * Class MainUserSelectorComponent
 */
class MainUserSelectorComponent extends CBitrixComponent
{
	/** @var ErrorCollection $errors */
	protected $errors;

	protected function checkRequiredParams()
	{
		if (empty($this->arParams['INPUT_NAME']))
		{
			$this->errors->setError(new Error('Parameter `INPUT_NAME` required.'));
			return false;
		}
		if (empty($this->arParams['ID']))
		{
			$this->errors->setError(new Error('Parameter `ID` required.'));
			return false;
		}

		return true;
	}

	protected function initParams()
	{
		$this->arParams['INPUT_NAME'] = isset($this->arParams['INPUT_NAME']) ? $this->arParams['INPUT_NAME'] : '';
		$this->arParams['ID'] = isset($this->arParams['ID']) ?
			$this->arParams['ID']
			:
			str_replace(['[', ']'], ['_', ''], $this->arParams['INPUT_NAME']);

		$this->arParams['LIST'] = isset($this->arParams['LIST']) ? $this->arParams['LIST'] : [];
		$this->arParams['READONLY'] = isset($this->arParams['READONLY']) ? (bool) $this->arParams['READONLY'] : false;
		$this->arParams['BUTTON_SELECT_CAPTION'] = isset($this->arParams['BUTTON_SELECT_CAPTION']) ? $this->arParams['BUTTON_SELECT_CAPTION'] : null;
		$this->arParams['NAME_TEMPLATE'] = empty($this->arParams['NAME_TEMPLATE']) ? \CAllSite::GetNameFormat(false) : str_replace(array("#NOBR#","#/NOBR#"), array("",""), $this->arParams["NAME_TEMPLATE"]);
		$this->arParams['SELECTOR_OPTIONS'] = is_array($this->arParams['SELECTOR_OPTIONS']) ? $this->arParams['SELECTOR_OPTIONS'] : [];

		if (isset($this->arParams['SHOW_BUTTON_SELECT']))
		{
			$this->arParams['SHOW_BUTTON_SELECT'] = (bool) $this->arParams['SHOW_BUTTON_SELECT'];
		}
		else
		{
			$this->arParams['SHOW_BUTTON_SELECT'] = true;
		}

		if (isset($this->arParams['DUPLICATES']))
		{
			$this->arParams['DUPLICATES'] = (bool) $this->arParams['DUPLICATES'];
		}
		else
		{
			$this->arParams['DUPLICATES'] = false;
		}
	}

	protected function prepareResult()
	{
		$this->arResult['LIST_USER'] = [];
		$this->arResult['LIST'] = [];
		$list = is_array($this->arParams['LIST']) ? $this->arParams['LIST'] : [];
		//if (empty($list))
		//{
		//	/** @var \CAllUser {$GLOBALS['USER']} */
		//	$list[] = $GLOBALS['USER']->GetID();
		//}

		$tileIds = [];
		$userList = \Bitrix\Main\UserTable::getList([
			'select' => ['ID', 'NAME', 'LAST_NAME', 'SECOND_NAME', 'LOGIN'],
			'filter' => ['=ID' => $list]
		]);
		foreach ($userList as $userData)
		{
			$id = (int) $userData['ID'];
			if (!in_array($id, $list))
			{
				continue;
			}

			// format name
			$userName = \CAllUser::FormatName(
				$this->arParams['NAME_TEMPLATE'],
				[
					'LOGIN' => $userData['LOGIN'],
					'NAME' => $userData['NAME'],
					'LAST_NAME' => $userData['LAST_NAME'],
					'SECOND_NAME' => $userData['SECOND_NAME']
				],
				true, false
			);

			$item = [
				'id' => $userData['ID'],
				'name' => $userName,
				'data' => [],
			];

			if (!$this->arParams['DUPLICATES'] && in_array($id, $tileIds))
			{
				continue;
			}

			$tileIds[] = $id;
			$this->arResult['LIST'][] = array(
				'name' => $item['name'],
				'data' => $item['data'],
				'id' => $id,
				'bgcolor' => isset($item['bgcolor']) ? $item['bgcolor'] : null,
				'color' => isset($item['color']) ? $item['color'] : null,
			);
		}
		$this->arResult['LIST_USER'] = $tileIds;

		$this->arResult['IS_INPUT_MULTIPLE'] = substr($this->arParams['INPUT_NAME'], -2) == '[]';

		return true;
	}

	protected function printErrors()
	{
		foreach ($this->errors as $error)
		{
			ShowError($error);
		}
	}

	public function onPrepareComponentParams($arParams)
	{
		$this->errors = new \Bitrix\Main\ErrorCollection();
		if (!Loader::includeModule('socialnetwork'))
		{
			$this->errors->setError(new Error('Module `socialnetwork` is not installed.'));
			return $arParams;
		}

		$this->arParams = $arParams;
		$this->initParams();
		if (!$this->checkRequiredParams())
		{
			$this->printErrors();
		}

		return $this->arParams;
	}

	public function executeComponent()
	{
		if (!$this->errors->isEmpty())
		{
			return;
		}

		if (!$this->prepareResult())
		{
			$this->printErrors();
			return;
		}

		$this->includeComponentTemplate();
	}
}