<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);

return array(
	'name' => Loc::getMessage('LANDING_DEMO_23FEB2_TITLE'),
	'description' => Loc::getMessage('LANDING_DEMO_23FEB2_DESCRIPTION'),
	'fields' => array(
		'ADDITIONAL_FIELDS' => array(
		    'METAOG_IMAGE' => 'https://repo.bitrix24.site/bitrix/images/demo/page/holidays/holiday.23february.2/preview.jpg',
			'THEME_CODE' => 'spa',
			'METAOG_TITLE' => Loc::getMessage('LANDING_DEMO_23FEB2_TITLE'),
			'METAOG_DESCRIPTION' => Loc::getMessage('LANDING_DEMO_23FEB2_DESCRIPTION'),
			'METAMAIN_TITLE' => Loc::getMessage('LANDING_DEMO_23FEB2_TITLE'),
			'METAMAIN_DESCRIPTION' => Loc::getMessage('LANDING_DEMO_23FEB2_DESCRIPTION')
		)
	),
	'sort' => -111,
	'available' => true,
	'active' => \LandingSiteDemoComponent::checkActive(array(
		'ONLY_IN' => array('ru', 'kz', 'by'),
		'EXCEPT' => array()
	)),
	'items' => array (
		'0.menu_04' =>
			array (
				'CODE' => '0.menu_04',
				'SORT' => '-100',
				'CONTENT' => '<header class="landing-block landing-block-menu landing-ui-pattern-transparent u-header u-header--sticky-top u-header--change-appearance" data-header-fix-moment="100">
	<div class="dark-theme u-header__section g-bg-black-opacity-0_4 g-transition-0_3 g-py-8 g-py-17--md" data-header-fix-moment-exclude="dark-theme g-bg-black-opacity-0_4 g-py-17--md" data-header-fix-moment-classes="light-theme u-theme-shadow-v1 g-bg-white g-py-10--md">
		<nav class="navbar navbar-expand-lg p-0 g-px-15">
			<div class="container">
				<a href="/" class="landing-block-node-menu-logo-link-small g-hidden-lg-up navbar-brand mr-0 p-0">
					<img class="landing-block-node-menu-logo-small d-block g-max-width-180"
						 src="/bitrix/images/landing/logos/architecture-logo-light.png"
						 alt=""
						 data-header-fix-moment-exclude="d-block"
						 data-header-fix-moment-classes="d-none">

					<img class="landing-block-node-menu-logo-small-2 d-none g-max-width-180"
						 src="/bitrix/images/landing/logos/architecture-logo-dark.png" alt=""
						 data-header-fix-moment-exclude="d-none"
						 data-header-fix-moment-classes="d-block">
				</a>

				<!-- Navigation -->
				<div class="collapse navbar-collapse align-items-center flex-sm-row" id="navBar">
					<ul class="landing-block-node-menu-list js-scroll-nav navbar-nav align-items-lg-center text-uppercase g-font-weight-700 g-font-size-11 g-pt-20 g-pt-0--lg mx-auto">
						<li class="landing-block-node-menu-list-item nav-item g-mr-30--lg g-mb-7 g-mb-0--lg active">
							<a href="#block@block[41.3.announcement_with_slider]" class="landing-block-node-menu-list-item-link nav-link g-color-white p-0" target="_self">Начало страницы</a><span class="sr-only">(current)
						</span></li>
						<li class="landing-block-node-menu-list-item nav-item g-mx-30--lg g-mb-7 g-mb-0--lg">
							<a href="#block@block[01.two_col_with_titles]" class="landing-block-node-menu-list-item-link nav-link g-color-white p-0" target="_self">Мы предлагаем</a>
						</li>
						
						

						<!-- Logo -->
						<li class="g-hidden-md-down nav-logo-item g-mx-15--lg">
							<a href="#team" class="landing-block-node-menu-logo-link navbar-brand mr-0">
								<img class="landing-block-node-menu-logo d-block g-max-width-180"
									 src="/bitrix/images/landing/logos/architecture-logo-light.png"
									 alt=""
									 data-header-fix-moment-exclude="d-block"
									 data-header-fix-moment-classes="d-none">

								<img class="landing-block-node-menu-logo-2 d-none g-max-width-180"
									 src="/bitrix/images/landing/logos/architecture-logo-dark.png"
									 alt=""
									 data-header-fix-moment-exclude="d-none"
									 data-header-fix-moment-classes="d-block">
							</a>
						</li>
						<!-- End Logo -->

						
						<li class="landing-block-node-menu-list-item nav-item g-mx-30--lg g-mb-7 g-mb-0--lg">
							<a href="#block@block[04.7.one_col_fix_with_title_and_text_2]" class="landing-block-node-menu-list-item-link nav-link g-color-white p-0" target="_self">Отзывы</a>
						</li>
						<li class="landing-block-node-menu-list-item nav-item g-mx-30--lg g-mb-7 g-mb-0--lg">
							<a href="#block@block[04.1.one_col_fix_with_title]" class="landing-block-node-menu-list-item-link nav-link g-color-white p-0" target="_self">Контакты</a>
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
		'41.3.announcement_with_slider' =>
			array (
				'CODE' => '41.3.announcement_with_slider',
				'SORT' => '1000',
				'CONTENT' => '<section class="landing-block">
	<div class="g-pb-70">
		<div class="landing-block-node-bgimg g-pt-150 g-bg-img-hero g-pos-rel u-bg-overlay g-bg-darkblue-opacity-0_7--after" style="background-image: url(\'https://cdn.bitrix24.site/bitrix/images/landing/business/1920x1281/img2.jpg\');" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb">
			<div class="container g-max-width-750 u-bg-overlay__inner g-mb-60 landing-block-node-container js-animation fadeInUp">

				<h2 class="landing-block-node-title text-center text-uppercase h2 g-font-weight-700 g-font-size-60 g-color-white g-mb-30 g-mb-70--md g-font-open-sans">лучшие подарки для мужчин!</h2>

				<div class="row g-mx-minus-5">
					<div class="col-md-4 g-px-5 g-mb-20 g-mb-0--md">
						<div class="media">
							<div class="media-left d-flex align-self-center g-mr-20">
								<i class="landing-block-node-date-icon fa fa-calendar g-font-size-27 g-color-white-opacity-0_5"></i>
							</div>

							<div class="media-body text-uppercase">
								<div class="landing-block-node-date-title g-mb-5 g-font-size-14 g-color-white-opacity-0_5"><span style="font-weight: bold;">когда</span></div>
								<h3 class="landing-block-node-date-text h3 text-uppercase g-font-size-15 g-color-white mb-0">январь–февраль</h3>
							</div>
						</div>
					</div>

					<div class="col-md-5 g-px-5 g-mb-20 g-mb-0--md">
						<div class="media">
							<div class="media-left d-flex align-self-center g-mr-20">
								<i class="landing-block-node-place-icon fa fa-map-marker g-font-size-27 g-color-white-opacity-0_5"></i>
							</div>

							<div class="media-body text-uppercase">
								<div class="landing-block-node-place-title g-mb-5 g-font-size-14 g-color-white-opacity-0_5"><span style="font-weight: bold;">где</span></div>
								<h3 class="landing-block-node-place-text h3 text-uppercase g-font-size-15 g-color-white mb-0">торговый комплекс &quot;волна&quot;</h3>
							</div>
						</div>
					</div>

					<div class="col-md-3 text-md-right g-px-5">
						<a class="landing-block-node-button btn btn-lg text-uppercase u-btn-white g-font-weight-700 g-font-size-11 g-color-white--hover g-bg-primary--hover g-brd-none rounded-0 g-py-18" href="#" target="_self">Узнать больше</a>
					</div>
				</div>
			</div>

			<div class="container u-bg-overlay__inner g-bottom-minus-70 px-0 g-z-index-2">
				<div class="row u-shadow-v23 g-theme-event-bg-blue-dark-v2 mx-0">
					<div class="col-md-6 px-0">
						<div class="js-carousel text-center u-carousel-v5 g-overflow-hidden h-100" data-infinite="true" data-arrows-classes="u-arrow-v1 g-absolute-centered--y g-width-40 g-height-40 g-font-size-20 g-color-white g-color-primary--hover g-bg-primary g-bg-white--hover g-transition-0_2 g-transition--ease-in" data-arrow-left-classes="fa fa-angle-left g-left-0" data-arrow-right-classes="fa fa-angle-right g-right-0">
							<div class="landing-block-node-card landing-block-node-card-img js-slide g-bg-img-hero g-min-height-50vh" style="background-image: url(\'https://cdn.bitrix24.site/bitrix/images/landing/business/1000x667/img4.jpg\');" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb"></div>

							<div class="landing-block-node-card landing-block-node-card-img js-slide g-bg-img-hero g-min-height-50vh" style="background-image: url(\'https://cdn.bitrix24.site/bitrix/images/landing/business/1000x667/img5.jpg\');" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb"></div>
						</div>
					</div>

					<div class="col-md-6 d-flex g-min-height-50vh g-theme-event-color-gray-dark-v1 g-py-80 g-py-20--md g-px-50">
						<div class="align-self-center w-100">
							<h2 class="landing-block-node-block-title text-uppercase g-font-weight-700 g-font-size-30 g-color-primary g-mb-10">лучшее качество</h2>
							<h3 class="landing-block-node-block-subtitle text-uppercase g-font-weight-500 g-font-size-13 g-color-white g-mb-20"> </h3>
							<div class="landing-block-node-block-text g-font-size-14 mb-0"><p>Наши подарки лучшего качества.</p><p>Порадуйте своего мужчину!</p><p>Выбирайте оригинальные подарки! </p></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>',
			),
		'21.3.two_cols_big_bgimg_title_text_button' =>
			array (
				'CODE' => '21.3.two_cols_big_bgimg_title_text_button',
				'SORT' => '1500',
				'CONTENT' => '<section class="landing-block container-fluid px-0">
        <div class="row no-gutters">

        

        

        </div>
    </section>',
			),
		'09.1.two_cols_fix_text_and_image_slider' =>
			array (
				'CODE' => '09.1.two_cols_fix_text_and_image_slider',
				'SORT' => '2000',
				'CONTENT' => '<section class="landing-block g-pt-115 g-pt-80 g-pb-80">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 g-mb-40 g-mb-0--lg landing-block-node-text-container js-animation fadeInLeft">
                    <div class="landing-block-node-header text-uppercase u-heading-v2-4--bottom g-brd-primary g-mb-40">
                        <h4 class="landing-block-node-subtitle h6 g-font-weight-800 g-font-size-12 g-letter-spacing-1 g-color-primary g-mb-20">преимущество</h4>
                        <h2 class="landing-block-node-title h1 u-heading-v2__title g-line-height-1_3 g-font-weight-600 g-mb-minus-10 g-font-open-sans g-font-size-33">широкий выбор</h2>
                    </div>

					<div class="landing-block-node-text"><p>У нас можно приобрести такие подарки как:<br />- Часы<br />- Фото-техника<br />- Ремни<br />- Спортивные товары<br />- Аксессуары<br />- Наборы путешественника<br />- Парфюм<br /><br />И многое другое!</p></div>
                </div>

                <div class="col-lg-8 landing-block-node-carousel-container js-animation fadeInRight">
                    <div id="carouselGLR001" class="landing-block-node-carousel js-carousel g-line-height-0" data-infinite="true" data-speed="5000" data-rows="2" data-slides-show="2" data-arrows-classes="u-arrow-v1 g-pos-abs g-bottom-100x g-right-0 g-width-35 g-height-35 g-font-size-default g-color-gray g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-mb-5 g-transition-0_2 g-transition--ease-in" data-arrow-left-classes="fa fa-angle-left g-mr-50" data-arrow-right-classes="fa fa-angle-right g-mr-5">
                        <div class="landing-block-node-carousel-element landing-block-card-carousel-element js-slide g-pa-5">
                            <div class="g-parent g-pos-rel g-overflow-hidden">
                                <img class="landing-block-node-carousel-element-img img-fluid g-transform-scale-1_1--parent-hover g-transition-0_3 g-transition--ease-in" src="https://cdn.bitrix24.site/bitrix/images/landing/business/400x269/img13.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
                                <div class="landing-block-node-carousel-element-img-hover g-pos-abs g-top-0 g-left-0 w-100 h-100 g-bg-primary-opacity-0_8 g-color-white opacity-0 g-opacity-1--parent-hover g-pa-25 g-transition-0_3 g-transition--ease-in">
                                    <h3 class="landing-block-node-carousel-element-title text-uppercase g-font-weight-700 g-font-size-16 g-color-white mb-0">Часы</h3>
                                    <div class="landing-block-node-carousel-element-text g-line-height-1_5--hover g-font-size-12 g-transition-0_3 g-transition--ease-in g-color-gray-light-v4"><p>Множество различных моделей</p></div>
                                </div>
                            </div>
                        </div>
						
                        <div class="landing-block-node-carousel-element landing-block-card-carousel-element js-slide g-pa-5">
                            <div class="g-parent g-pos-rel g-overflow-hidden">
                                <img class="landing-block-node-carousel-element-img img-fluid g-transform-scale-1_1--parent-hover g-transition-0_3 g-transition--ease-in" src="https://cdn.bitrix24.site/bitrix/images/landing/business/400x269/img15.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
                                <div class="landing-block-node-carousel-element-img-hover g-pos-abs g-top-0 g-left-0 w-100 h-100 g-bg-primary-opacity-0_8 g-color-white opacity-0 g-opacity-1--parent-hover g-pa-25 g-transition-0_3 g-transition--ease-in">
                                    <h3 class="landing-block-node-carousel-element-title text-uppercase g-font-weight-700 g-font-size-16 g-color-white mb-0">Фото-техника</h3>
                                    <div class="landing-block-node-carousel-element-text g-line-height-1_5--hover g-font-size-12 g-transition-0_3 g-transition--ease-in g-color-gray-light-v4"><p>Множество различных моделей</p></div>
                                </div>
                            </div>
                        </div>

                        <div class="landing-block-node-carousel-element landing-block-card-carousel-element js-slide g-pa-5">
                            <div class="g-parent g-pos-rel g-overflow-hidden">
                                <img class="landing-block-node-carousel-element-img img-fluid g-transform-scale-1_1--parent-hover g-transition-0_3 g-transition--ease-in" src="https://cdn.bitrix24.site/bitrix/images/landing/business/400x269/img14.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
                                <div class="landing-block-node-carousel-element-img-hover g-pos-abs g-top-0 g-left-0 w-100 h-100 g-bg-primary-opacity-0_8 g-color-white opacity-0 g-opacity-1--parent-hover g-pa-25 g-transition-0_3 g-transition--ease-in">
                                    <h3 class="landing-block-node-carousel-element-title text-uppercase g-font-weight-700 g-font-size-16 g-color-white mb-0">Ремни</h3>
                                    <div class="landing-block-node-carousel-element-text g-line-height-1_5--hover g-font-size-12 g-transition-0_3 g-transition--ease-in g-color-gray-light-v4"><p>Множество различных моделей</p></div>
                                </div>
                            </div>
                        </div>

                        <div class="landing-block-node-carousel-element landing-block-card-carousel-element js-slide g-pa-5">
                            <div class="g-parent g-pos-rel g-overflow-hidden">
                                <img class="landing-block-node-carousel-element-img img-fluid g-transform-scale-1_1--parent-hover g-transition-0_3 g-transition--ease-in" src="https://cdn.bitrix24.site/bitrix/images/landing/business/400x269/img16.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
                                <div class="landing-block-node-carousel-element-img-hover g-pos-abs g-top-0 g-left-0 w-100 h-100 g-bg-primary-opacity-0_8 g-color-white opacity-0 g-opacity-1--parent-hover g-pa-25 g-transition-0_3 g-transition--ease-in">
                                    <h3 class="landing-block-node-carousel-element-title text-uppercase g-font-weight-700 g-font-size-16 g-color-white mb-0">Спортивные товары</h3>
                                    <div class="landing-block-node-carousel-element-text g-line-height-1_5--hover g-font-size-12 g-transition-0_3 g-transition--ease-in g-color-gray-light-v4"><p>Множество различных моделей</p></div>
                                </div>
                            </div>
                        </div>

                        <div class="landing-block-node-carousel-element landing-block-card-carousel-element js-slide g-pa-5">
                            <div class="g-parent g-pos-rel g-overflow-hidden">
                                <img class="landing-block-node-carousel-element-img img-fluid g-transform-scale-1_1--parent-hover g-transition-0_3 g-transition--ease-in" src="https://cdn.bitrix24.site/bitrix/images/landing/business/400x269/img13.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
                                <div class="landing-block-node-carousel-element-img-hover g-pos-abs g-top-0 g-left-0 w-100 h-100 g-bg-primary-opacity-0_8 g-color-white opacity-0 g-opacity-1--parent-hover g-pa-25 g-transition-0_3 g-transition--ease-in">
                                    <h3 class="landing-block-node-carousel-element-title text-uppercase g-font-weight-700 g-font-size-16 g-color-white mb-0">Часы</h3>
                                    <div class="landing-block-node-carousel-element-text g-line-height-1_5--hover g-font-size-12 g-transition-0_3 g-transition--ease-in g-color-gray-light-v4"><p>Множество различных моделей</p></div>
                                </div>
                            </div>
                        </div>

                        <div class="landing-block-node-carousel-element landing-block-card-carousel-element js-slide g-pa-5">
                            <div class="g-parent g-pos-rel g-overflow-hidden">
                                <img class="landing-block-node-carousel-element-img img-fluid g-transform-scale-1_1--parent-hover g-transition-0_3 g-transition--ease-in" src="https://cdn.bitrix24.site/bitrix/images/landing/business/400x269/img15.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
                                <div class="landing-block-node-carousel-element-img-hover g-pos-abs g-top-0 g-left-0 w-100 h-100 g-bg-primary-opacity-0_8 g-color-white opacity-0 g-opacity-1--parent-hover g-pa-25 g-transition-0_3 g-transition--ease-in">
                                    <h3 class="landing-block-node-carousel-element-title text-uppercase g-font-weight-700 g-font-size-16 g-color-white mb-0">Фото-техника</h3>
                                    <div class="landing-block-node-carousel-element-text g-line-height-1_5--hover g-font-size-12 g-transition-0_3 g-transition--ease-in g-color-gray-light-v4"><p>Множество различных моделей</p></div>
                                </div>
                            </div>
                        </div>

                        <div class="landing-block-node-carousel-element landing-block-card-carousel-element js-slide g-pa-5">
                            <div class="g-parent g-pos-rel g-overflow-hidden">
                                <img class="landing-block-node-carousel-element-img img-fluid g-transform-scale-1_1--parent-hover g-transition-0_3 g-transition--ease-in" src="https://cdn.bitrix24.site/bitrix/images/landing/business/400x269/img14.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
                                <div class="landing-block-node-carousel-element-img-hover g-pos-abs g-top-0 g-left-0 w-100 h-100 g-bg-primary-opacity-0_8 g-color-white opacity-0 g-opacity-1--parent-hover g-pa-25 g-transition-0_3 g-transition--ease-in">
                                    <h3 class="landing-block-node-carousel-element-title text-uppercase g-font-weight-700 g-font-size-16 g-color-white mb-0">ремни</h3>
                                    <div class="landing-block-node-carousel-element-text g-line-height-1_5--hover g-font-size-12 g-transition-0_3 g-transition--ease-in g-color-gray-light-v4"><p>Множество различных моделей</p></div>
                                </div>
                            </div>
                        </div>

                        <div class="landing-block-node-carousel-element landing-block-card-carousel-element js-slide g-pa-5">
                            <div class="g-parent g-pos-rel g-overflow-hidden">
                                <img class="landing-block-node-carousel-element-img img-fluid g-transform-scale-1_1--parent-hover g-transition-0_3 g-transition--ease-in" src="https://cdn.bitrix24.site/bitrix/images/landing/business/400x269/img16.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
                                <div class="landing-block-node-carousel-element-img-hover g-pos-abs g-top-0 g-left-0 w-100 h-100 g-bg-primary-opacity-0_8 g-color-white opacity-0 g-opacity-1--parent-hover g-pa-25 g-transition-0_3 g-transition--ease-in">
                                    <h3 class="landing-block-node-carousel-element-title text-uppercase g-font-weight-700 g-font-size-16 g-color-white mb-0">Спортивные товары</h3>
                                    <div class="landing-block-node-carousel-element-text g-line-height-1_5--hover g-font-size-12 g-transition-0_3 g-transition--ease-in g-color-gray-light-v4"><p>Множество различных моделей</p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>',
			),
		'01.two_col_with_titles' =>
			array (
				'CODE' => '01.two_col_with_titles',
				'SORT' => '2500',
				'CONTENT' => '<section class="landing-block">
	<div class="container-fluid">
		<div class="row">
			<div class="landing-block-node-img col-md-6 u-bg-overlay g-bg-img-hero g-bg-black-opacity-0_7--after" style="background-image: url(\'https://cdn.bitrix24.site/bitrix/images/landing/business/700x800/img5.jpg\');" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb">
				<div class="landing-block-node-inner-container g-flex-centered g-height-100vh--md g-min-height-300 g-py-40 g-pr-50--md text-md-right">
					<div class="w-100 u-bg-overlay__inner g-py-100 js-animation landing-block-node-inner-container-left landing-block-node-inner-container-right fadeInLeft">
						<h3 class="landing-block-node-small-title landing-block-node-small-title-left h4 g-font-weight-700 g-color-primary g-mb-20">Мы предлагаем</h3>
	
						<div class="landing-block-node-title-container g-brd-left g-brd-left-none--md g-brd-right--md g-brd-7 g-brd-primary g-color-white g-pl-30 g-pr-30 g-pl-0--lg g-mb-30">
							<h2 class="landing-block-node-title landing-block-node-title-left text-uppercase g-line-height-0_9 g-font-weight-700 mb-0 g-font-size-48">Индивидуальные подарки</h2>
						</div>
						<div class="landing-block-node-button-container">
							<a class="btn btn-lg u-btn-inset mx-2 landing-block-node-button u-btn-white g-brd-0" href="#" target="_self">узнать больше</a>
						</div>
					</div>
				</div>
			</div>

			<div class="landing-block-node-img col-md-6 u-bg-overlay g-bg-img-hero g-bg-black-opacity-0_7--after" style="background-image: url(\'https://cdn.bitrix24.site/bitrix/images/landing/business/700x800/img6.jpg\');" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb">
				<div class="landing-block-node-inner-container g-flex-centered g-height-100vh--md g-min-height-300 g-py-40 g-pl-50--md">
					<div class="w-100 u-bg-overlay__inner g-py-100 js-animation landing-block-node-inner-container-right fadeInLeft">
						<h3 class="landing-block-node-small-title landing-block-node-small-title-right h4 g-font-weight-700 g-color-primary g-mb-20">Мы предлагаем</h3>
						
						<div class="landing-block-node-title-container g-brd-left g-brd-7 g-brd-primary g-color-white g-pl-30 g-mb-30">
							<h2 class="landing-block-node-title landing-block-node-title-left text-uppercase g-line-height-0_9 g-font-weight-700 mb-0 g-font-size-48">Корпоративные подарки<br /></h2>
						</div>
						<div class="landing-block-node-button-container">
							<a class="btn btn-lg u-btn-inset mx-2 landing-block-node-button u-btn-white g-brd-0" href="#" target="_self">узнать больше</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>',
			),
		'04.7.one_col_fix_with_title_and_text_2' =>
			array (
				'CODE' => '04.7.one_col_fix_with_title_and_text_2',
				'SORT' => '3000',
				'CONTENT' => '<section class="landing-block g-bg-gray-light-v5 g-pb-20 g-pt-40 js-animation fadeInUp">

        <div class="container text-center g-max-width-800 g-mb-20">

            <div class="landing-block-node-inner text-uppercase u-heading-v2-4--bottom g-brd-primary">
                <h4 class="landing-block-node-subtitle g-font-weight-700 g-font-size-12 g-color-primary g-mb-15">Testimonials</h4>
                <h2 class="landing-block-node-title u-heading-v2__title g-line-height-1_1 g-font-weight-700 g-color-black g-mb-minus-10 g-text-transform-none g-font-open-sans g-font-size-42"><span style="font-weight: normal;">Отзывы клиентов</span><br /></h2>
            </div>

			<div class="landing-block-node-text g-color-gray-dark-v5 g-font-size-15"><p>Мы осчастливили уже более 500 мужчин</p></div>
        </div>

    </section>',
			),
		'23.big_carousel_blocks' =>
			array (
				'CODE' => '23.big_carousel_blocks',
				'SORT' => '3500',
				'CONTENT' => '<section class="landing-block js-animation g-bg-gray-light-v5 g-py-20 fadeIn">

        <div id="carouselFBK001" class="js-carousel" data-autoplay="true" data-infinite="true" data-slides-show="4">
            <div class="landing-block-card-carousel-element js-slide g-pt-60 g-pb-5 g-px-15">
                <div class="text-center u-shadow-v10 g-bg-white g-pa-0-35-35--sm g-pa-0-20-20">
                    <img class="landing-block-node-img rounded-circle mx-auto g-width-100 g-brd-10 g-brd-around g-brd-gray-light-v5 g-pull-50x-up" src="https://cdn.bitrix24.site/bitrix/images/landing/business/500x500/img11.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />

                    <h4 class="landing-block-node-title text-uppercase g-font-weight-700 g-font-size-default mb-0">Алексей</h4>
                    <div class="landing-block-node-subtitle text-uppercase g-font-style-normal g-font-weight-700 g-font-size-10 g-color-gray-dark-v5">Получил в подарок запонки</div>
                    <blockquote class="landing-block-node-text u-blockquote-v7 g-line-height-1_5 g-color-gray-dark-v5 g-bg-primary--before mb-0">Приятный для меня сюрприз! Давно хотел приобрести сам, но теперь не нужно об этом думать!</blockquote>
                </div>
            </div>

            <div class="landing-block-card-carousel-element js-slide g-pt-60 g-pb-5 g-px-15">
                <div class="text-center u-shadow-v10 g-bg-white g-pa-0-35-35--sm g-pa-0-20-20">
                    <img class="landing-block-node-img rounded-circle mx-auto g-width-100 g-brd-10 g-brd-around g-brd-gray-light-v5 g-pull-50x-up" src="https://cdn.bitrix24.site/bitrix/images/landing/business/500x500/img1.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />

                    <h4 class="landing-block-node-title text-uppercase g-font-weight-700 g-font-size-default mb-0">виктор</h4>
                    <div class="landing-block-node-subtitle text-uppercase g-font-style-normal g-font-weight-700 g-font-size-10 g-color-gray-dark-v5">Получил в подарок кошелек</div>
                    <blockquote class="landing-block-node-text u-blockquote-v7 g-line-height-1_5 g-color-gray-dark-v5 g-bg-primary--before mb-0">Приятный для меня сюрприз! Давно хотел приобрести сам, но теперь не нужно об этом думать!</blockquote>
                </div>
            </div>

            <div class="landing-block-card-carousel-element js-slide g-pt-60 g-pb-5 g-px-15">
                <div class="text-center u-shadow-v10 g-bg-white g-pa-0-35-35--sm g-pa-0-20-20">
                    <img class="landing-block-node-img rounded-circle mx-auto g-width-100 g-brd-10 g-brd-around g-brd-gray-light-v5 g-pull-50x-up" src="https://cdn.bitrix24.site/bitrix/images/landing/business/500x500/img5.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />

                    <h4 class="landing-block-node-title text-uppercase g-font-weight-700 g-font-size-default mb-0">николай</h4>
                    <div class="landing-block-node-subtitle text-uppercase g-font-style-normal g-font-weight-700 g-font-size-10 g-color-gray-dark-v5">Получил в подарок ремень</div>
                    <blockquote class="landing-block-node-text u-blockquote-v7 g-line-height-1_5 g-color-gray-dark-v5 g-bg-primary--before mb-0">Приятный для меня сюрприз! Давно хотел приобрести сам, но теперь не нужно об этом думать!</blockquote>
                </div>
            </div>

            <div class="landing-block-card-carousel-element js-slide g-pt-60 g-pb-5 g-px-15">
                <div class="text-center u-shadow-v10 g-bg-white g-pa-0-35-35--sm g-pa-0-20-20">
                    <img class="landing-block-node-img rounded-circle mx-auto g-width-100 g-brd-10 g-brd-around g-brd-gray-light-v5 g-pull-50x-up" src="https://cdn.bitrix24.site/bitrix/images/landing/business/500x500/img4.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />

                    <h4 class="landing-block-node-title text-uppercase g-font-weight-700 g-font-size-default mb-0">василий</h4>
                    <div class="landing-block-node-subtitle text-uppercase g-font-style-normal g-font-weight-700 g-font-size-10 g-color-gray-dark-v5">Получил в подарок парфюм</div>
                    <blockquote class="landing-block-node-text u-blockquote-v7 g-line-height-1_5 g-color-gray-dark-v5 g-bg-primary--before mb-0">Приятный для меня сюрприз! Давно хотел приобрести сам, но теперь не нужно об этом думать!</blockquote>
                </div>
            </div>

            <div class="landing-block-card-carousel-element js-slide g-pt-60 g-pb-5 g-px-15">
                <div class="text-center u-shadow-v10 g-bg-white g-pa-0-35-35--sm g-pa-0-20-20">
                    <img class="landing-block-node-img rounded-circle mx-auto g-width-100 g-brd-10 g-brd-around g-brd-gray-light-v5 g-pull-50x-up" src="https://cdn.bitrix24.site/bitrix/images/landing/business/500x500/img12.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />

                    <h4 class="landing-block-node-title text-uppercase g-font-weight-700 g-font-size-default mb-0">александр</h4>
                    <div class="landing-block-node-subtitle text-uppercase g-font-style-normal g-font-weight-700 g-font-size-10 g-color-gray-dark-v5">Получил в подарок фотоаппарат</div>
                    <blockquote class="landing-block-node-text u-blockquote-v7 g-line-height-1_5 g-color-gray-dark-v5 g-bg-primary--before mb-0">Приятный для меня сюрприз! Давно хотел приобрести сам, но теперь не нужно об этом думать!</blockquote>
                </div>
            </div>

            <div class="landing-block-card-carousel-element js-slide g-pt-60 g-pb-5 g-px-15">
                <div class="text-center u-shadow-v10 g-bg-white g-pa-0-35-35--sm g-pa-0-20-20">
                    <img class="landing-block-node-img rounded-circle mx-auto g-width-100 g-brd-10 g-brd-around g-brd-gray-light-v5 g-pull-50x-up" src="https://cdn.bitrix24.site/bitrix/images/landing/business/500x500/img13.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />

                    <h4 class="landing-block-node-title text-uppercase g-font-weight-700 g-font-size-default mb-0">владимир</h4>
                    <div class="landing-block-node-subtitle text-uppercase g-font-style-normal g-font-weight-700 g-font-size-10 g-color-gray-dark-v5">Получил в подарок галстук</div>
                    <blockquote class="landing-block-node-text u-blockquote-v7 g-line-height-1_5 g-color-gray-dark-v5 g-bg-primary--before mb-0">Приятный для меня сюрприз! Давно хотел приобрести сам, но теперь не нужно об этом думать!</blockquote>
                </div>
            </div>

            <div class="landing-block-card-carousel-element js-slide g-pt-60 g-pb-5 g-px-15">
                <div class="text-center u-shadow-v10 g-bg-white g-pa-0-35-35--sm g-pa-0-20-20">
                    <img class="landing-block-node-img rounded-circle mx-auto g-width-100 g-brd-10 g-brd-around g-brd-gray-light-v5 g-pull-50x-up" src="https://cdn.bitrix24.site/bitrix/images/landing/business/500x500/img14.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />

                    <h4 class="landing-block-node-title text-uppercase g-font-weight-700 g-font-size-default mb-0">елизар</h4>
                    <div class="landing-block-node-subtitle text-uppercase g-font-style-normal g-font-weight-700 g-font-size-10 g-color-gray-dark-v5">Получил в подарок гантели</div>
                    <blockquote class="landing-block-node-text u-blockquote-v7 g-line-height-1_5 g-color-gray-dark-v5 g-bg-primary--before mb-0">Приятный для меня сюрприз! Давно хотел приобрести сам, но теперь не нужно об этом думать!</blockquote>
                </div>
            </div>

        </div>

    </section>',
			),
		'18.two_cols_fix_img_text_button' =>
			array (
				'CODE' => '18.two_cols_fix_img_text_button',
				'SORT' => '4000',
				'CONTENT' => '<section class="landing-block g-bg-primary g-bg-primary-opacity-0_8--after g-pt-40 g-pb-40">
	<div class="container text-center text-lg-left g-color-white">
		<div class="row g-flex-centered">
			<div class="col-lg-3 offset-lg-1">
				<img class="landing-block-node-img img-fluid g-width-200 g-width-auto--lg g-mb-30 g-mb-0--lg mx-auto" src="https://cdn.bitrix24.site/bitrix/images/landing/business/874x600/img3.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
			</div>

			<div class="col-lg-6 u-bg-overlay__inner g-flex-centered">
				<div class="w-100">
					<h2 class="landing-block-node-title g-line-height-1_1 g-font-weight-700 g-mb-10 g-text-transform-none g-font-size-38 g-font-open-sans js-animation fadeInDown"><span style="font-weight: normal;">Специальные акции</span></h2>
					<div class="landing-block-node-text g-line-height-1_2 g-color-white g-font-size-17 js-animation fadeIn"><p>Только у нас акции на подарочные наборы от 2000 руб.</p></div>
				</div>
			</div>

			<a class="landing-block-node-button btn btn-lg u-btn-inset mx-2 g-flex-centered g-flex-right--lg u-btn-white g-color-primary g-brd-0 rounded-0 js-animation fadeInUp" href="#" target="_self">Подробнее</a>
		</div>
	</div>
</section>',
			),
		'43.2.three_tiles_with_img_zoom' =>
			array (
				'CODE' => '43.2.three_tiles_with_img_zoom',
				'SORT' => '4500',
				'CONTENT' => '<section class="landing-block g-pt-80 g-pb-80">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-lg-4 g-mb-30 g-mb-0--lg">
				<!-- Article -->
				<article class="text-center u-block-hover u-bg-overlay g-color-white g-bg-img-hero g-bg-black-opacity-0_3--after landing-block-node-block js-animation fadeInUp">
					<!-- Article Image -->
					<img class="landing-block-node-img1 w-100 u-block-hover__main--zoom-v1" src="https://cdn.bitrix24.site/bitrix/images/landing/business/800x867/img5.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
					<!-- End Article Image -->

					<!-- Article Content -->
					<div class="u-block-hover__additional u-bg-overlay__inner g-pos-abs g-flex-middle g-brd-around g-brd-2 g-brd-white-opacity-0_3 g-pa-15 g-ma-20">
						<div class="text-uppercase g-flex-middle-item">
							<h3 class="landing-block-node-subtitle1 g-font-weight-700 g-font-size-18 g-color-white g-brd-bottom g-brd-2 g-brd-primary g-mb-20">набор из кожгалантереи</h3>
							<div class="landing-block-node-title1 text-uppercase g-line-height-1 g-font-weight-700 g-font-size-40 g-mb-30"><span style="font-weight: bold;">скидка 40%</span></div>
							<div class="landing-block-node-button1-container">
								<a class="landing-block-node-button1 btn btn-md text-uppercase u-btn-primary g-font-weight-700 g-font-size-11 g-brd-none rounded-0 g-py-10 g-px-25" href="#" target="_self">узнать больше</a>
							</div>
						</div>
					</div>
					<!-- End Article Content -->
				
				<!-- End Article -->
			</article></div>

			<div class="col-md-6 col-lg-4 g-mb-30 g-mb-0--lg">
				<!-- Article -->
				<article class="text-center u-block-hover u-bg-overlay g-color-white g-bg-img-hero g-bg-black-opacity-0_3--after landing-block-node-block js-animation fadeInUp">
					<!-- Article Image -->
					<img class="landing-block-node-img2 w-100 u-block-hover__main--zoom-v1" src="https://cdn.bitrix24.site/bitrix/images/landing/business/800x867/img6.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
					<!-- End Article Image -->

					<!-- Article Content -->
					<div class="u-block-hover__additional u-bg-overlay__inner g-pos-abs g-flex-middle g-brd-around g-brd-2 g-brd-white-opacity-0_3 g-pa-15 g-ma-20">
						<div class="text-uppercase g-flex-middle-item">
							<h3 class="landing-block-node-subtitle2 g-font-weight-700 g-font-size-16 g-color-white g-mb-5">скидка 20% на</h3>
							<div class="landing-block-node-title2 text-uppercase g-line-height-1 g-font-weight-700 g-font-size-28 g-mb-10"><span style="font-weight: bold;">набор</span></div>
							<h3 class="landing-block-node-text2 g-font-weight-700 g-font-size-16 g-color-white mb-0">из мужских аксессуаров</h3>
						</div>
					</div>
					<!-- End Article Content -->
				
				<!-- End Article -->
			</article></div>

			<div class="col-lg-4">
				<!-- Article -->
				<article class="landing-block-node-bg-mini text-center u-block-hover g-color-white g-bg-primary g-mb-30">
					<div class="g-brd-around g-brd-2 g-brd-white-opacity-0_3 g-pa-30 g-ma-20">
						<div class="g-flex-middle-item">
							<h3 class="landing-block-node-title-mini text-uppercase g-font-weight-700 g-font-size-18 g-color-white g-mb-10">часы</h3>
							<div class="landing-block-node-text-mini g-font-size-12 g-color-white mb-0">Водонепроницаемые, из стали или драгоценных металлов и другие</div>
						</div>
					</div>
				</article>
				<!-- End Article -->

				<!-- Article -->
				<article class="text-center u-block-hover u-bg-overlay g-color-white g-bg-img-hero g-bg-black-opacity-0_3--after landing-block-node-block js-animation fadeInUp">
					<!-- Article Image -->
					<img class="landing-block-node-img-mini w-100 u-block-hover__main--zoom-v1" src="https://cdn.bitrix24.site/bitrix/images/landing/business/800x401/img3.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
					<!-- End Article Image -->

					<!-- Article Content -->
					<div class="u-block-hover__additional u-bg-overlay__inner g-pos-abs g-flex-middle g-brd-around g-brd-2 g-brd-white-opacity-0_3 g-pa-15 g-ma-20">
						<div class="g-flex-middle-item">
							<h3 class="landing-block-node-title-mini text-uppercase g-font-weight-700 g-font-size-18 g-color-white g-mb-5">1+1</h3>
							<div class="landing-block-node-text-mini g-font-size-12 g-color-white mb-0"><p>Акция, купи набор конфет, второй в подарок!</p></div>
						</div>
					</div>
					<!-- End Article Content -->
				
				<!-- End Article -->
			</article></div>
		</div>
	</div>
</section>',
			),
		'04.7.one_col_fix_with_title_and_text_2@2' =>
			array (
				'CODE' => '04.7.one_col_fix_with_title_and_text_2',
				'SORT' => '5000',
				'CONTENT' => '<section class="landing-block g-bg-gray-light-v5 g-pt-50 g-pb-45 js-animation fadeInUp">

        <div class="container text-center g-max-width-800 g-mb-20">

            <div class="landing-block-node-inner text-uppercase u-heading-v2-4--bottom g-brd-primary">
                <h4 class="landing-block-node-subtitle g-font-weight-700 g-font-size-12 g-color-primary g-mb-15">наши друзья</h4>
                <h2 class="landing-block-node-title u-heading-v2__title g-font-weight-700 g-color-black g-mb-minus-10 g-text-transform-none g-font-open-sans g-font-size-42 g-line-height-1_3 g-letter-spacing-0"><span style="font-weight: normal;">Компании-партнеры</span><br /></h2>
            </div>

			<div class="landing-block-node-text g-color-gray-dark-v5"><p>Огромный выбор подарков - это не только наша заслуга, но и наших дорогих партнеров!</p></div>
        </div>

    </section>',
			),
		'24.2.image_carousel_6_cols_fix_3' =>
			array (
				'CODE' => '24.2.image_carousel_6_cols_fix_3',
				'SORT' => '5500',
				'CONTENT' => '<section class="landing-block landing-block-node-bgimg js-animation g-bg-img-hero u-bg-overlay g-bg-primary-opacity-0_9--after g-pt-60 g-pb-80 fadeIn" style="background-image: url(\'https://cdn.bitrix24.site/bitrix/images/landing/business/1920x350/img3.jpg\');" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb">
	<div class="container u-bg-overlay__inner text-center">
		<div id="carouselGLR004" class="js-carousel" data-autoplay="true" data-pause-hover="true" data-infinite="true" data-slides-show="6">
			<div class="landing-block-card-carousel-element js-slide g-mx-15 g-pt-20">
				<a href="#" class="landing-block-card-logo-link" target="_self">
					<img class="landing-block-node-img mx-auto g-width-120" src="https://cdn.bitrix24.site/bitrix/images/landing/business/250x200/img1.png" alt="" />
				</a>
			</div>

			<div class="landing-block-card-carousel-element js-slide g-mx-15 g-pt-20">
				<a href="#" class="landing-block-card-logo-link" target="_self">
					<img class="landing-block-node-img mx-auto g-width-120" src="https://cdn.bitrix24.site/bitrix/images/landing/business/250x200/img2.png" alt="" />
				</a>
			</div>

			<div class="landing-block-card-carousel-element js-slide g-mx-15 g-pt-20">
				<a href="#" class="landing-block-card-logo-link" target="_self">
					<img class="landing-block-node-img mx-auto g-width-120" src="https://cdn.bitrix24.site/bitrix/images/landing/business/250x200/img3.png" alt="" />
				</a>
			</div>

			<div class="landing-block-card-carousel-element js-slide g-mx-15 g-pt-20">
				<a href="#" class="landing-block-card-logo-link" target="_self">
					<img class="landing-block-node-img mx-auto g-width-120" src="https://cdn.bitrix24.site/bitrix/images/landing/business/250x200/img4.png" alt="" />
				</a>
			</div>

			<div class="landing-block-card-carousel-element js-slide g-mx-15 g-pt-20">
				<a href="#" class="landing-block-card-logo-link" target="_self">
					<img class="landing-block-node-img mx-auto g-width-120" src="https://cdn.bitrix24.site/bitrix/images/landing/business/250x200/img5.png" alt="" />
				</a>
			</div>

			<div class="landing-block-card-carousel-element js-slide g-mx-15 g-pt-20">
				<a href="#" class="landing-block-card-logo-link" target="_self">
					<img class="landing-block-node-img mx-auto g-width-120" src="https://cdn.bitrix24.site/bitrix/images/landing/business/250x200/img6.png" alt="" />
				</a>
			</div>

			<div class="landing-block-card-carousel-element js-slide g-mx-15 g-pt-20">
				<a href="#" class="landing-block-card-logo-link" target="_self">
					<img class="landing-block-node-img mx-auto g-width-120" src="https://cdn.bitrix24.site/bitrix/images/landing/business/250x200/img7.png" alt="" />
				</a>
			</div>

			<div class="landing-block-card-carousel-element js-slide g-mx-15 g-pt-20">
				<a href="#" class="landing-block-card-logo-link" target="_self">
					<img class="landing-block-node-img mx-auto g-width-120" src="https://cdn.bitrix24.site/bitrix/images/landing/business/250x200/img8.png" alt="" />
				</a>
			</div>
		</div>
	</div>
</section>',
			),
		'04.1.one_col_fix_with_title' =>
			array (
				'CODE' => '04.1.one_col_fix_with_title',
				'SORT' => '6000',
				'CONTENT' => '<section class="landing-block landing-block-container g-pb-20 g-pt-50 js-animation fadeInUp">
        <div class="container">
            <div class="landing-block-node-inner text-uppercase text-center u-heading-v2-4--bottom g-brd-primary">
                <h4 class="landing-block-node-subtitle h6 g-font-weight-800 g-font-size-12 g-letter-spacing-1 g-color-primary g-mb-20">контакты</h4>
                <h2 class="landing-block-node-title h1 u-heading-v2__title g-line-height-1_3 g-font-weight-600 g-mb-minus-10 g-text-transform-none g-font-size-42 g-font-open-sans"><span style="color: rgb(33, 33, 33); font-weight: normal;">Напишите нам</span></h2>
            </div>
        </div>
    </section>',
			),
		'33.10.form_2_light_left_text' =>
			array (
				'CODE' => '33.10.form_2_light_left_text',
				'SORT' => '6500',
				'CONTENT' => '<section class="g-pos-rel landing-block text-center g-color-gray-dark-v1 g-pt-100 g-pb-100">

	<div class="container">

		<div class="landing-block-form-styles" hidden="">
			<div class="g-bg-transparent h1 g-color-white g-brd-none g-pa-0" data-form-style-wrapper-padding="1" data-form-style-bg="1" data-form-style-bg-content="1" data-form-style-bg-block="1" data-form-style-header-font-size="1" data-form-style-main-font-weight="1" data-form-style-button-font-color="1" data-form-style-border-block="1">
			</div>
			<div class="g-bg-primary g-color-primary g-brd-primary" data-form-style-main-bg="1" data-form-style-main-border-color="1" data-form-style-main-font-color-hover="1">
			</div>
			<div class="g-bg-gray-light-v5 g-color-gray-dark-v1 g-brd-around g-brd-white rounded-0" data-form-style-input-bg="1" data-form-style-input-select-bg="1" data-form-style-input-border="1" data-form-style-input-border-radius="1" data-form-style-main-font-color="1">
			</div>
			<div class="g-brd-around g-brd-gray-light-v2 g-color-gray-dark-v5 g-brd-bottom g-bg-black-opacity-0_7" data-form-style-input-border-color="1" data-form-style-input-border-hover="1" data-form-style-icon-font-color="1">
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="text-center g-overflow-hidden">
					<h3 class="landing-block-node-main-title h3 text-uppercase g-font-weight-700 g-mb-20 g-color-black"><span style="font-weight: normal;">контакты</span></h3>
					
					<div class="landing-block-node-text g-line-height-1_5 text-left g-mb-40 g-color-gray-dark-v5" data-form-style-main-font-family="1" data-form-style-main-font-weight="1" data-form-style-header-text-font-size="1"><p>Для большей информации, свяжитесь с нами удобным для вас способом</p></div>
					<div class="g-mx-minus-2 g-my-minus-2">
						<div class="row mx-0">
							<div class="landing-block-card-contact col-sm-6 g-brd-left g-brd-bottom g-brd-gray-light-v4 g-px-15 g-py-25 js-animation fadeIn">
								<i class="landing-block-card-contact-icon icon-anchor d-inline-block g-font-size-50 g-color-primary g-mb-30"></i>
								<h3 class="landing-block-card-contact-title text-uppercase g-font-size-11 g-color-gray-dark-v5 mb-0" data-form-style-label-font-weight="1" data-form-style-label-font-size="1" data-form-style-second-font-color="1">адрес</h3>
								<div class="landing-block-card-contact-text g-font-size-11"><span style="font-weight: bold;">Улица и дом с офисом</span></div>
							</div>

							<div class="landing-block-card-contact col-sm-6 g-brd-left g-brd-bottom g-brd-gray-light-v4 g-px-15 g-py-25 js-animation fadeIn">
								<i class="landing-block-card-contact-icon icon-call-in d-inline-block g-font-size-50 g-color-primary g-mb-30"></i>
								<h3 class="landing-block-card-contact-title text-uppercase g-font-size-11 g-color-gray-dark-v5 mb-0" data-form-style-label-font-weight="1" data-form-style-label-font-size="1" data-form-style-second-font-color="1">телефон</h3>
								<div class="g-font-size-11">
									<a href="tel:+4025448569" class="landing-block-card-contact-link g-font-weight-700">+402 5448 569</a>
								</div>
							</div>

							<div class="landing-block-card-contact col-sm-6 g-brd-left g-brd-bottom g-brd-gray-light-v4 g-px-15 g-py-25 js-animation fadeIn">
								<i class="landing-block-card-contact-icon icon-line icon-envelope-letter d-inline-block g-font-size-50 g-color-primary g-mb-30"></i>
								<h3 class="landing-block-card-contact-title text-uppercase g-font-size-11 g-color-gray-dark-v5 mb-0" data-form-style-label-font-weight="1" data-form-style-label-font-size="1" data-form-style-second-font-color="1">
									Email</h3>
								<div class="g-font-size-11 g-color-gray-dark-v1">
									<a href="mailto:info@company24.com" class="landing-block-card-contact-link g-font-weight-700">info@company24.com</a>
								</div>
							</div>

							<div class="landing-block-card-contact col-sm-6 g-brd-left g-brd-bottom g-brd-gray-light-v4 g-px-15 g-py-25 js-animation fadeIn">
								<i class="landing-block-card-contact-icon icon-earphones-alt d-inline-block g-font-size-50 g-color-primary g-mb-30"></i>
								<h3 class="landing-block-card-contact-title text-uppercase g-font-size-11 g-color-gray-dark-v5 mb-0" data-form-style-label-font-weight="1" data-form-style-label-font-size="1" data-form-style-second-font-color="1">телефон</h3>
								<div class="g-font-size-11">
									<a href="tel:+4025897660" class="landing-block-card-contact-link g-font-weight-700">+402 5897 660</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="bitrix24forms g-brd-white-opacity-0_6" data-b24form="" data-b24form-use-style="Y" data-b24form-show-header="N" data-b24form-original-domain=""></div>
			</div>
		</div>
	</div>
</section>',
			),
	),
);