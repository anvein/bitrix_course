<?php

namespace Anvein\Geotarget\Providers;

use Anvein\Geotarget\Exceptions\BadRequest;
use Anvein\Geotarget\Exceptions\BotRequest;
use Anvein\Geotarget\Exceptions\ErrorStatusCode;

// TODO: описать city
// TODO: описать Region
// TODO: доделать Sypex
// TODO: сделать IpApi

abstract class Provider implements IProvider
{
    public static $langsAllow = [];

    /**
     * Проверяет, статуса ответа от сервиса
     * @param int $statusCode - статус ответа
     * @return void
     * @throws BadRequest
     * @throws ErrorStatusCode
     */
    protected function checkStatusCode(int $statusCode)
    {
        if ($statusCode === 200) {
            return;
        } elseif ($statusCode === 400) {
            throw new BadRequest;
        } else {
            throw new ErrorStatusCode($statusCode);
        }
    }

    /**
     * Проверяет, является ли запрос от бота
     * @throws BotRequest
     */
    protected function isBot()
    {
        $isBot = preg_match(
            "~(Google|Yahoo|Rambler|Bot|Yandex|Spider|Snoopy|Crawler|Finder|Mail|curl)~i",
            $_SERVER['HTTP_USER_AGENT']
        );

        if ($isBot) {
            throw new BotRequest;
        }
    }

    /**
     * Проверяет, разрешено ли запрашивать данные указанным языком
     * @param string $lang - проверяемый язык
     * @return bool - true, если разрешено, иначе false
     */
    protected static function checkAllowLang(string $lang) : bool
    {
        if (in_array(strtolower($lang), static::$langsAllow)) {
            return true;
        }

        return false;
    }


    /**
     * @inheritdoc
     */
    public function getCountryCode($ip): string
    {
        $country = $this->getCountry($ip);

        return $country->getCode();
    }
}
