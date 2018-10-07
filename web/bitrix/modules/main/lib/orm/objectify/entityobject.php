<?php
/**
 * Bitrix Framework
 * @package    bitrix
 * @subpackage main
 * @copyright  2001-2018 Bitrix
 */

namespace Bitrix\Main\ORM\Objectify;

use Bitrix\Main\ORM\Entity;
use Bitrix\Main\ORM\Fields\ExpressionField;
use Bitrix\Main\ORM\Fields\IReadable;
use Bitrix\Main\ORM\Fields\Relations\ManyToMany;
use Bitrix\Main\ORM\Fields\Relations\OneToMany;
use Bitrix\Main\ORM\Fields\UserTypeField;
use Bitrix\Main\ORM\Query\Query;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Data\Result;
use Bitrix\Main\ORM\Fields\ScalarField;
use Bitrix\Main\ORM\Fields\FieldTypeMask;
use Bitrix\Main\SystemException;
use Bitrix\Main\ArgumentException;

/**
 * Entity object.
 *
 * @method mixed get($fieldName)
 * @method mixed actual($fieldName)
 * @method mixed require($fieldName)
 * @method $this set($fieldName, $value)
 * @method $this reset($fieldName)
 * @method $this unset($fieldName)
 * @method void addTo($fieldName, $value)
 * @method void removeFrom($fieldName, $value)
 * @method void removeAll($fieldName)
 * 
 * @package    bitrix
 * @subpackage main
 */
abstract class EntityObject implements \ArrayAccess
{
	/** @var Entity */
	protected $entity;

	/**
	 * @var int
	 * @see State
	 */
	protected $state = State::RAW;

	/**
	 * Actual values fetched from DB and collections of relations
	 * @var mixed[]|static[]|Collection[]
	 */
	protected $actualValues = [];

	/**
	 * Current values - actual or rewritten by setter (except changed collections - they are still in actual values)
	 * @var mixed[]|static[]
	 */
	protected $runtimeValues = [];

	/**
	 * Cache for lastName => LAST_NAME transforming
	 * @var string[]
	 */
	protected static $camelToSnakeCache = [];

	public function __construct($setDefaultValues = true)
	{
		if ($setDefaultValues)
		{
			foreach ($this->entity()->getScalarFields() as $fieldName => $field)
			{
				$defaultValue = $field->getDefaultValue($this);

				if ($defaultValue !== null)
				{
					$this->sysSetValue($fieldName, $defaultValue);
				}
			}
		}
	}

	/**
	 * DataManager (Table) class. Can be overridden.
	 *
	 * @return string|\Bitrix\Main\ORM\Data\DataManager
	 */
	public static function dataClass()
	{
		return get_called_class().'Table';
	}

	/**
	 * @return Entity
	 * @throws \Bitrix\Main\ArgumentException
	 * @throws \Bitrix\Main\SystemException
	 */
	public function entity()
	{
		if ($this->entity === null)
		{
			/** @var \Bitrix\Main\ORM\Data\DataManager $dataClass */
			$dataClass = static::dataClass();
			$this->entity = $dataClass::getEntity();
		}

		return $this->entity;
	}

	/**
	 * Returns [primary => value] array.
	 *
	 * @return array
	 * @throws ArgumentException
	 * @throws SystemException
	 */
	public function primary()
	{
		$primaryValues = [];

		foreach ($this->entity()->getPrimaryArray() as $primaryName)
		{
			$primaryValues[$primaryName] = $this->sysGetValue($primaryName);
		}

		return $primaryValues;
	}

	/**
	 * Returns all objects values as an array
	 *
	 * @param int $valuesType
	 * @param int $fieldsMask
	 *
	 * @return array
	 * @throws ArgumentException
	 * @throws SystemException
	 */
	public function values($valuesType = Values::ALL, $fieldsMask = FieldTypeMask::ALL)
	{
		switch ($valuesType)
		{
			case Values::ACTUAL:
				$objectValues = $this->actualValues;
				break;
			case Values::RUNTIME:
				$objectValues = $this->runtimeValues;
				break;
			default:
				$objectValues = array_merge($this->actualValues, $this->runtimeValues);
		}

		// filter with field mask
		if ($fieldsMask !== FieldTypeMask::ALL)
		{
			foreach ($objectValues as $fieldName => $value)
			{
				$fieldMask = $this->entity()->getField($fieldName)->getTypeMask();
				if (!($fieldsMask & $fieldMask))
				{
					unset($objectValues[$fieldName]);
				}
			}
		}

		// remap from uppercase to real field names
		$values = [];

		foreach ($objectValues as $k => $v)
		{
			$values[$this->entity()->getField($k)->getName()] = $v;
		}

		return $values;
	}

