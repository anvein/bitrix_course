<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<section class="who-area-are pad-90 bg-color">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="who-we">
                    <h2 class="title-1">
                        <? $APPLICATION->IncludeComponent("bitrix:main.include", "", [
                            "AREA_FILE_SHOW"   => "page",
                            "AREA_FILE_SUFFIX" => "about_title"
                        ]); ?>
                    </h2>
                    <? $APPLICATION->IncludeComponent("bitrix:main.include", "", [
                        "AREA_FILE_SHOW"   => "page",
                        "AREA_FILE_SUFFIX" => "about_text"
                    ]); ?>
                </div>
            </div>

            <?php $APPLICATION->IncludeComponent("bitrix:news.list", "SkillsOnServices", [
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
                // Поля
                "FIELD_CODE"                      => [
                    "NAME",
                    "PREVIEW_TEXT",
                    'CODE',
                ],
                "FILTER_NAME"                     => "",    // Фильтр
                "HIDE_LINK_WHEN_NO_DETAIL"        => "N",    // Скрывать ссылку, если нет детального описания
                "IBLOCK_ID"                       => getIblockIdByCode('skills'),    // Код информационного блока
                "IBLOCK_TYPE"                     => "content",    // Тип информационного блока (используется только для проверки)
                "INCLUDE_IBLOCK_INTO_CHAIN"       => "N",    // Включать инфоблок в цепочку навигации
                "INCLUDE_SUBSECTIONS"             => "N",    // Показывать элементы подразделов раздела
                "MESSAGE_404"                     => "",    // Сообщение для показа (по умолчанию из компонента)
                "NEWS_COUNT"                      => "5",    // Количество новостей на странице
                "PAGER_BASE_LINK_ENABLE"          => "N",    // Включить обработку ссылок
                "PAGER_DESC_NUMBERING"            => "N",    // Использовать обратную навигацию
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",    // Время кеширования страниц для обратной навигации
                "PAGER_SHOW_ALL"                  => "N",    // Показывать ссылку "Все"
                "PAGER_SHOW_ALWAYS"               => "N",    // Выводить всегда
                "PAGER_TEMPLATE"                  => "",    // Шаблон постраничной навигации
                "PAGER_TITLE"                     => "Новости",    // Название категорий
                "PARENT_SECTION"                  => "",    // ID раздела
                "PARENT_SECTION_CODE"             => "services_page",    // Код раздела
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
                "STRICT_SECTION_CHECK"            => "Y",    // Строгая проверка раздела для показа списка
            ], false); ?>
        </div>
    </div>
</section>


<?php $APPLICATION->IncludeComponent("bitrix:news.list", "main_activities", [
    'CLASS_BG_COLOR'                  => '',
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
    // Поля
    "FIELD_CODE"                      => [
        "NAME",
        "PREVIEW_TEXT",
        "DETAIL_TEXT",
    ],
    "FILTER_NAME"                     => "",    // Фильтр
    "HIDE_LINK_WHEN_NO_DETAIL"        => "N",    // Скрывать ссылку, если нет детального описания
    "IBLOCK_ID"                       => getIblockIdByCode('main_activities'),    // Код информационного блока
    "IBLOCK_TYPE"                     => "content",    // Тип информационного блока (используется только для проверки)
    "INCLUDE_IBLOCK_INTO_CHAIN"       => "N",    // Включать инфоблок в цепочку навигации
    "INCLUDE_SUBSECTIONS"             => "N",    // Показывать элементы подразделов раздела
    "MESSAGE_404"                     => "",    // Сообщение для показа (по умолчанию из компонента)
    "NEWS_COUNT"                      => "9",    // Количество новостей на странице
    "PAGER_BASE_LINK_ENABLE"          => "N",    // Включить обработку ссылок
    "PAGER_DESC_NUMBERING"            => "N",    // Использовать обратную навигацию
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",    // Время кеширования страниц для обратной навигации
    "PAGER_SHOW_ALL"                  => "N",    // Показывать ссылку "Все"
    "PAGER_SHOW_ALWAYS"               => "N",    // Выводить всегда
    "PAGER_TEMPLATE"                  => "",    // Шаблон постраничной навигации
    "PAGER_TITLE"                     => "Новости",    // Название категорий
    "PARENT_SECTION"                  => "",    // ID раздела
    "PARENT_SECTION_CODE"             => "services",    // Код раздела
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
    "STRICT_SECTION_CHECK"            => "Y",    // Строгая проверка раздела для показа списка
], false); ?>

