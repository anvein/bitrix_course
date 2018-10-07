<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use \Bitrix\Main\Localization\Loc;

Loc::loadLanguageFile(__FILE__);

return array(
	'name' => Loc::getMessage('LANDING_DEMO_B24_TITLE'),
	'description' => Loc::getMessage('LANDING_DEMO_B24_DESCRIPTION'),
	'fields' => array(
		'ADDITIONAL_FIELDS' => array(
			'THEME_CODE' => '3corporate',
			'THEME_CODE_TYPO' => '3corporate',
			'METAOG_IMAGE' => 'https://cdn.bitrix24.site/bitrix/images/demo/page/bitrix24/preview.jpg',
			'METAOG_TITLE' => Loc::getMessage('LANDING_DEMO_B24_TITLE'),
			'METAOG_DESCRIPTION' => Loc::getMessage('LANDING_DEMO_B24_DESCRIPTION'),
			'METAMAIN_TITLE' => Loc::getMessage('LANDING_DEMO_B24_TITLE'),
			'METAMAIN_DESCRIPTION' => Loc::getMessage('LANDING_DEMO_B24_DESCRIPTION')
		)
	),
	'replace' => array(
		'#partner_id#' => \Bitrix\Main\Config\Option::get('bitrix24', 'partner_id', 0)
	),
	'items' => array (
		'0.menu_09_corporate' =>
			array (
				'CODE' => '0.menu_09_corporate',
				'SORT' => '0',
				'CONTENT' => '
<header class="landing-block landing-block-menu u-header u-header--floating">
	<div class="u-header__section g-bg-white g-transition-0_3 g-py-7 g-py-23--md" data-header-fix-moment-exclude="g-py-23--md" data-header-fix-moment-classes="g-py-17--md">
		<nav class="navbar navbar-expand-lg g-py-0">
			<div class="container">
				<!-- Logo -->
				<a href="#" class="landing-block-node-menu-logo-link navbar-brand u-header__logo" target="_self">
					<img class="landing-block-node-menu-logo u-header__logo-img u-header__logo-img--main g-max-width-180" src="https://cdn.bitrix24.ru/b1479079/landing/517/5179f02a73b385c15f86a73c7e9dcf30/Bez+imeni-1.png" alt="" data-fileid="5278" data-filehash="c2c9a6f5e596edcea27c1e5de3f78c76" />
				</a>
				<!-- End Logo -->

				<!-- Navigation -->
				<div class="collapse navbar-collapse align-items-center flex-sm-row" id="navBar">
					<ul id="js-scroll-nav" class="landing-block-node-menu-list navbar-nav text-uppercase g-letter-spacing-1 g-font-size-12 g-pt-20 g-pt-0--lg ml-auto">
						<li class="landing-block-node-menu-list-item nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
							<a href="#" class="landing-block-node-menu-list-item-link nav-link p-0 g-color-black g-font-size-12" target="_self">Акции</a>
						</li>
						
						<li class="landing-block-node-menu-list-item nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
							<a href="#block@block[04.1.one_col_fix_with_title]" class="landing-block-node-menu-list-item-link nav-link p-0 g-color-black g-font-size-12" target="_self">Что такое Битрикс24?</a>
						</li><li class="landing-block-node-menu-list-item nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
							<a href="#block@block[04.1.one_col_fix_with_title_@_GjiahlPL7r]" class="landing-block-node-menu-list-item-link nav-link p-0 g-color-black g-font-size-12" target="_self">Тарифы</a>
						</li>
						<li class="landing-block-node-menu-list-item nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
							<a href="#block@block[04.1.one_col_fix_with_title_@_3ndB2T6qkG]" class="landing-block-node-menu-list-item-link nav-link p-0 g-color-black g-font-size-12" target="_self">Пакеты</a>
						</li>
						<li class="landing-block-node-menu-list-item nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
							<a href="#block@block[04.1.one_col_fix_with_title_@_JinFBJ3Y9J]" class="landing-block-node-menu-list-item-link nav-link p-0 g-color-black g-font-size-12" target="_self">Преимущества</a>
						</li>
						<li class="landing-block-node-menu-list-item nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
							<a href="#block@block[04.2.one_col_fix_with_title_2]" class="landing-block-node-menu-list-item-link nav-link p-0 g-color-black g-font-size-12" target="_self">Компетенции</a>
						</li>
						<li class="landing-block-node-menu-list-item nav-item g-ml-15--lg">
							<a href="#block@block[07.2.two_col_fix_text_with_icon_with_title]" class="landing-block-node-menu-list-item-link nav-link p-0 g-color-black g-font-size-12" target="_self">Этапы</a>
						</li>
					<li class="landing-block-node-menu-list-item nav-item g-ml-15--lg">
							<a href="#block@block[04.1.one_col_fix_with_title_@_Mnlpn9rMs6]" class="landing-block-node-menu-list-item-link nav-link p-0 g-color-black g-font-size-12" target="_self">Контакты</a>
						</li></ul>
				</div>
				<!-- End Navigation -->

				<!-- Responsive Toggle Button -->
				<button class="navbar-toggler btn g-line-height-1 g-brd-none g-pa-0 g-mt-12 ml-auto" type="button" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navBar" data-toggle="collapse" data-target="#navBar">
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
		'43.4.cover_with_price_text_button_bgimg' =>
			array (
				'CODE' => '43.4.cover_with_price_text_button_bgimg',
				'SORT' => '500',
				'CONTENT' => '<section class="landing-block g-bg-black">
	<div class="js-carousel g-overflow-hidden g-max-height-100vh" data-autoplay="true" data-infinite="true" data-fade="true" data-speed="5000" data-pagi-classes="u-carousel-indicators-v1 g-absolute-centered--x g-bottom-30">
		

		

		

		

		

		

		

		

		

		
	<div class="js-slide landing-block-node-card-bgimg landing-block-node-card g-bg-img-hero u-bg-overlay g-min-height-600 g-bg-black-opacity-0_4--after" style="background-image: url(\'https://cdn.bitrix24.ru/b1479079/landing/bcc/bcc5e00181ca124372c2a79e0f58146f/crm.jpg\');" data-fileid="5290" data-filehash="56853e1f1e8351d1d560a21625836590">
			<div class="u-bg-overlay__inner g-flex-centered g-height-100vh">
				<div class="container">
					<div class="landing-block-node-card-price u-ribbon-v1 text-uppercase g-pos-rel g-line-height-1_2 g-font-weight-700 g-font-size-16 g-font-size-18 g-color-white g-theme-travel-bg-black-v1 g-pa-10 g-mb-10">помогает продавать больше<br /></div>
					
					<h3 class="landing-block-node-card-title text-uppercase g-pos-rel g-line-height-1 g-font-weight-700 g-color-white g-mb-10 g-font-montserrat g-font-size-60">битрикс<span style="color: rgb(3, 169, 244);">24</span><span style="color: rgb(245, 245, 245);">.CRM</span></h3>

					<div class="g-pos-rel g-line-height-1_2 g-max-width-550">
						<div class="landing-block-node-card-text g-mb-20 g-font-size-18 g-color-white-opacity-0_8"><p>Возьмите все коммуникации с клиентами под контроль</p></div>
						<div class="landing-block-node-card-button-container">
							<a class="landing-block-node-card-button btn btn-md text-uppercase u-btn-primary g-font-weight-700 g-font-size-12 g-py-10 g-px-25 g-rounded-20" href="https://www.bitrix24.ru/features/?p=#partner_id#" target="_self">подробнее</a>
						</div>
					</div>
				</div>
			</div>
		</div><div class="js-slide landing-block-node-card-bgimg landing-block-node-card g-bg-img-hero u-bg-overlay g-min-height-600 g-bg-black-opacity-0_4--after" style="background-image: url(\'https://cdn.bitrix24.ru/b1479079/landing/aa2/aa214ffc8cfa81e01621511185960e3d/tasks.jpg\');" data-fileid="5292" data-filehash="d1811308789e697cf16abf52b786577e">
			<div class="u-bg-overlay__inner g-flex-centered g-height-100vh">
				<div class="container">
					<div class="landing-block-node-card-price u-ribbon-v1 text-uppercase g-pos-rel g-line-height-1_2 g-font-weight-700 g-font-size-16 g-font-size-18 g-color-white g-theme-travel-bg-black-v1 g-pa-10 g-mb-10">Помогают работать вместе и успевать вовремя<br /></div>
					
					<h3 class="landing-block-node-card-title text-uppercase g-pos-rel g-line-height-1 g-font-weight-700 g-color-white g-mb-10 g-font-montserrat g-font-size-60">битрикс<span style="color: rgb(3, 169, 244);">24</span><span style="color: rgb(245, 245, 245);">.Задачи и проекты</span></h3>

					<div class="g-pos-rel g-line-height-1_2 g-max-width-550">
						<div class="landing-block-node-card-text g-mb-20 g-font-size-18 g-color-white-opacity-0_8"><p>Управление задачами и проектами, Канбан, делегирование, чек-листы, шаблоны </p></div>
						<div class="landing-block-node-card-button-container">
							<a class="landing-block-node-card-button btn btn-md text-uppercase u-btn-primary g-font-weight-700 g-font-size-12 g-py-10 g-px-25 g-rounded-20" href="https://www.bitrix24.ru/features/tasks.php?p=#partner_id#" target="_self">подробнее</a>
						</div>
					</div>
				</div>
			</div>
		</div><div class="js-slide landing-block-node-card-bgimg landing-block-node-card g-bg-img-hero u-bg-overlay g-min-height-600 g-bg-black-opacity-0_4--after" style="background-image: url(\'https://cdn.bitrix24.ru/b1479079/landing/f08/f08f15c846339599e39b11a6548d9e61/sites.jpg\');" data-fileid="5294" data-filehash="9c63c552345f7ffc15d95de365e4e317">
			<div class="u-bg-overlay__inner g-flex-centered g-height-100vh">
				<div class="container">
					<div class="landing-block-node-card-price u-ribbon-v1 text-uppercase g-pos-rel g-line-height-1_2 g-font-weight-700 g-font-size-16 g-font-size-18 g-color-white g-theme-travel-bg-black-v1 g-pa-10 g-mb-10">помогают продавать<br /></div>
					
					<h3 class="landing-block-node-card-title text-uppercase g-pos-rel g-line-height-1 g-font-weight-700 g-color-white g-mb-10 g-font-montserrat g-font-size-60">битрикс<span style="color: rgb(3, 169, 244);">24</span><span style="color: rgb(245, 245, 245);">.САЙТЫ</span></h3>

					<div class="g-pos-rel g-line-height-1_2 g-max-width-550">
						<div class="landing-block-node-card-text g-mb-20 g-font-size-18 g-color-white-opacity-0_8"><p>Создавайте сайты и лендинги в CRM, сразу с онлайн-чатом, обратным звонком и формой обратной связи</p></div>
						<div class="landing-block-node-card-button-container">
							<a class="landing-block-node-card-button btn btn-md text-uppercase u-btn-primary g-font-weight-700 g-font-size-12 g-py-10 g-px-25 g-rounded-20" href="https://www.bitrix24.ru/features/sites.php?p=#partner_id#" target="_self">подробнее</a>
						</div>
					</div>
				</div>
			</div>
		</div><div class="js-slide landing-block-node-card-bgimg landing-block-node-card g-bg-img-hero u-bg-overlay g-min-height-600 g-bg-black-opacity-0_4--after" style="background-image: url(\'https://cdn.bitrix24.ru/b1479079/landing/5d5/5d5c83066ea04192506ede4f625bf598/olines.jpg\');" data-fileid="5296" data-filehash="da05172d4211b708b723d7ce262b50e0">
			<div class="u-bg-overlay__inner g-flex-centered g-height-100vh">
				<div class="container">
					<div class="landing-block-node-card-price u-ribbon-v1 text-uppercase g-pos-rel g-line-height-1_2 g-font-weight-700 g-font-size-16 g-font-size-18 g-color-white g-theme-travel-bg-black-v1 g-pa-10 g-mb-10">помогают любить клиентов :)<br /></div>
					
					<h3 class="landing-block-node-card-title text-uppercase g-pos-rel g-line-height-1 g-font-weight-700 g-color-white g-mb-10 g-font-montserrat g-font-size-60">битрикс<span style="color: rgb(3, 169, 244);">24</span><span style="color: rgb(245, 245, 245);">.открытые линии</span></h3>

					<div class="g-pos-rel g-line-height-1_2 g-max-width-550">
						<div class="landing-block-node-card-text g-mb-20 g-font-size-18 g-color-white-opacity-0_8"><p>Подключите соцсети и мессенджеры и общайтесь с клиентами в Битрикс24 </p></div>
						<div class="landing-block-node-card-button-container">
							<a class="landing-block-node-card-button btn btn-md text-uppercase u-btn-primary g-font-weight-700 g-font-size-12 g-py-10 g-px-25 g-rounded-20" href="https://www.bitrix24.ru/features/ol.php?p=#partner_id#" target="_self">подробнее</a>
						</div>
					</div>
				</div>
			</div>
		</div><div class="js-slide landing-block-node-card-bgimg landing-block-node-card g-bg-img-hero u-bg-overlay g-min-height-600 g-bg-black-opacity-0_4--after" style="background-image: url(\'https://cdn.bitrix24.ru/b1479079/landing/a00/a008f81478fe28497216039f7dafad83/company.jpg\');" data-fileid="5298" data-filehash="af1baa0b3dd8733e61bd675a1817c947">
			<div class="u-bg-overlay__inner g-flex-centered g-height-100vh">
				<div class="container">
					<div class="landing-block-node-card-price u-ribbon-v1 text-uppercase g-pos-rel g-line-height-1_2 g-font-weight-700 g-font-size-16 g-font-size-18 g-color-white g-theme-travel-bg-black-v1 g-pa-10 g-mb-10">помогает работать вместе<br /></div>
					
					<h3 class="landing-block-node-card-title text-uppercase g-pos-rel g-line-height-1 g-font-weight-700 g-color-white g-mb-10 g-font-montserrat g-font-size-60">битрикс<span style="color: rgb(3, 169, 244);">24</span><span style="color: rgb(245, 245, 245);">.компания</span></h3>

					<div class="g-pos-rel g-line-height-1_2 g-max-width-550">
						<div class="landing-block-node-card-text g-mb-20 g-font-size-18 g-color-white-opacity-0_8"><p>Живая Лента, Чат, Диск, Календарь и многое другое</p></div>
						<div class="landing-block-node-card-button-container">
							<a class="landing-block-node-card-button btn btn-md text-uppercase u-btn-primary g-font-weight-700 g-font-size-12 g-py-10 g-px-25 g-rounded-20" href="https://www.bitrix24.ru/features/company.php?p=#partner_id#" target="_self">подробнее</a>
						</div>
					</div>
				</div>
			</div>
		</div></div>
</section>',
			),
		'25.one_col_fix_texts_blocks_slider' =>
			array (
				'CODE' => '25.one_col_fix_texts_blocks_slider',
				'SORT' => '1000',
				'CONTENT' => '<section class="landing-block">

        <div class="landing-block-node_bgimage u-bg-overlay g-bg-img-hero g-py-60 g-bg-primary-opacity-0_9--after" style="background-image: url(https://cdn.bitrix24.site/bitrix/images/landing/business/1920x1280/img2.jpg);">
            <div class="container u-bg-overlay__inner">

                <div class="js-carousel" data-infinite="true" data-arrows-classes="u-arrow-v1 g-pos-abs g-absolute-centered--y--md g-top-0 g-top-50x--md g-width-50 g-height-50 g-font-size-default g-color-primary g-bg-gray-dark-v1 g-opacity-0_8--hover g-transition-0_2 g-transition--ease-in" data-arrow-left-classes="fa fa-arrow-left g-left-0 g-ml-30--md" data-arrow-right-classes="fa fa-arrow-right g-right-0 g-mr-30--md">
                    <div class="landing-block-card-slider-element js-slide">
                        <div class="container text-center g-max-width-700">
                            <h2 class="landing-block-node-element-title text-uppercase g-font-weight-700 g-font-size-26 g-color-white g-mb-40">Акция!</h2>
                            <div class="landing-block-node-element-text g-color-white-opacity-0_8"><p>При покупке тарифа у нас - булочка с изюмом в подарок!</p></div>
                            <div class="landing-block-node-button-container">
                            	<a class="landing-block-node-element-button btn btn-lg u-btn-inset g-rounded-20" href="#" target="_self">Узнать подробнее</a>
                        	</div>
                        </div>
                    </div>

                    <div class="landing-block-card-slider-element js-slide">
                        <div class="container text-center g-max-width-700">
                            <h2 class="landing-block-node-element-title text-uppercase g-font-weight-700 g-font-size-26 g-color-white g-mb-40">&quot;Как работать в Битрикс24&quot;</h2>
                            <div class="landing-block-node-element-text g-color-white-opacity-0_8"><p>Бесплатный вебинар для тех, кто начинает работу с сервисом</p></div>
                            <div class="landing-block-node-button-container">
                            	<a class="landing-block-node-element-button btn btn-lg u-btn-inset g-rounded-20" href="#" target="_self">Зарегистрироваться</a>
                        	</div>
                        </div>
                    </div><div class="landing-block-card-slider-element js-slide">
                        <div class="container text-center g-max-width-700">
                            <h2 class="landing-block-node-element-title text-uppercase g-font-weight-700 g-font-size-26 g-color-white g-mb-40">Акция!</h2>
                            <div class="landing-block-node-element-text g-color-white-opacity-0_8"><p>Покупаете внедрение тарифа &quot;Команда&quot;? Получите скидку на услуги 30% на первые три месяца!</p></div>
                            <div class="landing-block-node-button-container">
                            	<a class="landing-block-node-element-button btn btn-lg u-btn-inset g-rounded-20" href="#" target="_self">Узнать подробнее</a>
                        	</div>
                        </div>
                    </div>

                    
                </div>

            </div>
        </div>

    </section>',
			),
		'04.1.one_col_fix_with_title' =>
			array (
				'CODE' => '04.1.one_col_fix_with_title',
				'SORT' => '1500',
				'CONTENT' => '<section class="landing-block g-pb-0 g-bg-gray-light-v4 g-pb-2 g-pt-2">
        <div class="container">
            <div class="landing-block-node-inner text-uppercase text-center u-heading-v2-4--bottom g-brd-primary">
                <h4 class="landing-block-node-subtitle h6 g-font-weight-800 g-letter-spacing-1 g-mb-20 g-color-black g-font-size-14"> </h4>
                <h2 class="landing-block-node-title h1 u-heading-v2__title g-line-height-1_3 g-font-weight-600 g-font-size-40 g-mb-minus-10 g-color-primary"><span style="color: rgb(33, 33, 33);">что такое битрикс</span>24<span style="color: rgb(33, 33, 33);">?</span></h2>
            </div>
        </div>
    </section>',
			),
		'06.2.features_4_cols' =>
			array (
				'CODE' => '06.2.features_4_cols',
				'SORT' => '2000',
				'CONTENT' => '<section class="landing-block g-pt-80 g-pb-80">
        <div class="container">

            <div class="row no-gutters">
                <div class="landing-block-node-element landing-block-card col-md-6 col-lg-3 g-parent g-brd-around g-brd-gray-light-v4 g-brd-bottom-primary--hover g-brd-bottom-2--hover g-mb-30 g-mb-0--lg g-transition-0_2 g-transition--ease-in">
                    <div class="text-center g-px-10 g-px-30--lg g-py-40 g-pt-25--parent-hover g-transition-0_2 g-transition--ease-in">
					<span class="landing-block-node-element-icon-container d-block g-color-primary g-font-size-40 g-mb-15">
					  <i class="landing-block-node-element-icon icon-fire"></i>
					</span>
                        <h3 class="landing-block-node-element-title h5 text-uppercase g-color-black g-mb-10">Битрикс24.CRM</h3>
                        <div class="landing-block-node-element-text g-color-gray-dark-v4"><p>помогает продавать больше</p></div>

                        <div class="landing-block-node-separator d-inline-block g-width-40 g-brd-bottom g-brd-2 g-brd-primary g-my-15"></div>

                        <ul class="landing-block-node-element-list list-unstyled text-uppercase g-mb-0"><li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">подключите к CRM ваши каналы коммуникации с клиентами</li>
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">CRM упрощает работу каждому сотруднику</li>
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">Включите роботов и автоматизируйте продажи</li>
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">Сегментируйте клиентов и напоминайте о себе</li></ul>
                    </div>
                </div>

                <div class="landing-block-node-element landing-block-card col-md-6 col-lg-3 g-parent g-brd-around g-brd-gray-light-v4 g-brd-bottom-primary--hover g-brd-bottom-2--hover g-mb-30 g-mb-0--md g-ml-minus-1 g-transition-0_2 g-transition--ease-in">
                    <div class="text-center g-px-10 g-px-30--lg g-py-40 g-pt-25--parent-hover g-transition-0_2 g-transition--ease-in">
					<span class="landing-block-node-element-icon-container d-block g-color-primary g-font-size-40 g-mb-15">
					  <i class="landing-block-node-element-icon icon-energy"></i>
					</span>
                        <h3 class="landing-block-node-element-title h5 text-uppercase g-color-black g-mb-10">Битрикс24.открытые линии</h3>
                        <div class="landing-block-node-element-text g-color-gray-dark-v4"><p>помогают любить клиентов :)</p></div>

                        <div class="landing-block-node-separator d-inline-block g-width-40 g-brd-bottom g-brd-2 g-brd-primary g-my-15"></div>

                        <ul class="landing-block-node-element-list list-unstyled text-uppercase g-mb-0"><li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">Подключите к Битрикс24 ваши группы в соцсетях и мессенджеры</li>
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">поставьте на сайт бесплатный онлайн-чат и обратный звонок</li>
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">все сообщения придут к вам в Битрикс24 и сохранятся в CRM</li></ul>
                    </div>
                </div>

                <div class="landing-block-node-element landing-block-card col-md-6 col-lg-3 g-parent g-brd-around g-brd-gray-light-v4 g-brd-bottom-primary--hover g-brd-bottom-2--hover g-mb-30 g-mb-0--md g-ml-minus-1 g-transition-0_2 g-transition--ease-in">
                    <div class="text-center g-px-10 g-px-30--lg g-py-40 g-pt-25--parent-hover g-transition-0_2 g-transition--ease-in">
					<span class="landing-block-node-element-icon-container d-block g-color-primary g-font-size-40 g-mb-15">
					  <i class="landing-block-node-element-icon icon-layers"></i>
					</span>
                        <h3 class="landing-block-node-element-title h5 text-uppercase g-color-black g-mb-10">Битрикс24.Задачи и проекты</h3>
                        <div class="landing-block-node-element-text g-color-gray-dark-v4"><p>помогают работать вместе и успевать вовремя</p></div>

                        <div class="landing-block-node-separator d-inline-block g-width-40 g-brd-bottom g-brd-2 g-brd-primary g-my-15"></div>

                        <ul class="landing-block-node-element-list list-unstyled text-uppercase g-mb-0"><li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">Битрикс24 поможет завершить задачу и проект точно в срок</li>
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">Просто поставьте задачу. Себе, коллегам, подрядчикам</li>
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">поддерживает все варианты планирования: от agile до «водопада» с зависимостями.</li></ul>
                    </div>
                </div>

                <div class="landing-block-node-element landing-block-card col-md-6 col-lg-3 g-parent g-brd-around g-brd-gray-light-v4 g-brd-bottom-primary--hover g-brd-bottom-2--hover g-mb-30 g-mb-0--md g-ml-minus-1 g-transition-0_2 g-transition--ease-in">
                    <div class="text-center g-px-10 g-px-30--lg g-py-40 g-pt-25--parent-hover g-transition-0_2 g-transition--ease-in">
					<span class="landing-block-node-element-icon-container d-block g-color-primary g-font-size-40 g-mb-15">
					  <i class="landing-block-node-element-icon icon-social-youtube"></i>
					</span>
                        <h3 class="landing-block-node-element-title h5 text-uppercase g-color-black g-mb-10">Битрикс24.Сайты</h3>
                        <div class="landing-block-node-element-text g-color-gray-dark-v4"><p>помогают продавать</p></div>

                        <div class="landing-block-node-separator d-inline-block g-width-40 g-brd-bottom g-brd-2 g-brd-primary g-my-15"></div>

                        <ul class="landing-block-node-element-list list-unstyled text-uppercase g-mb-0"><li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">Создавайте сайты и лендинги в вашем Битрикс24 в удобном конструкторе</li>
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">Сайт не нужно специально интегрировать с CRM, он уже создан внутри CRM</li>
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">Все контакты клиентов, которые напишут вам с сайта или позвонят, сразу заносятся в CRM и попадают в работу менеджерам</li></ul>
                    </div>
                </div>
            <div class="landing-block-node-element landing-block-card col-md-6 col-lg-3 g-parent g-brd-around g-brd-gray-light-v4 g-brd-bottom-primary--hover g-brd-bottom-2--hover g-mb-30 g-mb-0--md g-ml-minus-1 g-transition-0_2 g-transition--ease-in">
                    <div class="text-center g-px-10 g-px-30--lg g-py-40 g-pt-25--parent-hover g-transition-0_2 g-transition--ease-in">
					<span class="landing-block-node-element-icon-container d-block g-color-primary g-font-size-40 g-mb-15">
					  <i class="landing-block-node-element-icon icon-social-youtube"></i>
					</span>
                        <h3 class="landing-block-node-element-title h5 text-uppercase g-color-black g-mb-10">Битрикс24.Компания</h3>
                        <div class="landing-block-node-element-text g-color-gray-dark-v4"><p>помогает контролировать все процессы</p></div>

                        <div class="landing-block-node-separator d-inline-block g-width-40 g-brd-bottom g-brd-2 g-brd-primary g-my-15"></div>

                        <ul class="landing-block-node-element-list list-unstyled text-uppercase g-mb-0"><li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">Все для организации работы компании в цифровой среде: чат, видеозвонки, календарь, диск</li>
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">Создайте единое информационное пространство для работы вашей компании</li>
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">Фиксируйте начало и конец рабочего дня и учитывайте отработанное время.</li><li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10">Получайте рабочие отчеты вовремя.</li></ul>
                    </div>
                </div></div>
        </div>
    </section>
    <style type="text/css">
    	/* Partner landing*/
		.landing-block-node-element.landing-block-card.col-lg-3 {
		   -webkit-flex: 0 0 20%;
		   -ms-flex: 0 0 20%;
		   flex: 0 0 20%;
		   max-width: 20%;
		}
		@media (max-width: 768px) {
		   .landing-block-node-element.landing-block-card.col-lg-3 {
			  -webkit-flex: 0 0 100%;
			  -ms-flex: 0 0 100%;
			  flex: 0 0 100%;
			  max-width: 100%;
		   }
		}
		.landing-block .landing-block-card .g-pt-25--parent-hover .landing-block-node-element-title.h5 {
			font-size: 1.10rem;
			text-transform: none !important;
		}
		.landing-block .landing-block-card .g-pt-25--parent-hover .list-unstyled.text-uppercase{
			text-transform: none !important;
		}
	</style>',
			),
		'13.2.one_col_fix_button' =>
			array (
				'CODE' => '13.2.one_col_fix_button',
				'SORT' => '2500',
				'CONTENT' => '<section class="landing-block text-center g-pt-20 g-pb-20">
        <div class="container">
				<a class="landing-block-node-button btn btn-md text-uppercase u-btn-primary g-px-15 g-font-weight-700 g-rounded-20 g-font-size-14" href="#" target="_self">Подробнее</a>
        </div>
    </section>',
			),
		'04.1.one_col_fix_with_title_@_GjiahlPL7r' =>
			array (
				'CODE' => '04.1.one_col_fix_with_title',
				'SORT' => '3000',
				'CONTENT' => '<section class="landing-block g-pt-20 g-pb-20">
        <div class="container">
            <div class="landing-block-node-inner text-uppercase text-center u-heading-v2-4--bottom g-brd-primary">
                <h4 class="landing-block-node-subtitle h6 g-font-weight-800 g-font-size-12 g-letter-spacing-1 g-color-primary g-mb-20"> </h4>
                <h2 class="landing-block-node-title h1 u-heading-v2__title g-line-height-1_3 g-font-weight-600 g-font-size-40 g-mb-minus-10">коммерческие тарифы битрикс<span style="color: rgb(100, 181, 246);">24</span></h2>
            </div>
        </div>
    </section>',
			),
		'11.three_cols_fix_tariffs' =>
			array (
				'CODE' => '11.three_cols_fix_tariffs',
				'SORT' => '3500',
				'CONTENT' => '<section class="landing-block g-pt-30 g-pb-20">
        <div class="container">

            <div class="row no-gutters">

                <div class="landing-block-card js-animation fadeInUp col-md-4 g-mb-30 g-mb-0--md landing-card col-lg-3">
                    <article class="text-center g-brd-around g-color-gray g-brd-gray-light-v5 g-pa-10">
                        <div class="landing-block-card-container g-bg-gray-light-v5 g-pa-30">
                            <h4 class="landing-block-node-title text-uppercase h5 g-color-gray-dark-v3 g-font-weight-500 g-mb-10">проект+</h4>
                            <div class="landing-block-node-subtitle g-font-style-normal"> </div>

                            <hr class="g-brd-gray-light-v3 g-my-10" />

                            <div class="g-color-primary g-my-20">
								<div class="landing-block-node-price g-line-height-1_2 g-font-size-28"><span style="font-weight: bold;">1 190 руб.</span></div>
                                <div class="landing-block-node-price-text">в месяц</div>
                            </div>

                            <hr class="g-brd-gray-light-v3 g-mt-10 mb-0" />

                            <ul class="landing-block-node-price-list list-unstyled g-mb-25"><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12"><b>12</b><span style="font-size: 1rem;"> бизнес-пользователей</span><br /></li>
                                <li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12"><b>24</b> Гб </li>
                                <li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">Роботы в лидах</li>
                                <li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12"><span style="font-weight: bold;">1</span> направление сделок</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">Без Плана Продаж</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">Без Бизнес-процессов в CRM</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">Без регулярных сделок и счетов</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">Без интеграции с 1С</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">Без IVR</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">Face-трекер (платно)</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">Без Face-карт в 1С</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12"><span style="font-weight: bold;">15 000</span> писем в месяц</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12"><span style="font-weight: bold;">2</span> Открытых линии</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12"><span style="font-weight: bold;">5</span> сайтов</li></ul>
                            <div class="landing-block-node-price-container">
                            <a class="landing-block-node-price-button btn btn-md text-uppercase u-btn-primary g-px-15 g-rounded-20" href="https://www.bitrix24.ru/prices/order.php?product=TF&amp;p=#partner_id#" target="_self">Купить</a>
                        	</div>
                        </div>
                    </article>
                </div>

                <div class="landing-block-card js-animation fadeInUp col-md-4 g-mb-30 g-mb-0--md landing-card col-lg-3">
                    <article class="text-center g-brd-around g-color-gray g-brd-gray-light-v5 g-pa-10 g-mt-minus-20">
                        <div class="landing-block-card-container g-bg-gray-light-v5 g-py-50 g-px-30">
                            <h4 class="landing-block-node-title text-uppercase h5 g-color-gray-dark-v3 g-font-weight-500 g-mb-10">CRM+</h4>
                            <div class="landing-block-node-subtitle g-font-style-normal"> </div>

                            <hr class="g-brd-gray-light-v3 g-my-10" />

                            <div class="g-color-primary g-my-20">
								<div class="landing-block-node-price g-line-height-1_2 g-font-size-28"><span style="font-weight: bold;">2 990 руб.</span></div>
                                <div class="landing-block-node-price-text">в месяц</div>
                            </div>

                            <hr class="g-brd-gray-light-v3 g-mt-10 mb-0" />

                            <ul class="landing-block-node-price-list list-unstyled g-mb-25"><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12"><span style="font-weight: bold;">6</span> бизнес-пользователей</li>
                                <li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12"><span style="font-weight: bold;">50 </span>Гб</li>
                                <li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">Роботы в лидах и сделках
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">+ Направления сделок без ограничений
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">+ План продаж
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">+ Бизнес-процессы в CRM
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">+ Регулярные счета и сделки
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">+ Интеграция с 1С
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">+ <span style="font-weight: bold;">IVR</span> 2 уровня
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">Face-трекер (платно)
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">+ Face-карт в 1С (бесплатно)
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12"><span style="font-weight: bold;">35 000</span> писем в месяц
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">+ Открытые линии без ограничений
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12"><span style="font-weight: bold;">10</span> сайтов</li></ul>
                            <div class="landing-block-node-price-container">
                            <a class="landing-block-node-price-button btn btn-md text-uppercase u-btn-primary g-px-15 g-rounded-20" href="https://www.bitrix24.ru/prices/order.php?product=CRM&amp;p=#partner_id#" target="_self">Купить</a>
                        	</div>
                        </div>
                    </article>
                </div>

                <div class="landing-block-card js-animation fadeInUp col-md-4 g-mb-30 g-mb-0--md landing-card col-lg-3">
                    <article class="text-center g-brd-around g-color-gray g-brd-gray-light-v5 g-pa-10 g-mt-minus-20">
                        <div class="landing-block-card-container g-bg-gray-light-v5 g-py-50 g-px-30">
                            <h4 class="landing-block-node-title text-uppercase h5 g-color-gray-dark-v3 g-font-weight-500 g-mb-10">команда</h4>
                            <div class="landing-block-node-subtitle g-font-style-normal"> </div>

                            <hr class="g-brd-gray-light-v3 g-my-10" />

                            <div class="g-color-primary g-my-20">
								<div class="landing-block-node-price g-line-height-1_2 g-font-size-28"><span style="font-weight: bold;">5 990 руб.</span></div>
                                <div class="landing-block-node-price-text">в месяц</div>
                            </div>

                            <hr class="g-brd-gray-light-v3 g-mt-10 mb-0" />

                            <ul class="landing-block-node-price-list list-unstyled g-mb-25"><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">+ Бизнес-пользователи без ограничений
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12"><span style="font-weight: bold;">100</span> Гб
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">Роботы в лидах и сделках
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12"><span style="font-weight: bold;">10</span> направлений сделок </li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">План продаж
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">Бизнес-процессы в CRM
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">Регулярные счета и сделки
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">Интеграция с 1С
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12"><span style="font-weight: bold;">IVR</span> 2 уровня
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">Face-трекер (платно)
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">Face-карт в 1С (платно)
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12"><span style="font-weight: bold;">50 000</span> писем в месяц
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">Открытые линии без ограничений
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12"><span style="font-weight: bold;">10</span> сайтов<br /></li></ul>
                            <div class="landing-block-node-price-container">
                            <a class="landing-block-node-price-button btn btn-md text-uppercase u-btn-primary g-px-15 g-rounded-20" href="https://www.bitrix24.ru/prices/order.php?product=TEAM&amp;p=#partner_id#" target="_self">Купить</a>
                        	</div>
                        </div>
                    </article>
                </div><div class="landing-block-card js-animation fadeInUp col-md-4 g-mb-30 g-mb-0--md landing-card col-lg-3">
                    <article class="text-center g-brd-around g-color-gray g-brd-gray-light-v5 g-pa-10">
                        <div class="landing-block-card-container g-bg-gray-light-v5 g-pa-30">
                            <h4 class="landing-block-node-title text-uppercase h5 g-color-gray-dark-v3 g-font-weight-500 g-mb-10">компания</h4>
                            <div class="landing-block-node-subtitle g-font-style-normal"> </div>

                            <hr class="g-brd-gray-light-v3 g-my-10" />

                            <div class="g-color-primary g-my-20">
								<div class="landing-block-node-price g-line-height-1_2 g-font-size-28"><span style="font-weight: bold;">11 990 руб.</span></div>
                                <div class="landing-block-node-price-text">в месяц</div>
                            </div>

                            <hr class="g-brd-gray-light-v3 g-mt-10 mb-0" />

                            <ul class="landing-block-node-price-list list-unstyled g-mb-25"><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">Бизнес-пользователи без ограничений
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">+ Место без ограничений
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">Роботы в лидах и сделках
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">Направления бизнеса без ограничений
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">План продаж
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">Бизнес-процессы в CRM
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">Регулярные счета и сделки
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">Интеграция с 1С
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">+ <span style="font-weight: bold;">IVR</span> без ограничений
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">Face-трекер (платно)
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">Face-карт для 1С (платно)
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12"><span style="font-weight: bold;">1 000 000</span> писем в месяц
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">Открытые линии без ограничений
</li><li class="landing-block-node-price-list-item g-brd-bottom g-brd-gray-light-v3 g-py-12">+ Сайты без ограничений</li></ul>

                            <div class="landing-block-node-price-container">
                            <a class="landing-block-node-price-button btn btn-md text-uppercase u-btn-primary g-px-15 g-rounded-20" href="https://www.bitrix24.ru/prices/order.php?product=COMPANY&amp;p=#partner_id#" target="_self">Купить</a>
                        	</div>
                        </div>
                    </article>
                </div>

            </div>
        </div>
    </section>',
			),
		'13.1.one_col_fix_text_and_button' =>
			array (
				'CODE' => '13.1.one_col_fix_text_and_button',
				'SORT' => '4000',
				'CONTENT' => '<section class="landing-block text-center g-pt-20 g-pb-20">
	<div class="container g-max-width-800">

		<div class="landing-block-node-text"><p>Прямо сейчас вы можете испытать бесплатный Битрикс24 на 12 человек</p></div>
		<div class="landing-block-node-button-container">
			<a class="landing-block-node-button btn btn-md text-uppercase u-btn-primary g-px-15 g-font-weight-700 g-rounded-20" href="#" target="_self">хочу попробовать!</a>
		</div>
	</div>
</section>',
			),
		'04.1.one_col_fix_with_title_@_3ndB2T6qkG' =>
			array (
				'CODE' => '04.1.one_col_fix_with_title',
				'SORT' => '4500',
				'CONTENT' => '<section class="landing-block g-pt-20 g-pb-20">
        <div class="container">
            <div class="landing-block-node-inner text-uppercase text-center u-heading-v2-4--bottom g-brd-primary">
                <h4 class="landing-block-node-subtitle h6 g-font-weight-800 g-font-size-12 g-letter-spacing-1 g-color-primary g-mb-20"> </h4>
                <h2 class="landing-block-node-title h1 u-heading-v2__title g-line-height-1_3 g-font-weight-600 g-font-size-40 g-mb-minus-10">пакеты партнера</h2>
            </div>
        </div>
    </section>',
			),
		'37.3.two_cols_blocks_carousel' =>
			array (
				'CODE' => '37.3.two_cols_blocks_carousel',
				'SORT' => '5000',
				'CONTENT' => '<section class="landing-block g-pt-40 g-pb-40">
	<div class="container">
		<!-- Carousel -->
		<div id="carouselCharity01" class="js-carousel g-pb-85 g-mx-minus-15" data-slides-show="2" data-arrows-classes="u-arrow-v1 g-pos-abs g-absolute-centered--x--md g-bottom-0 g-width-45 g-height-45 g-color-white g-color-black--hover g-bg-gray-light-v3 g-bg-primary--hover g-transition-0_2 g-transition--ease-in" data-arrow-left-classes="fa fa-chevron-left g-left-15 g-left-50x--md g-ml-minus-40--md" data-arrow-right-classes="fa fa-chevron-right g-right-15 g-left-50x--md g-ml-40--md">
			

			

			

			<div class="landing-block-node-card js-slide g-px-15">
				<!-- Article -->
				<article class="landing-block-node-card-bgimg clearfix g-bg-size-cover g-pos-rel" style="background-image: url(\'https://cdn.bitrix24.ru/b1479079/landing/187/18700108ef6c4bc31ec82ad54bf5a58f/Zadachi+_1_.png\');" data-fileid="5306" data-filehash="a207b14bcd0291c5b09a62e3ae428303">
					<!-- Article Content -->
					<div class="landing-block-node-card-text-bg float-right g-color-gray-light-v1 g-bg-black-opacity-0_7 g-width-50x--sm g-pa-30">
						<h4 class="landing-block-node-card-title text-uppercase g-font-weight-700 h6 g-color-white g-mb-15">Внедрение тарифа <br />&quot;Проект+&quot;</h4>
						<div class="landing-block-node-card-text g-mb-45"><p>Вы получаете:<br />- внедрение Битрикс24<br />- бесплатное обслуживание в течение 1 месяца</p></div>

						<div class="clearfix text-uppercase g-color-white g-font-size-11 g-mb-35">
							<div class="float-right landing-block-node-card-label-right"><br /></div>
							<div class="landing-block-node-card-label-left">стоимость: <span style="font-weight: bold; color:#f5f219 !important">2990 руб./мес</span></div>
						</div>

						<a class="#system_catalogbtn landing-block-node-card-button g-valign-middle btn-block text-uppercase u-btn-primary g-font-weight-700 g-font-size-11 g-py-10 g-py-20--md g-px-15 g-px-25--md g-rounded-20 g-color-white" href="#" target="_self">Подробнее</a>
					</div>
					<!-- End Article Content -->
				</article>
				<!-- End Article -->
			</div>
		<div class="landing-block-node-card js-slide g-px-15">
				<!-- Article -->
				<article class="landing-block-node-card-bgimg clearfix g-bg-size-cover g-pos-rel" style="background-image: url(\'https://cdn.bitrix24.ru/b1479079/landing/80f/80f7635f7a7525803fddec7fc0c0e949/CRM+_4_+_1_.png\');" data-fileid="5302" data-filehash="dd85f0520eeef02b7623a4482c3babc9">
					<!-- Article Content -->
					<div class="landing-block-node-card-text-bg float-right g-color-gray-light-v1 g-bg-black-opacity-0_7 g-width-50x--sm g-pa-30">
						<h4 class="landing-block-node-card-title text-uppercase g-font-weight-700 h6 g-color-white g-mb-15">Внедрение тарифа <br />&quot;CRM +&quot;</h4>
						<div class="landing-block-node-card-text g-mb-45"><p>Вы получаете:<br />- внедрение Битрикс24.CRM<br />- бесплатное обслуживание в течение 1 месяца</p></div>

						<div class="clearfix text-uppercase g-color-white g-font-size-11 g-mb-35">
							<div class="float-right landing-block-node-card-label-right"><br /></div>
							<div class="landing-block-node-card-label-left">стоимость: <span style="color: rgb(245, 242, 25); font-weight: bold;">3990 руб./мес.</span></div>
						</div>

						<a class="#system_catalogbtn landing-block-node-card-button g-valign-middle btn-block text-uppercase u-btn-primary g-font-weight-700 g-font-size-11 g-py-10 g-py-20--md g-px-15 g-px-25--md g-rounded-20 g-color-white" href="#" target="_self">Подробнее</a>
					</div>
					<!-- End Article Content -->
				</article>
				<!-- End Article -->
			</div><div class="landing-block-node-card js-slide g-px-15">
				<!-- Article -->
				<article class="landing-block-node-card-bgimg clearfix g-bg-size-cover g-pos-rel" style="background-image: url(\'https://cdn.bitrix24.ru/b1479079/landing/66a/66a1e952973326664112a099733f46d3/Kompaniya+_2_.png\');" data-fileid="5304" data-filehash="33f8a759fa8877b28f5282ab0de427fd">
					<!-- Article Content -->
					<div class="landing-block-node-card-text-bg float-right g-color-gray-light-v1 g-bg-black-opacity-0_7 g-width-50x--sm g-pa-30">
						<h4 class="landing-block-node-card-title text-uppercase g-font-weight-700 h6 g-color-white g-mb-15">Внедрение тарифа <br />&quot;команда&quot;</h4>
						<div class="landing-block-node-card-text g-mb-45"><p>Вы получаете:
<br /><span style="font-size: 1rem;">- внедрение Битрикс24.CRM <br /></span><span style="font-size: 1rem;">- бесплатное обслуживание в течение 3 месяцев</span></p></div>

						<div class="clearfix text-uppercase g-color-white g-font-size-11 g-mb-35">
							<div class="float-right landing-block-node-card-label-right"><br /></div>
							<div class="landing-block-node-card-label-left">стоимость: <span style="font-weight: bold; color:#f5f219 !important">6490 руб./мес</span></div>
						</div>

						<a class="#system_catalogbtn landing-block-node-card-button g-valign-middle btn-block text-uppercase u-btn-primary g-font-weight-700 g-font-size-11 g-py-10 g-py-20--md g-px-15 g-px-25--md g-rounded-20 g-color-white" href="#" target="_self">Подробнее</a>
					</div>
					<!-- End Article Content -->
				</article>
				<!-- End Article -->
			</div></div>
		<!-- End Carousel -->
	</div>
</section>',
			),
		'04.1.one_col_fix_with_title_@_JinFBJ3Y9J' =>
			array (
				'CODE' => '04.1.one_col_fix_with_title',
				'SORT' => '5500',
				'CONTENT' => '<section class="landing-block g-pt-20 g-pb-20">
        <div class="container">
            <div class="landing-block-node-inner text-uppercase text-center u-heading-v2-4--bottom g-brd-primary">
                <h4 class="landing-block-node-subtitle h6 g-font-weight-800 g-font-size-12 g-letter-spacing-1 g-color-primary g-mb-20"> </h4>
                <h2 class="landing-block-node-title h1 u-heading-v2__title g-line-height-1_3 g-font-weight-600 g-font-size-40 g-mb-minus-10">наши преимущества</h2>
            </div>
        </div>
    </section>',
			),
		'44.1.four_columns_with_img_and_text' =>
			array (
				'CODE' => '44.1.four_columns_with_img_and_text',
				'SORT' => '6000',
				'CONTENT' => '<section class="landing-block">
	<div class="container-fluid px-0">
		<!-- Banners -->
		<div class="row no-gutters">
			<div class="landing-block-node-card col-md-6 col-lg-3">
				<!-- Article -->
				<article
 class="landing-block-node-card-inner h-100 text-center info-v3-3 g-parent g-bg-gray-light-v5 g-bg-cover g-bg-primary-opacity-0_6--after g-color-gray-dark-v3 g-color-white--hover g-py-30">
					<!-- Article Image -->
					<img class="landing-block-node-card-img info-v3-3__img" src="https://cdn.bitrix24.site/bitrix/images/landing/business/166x319/img1.png" alt="" />
					<!-- End Article Image -->

					<!-- Article Content -->
					<div class="info-v3-3__description g-pos-cover g-flex-middle">
						<div class="g-flex-middle-item g-pa-30">
							<h4 class="landing-block-node-card-title h3 text-uppercase g-line-height-1 g-font-weight-700
							g-mb-20 info-v3-3__title g-color-gray-dark-v2 g-color-white--parent-hover g-text-underline--none--hover g-transition-0_3">срочное<br />внедрение</h4>
							<div class="landing-block-node-card-text-unhover info-v3-3__category g-font-size-11 text-uppercase">Менее, чем <br />за один час</div>

							<div class="info-v3-3__content g-opacity-0_7">
								<div class="landing-block-node-card-text g-color-white--parent-hover mb-0">Ваше время - ваши деньги. Поэтому мы позаботимся о том, чтобы вы начали полноценную работу в Битрикс24 как можно скорее!</div>
							</div>
						</div>
					</div>
					<!-- End Article Content -->
				
				<!-- End Article -->
			</article
></div>

			<div class="landing-block-node-card col-md-6 col-lg-3">
				<!-- Article -->
				<article
 class="landing-block-node-card-inner h-100 text-center info-v3-3 g-parent g-bg-gray-light-v5 g-bg-cover g-bg-primary-opacity-0_6--after g-color-gray-dark-v3 g-color-white--hover g-py-30">
					<!-- Article Image -->
					<img class="landing-block-node-card-img info-v3-3__img" src="https://cdn.bitrix24.site/bitrix/images/landing/business/166x319/img2.png" alt="" />
					<!-- End Article Image -->

					<!-- Article Content -->
					<div class="info-v3-3__description g-pos-cover g-flex-middle">
						<div class="g-flex-middle-item g-pa-30">
							<h4 class="landing-block-node-card-title h3 text-uppercase g-line-height-1 g-font-weight-700
							g-mb-20 info-v3-3__title g-color-gray-dark-v2 g-color-white--parent-hover g-text-underline--none--hover g-transition-0_3">удобство<br />работы</h4>
							<div class="landing-block-node-card-text-unhover info-v3-3__category g-font-size-11 text-uppercase">всё для <br />вашего комфорта</div>

							<div class="info-v3-3__content g-opacity-0_7">
								<div class="landing-block-node-card-text g-color-white--parent-hover mb-0">Наш специалист назначит встречу и проведёт внедрение Битрикс24 в любое удобное для вас время! А ещё у нас есть несколько способов оплаты!</div>
							</div>
						</div>
					</div>
					<!-- End Article Content -->
				
				<!-- End Article -->
			</article
></div>

			<div class="landing-block-node-card col-md-6 col-lg-3">
				<!-- Article -->
				<article
 class="landing-block-node-card-inner h-100 text-center info-v3-3 g-parent g-bg-gray-light-v5 g-bg-cover g-bg-primary-opacity-0_6--after g-color-gray-dark-v3 g-color-white--hover g-py-30">
					<!-- Article Image -->
					<img class="landing-block-node-card-img info-v3-3__img" src="https://cdn.bitrix24.site/bitrix/images/landing/business/166x319/img3.png" alt="" />
					<!-- End Article Image -->

					<!-- Article Content -->
					<div class="info-v3-3__description g-pos-cover g-flex-middle">
						<div class="g-flex-middle-item g-pa-30">
							<h4 class="landing-block-node-card-title h3 text-uppercase g-line-height-1 g-font-weight-700
							g-mb-20 info-v3-3__title g-color-gray-dark-v2 g-color-white--parent-hover g-text-underline--none--hover g-transition-0_3">надежность</h4>
							<div class="landing-block-node-card-text-unhover info-v3-3__category g-font-size-11 text-uppercase">Консультанты <br />на связи 24/7</div>

							<div class="info-v3-3__content g-opacity-0_7">
								<div class="landing-block-node-card-text g-color-white--parent-hover mb-0">Мы гарантируем, что вы в любой момент сможете связаться с нами и получить консультацию, либо оформить заявку на устранение возможных проблем</div>
							</div>
						</div>
					</div>
					<!-- End Article Content -->
				
				<!-- End Article -->
			</article
></div>

			<div class="landing-block-node-card col-md-6 col-lg-3">
				<!-- Article -->
				<article
 class="landing-block-node-card-inner h-100 text-center info-v3-3 g-parent g-bg-gray-light-v5 g-bg-cover g-bg-primary-opacity-0_6--after g-color-gray-dark-v3 g-color-white--hover g-py-30">
					<!-- Article Image -->
					<img class="landing-block-node-card-img info-v3-3__img" src="https://cdn.bitrix24.site/bitrix/images/landing/business/166x319/img4.png" alt="" />
					<!-- End Article Image -->

					<!-- Article Content -->
					<div class="info-v3-3__description g-pos-cover g-flex-middle">
						<div class="g-flex-middle-item g-pa-30">
							<h4 class="landing-block-node-card-title h3 text-uppercase g-line-height-1 g-font-weight-700
							g-mb-20 info-v3-3__title g-color-gray-dark-v2 g-color-white--parent-hover g-text-underline--none--hover g-transition-0_3">Высокие<br />Технологии</h4>
							<div class="landing-block-node-card-text-unhover info-v3-3__category g-font-size-11 text-uppercase">Наша работа - <br />ваша уверенность!</div>

							<div class="info-v3-3__content g-opacity-0_7">
								<div class="landing-block-node-card-text g-color-white--parent-hover mb-0">Специалисты по внедрению имеют огромный опыт работы с Битрикс24. Вы можете быть на 100% уверены в качестве внедрения сервиса.</div>
							</div>
						</div>
					</div>
					<!-- End Article Content -->
				
				<!-- End Article -->
			</article
></div>
		</div>
		<!-- End Banners -->
	</div>
</section>',
			),
		'04.2.one_col_fix_with_title_2' =>
			array (
				'CODE' => '04.2.one_col_fix_with_title_2',
				'SORT' => '6500',
				'CONTENT' => '<section class="landing-block g-pb-0 g-pt-2 g-bg-blue-opacity-0_9">
	<div class="container g-max-width-800">
		<div class="landing-block-node-inner text-uppercase text-center u-heading-v2-4--bottom g-brd-primary">
			<h4 class="landing-block-node-subtitle h6 g-font-weight-800 g-font-size-12 g-letter-spacing-1 g-color-primary g-mb-20"> </h4>
			<h2 class="landing-block-node-title h1 u-heading-v2__title g-line-height-1_3 g-font-weight-600 g-font-size-40 g-color-white g-mb-minus-10">Наши компетенции</h2>
		</div>
	</div>
</section>',
			),
		'12.image_carousel_6_cols_fix' =>
			array (
				'CODE' => '12.image_carousel_6_cols_fix',
				'SORT' => '7000',
				'CONTENT' => '<section class="landing-block text-center js-animation zoomIn g-pt-20 g-pb-20">
        <div class="container">

            <div id="carouselGLR003" class="js-carousel g-mb-20"
                 data-autoplay="true"
				 data-pause-hover="true"
                 data-infinite="true"
                 data-slides-show="6">
                <div class="landing-block-card-carousel-item js-slide g-brd-around g-brd-gray-light-v1--hover g-transition-0_2 g-mx-10">
					<a href="#" class="landing-block-card-logo-link">
						<img class="landing-block-node-carousel-img img-fluid g-max-width-170--md mx-auto" src="https://cdn.bitrix24.site/bitrix/images/landing/business/200x150/img1.png" alt="">
					</a>
                </div>

                <div class="landing-block-card-carousel-item js-slide g-brd-around g-brd-gray-light-v1--hover g-transition-0_2 g-mx-10">
					<a href="#" class="landing-block-card-logo-link">
						<img class="landing-block-node-carousel-img img-fluid g-max-width-170--md mx-auto" src="https://cdn.bitrix24.site/bitrix/images/landing/business/200x150/img2.png" alt="">
					</a>
                </div>

                <div class="landing-block-card-carousel-item js-slide g-brd-around g-brd-gray-light-v1--hover g-transition-0_2 g-mx-10">
					<a href="#" class="landing-block-card-logo-link">
						<img class="landing-block-node-carousel-img img-fluid g-max-width-170--md mx-auto" src="https://cdn.bitrix24.site/bitrix/images/landing/business/200x150/img3.png" alt="">
					</a>
                </div>

                <div class="landing-block-card-carousel-item js-slide g-brd-around g-brd-gray-light-v1--hover g-transition-0_2 g-mx-10">
					<a href="#" class="landing-block-card-logo-link">
						<img class="landing-block-node-carousel-img img-fluid g-max-width-170--md mx-auto" src="https://cdn.bitrix24.site/bitrix/images/landing/business/200x150/img4.png" alt="">
					</a>
                </div>

                <div class="landing-block-card-carousel-item js-slide g-brd-around g-brd-gray-light-v1--hover g-transition-0_2 g-mx-10">
					<a href="#" class="landing-block-card-logo-link">
						<img class="landing-block-node-carousel-img img-fluid g-max-width-170--md mx-auto" src="https://cdn.bitrix24.site/bitrix/images/landing/business/200x150/img5.png" alt="">
					</a>
                </div>

                <div class="landing-block-card-carousel-item js-slide g-brd-around g-brd-gray-light-v1--hover g-transition-0_2 g-mx-10">
					<a href="#" class="landing-block-card-logo-link">
						<img class="landing-block-node-carousel-img img-fluid g-max-width-170--md mx-auto" src="https://cdn.bitrix24.site/bitrix/images/landing/business/200x150/img6.png" alt="">
					</a>
                </div>

                <div class="landing-block-card-carousel-item js-slide g-brd-around g-brd-gray-light-v1--hover g-transition-0_2 g-mx-10">
					<a href="#" class="landing-block-card-logo-link">
						<img class="landing-block-node-carousel-img img-fluid g-max-width-170--md mx-auto" src="https://cdn.bitrix24.site/bitrix/images/landing/business/200x150/img7.png" alt="">
					</a>
                </div>

                <div class="landing-block-card-carousel-item js-slide g-brd-around g-brd-gray-light-v1--hover g-transition-0_2 g-mx-10">
					<a href="#" class="landing-block-card-logo-link">
						<img class="landing-block-node-carousel-img img-fluid g-max-width-170--md mx-auto" src="https://cdn.bitrix24.site/bitrix/images/landing/business/200x150/img8.png" alt="">
					</a>
                </div>

                <div class="landing-block-card-carousel-item js-slide g-brd-around g-brd-gray-light-v1--hover g-transition-0_2 g-mx-10">
					<a href="#" class="landing-block-card-logo-link">
						<img class="landing-block-node-carousel-img img-fluid g-max-width-170--md mx-auto" src="https://cdn.bitrix24.site/bitrix/images/landing/business/200x150/img9.png" alt="">
					</a>
                </div>
            </div>

        </div>
    </section>',
			),
		'07.2.two_col_fix_text_with_icon_with_title' =>
			array (
				'CODE' => '07.2.two_col_fix_text_with_icon_with_title',
				'SORT' => '7500',
				'CONTENT' => '<section class="landing-block g-pt-20 g-pb-20 g-bg-secondary">

		<div class="container text-center g-width-780 g-color-gray-light-v2 g-mb-20">
			<div class="landing-block-node-header text-uppercase u-heading-v2-4--bottom g-brd-primary g-mb-40">
				<h4 class="landing-block-node-subtitle h6 g-font-weight-800 g-font-size-12 g-letter-spacing-1 g-color-primary g-mb-20"> </h4>
				<h2 class="landing-block-node-title h1 u-heading-v2__title g-line-height-1_3 g-font-weight-600 g-font-size-40 g-mb-minus-10 g-color-black">этапы работы</h2>
			</div>
		</div>
		
        <div class="container">
            <div class="row">

                <div class="landing-block-card js-animation fadeIn col-lg-6 g-px-30 g-mb-10">
                    <div class="landing-block-card-container g-pos-rel g-parent g-theme-business-bg-blue-dark-v2 g-py-35 g-px-25 g-pl-70--sm">
                        <div class="g-hidden-xs-down g-absolute-centered--y g-left-0 g-absolute-top-px">
                            <div class="landing-block-node-element-icon-container g-pull-50x-left g-brd-around g-brd-5 g-rounded-50x g-overflow-hidden g-color-white g-bg-primary">
                                <span class="landing-block-node-icon-hover d-block g-pos-abs g-top-0 g-left-0 g-width-85 g-height-85 g-rounded-50x opacity-0 g-opacity-1--parent-hover g-transition-0_1 g-transition--ease-in" style="background-image: url(\'https://cdn.bitrix24.ru/b1479079/landing/35f/35f9fe44e89822cc1583f2fafad524f7/help-cloudman-07.jpg\');" data-fileid="5498" data-filehash="69c421b0d54123b9bf68019eedd461be"></span>
								<span class="u-icon-v3 u-icon-size--xl g-width-85 g-height-85 g-bg-transparent g-opacity-1 opacity-0--parent-hover g-transition-0_1 g-transition--ease-in">
								  <i class="landing-block-node-element-icon icon-fire"></i>
								</span>
                            </div>
                        </div>

                        <h3 class="landing-block-node-element-title h5 text-uppercase g-color-gray-light-v2 g-mb-10">предпроектный анализ</h3>
                        <div class="landing-block-node-element-text g-color-gray-light-v2">Анализируем специфику работы вашей компании, даём практические советы по улучшению.<br /></div>
                    </div>
                </div>

                <div class="landing-block-card js-animation fadeIn col-lg-6 g-px-30 g-mb-10">
                    <div class="landing-block-card-container g-pos-rel g-parent g-theme-business-bg-blue-dark-v2 g-py-35 g-px-25 g-pl-70--sm">
                        <div class="g-hidden-xs-down g-absolute-centered--y g-left-0 g-absolute-top-px">
                            <div class="landing-block-node-element-icon-container g-pull-50x-left g-brd-around g-brd-5 g-rounded-50x g-overflow-hidden g-color-white g-bg-primary">
                                <span class="landing-block-node-icon-hover d-block g-pos-abs g-top-0 g-left-0 g-width-85 g-height-85 g-rounded-50x opacity-0 g-opacity-1--parent-hover g-transition-0_1 g-transition--ease-in" style="background-image: url(\'https://cdn.bitrix24.ru/b1479079/landing/c2e/c2ec656f2120002441eab8442cdd0172/vesy.jpg\');" data-fileid="5732" data-filehash="e11164dc8b3adfc99ad1c1bf673bbf83"></span>
								<span class="u-icon-v3 u-icon-size--xl g-width-85 g-height-85 g-bg-transparent g-opacity-1 opacity-0--parent-hover g-transition-0_1 g-transition--ease-in">
								  <i class="landing-block-node-element-icon icon-fire"></i>
								</span>
                            </div>
                        </div>

                        <h3 class="landing-block-node-element-title h5 text-uppercase g-color-gray-light-v2 g-mb-10">аудит</h3>
                        <div class="landing-block-node-element-text g-color-gray-light-v2"><p>Выявляем сильные и слабые стороны будущего проекта, работаем над его совершенствованием.</p></div>
                    </div>
                </div><div class="landing-block-card js-animation fadeIn col-lg-6 g-px-30 g-mb-10">
                    <div class="landing-block-card-container g-pos-rel g-parent g-theme-business-bg-blue-dark-v2 g-py-35 g-px-25 g-pl-70--sm">
                        <div class="g-hidden-xs-down g-absolute-centered--y g-left-0 g-absolute-top-px">
                            <div class="landing-block-node-element-icon-container g-pull-50x-left g-brd-around g-brd-5 g-rounded-50x g-overflow-hidden g-color-white g-bg-primary">
                                <span class="landing-block-node-icon-hover d-block g-pos-abs g-top-0 g-left-0 g-width-85 g-height-85 g-rounded-50x opacity-0 g-opacity-1--parent-hover g-transition-0_1 g-transition--ease-in" style="background-image: url(\'https://cdn.bitrix24.ru/b1479079/landing/133/1331cab5df96c7be0070c93ded0b10ca/kluch.jpg\');" data-fileid="5736" data-filehash="32950b3ff8413eb3910f54129f4d0d3b"></span>
								<span class="u-icon-v3 u-icon-size--xl g-width-85 g-height-85 g-bg-transparent g-opacity-1 opacity-0--parent-hover g-transition-0_1 g-transition--ease-in">
								  <i class="landing-block-node-element-icon icon-fire"></i>
								</span>
                            </div>
                        </div>

                        <h3 class="landing-block-node-element-title h5 text-uppercase g-color-gray-light-v2 g-mb-10">разработка проекта</h3>
                        <div class="landing-block-node-element-text g-color-gray-light-v2"><p>Разрабатываем проект с учётом пожеланий клиента и специфики его бизнеса.</p></div>
                    </div>
                </div><div class="landing-block-card js-animation fadeIn col-lg-6 g-px-30 g-mb-10">
                    <div class="landing-block-card-container g-pos-rel g-parent g-theme-business-bg-blue-dark-v2 g-py-35 g-px-25 g-pl-70--sm">
                        <div class="g-hidden-xs-down g-absolute-centered--y g-left-0 g-absolute-top-px">
                            <div class="landing-block-node-element-icon-container g-pull-50x-left g-brd-around g-brd-5 g-rounded-50x g-overflow-hidden g-color-white g-bg-primary">
                                <span class="landing-block-node-icon-hover d-block g-pos-abs g-top-0 g-left-0 g-width-85 g-height-85 g-rounded-50x opacity-0 g-opacity-1--parent-hover g-transition-0_1 g-transition--ease-in" style="background-image: url(\'https://cdn.bitrix24.ru/b1479079/landing/859/859cfaa31b91c57d44434dfa3fbc230f/palec.jpg\');" data-fileid="5738" data-filehash="b59791dbcbe77a57c1fd082dc8bcd56e"></span>
								<span class="u-icon-v3 u-icon-size--xl g-width-85 g-height-85 g-bg-transparent g-opacity-1 opacity-0--parent-hover g-transition-0_1 g-transition--ease-in">
								  <i class="landing-block-node-element-icon icon-energy"></i>
								</span>
                            </div>
                        </div>

                        <h3 class="landing-block-node-element-title h5 text-uppercase g-color-gray-light-v2 g-mb-10">внедрение</h3>
                        <div class="landing-block-node-element-text g-color-gray-light-v2"><p>Готовый проект воплощается в жизнь, проводятся необходимые работы по внедрению и обучению сотрудников.</p></div>
                    </div>
                </div>
				
            </div>
        </div>
    </section>',
			),
		'04.1.one_col_fix_with_title_@_Mnlpn9rMs6' =>
			array (
				'CODE' => '04.1.one_col_fix_with_title',
				'SORT' => '8000',
				'CONTENT' => '<section class="landing-block g-pt-20 g-pb-20">
        <div class="container">
            <div class="landing-block-node-inner text-uppercase text-center u-heading-v2-4--bottom g-brd-primary">
                <h4 class="landing-block-node-subtitle h6 g-font-weight-800 g-font-size-12 g-letter-spacing-1 g-color-primary g-mb-20">интересно?</h4>
                <h2 class="landing-block-node-title h1 u-heading-v2__title g-line-height-1_3 g-font-weight-600 g-font-size-40 g-mb-minus-10">оставляй контакты</h2>
            </div>
        </div>
    </section>',
			),
		'33.2.form_1_transparent_black_right_text' =>
			array (
				'CODE' => '33.2.form_1_transparent_black_right_text',
				'SORT' => '8500',
				'CONTENT' => '<section class="g-pos-rel landing-block">

	<div class="landing-block-node-bgimg g-bg-size-cover g-bg-img-hero g-bg-cover g-bg-black-opacity-0_7--after g-pt-120 g-pb-70" style="background-image: url(https://cdn.bitrix24.site/bitrix/images/landing/business/1920x1080/img4.jpg);">

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
				</div>

				<div class="col-md-8 g-mb-50">
					<div class="bitrix24forms g-brd-around g-brd-white-opacity-0_6 g-px-45 g-py-60 u-form-alert-v1" data-b24form="" data-form-style-input-border-color="1" data-b24form-use-style="Y" data-b24form-show-header="N" data-b24form-original-domain=""></div>
				</div>

				<div class="col-md-4 g-mb-50">
					<h2 class="landing-block-node-main-title h1 g-color-white mb-4">Оставляйте заявку!</h2>

					<div class="landing-block-node-text g-line-height-1_5 text-left g-mb-40 g-color-white-opacity-0_6" data-form-style-main-font-family="1" data-form-style-main-font-weight="1" data-form-style-header-text-font-size="1" data-selector=".landing-block-node-text@0"><p>Наш менеджер свяжется с вами в любое удобное для вас время!</p></div>

					<h3 class="h4 g-color-white mb-4 landing-block-node-title" data-form-style-main-font-color="1" data-form-style-main-font-family="1">Контактная информация</h3>

					<!-- Icon Block -->
					<div class="landing-block-node-card-contact">
						<div class="media align-items-center mb-4">
							<div class="d-flex">
								<span class="landing-block-card-contact-icon-container u-icon-v1 u-icon-size--sm g-color-white mr-2">
								  <i class="landing-block-card-contact-icon icon-hotel-restaurant-235 u-line-icon-pro"></i>
								</span>
							</div>
							<div class="media-body">
								<div class="landing-block-node-contact-text g-color-white-opacity-0_6 mb-0" data-form-style-main-font-weight="1" data-form-style-header-text-font-size="1" data-form-style-label-font-weight="1" data-form-style-label-font-size="1" data-form-style-second-font-color="1">г. Москва, пр. Вернандского, 58, с. 3</div>
							</div>
						</div>
					</div>
					<!-- End Icon Block -->

					<!-- Icon Block -->
					<div class="landing-block-node-card-contact">
						<div class="media align-items-center mb-4">
							<div class="d-flex">
								<span class="landing-block-card-contact-icon-container u-icon-v1 u-icon-size--sm g-color-white mr-2">
								  <i class="landing-block-card-contact-icon icon-communication-033 u-line-icon-pro"></i>
								</span>
							</div>
							<div class="media-body">
								<div class="landing-block-node-contact-text g-color-white-opacity-0_6 mb-0" data-form-style-main-font-weight="1" data-form-style-header-text-font-size="1" data-form-style-label-font-weight="1" data-form-style-label-font-size="1" data-form-style-second-font-color="1">
									<a href="tel:+7(495)0000000">+7 (495) 000 00 00</a>
								</div>
							</div>
						</div>
					</div>
					<!-- End Icon Block -->

					<!-- Icon Block -->
					<div class="landing-block-node-card-contact">
						<div class="media align-items-center mb-4">
							<div class="d-flex">
								<span class="landing-block-card-contact-icon-container u-icon-v1 u-icon-size--sm g-color-white mr-2">
								  <i class="landing-block-card-contact-icon icon-communication-033 u-line-icon-pro"></i>
								</span>
							</div>
							<div class="media-body">
								<div class="landing-block-node-contact-text g-color-white-opacity-0_6 mb-0" data-form-style-main-font-weight="1" data-form-style-header-text-font-size="1" data-form-style-label-font-weight="1" data-form-style-label-font-size="1" data-form-style-second-font-color="1">
									<a href="tel:+7(495)0000001">+7 (495) 000 00 01</a>
								</div>
							</div>
						</div>
					</div>
					<!-- End Icon Block -->

					<!-- Icon Block -->
					<div class="landing-block-node-card-contact">
						<div class="media align-items-center mb-4">
							<div class="d-flex">
								<span class="landing-block-card-contact-icon-container u-icon-v1 u-icon-size--sm g-color-white mr-2">
								  <i class="landing-block-card-contact-icon icon-communication-033 u-line-icon-pro"></i>
								</span>
							</div>
							<div class="media-body">
								<div class="landing-block-node-contact-text g-color-white-opacity-0_6 mb-0" data-form-style-main-font-weight="1" data-form-style-header-text-font-size="1" data-form-style-label-font-weight="1" data-form-style-label-font-size="1" data-form-style-second-font-color="1">
									<a href="tel:+7(495)0000002">+7 (495) 000 00 02</a>
								</div>
							</div>
						</div>
					</div>
					<!-- End Icon Block -->

					<!-- Icon Block -->
					<div class="landing-block-node-card-contact">
						<div class="media align-items-center g-mb-60">
							<div class="d-flex">
								<span class="landing-block-card-contact-icon-container u-icon-v1 u-icon-size--sm g-color-white mr-2">
								  <i class="landing-block-card-contact-icon icon-communication-062 u-line-icon-pro"></i>
								</span>
							</div>
							<div class="media-body">
								<div class="landing-block-node-contact-text g-color-white-opacity-0_6"
									 data-form-style-main-font-weight="1"
									 data-form-style-header-text-font-size="1"
									 data-form-style-label-font-weight="1"
									 data-form-style-label-font-size="1"
									 data-form-style-second-font-color="1"
								>
									<a href="mailto:info@company24.ru">info@rupany24.com</a>
								</div>
							</div>
						</div>
					</div>
					<!-- End Icon Block -->
				</div>
			</div>
		</div>
	</div>

</section>',
			),
	)

);