<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?><br>
 <br>
 <br>
 <br>
<br>
<? $APPLICATION->IncludeComponent("bitrix:main.include", "", [
        "AREA_FILE_SHOW"   => "page",
        "AREA_FILE_SUFFIX" => "wwww",
        "EDIT_TEMPLATE"    => "",
    ]); ?><br><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>