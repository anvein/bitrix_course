<?php
/**
 * Bitrix Framework
 * @package    bitrix
 * @subpackage main
 * @copyright  2001-2018 Bitrix
 */

namespace Bitrix\Main\ORM\Objectify;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Objectify\EntityObject;
use Bitrix\Main\ORM\Entity;
use Bitrix\Main\ORM\Query\Query;
use Bitrix\Main\NotImplementedException;
use Bitrix\Main\ORM\Fields\FieldTypeMask;
use Bitrix\Main\SystemException;

/**
 * Collection of entity objects. Used to hold 1:N and N:M object collections.
 *
 * @package    bitrix
 * @subpackage main
 */
abstract class Collection implements \ArrayAccess, \Iterator
{
	/** @var Entity */
	protected $entity;

	/** @var  EntityObject[] */
	protected $objects;

	/** @var bool */
	protected $isFilled = false;

	/** @var bool */
	protected $isSinglePrimary;

	/** @var array [SerializedPrimary => RUNTIME_CHANGE_CODE] */
	protected $objectsRuntimeChanged;

	/** @var  EntityObject[] */
	protected $objectsRemoved;

	/** @var EntityObject[] Used for Iterator interface, allows to delete elements during foreach loop */
	protected $iterableObjects;

	/** @var int Code for $objectsRuntimeChanged */
	const RUNTIME_ADDED = 1;

	/** @var int Code for $objectsRuntimeChanged */
	const RUNTIME_REMOVED = 2;

	/**
	 * Collection constructor.
	 *
	 * @param Entity $entity
	 *
	 * @throws ArgumentException
	 * @throws SystemException
	 */
	public function __construct(Entity $entity = null)
	{
		if (empty($entity))
		{
			if (__CLASS__ !== get_called_class())
			{
				// custom collection class
				$dataClass = static::dataClass();
				$this->entity = $dataClass::getEntity();
			}
			else
			{
				throw new ArgumentException('Entity required when constructing collection');
			}
		}
		else
		{
			$this->entity = $entity;
		}

		$this->isSinglePrimary = count($this->entity->getPrimaryArray()) == 1;
	}

	/**
	 * DataManager (Table) class. Can be overridden.
	 *
	 * @return string|DataManager
	 */
	public static function dataClass()
	{
		return substr(get_called_class(), 0, -10).'Table';
	}

	/**
	 * @param EntityObject $object
	 */
	public function add(EntityObject $object)
	{
		$srPrimary = $this->getPrimaryKey($object);

		if (empty($this->objects[$srPrimary]))
		{
			$this->objects[$srPrimary] = $object;
			$this->objectsRuntimeChanged[$srPrimary] = static::RUNTIME_ADDED;
		}
	}

	/**
	 * @param EntityObject $object
	 *
	 * @return bool
	 */
	public function has(EntityObject $object)
	{
		return array_key_exists($this->getPrimaryKey($object), $this->objects);
	}

	/**
	 * @param $primary
	 *
	 * @return bool
	 * @throws ArgumentException
	 */
	public function hasByPrimary($primary)
	{
		$normalizedPrimary = $this->normalizePrimary($primary);
		return array_key_exists($this->serializePrimaryKey($normalizedPrimary), $this->objects);
	}

	/**
	 * @param $primary
	 *
	 * @return EntityObject
	 * @throws ArgumentException
	 */
	public function getByPrimary($primary)
	{
		$normalizedPrimary = $this->normalizePrimary($primary);
		return $this->objects[$this->serializePrimaryKey($normalizedPrimary)];
	}

	/**
	 * @return EntityObject[]
	 */
	public function getAll()
	{
		return array_values($this->objects);
	}

	/**
	 * @param EntityObject $object
	 */
	public function remove(EntityObject $object)
	{
		$srPrimary = $this->getPrimaryKey($object);

		unset($this->objects[$srPrimary]);

		if (!isset($this->objectsRuntimeChanged[$srPrimary]) || $this->objectsRuntimeChanged[$srPrimary] != static::RUNTIME_ADDED)
		{
			// regular remove
			$this->objectsRuntimeChanged[$srPrimary] = static::RUNTIME_REMOVED;
			$this->objectsRemoved[$srPrimary] = $object;
		}
		elseif (isset($this->objectsRuntimeChanged[$srPrimary]) && $this->objectsRuntimeChanged[$srPrimary] == static::RUNTIME_ADDED)
		{
			// silent remove for added runtime
			unset($this->objectsRuntimeChanged[$srPrimary]);
			unset($this->objectsRemoved[$srPrimary]);
		}
	}