	/**
	 * ActiveRecord save.
	 *
	 * @return Result
	 * @throws ArgumentException
	 * @throws SystemException
	 * @throws \Exception
	 */
	public function save()
	{
		$result = new Result;
		$dataClass = $this->entity()->getDataClass();

		if ($this->state == State::RAW)
		{
			$data = $this->runtimeValues;
			$data['__object'] = $this;

			// put secret key __object to array
			$result = $dataClass::add($data);

			// check for error
			if (!$result->isSuccess())
			{
				return $result;
			}

			// set primary
			foreach ($result->getPrimary() as $primaryName => $primaryValue)
			{
				$this->sysSetActual($primaryName, $primaryValue);
			}
		}
		elseif ($this->state == State::CHANGED)
		{
			// changed scalar and reference
			if (!empty($this->runtimeValues))
			{
				$data = $this->runtimeValues;
				$data['__object'] = $this;

				// put secret key __object to array
				$result = $dataClass::update($this->primary(), $data);

				// check for error
				if (!$result->isSuccess())
				{
					return $result;
				}
			}
		}
		else
		{
			// nothing to do
			return $result;
		}

		// set other fields, as long as some values could be added or modified in events
		foreach ($result->getData() as $fieldName => $fieldValue)
		{
			$field = $this->entity()->getField($fieldName);

			if ($field instanceof ScalarField)
			{
				$fieldValue = $field->cast($fieldValue);
			}

			$this->sysSetActual($fieldName, $fieldValue);
		}

		// changed collections
		$this->saveRelations($result);

		// return if there were errors
		if (!$result->isSuccess())
		{
			return $result;
		}

		// clear runtime values
		$this->runtimeValues = [];

		// change state
		$this->sysChangeState(State::ACTUAL);

		return $result;
	}

	/**
	 * ActiveRecord delete.
	 *
	 * @return Result
	 * @throws ArgumentException
	 * @throws SystemException
	 */
	public function delete()
	{
		$result = new Result;

		// delete relations
		foreach ($this->entity()->getFields() as $field)
		{
			if ($field instanceof OneToMany || $field instanceof ManyToMany)
			{
				$this->sysRemoveAllFromCollection($field->getName());
			}
		}

		$this->saveRelations($result);

		// delete object itself
		$dataClass = static::dataClass();
		$deleteResult = $dataClass::delete($this->primary());
		$result->addErrors($deleteResult->getErrors());

		// clear status
		foreach ($this->entity()->getPrimaryArray()as $primaryName)
		{
			unset($this->actualValues[$primaryName]);
		}

		$this->sysChangeState(State::RAW);

		return $result;
	}

