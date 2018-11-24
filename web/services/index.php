<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';
$APPLICATION->SetTitle('Услуги');
$APPLICATION->SetPageProperty('title', 'Услуги | We Coders');
$APPLICATION->AddChainItem($APPLICATION->GetTitle(), $APPLICATION->GetCurDir());
?>

<?php $APPLICATION->IncludeComponent("bitrix:news", "Services", [
    "ADD_ELEMENT_CHAIN"         => "Y",    // Включать название элемента в цепочку навигации
    "ADD_SECTIONS_CHAIN"        => "N",    // Включать раздел в цепочку навигации
    "AJAX_MODE"                 => "N",    // Включить режим AJAX
    "AJAX_OPTION_ADDITIONAL"    => "",    // Дополнительный идентификатор
    "AJAX_OPTION_HISTORY"       => "N",    // Включить эмуляцию навигации браузера
    "AJAX_OPTION_JUMP"          => "N",    // Включить прокрутку к началу компонента
    "AJAX_OPTION_STYLE"         => "N",    // Включить подгрузку стилей
    "BROWSER_TITLE"             => "-",    // Установить заголовок окна браузера из свойства
    "CACHE_FILTER"              => "N",    // Кешировать при установленном фильтре
    "CACHE_GROUPS"              => "N",    // Учитывать права доступа
    "CACHE_TIME"                => "36000000",    // Время кеширования (сек.)
    "CACHE_TYPE"                => "N",    // Тип кеширования
    "CHECK_DATES"               => "Y",    // Показывать только активные на данный момент элементы
    "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",    // Формат показа даты
    // Поля
    "DETAIL_FIELD_CODE"         => [
        "CODE",
        "NAME",
        "DETAIL_PICTURE",
        'DETAIL_TEXT',
    ],
    "DETAIL_PAGER_SHOW_ALL"     => "N",    // Показывать ссылку "Все"
    "DETAIL_PAGER_TEMPLATE"     => "",    // Название шаблона
    "DETAIL_PAGER_TITLE"        => "Страница",    // Название категорий
    // Свойства
    "DETAIL_PROPERTY_CODE"      => [
        "faq",
        "stages",
        "detail_title",
    ],
    "DETAIL_SET_CANONICAL_URL"  => "N",    // Устанавливать канонический URL
    "HIDE_LINK_WHEN_NO_DETAIL"  => "N",    // Скрывать ссылку, если нет детального описания
    "IBLOCK_ID"                 => getIblockIdByCode('services'),    // Инфоблок
    "IBLOCK_TYPE"               => "content",    // Тип инфоблока
    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",    // Включать инфоблок в цепочку навигации
    "LIST_ACTIVE_DATE_FORMAT"   => "d.m.Y",    // Формат показа даты
    // Поля
    "LIST_FIELD_CODE"           => [
        0 => "CODE",
        1 => "NAME",
        2 => "PREVIEW_PICTURE",
    ],
    // Свойства
    "LIST_PROPERTY_CODE"        => [
        'list_info',
        'price',
    ],
    "MESSAGE_404"               => "",    // Сообщение для показа (по умолчанию из компонента)
    "META_DESCRIPTION"          => "-",    // Установить описание страницы из свойства
    "META_KEYWORDS"             => "-",    // Установить ключевые слова страницы из свойства
    "NEWS_COUNT"                => "30",    // Количество новостей на странице
    "PREVIEW_TRUNCATE_LEN"      => "",    // Максимальная длина анонса для вывода (только для типа текст)
    "SEF_FOLDER"                => "/services/",    // Каталог ЧПУ (относительно корня сайта)
    "SEF_MODE"                  => "Y",    // Включить поддержку ЧПУ
    "SEF_URL_TEMPLATES"         => [
        "detail" => "#ELEMENT_CODE#/",
        "news"   => "",
    ],
    "SET_LAST_MODIFIED"         => "Y",    // Устанавливать в заголовках ответа время модификации страницы
    "SET_STATUS_404"            => "Y",    // Устанавливать статус 404
    "SET_TITLE"                 => "Y",    // Устанавливать заголовок страницы
    "SHOW_404"                  => "N",    // Показ специальной страницы
    "SORT_BY1"                  => "SORT",    // Поле для первой сортировки новостей
    "SORT_ORDER1"               => "ASC",    // Направление для первой сортировки новостей
    "STRICT_SECTION_CHECK"      => "N",    // Строгая проверка раздела
    "USE_CATEGORIES"            => "N",    // Выводить материалы по теме
    "USE_FILTER"                => "N",    // Показывать фильтр
    "USE_PERMISSIONS"           => "N",    // Использовать дополнительное ограничение доступа
    "USE_RATING"                => "N",    // Разрешить голосование
    "USE_REVIEW"                => "N",    // Разрешить отзывы
    "USE_RSS"                   => "N",    // Разрешить RSS
    "USE_SEARCH"                => "N",    // Разрешить поиск
    "USE_SHARE"                 => "N",    // Отображать панель соц. закладок
], false);
?>

<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>