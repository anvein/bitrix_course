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
    <div id="Container">
        <?php foreach ($arResult["ITEMS"] as $arItem): ?>
            <div class="col-md-4 col-sm-6 col-xs-12 mb-30 mix <?= isset($arItem['SECTIONS_CODES']) ? $arItem['SECTIONS_CODES'] : ''; ?>">
                <div class="portfolio-wrapper portfolio-title">
                    <div class="portfolio-img">
                        <?php if ($arItem['PREVIEW_PICTURE']['SRC']): ?>
                            <img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"
                                 alt="<?= $arItem['PREVIEW_PICTURE']['ALT'] ?>"/>

                            <div class="work-text brand-bg">
                                <div class="inner-text">
                                    <a class="view-portfolio image-link" href="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>">
                                        <span class="plus"></span>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="portfolio-heading pd-15">
                        <h4 class="mb-10">
                            <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                                <?= isset($arItem['NAME']) ? $arItem['NAME'] : ''; ?>
                            </a>
                        </h4>
                        <h5 class="m-0"><?= isset($arItem['SECTION_NAME']) ? $arItem['SECTION_NAME'] : ''; ?></h5>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<?php if (!empty($arResult['ITEMS'])): ?>
    <section class="testimonial-area bg-color pad-90">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="testimonial-active dots-style">
                        <?php foreach ($arResult['ITEMS'] as $item): ?>
                            <div class="single-testimonial black-text text-center">
                                <div class="testimonial-title">
                                    <span class="icon-quote"></span>
                                    <h3 class="black-text"><?= $item['PREVIEW_TEXT'] ?? ''; ?></h3>
                                </div>
                                <p><span>"</span><?= $item['DETAIL_TEXT'] ?? ''; ?><span>"</span>
                                </p>
                                <div class="testimonial-author text-uppercase">
                                    <span><?= $item['NAME'] ?? ''; ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
