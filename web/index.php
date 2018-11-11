<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Главная');
$APPLICATION->SetPageProperty('title', 'Digital агентство We coders');
?>

<?php $APPLICATION->IncludeComponent("bitrix:news.list", "mainpage_top_slider", [
    "ACTIVE_DATE_FORMAT"              => "d.m.Y",    // Формат показа даты
    "ADD_SECTIONS_CHAIN"              => "N",    // Включать раздел в цепочку навигации
    "AJAX_MODE"                       => "N",    // Включить режим AJAX
    "AJAX_OPTION_ADDITIONAL"          => "",    // Дополнительный идентификатор
    "AJAX_OPTION_HISTORY"             => "N",    // Включить эмуляцию навигации браузера
    "AJAX_OPTION_JUMP"                => "N",    // Включить прокрутку к началу компонента
    "AJAX_OPTION_STYLE"               => "N",    // Включить подгрузку стилей
    "CACHE_FILTER"                    => "N",    // Кешировать при установленном фильтре
    "CACHE_GROUPS"                    => "N",    // Учитывать права доступа
    "CACHE_TIME"                      => "36000000",    // Время кеширования (сек.)
    "CACHE_TYPE"                      => "N",    // Тип кеширования
    "CHECK_DATES"                     => "Y",    // Показывать только активные на данный момент элементы
    "DETAIL_URL"                      => "",    // URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
    "DISPLAY_BOTTOM_PAGER"            => "N",    // Выводить под списком
    "DISPLAY_DATE"                    => "N",    // Выводить дату элемента
    "DISPLAY_NAME"                    => "N",    // Выводить название элемента
    "DISPLAY_PICTURE"                 => "Y",    // Выводить изображение для анонса
    "DISPLAY_PREVIEW_TEXT"            => "N",    // Выводить текст анонса
    "DISPLAY_TOP_PAGER"               => "N",    // Выводить над списком
    "FIELD_CODE"                      => [    // Поля
                                              0 => "NAME",
                                              1 => "PREVIEW_TEXT",
                                              2 => "DETAIL_TEXT",
                                              3 => "",
    ],
    "FILTER_NAME"                     => "",    // Фильтр
    "HIDE_LINK_WHEN_NO_DETAIL"        => "N",    // Скрывать ссылку, если нет детального описания
    "IBLOCK_ID"                       => getIblockIdByCode('main_slider'),    // Код информационного блока
    "IBLOCK_TYPE"                     => "content",    // Тип информационного блока (используется только для проверки)
    "INCLUDE_IBLOCK_INTO_CHAIN"       => "N",    // Включать инфоблок в цепочку навигации
    "INCLUDE_SUBSECTIONS"             => "N",    // Показывать элементы подразделов раздела
    "MESSAGE_404"                     => "",    // Сообщение для показа (по умолчанию из компонента)
    "NEWS_COUNT"                      => "10",    // Количество новостей на странице
    "PAGER_BASE_LINK_ENABLE"          => "N",    // Включить обработку ссылок
    "PAGER_DESC_NUMBERING"            => "N",    // Использовать обратную навигацию
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",    // Время кеширования страниц для обратной навигации
    "PAGER_SHOW_ALL"                  => "N",    // Показывать ссылку "Все"
    "PAGER_SHOW_ALWAYS"               => "N",    // Выводить всегда
    "PAGER_TEMPLATE"                  => "",    // Шаблон постраничной навигации
    "PAGER_TITLE"                     => "Новости",    // Название категорий
    "PARENT_SECTION"                  => "",    // ID раздела
    "PARENT_SECTION_CODE"             => "",    // Код раздела
    "PREVIEW_TRUNCATE_LEN"            => "",    // Максимальная длина анонса для вывода (только для типа текст)
    "PROPERTY_CODE"                   => [    // Свойства
                                              0 => "link",
                                              1 => "",
    ],
    "SET_BROWSER_TITLE"               => "N",    // Устанавливать заголовок окна браузера
    "SET_LAST_MODIFIED"               => "N",    // Устанавливать в заголовках ответа время модификации страницы
    "SET_META_DESCRIPTION"            => "N",    // Устанавливать описание страницы
    "SET_META_KEYWORDS"               => "N",    // Устанавливать ключевые слова страницы
    "SET_STATUS_404"                  => "N",    // Устанавливать статус 404
    "SET_TITLE"                       => "N",    // Устанавливать заголовок страницы
    "SHOW_404"                        => "N",    // Показ специальной страницы
    "SORT_BY1"                        => "SORT",    // Поле для первой сортировки новостей
    "SORT_BY2"                        => "",    // Поле для второй сортировки новостей
    "SORT_ORDER1"                     => "ASC",    // Направление для первой сортировки новостей
    "SORT_ORDER2"                     => "",    // Направление для второй сортировки новостей
    "STRICT_SECTION_CHECK"            => "N",    // Строгая проверка раздела для показа списка
], false); ?>

