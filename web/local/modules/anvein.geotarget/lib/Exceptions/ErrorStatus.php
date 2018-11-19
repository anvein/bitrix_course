<?php

namespace Anvein\Geotarget\Exceptions;

use Exception;

/**
 * Class ErrorStatus<br>
 * Пустой status ответа сервиса
 * @package Anvein\Geotarget\Exception
 */
class ErrorStatus extends Exception
{
    public $message = 'Пустой status ответа сервиса';
}