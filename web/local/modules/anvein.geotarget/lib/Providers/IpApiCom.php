<?php

namespace Anvein\Geotarget\Providers;

use Anvein\Geotarget\Exceptions\ErrorStatusCode;
use Bitrix\Main\Web\HttpClient;
use Anvein\Geotarget\Entities\City;
use Anvein\Geotarget\Entities\Country;
use Anvein\Geotarget\Exceptions\EmptyResult;
use Anvein\Geotarget\Exceptions\ErrorStatus;

class IpApiCom extends Provider
{
    const FORMAT_RESPONCE = 'json';
    private static $lang = 'en';

    /**
     * IpApiCom constructor.
     * @param array $params - параметры подключения к сервису<br>
     * > key - ключ подключения
     */
    public function __construct(array $params)
    {
        $this->isBot();
    }

    /**
     * @inheritdoc
     */
    public function getCountry(string $ip) : Country
    {
        $http = $this->createAndReturnHttpClient();
        $http->get(
            "http://ip-api.com/" . self::FORMAT_RESPONCE . "/{$ip}"
        );

        $result = json_decode($http->getResult(), true);

        $this->checkSocketErrors($http->getError());
        $this->checkStatusCode($http->getStatus());
        $this->checkStatusResponce($result);
        if (empty($result['countryCode'])) {
            throw new EmptyResult;
        }

        $country = new Country;
        $country
            ->setCode((string) $result['countryCode'])
            ->setLon((float) $result['lon'])
            ->setLat((float) $result['lat'])
            ->setName((string) $result['country'])
            ->setLang((string) self::$lang);

        return $country;
    }

    /**
     * @inheritdoc
     */
    public function getCity(string $ip) : City
    {
        $http = $this->createAndReturnHttpClient();
        $http->get(
            "http://ip-api.com/" . self::FORMAT_RESPONCE . "/{$ip}"
        );

        $result = json_decode($http->getResult(), true);

        $this->checkSocketErrors($http->getError());
        $this->checkStatusCode($http->getStatus());
        $this->checkStatusResponce($result);
        if (empty($result['city'])) {
            throw new EmptyResult;
        }

        $city = new City;
        $city
            ->setName((string) $result['city'])
            ->setLon((float) $result['lon'])
            ->setLat((float) $result['lat'])
            ->setLang((string) self::$lang);

        return $city;
    }


    /**
     * Валидирует статус ответа сервиса (не запроса)
     * @param $responce - декодированный ответ
     * @throws ErrorStatus
     */
    private function checkStatusResponce($responce = [])
    {
        if (empty($responce['status']) ) {
            throw new ErrorStatus;
        } elseif ($responce['status'] === 'success') {
          return;
        } elseif (!empty($responce['message'])) {
            throw new ErrorStatus($responce['message']);
        } else {
            throw new ErrorStatus;
        }
    }

    /**
     * Валидирует ошибки сокета, которые вернул запрос.
     * @param array $errors - декодированный ответ
     * @throws ErrorStatus
     */
    private function checkSocketErrors($errors)
    {
        if (!empty($errors) && is_array($errors)) {
            throw new ErrorStatus(implode(', ', $errors));
        }
    }

    /**
     * Возвращает настроенный объект HttpClient.
     *
     * @return \Bitrix\Main\Web\HttpClient
     */
    protected function createAndReturnHttpClient()
    {
        return new HttpClient([
            'socketTimeout' => 5,
            'streamTimeout' => 5,
        ]);
    }
}
