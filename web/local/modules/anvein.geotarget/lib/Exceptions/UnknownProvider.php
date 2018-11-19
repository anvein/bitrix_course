<?php

namespace Anvein\Geotarget\Exceptions;

use Exception;

class UnknownProvider extends Exception
{
    public $message = 'Запрошенный провайдер не реализован';
}