<?php
/**
 * Bitrix Framework
 * @package    bitrix
 * @subpackage main
 * @copyright  2001-2018 Bitrix
 */

namespace Bitrix\Main\ORM;

use Bitrix\Main\ORM\Data\DataManager;

/**
 * Loads (generates) entity object or collection classes
 *
 * @package    bitrix
 * @subpackage main
 */
class Loader
{
	/** @var DataManager[] Entity registers its object class on init */
	protected static $predefinedObjectClass;

	/** @var DataManager[] Entity registers its collection class on init */
	protected static $predefinedCollectionClass;

	public static function autoLoad($className)
	{
		// break recursion
		if (substr($className, -5) == 'Table')
		{
			return;
		}

		$className = Entity::normalizeName($className);

		if (isset(static::$predefinedObjectClass[strtolower($className)]))
		{
			// check for predefined object class
			$tryDataClass = static::$predefinedObjectClass[strtolower($className)];

			$entity = $tryDataClass::getEntity();
			$entity->compileObjectClass();
		}
		elseif (isset(static::$predefinedCollectionClass[strtolower($className)]))
		{
			// check for predefined collection class
			$tryDataClass = static::$predefinedCollectionClass[strtolower($className)];

			$entity = $tryDataClass::getEntity();
			$entity->compileCollectionClass();
		}
		else
		{
			// search for data class
			$needFor = 'object';
			$tryDataClass = $className.'Table';

			if (substr($className, -10) == 'Collection')
			{
				$needFor = 'collection';
				$tryDataClass = substr($className, 0, -10).'Table';
			}

			if (class_exists($tryDataClass) && is_subclass_of($tryDataClass, DataManager::class))
			{
				/** @var DataManager $tryDataClass */
				$entity = $tryDataClass::getEntity();

				$needFor == 'object'
					? $entity->compileObjectClass()
					: $entity->compileCollectionClass();
			}
		}
	}

	public static function registerObjectClass($objectClass, $entityClass)
	{
		static::$predefinedObjectClass[strtolower(Entity::normalizeName($objectClass))] = $entityClass;
	}

	public static function registerCollectionClass($collectionClass, $entityClass)
	{
		static::$predefinedCollectionClass[strtolower(Entity::normalizeName($collectionClass))] = $entityClass;
	}
}
