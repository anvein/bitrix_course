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

<?php if (!empty($arResult["ITEMS"])): ?>
    <section class="service-area pt-90 pb-60 <?= $arParams['CLASS_BG_COLOR'] ?? ''; ?>">
        <div class="container">
            <div class="row">
                <div class="section-heading text-center mb-70">
                    <h2>Основные направления</h2>
                    <p>Всё что нужно для производства сайта любой сложности</p>
                </div>
            </div>
            <div class="row">
                <?php foreach ($arResult["ITEMS"] as $arItem): ?>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="single-service brand-hover radius-4 mb-30 text-center">
                            <div class="service-icon">
                                <?= isset($arItem['DETAIL_TEXT']) ? $arItem['DETAIL_TEXT'] : ''; ?>
                            </div>
                            <div class="service-text">
                                <h3><?= isset($arItem['NAME']) ? $arItem['NAME'] : ''; ?></h3>
                                <p><?= isset($arItem['PREVIEW_TEXT']) ? $arItem['PREVIEW_TEXT'] : ''; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