	/**
	 * Constructs existing object from pre-selected data, including references and relations.
	 *
	 * @param mixed $row Array of [field => value] or single scalar primary value.
	 *
	 * @return static
	 * @throws ArgumentException
	 * @throws SystemException
	 */
	public static function wakeUp($row)
	{
		/** @var static $objectClass */
		$objectClass = get_called_class();

		/** @var \Bitrix\Main\ORM\Data\DataManager $dataClass */
		$dataClass = static::dataClass();

		$entity = $dataClass::getEntity();
		$entityPrimary = $entity->getPrimaryArray();

		// normalize input data and primary
		$primary = [];

		if (!is_array($row))
		{
			// it could be single primary
			if (count($entityPrimary) == 1)
			{
				$primary[$entityPrimary[0]] = $row;
				$row = [];
			}
			else
			{
				throw new ArgumentException(sprintf(
					'Multi-primary for %s was not found', $objectClass
				));
			}
		}
		else
		{
			foreach ($entityPrimary as $primaryName)
			{
				if (!isset($row[$primaryName]))
				{
					throw new ArgumentException(sprintf(
						'Primary %s for %s was not found', $primaryName, $objectClass
					));
				}

				$primary[$primaryName] = $row[$primaryName];
				unset($row[$primaryName]);
			}
		}

		// create object
		/** @var static $object */
		$object = new $objectClass(false); // here go with false to not set default values
		$object->sysChangeState(State::ACTUAL);

		// set primary
		foreach ($primary as $primaryName => $primaryValue)
		{
			/** @var ScalarField $primaryField */
			$primaryField = $entity->getField($primaryName);
			$object->sysSetActual($primaryName, $primaryField->cast($primaryValue));
		}

		// set other data
		foreach ($row as $fieldName => $value)
		{
			/** @var ScalarField $primaryField */
			$field = $entity->getField($fieldName);

			if ($field instanceof IReadable)
			{
				$object->sysSetActual($fieldName, $field->cast($value));
			}
			else
			{
				// we have a relation
				if ($value instanceof static || $value instanceof Collection)
				{
					// it is ready data
					$object->sysSetActual($fieldName, $value);
				}
				else
				{
					// wake up relation
					if ($field instanceof Reference)
					{
						// wake up an object
						$remoteObjectClass = $field->getRefEntity()->getObjectClass();
						$remoteObject = $remoteObjectClass::wakeUp($value);

						$object->sysSetActual($fieldName, $remoteObject);
					}
					elseif ($field instanceof OneToMany || $field instanceof ManyToMany)
					{
						// wake up collection
						$remoteCollectionClass = $field->getRefEntity()->getCollectionClass();
						$remoteCollection = $remoteCollectionClass::wakeUp($value);

						$object->sysSetActual($fieldName, $remoteCollection);
					}
				}
			}
		}

		return $object;
	}

	/**
	 * Magic to handle getters, setters etc.
	 *
	 * @param $name
	 * @param $arguments
	 *
	 * @return mixed
	 * @throws ArgumentException
	 * @throws SystemException
	 */
	public function __call($name, $arguments)
	{
		$first3 = substr($name, 0, 3);

		// regular getter
		if ($first3 == 'get')
		{
			$fieldName = self::sysMethodToFieldCase(substr($name, 3));

			if (!strlen($fieldName))
			{
				$fieldName = strtoupper($arguments[0]);

				// hard field check
				$this->entity()->getField($fieldName);
			}

			// check if field exists
			if ($this->entity()->hasField($fieldName))
			{
				return $this->sysGetValue($fieldName);
			}
		}

		// regular setter
		if ($first3 == 'set')
		{
			$fieldName = self::sysMethodToFieldCase(substr($name, 3));
			$value = $arguments[0];

			if (!strlen($fieldName))
			{
				$fieldName = strtoupper($arguments[0]);
				$value = $arguments[1];

				// hard field check
				$this->entity()->getField($fieldName);
			}

			// check if field exists
			if ($this->entity()->hasField($fieldName))
			{
				$field = $this->entity()->getField($fieldName);

				if ($field instanceof IReadable)
				{
					$value = $field->cast($value);
				}

				return $this->sysSetValue($fieldName, $value);
			}
		}

		$first4 = substr($name, 0, 4);

		// filler
		if ($first4 == 'fill')
		{
			$fieldName = self::sysMethodToFieldCase(substr($name, 4));

			// check if field exists
			if ($this->entity()->hasField($fieldName))
			{
				return $this->fill([$fieldName]);
			}
		}

		$first5 = substr($name, 0, 5);

		// relation adder
		if ($first5 == 'addTo')
		{
			$fieldName = self::sysMethodToFieldCase(substr($name, 5));
			$value = $arguments[0];

			if (!strlen($fieldName))
			{
				$fieldName = strtoupper($arguments[0]);
				$value = $arguments[1];
			}

			if ($this->entity()->hasField($fieldName))
			{
				return $this->sysAddToCollection($fieldName, $value);
			}
		}

		// unsetter
		if ($first5 == 'unset')
		{
			$fieldName = self::sysMethodToFieldCase(substr($name, 5));

			if (!strlen($fieldName))
			{
				$fieldName = strtoupper($arguments[0]);
			}

			if ($this->entity()->hasField($fieldName))
			{
				return $this->sysUnset($fieldName);
			}
		}

		// resetter
		if ($first5 == 'reset')
		{
			$fieldName = self::sysMethodToFieldCase(substr($name, 5));

			if (!strlen($fieldName))
			{
				$fieldName = strtoupper($arguments[0]);
			}

			if ($this->entity()->hasField($fieldName))
			{
				$field = $this->entity()->getField($fieldName);

				if ($field instanceof OneToMany || $field instanceof ManyToMany)
				{
					return $this->sysResetRelation($fieldName);
				}
				else
				{
					return $this->sysReset($fieldName);
				}
			}
		}

		$first9 = substr($name, 0, 9);

		// relation mass remover
		if ($first9 == 'removeAll')
		{
			$fieldName = self::sysMethodToFieldCase(substr($name, 9));

			if (!strlen($fieldName))
			{
				$fieldName = strtoupper($arguments[0]);
			}

			if ($this->entity()->hasField($fieldName))
			{
				return $this->sysRemoveAllFromCollection($fieldName);
			}
		}

		$first10 = substr($name, 0, 10);

		// relation remover
		if ($first10 == 'removeFrom')
		{
			$fieldName = self::sysMethodToFieldCase(substr($name, 10));
			$value = $arguments[0];

			if (!strlen($fieldName))
			{
				$fieldName = strtoupper($arguments[0]);
				$value = $arguments[1];
			}

			if ($this->entity()->hasField($fieldName))
			{
				return $this->sysRemoveFromCollection($fieldName, $value);
			}
		}

		$first6 = substr($name, 0, 6);

		// actual value getter
		if ($first6 == 'actual')
		{
			$fieldName = self::sysMethodToFieldCase(substr($name, 6));

			if (!strlen($fieldName))
			{
				$fieldName = strtoupper($arguments[0]);

				// hard field check
				$this->entity()->getField($fieldName);
			}

			// check if field exists
			if ($this->entity()->hasField($fieldName))
			{
				return $this->actualValues[$fieldName];
			}
		}

		$first7 = substr($name, 0, 7);

		// strict getter
		if ($first7 == 'require')
		{
			$fieldName = self::sysMethodToFieldCase(substr($name, 7));

			if (!strlen($fieldName))
			{
				$fieldName = strtoupper($arguments[0]);

				// hard field check
				$this->entity()->getField($fieldName);
			}

			// check if field exists
			if ($this->entity()->hasField($fieldName))
			{
				return $this->sysGetValue($fieldName, true);
			}
		}

		throw new SystemException(sprintf(
			'Unknown method `%s` for object `%s`', $name, get_called_class()
		));
	}

