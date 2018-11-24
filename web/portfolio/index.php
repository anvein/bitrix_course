<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Портфолио");
$APPLICATION->SetPageProperty('title', 'Портфолио | We Coders');
$APPLICATION->AddChainItem($APPLICATION->GetTitle(), $APPLICATION->GetCurDir());
?>
<? $APPLICATION->IncludeComponent("bitrix:news", "Portfolio", [
    "ADD_ELEMENT_CHAIN"               => "Y",    // Включать название элемента в цепочку навигации
    "ADD_SECTIONS_CHAIN"              => "N",    // Включать раздел в цепочку навигации
    "AJAX_MODE"                       => "N",    // Включить режим AJAX
    "AJAX_OPTION_ADDITIONAL"          => "",    // Дополнительный идентификатор
    "AJAX_OPTION_HISTORY"             => "N",    // Включить эмуляцию навигации браузера
    "AJAX_OPTION_JUMP"                => "N",    // Включить прокрутку к началу компонента
    "AJAX_OPTION_STYLE"               => "N",    // Включить подгрузку стилей
    "BROWSER_TITLE"                   => "-",    // Установить заголовок окна браузера из свойства
    "CACHE_FILTER"                    => "N",    // Кешировать при установленном фильтре
    "CACHE_GROUPS"                    => "N",    // Учитывать права доступа
    "CACHE_TIME"                      => "36000000",    // Время кеширования (сек.)
    "CACHE_TYPE"                      => "N",    // Тип кеширования
    "CHECK_DATES"                     => "Y",    // Показывать только активные на данный момент элементы
    "DETAIL_ACTIVE_DATE_FORMAT"       => "d.m.Y",    // Формат показа даты
    "DETAIL_DISPLAY_BOTTOM_PAGER"     => "N",    // Выводить под списком
    "DETAIL_DISPLAY_TOP_PAGER"        => "N",    // Выводить над списком
    "DETAIL_FIELD_CODE"               => [    // Поля
                                              0 => "CODE",
                                              1 => "NAME",
    ],
    "DETAIL_PAGER_SHOW_ALL"           => "N",    // Показывать ссылку "Все"
    "DETAIL_PAGER_TEMPLATE"           => "",    // Название шаблона
    "DETAIL_PAGER_TITLE"              => "Страница",    // Название категорий
    "DETAIL_PROPERTY_CODE"            => [    // Свойства
                                              0 => "",
                                              1 => "add_info",
                                              2 => "detail_title",
                                              3 => "description",
                                              4 => "link",
                                              5 => "gallery",
    ],
    "DETAIL_SET_CANONICAL_URL"        => "N",    // Устанавливать канонический URL
    "DISPLAY_BOTTOM_PAGER"            => "N",    // Выводить под списком
    "DISPLAY_DATE"                    => "N",    // Выводить дату элемента
    "DISPLAY_NAME"                    => "Y",    // Выводить название элемента
    "DISPLAY_PICTURE"                 => "N",    // Выводить изображение для анонса
    "DISPLAY_PREVIEW_TEXT"            => "N",    // Выводить текст анонса
    "DISPLAY_TOP_PAGER"               => "N",    // Выводить над списком
    "HIDE_LINK_WHEN_NO_DETAIL"        => "N",    // Скрывать ссылку, если нет детального описания
    "IBLOCK_ID"                       => getIblockIdByCode('portfolio'),    // Инфоблок
    "IBLOCK_TYPE"                     => "content",    // Тип инфоблока
    "INCLUDE_IBLOCK_INTO_CHAIN"       => "N",    // Включать инфоблок в цепочку навигации
    "LIST_ACTIVE_DATE_FORMAT"         => "d.m.Y",    // Формат показа даты
    "LIST_FIELD_CODE"                 => [    // Поля
                                              0 => "CODE",
                                              1 => "NAME",
                                              2 => "PREVIEW_PICTURE",
    ],
    "LIST_PROPERTY_CODE"              => [    // Свойства
    ],
    "MESSAGE_404"                     => "",    // Сообщение для показа (по умолчанию из компонента)
    "META_DESCRIPTION"                => "-",    // Установить описание страницы из свойства
    "META_KEYWORDS"                   => "-",    // Установить ключевые слова страницы из свойства
    "NEWS_COUNT"                      => "30",    // Количество новостей на странице
    "PAGER_BASE_LINK_ENABLE"          => "N",    // Включить обработку ссылок
    "PAGER_DESC_NUMBERING"            => "N",    // Использовать обратную навигацию
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",    // Время кеширования страниц для обратной навигации
    "PAGER_SHOW_ALL"                  => "N",    // Показывать ссылку "Все"
    "PAGER_SHOW_ALWAYS"               => "N",    // Выводить всегда
    "PAGER_TEMPLATE"                  => ".default",    // Шаблон постраничной навигации
    "PAGER_TITLE"                     => "Новости",    // Название категорий
    "PREVIEW_TRUNCATE_LEN"            => "",    // Максимальная длина анонса для вывода (только для типа текст)
    "SEF_FOLDER"                      => "/portfolio/",    // Каталог ЧПУ (относительно корня сайта)
    "SEF_MODE"                        => "Y",    // Включить поддержку ЧПУ
    "SEF_URL_TEMPLATES"               => [
        "detail"  => "#SECTION_CODE#/#ELEMENT_CODE#/",
        "news"    => "",
        "section" => "",
    ],
    "SET_LAST_MODIFIED"               => "N",    // Устанавливать в заголовках ответа время модификации страницы
    "SET_STATUS_404"                  => "Y",    // Устанавливать статус 404
    "SET_TITLE"                       => "Y",    // Устанавливать заголовок страницы
    "SHOW_404"                        => "N",    // Показ специальной страницы
    "SORT_BY1"                        => "SORT",    // Поле для первой сортировки новостей
    "SORT_BY2"                        => "ACTIVE_FROM",    // Поле для второй сортировки новостей
    "SORT_ORDER1"                     => "ASC",    // Направление для первой сортировки новостей
    "SORT_ORDER2"                     => "ASC",    // Направление для второй сортировки новостей
    "STRICT_SECTION_CHECK"            => "N",    // Строгая проверка раздела
    "USE_CATEGORIES"                  => "N",    // Выводить материалы по теме
    "USE_FILTER"                      => "N",    // Показывать фильтр
    "USE_PERMISSIONS"                 => "N",    // Использовать дополнительное ограничение доступа
    "USE_RATING"                      => "N",    // Разрешить голосование
    "USE_REVIEW"                      => "N",    // Разрешить отзывы
    "USE_RSS"                         => "N",    // Разрешить RSS
    "USE_SEARCH"                      => "N",    // Разрешить поиск
    "USE_SHARE"                       => "N",    // Отображать панель соц. закладок
], false);
?>
<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>