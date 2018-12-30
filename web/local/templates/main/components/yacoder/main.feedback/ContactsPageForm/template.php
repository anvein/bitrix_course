<?php if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */

use Bitrix\Main\Localization\Loc;
?>

<div class="col-md-8" >
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <?php if (!empty($arResult["ERROR_MESSAGE"])): ?>
                <?php foreach ($arResult["ERROR_MESSAGE"] as $error): ?>
                    <span class="text-danger"><?= $error; ?></span><br>
                <?php endforeach; ?>
            <?php elseif (!empty($arResult["OK_MESSAGE"])): ?>
                <span class="text-success"><?=$arResult["OK_MESSAGE"]?></span><br>
            <?php endif; ?>
        </div>
    </div>
    <br>
    <div class="row">
        <form class="default-form"  action="<?= POST_FORM_ACTION_URI ?>" method="POST">
            <?=bitrix_sessid_post()?>

            <div class="col-md-4 col-sm-6">
                <input name="user_name" type="text" value="<?=$arResult['AUTHOR_NAME']?>" placeholder="<?= Loc::getMessage('MFT_NAME') ?><?= (empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])) ? '*' : ''; ?>"/>
            </div>

            <div class="col-md-4 col-sm-6">
                <input name="user_email" type="text" value="<?=$arResult["AUTHOR_EMAIL"]?>" placeholder="<?= Loc::getMessage('MFT_EMAIL') ?><?= (empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])) ? '*' : ''; ?>"/>
            </div>

            <div class="col-md-4 col-sm-6">
                <input name="user_phone" type="text" value="<?=$arResult["AUTHOR_PHONE"]?>" placeholder="<?= Loc::getMessage('MFT_PHONE') ?><?= (empty($arParams["REQUIRED_FIELDS"]) || in_array("PHONE", $arParams["REQUIRED_FIELDS"])) ? '*' : ''; ?>"/>
            </div>


            <div class="col-md-12 col-sm-12">
                <textarea name="MESSAGE" cols="30" rows="10" placeholder="<?= Loc::getMessage('MFT_MESSAGE') ?><?= (empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])) ? '*' : ''; ?>"><?=$arResult["MESSAGE"]?></textarea>
                <input class="btn mt-30" type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>">
            </div>

            <input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
        </form>

    </div>
</div>