	/**
	 * Fills all the values and relations of object
	 *
	 * @param int|string[] $fields Names of fields to fill
	 *
	 * @return mixed
	 * @throws ArgumentException
	 * @throws SystemException
	 */
	public function fill($fields = FieldTypeMask::ALL)
	{
		// object must have primary
		$primaryFilter = Query::filter();

		foreach ($this->sysRequirePrimary() as $primaryName => $primaryValue)
		{
			$primaryFilter->where($primaryName, $primaryValue);
		}

		// collect fields to be selected
		$fieldsToSelect = $this->entity()->getPrimaryArray();

		if (is_array($fields))
		{
			// get custom fields
			$fieldsToSelect = array_merge($fieldsToSelect, $fields);
		}
		elseif (is_scalar($fields) && !is_numeric($fields))
		{
			// one custom field
			$fieldsToSelect[] = $fields;
		}
		else
		{
			// get fields according to selector mask
			$fieldsToSelect = array_merge($fieldsToSelect, $this->sysGetIdleFields($fields));
		}

		// build query
		$dataClass = $this->entity()->getDataClass();
		$result = $dataClass::query()->setSelect($fieldsToSelect)->where($primaryFilter)->exec();

		// set object to identityMap of result, and it will be partially completed by fetch
		$im = new IdentityMap;
		$im->put($this);

		$result->setIdentityMap($im);
		$result->fetchObject();

		// set filled flag to collections
		foreach ($fieldsToSelect as $fieldName)
		{
			// check field before continue, it could be remote REF.ID definition so we skip it here
			if ($this->entity()->hasField($fieldName))
			{
				$field = $this->entity()->getField($fieldName);

				if ($field instanceof OneToMany || $field instanceof ManyToMany)
				{
					/** @var Collection $collection */
					$collection = $this->sysGetValue($fieldName);
					$collection->sysSetFilled();
				}
			}
		}

		// return field value it it was only one
		if (is_array($fields) && count($fields) == 1 && $this->entity()->hasField(current($fields)))
		{
			return $this->sysGetValue(current($fields));
		}

		return null;
	}

