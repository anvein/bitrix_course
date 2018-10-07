<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);

return array(
	'name' => Loc::getMessage('LANDING_DEMO_23FEB1_TITLE'),
	'description' => Loc::getMessage('LANDING_DEMO_23FEB1_DESCRIPTION'),
	'fields' => array(
		'ADDITIONAL_FIELDS' => array(
		    'METAOG_IMAGE' => 'https://repo.bitrix24.site/bitrix/images/demo/page/holidays/holiday.23february.1/preview.jpg',
			'THEME_CODE' => 'spa',
			'METAOG_TITLE' => Loc::getMessage('LANDING_DEMO_23FEB1_TITLE'),
			'METAOG_DESCRIPTION' => Loc::getMessage('LANDING_DEMO_23FEB1_DESCRIPTION'),
			'METAMAIN_TITLE' => Loc::getMessage('LANDING_DEMO_23FEB1_TITLE'),
			'METAMAIN_DESCRIPTION' => Loc::getMessage('LANDING_DEMO_23FEB1_DESCRIPTION')
		)
	),
	'sort' => -110,
	'available' => true,
	'active' => \LandingSiteDemoComponent::checkActive(array(
		'ONLY_IN' => array('ru', 'kz', 'by'),
		'EXCEPT' => array()
	)),
	'items' => array (
		'0.menu_15_photography' =>
			array (
				'CODE' => '0.menu_15_photography',
				'SORT' => '-100',
				'CONTENT' => '<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

$context = \\Bitrix\\Main\\Application::getInstance()->getContext();
$request = $context->getRequest();

if ($request->get("landing_mode") != "edit")
{
	\\Bitrix\\Landing\\Manager::setPageClass(
		"MainClass",
		"g-pt-155 g-pt-130--md"
	);
}
?>

<header class="landing-block landing-block-menu landing-ui-pattern-transparent u-header u-header--sticky-top u-header--toggle-section u-header--change-appearance" data-header-fix-moment="300">
	<!-- Top Bar -->
	<div class="landing-block-node-top-block u-header__section u-header__section--hidden g-bg-white g-transition-0_3 g-pt-15">
		<div class="container">
			<div class="row flex-column flex-md-row align-items-center justify-content-md-end text-uppercase g-font-weight-700 g-font-size-13 g-mt-minus-10">
				<div class="col-auto text-center text-md-left g-font-size-10 g-color-gray-dark-v5 mr-md-auto g-px-15 g-mt-10">
					<div class="d-inline-block g-mb-0--md g-ml-0--md g-mx-30--xs">
						<div class="d-inline-block landing-block-node-menu-contact-title">
							<p>Phone Number: </p>
						</div>
						<a class="landing-block-node-menu-contact-link" href="tel:+4554554554"><strong>+4 554 554
								554</strong></a>
					</div>

					<div class="d-inline-block">
						<div class="d-inline-block landing-block-node-menu-contact-title">
							<p>Email:</p>
						</div>
						<a class="landing-block-node-menu-contact-link" href="mailto:support@company24.com"><strong>support@company24.com</strong></a>
					</div>
				</div>

				<div class="col-auto g-px-15 g-mt-10">
				</div>
			</div>
		</div>
	</div>
	<!-- End Top Bar -->

	<div class="landing-block-node-bottom-block u-header__section g-bg-gray-light-v5 g-py-30" data-header-fix-moment-classes="u-shadow-v27">
		<nav class="navbar navbar-expand-lg p-0 g-px-15">
			<div class="container">
				<!-- Logo -->
				<a href="#" class="navbar-brand landing-block-node-menu-logo-link u-header__logo">
					<img class="landing-block-node-menu-logo u-header__logo-img u-header__logo-img--main g-max-width-180"
						 src="/bitrix/images/landing/logos/photography-logo.png" alt="">
				</a>
				<!-- End Logo -->

				<!-- Navigation -->
				<div class="collapse navbar-collapse align-items-center flex-sm-row" id="navBar">
					<ul class="landing-block-node-menu-list js-scroll-nav navbar-nav text-uppercase g-font-weight-700 g-font-size-11 g-pt-20 g-pt-0--lg ml-auto">
						<li class="landing-block-node-menu-list-item nav-item g-mr-25--lg g-mb-7 g-mb-0--lg active">
							<a href="#block@block[46.1.cover_with_bg_image_and_big_title]" class="landing-block-node-menu-list-item-link nav-link p-0" target="_self">Начало страницы</a><span class="sr-only">(current)</span>
						</li>
						<li class="landing-block-node-menu-list-item nav-item g-mx-25--lg g-mb-7 g-mb-0--lg">
							<a href="#block@block[19.6.features_two_cols_with_bg_pattern]" class="landing-block-node-menu-list-item-link nav-link p-0" target="_self">Что мы предлагаем</a>
						</li>
						<li class="landing-block-node-menu-list-item nav-item g-mx-25--lg g-mb-7 g-mb-0--lg">
							<a href="#block@block[11.2.three_cols_fix_tariffs_with_img]" class="landing-block-node-menu-list-item-link nav-link p-0" target="_self">Специальные предложения</a>
						</li>
						
						
						
						
						
					</ul>
				</div>
				<!-- End Navigation -->

				<!-- Responsive Toggle Button -->
				<button class="navbar-toggler btn g-line-height-1 g-brd-none g-pa-0 g-mt-5 ml-auto" type="button" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navBar" data-toggle="collapse" data-target="#navBar">
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
		'46.1.cover_with_bg_image_and_big_title' =>
			array (
				'CODE' => '46.1.cover_with_bg_image_and_big_title',
				'SORT' => '500',
				'CONTENT' => '<section class="landing-block g-pb-30 g-bg-main">
	<div class="container">
		<div class="landing-block-node-bgimg g-bg-cover g-bg-pos-top-center g-bg-img-hero g-bg-black-opacity-0_1--after g-px-20 g-py-200" style="background-image: url(\'https://cdn.bitrix24.site/bitrix/images/landing/business/1600x1068/img3.jpg\');" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb">
			<div class="text-center g-pos-rel g-z-index-1 landing-block-node-container js-animation zoomIn">
				<div class="landing-block-node-subtitle g-color-white g-font-size-20 text-uppercase g-letter-spacing-5 g-mb-50"> </div>
				<h2 class="landing-block-node-title h2 d-inline-block g-brd-around g-brd-2 g-brd-white g-color-white g-font-weight-700 g-font-size-40 text-uppercase g-line-height-1_2 g-letter-spacing-5 g-py-12 g-px-20 g-mb-50">с праздником, мужчины!</h2>
				<div class="landing-block-node-text g-color-white g-font-size-20 text-uppercase g-letter-spacing-5 mb-0"><p>подарки на любой вкус</p></div>
			</div>
		</div>
	</div>
</section>',
			),
		'46.2.cover_with_2_big_images_cols' =>
			array (
				'CODE' => '46.2.cover_with_2_big_images_cols',
				'SORT' => '1000',
				'CONTENT' => '<section class="landing-block g-pt-30 g-pb-30">
	<div class="container">
		<div class="row">

			<div class="col-12 col-md-6 g-min-height-540 g-max-height-810">
				<div class="h-100 g-pb-15 g-pb-0--md">
					<div class="landing-block-node-img-container h-100 g-pos-rel g-parent u-block-hover js-animation fadeIn">
						<img class="landing-block-node-img img-fluid g-object-fit-cover h-100 w-100 u-block-hover__main--zoom-v1" src="https://cdn.bitrix24.site/bitrix/images/landing/business/960x960/img7.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
						<div class="landing-block-node-img-title-container w-100 g-pos-abs g-bottom-0 g-left-0 g-top-0
							g-flex-middle g-bg-black-opacity-0_5 opacity-0 g-opacity-1--parent-hover g-pa-20
							g-transition-0_2 g-transition--ease-in">
							<article class="landing-block-node-img-title-border h-100 g-flex-middle text-center
								g-brd-around g-brd-white-opacity-0_2 text-uppercase g-color-white">
								<div class="g-flex-middle-item">
									<h3 class="landing-block-node-img-title g-color-white h3 g-line-height-1_4 g-letter-spacing-5 g-font-size-20 g-mb-20">подарки</h3>
									<div class="landing-block-node-img-text g-letter-spacing-3 g-font-weight-300 g-mb-40">по мелочи</div>
									<div class="landing-block-node-button-container">
										<a class="landing-block-node-img-button btn btn-md u-btn-outline-white g-font-size-11 g-brd-2 rounded-0 g-px-25" href="#" target="_self">Узнать больше</a>
									</div>
								</div>
							</article>
						</div>
					</div>
				</div>
			</div>

			<div class="col-12 col-md-6 g-min-height-540 g-max-height-810">
				<div class="h-100 g-pb-0">
					<div class="landing-block-node-img-container h-100 g-pos-rel g-parent u-block-hover js-animation fadeIn">
						<img class="landing-block-node-img img-fluid g-object-fit-cover h-100 w-100 u-block-hover__main--zoom-v1" src="https://cdn.bitrix24.site/bitrix/images/landing/business/960x960/img8.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
						<div class="landing-block-node-img-title-container w-100 g-pos-abs g-bottom-0 g-left-0 g-top-0
							g-flex-middle g-bg-black-opacity-0_5 opacity-0 g-opacity-1--parent-hover g-pa-20
							g-transition-0_2 g-transition--ease-in">
							<article class="landing-block-node-img-title-border h-100 g-flex-middle text-center
								g-brd-around g-brd-white-opacity-0_2 text-uppercase g-color-white">
								<div class="g-flex-middle-item">
									<h3 class="landing-block-node-img-title g-color-white h3 g-line-height-1_4 g-letter-spacing-5 g-font-size-20 g-mb-20">подарки</h3>
									<div class="landing-block-node-img-text g-letter-spacing-3 g-font-weight-300 g-mb-40">по мелочи</div>
									<div class="landing-block-node-button-container">
										<a class="landing-block-node-img-button btn btn-md u-btn-outline-white g-font-size-11 g-brd-2 rounded-0 g-px-25" href="#" target="_self">Узнать больше</a>
									</div>
								</div>
							</article>
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
				'SORT' => '1500',
				'CONTENT' => '<section class="landing-block g-pb-20 g-bg-main g-pt-60 js-animation fadeInUp">

        <div class="container text-center g-max-width-800 g-mb-20">

            <div class="landing-block-node-inner text-uppercase u-heading-v2-4--bottom g-brd-primary">
                <h4 class="landing-block-node-subtitle g-font-weight-700 g-font-size-12 g-color-primary g-mb-15"> </h4>
                <h2 class="landing-block-node-title u-heading-v2__title g-line-height-1_1 g-font-weight-700 g-color-black g-mb-minus-10 g-font-size-33">счастливые обладатели подарков<br /></h2>
            </div>

			<div class="landing-block-node-text g-color-gray-dark-v5 g-letter-spacing-3"><p>МЫ ОСЧАСТЛИВИЛИ БОЛЕЕ 500 МУЖЧИН</p></div>
        </div>

    </section>',
			),
		'45.1.gallery_app_wo_slider' =>
			array (
				'CODE' => '45.1.gallery_app_wo_slider',
				'SORT' => '2000',
				'CONTENT' => '<div class="landing-block g-pt-80 g-pb-80">
	<div class="container">
		<div class="js-gallery-cards row">
			<div class="landing-block-node-card text-center col-lg-3 col-md-4 col-sm-6 g-mb-30 js-animation slideInUp">
				<div class="g-pos-rel g-parent d-inline-block h-100">
					<img data-fancybox="gallery" src="https://cdn.bitrix24.site/bitrix/images/landing/business/530x960/img1.jpg" alt="" class="landing-block-node-card-img g-min-height-380 g-object-fit-cover h-100 w-100" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
					<div class="landing-block-node-card-title-container w-100 g-pos-abs g-bottom-0 g-left-0 g-flex-middle g-bg-primary-opacity-0_9 opacity-0 g-opacity-1--parent-hover g-pa-20 g-transition-0_2 g-transition--ease-in">
						<h3 class="landing-block-node-card-title h3 g-color-white g-font-size-12">ИГОРЬ</h3>
						<div class="landing-block-node-card-subtitle g-color-white"> </div>
					</div>
				</div>
			</div>

			<div class="landing-block-node-card text-center col-lg-3 col-md-4 col-sm-6 g-mb-30 js-animation slideInUp">
				<div class="g-pos-rel g-parent d-inline-block h-100">
					<img data-fancybox="gallery" src="https://cdn.bitrix24.site/bitrix/images/landing/business/530x960/img2.jpg" alt="" class="landing-block-node-card-img g-min-height-380 g-object-fit-cover h-100 w-100" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
					<div class="landing-block-node-card-title-container w-100 g-pos-abs g-bottom-0 g-left-0 g-flex-middle g-bg-primary-opacity-0_9 opacity-0 g-opacity-1--parent-hover g-pa-20 g-transition-0_2 g-transition--ease-in">
						<h3 class="landing-block-node-card-title h3 g-color-white g-font-size-12">ВИКТОР</h3>
						<div class="landing-block-node-card-subtitle g-color-white"> </div>
					</div>
				</div>
			</div>

			<div class="landing-block-node-card text-center col-lg-3 col-md-4 col-sm-6 g-mb-30 js-animation slideInUp">
				<div class="g-pos-rel g-parent d-inline-block h-100">
					<img data-fancybox="gallery" src="https://cdn.bitrix24.site/bitrix/images/landing/business/530x960/img3.jpg" alt="" class="landing-block-node-card-img g-min-height-380 g-object-fit-cover h-100 w-100" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
					<div class="landing-block-node-card-title-container w-100 g-pos-abs g-bottom-0 g-left-0 g-flex-middle g-bg-primary-opacity-0_9 opacity-0 g-opacity-1--parent-hover g-pa-20 g-transition-0_2 g-transition--ease-in">
						<h3 class="landing-block-node-card-title h3 g-color-white g-font-size-12">ВАЛЕНТИН</h3>
						<div class="landing-block-node-card-subtitle g-color-white"> </div>
					</div>
				</div>
			</div>

			<div class="landing-block-node-card text-center col-lg-3 col-md-4 col-sm-6 g-mb-30 js-animation slideInUp">
				<div class="g-pos-rel g-parent d-inline-block h-100">
					<img data-fancybox="gallery" src="https://cdn.bitrix24.site/bitrix/images/landing/business/530x960/img4.jpg" alt="" class="landing-block-node-card-img g-min-height-380 g-object-fit-cover h-100 w-100" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
					<div class="landing-block-node-card-title-container w-100 g-pos-abs g-bottom-0 g-left-0 g-flex-middle g-bg-primary-opacity-0_9 opacity-0 g-opacity-1--parent-hover g-pa-20 g-transition-0_2 g-transition--ease-in">
						<h3 class="landing-block-node-card-title h3 g-color-white g-font-size-12">АЛЕКСАНДР</h3>
						<div class="landing-block-node-card-subtitle g-color-white"> </div>
					</div>
				</div>
			</div>

			

			

			

			

			

			

			

			
		</div>
	</div>
</div>',
			),
		'19.6.features_two_cols_with_bg_pattern' =>
			array (
				'CODE' => '19.6.features_two_cols_with_bg_pattern',
				'SORT' => '2500',
				'CONTENT' => '<section class="landing-block g-pt-80 g-pb-80 g-bg-pattern-dark-v1">
	<div class="container">
		<div class="text-uppercase text-center g-mb-70">
			<h2 class="landing-block-node-title d-inline-block g-letter-spacing-0_5 g-font-weight-700 g-font-size-12 g-color-white g-brd-bottom g-brd-5 g-brd-white g-pb-8 g-mb-20">Что мы предлагаем</h2>
			<div class="landing-block-node-text text-uppercase g-letter-spacing-3 g-font-size-12 g-color-gray-dark-v4 mb-0"><p>Большие подарки и не очень</p></div>
		</div>

		<div class="row">
			<div class="landing-block-node-card col-lg-6 g-pl-100--md g-mb-30 js-animation slideInUp">
				<article class="landing-block-node-card-container media d-block d-md-flex h-100 g-bg-white">
					<!-- Article Image -->
					<div class="d-md-flex align-self-center g-mr-30--md g-ml-minus-82--md">
						<img class="landing-block-node-card-img w-100" src="https://cdn.bitrix24.site/bitrix/images/landing/business/169x169/img13.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
					</div>
					<!-- End Article Image -->

					<div class="media-body align-self-center g-py-50 g-pl-40 g-pl-0--md g-pr-40">
						<h3 class="landing-block-node-card-title h6 text-uppercase g-letter-spacing-4 g-font-weight-700 g-mb-20">ремни</h3>
						<div class="landing-block-node-card-text g-color-gray-dark-v5 mb-0"><p>Наши подарки лучшего качества.</p><p>Порадуйте своего мужчину!</p><p>Выбирайте оригинальные подарки! </p></div>
					</div>
					<!-- End Article Content -->
				</article>
			</div>

			<div class="landing-block-node-card col-lg-6 g-pl-100--md g-mb-30 js-animation slideInUp">
				<article class="landing-block-node-card-container media d-block d-md-flex h-100 g-bg-white">
					<!-- Article Image -->
					<div class="d-md-flex align-self-center g-mr-30--md g-ml-minus-82--md">
						<img class="landing-block-node-card-img w-100" src="https://cdn.bitrix24.site/bitrix/images/landing/business/169x169/img8.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
					</div>
					<!-- End Article Image -->

					<div class="media-body align-self-center g-py-50 g-pl-40 g-pl-0--md g-pr-40">
						<h3 class="landing-block-node-card-title h6 text-uppercase g-letter-spacing-4 g-font-weight-700 g-mb-20">аксессуары</h3>
						<div class="landing-block-node-card-text g-color-gray-dark-v5 mb-0"><p>Наши подарки лучшего качества.</p><p>Порадуйте своего мужчину!</p><p>Выбирайте оригинальные подарки! </p></div>
					</div>
					<!-- End Article Content -->
				</article>
			</div>
			
			<div class="landing-block-node-card col-lg-6 g-pl-100--md g-mb-30 js-animation slideInUp">
				<article class="landing-block-node-card-container media d-block d-md-flex h-100 g-bg-white">
					<!-- Article Image -->
					<div class="d-md-flex align-self-center g-mr-30--md g-ml-minus-82--md">
						<img class="landing-block-node-card-img w-100" src="https://cdn.bitrix24.site/bitrix/images/landing/business/169x169/img14.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
					</div>
					<!-- End Article Image -->

					<div class="media-body align-self-center g-py-50 g-pl-40 g-pl-0--md g-pr-40">
						<h3 class="landing-block-node-card-title h6 text-uppercase g-letter-spacing-4 g-font-weight-700 g-mb-20">техника</h3>
						<div class="landing-block-node-card-text g-color-gray-dark-v5 mb-0"><p>Наши подарки лучшего качества.</p><p><span style="font-size: 1rem;">Порадуйте своего мужчину!</span></p><p>Выбирайте оригинальные подарки! </p></div>
					</div>
					<!-- End Article Content -->
				</article>
			</div>

			<div class="landing-block-node-card col-lg-6 g-pl-100--md g-mb-30 js-animation slideInUp">
				<article class="landing-block-node-card-container media d-block d-md-flex h-100 g-bg-white">
					<!-- Article Image -->
					<div class="d-md-flex align-self-center g-mr-30--md g-ml-minus-82--md">
						<img class="landing-block-node-card-img w-100" src="https://cdn.bitrix24.site/bitrix/images/landing/business/169x169/img15.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
					</div>
					<!-- End Article Image -->

					<div class="media-body align-self-center g-py-50 g-pl-40 g-pl-0--md g-pr-40">
						<h3 class="landing-block-node-card-title h6 text-uppercase g-letter-spacing-4 g-font-weight-700 g-mb-20">сладкие подарки</h3>
						<div class="landing-block-node-card-text g-color-gray-dark-v5 mb-0"><p>Наши подарки лучшего качества.</p><p><span style="font-size: 1rem;">Порадуйте своего мужчину!</span></p><p>Выбирайте оригинальные подарки! </p></div>
					</div>
					<!-- End Article Content -->
				</article>
			</div>
			
			<div class="landing-block-node-card col-lg-6 g-pl-100--md g-mb-30 js-animation slideInUp">
				<article class="landing-block-node-card-container media d-block d-md-flex h-100 g-bg-white">
					<!-- Article Image -->
					<div class="d-md-flex align-self-center g-mr-30--md g-ml-minus-82--md">
						<img class="landing-block-node-card-img w-100" src="https://cdn.bitrix24.site/bitrix/images/landing/business/169x169/img16.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
					</div>
					<!-- End Article Image -->

					<div class="media-body align-self-center g-py-50 g-pl-40 g-pl-0--md g-pr-40">
						<h3 class="landing-block-node-card-title h6 text-uppercase g-letter-spacing-4 g-font-weight-700 g-mb-20">часы</h3>
						<div class="landing-block-node-card-text g-color-gray-dark-v5 mb-0"><p>Наши подарки лучшего качества.</p><p>Порадуйте своего мужчину!</p><p>Выбирайте оригинальные подарки! </p></div>
					</div>
					<!-- End Article Content -->
				</article>
			</div>

			<div class="landing-block-node-card col-lg-6 g-pl-100--md g-mb-30 js-animation slideInUp">
				<article class="landing-block-node-card-container media d-block d-md-flex h-100 g-bg-white">
					<!-- Article Image -->
					<div class="d-md-flex align-self-center g-mr-30--md g-ml-minus-82--md">
						<img class="landing-block-node-card-img w-100" src="https://cdn.bitrix24.site/bitrix/images/landing/business/169x169/img17.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
					</div>
					<!-- End Article Image -->

					<div class="media-body align-self-center g-py-50 g-pl-40 g-pl-0--md g-pr-40">
						<h3 class="landing-block-node-card-title h6 text-uppercase g-letter-spacing-4 g-font-weight-700 g-mb-20">различные наборы</h3>
						<div class="landing-block-node-card-text g-color-gray-dark-v5 mb-0"><p>Наши подарки лучшего качества.</p><p><span style="font-size: 1rem;">Порадуйте своего мужчину!</span></p><p>Выбирайте оригинальные подарки! </p></div>
					</div>
					<!-- End Article Content -->
				</article>
			</div>
		</div>
	</div>
</section>',
			),
		'04.7.one_col_fix_with_title_and_text_2@2' =>
			array (
				'CODE' => '04.7.one_col_fix_with_title_and_text_2',
				'SORT' => '3000',
				'CONTENT' => '<section class="landing-block g-pb-20 g-bg-main g-pt-60 js-animation fadeInUp">

        <div class="container text-center g-max-width-800 g-mb-20">

            <div class="landing-block-node-inner text-uppercase u-heading-v2-4--bottom g-brd-primary">
                <h4 class="landing-block-node-subtitle g-font-weight-700 g-font-size-12 g-color-primary g-mb-15"> </h4>
                <h2 class="landing-block-node-title u-heading-v2__title g-line-height-1_1 g-font-weight-700 g-color-black g-mb-minus-10 g-font-size-12">Что мы предлагаем</h2>
            </div>

			<div class="landing-block-node-text g-color-gray-dark-v5 g-letter-spacing-3"><p>БОЛЬШИЕ ПОДАРКИ И НЕ ОЧЕНЬ</p></div>
        </div>

    </section>',
			),
		'32.5.img_grid_3cols_1' =>
			array (
				'CODE' => '32.5.img_grid_3cols_1',
				'SORT' => '3500',
				'CONTENT' => '<section class="landing-block g-pt-30 g-pb-30">

	<div class="container">
		<div class="row js-gallery-cards">

			<div class="col-12 col-sm-4">
				<div class="h-100 g-pb-15 g-pb-0--sm">
					<div class="landing-block-node-img-container h-100 g-pos-rel g-parent u-block-hover">
						<img data-fancybox="gallery" class="landing-block-node-img img-fluid g-object-fit-cover h-100 w-100 u-block-hover__main--zoom-v1" src="https://cdn.bitrix24.site/bitrix/images/landing/business/960x600/img4.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
						<div class="landing-block-node-img-title-container w-100 g-pos-abs g-bottom-0 g-left-0 g-top-0
							g-flex-middle g-bg-black-opacity-0_5 opacity-0 g-opacity-1--parent-hover g-pa-20
							g-transition-0_2 g-transition--ease-in">
							<div class="h-100 g-flex-middle g-brd-around g-brd-white-opacity-0_2 text-uppercase">
								<h3 class="landing-block-node-img-title g-flex-middle-item text-center h3
							g-color-white g-line-height-1_4 g-letter-spacing-5 g-font-size-20">техника</h3>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-12 col-sm-4">
				<div class="h-100 g-pb-15 g-pb-0--sm">
					<div class="landing-block-node-img-container h-100 g-pos-rel g-parent u-block-hover">
						<img data-fancybox="gallery" class="landing-block-node-img img-fluid g-object-fit-cover h-100 w-100 u-block-hover__main--zoom-v1" src="https://cdn.bitrix24.site/bitrix/images/landing/business/960x600/img5.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
						<div class="landing-block-node-img-title-container w-100 g-pos-abs g-bottom-0 g-left-0 g-top-0
							g-flex-middle g-bg-black-opacity-0_5 opacity-0 g-opacity-1--parent-hover g-pa-20
							g-transition-0_2 g-transiti	on--ease-in">
							<div class="h-100 g-flex-middle g-brd-around g-brd-white-opacity-0_2 text-uppercase">
								<h3 class="landing-block-node-img-title g-flex-middle-item text-center h3
							g-color-white g-line-height-1_4 g-letter-spacing-5 g-font-size-20">ремни</h3>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-12 col-sm-4">
				<div class="h-100 g-pb-0">
					<div class="landing-block-node-img-container h-100 g-pos-rel g-parent u-block-hover">
						<img data-fancybox="gallery" class="landing-block-node-img img-fluid g-object-fit-cover h-100 w-100 u-block-hover__main--zoom-v1" src="https://cdn.bitrix24.site/bitrix/images/landing/business/960x600/img6.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
						<div class="landing-block-node-img-title-container w-100 g-pos-abs g-bottom-0 g-left-0 g-top-0
							g-flex-middle g-bg-black-opacity-0_5 opacity-0 g-opacity-1--parent-hover g-pa-20
							g-transition-0_2 g-transition--ease-in">
							<div class="h-100 g-flex-middle g-brd-around g-brd-white-opacity-0_2 text-uppercase">
								<h3 class="landing-block-node-img-title g-flex-middle-item text-center h3
							g-color-white g-line-height-1_4 g-letter-spacing-5 g-font-size-20">парфюм</h3>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

</section>',
			),
		'44.6.two_columns_with_peoples' =>
			array (
				'CODE' => '44.6.two_columns_with_peoples',
				'SORT' => '4000',
				'CONTENT' => '<section class="landing-block g-pt-30 g-pb-30">
	<div class="container">
		<div class="row">
			<div class="landing-block-node-card js-animation col-md-6 col-lg-6 g-pt-30 g-mb-50 g-mb-0--md fadeIn">
				<!-- Article -->
				<article class="text-center">
					<!-- Article Image -->
					<img class="landing-block-node-card-photo g-max-width-200 g-rounded-50x g-mb-20" src="https://cdn.bitrix24.site/bitrix/images/landing/business/500x500/img5.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
					<!-- End Article Image -->

					<!-- Article Title -->
					<h4 class="landing-block-node-card-name g-line-height-1 g-font-size-40 g-font-cormorant-infant font-italic g-font-weight-600 g-mb-20">Александр Сандров</h4>
					<!-- End Article Title -->
					<!-- Article Body -->
					<div class="landing-block-node-card-post text-uppercase g-font-weight-700 g-font-size-12 g-color-primary g-mb-30">ПОЛУЧИЛ В ПОДАРОК ЗАПОНКИ</div>
					<div class="landing-block-node-card-text g-font-size-default g-color-gray-dark-v5 g-mb-40"><p>
							Оригинальный дизайн, качественный материал, очень доволен!</p></div>

					<!--				<ul class="text-center list-inline mb-0">-->
					<!--					<li class="list-inline-item g-mx-4">-->
					<!--						<a class="u-icon-v3 g-width-35 g-height-35 g-font-size-default g-color-gray-light-v2 g-color-white--hover g-theme-bg-gray-light-v5 g-bg-primary--hover g-rounded-50x g-transition-0_2 g-transition--ease-in"-->
					<!--						   href="#">-->
					<!--							<i class="fa fa-twitter"></i>-->
					<!--						</a>-->
					<!--					</li>-->
					<!--					<li class="list-inline-item g-mx-4">-->
					<!--						<a class="u-icon-v3 g-width-35 g-height-35 g-font-size-default g-color-gray-light-v2 g-color-white--hover g-theme-bg-gray-light-v5 g-bg-primary--hover g-rounded-50x g-transition-0_2 g-transition--ease-in"-->
					<!--						   href="#">-->
					<!--							<i class="fa fa-pinterest-p"></i>-->
					<!--						</a>-->
					<!--					</li>-->
					<!--					<li class="list-inline-item g-mx-4">-->
					<!--						<a class="u-icon-v3 g-width-35 g-height-35 g-font-size-default g-color-gray-light-v2 g-color-white--hover g-theme-bg-gray-light-v5 g-bg-primary--hover g-rounded-50x g-transition-0_2 g-transition--ease-in"-->
					<!--						   href="#">-->
					<!--							<i class="fa fa-facebook"></i>-->
					<!--						</a>-->
					<!--					</li>-->
					<!--					<li class="list-inline-item g-mx-4">-->
					<!--						<a class="u-icon-v3 g-width-35 g-height-35 g-font-size-default g-color-gray-light-v2 g-color-white--hover g-theme-bg-gray-light-v5 g-bg-primary--hover g-rounded-50x g-transition-0_2 g-transition--ease-in"-->
					<!--						   href="#">-->
					<!--							<i class="fa fa-instagram"></i>-->
					<!--						</a>-->
					<!--					</li>-->
					<!--					<li class="list-inline-item g-mx-4">-->
					<!--						<a class="u-icon-v3 g-width-35 g-height-35 g-font-size-default g-color-gray-light-v2 g-color-white--hover g-theme-bg-gray-light-v5 g-bg-primary--hover g-rounded-50x g-transition-0_2 g-transition--ease-in"-->
					<!--						   href="#">-->
					<!--							<i class="fa fa-linkedin"></i>-->
					<!--						</a>-->
					<!--					</li>-->
					<!--				</ul>-->
					<!-- End Article Body -->
				</article>
				<!-- End Article -->
			</div>

			<div class="landing-block-node-card js-animation col-md-6 col-lg-6 g-pt-30 g-mb-50 g-mb-0--md fadeIn">
				<!-- Article -->
				<article class="text-center">
					<!-- Article Image -->
					<img class="landing-block-node-card-photo g-max-width-200 g-rounded-50x g-mb-20" src="https://cdn.bitrix24.site/bitrix/images/landing/business/500x500/img2.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
					<!-- End Article Image -->

					<!-- Article Title -->
					<h4 class="landing-block-node-card-name g-line-height-1 g-font-size-40 g-font-cormorant-infant font-italic g-font-weight-600 g-mb-20">Дориан Сергеев</h4>
					<!-- End Article Title -->
					<!-- Article Body -->
					<div class="landing-block-node-card-post text-uppercase g-font-weight-700 g-font-size-12 g-color-primary g-mb-30">Получил в подарок кошелек</div>
					<div class="landing-block-node-card-text g-font-size-default g-color-gray-dark-v5 g-mb-40"><p>Оригинальный дизайн, качественный материал, очень доволен!</p></div>

					<!--				<ul class="text-center list-inline mb-0">-->
					<!--					<li class="list-inline-item g-mx-4">-->
					<!--						<a class="u-icon-v3 g-width-35 g-height-35 g-font-size-default g-color-gray-light-v2 g-color-white--hover g-theme-bg-gray-light-v5 g-bg-primary--hover g-rounded-50x g-transition-0_2 g-transition--ease-in"-->
					<!--						   href="#">-->
					<!--							<i class="fa fa-twitter"></i>-->
					<!--						</a>-->
					<!--					</li>-->
					<!--					<li class="list-inline-item g-mx-4">-->
					<!--						<a class="u-icon-v3 g-width-35 g-height-35 g-font-size-default g-color-gray-light-v2 g-color-white--hover g-theme-bg-gray-light-v5 g-bg-primary--hover g-rounded-50x g-transition-0_2 g-transition--ease-in"-->
					<!--						   href="#">-->
					<!--							<i class="fa fa-pinterest-p"></i>-->
					<!--						</a>-->
					<!--					</li>-->
					<!--					<li class="list-inline-item g-mx-4">-->
					<!--						<a class="u-icon-v3 g-width-35 g-height-35 g-font-size-default g-color-gray-light-v2 g-color-white--hover g-theme-bg-gray-light-v5 g-bg-primary--hover g-rounded-50x g-transition-0_2 g-transition--ease-in"-->
					<!--						   href="#">-->
					<!--							<i class="fa fa-facebook"></i>-->
					<!--						</a>-->
					<!--					</li>-->
					<!--					<li class="list-inline-item g-mx-4">-->
					<!--						<a class="u-icon-v3 g-width-35 g-height-35 g-font-size-default g-color-gray-light-v2 g-color-white--hover g-theme-bg-gray-light-v5 g-bg-primary--hover g-rounded-50x g-transition-0_2 g-transition--ease-in"-->
					<!--						   href="#">-->
					<!--							<i class="fa fa-instagram"></i>-->
					<!--						</a>-->
					<!--					</li>-->
					<!--					<li class="list-inline-item g-mx-4">-->
					<!--						<a class="u-icon-v3 g-width-35 g-height-35 g-font-size-default g-color-gray-light-v2 g-color-white--hover g-theme-bg-gray-light-v5 g-bg-primary--hover g-rounded-50x g-transition-0_2 g-transition--ease-in"-->
					<!--						   href="#">-->
					<!--							<i class="fa fa-linkedin"></i>-->
					<!--						</a>-->
					<!--					</li>-->
					<!--				</ul>-->
					<!-- End Article Body -->
				</article>
				<!-- End Article -->
			</div>
		</div>
	</div>
</section>',
			),
		'11.2.three_cols_fix_tariffs_with_img' =>
			array (
				'CODE' => '11.2.three_cols_fix_tariffs_with_img',
				'SORT' => '4500',
				'CONTENT' => '<section class="landing-block g-bg-gray-light-v5 g-pt-100 g-pb-100">
	<div class="container">
		<div class="text-uppercase text-center g-mb-70">
			<h2 class="landing-block-node-title d-inline-block g-letter-spacing-0_5 g-font-weight-700 g-font-size-12 g-brd-bottom g-brd-5 g-brd-primary g-pb-8 g-mb-20">специальные предложения</h2>
			<div class="landing-block-node-text text-uppercase g-letter-spacing-3 g-font-size-12 g-color-gray-dark-v5 mb-0"><p>специальные наборы для мужчин</p></div>
		</div>

		<div class="row">
			<div class="landing-block-node-card col-md-6 col-lg-4 g-mb-30 g-mb-0--md">
				<!-- Article -->
				<article class="landing-block-node-card-container js-animation text-center text-uppercase g-theme-photography-bg-gray-dark-v2 g-color-white-opacity-0_5 fadeInRight">
					<!-- Article Image -->
					<img class="landing-block-node-card-img w-100" src="https://cdn.bitrix24.site/bitrix/images/landing/business/370x200/img7.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
					<!-- End Article Image -->

					<!-- Article Content -->
					<header class="g-letter-spacing-3 g-pos-rel g-px-40 g-mb-30">
						<span class="u-icon-v3 u-icon-size--xl g-rounded-50x g-font-size-26 g-bg-gray-dark-v1 g-color-white g-pull-50x-up">
							<i class="landing-block-node-card-icon icon-camera"></i>
						</span>
						<h4 class="landing-block-node-card-title h6 g-color-white g-mt-minus-25 g-mb-10">набор путешественника</h4>
						<div class="landing-block-node-card-text g-font-size-12 g-color-gray-dark-v4 mb-0"><p>порадуйте мужчину!</p></div>
					</header>

					<div class="landing-block-node-card-price g-font-weight-700 d-block g-color-white g-font-size-26 g-letter-spacing-5 g-mb-20">1000 руб.</div>
					<ul class="landing-block-node-card-price-list list-unstyled g-letter-spacing-0_5 g-font-size-12 mb-0">
						<li class="g-theme-photography-bg-gray-dark-v3 g-py-10 g-px-30"><span style="font-weight: 700;">компас</span></li>
						<li class="g-theme-photography-bg-gray-dark-v4 g-py-10 g-px-30"><span style="font-weight: 700;">охотничий нож</span></li>
						<li class="g-theme-photography-bg-gray-dark-v3 g-py-10 g-px-30">термос</li>
						<li class="g-theme-photography-bg-gray-dark-v4 g-py-10 g-px-30">фонарик</li>
					</ul>

					<footer class="g-pa-40 landing-block-node-card-button-containe">
						<a class="landing-block-node-card-button btn btn-md rounded-0 u-btn-outline-white g-brd-2 g-font-size-12 g-font-weight-600 g-letter-spacing-1" href="#" target="_self">заказать</a>
					</footer>
					<!-- End of Article Content -->
				</article>
				<!-- End Article -->
			</div>

			<div class="landing-block-node-card col-md-6 col-lg-4 g-mb-30 g-mb-0--md">
				<!-- Article -->
				<article class="landing-block-node-card-container js-animation text-center text-uppercase g-theme-photography-bg-gray-dark-v2 g-color-white-opacity-0_5 fadeInRight">
					<!-- Article Image -->
					<img class="landing-block-node-card-img w-100" src="https://cdn.bitrix24.site/bitrix/images/landing/business/370x200/img8.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
					<!-- End Article Image -->

					<!-- Article Content -->
					<header class="g-letter-spacing-3 g-pos-rel g-px-40 g-mb-30">
						<span class="u-icon-v3 u-icon-size--xl g-rounded-50x g-font-size-26 g-bg-gray-dark-v1 g-color-white g-pull-50x-up">
							<i class="landing-block-node-card-icon icon-film"></i>
						</span>
						<h4 class="landing-block-node-card-title h6 g-color-white g-mt-minus-25 g-mb-10">Набор стильного парня</h4>
						<div class="landing-block-node-card-text g-font-size-12 g-color-gray-dark-v4 mb-0"><p>ПОРАДУЙТЕ МУЖЧИНУ!</p></div>
					</header>

					<div class="landing-block-node-card-price g-font-weight-700 d-block g-color-white g-font-size-26 g-letter-spacing-5 g-mb-20">1500 руб.</div>
					<ul class="landing-block-node-card-price-list list-unstyled g-letter-spacing-0_5 g-font-size-12 mb-0">
						<li class="g-theme-photography-bg-gray-dark-v3 g-py-10 g-px-30"><span style="font-weight: 700;">запонки</span></li>
						<li class="g-theme-photography-bg-gray-dark-v4 g-py-10 g-px-30"><span style="font-weight: 700;">галстук</span></li>
						<li class="g-theme-photography-bg-gray-dark-v3 g-py-10 g-px-30"><span style="font-weight: 700;">рубашка</span></li>
						<li class="g-theme-photography-bg-gray-dark-v4 g-py-10 g-px-30"><span style="font-weight: 700;">зажим для галстука</span></li>
					</ul>

					<footer class="g-pa-40 landing-block-node-card-button-containe">
						<a class="landing-block-node-card-button btn btn-md rounded-0 u-btn-outline-white g-brd-2 g-font-size-12 g-font-weight-600 g-letter-spacing-1" href="#" target="_self">заказать</a>
					</footer>
					<!-- End of Article Content -->
				</article>
				<!-- End Article -->
			</div>

			<div class="landing-block-node-card col-md-6 col-lg-4 g-mb-30 g-mb-0--md">
				<!-- Article -->
				<article class="landing-block-node-card-container js-animation text-center text-uppercase g-theme-photography-bg-gray-dark-v2 g-color-white-opacity-0_5 fadeInRight">
					<!-- Article Image -->
					<img class="landing-block-node-card-img w-100" src="https://cdn.bitrix24.site/bitrix/images/landing/business/370x200/img9.jpg" alt="" data-fileid="-1" data-filehash="9eef207add73028ae50f74a9033c20cb" />
					<!-- End Article Image -->

					<!-- Article Content -->
					<header class="g-letter-spacing-3 g-pos-rel g-px-40 g-mb-30">
						<span class="u-icon-v3 u-icon-size--xl g-rounded-50x g-font-size-26 g-bg-gray-dark-v1 g-color-white g-pull-50x-up">
							<i class="landing-block-node-card-icon icon-star"></i>
						</span>
						<h4 class="landing-block-node-card-title h6 g-color-white g-mt-minus-25 g-mb-10">классический набор</h4>
						<div class="landing-block-node-card-text g-font-size-12 g-color-gray-dark-v4 mb-0"><p>ПОРАДУЙТЕ МУЖЧИНУ!</p></div>
					</header>

					<div class="landing-block-node-card-price g-font-weight-700 d-block g-color-white g-font-size-26 g-letter-spacing-5 g-mb-20">2000 руб.</div>
					<ul class="landing-block-node-card-price-list list-unstyled g-letter-spacing-0_5 g-font-size-12 mb-0">
						<li class="g-theme-photography-bg-gray-dark-v3 g-py-10 g-px-30"><span style="font-weight: 700;">кожелек</span></li>
						<li class="g-theme-photography-bg-gray-dark-v4 g-py-10 g-px-30"><span style="font-weight: 700;">сумка</span></li>
						<li class="g-theme-photography-bg-gray-dark-v3 g-py-10 g-px-30"><span style="font-weight: 700;">ремень</span></li>
						<li class="g-theme-photography-bg-gray-dark-v4 g-py-10 g-px-30"><span style="font-weight: 700;">визитница</span></li>
					</ul>

					<footer class="g-pa-40 landing-block-node-card-button-containe">
						<a class="landing-block-node-card-button btn btn-md rounded-0 u-btn-outline-white g-brd-2 g-font-size-12 g-font-weight-600 g-letter-spacing-1" href="#" target="_self">заказать</a>
					</footer>
					<!-- End of Article Content -->
				</article>
				<!-- End Article -->
			</div>
		</div>
	</div>
</section>',
			),
		'35.1.footer_light' =>
			array (
				'CODE' => '35.1.footer_light',
				'SORT' => '5000',
				'CONTENT' => '<section class="g-color-gray-dark-v2 g-pt-60 g-pb-60">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-6 col-lg-6 g-mb-25 g-mb-0--lg">
				<h2 class="landing-block-node-title text-uppercase g-font-weight-700 g-font-size-16 g-mb-20">Свяжитесь с нами</h2>
				<div class="landing-block-node-text g-font-size-default g-color-gray-dark-v2 g-mb-20"><p>Ответим на любые вопросы</p></div>

				<address class="g-color-gray-dark-v2 g-mb-20">
					<div class="landing-block-card-contact g-pos-rel g-pl-20 g-mb-7">
						<i class="landing-block-node-card-contact-icon fa fa-home g-absolute-centered--y g-left-0"></i>
						<div class="landing-block-node-card-contact-text">Адрес: улица и дом с офисом</div>
					</div>

					<div class="landing-block-card-contact g-pos-rel g-pl-20 g-mb-7">
						<i class="landing-block-node-card-contact-icon fa fa-phone g-absolute-centered--y g-left-0"></i>
						<div>
							<span class="landing-block-node-card-contact-text">Телефон: </span>
							<a href="tel:+48 555 2566 112" class="landing-block-node-card-contact-link g-color-gray-dark-v2 g-font-weight-700">+48 555 2566 112</a>
						</div>
					</div>

					<div class="landing-block-card-contact g-pos-rel g-pl-20 g-mb-7">
						<i class="landing-block-node-card-contact-icon fa fa-envelope g-absolute-centered--y g-left-0"></i>
						<div>
							<span class="landing-block-node-card-contact-text">Email:</span>
							<a class="landing-block-node-card-contact-link g-color-gray-dark-v2 g-font-weight-700" href="mailto:info@company24.com">info@company24.com</a>
						</div>
					</div>
				</address>

				<!--				<ul class="list-inline g-mb-20 g-mb-0--md">-->
				<!--					<li class="list-inline-item">-->
				<!--						<a class="u-icon-v2 g-width-35 g-height-35 g-font-size-default g-color-gray-dark-v2 g-color-white--hover g-bg-primary--hover g-brd-gray-dark-v2 g-brd-primary--hover g-rounded-50x g-mx-5"-->
				<!--						   href="#"><i class="fa fa-twitter"></i></a>-->
				<!--					</li>-->
				<!--					<li class="list-inline-item">-->
				<!--						<a class="u-icon-v2 g-width-35 g-height-35 g-font-size-default g-color-gray-dark-v2 g-color-white--hover g-bg-primary--hover g-brd-gray-dark-v2 g-brd-primary--hover g-rounded-50x g-mx-5"-->
				<!--						   href="#"><i class="fa fa-pinterest-p"></i></a>-->
				<!--					</li>-->
				<!--					<li class="list-inline-item">-->
				<!--						<a class="u-icon-v2 g-width-35 g-height-35 g-font-size-default g-color-gray-dark-v2 g-color-white--hover g-bg-primary--hover g-brd-gray-dark-v2 g-brd-primary--hover g-rounded-50x g-mx-5"-->
				<!--						   href="#"><i class="fa fa-facebook"></i></a>-->
				<!--					</li>-->
				<!--					<li class="list-inline-item">-->
				<!--						<a class="u-icon-v2 g-width-35 g-height-35 g-font-size-default g-color-gray-dark-v2 g-color-white--hover g-bg-primary--hover g-brd-gray-dark-v2 g-brd-primary--hover g-rounded-50x g-mx-5"-->
				<!--						   href="#"><i class="fa fa-linkedin"></i></a>-->
				<!--					</li>-->
				<!--				</ul>-->
			</div>


			<div class="col-sm-12 col-md-2 col-lg-2 g-mb-25 g-mb-0--lg">
				<h2 class="landing-block-node-title text-uppercase g-font-weight-700 g-font-size-16 g-mb-20">категории</h2>
				<ul class="list-unstyled g-mb-30">
					<li class="landing-block-card-list-item g-mb-10">
						<a class="landing-block-node-list-item g-color-gray-dark-v5" href="#" target="_self">Кожгалатерея</a>
					</li>
					<li class="landing-block-card-list-item g-mb-10">
						<a class="landing-block-node-list-item g-color-gray-dark-v5" href="#" target="_self">Техника</a>
					</li>
					<li class="landing-block-card-list-item g-mb-10">
						<a class="landing-block-node-list-item g-color-gray-dark-v5" href="#" target="_self">Часы</a>
					</li>
					<li class="landing-block-card-list-item g-mb-10">
						<a class="landing-block-node-list-item g-color-gray-dark-v5" href="#" target="_self">Аксессуары</a>
					</li>
				</ul>
			</div>

			<div class="col-sm-12 col-md-2 col-lg-2 g-mb-25 g-mb-0--lg">
				<h2 class="landing-block-node-title text-uppercase g-font-weight-700 g-font-size-16 g-mb-20">для связи</h2>
				<ul class="list-unstyled g-mb-30">
					<li class="landing-block-card-list-item g-mb-10">
						<a class="landing-block-node-list-item g-color-gray-dark-v5" href="#" target="_self">Форма обратной связи</a>
					</li>
					
					
					
				</ul>
			</div>

			<div class="col-sm-12 col-md-2 col-lg-2 g-mb-25 g-mb-0--lg">
				<h2 class="landing-block-node-title text-uppercase g-font-weight-700 g-font-size-16 g-mb-20">топ ссылок</h2>
				<ul class="list-unstyled g-mb-30">
					<li class="landing-block-card-list-item g-mb-10">
						<a class="landing-block-node-list-item g-color-gray-dark-v5" href="#" target="_self">Отзывы клиентов</a>
					</li>
					<li class="landing-block-card-list-item g-mb-10">
						<a class="landing-block-node-list-item g-color-gray-dark-v5" href="#" target="_self">Специальные предложения</a>
					</li>
					
					
				</ul>
			</div>

		</div>
	</div>
</section>',
			),
		'17.copyright' =>
			array (
				'CODE' => '17.copyright',
				'SORT' => '5500',
				'CONTENT' => '<section class="landing-block js-animation animation-none">
	<div class="text-center g-color-gray-dark-v3 g-pa-10">
		<div class="g-width-600 mx-auto">
			<div class="landing-block-node-text g-font-size-12  js-animation animation-none">
				<p>&copy; 2018 All right reserved.</p>
			</div>
		</div>
	</div>
</section>',
			),
	),
);