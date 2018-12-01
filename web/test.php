<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?><br>
 <br>
 <? $arr = $APPLICATION->IncludeComponent("bitrix:menu.sections", "", [
        "CACHE_TIME"       => "36000000",
        "CACHE_TYPE"       => "A",
        "DEPTH_LEVEL"      => "1",
        "DETAIL_PAGE_URL"  => "#SECTION_CODE#/#ELEMENT_CODE#",
        "IBLOCK_ID"        => "8",
        "IBLOCK_TYPE"      => "content",
        "ID"               => $_REQUEST["ID"],
        "IS_SEF"           => "Y",
        "SECTION_PAGE_URL" => "#SECTION_CODE#/",
        "SECTION_URL"      => "",
        "SEF_BASE_URL"     => "/portfolio/",
    ]);

echo '<pre>';
 print_r($arr);
 echo '</pre>';
 ?><br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>