	/**
	 * Sets actual value. For internal system usage only.
	 *
	 * @param $fieldName
	 * @param $value
	 */
	public function sysSetActual($fieldName, $value)
	{
		$this->actualValues[strtoupper($fieldName)] = $value;
	}

	/**
	 * Changes state. For internal system usage only.
	 * @see State
	 *
	 * @param $state
	 */
	public function sysChangeState($state)
	{
		if ($this->state !== $state)
		{
			/* not sure if we need check or changes here
			if ($state == State::RAW)
			{
				// actual should be empty
			}
			elseif ($state == State::ACTUAL)
			{
				// runtime values should be empty
			}
			elseif ($state == State::CHANGED)
			{
				// runtime values should not be empty
			}*/

			$this->state = $state;
		}

	}

	/**
	 * Returns current state. For internal system usage only.
	 * @see State
	 *
	 * @return int
	 */
	public function sysGetState()
	{
		return $this->state;
	}

	/**
	 * Regular getter, called by __call.
	 *
	 * @param string $fieldName
	 * @param bool $require Throws an exception in the absence of value
	 *
	 * @return mixed
	 * @throws SystemException
	 */
	public function sysGetValue($fieldName, $require = false)
	{
		$fieldName = strtoupper($fieldName);

		if (array_key_exists($fieldName, $this->runtimeValues))
		{
			return $this->runtimeValues[$fieldName];
		}
		else
		{
			if ($require && !array_key_exists($fieldName, $this->actualValues))
			{
				throw new SystemException(sprintf(
					'%s value is required for further operations', $fieldName
				));
			}

			return $this->actualValues[$fieldName];
		}
	}

	/**
	 * Regular setter, called by __call. Doesn't validate values.
	 * For internal system usage only.
	 *
	 * @param $fieldName
	 * @param $value
	 *
	 * @return $this
	 * @throws ArgumentException
	 * @throws SystemException
	 */
	public function sysSetValue($fieldName, $value)
	{
		$fieldName = strtoupper($fieldName);
		$field = $this->entity()->getField($fieldName);

		// system validations
		if ($field instanceof ScalarField)
		{
			// restrict updating primary
			if ($this->state !== State::RAW && in_array($field->getName(), $this->entity()->getPrimaryArray()))
			{
				throw new SystemException(sprintf(
					'Setting value for Primary `%s` in `%s` is not allowed, it is read-only field',
					$field->getName(), get_called_class()
				));
			}
		}

		// no setter for expressions
		if ($field instanceof ExpressionField && !($field instanceof UserTypeField))
		{
			throw new SystemException(sprintf(
				'Setting value for ExpressionField `%s` in `%s` is not allowed, it is read-only field',
				$fieldName, get_called_class()
			));
		}

		if ($field instanceof Reference)
		{
			if (!empty($value))
			{
				// validate object class and skip null
				$remoteObjectClass = $field->getRefEntity()->getObjectClass();

				if (!($value instanceof $remoteObjectClass))
				{
					throw new ArgumentException(sprintf(
						'Expected instance of `%s`, got `%s` instead', $remoteObjectClass, get_class($value)
					));
				}
			}
		}

		// change only if value is different from actual
		if (array_key_exists($fieldName, $this->actualValues))
		{
			if ($field instanceof IReadable)
			{
				if ($field->cast($value) === $this->actualValues[$fieldName])
				{
					// forget previous runtime change
					unset($this->runtimeValues[$fieldName]);
					return $this;
				}
			}
			elseif ($field instanceof Reference)
			{
				/** @var static $value */
				if ($value->primary() === $this->actualValues[$fieldName]->primary())
				{
					// forget previous runtime change
					unset($this->runtimeValues[$fieldName]);
					return $this;
				}
			}
		}

		// set value
		if ($field instanceof ScalarField || $field instanceof UserTypeField)
		{
			$this->runtimeValues[$fieldName] = $value;
		}
		elseif ($field instanceof Reference)
		{
			/** @var static $value */
			$this->runtimeValues[$fieldName] = $value;

			// set elemental fields if there are any
			$elementals = $field->getElementals();

			if (!empty($elementals))
			{
				foreach ($elementals as $localFieldName => $remoteFieldName)
				{
					$elementalValue = empty($value) ? null : $value->sysGetValue($remoteFieldName);
					$this->sysSetValue($localFieldName, $elementalValue);
				}
			}
		}
		else
		{
			throw new SystemException(sprintf(
				'Unknown field type `%s` in system setter of `%s`', get_class($field), get_called_class()
			));
		}

		if ($this->state == State::ACTUAL)
		{
			$this->sysChangeState(State::CHANGED);
		}

		return $this;
	}

