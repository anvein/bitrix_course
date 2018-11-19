<?php

namespace Anvein\Geotarget\Providers;


use Bitrix\Main\Web\HttpClient;
use Anvein\Geotarget\Entities\City;
use Anvein\Geotarget\Entities\Country;
use Anvein\Geotarget\Exceptions\EmptyResult;
use Anvein\Geotarget\Exceptions\NotSupportedLanguage;


class SypexGeo extends Provider
{
    private $key = null;
    private $lang = 'ru';

    public static $langsAllow = ['ru', 'en', 'de', 'fr', 'it', 'it', 'es', 'pt'];

    const FORMAT_RESPONCE = 'json';

    /**
     * SypexGeo constructor.
     * @param array $params - параметры подключения к сервису<br>
     * > key - ключ подключения
     * @throws NotSupportedLanguage
     */
    public function __construct(array $params)
    {
        if (!isset($params['lang']) || !self::checkAllowLang($params['lang'])) {
            throw new NotSupportedLanguage($params['lang']);
        } else {
            $this->lang = strtolower($params['lang']);
        }

        if (!empty($params['key'])) {
            $this->key = $params['key'];
        }

        $this->isBot();
    }

    /**
     * @inheritdoc
     */
    public function getCountry(string $ip): Country
    {
        $http = new HttpClient();
        $http->get(
            "https://api.sypexgeo.net/{$this->getPrepareKey()}" . self::FORMAT_RESPONCE . "/{$ip}"
        );

        $this->checkStatusCode($http->getStatus());
        $result = json_decode($http->getResult(), true);

        if (empty($result['country'])) {
            throw new EmptyResult;
        }

        $country = new Country;
        $country
            ->setCode((string) $result['country']['iso'])
            ->setName((string) $result['country']["name_{$this->lang}"])
            ->setLang((string) $this->lang)
            ->setCurCode((string) $result['country']['cur_code'])
            ->setLon((float) $result['country']['lon'])
            ->setLat((float) $result['country']['lat'])
            ->setPhoneCode((string) $result['country']['phone']);

        return $country;
    }

    /**
     * @inheritdoc
     */
    public function getCity(string $ip): City
    {
        $http = new HttpClient();
        $http->get(
            "https://api.sypexgeo.net/{$this->getPrepareKey()}" . self::FORMAT_RESPONCE . "/{$ip}"
        );

        $this->checkStatusCode($http->getStatus());
        $result = json_decode($http->getResult(), true);

        if (empty($result['city'])) {
            throw new EmptyResult;
        }

        $city = new City;
        $city
            ->setName((string) $result['city']["name_{$this->lang}"])
            ->setLon((float) $result['city']['lon'])
            ->setLat((float) $result['city']['lat'])
            ->setLang((string) $this->lang);

        return $city;
    }

    /**
     * Возвращает ключ подключения к сервису подготовленный для адресной строки
     * @return string - подготовленный ключ
     */
    private function getPrepareKey()
    {
        if (!is_null($this->key)) {
            return "{$this->key}/";
        } else {
            return '';
        }
    }

}