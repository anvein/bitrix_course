<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use \Bitrix\Main\Localization\Loc;

return array(
	'parent' => 'store-mini-catalog',
	'code' => 'store-mini-catalog/handmade',
	'name' => Loc::getMessage('LANDING_DEMO_STORE_MINI_CATALOG_HANDMADE_TXT_1'),
	'description' => Loc::getMessage('LANDING_DEMO_STORE_MINI_CATALOG_HANDMADE_DESC'),
	'type' => 'store',
	'version' => 2,
	'fields' =>
		array(
			'RULE' => NULL,
			'ADDITIONAL_FIELDS' =>
				array(
					'METAOG_IMAGE' => 'https://repo.bitrix24.site/bitrix/images/demo/page/store-mini-catalog/preview.jpg',
					'VIEW_USE' => 'N',
					'VIEW_TYPE' => 'no',
					'THEME_CODE' => 'event',
					'THEME_CODE_TYPO' => 'event',
				),
		),
	'layout' => array(),
	'items' =>
		array(
			0 =>
				array(
					'code' => '46.9.cover_bgimg_vertical_slider',
					'cards' =>
						array(
							'.landing-block-node-card' => 1,
						),
					'nodes' =>
						array(
							'.landing-block-node-card-img' =>
								array(
									0 =>
										array(
											'src' => 'https://cdn.bitrix24.site/bitrix/images/landing/business/1620x1080/artem-bali-623185-unsplash.jpg',
										),
								),
							'.landing-block-node-card-subtitle' =>
								array(
									0 => '<span style="font-weight: bold;font-style: italic;">Handmade-магазинчик &quot;Мечта&quot;</span>',
								),
							'.landing-block-node-card-title' =>
								array(
									0 => '<span style="font-weight: normal;">Делаем украшения с любовью!</span>',
								),
							'.landing-block-node-card-button' =>
								array(
									0 =>
										array(
											'text' => 'Купить сейчас',
											'href' => '#block@block[store.catalog.list]',
											'target' => '_self',
											'attrs' =>
												array(
													'data-embed' => NULL,
													'data-url' => NULL,
												),
										),
								),
						),
					'style' =>
						array(
							'.landing-block-node-text-container' =>
								array(
									0 => 'landing-block-node-text-container js-animation fadeIn container text-center g-z-index-1 animated',
								),
							'.landing-block-node-card-subtitle' =>
								array(
									0 => 'landing-block-node-card-subtitle h6 g-color-white g-mb-10 g-mb-25--md g-font-cormorant-infant g-font-size-60',
								),
							'.landing-block-node-card-title' =>
								array(
									0 => 'landing-block-node-card-title g-line-height-1_2 g-font-weight-700 g-color-white mb-0 g-mb-35--md g-text-transform-none g-font-open-sans g-font-size-18',
								),
							'.landing-block-node-card-button' =>
								array(
									0 => 'landing-block-node-card-button btn btn-lg g-mt-20 g-mt-0--md text-uppercase u-btn-primary g-font-weight-700 g-font-size-12 g-py-15 g-px-40',
								),
							'.landing-block-node-card-img' =>
								array(
									0 => 'landing-block-node-card-img g-flex-centered g-bg-cover g-bg-pos-center g-bg-img-hero g-height-70vh g-bg-black-opacity-0_5--after',
								),
							'.landing-block-node-card-button-container' =>
								array(
									0 => 'landing-block-node-card-button-container',
								),
							'#wrapper' =>
								array(
									0 => 'landing-block',
								),
						),
					'attrs' =>
						array(),
				),
			1 =>
				array(
					'code' => '47.1.title_with_icon',
					'cards' =>
						array(),
					'nodes' =>
						array(
							'.landing-block-node-title' =>
								array(
									0 => 'О нас',
								),
							'.landing-block-node-icon' =>
								array(
									0 => 'landing-block-node-icon fa fa-heart g-font-size-8',
									1 => 'landing-block-node-icon fa fa-heart g-font-size-11',
									2 => 'landing-block-node-icon fa fa-heart g-font-size-default',
									3 => 'landing-block-node-icon fa fa-heart g-font-size-11',
									4 => 'landing-block-node-icon fa fa-heart g-font-size-8',
								),
							'.landing-block-node-text' =>
								array(
									0 => '<p>Мы изготавливаем различные украшения: кольца, серьги, кулоны, браслеты. <br />У нас есть как готовые украшение, так и под заказ!</p>',
								),
						),
					'style' =>
						array(
							'.landing-block-node-title' =>
								array(
									0 => 'landing-block-node-title js-animation fadeInUp u-heading-v7__title g-font-size-60 g-font-cormorant-infant font-italic g-font-weight-600 g-mb-20 animated g-color-black-opacity-0_9',
								),
							'.landing-block-node-text' =>
								array(
									0 => 'landing-block-node-text js-animation fadeInUp mb-0 g-pb-1 animated g-font-open-sans g-color-gray-dark-v4',
								),
							'.landing-block-node-icon' =>
								array(
									0 => 'landing-block-node-icon fa fa-heart g-font-size-8',
									1 => 'landing-block-node-icon fa fa-heart g-font-size-11',
									2 => 'landing-block-node-icon fa fa-heart g-font-size-default',
								),
							'#wrapper' =>
								array(
									0 => 'landing-block g-pb-20 g-pt-30',
								),
						),
					'attrs' =>
						array(),
				),
			2 =>
				array(
					'code' => '34.4.two_cols_with_text_and_icons',
					'cards' =>
						array(
							'.landing-block-node-card' => 3,
						),
					'nodes' =>
						array(
							'.landing-block-node-card-icon' =>
								array(
									0 => 'landing-block-node-card-icon g-color-primary icon-diamond',
									1 => 'landing-block-node-card-icon g-color-primary icon-emotsmile',
									2 => 'landing-block-node-card-icon g-color-primary icon-star',
								),
							'.landing-block-node-card-text' =>
								array(
									0 => '<p>Мы изготавливаем украшения на любой вкус, которые моментально разбирают. И каждую модель можно повторить!</p>',
									1 => '<p>За время работы нашего магазинчика, мы осчастливили огромное количество людей!</p>',
									2 => '<p>Наши возможности не ограничиваются готовыми украшениями, мы всегда готовы сделать что-либо на заказ!</p>',
								),
							'.landing-block-node-card-title' =>
								array(
									0 => '<span style="font-style: italic;">Изготовили 200 моделей</span>',
									1 => '<span style="font-style: italic;">Более 500 покупателей</span>',
									2 => '<span style="font-style: italic;">Делаем на заказ</span>',
								),
						),
					'style' =>
						array(
							'.landing-block-node-card' =>
								array(
									0 => 'landing-block-node-card js-animation fadeInUp col-md-6 g-mb-40 animated landing-card col-lg-4',
								),
							'.landing-block-node-card-text' =>
								array(
									0 => 'landing-block-node-card-text g-font-size-default g-color-gray-dark-v2 mb-0 g-font-open-sans g-font-size-14',
								),
							'.landing-block-node-card-title' =>
								array(
									0 => 'landing-block-node-card-title h5 g-font-weight-800 g-text-transform-none g-font-cormorant-infant g-font-size-25',
								),
							'.landing-block-node-card-icon' =>
								array(
									0 => 'landing-block-node-card-icon g-color-primary icon-diamond',
									1 => 'landing-block-node-card-icon g-color-primary icon-emotsmile',
									2 => 'landing-block-node-card-icon g-color-primary icon-star',
								),
							'#wrapper' =>
								array(
									0 => 'landing-block g-pt-0 g-pb-5',
								),
						),
					'attrs' =>
						array(),
				),
			3 =>
				array(
					'code' => '47.1.title_with_icon',
					'cards' =>
						array(),
					'nodes' =>
						array(
							'.landing-block-node-title' =>
								array(
									0 => '<span style="">Наши</span> украшения',
								),
							'.landing-block-node-icon' =>
								array(
									0 => 'landing-block-node-icon fa fa-heart g-font-size-8',
									1 => 'landing-block-node-icon fa fa-heart g-font-size-11',
									2 => 'landing-block-node-icon fa fa-heart g-font-size-default',
									3 => 'landing-block-node-icon fa fa-heart g-font-size-11',
									4 => 'landing-block-node-icon fa fa-heart g-font-size-8',
								),
							'.landing-block-node-text' =>
								array(
									0 => ' ',
								),
						),
					'style' =>
						array(
							'.landing-block-node-title' =>
								array(
									0 => 'landing-block-node-title js-animation fadeInUp u-heading-v7__title g-font-size-60 g-font-cormorant-infant font-italic g-font-weight-600 g-mb-20 animated g-color-gray-light-v5',
								),
							'.landing-block-node-text' =>
								array(
									0 => 'landing-block-node-text js-animation fadeInUp g-color-gray-dark-v5 mb-0 g-pb-1 animated',
								),
							'.landing-block-node-icon' =>
								array(
									0 => 'landing-block-node-icon fa fa-heart g-font-size-8',
									1 => 'landing-block-node-icon fa fa-heart g-font-size-11',
									2 => 'landing-block-node-icon fa fa-heart g-font-size-default',
								),
							'#wrapper' =>
								array(
									0 => 'landing-block g-theme-business-bg-blue-dark-v1-opacity-0_9 g-pt-35 g-pb-5',
								),
						),
					'attrs' =>
						array(),
				),
			4 =>
				array(
					'code' => 'store.catalog.list',
					'cards' =>
						array(),
					'nodes' =>
						array(
							'bitrix:catalog.section' => array(
								'PAGE_ELEMENT_COUNT' => 8,
								'PRODUCT_ROW_VARIANTS' => [3,3],//[{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false}]
							),
						),
					'style' =>
						array(
							'.landing-component' =>
								array(
									0 => 'landing-component',
								),
							'#wrapper' =>
								array(
									0 => 'landing-block g-pt-0 g-pb-35',
								),
						),
					'attrs' =>
						array(
							'bitrix:landing.blocks.cmpfilter' =>
								array(),
							'bitrix:catalog.section' => array(
							),
						),
				),
			5 =>
				array(
					'code' => '47.1.title_with_icon',
					'cards' =>
						array(),
					'nodes' =>
						array(
							'.landing-block-node-title' =>
								array(
									0 => 'Доставка',
								),
							'.landing-block-node-icon' =>
								array(
									0 => 'landing-block-node-icon fa fa-heart g-font-size-8',
									1 => 'landing-block-node-icon fa fa-heart g-font-size-11',
									2 => 'landing-block-node-icon fa fa-heart g-font-size-default',
									3 => 'landing-block-node-icon fa fa-heart g-font-size-11',
									4 => 'landing-block-node-icon fa fa-heart g-font-size-8',
								),
							'.landing-block-node-text' =>
								array(
									0 => '<p> Мы можем отправить любой заказ курьером в Калининград и Калининградскую область.<br /><span style="font-size: 1.14286rem;">Также возможен самовывоз: наш магазинчик находится в самом центре города. <br /></span><span style="font-size: 1.14286rem;">Приходите к нам в гости :)</span></p>',
								),
						),
					'style' =>
						array(
							'.landing-block-node-title' =>
								array(
									0 => 'landing-block-node-title js-animation fadeInUp u-heading-v7__title g-font-size-60 g-font-cormorant-infant font-italic g-font-weight-600 g-mb-20 animated g-color-lightblue',
								),
							'.landing-block-node-text' =>
								array(
									0 => 'landing-block-node-text js-animation fadeInUp mb-0 g-pb-1 animated g-font-open-sans g-color-lightblue-v1',
								),
							'.landing-block-node-icon' =>
								array(
									0 => 'landing-block-node-icon fa fa-heart g-font-size-8',
									1 => 'landing-block-node-icon fa fa-heart g-font-size-11',
									2 => 'landing-block-node-icon fa fa-heart g-font-size-default',
								),
							'#wrapper' =>
								array(
									0 => 'landing-block g-theme-business-bg-blue-dark-v1-opacity-0_9 g-pr-0 g-pt-35 g-pb-25',
								),
						),
					'attrs' =>
						array(),
				),
			6 =>
				array(
					'code' => '31.4.two_cols_img_text_fix',
					'cards' =>
						array(),
					'nodes' =>
						array(
							'.landing-block-node-title' =>
								array(
									0 => '<span style="font-style: italic;">Рабочий процесс</span>',
								),
							'.landing-block-node-text' =>
								array(
									0 => '<p>Мы обожаем экспериментировать и делать, казалось бы, невозможное. Самое главное для нас - это довольный клиент.<br /><br />Наше вдохновение - природа, которая хранит в себе неописуемую красоту. Каждое изделие делается полностью вручную. Наш любимый материал - натуральные полудрагоценные камни, такие как опал, аметист, бирюза и авантюрин.<br /><br />Мы используем только качественные материалы для своих изделий.<br /></p>',
								),
							'.landing-block-node-img' =>
								array(
									0 =>
										array(
											'alt' => 'Image description',
											'src' => 'https://cdn.bitrix24.site/bitrix/images/landing/business/540x360/grace-p-197524-unsplash.jpg',
										),
								),
						),
					'style' =>
						array(
							'.landing-block-node-text-container' =>
								array(
									0 => 'landing-block-node-text-container js-animation slideInRight col-md-6 animated',
								),
							'.landing-block-node-title' =>
								array(
									0 => 'landing-block-node-title g-font-weight-700 mb-0 g-mb-15 g-font-cormorant-infant g-text-transform-none g-font-size-40',
								),
							'.landing-block-node-text' =>
								array(
									0 => 'landing-block-node-text g-color-gray-dark-v4 g-font-open-sans g-font-size-16',
								),
							'.landing-block-node-img' =>
								array(
									0 => 'landing-block-node-img js-animation slideInLeft img-fluid animated',
								),
							'#wrapper' =>
								array(
									0 => 'landing-block g-pt-45 g-pb-45',
								),
						),
					'attrs' =>
						array(),
				),
			7 =>
				array(
					'code' => '47.1.title_with_icon',
					'cards' =>
						array(),
					'nodes' =>
						array(
							'.landing-block-node-title' =>
								array(
									0 => 'Украшения на наших покупателях',
								),
							'.landing-block-node-icon' =>
								array(
									0 => 'landing-block-node-icon fa fa-heart g-font-size-8',
									1 => 'landing-block-node-icon fa fa-heart g-font-size-11',
									2 => 'landing-block-node-icon fa fa-heart g-font-size-default',
									3 => 'landing-block-node-icon fa fa-heart g-font-size-11',
									4 => 'landing-block-node-icon fa fa-heart g-font-size-8',
								),
							'.landing-block-node-text' =>
								array(
									0 => ' ',
								),
						),
					'style' =>
						array(
							'.landing-block-node-title' =>
								array(
									0 => 'landing-block-node-title js-animation fadeInUp u-heading-v7__title g-font-size-60 g-font-cormorant-infant font-italic g-font-weight-600 g-mb-20 animated g-color-gray-light-v5 g-line-height-1_1',
								),
							'.landing-block-node-text' =>
								array(
									0 => 'landing-block-node-text js-animation fadeInUp g-color-gray-dark-v5 mb-0 g-pb-1 animated',
								),
							'.landing-block-node-icon' =>
								array(
									0 => 'landing-block-node-icon fa fa-heart g-font-size-8',
									1 => 'landing-block-node-icon fa fa-heart g-font-size-11',
									2 => 'landing-block-node-icon fa fa-heart g-font-size-default',
								),
							'#wrapper' =>
								array(
									0 => 'landing-block g-theme-business-bg-blue-dark-v1-opacity-0_9 g-pt-35 g-pb-7',
								),
						),
					'attrs' =>
						array(),
				),
			8 =>
				array(
					'code' => '32.6.img_grid_4cols_1',
					'cards' =>
						array(),
					'nodes' =>
						array(
							'.landing-block-node-img' =>
								array(
									0 =>
										array(
											'alt' => '',
											'src' => 'https://cdn.bitrix24.site/bitrix/images/landing/business/960x960/image-2018-05-14-10-38-15.png',
										),
									1 =>
										array(
											'alt' => '',
											'src' => 'https://cdn.bitrix24.site/bitrix/images/landing/business/960x960/image-2018-05-14-10-40-56.png',
										),
									2 =>
										array(
											'alt' => '',
											'src' => 'https://cdn.bitrix24.site/bitrix/images/landing/business/960x960/image-2018-05-14-10-42-00.png',
										),
									3 =>
										array(
											'alt' => '',
											'src' => 'https://cdn.bitrix24.site/bitrix/images/landing/business/960x960/image-2018-05-14-10-41-29.png',
										),
								),
							'.landing-block-node-img-title' =>
								array(
									0 => 'Лунный камень',
									1 => 'Черный агат',
									2 => 'Белый агат',
									3 => 'Белый говлит',
								),
						),
					'style' =>
						array(
							'.landing-block-node-img-title' =>
								array(
									0 => 'landing-block-node-img-title g-flex-middle-item text-center h3 g-color-white g-line-height-1_4 g-font-size-20 g-font-open-sans g-letter-spacing-1 g-text-transform-none',
								),
							'.landing-block-node-img-container-leftleft' =>
								array(
									0 => 'landing-block-node-img-container landing-block-node-img-container-leftleft js-animation fadeInLeft h-100 g-pos-rel g-parent u-block-hover animated',
								),
							'.landing-block-node-img-container-left' =>
								array(
									0 => 'landing-block-node-img-container landing-block-node-img-container-left js-animation fadeInLeft h-100 g-pos-rel g-parent u-block-hover animated',
								),
							'.landing-block-node-img-container-right' =>
								array(
									0 => 'landing-block-node-img-container landing-block-node-img-container-right js-animation fadeInRight h-100 g-pos-rel g-parent u-block-hover animated',
								),
							'.landing-block-node-img-container-rightright' =>
								array(
									0 => 'landing-block-node-img-container landing-block-node-img-container-rightright js-animation fadeInRight h-100 g-pos-rel g-parent u-block-hover animated',
								),
							'#wrapper' =>
								array(
									0 => 'landing-block g-pt-45 g-pb-35',
								),
						),
					'attrs' =>
						array(),
				),
			9 =>
				array(
					'code' => '47.1.title_with_icon',
					'cards' =>
						array(),
					'nodes' =>
						array(
							'.landing-block-node-title' =>
								array(
									0 => 'Контакты',
								),
							'.landing-block-node-icon' =>
								array(
									0 => 'landing-block-node-icon fa fa-heart g-font-size-8',
									1 => 'landing-block-node-icon fa fa-heart g-font-size-11',
									2 => 'landing-block-node-icon fa fa-heart g-font-size-default',
									3 => 'landing-block-node-icon fa fa-heart g-font-size-11',
									4 => 'landing-block-node-icon fa fa-heart g-font-size-8',
								),
							'.landing-block-node-text' =>
								array(
									0 => '<p>Мы всегда рады знакомиться и общаться с нашими клиентами. А также рады любым пожеланиям. Позвоните нам или напишите пару строк в соцсетях.</p>',
								),
						),
					'style' =>
						array(
							'.landing-block-node-title' =>
								array(
									0 => 'landing-block-node-title js-animation fadeInUp u-heading-v7__title g-font-size-60 g-font-cormorant-infant font-italic g-font-weight-600 g-mb-20 animated g-color-gray-light-v5',
								),
							'.landing-block-node-text' =>
								array(
									0 => 'landing-block-node-text js-animation fadeInUp mb-0 g-pb-1 animated g-color-lightblue-v1 g-font-open-sans',
								),
							'.landing-block-node-icon' =>
								array(
									0 => 'landing-block-node-icon fa fa-heart g-font-size-8',
									1 => 'landing-block-node-icon fa fa-heart g-font-size-11',
									2 => 'landing-block-node-icon fa fa-heart g-font-size-default',
								),
							'#wrapper' =>
								array(
									0 => 'landing-block g-theme-business-bg-blue-dark-v1-opacity-0_9 g-pt-40 g-pb-0',
								),
						),
					'attrs' =>
						array(),
				),
			10 =>
				array(
					'code' => '14.2contacts_3_cols',
					'cards' =>
						array(
							'.landing-block-card' => 3,
						),
					'nodes' =>
						array(
							'.landing-block-node-contact-img' =>
								array(
									0 => 'landing-block-node-contact-img d-inline-block g-font-size-50 g-color-primary g-mb-20 fa fa-phone-square',
									1 => 'landing-block-node-contact-img d-inline-block g-font-size-50 g-color-primary g-mb-20 fa fa-facebook-official',
									2 => 'landing-block-node-contact-img d-inline-block g-font-size-50 g-color-primary g-mb-20 fa fa-twitter-square',
								),
							'.landing-block-node-contact-title' =>
								array(
									0 => '<br />',
									1 => '<br />',
									2 => '<br />',
								),
							'.landing-block-node-contact-text' =>
								array(),
							'.landing-block-node-contact-link' =>
								array(
									0 =>
										array(
											'text' => '1-800-643-4500',
											'href' => 'tel:1-800-643-4500',
											'target' => NULL,
											'attrs' =>
												array(
													'data-embed' => NULL,
													'data-url' => NULL,
												),
										),
									1 =>
										array(
											'text' => 'Facebook',
											'href' => 'https://facebook.com',
											'target' => '_self',
											'attrs' =>
												array(
													'data-embed' => NULL,
													'data-url' => NULL,
												),
										),
									2 =>
										array(
											'text' => 'Twitter',
											'href' => 'https://twitter.com',
											'target' => '_self',
											'attrs' =>
												array(
													'data-embed' => NULL,
													'data-url' => NULL,
												),
										),
								),
						),
					'style' =>
						array(
							'.landing-block-card' =>
								array(
									0 => 'landing-block-card js-animation fadeIn landing-block-node-contact g-brd-between-cols col-sm-4 g-brd-top g-brd-top-none--md g-brd-left--md g-brd-primary g-px-15 g-py-30 g-py-0--md animated landing-card',
								),
							'.landing-block-node-contact-title' =>
								array(
									0 => 'landing-block-node-contact-title text-uppercase g-font-size-default g-color-white-opacity-0_5 g-mb-5',
								),
							'.landing-block-node-contact-img' =>
								array(
									0 => 'landing-block-node-contact-img d-inline-block g-font-size-50 g-color-primary g-mb-20 fa fa-phone-square',
									1 => 'landing-block-node-contact-img d-inline-block g-font-size-50 g-color-primary g-mb-20 fa fa-facebook-official',
									2 => 'landing-block-node-contact-img d-inline-block g-font-size-50 g-color-primary g-mb-20 fa fa-twitter-square',
								),
							'.landing-block-node-contact-link' =>
								array(
									0 => 'landing-block-node-contact-link g-font-weight-700',
								),
							'#wrapper' =>
								array(
									0 => 'landing-block g-theme-business-bg-blue-dark-v1-opacity-0_9',
								),
						),
					'attrs' =>
						array(),
				),
		),
);