	public function sysUnset($fieldName)
	{
		$fieldName = strtoupper($fieldName);

		unset($this->runtimeValues[$fieldName]);
		unset($this->actualValues[$fieldName]);

		return $this;
	}

	public function sysReset($fieldName)
	{
		$fieldName = strtoupper($fieldName);

		unset($this->runtimeValues[$fieldName]);

		return $this;
	}

	public function sysResetRelation($fieldName)
	{
		$fieldName = strtoupper($fieldName);

		if (isset($this->actualValues[$fieldName]))
		{
			/** @var Collection $collection */
			$collection = $this->actualValues[$fieldName];
			$collection->resetChanges(true);
		}

		return $this;
	}

	public function sysRequirePrimary()
	{
		$primaryValues = [];

		foreach ($this->entity()->getPrimaryArray() as $primaryName)
		{
			try
			{
				$primaryValues[$primaryName] = $this->sysGetValue($primaryName, true);
			}
			catch (SystemException $e)
			{
				throw new SystemException(sprintf(
					'Primary `%s` value is required for further operations', $primaryName
				));
			}
		}

		return $primaryValues;
	}

	public function sysGetIdleFields($mask = FieldTypeMask::ALL)
	{
		$list = [];

		foreach ($this->entity()->getFields() as $field)
		{
			$fieldMask = $field->getTypeMask();

			if (!isset($this->actualValues[strtoupper($field->getName())])
				&& ($mask & $fieldMask)
			)
			{
				$list[] = $field->getName();
			}
		}

		return $list;
	}

	/**
	 * @param Result $result
	 *
	 * @throws ArgumentException
	 * @throws SystemException
	 */
	protected function saveRelations(Result $result)
	{
		foreach ($this->actualValues as $fieldName => $value)
		{
			$field = $this->entity()->getField($fieldName);

			if ($field instanceof OneToMany && $value->isChanged())
			{
				// save changed elements of collection
				$collection = $value;

				foreach ($collection->getChanges() as $change)
				{
					list($remoteObject,) = $change;

					// no matter what changeType is, just save the remote object
					// elementals will be changed after add or nulled after remove
					/** @var static $remoteObject */
					$remoteResult = $remoteObject->save();
					$result->addErrors($remoteResult->getErrors());
				}

				// forget collection changes
				$collection->resetChanges();
			}
			elseif ($field instanceof ManyToMany && $value->isChanged())
			{
				$collection = $value;

				foreach ($collection->getChanges() as $change)
				{
					list($remoteObject, $changeType) = $change;

					// initialize mediator object
					$mediatorObjectClass = $field->getMediatorEntity()->getObjectClass();
					$localReferenceName = $field->getLocalReferenceName();
					$remoteReferenceName = $field->getRemoteReferenceName();

					/** @var static $mediatorObject */
					$mediatorObject = new $mediatorObjectClass;
					$mediatorObject->sysSetValue($localReferenceName, $this);
					$mediatorObject->sysSetValue($remoteReferenceName, $remoteObject);

					// add or remove mediator depending on changeType
					if ($changeType == Collection::RUNTIME_ADDED)
					{
						$mediatorObject->save();
					}
					elseif ($changeType == Collection::RUNTIME_REMOVED)
					{
						// destroy directly through data class
						$mediatorDataClass = $field->getMediatorEntity()->getDataClass();
						$mediatorDataClass::delete($mediatorObject->primary());
					}
				}

				// forget collection changes
				$collection->resetChanges();
			}
		}
	}

