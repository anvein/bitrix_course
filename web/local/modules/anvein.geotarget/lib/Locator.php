<?php

namespace Anvein\Geotarget;

use Anvein\Geotarget\Providers\IProvider;
use Anvein\Geotarget\Exceptions\UnknownProvider;

abstract class Locator
{
    const PROVIDER_NAMESPACE = 'Anvein\Geotarget\Providers\\';

    /**
     * Возвращает по названию класса в $providerName провайдера опредения страны/города по ip
     * @param string $providerName
     * @return IProvider - возвращает объект провайдера
     * @throws UnknownProvider - если провайдер не найден
     */
    public static function getProvider(string $providerName, array $params = []) : IProvider
    {
        $providerClass = self::PROVIDER_NAMESPACE . $providerName;
        if (!class_exists($providerClass) || !(new $providerClass($params) instanceof IProvider)) {
            throw new UnknownProvider;
        }

        $provider = new $providerClass($params);
        return $provider;
    }
}