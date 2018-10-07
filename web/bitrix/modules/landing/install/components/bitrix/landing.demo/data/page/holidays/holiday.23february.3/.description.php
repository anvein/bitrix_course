<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);

return array(
	'name' => Loc::getMessage('LANDING_DEMO_23FEB3_TITLE'),
	'description' => Loc::getMessage('LANDING_DEMO_23FEB3_DESCRIPTION'),
	'fields' => array(
		'ADDITIONAL_FIELDS' => array(
		    'METAOG_IMAGE' => 'https://cdn.bitrix24.site/bitrix/images/demo/page/holidays/holiday.23february.3/preview.jpg',
			'THEME_CODE' => 'spa',
			'METAOG_TITLE' => Loc::getMessage('LANDING_DEMO_23FEB3_TITLE'),
			'METAOG_DESCRIPTION' => Loc::getMessage('LANDING_DEMO_23FEB3_DESCRIPTION'),
			'METAMAIN_TITLE' => Loc::getMessage('LANDING_DEMO_23FEB3_TITLE'),
			'METAMAIN_DESCRIPTION' => Loc::getMessage('LANDING_DEMO_23FEB3_DESCRIPTION')
		)
	),
	'sort' => -112,
	'available' => true,
	'active' => \LandingSiteDemoComponent::checkActive(array(
		'ONLY_IN' => array('ru', 'kz', 'by'),
		'EXCEPT' => array()
	)),
	'items' => array (
		'0.menu_18_spa' =>
			array (
				'CODE' => '0.menu_18_spa',
				'SORT' => '-100',
				'CONTENT' => '<header class="landing-block landing-ui-pattern-transparent landing-block-menu u-header u-header--floating g-z-index-9999">
	<div class="light-theme u-header__section g-transition-0_3 g-py-6 g-py-14--md" data-header-fix-moment-exclude="light-theme g-py-14--md" data-header-fix-moment-classes="dark-theme u-shadow-v27 g-bg-white g-py-11--md">
		<nav class="navbar navbar-expand-lg g-py-0">
			<div class="container">
				<!-- Logo -->
				<a href="#" class="navbar-brand landing-block-node-menu-logo-link u-header__logo p-0">
					<img class="landing-block-node-menu-logo u-header__logo-img u-header__logo-img--main d-block g-max-width-180" src="https://cdn.bitrix24.site/bitrix/images/landing/logos/spa-logo-light.png" alt="" data-header-fix-moment-exclude="d-block" data-header-fix-moment-classes="d-none" />

					<img class="landing-block-node-menu-logo2 u-header__logo-img u-header__logo-img--main d-none g-max-width-180" src="https://cdn.bitrix24.site/bitrix/images/landing/logos/spa-logo-dark.png" alt="" data-header-fix-moment-exclude="d-none" data-header-fix-moment-classes="d-block" />
				</a>
				<!-- End Logo -->

				<!-- Navigation -->
				<div class="collapse navbar-collapse align-items-center flex-sm-row" id="navBar">
					<ul class="landing-block-node-menu-list js-scroll-nav navbar-nav text-uppercase g-font-weight-700 g-font-size-11 g-pt-20 g-pt-0--lg ml-auto">
						<li class="landing-block-node-menu-list-item nav-item g-mr-12--lg g-mb-7 g-mb-0--lg active">
							<a href="#block@block[01.big_with_text_3]" class="landing-block-node-menu-list-item-link nav-link p-0" target="_self">Начало страницы</a><span class="sr-only">(current)
						</span></li>
						<li class="landing-block-node-menu-list-item nav-item g-mx-12--lg g-mb-7 g-mb-0--lg">
							<a href="#block@block[02.three_cols_big_3]" class="landing-block-node-menu-list-item-link nav-link p-0" target="_self">О нас</a>
						</li>
						<li class="landing-block-node-menu-list-item nav-item g-mx-12--lg g-mb-7 g-mb-0--lg">
							<a href="#block@block[47.1.title_with_icon]" class="landing-block-node-menu-list-item-link nav-link p-0" target="_self">Наша продукция</a>
						</li>
						<li class="landing-block-node-menu-list-item nav-item g-mx-12--lg g-mb-7 g-mb-0--lg">
							<a href="#block@block[46.3.cover_with_blocks_slider]" class="landing-block-node-menu-list-item-link nav-link p-0" target="_self">Отзывы</a>
						</li>
						<li class="landing-block-node-menu-list-item nav-item g-mx-12--lg g-mb-7 g-mb-0--lg">
							<a href="#block@block[47.1.title_with_icon@3]" class="landing-block-node-menu-list-item-link nav-link p-0" target="_self">Контакты</a>
						</li>
					</ul>
				</div>
				<!-- End Navigation -->

				<!-- Responsive Toggle Button -->
				<button class="navbar-toggler btn g-line-height-1 g-brd-none g-pa-0 ml-auto g-flex-centered-item--center" type="button" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navBar" data-toggle="collapse" data-target="#navBar">
                <span class="hamburger hamburger--slider">
                  <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                  </span>
                </span>
				</button>
				<!-- End Responsive Toggle Button -->
			</div>
		</nav>
	</div>
</header>',
			),
		'01.big_with_text_3' =>
			array (
				'CODE' => '01.big_with_text_3',
				'SORT' => '500',
				'CONTENT' => '<section class="landing-block landing-block-node-img u-bg-overlay g-flex-centered g-min-height-100vh g-height-70vh g-bg-img-hero g-bg-black-opacity-0_5--after g-pt-80 g-pb-80" style="background-image: url(\'https://cdn.bitrix24.site/bitrix/images/landing/business/1400x700/img7.jpg\');" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb">
	<div class="container g-max-width-800 text-center u-bg-overlay__inner g-mx-1 js-animation landing-block-node-container fadeInDown">
		<h2 class="landing-block-node-title g-line-height-1 g-font-weight-700 g-mb-20 g-text-transform-none g-color-white g-font-montserrat g-font-size-75">С праздником, дорогие мужчины!</h2>

		<div class="landing-block-node-text g-mb-35 g-color-white g-font-montserrat">Лучшие подарки для любимых мужчин можно найти в нашем магазине.</div>
		<div class="landing-block-node-button-container">
			<a href="#" class="landing-block-node-button btn btn-xl u-btn-primary text-uppercase g-font-weight-700 g-font-size-12 g-rounded-50 g-py-15 g-px-40 g-mb-15" target="_self">подробнее</a>
		</div>
	</div>
</section>',
			),
		'02.three_cols_big_3' =>
			array (
				'CODE' => '02.three_cols_big_3',
				'SORT' => '1000',
				'CONTENT' => '<section class="landing-block container-fluid px-0">
        <div class="row no-gutters">

            <div class="landing-block-node-left col-md-6 col-lg-4 g-theme-business-bg-blue-dark-v2">
                <div class="js-carousel g-pb-90" data-infinite="true" data-slides-show="true" data-pagi-classes="u-carousel-indicators-v1 g-absolute-centered--x g-bottom-30">
                    <div class="js-slide landing-block-card-left">
                        <img class="landing-block-node-left-img img-fluid w-100" src="https://cdn.bitrix24.site/bitrix/images/landing/business/1600x1600/img1.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />

                        <div class="g-pa-30">
                            <h3 class="landing-block-node-left-title text-uppercase g-font-weight-700 g-color-white g-mb-10 g-font-montserrat g-font-size-18 js-animation fadeIn" target="_self">Работаем с 2008</h3>
                            <div class="landing-block-node-left-text g-color-gray-light-v2 js-animation fadeIn"><p>За 10 лет работы мы успели не только расширить виды подарков, но и обеспечить подарками огромное количество клиентов не только в нашем родном городе, но и по всей стране! </p></div>
                        </div>
                    </div>

                    

                    
                </div>
            </div>

            <div class="landing-block-node-center col-md-6 col-lg-4 g-flex-centered g-theme-business-bg-blue-dark-v1">
                <div class="text-center g-color-gray-light-v2 g-pa-30">
                    <div class="landing-block-node-header text-uppercase u-heading-v2-4--bottom g-brd-primary g-mb-40">
                        <h4 class="landing-block-node-center-subtitle h6 g-font-weight-800 g-font-size-12 g-letter-spacing-1 g-color-primary g-mb-20 js-animation fadeIn">о нашем магазине</h4>
                        <h2 class="landing-block-node-center-title h1 u-heading-v2__title g-line-height-1_3 g-font-weight-600 g-color-white g-mb-minus-10 g-font-montserrat g-font-size-46 js-animation fadeIn">лучшие подарки</h2>
                    </div>

                    <div class="landing-block-node-center-text g-color-gray-light-v2 js-animation fadeIn"><p>У нас можно приобрести такие подарки как:<br /><span style="font-size: 1rem;">Часы<br /></span><span style="font-size: 1rem;">Фото-техника<br /></span><span style="font-size: 1rem;">Ремни<br /></span><span style="font-size: 1rem;">Спортивные товары<br /></span><span style="font-size: 1rem;">Аксессуары<br /></span><span style="font-size: 1rem;">Наборы путешественника<br /></span><span style="font-size: 1rem;">Парфюм<br /></span><span style="font-size: 1rem;">И многое другое!</span></p></div>
                </div>
            </div>

            <div class="landing-block-node-right-img g-min-height-300 col-lg-4 g-bg-img-hero" style="background-image: url(\'https://cdn.bitrix24.site/bitrix/images/landing/business/1600x1920/img3.jpg\');" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb"></div>

        </div>
    </section>',
			),
		'47.1.title_with_icon' =>
			array (
				'CODE' => '47.1.title_with_icon',
				'SORT' => '1500',
				'CONTENT' => '<section class="landing-block g-pb-20 g-pt-80">
	<div class="container text-center g-max-width-800">
		<div class="u-heading-v7-3 g-mb-30">
			<h2 class="landing-block-node-title u-heading-v7__title font-italic g-font-weight-600 g-mb-20 g-color-primary g-font-montserrat g-font-size-60 js-animation fadeInUp"><span style="color: rgb(33, 33, 33); font-style: normal;">Огромный выбор подарков</span></h2>

			<div class="landing-block-node-icon-container u-heading-v7-divider g-color-primary g-brd-gray-light-v4">
				<i class="landing-block-node-icon g-font-size-8 fa fa-star"></i>
				<i class="landing-block-node-icon g-font-size-11 fa fa-star"></i>
				<i class="landing-block-node-icon g-font-size-default fa fa-star"></i>
				<i class="landing-block-node-icon g-font-size-11 fa fa-star"></i>
				<i class="landing-block-node-icon g-font-size-8 fa fa-star"></i>
			</div>
		</div>

		<div class="landing-block-node-text g-color-gray-dark-v5 mb-0 g-font-montserrat js-animation fadeInUp"><p><span style="font-size: 1rem;">Порадуйте своего мужчину! </span><span style="font-size: 1rem;">Выбирайте оригинальные подарки!</span></p></div>
	</div>
</section>',
			),
		'06.1features_3_cols' =>
			array (
				'CODE' => '06.1features_3_cols',
				'SORT' => '2000',
				'CONTENT' => '<section class="landing-block g-pt-80 g-pb-80">
        <div class="container">

            <!-- Icon Blocks -->
            <div class="row no-gutters">

                <div class="landing-block-node-element landing-block-card col-md-4 col-lg-4 g-parent g-brd-around g-brd-gray-light-v4 g-brd-bottom-primary--hover g-brd-bottom-2--hover g-mb-30 g-mb-0--lg g-transition-0_2 g-transition--ease-in js-animation fadeInLeft">
                    <!-- Icon Blocks -->
                    <div class="text-center g-px-10 g-px-30--lg g-py-40 g-pt-25--parent-hover g-transition-0_2 g-transition--ease-in">
					<span class="landing-block-node-element-icon-container d-block g-color-primary g-font-size-40 g-mb-15">
					  <i class="landing-block-node-element-icon icon-present"></i>
					</span>
                        <h3 class="landing-block-node-element-title h5 text-uppercase g-color-black g-mb-10">НАБОР ПУТЕШЕСТВЕННИКА</h3>
                        <div class="landing-block-node-element-text g-color-gray-dark-v4"><p>ПОРАДУЙТЕ МУЖЧИНУ!</p></div>

                        <div class="landing-block-node-separator d-inline-block g-width-40 g-brd-bottom g-brd-2 g-brd-primary g-my-15"></div>

                        <ul class="landing-block-node-element-list list-unstyled text-uppercase g-mb-0">
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">Компас</li>
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">Охотничий нож</li>
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">Термос</li>
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">Фонарик</li>
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">Навигатор</li>
                            <li class="landing-block-node-element-list-item g-py-8">зажигалка</li>
                        </ul>
                    </div>
                    <!-- End Icon Blocks -->
                </div>

                <div class="landing-block-node-element landing-block-card col-md-4 col-lg-4 g-parent g-brd-around g-brd-gray-light-v4 g-brd-bottom-primary--hover g-brd-bottom-2--hover g-mb-30 g-mb-0--md g-ml-minus-1 g-transition-0_2 g-transition--ease-in js-animation fadeInLeft">
                    <!-- Icon Blocks -->
                    <div class="text-center g-px-10 g-px-30--lg g-py-40 g-pt-25--parent-hover g-transition-0_2 g-transition--ease-in">
					<span class="landing-block-node-element-icon-container d-block g-color-primary g-font-size-40 g-mb-15">
					  <i class="landing-block-node-element-icon icon-trophy"></i>
                	</span>
                        <h3 class="landing-block-node-element-title h5 text-uppercase g-color-black g-mb-10">НАБОР Спортсмена</h3>
                        <div class="landing-block-node-element-text g-color-gray-dark-v4"><p>ПОРАДУЙТЕ МУЖЧИНУ!</p></div>

                        <div class="landing-block-node-separator d-inline-block g-width-40 g-brd-bottom g-brd-2 g-brd-primary g-my-15"></div>

                        <ul class="landing-block-node-element-list list-unstyled text-uppercase g-mb-0">
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">Гантели</li>
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">Эспандер</li>
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">Перчатки</li>
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">Саппорт для колена</li>
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">Саппорт для логтя</li>
                            <li class="landing-block-node-element-list-item g-py-8">напульсники</li>
                        </ul>
                    </div>
                    <!-- End Icon Blocks -->
                </div>

                <div class="landing-block-node-element landing-block-card col-md-4 col-lg-4 g-parent g-brd-around g-brd-gray-light-v4 g-brd-bottom-primary--hover g-brd-bottom-2--hover g-mb-30 g-mb-0--md g-ml-minus-1 g-transition-0_2 g-transition--ease-in js-animation fadeInLeft">
                    <!-- Icon Blocks -->
                    <div class="text-center g-px-10 g-px-30--lg g-py-40 g-pt-25--parent-hover g-transition-0_2 g-transition--ease-in">
					<span class="landing-block-node-element-icon-container d-block g-color-primary g-font-size-40 g-mb-15">
					  <i class="landing-block-node-element-icon icon-flag"></i>
					</span>
                        <h3 class="landing-block-node-element-title h5 text-uppercase g-color-black g-mb-10">КЛАССИЧЕСКИЙ НАБОР</h3>
                        <div class="landing-block-node-element-text g-color-gray-dark-v4"><p>ПОРАДУЙТЕ МУЖЧИНУ!</p></div>

                        <div class="landing-block-node-separator d-inline-block g-width-40 g-brd-bottom g-brd-2 g-brd-primary g-my-15"></div>

                        <ul class="landing-block-node-element-list list-unstyled text-uppercase g-mb-0">
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">Кошелек</li>
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">Сумка</li>
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">ремень</li>
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">Визитница</li>
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">Галстук</li>
                            <li class="landing-block-node-element-list-item g-py-8">запонки</li>
                        </ul>
                    </div>
                    <!-- End Icon Blocks -->
                </div>

            </div>
            <!-- End Icon Blocks -->
        </div>
    </section>',
			),
		'01.big_with_text_3@2' =>
			array (
				'CODE' => '01.big_with_text_3',
				'SORT' => '2500',
				'CONTENT' => '<section class="landing-block landing-block-node-img u-bg-overlay g-flex-centered g-min-height-100vh g-height-70vh g-bg-img-hero g-bg-black-opacity-0_5--after g-pt-80 g-pb-80" style="background-image: url(\'https://cdn.bitrix24.site/bitrix/images/landing/business/1400x700/img6.jpg\');" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb">
	<div class="container g-max-width-800 text-center u-bg-overlay__inner g-mx-1 js-animation landing-block-node-container fadeInDown">
		<h2 class="landing-block-node-title g-line-height-1 g-font-weight-700 g-mb-20 g-text-transform-none g-color-primary g-font-size-75 g-font-montserrat"><span style="color: rgb(245, 245, 245);">
			Подарки любым мужчинам!</span></h2>

		<div class="landing-block-node-text g-mb-35 g-color-white g-font-montserrat">Радуйте не только своих парней, мужей или отцов, но и подрастающих мужчин: сыновей или племянников!</div>
		<div class="landing-block-node-button-container">
			<a href="#" class="landing-block-node-button btn btn-xl u-btn-primary text-uppercase g-font-weight-700 g-font-size-12 g-rounded-50 g-py-15 g-px-40 g-mb-15" target="_self">Узнать больше</a>
		</div>
	</div>
</section>',
			),
		'47.1.title_with_icon@2' =>
			array (
				'CODE' => '47.1.title_with_icon',
				'SORT' => '3000',
				'CONTENT' => '<section class="landing-block g-pt-80 g-pb-80">
	<div class="container text-center g-max-width-800">
		<div class="u-heading-v7-3 g-mb-30">
			<h2 class="landing-block-node-title u-heading-v7__title font-italic g-font-weight-600 g-mb-20 g-font-montserrat g-color-black g-font-size-60 js-animation fadeInUp"><span style="font-style: normal;">Специальные подарки<br /></span></h2>

			<div class="landing-block-node-icon-container u-heading-v7-divider g-color-primary g-brd-gray-light-v4">
				<i class="landing-block-node-icon g-font-size-8 fa fa-star"></i>
				<i class="landing-block-node-icon g-font-size-11 fa fa-star"></i>
				<i class="landing-block-node-icon g-font-size-default fa fa-star"></i>
				<i class="landing-block-node-icon g-font-size-11 fa fa-star"></i>
				<i class="landing-block-node-icon g-font-size-8 fa fa-star"></i>
			</div>
		</div>

		<div class="landing-block-node-text g-color-gray-dark-v5 mb-0 g-font-montserrat js-animation fadeInUp"><p>Порадуйте своего мужчину! Выбирайте оригинальные подарки!</p></div>
	</div>
</section>',
			),
		'44.7.three_columns_with_img_and_price' =>
			array (
				'CODE' => '44.7.three_columns_with_img_and_price',
				'SORT' => '4500',
				'CONTENT' => '<section class="landing-block g-pt-65 g-pb-65">
	<div class="container">
		<div class="row">
			<div class="landing-block-node-card col-md-6 col-lg-4 g-mb-30">
				<!-- Article -->
				<article class="h-100 text-center u-block-hover u-block-hover__additional--jump g-brd-around g-bg-gray-light-v5 g-brd-gray-light-v4 d-flex flex-column">
					<!-- Article Header -->
					<header class="landing-block-node-card-container-top g-bg-primary g-pa-20">
						<h4 class="landing-block-node-card-title font-italic g-font-weight-700 g-color-white mb-0 g-font-montserrat g-font-size-24"><span style="font-style: normal;">Фототехника<br /></span></h4>
						<div class="landing-block-node-card-subtitle g-font-size-default g-color-white-opacity-0_6 g-font-montserrat">Порадуйте мужчину!</div>
					</header>
					<!-- End Article Header -->

					<!-- Article Image -->
					<img class="landing-block-node-card-img g-height-230 w-100 g-object-fit-cover" src="https://cdn.bitrix24.site/bitrix/images/landing/business/350x230/img1.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
					<!-- End Article Image -->

					<!-- Article Content -->
					<div class="landing-block-node-card-container-bottom h-100 g-pa-40 d-flex flex-column">
						<div class="g-mb-15">
							<div class="landing-block-node-card-price-subtitle g-font-size-default g-color-gray-light-v1 g-font-montserrat">от</div>
							<div class="landing-block-node-card-price g-font-weight-700 g-color-primary g-font-size-24 g-mt-10 g-font-montserrat"><span style="color: rgb(33, 33, 33);">30000 руб.</span></div>
						</div>

						<div class="landing-block-node-card-text g-font-size-default g-color-gray-light-v1 g-mb-40 g-font-montserrat"><p>
								Фототехника на любой вкус</p></div>
						<div class="landing-block-node-card-button-container mt-auto">
							<a class="landing-block-node-card-button btn text-uppercase u-btn-primary g-font-weight-700 g-font-size-12 g-py-15 g-rounded-50" href="#" target="_self">Заказать</a>
						</div>
					</div>
					<!-- End Article Content -->
				
				<!-- End Article -->
			</article></div>

			<div class="landing-block-node-card col-md-6 col-lg-4 g-mb-30">
				<!-- Article -->
				<article class="h-100 text-center u-block-hover u-block-hover__additional--jump g-brd-around g-bg-gray-light-v5 g-brd-gray-light-v4 d-flex flex-column">
					<!-- Article Header -->
					<header class="landing-block-node-card-container-top g-bg-primary g-pa-20">
						<h4 class="landing-block-node-card-title font-italic g-font-weight-700 g-color-white mb-0 g-font-montserrat g-font-size-24"><span style="font-style: normal;">Мужской парфюм<br /></span></h4>
						<div class="landing-block-node-card-subtitle g-font-size-default g-color-white-opacity-0_6 g-font-montserrat">Порадуйте мужчину!</div>
					</header>
					<!-- End Article Header -->

					<!-- Article Image -->
					<img class="landing-block-node-card-img g-height-230 w-100 g-object-fit-cover" src="https://cdn.bitrix24.site/bitrix/images/landing/business/350x230/img2.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
					<!-- End Article Image -->

					<!-- Article Content -->
					<div class="landing-block-node-card-container-bottom h-100 g-pa-40 d-flex flex-column">
						<div class="g-mb-15">
							<div class="landing-block-node-card-price-subtitle g-font-size-default g-color-gray-light-v1 g-font-montserrat">от</div>
							<div class="landing-block-node-card-price g-font-weight-700 g-color-primary g-font-size-24 g-mt-10 g-font-montserrat"><span style="color: rgb(33, 33, 33);">
								2000 руб.</span></div>
						</div>

						<div class="landing-block-node-card-text g-font-size-default g-color-gray-light-v1 g-mb-40 g-font-montserrat"><p>
								Парфюм для стильного мужчины</p></div>
						<div class="landing-block-node-card-button-container mt-auto">
							<a class="landing-block-node-card-button btn text-uppercase u-btn-primary g-font-weight-700 g-font-size-12 g-py-15 g-rounded-50" href="#" target="_self">Заказать</a>
						</div>
					</div>
					<!-- End Article Content -->
				
				<!-- End Article -->
			</article></div>

			<div class="landing-block-node-card col-md-6 col-lg-4 g-mb-30">
				<!-- Article -->
				<article class="h-100 text-center u-block-hover u-block-hover__additional--jump g-brd-around g-bg-gray-light-v5 g-brd-gray-light-v4 d-flex flex-column">
					<!-- Article Header -->
					<header class="landing-block-node-card-container-top g-bg-primary g-pa-20">
						<h4 class="landing-block-node-card-title font-italic g-font-weight-700 g-color-white mb-0 g-font-montserrat g-font-size-24"><span style="font-style: normal;">Сладкий набор</span></h4>
						<div class="landing-block-node-card-subtitle g-font-size-default g-color-white-opacity-0_6 g-font-montserrat">Порадуйте мужчину!</div>
					</header>
					<!-- End Article Header -->

					<!-- Article Image -->
					<img class="landing-block-node-card-img g-height-230 w-100 g-object-fit-cover" src="https://cdn.bitrix24.site/bitrix/images/landing/business/350x230/img3.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
					<!-- End Article Image -->

					<!-- Article Content -->
					<div class="landing-block-node-card-container-bottom h-100 g-pa-40 d-flex flex-column">
						<div class="g-mb-15">
							<div class="landing-block-node-card-price-subtitle g-font-size-default g-color-gray-light-v1 g-font-montserrat">от</div>
							<div class="landing-block-node-card-price g-font-weight-700 g-color-primary g-font-size-24 g-mt-10 g-font-montserrat"><span style="color: rgb(33, 33, 33);">1000 руб.</span></div>
						</div>

						<div class="landing-block-node-card-text g-font-size-default g-color-gray-light-v1 g-mb-40 g-font-montserrat"><p>
								Набор конфет для сладкоежек</p></div>
						<div class="landing-block-node-card-button-container mt-auto">
							<a class="landing-block-node-card-button btn text-uppercase u-btn-primary g-font-weight-700 g-font-size-12 g-py-15 g-rounded-50" href="#" target="_self">Заказать</a>
						</div>
					</div>
					<!-- End Article Content -->
				
				<!-- End Article -->
			</article></div>
		</div>
	</div>
</section>',
			),
		'46.3.cover_with_blocks_slider' =>
			array (
				'CODE' => '46.3.cover_with_blocks_slider',
				'SORT' => '5000',
				'CONTENT' => '<section class="landing-block landing-block-node-bgimg u-bg-overlay g-bg-img-hero g-bg-black-opacity-0_5--after g-py-100" style="background-image: url(\'https://cdn.bitrix24.site/bitrix/images/landing/business/1920x1280/img31.jpg\');" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb">
	<div class="container u-bg-overlay__inner">
		<div class="js-carousel" data-infinite="true" data-arrows-classes="hidden-down u-arrow-v1 g-pos-abs g-absolute-centered--y--md g-top-100x g-top-50x--md g-width-50 g-height-50 g-rounded-50x g-font-size-12 g-color-white g-bg-white-opacity-0_4 g-bg-white-opacity-0_7--hover g-mt-30 g-mt-0--md" data-arrow-left-classes="fa fa-chevron-left g-left-0" data-arrow-right-classes="fa fa-chevron-right g-right-0">
			<div class="landing-block-node-card js-slide">
				<!-- Testimonial Block -->
				<div class="text-center g-max-width-600 mx-auto">
					<img class="landing-block-node-card-photo w-100 img-fluid" src="https://cdn.bitrix24.site/bitrix/images/landing/business/600x400/img14.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />

					<div class="landing-block-node-card-text-container g-bg-white g-pa-40">
						<h4 class="landing-block-node-card-title g-font-size-30 font-italic g-font-weight-700 g-mb-20 g-font-montserrat js-animation fadeInRightBig"><span style="font-style: normal;">Александр</span></h4>
						<div class="landing-block-node-card-subtitle text-uppercase g-font-weight-700 g-font-size-12 g-color-primary g-mb-25 g-font-montserrat">ПОЛУЧИЛ В ПОДАРОК ПАРФЮМ</div>
						<blockquote class="landing-block-node-card-text g-font-size-default g-color-gray-light-v1 g-mb-40 g-font-montserrat js-animation fadeInRightBig"><p>Приятный для меня сюрприз! Давно хотел приобрести сам, но теперь не нужно об этом думать!</p></blockquote>
						<div class="landing-block-node-card-button-container">
							<a class="landing-block-node-card-button btn btn-xl text-uppercase u-btn-primary g-font-weight-700 g-font-size-12 g-pa-15 g-rounded-50 js-animation fadeInRightBig" href="#" target="_self">подробнее</a>
						</div>
					</div>
				</div>
				<!-- End Testimonial Block -->
			</div>

			<div class="landing-block-node-card js-slide">
				<!-- Testimonial Block -->
				<div class="text-center g-max-width-600 mx-auto">
					<img class="landing-block-node-card-photo w-100 img-fluid" src="https://cdn.bitrix24.site/bitrix/images/landing/business/600x400/img13.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />

					<div class="landing-block-node-card-text-container g-bg-white g-pa-40">
						<h4 class="landing-block-node-card-title g-font-size-30 font-italic g-font-weight-700 g-mb-20 g-font-montserrat js-animation fadeInRightBig"><span style="font-style: normal;">Станислав<br /></span></h4>
						<div class="landing-block-node-card-subtitle text-uppercase g-font-weight-700 g-font-size-12 g-color-primary g-mb-25 g-font-montserrat">ПОЛУЧИЛ В ПОДАРОК ФОТОАППАРАТ</div>
						<blockquote class="landing-block-node-card-text g-font-size-default g-color-gray-light-v1 g-mb-40 g-font-montserrat js-animation fadeInRightBig"><p>Приятный для меня сюрприз! Давно хотел приобрести сам, но теперь не нужно об этом думать!</p></blockquote>
						<div class="landing-block-node-card-button-container">
							<a class="landing-block-node-card-button btn btn-xl text-uppercase u-btn-primary g-font-weight-700 g-font-size-12 g-pa-15 g-rounded-50 js-animation fadeInRightBig" href="#" target="_self">подробнее</a>
						</div>
					</div>
				</div>
				<!-- End Testimonial Block-->
			</div>
		<div class="landing-block-node-card js-slide">
				<!-- Testimonial Block -->
				<div class="text-center g-max-width-600 mx-auto">
					<img class="landing-block-node-card-photo w-100 img-fluid" src="https://cdn.bitrix24.site/bitrix/images/landing/business/600x400/img15.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />

					<div class="landing-block-node-card-text-container g-bg-white g-pa-40">
						<h4 class="landing-block-node-card-title g-font-size-30 font-italic g-font-weight-700 g-mb-20 g-font-montserrat js-animation fadeInRightBig"><span style="font-style: normal;">Андрей<br /></span></h4>
						<div class="landing-block-node-card-subtitle text-uppercase g-font-weight-700 g-font-size-12 g-color-primary g-mb-25 g-font-montserrat">ПОЛУЧИЛ В ПОДАРОК ГАНТЕЛИ</div>
						<blockquote class="landing-block-node-card-text g-font-size-default g-color-gray-light-v1 g-mb-40 g-font-montserrat js-animation fadeInRightBig"><p>Приятный для меня сюрприз! Давно хотел приобрести сам, но теперь не нужно об этом думать!</p></blockquote>
						<div class="landing-block-node-card-button-container">
							<a class="landing-block-node-card-button btn btn-xl text-uppercase u-btn-primary g-font-weight-700 g-font-size-12 g-pa-15 g-rounded-50 js-animation fadeInRightBig" href="#" target="_self">подробнее</a>
						</div>
					</div>
				</div>
				<!-- End Testimonial Block-->
			</div></div>
	</div>
</section>',
			),
		'47.1.title_with_icon@3' =>
			array (
				'CODE' => '47.1.title_with_icon',
				'SORT' => '5500',
				'CONTENT' => '<section class="landing-block g-pt-80 g-pb-80">
	<div class="container text-center g-max-width-800">
		<div class="u-heading-v7-3 g-mb-30">
			<h2 class="landing-block-node-title u-heading-v7__title font-italic g-font-weight-600 g-mb-20 g-color-primary g-font-montserrat g-font-size-60 js-animation fadeInUp"><span style="color: rgb(33, 33, 33); font-style: normal;">Напишите нам</span></h2>

			<div class="landing-block-node-icon-container u-heading-v7-divider g-color-primary g-brd-gray-light-v4">
				<i class="landing-block-node-icon g-font-size-8 fa fa-star"></i>
				<i class="landing-block-node-icon g-font-size-11 fa fa-star"></i>
				<i class="landing-block-node-icon g-font-size-default fa fa-star"></i>
				<i class="landing-block-node-icon g-font-size-11 fa fa-star"></i>
				<i class="landing-block-node-icon g-font-size-8 fa fa-star"></i>
			</div>
		</div>

		<div class="landing-block-node-text g-color-gray-dark-v5 mb-0 g-font-montserrat js-animation fadeInUp"><p>Для большей информации, свяжитесь с нами удобным для вас способом</p></div>
	</div>
</section>',
			),
		'33.3.form_1_transparent_black_no_text' =>
			array (
				'CODE' => '33.3.form_1_transparent_black_no_text',
				'SORT' => '6000',
				'CONTENT' => '<section class="landing-block g-pos-rel g-bg-primary-dark-v1 g-pt-120 g-pb-120 landing-block-node-bgimg g-bg-size-cover g-bg-img-hero g-bg-cover g-bg-black-opacity-0_7--after" style="background-image: url(\'https://cdn.bitrix24.site/bitrix/images/landing/business/1920x1280/img32.jpg\');" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb">

	<div class="container g-pos-rel g-z-index-1">
		<div class="row align-items-center">

			<div class="landing-block-form-styles" hidden="">
				<div class="g-bg-transparent h1 g-color-white g-brd-none g-pa-0" data-form-style-wrapper-padding="1" data-form-style-bg="1" data-form-style-bg-content="1" data-form-style-bg-block="1" data-form-style-header-font-size="1" data-form-style-header-font-weight="1" data-form-style-button-font-color="1" data-form-style-border-block="1">
				</div>
				<div class="g-bg-primary g-color-primary g-brd-primary" data-form-style-main-bg="1" data-form-style-main-border-color="1" data-form-style-main-font-color-hover="1">
				</div>
				<div class="g-bg-transparent g-brd-none g-brd-bottom g-brd-white" data-form-style-input-bg="1" data-form-style-input-border="1" data-form-style-input-border-radius="1" data-form-style-input-border-color="1">
				</div>
				<div class="g-brd-primary g-brd-none g-brd-bottom g-bg-black-opacity-0_7" data-form-style-input-border-hover="1" data-form-style-input-border-color-hover="1" data-form-style-input-select-bg="1">
				</div>

				<p class="g-color-white-opacity-0_6" data-form-style-main-font-weight="1" data-form-style-header-text-font-size="1" data-form-style-label-font-weight="1" data-form-style-label-font-size="1" data-form-style-second-font-color="1">
				</p>

				<h3 class="h4 g-color-white" data-form-style-main-font-color="1" data-form-style-main-font-family="1">
				</h3>

				<p data-form-style-main-font-family="1" data-form-style-main-font-weight="1" data-form-style-header-text-font-size="1">
			
			</p></div>


			<div class="col-12 col-md-10 col-lg-8 mx-auto">
				<div class="bitrix24forms g-brd-none g-brd-around--sm g-brd-white-opacity-0_6 g-px-0 g-px-20--sm g-px-45--lg g-py-0 g-py-30--sm g-py-60--lg u-form-alert-v1" data-b24form="" data-form-style-input-border-color="1" data-b24form-use-style="Y" data-b24form-show-header="N" data-b24form-original-domain=""></div>
			</div>

		</div>
	</div>
</section>',
			),
	),
);