<?php $APPLICATION->IncludeComponent("bitrix:news.list", "ServicesList", [
    "IBLOCK_TYPE"                     => $arParams["IBLOCK_TYPE"],
    "IBLOCK_ID"                       => $arParams["IBLOCK_ID"],
    "NEWS_COUNT"                      => $arParams["NEWS_COUNT"],
    "SORT_BY1"                        => $arParams["SORT_BY1"],
    "SORT_ORDER1"                     => $arParams["SORT_ORDER1"],
    "SORT_BY2"                        => $arParams["SORT_BY2"],
    "SORT_ORDER2"                     => $arParams["SORT_ORDER2"],
    "FIELD_CODE"                      => $arParams["LIST_FIELD_CODE"],
    "PROPERTY_CODE"                   => $arParams["LIST_PROPERTY_CODE"],
    "DETAIL_URL"                      => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
    "IBLOCK_URL"                      => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
    "DISPLAY_PANEL"                   => $arParams["DISPLAY_PANEL"],
    "SET_TITLE"                       => $arParams["SET_TITLE"],
    "SET_LAST_MODIFIED"               => $arParams["SET_LAST_MODIFIED"],
    "MESSAGE_404"                     => $arParams["MESSAGE_404"],
    "SET_STATUS_404"                  => $arParams["SET_STATUS_404"],
    "SHOW_404"                        => $arParams["SHOW_404"],
    "FILE_404"                        => $arParams["FILE_404"],
    "INCLUDE_IBLOCK_INTO_CHAIN"       => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
    "CACHE_TYPE"                      => $arParams["CACHE_TYPE"],
    "CACHE_TIME"                      => $arParams["CACHE_TIME"],
    "CACHE_FILTER"                    => $arParams["CACHE_FILTER"],
    "CACHE_GROUPS"                    => $arParams["CACHE_GROUPS"],
    "DISPLAY_TOP_PAGER"               => $arParams["DISPLAY_TOP_PAGER"],
    "DISPLAY_BOTTOM_PAGER"            => $arParams["DISPLAY_BOTTOM_PAGER"],
    "PAGER_TITLE"                     => $arParams["PAGER_TITLE"],
    "PAGER_TEMPLATE"                  => $arParams["PAGER_TEMPLATE"],
    "PAGER_SHOW_ALWAYS"               => $arParams["PAGER_SHOW_ALWAYS"],
    "PAGER_DESC_NUMBERING"            => $arParams["PAGER_DESC_NUMBERING"],
    "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
    "PAGER_SHOW_ALL"                  => $arParams["PAGER_SHOW_ALL"],
    "PAGER_BASE_LINK_ENABLE"          => $arParams["PAGER_BASE_LINK_ENABLE"],
    "PAGER_BASE_LINK"                 => $arParams["PAGER_BASE_LINK"],
    "PAGER_PARAMS_NAME"               => $arParams["PAGER_PARAMS_NAME"],
    "DISPLAY_DATE"                    => $arParams["DISPLAY_DATE"],
    "DISPLAY_NAME"                    => "Y",
    "DISPLAY_PICTURE"                 => $arParams["DISPLAY_PICTURE"],
    "DISPLAY_PREVIEW_TEXT"            => $arParams["DISPLAY_PREVIEW_TEXT"],
    "PREVIEW_TRUNCATE_LEN"            => $arParams["PREVIEW_TRUNCATE_LEN"],
    "ACTIVE_DATE_FORMAT"              => $arParams["LIST_ACTIVE_DATE_FORMAT"],
    "USE_PERMISSIONS"                 => $arParams["USE_PERMISSIONS"],
    "GROUP_PERMISSIONS"               => $arParams["GROUP_PERMISSIONS"],
    "FILTER_NAME"                     => $arParams["FILTER_NAME"],
    "HIDE_LINK_WHEN_NO_DETAIL"        => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
    "CHECK_DATES"                     => $arParams["CHECK_DATES"],
], $component); ?>