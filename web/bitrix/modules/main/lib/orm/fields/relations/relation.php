<?php
/**
 * Bitrix Framework
 * @package    bitrix
 * @subpackage main
 * @copyright  2001-2018 Bitrix
 */

namespace Bitrix\Main\ORM\Fields\Relations;

use Bitrix\Main\ORM\Entity;
use Bitrix\Main\ORM\Fields\Field;

/**
 * Performs relation mapping: back-reference and many-to-many relations.
 *
 * @package    bitrix
 * @subpackage main
 */
abstract class Relation extends Field
{
	/** @var string Name of target entity */
	protected $refEntityName;

	/** @var Entity Target entity */
	protected $refEntity;

	/**
	 * @return Entity
	 * @throws \Bitrix\Main\ArgumentException
	 * @throws \Bitrix\Main\SystemException
	 */
	public function getRefEntity()
	{
		if ($this->refEntity === null)
		{
			$this->refEntity = Entity::getInstance($this->refEntityName);
		}

		return $this->refEntity;
	}
}
