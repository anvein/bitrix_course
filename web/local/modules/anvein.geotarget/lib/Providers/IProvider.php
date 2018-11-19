<?php

namespace Anvein\Geotarget\Providers;

use Anvein\Geotarget\Entities\Country;
use Anvein\Geotarget\Entities\City;


interface IProvider
{
    /**
     * IProvider constructor.<br>
     * Инициализация провайдера.
     * @param array $params - параметры подключения к провайдеру
     */
    public function __construct(array $params);

    /**
     * Определяет страну по ip
     * @param string $ip
     * @return Country - объект страны соответствующий $ip, если страна найдена
     * @throw CountryNotFound - ошибка в случае, если страна не найдена
     */
    public function getCountry(string $ip) : Country;

    /**
     * Определяет город по ip
     * @return City
     * @throw CityNotFound - ошибка в случае, если страна не найдена
     */
    public function getCity(string $ip) : City;

    /**
     * Определяет код страны по ip
     * @return string
     * @throw CountryNotFound - ошибка в случае, если страна не найдена
     */
    public function getCountryCode($ip) : string;

}