<!-- О нас -->
<section class="who-area-are pad-90" id="about_us">
    <div class="container">
        <h2 class="title-1">
            <? $APPLICATION->IncludeComponent("bitrix:main.include", "", [
                "AREA_FILE_SHOW"   => "page",
                "AREA_FILE_SUFFIX" => "about_title"
            ]); ?>
        </h2>
        <div class="row">
            <div class="col-md-7">
                <div class="who-we">
                    <? $APPLICATION->IncludeComponent("bitrix:main.include", "", [
                        "AREA_FILE_SHOW"   => "page",
                        "AREA_FILE_SUFFIX" => "about_text"
                    ]); ?>
                </div>
            </div>
            <div class="col-md-5">
                <div class="about-bg">
                    <? $APPLICATION->IncludeComponent("bitrix:main.include", "", [
                        "AREA_FILE_SHOW"   => "page",
                        "AREA_FILE_SUFFIX" => "about_image"
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $APPLICATION->IncludeComponent("bitrix:news.list", "main_activities", [
    "ACTIVE_DATE_FORMAT"              => "d.m.Y",    // Формат показа даты
    "ADD_SECTIONS_CHAIN"              => "N",    // Включать раздел в цепочку навигации
    "AJAX_MODE"                       => "N",    // Включить режим AJAX
    "AJAX_OPTION_ADDITIONAL"          => "",    // Дополнительный идентификатор
    "AJAX_OPTION_HISTORY"             => "N",    // Включить эмуляцию навигации браузера
    "AJAX_OPTION_JUMP"                => "N",    // Включить прокрутку к началу компонента
    "AJAX_OPTION_STYLE"               => "N",    // Включить подгрузку стилей
    "CACHE_FILTER"                    => "N",    // Кешировать при установленном фильтре
    "CACHE_GROUPS"                    => "N",    // Учитывать права доступа
    "CACHE_TIME"                      => "36000000",    // Время кеширования (сек.)
    "CACHE_TYPE"                      => "N",    // Тип кеширования
    "CHECK_DATES"                     => "Y",    // Показывать только активные на данный момент элементы
    "DETAIL_URL"                      => "",    // URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
    "DISPLAY_BOTTOM_PAGER"            => "N",    // Выводить под списком
    "DISPLAY_DATE"                    => "N",    // Выводить дату элемента
    "DISPLAY_NAME"                    => "N",    // Выводить название элемента
    "DISPLAY_PICTURE"                 => "Y",    // Выводить изображение для анонса
    "DISPLAY_PREVIEW_TEXT"            => "N",    // Выводить текст анонса
    "DISPLAY_TOP_PAGER"               => "N",    // Выводить над списком
    "FIELD_CODE"                      => [    // Поля
                                              0 => "NAME",
                                              1 => "PREVIEW_TEXT",
                                              2 => "DETAIL_TEXT",
    ],
    "FILTER_NAME"                     => "",    // Фильтр
    "HIDE_LINK_WHEN_NO_DETAIL"        => "N",    // Скрывать ссылку, если нет детального описания
    "IBLOCK_ID"                       => getIblockIdByCode('main_activities'),    // Код информационного блока
    "IBLOCK_TYPE"                     => "content",    // Тип информационного блока (используется только для проверки)
    "INCLUDE_IBLOCK_INTO_CHAIN"       => "N",    // Включать инфоблок в цепочку навигации
    "INCLUDE_SUBSECTIONS"             => "N",    // Показывать элементы подразделов раздела
    "MESSAGE_404"                     => "",    // Сообщение для показа (по умолчанию из компонента)
    "NEWS_COUNT"                      => "3",    // Количество новостей на странице
    "PAGER_BASE_LINK_ENABLE"          => "N",    // Включить обработку ссылок
    "PAGER_DESC_NUMBERING"            => "N",    // Использовать обратную навигацию
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",    // Время кеширования страниц для обратной навигации
    "PAGER_SHOW_ALL"                  => "N",    // Показывать ссылку "Все"
    "PAGER_SHOW_ALWAYS"               => "N",    // Выводить всегда
    "PAGER_TEMPLATE"                  => "",    // Шаблон постраничной навигации
    "PAGER_TITLE"                     => "Новости",    // Название категорий
    "PARENT_SECTION"                  => "",    // ID раздела
    "PARENT_SECTION_CODE"             => "glavnaya-stranitsa",    // Код раздела
    "PREVIEW_TRUNCATE_LEN"            => "",    // Максимальная длина анонса для вывода (только для типа текст)
    "PROPERTY_CODE"                   => [    // Свойства
    ],
    "SET_BROWSER_TITLE"               => "N",    // Устанавливать заголовок окна браузера
    "SET_LAST_MODIFIED"               => "N",    // Устанавливать в заголовках ответа время модификации страницы
    "SET_META_DESCRIPTION"            => "N",    // Устанавливать описание страницы
    "SET_META_KEYWORDS"               => "N",    // Устанавливать ключевые слова страницы
    "SET_STATUS_404"                  => "N",    // Устанавливать статус 404
    "SET_TITLE"                       => "N",    // Устанавливать заголовок страницы
    "SHOW_404"                        => "N",    // Показ специальной страницы
    "SORT_BY1"                        => "SORT",    // Поле для первой сортировки новостей
    "SORT_BY2"                        => "",    // Поле для второй сортировки новостей
    "SORT_ORDER1"                     => "ASC",    // Направление для первой сортировки новостей
    "SORT_ORDER2"                     => "",    // Направление для второй сортировки новостей
    "STRICT_SECTION_CHECK"            => "N",    // Строгая проверка раздела для показа списка
], false); ?>

<?php $APPLICATION->IncludeComponent("bitrix:news.list", "infographics", [
    "ACTIVE_DATE_FORMAT"              => "d.m.Y",    // Формат показа даты
    "ADD_SECTIONS_CHAIN"              => "N",    // Включать раздел в цепочку навигации
    "AJAX_MODE"                       => "N",    // Включить режим AJAX
    "AJAX_OPTION_ADDITIONAL"          => "",    // Дополнительный идентификатор
    "AJAX_OPTION_HISTORY"             => "N",    // Включить эмуляцию навигации браузера
    "AJAX_OPTION_JUMP"                => "N",    // Включить прокрутку к началу компонента
    "AJAX_OPTION_STYLE"               => "N",    // Включить подгрузку стилей
    "CACHE_FILTER"                    => "N",    // Кешировать при установленном фильтре
    "CACHE_GROUPS"                    => "N",    // Учитывать права доступа
    "CACHE_TIME"                      => "36000000",    // Время кеширования (сек.)
    "CACHE_TYPE"                      => "N",    // Тип кеширования
    "CHECK_DATES"                     => "Y",    // Показывать только активные на данный момент элементы
    "DETAIL_URL"                      => "",    // URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
    "DISPLAY_BOTTOM_PAGER"            => "N",    // Выводить под списком
    "DISPLAY_DATE"                    => "N",    // Выводить дату элемента
    "DISPLAY_NAME"                    => "N",    // Выводить название элемента
    "DISPLAY_PICTURE"                 => "N",    // Выводить изображение для анонса
    "DISPLAY_PREVIEW_TEXT"            => "N",    // Выводить текст анонса
    "DISPLAY_TOP_PAGER"               => "N",    // Выводить над списком
    "FIELD_CODE"                      => [    // Поля
                                              0 => "NAME",
                                              1 => "PREVIEW_TEXT",
                                              2 => "DETAIL_TEXT",
    ],
    "FILTER_NAME"                     => "",    // Фильтр
    "HIDE_LINK_WHEN_NO_DETAIL"        => "N",    // Скрывать ссылку, если нет детального описания
    "IBLOCK_ID"                       => getIblockIdByCode('infographics'),    // Код информационного блока
    "IBLOCK_TYPE"                     => "content",    // Тип информационного блока (используется только для проверки)
    "INCLUDE_IBLOCK_INTO_CHAIN"       => "N",    // Включать инфоблок в цепочку навигации
    "INCLUDE_SUBSECTIONS"             => "N",    // Показывать элементы подразделов раздела
    "MESSAGE_404"                     => "",    // Сообщение для показа (по умолчанию из компонента)
    "NEWS_COUNT"                      => "4",    // Количество новостей на странице
    "PAGER_BASE_LINK_ENABLE"          => "N",    // Включить обработку ссылок
    "PAGER_DESC_NUMBERING"            => "N",    // Использовать обратную навигацию
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",    // Время кеширования страниц для обратной навигации
    "PAGER_SHOW_ALL"                  => "N",    // Показывать ссылку "Все"
    "PAGER_SHOW_ALWAYS"               => "N",    // Выводить всегда
    "PAGER_TEMPLATE"                  => "",    // Шаблон постраничной навигации
    "PAGER_TITLE"                     => "Новости",    // Название категорий
    "PARENT_SECTION"                  => "",    // ID раздела
    "PARENT_SECTION_CODE"             => "",    // Код раздела
    "PREVIEW_TRUNCATE_LEN"            => "",    // Максимальная длина анонса для вывода (только для типа текст)
    "PROPERTY_CODE"                   => [    // Свойства
    ],
    "SET_BROWSER_TITLE"               => "N",    // Устанавливать заголовок окна браузера
    "SET_LAST_MODIFIED"               => "N",    // Устанавливать в заголовках ответа время модификации страницы
    "SET_META_DESCRIPTION"            => "N",    // Устанавливать описание страницы
    "SET_META_KEYWORDS"               => "N",    // Устанавливать ключевые слова страницы
    "SET_STATUS_404"                  => "N",    // Устанавливать статус 404
    "SET_TITLE"                       => "N",    // Устанавливать заголовок страницы
    "SHOW_404"                        => "N",    // Показ специальной страницы
    "SORT_BY1"                        => "SORT",    // Поле для первой сортировки новостей
    "SORT_BY2"                        => "",    // Поле для второй сортировки новостей
    "SORT_ORDER1"                     => "ASC",    // Направление для первой сортировки новостей
    "SORT_ORDER2"                     => "",    // Направление для второй сортировки новостей
    "STRICT_SECTION_CHECK"            => "N",    // Строгая проверка раздела для показа списка
], false); ?>

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>