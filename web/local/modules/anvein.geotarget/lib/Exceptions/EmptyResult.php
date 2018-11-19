<?php

namespace Anvein\Geotarget\Exceptions;

use Exception;

/**
 * Class EmptyResult<br>
 * Сервис вернул пустой ответ
 * @package Anvein\Geotarget\Exceptions
 */
class EmptyResult extends Exception
{
    // TODO: нужен ли?
    public $message = 'Сервис вернул пустой ответ или ответ не содержит запрашиваемых данных';
}