	public function sysAddToCollection($fieldName, $remoteObject)
	{
		$fieldName = strtoupper($fieldName);

		/** @var OneToMany $field */
		$field = $this->entity()->getField($fieldName);
		$remoteObjectClass = $field->getRefEntity()->getObjectClass();

		// validate object class
		if (!($remoteObject instanceof $remoteObjectClass))
		{
			throw new ArgumentException(sprintf(
				'Expected instance of `%s`, got `%s` instead', $remoteObjectClass, get_class($remoteObject)
			));
		}

		// initialize collection
		$collection = $this->sysGetValue($fieldName);

		if (empty($collection))
		{
			$collection = $field->getRefEntity()->createCollection();
			$this->actualValues[$fieldName] = $collection;
		}

		// add to collection
		$collection->add($remoteObject);

		if ($field instanceof OneToMany)
		{
			// set self to the object
			$remoteFieldName = $field->getRefField()->getName();
			$remoteObject->sysSetValue($remoteFieldName, $this);
		}

		// mark object as changed
		$this->sysChangeState(State::CHANGED);
	}

	public function sysRemoveFromCollection($fieldName, $remoteObject)
	{
		$fieldName = strtoupper($fieldName);

		/** @var OneToMany $field */
		$field = $this->entity()->getField($fieldName);
		$remoteObjectClass = $field->getRefEntity()->getObjectClass();

		// validate object class
		if (!($remoteObject instanceof $remoteObjectClass))
		{
			throw new ArgumentException(sprintf(
				'Expected instance of `%s`, got `%s` instead', $remoteObjectClass, get_class($remoteObject)
			));
		}

		// initialize collection
		$collection = $this->sysGetValue($fieldName);

		if (empty($collection))
		{
			$collection = $field->getRefEntity()->createCollection();
			$this->actualValues[$fieldName] = $collection;
		}

		// remove from collection
		$collection->remove($remoteObject);

		if ($field instanceof OneToMany)
		{
			// remove self from the object
			$remoteFieldName = $field->getRefField()->getName();
			$remoteObject->sysSetValue($remoteFieldName, null);
		}

		// mark object as changed
		$this->sysChangeState(State::CHANGED);
	}

	public function sysRemoveAllFromCollection($fieldName)
	{
		$fieldName = strtoupper($fieldName);

		/** @var OneToMany|ManyToMany $field */
		$field = $this->entity()->getField($fieldName);

		// initialize collection
		$collection = $this->sysGetValue($fieldName);

		if (empty($collection))
		{
			$collection = $field->getRefEntity()->createCollection();
			$this->actualValues[$fieldName] = $collection;
		}

		// check collection fullness
		if (!$collection->isFilled())
		{
			// we need only primary here
			$remotePrimaryDefinitions = [];

			foreach ($field->getRefEntity()->getPrimaryArray() as $primaryName)
			{
				$remotePrimaryDefinitions[] = $fieldName.'.'.$primaryName;
			}

			$this->fill($remotePrimaryDefinitions);

			// we can set fullness flag here
			$collection->sysSetFilled();
		}

		// remove one by one
		foreach ($collection as $remoteObject)
		{
			$this->sysRemoveFromCollection($fieldName, $remoteObject);
		}
	}

	public static function sysMethodToFieldCase($methodName)
	{
		if (!isset(static::$camelToSnakeCache[$methodName]))
		{
			static::$camelToSnakeCache[$methodName] = strtoupper(
				preg_replace('/(.)([A-Z])/', '$1_$2', $methodName)
			);
		}

		return static::$camelToSnakeCache[$methodName];
	}

	/**
	 * ArrayAccess interface implementation.
	 *
	 * @param mixed $offset
	 *
	 * @return bool
	 * @throws ArgumentException
	 * @throws SystemException
	 */
	public function offsetExists($offset)
	{
		return $this->entity()->hasField($offset);
	}

	/**
	 * ArrayAccess interface implementation.
	 *
	 * @param mixed $offset
	 *
	 * @return mixed|null
	 * @throws ArgumentException
	 * @throws SystemException
	 */
	public function offsetGet($offset)
	{
		return $this->offsetExists($offset) ? $this->get($offset) : null;
	}

	/**
	 * ArrayAccess interface implementation.
	 *
	 * @param mixed $offset
	 * @param mixed $value
	 *
	 * @throws ArgumentException
	 * @throws SystemException
	 */
	public function offsetSet($offset, $value)
	{
		if (is_null($offset))
		{
			throw new ArgumentException('Field name should be set');
		}
		else
		{
			$this->set($offset, $value);
		}
	}

	/**
	 * ArrayAccess interface implementation.
	 *
	 * @param mixed $offset
	 */
	public function offsetUnset($offset)
	{
		$this->unset($offset);
	}
}
