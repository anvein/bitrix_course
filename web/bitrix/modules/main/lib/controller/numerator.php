<?php
namespace Bitrix\Main\Controller;

use Bitrix\Main;

/**
 * Class Numerator
 * @package Bitrix\Main\Controller
 */
class Numerator extends Main\Engine\Controller
{
	/**
	 * @return array
	 * @throws \Bitrix\Main\ArgumentException
	 * @throws \Bitrix\Main\NotImplementedException
	 * @throws \Bitrix\Main\SystemException
	 */
	public function saveAction()
	{
		$request = $this->getRequest();
		$result = (new Main\Numerator\Service\NumeratorRequestManager($request))->saveFromRequest();

		if (!$result->isSuccess())
		{
			foreach ($result->getErrorCollection() as $index => $error)
			{
				$this->errorCollection[] = $error;
			}
			return [];
		}
		return ['id' => $id = $result->getId()];
	}
}