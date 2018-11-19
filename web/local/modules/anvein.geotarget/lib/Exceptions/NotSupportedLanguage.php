<?php

namespace Anvein\Geotarget\Exceptions;

use Exception;

class NotSupportedLanguage extends Exception
{
    public $message = 'Язык не поддерживается';
}