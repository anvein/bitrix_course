<?php

use Bitrix\Main\Loader;

Loader::registerAutoLoadClasses(
    'anvein.geotarget',
    [
        'Anvein\Geotarget\Locator'                              => 'lib/Locator.php',

        'Anvein\Geotarget\Providers\IProvider'                  => 'lib/Providers/IProvider.php',
        'Anvein\Geotarget\Providers\Provider'                   => 'lib/Providers/Provider.php',
        'Anvein\Geotarget\Providers\IpApiCom'                   => 'lib/Providers/IpApiCom.php',
        'Anvein\Geotarget\Providers\SypexGeo'                   => 'lib/Providers/SypexGeo.php',

        'Anvein\Geotarget\Entities\Country'                     => 'lib/Entities/Country.php',
        'Anvein\Geotarget\Entities\City'                        => 'lib/Entities/City.php',

        'Anvein\Geotarget\Exceptions\UnknownProvider'           => 'lib/Exceptions/UnknownProvider.php',
        'Anvein\Geotarget\Exceptions\NotSupportedLanguage'      => 'lib/Exceptions/NotSupportedLanguage.php',
        'Anvein\Geotarget\Exceptions\BadRequest'                => 'lib/Exceptions/BadRequest.php',
        'Anvein\Geotarget\Exceptions\ErrorStatusCode'           => 'lib/Exceptions/ErrorStatusCode.php',
        'Anvein\Geotarget\Exceptions\BotRequest'                => 'lib/Exceptions/BotRequest.php',
        'Anvein\Geotarget\Exceptions\EmptyResult'               => 'lib/Exceptions/EmptyResult.php',
        'Anvein\Geotarget\Exceptions\ErrorStatus'               => 'lib/Exceptions/ErrorStatus.php',
    ]
);
