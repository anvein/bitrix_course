<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('О нас');
$APPLICATION->SetPageProperty('TITLE', 'О нас | We Coders');
$APPLICATION->AddChainItem($APPLICATION->GetTitle(), $APPLICATION->GetCurDir());

$APPLICATION->SetPageProperty("keywords", "о нас, о компании, we coders, сайты");
?>

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

<?php
$APPLICATION->IncludeComponent("bitrix:news.list", "Reviews", [
    "IBLOCK_TYPE"                     => 'content',
    "IBLOCK_ID"                       => getIblockIdByCode('reviews'),
    "NEWS_COUNT"                      => 9,
    "SORT_BY1"                        => 'SORT',
    "SORT_ORDER1"                     => 'ASC',
    "FIELD_CODE"                      => ["NAME", "PREVIEW_TEXT", 'DETAIL_TEXT'],
    "PROPERTY_CODE"                   => [],
    "SET_TITLE"                       => 'N',
    "SET_LAST_MODIFIED"               => 'N',
    "SET_STATUS_404"                  => 'N',
    "SHOW_404"                        => 'N',
    "INCLUDE_IBLOCK_INTO_CHAIN"       => 'N',
    'ADD_SECTIONS_CHAIN'              => 'N',
    'SET_BROWSER_TITLE'               => 'N',
    "CACHE_FILTER"                    => "N",    // Кешировать при установленном фильтре
    "CACHE_GROUPS"                    => "N",    // Учитывать права доступа
    "CACHE_TIME"                      => "36000000",    // Время кеширования (сек.)
    "CACHE_TYPE"                      => "N",    // Тип кеширования
    "DISPLAY_TOP_PAGER"               => 'N',
    "DISPLAY_BOTTOM_PAGER"            => 'N',
    "DISPLAY_DATE"                    => 'N',
    "DISPLAY_NAME"                    => "Y",
    "CHECK_DATES"                     => 'Y',
    "PARENT_SECTION_CODE"             => "o-nas",
], false); ?>

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>