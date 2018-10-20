<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?php if (!empty($arResult)): ?>
    <div class="header-main-menu hidden-xs">
        <nav id="primary-menu">
            <ul class="main-menu text-right">
                <?php foreach ($arResult as $item): ?>

                <?php if ($item["SELECTED"]): ?>
                    <li>
                        <a href="<?= $item['LINK'] ?>" style="color:#009cbb"><?= $item['TEXT'] ?></a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="<?= $item['LINK'] ?>"><?= $item['TEXT'] ?></a>
                    </li>
                <?php endif; ?>

                <?php endforeach; ?>
            </ul>
        </nav>
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