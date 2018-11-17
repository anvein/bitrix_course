<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
?>

<?php if (!empty($arResult)): ?>
    <div class="mobile-menu-area visible-xs">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul>
                                <?php foreach ($arResult as $item): ?>
                                    <li>
                                        <a href="<?= $item['LINK'] ?>"
                                           style="<?= $item["SELECTED"] ? 'color:#009cbb' : ''; ?>">
                                            <?= $item['TEXT'] ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<!--<span class="indicator"><i class="fa fa-angle-down"></i></span></a>-->
<!--<ul class="dropdown">-->
<!--    <li>-->
<!--        <a href="services_landing.html">Лендинг</a>-->
<!--    </li>-->
<!--    <li>-->
<!--        <a href="services_online_shop.html">Интернет-магазин</a>-->
<!--    </li>-->
<!--</ul>-->

<!--mobile-->
<!--<ul>-->
<!--    <li>-->
<!--        <a href="services_landing.html">Лендинг</a>-->
<!--    </li>-->
<!--    <li>-->
<!--        <a href="services_online_shop.html">Интернет-магазин</a>-->
<!--    </li>-->
<!--</ul>-->