	/**
	 * Fills all the values and relations of object
	 *
	 * @param int|string[] $fields Names of fields to fill
	 *
	 * @throws ArgumentException
	 * @throws SystemException
	 */
	public function fill($fields = FieldTypeMask::ALL)
	{
		$entityPrimary = $this->entity->getPrimaryArray();

		$primaryValues = [];
		$fieldsToSelect = $entityPrimary;

		if (is_scalar($fields) && !is_numeric($fields))
		{
			$fields = [$fields];
		}

		// collect custom fields to select
		if (is_array($fields))
		{
			$fieldsToSelect = array_merge($fieldsToSelect, $fields);
		}

		foreach ($this->objects as $object)
		{
			// collect primary
			$objectPrimary = $object->sysRequirePrimary();

			$primaryValues[] = count($objectPrimary) == 1
				? current($objectPrimary)
				: $objectPrimary;

			// collect fields to select if there is a fields flag instead of custom list
			if (!is_array($fields))
			{
				$diff = array_diff($object->sysGetIdleFields($fields), $fieldsToSelect);
				$fieldsToSelect = array_merge($fieldsToSelect, $diff);
			}
		}

		// build primary filter
		$primaryFilter = Query::filter();

		if (count($entityPrimary) == 1)
		{
			// IN for single-primary objects
			$primaryFilter->whereIn($entityPrimary[0], $primaryValues);
		}
		else
		{
			// OR for multi-primary objects
			$primaryFilter->logic('or');

			foreach ($primaryValues as $objectPrimary)
			{
				// add each object as a separate condition
				$oneObjectFilter = Query::filter();

				foreach ($objectPrimary as $primaryName => $primaryValue)
				{
					$oneObjectFilter->where($primaryName, $primaryValue);
				}

				$primaryFilter->where($oneObjectFilter);
			}
		}

		// build query
		$dataClass = $this->entity->getDataClass();
		$result = $dataClass::query()->setSelect($fieldsToSelect)->where($primaryFilter)->exec();

		// set object to identityMap of result, and it will be partially completed by fetch
		$im = new IdentityMap;

		foreach ($this->objects as $object)
		{
			$im->put($object);
		}

		$result->setIdentityMap($im);
		$result->fetchCollection();
	}

	public function isFilled()
	{
		return $this->isFilled;
	}

	/**
	 * @return bool
	 */
	public function isChanged()
	{
		return !empty($this->objectsRuntimeChanged);
	}

	/**
	 * @return array
	 * @throws SystemException
	 */
	public function getChanges()
	{
		$changes = [];

		foreach ($this->objectsRuntimeChanged as $srPrimary => $changeCode)
		{
			if (isset($this->objects[$srPrimary]))
			{
				$changedObject = $this->objects[$srPrimary];
			}
			elseif (isset($this->objectsRemoved[$srPrimary]))
			{
				$changedObject = $this->objectsRemoved[$srPrimary];
			}
			else
			{
				$changedObject = null;
			}

			if (empty($changedObject))
			{
				throw new SystemException(sprintf(
					'Object with primary `%s` was not found in `%s` collection', $srPrimary, get_class($this)
				));
			}

			$changes[] = [$changedObject, $changeCode];
		}

		return $changes;
	}

	public function resetChanges($rollback = false)
	{
		if ($rollback)
		{
			foreach ($this->objectsRuntimeChanged as $srPrimary => $changeCode)
			{
				if ($changeCode === static::RUNTIME_ADDED)
				{
					unset($this->objects[$srPrimary]);
				}
				elseif ($changeCode === static::RUNTIME_REMOVED)
				{
					$this->objects[$srPrimary] = $this->objectsRemoved[$srPrimary];
				}
			}
		}

		$this->objectsRuntimeChanged = [];
		$this->objectsRemoved = [];
	}

