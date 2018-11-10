<?php

use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Loader;

/**
 * Возвращает ID инфоблока по его коду
 *
 * @param string $code - код ИБ
 *
 * @return int - ID найденного ИБ
 * @throws Exception
 */
function getIblockIdByCode(string $code): int
{
    Loader::includeModule('iblock');

    $iblock = IblockTable::getList([
        'filter' => [
            'CODE' => $code,
        ],
        'select' => [
            'ID',
            'CODE',
        ],
    ])->fetch();

    if (!isset($iblock['ID'])) {
        throw new Exception("Не найден инфоблок с кодом {$code}");
    }

    return (int) $iblock['ID'];
}