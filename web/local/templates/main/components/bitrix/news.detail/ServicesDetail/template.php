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
<?php if (!empty($arResult['ID'])): ?>
    <section class="who-area-are pad-90" id="about_us">
        <div class="container">
            <?php if (!empty($arResult['PROPERTIES']['detail_title']['VALUE'])): ?>
                <h2 class="title-1"><?= $arResult['PROPERTIES']['detail_title']['VALUE']; ?></h2>
            <?php endif; ?>

            <div class="row">
                <?php if (!empty($arResult['DETAIL_TEXT'])): ?>
                    <div class="col-md-7">
                        <div class="who-we">
                            <?= $arResult['DETAIL_TEXT']; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($arResult['DETAIL_PICTURE']['SRC'])): ?>
                    <div class="col-md-5">
                        <div class="about-bg">
                            <img src="<?= $arResult['DETAIL_PICTURE']['SRC']; ?>" alt="<?= $arResult['DETAIL_PICTURE']['ALT'] ?>" />
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <div class="pb-60">
        <div class="container">
            <div class="row">
                <?php if (!empty($arResult['PROPERTIES']['faq']['VALUE'])): ?>
                    <div class="col-md-6">
                        <h3 class="mb-30">
                            <? $APPLICATION->IncludeComponent("bitrix:main.include", "", [
                                "AREA_FILE_SHOW"   => "page",
                                "AREA_FILE_SUFFIX" => "detail_faq_title"
                            ]); ?>
                        </h3>
                        <div class="brand-accordion">
                            <div class="panel-group icon angle-icon" id="accordion" role="tablist" aria-multiselectable="true">
                                <?php $ind = 0; ?>
                                <?php foreach ($arResult['PROPERTIES']['faq']['VALUE'] as $faqInd => $faqVal): ?>
                                    <div class="panel panel-default">
                                        <?php if ($arResult['PROPERTIES']['faq']['DESCRIPTION'][$faqInd]): ?>
                                            <div class="panel-heading" role="tab" id="headingOne">
                                                <h4 class="panel-title">
                                                    <a class="<?= ($ind === 0) ? '': 'collapsed'; ?>"
                                                       role="button"
                                                       data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $faqInd; ?>" aria-expanded="true" aria-controls="collapseOne">
                                                        <?= $arResult['PROPERTIES']['faq']['DESCRIPTION'][$faqInd]; ?>
                                                    </a>
                                                </h4>
                                            </div>
                                        <?php endif; ?>

                                        <div id="collapse<?= $faqInd; ?>"
                                             class="panel-collapse collapse <?= ($ind === 0) ? 'in': ''; ?>"
                                             role="tabpanel"
                                             aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                <?= $faqVal; ?>
                                            </div>
                                        </div>

                                    </div>
                                    <?php $ind++; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="col-lg-6 col-md-6">
                    <h3 class="mb-30">
                        <? $APPLICATION->IncludeComponent("bitrix:main.include", "", [
                            "AREA_FILE_SHOW"   => "page",
                            "AREA_FILE_SUFFIX" => "detail_stages_title"
                        ]); ?>
                    </h3>
                    <?php if (!empty($arResult['PROPERTIES']['stages']['VALUE'])): ?>
                        <div class="my-tab">
                            <ul class="custom-tab mb-15" role="tablist">
                                <?php $ind = 0; ?>
                                <?php foreach ($arResult['PROPERTIES']['stages']['VALUE'] as $keyStage => $valStage): ?>
                                    <li role="presentation" class="<?= ($ind++ == 0) ? 'active' : ''; ?>">
                                        <a href="#<?= $keyStage ?>" aria-controls="analytyc" role="tab" data-toggle="tab">
                                            <?= $arResult['PROPERTIES']['stages']['DESCRIPTION'][$keyStage] ?? ''; ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>

                            <div class="tab-content">
                                <?php $ind = 0; ?>
                                <?php foreach ($arResult['PROPERTIES']['stages']['VALUE'] as $keyStage => $valStage): ?>
                                    <div role="tabpanel" class="tab-pane fade in <?= ($ind++ == 0) ? 'active' : ''; ?>" id="<?= $keyStage ?>">
                                        <p><?= $valStage; ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="single-portfolio-area pt-90 pb-60">
        Элемент не найден
    </div>
<?php endif; ?>
