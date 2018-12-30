<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
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
<? $APPLICATION->IncludeComponent("yacoder:main.feedback", "", [
        "EMAIL_TO"         => "yacoder.test@gmail.com",
        "EVENT_MESSAGE_ID" => ["7"],
        "OK_TEXT"          => "Спасибо, ваше сообщение принято.",
        "REQUIRED_FIELDS"  => ["NAME", "EMAIL"],
        "USE_CAPTCHA"      => "N",
    ]); ?>
    <br><br><br>
 <br>
 <br>
 <br>
 <br>
 <br><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>