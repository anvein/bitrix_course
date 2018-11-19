<?php

namespace Anvein\Geotarget\Exceptions;

use Exception;

/**
 * Class BadRequest<br>
 * Статус ответа 400
 * @package Anvein\Geotarget\Exceptions
 */
class BadRequest extends Exception
{
    public $message = 'От сервиса получен ответ 400 (Bad Request)';
}