	/**
	 * Constructs set of existing objects from pre-selected data, including references and relations.
	 *
	 * @param $rows
	 *
	 * @return array|static
	 * @throws ArgumentException
	 * @throws SystemException
	 */
	public static function wakeUp($rows)
	{
		// define object class
		$dataClass = static::dataClass();
		$objectClass = $dataClass::getObjectClass();

		// complete collection
		$collection = new static;

		foreach ($rows as $row)
		{
			$collection->sysAddActual($objectClass::wakeUp($row));
		}

		return $collection;
	}

	public function __call($name, $arguments)
	{
		$first3 = substr($name, 0, 3);
		$last4 = substr($name, -4);

		// group getter
		if ($first3 == 'get' && $last4 == 'List')
		{
			$fieldName = EntityObject::sysMethodToFieldCase(substr($name, 3, -4));

			// check if field exists
			if ($this->entity->hasField($fieldName))
			{
				$values = [];

				// collect field values
				foreach ($this->objects as $objectPrimary => $object)
				{
					$values[$objectPrimary] = $object->sysGetValue($fieldName);
				}

				return $values;
			}
		}

		$first4 = substr($name, 0, 4);

		// filler
		if ($first4 == 'fill')
		{
			$fieldName = EntityObject::sysMethodToFieldCase(substr($name, 4));

			// check if field exists
			if ($this->entity->hasField($fieldName))
			{
				return $this->fill([$fieldName]);
			}
		}

		throw new SystemException(sprintf(
			'Unknown method `%s` for object `%s`', $name, get_called_class()
		));
	}

	public function sysAddActual(EntityObject $object)
	{
		$this->objects[$this->getPrimaryKey($object)] = $object;
	}

	public function sysSetFilled($value = true)
	{
		$this->isFilled = $value;
	}

	protected function normalizePrimary($primary)
	{
		// normalize primary
		$primaryNames = $this->entity->getPrimaryArray();

		if (!is_array($primary))
		{
			if (count($primaryNames) > 1)
			{
				throw new ArgumentException(sprintf(
					'Only one value of primary found, when entity %s has %s primary keys',
					$this->entity->getDataClass(), count($primaryNames)
				));
			}

			$primary = [$primaryNames[0] => $primary];
		}

		// check in $this->objects
		$normalizedPrimary = [];

		foreach ($primaryNames as $primaryName)
		{
			$normalizedPrimary[$primaryName] = $primary[$primaryName];
		}

		return $normalizedPrimary;
	}

	public function getPrimaryKey(EntityObject $object)
	{
		return $this->serializePrimaryKey($object->primary());
	}

	protected function serializePrimaryKey($primary)
	{
		if ($this->isSinglePrimary)
		{
			return current($primary);
		}

		return json_encode(array_values($primary));
	}

	/**
	 * ArrayAccess implementation
	 *
	 * @param mixed $offset
	 * @param mixed $value
	 */
	public function offsetSet($offset, $value)
	{
		$this->add($value);
	}

	/**
	 * ArrayAccess implementation
	 *
	 * @param mixed $offset
	 *
	 * @return bool|void
	 * @throws NotImplementedException
	 */
	public function offsetExists($offset)
	{
		throw new NotImplementedException;
	}

	/**
	 * ArrayAccess implementation
	 *
	 * @param mixed $offset
	 *
	 * @throws NotImplementedException
	 */
	public function offsetUnset($offset)
	{
		throw new NotImplementedException;
	}

	/**
	 * ArrayAccess implementation
	 *
	 * @param mixed $offset
	 *
	 * @return mixed|void
	 * @throws NotImplementedException
	 */
	public function offsetGet($offset)
	{
		throw new NotImplementedException;
	}

	/**
	 * Iterator implementation
	 */
	public function rewind()
	{
		$this->iterableObjects = $this->objects;
		reset($this->iterableObjects);
	}

	/**
	 * Iterator implementation
	 *
	 * @return EntityObject|mixed
	 */
	public function current()
	{
		return current($this->iterableObjects);
	}

	/**
	 * Iterator implementation
	 *
	 * @return int|mixed|null|string
	 */
	public function key()
	{
		return key($this->iterableObjects);
	}

	/**
	 * Iterator implementation
	 */
	public function next()
	{
		next($this->iterableObjects);
	}

	/**
	 * Iterator implementation
	 *
	 * @return bool
	 */
	public function valid()
	{
		return key($this->iterableObjects) !== null;
	}
}
