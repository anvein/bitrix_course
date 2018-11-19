<?php

namespace Anvein\Geotarget\Exceptions;

use Exception;

/**
 * Class BotRequest<br>
 * Запрос сделан ботом
 * @package Anvein\Geotarget\Exceptions
 */
class BotRequest extends Exception
{
    public $message = 'Запрос сделан ботом';
}