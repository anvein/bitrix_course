<?php

namespace yacoder\components;

use Bitrix\Main\Loader;
use CBitrixComponent;
use Creative\Edu\Iblock\HlBlockHelper;
use Exception;
use Creative\Edu\Logs\Logger;

/**
 * Class IblockElementsList - компонент для вывода списка элементов из hl-блока,

 * @package edu\components
 */
class HlBlockElementsList extends CBitrixComponent
{

    /**
     * @var Logger
     */
    protected $logger = null;

    /**
     * @param $params
     *
     * @return mixed
     * @throws Exception
     */
    public function onPrepareComponentParams($params)
    {
        Loader::includeModule('creative.edu');
        Loader::includeModule('highloadblock');


        $this->logger = new Logger('HlBlockElementsList');

        if (empty($params['hlBlockCode']) || !is_string($params['hlBlockCode'])) {
            throw new Exception('Не указан hlBlockCode или значение не является строкой');
        }

        $params['filter'] = is_array($params['filter'])
            ? $params['filter']
            : [];

        $params['select'] = is_array($params['select'])
            ? $params['select']
            : ['*'];

        $params['order'] = is_array($params['order'])
            ? $params['order']
            : [];

        $params['limit'] = is_int($params['limit'])
            ? $params['limit']
            : null;

        $params['silent'] = is_bool($params['silent'])
            ? $params['silent']
            : false;

        return $params;
    }


    /**
     * @return mixed
     */
    public function executeComponent()
    {
        try {
            $hlEntity = HlBlockHelper::getHlBlockEntity($this->arParams['hlBlockCode']);
            $this->arResult['items'] = $hlEntity::getList([
                'filter' => $this->arParams['filter'],
                'select' => $this->arParams['select'],
                'order'  => $this->arParams['order'],
                'limit'  => $this->arParams['limit'],
            ])->fetchAll();

            if ($this->arParams['silent']) {
                return $this->arResult['items'];
            }

            $this->includeComponentTemplate();
        } catch (Exception $e) {
            $this->logger->addErrorLog($e);
        }
    }

    /**
     * Метод для примера, который складывает 3 числа
     *
     * @param int $par1
     * @param int $par2
     * @param int $par3
     *
     * @return int
     */
    public function otherMethod(int $par1, int $par2, int $par3)
    {
        $result = $par1 + $par2 + $par3;

        return $result;
    }

}