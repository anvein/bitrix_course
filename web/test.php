<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?><?$APPLICATION->IncludeComponent("bitrix:news.list", "mainpage_top_slider", Array(
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "N",	// Учитывать права доступа
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "N",	// Тип кеширования
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
		"DISPLAY_DATE" => "N",	// Выводить дату элемента
		"DISPLAY_NAME" => "N",	// Выводить название элемента
		"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
		"DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"FIELD_CODE" => array(	// Поля
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "DETAIL_TEXT",
			3 => "",
		),
		"FILTER_NAME" => "",	// Фильтр
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"IBLOCK_ID" => "3",	// Код информационного блока
		"IBLOCK_TYPE" => "content",	// Тип информационного блока (используется только для проверки)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"NEWS_COUNT" => "10",	// Количество новостей на странице
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => "",	// Шаблон постраничной навигации
		"PAGER_TITLE" => "Новости",	// Название категорий
		"PARENT_SECTION" => "",	// ID раздела
		"PARENT_SECTION_CODE" => "",	// Код раздела
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
		"PROPERTY_CODE" => array(	// Свойства
			0 => "link",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
		"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SHOW_404" => "N",	// Показ специальной страницы
		"SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
		"SORT_BY2" => "",	// Поле для второй сортировки новостей
		"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
		"SORT_ORDER2" => "",	// Направление для второй сортировки новостей
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
	),
	false
);?>

    <!-- О нас -->
    <section class="who-area-are pad-90" id="about_us">
        <div class="container">
            <h2 class="title-1">О нас</h2>
            <div class="row">
                <div class="col-md-7">
                    <div class="who-we">
                        <p>Мы в <b>WeCoders</b> считаем, что любую задачу, даже которая кажется «невозможной» можно
                           решить, чем мы успешно и занимаемся! У нас собрались только творческие и ответственные
                           люди,которым под силу решить любую проблему в сфере digital, чтобы помочь другим бизнесам
                           достичь своих целей. </p>
                        <p>Используя накопленный за многие годы опыт работы с крупными мировыми корпорациями, мы создаем
                           творческие инновации, которые обеспечивают реальные результаты. Прокрутите вниз, чтобы узнать
                           немного о том, кто делает все это.</p>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="about-bg">
                        <img src="img/about/o_nas_text_block.jpg" alt=""/>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Основные направления -->
    <section class="service-area pt-90 pb-60 bg-color">
        <div class="container">
            <div class="row">
                <div class="section-heading text-center mb-70">
                    <h2>Основные направления</h2>
                    <p>Всё что нужно для производства сайта любой сложности</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="single-service brand-hover radius-4 mb-30 text-center">
                        <div class="service-icon">
                            <span class="icon-tools " aria-hidden="true"></span>
                        </div>
                        <div class="service-text">
                            <h3>Web-дизайн</h3>
                            <p>Создание индивидуальной концепции, от лаконичных решений до сложных динамических
                               элементов.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="single-service brand-hover radius-4 mb-30 text-center">
                        <div class="service-icon">
                            <span class="icon-mobile" aria-hidden="true"></span>
                        </div>
                        <div class="service-text">
                            <h3>Frontend</h3>
                            <p>Красивая и отзывчивая <b>frontend</b> часть сайта, которая будет отлично работать на всех
                               разрешениях и устройствах.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="single-service brand-hover radius-4 mb-30 text-center">
                        <div class="service-icon">
                            <span class="icon-tools-2" aria-hidden="true"></span>
                        </div>
                        <div class="service-text">
                            <h3>Backend</h3>
                            <p>Стабильный и быстрый <b>backend</b> сайта с гибкой админкой и высоким уровнем безопасности.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Инфографика -->
    <section class="project-count-area brand-bg pad-90">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <div class="single-count white-text text-center">
                        <span class="icon-briefcase "></span>
                        <h2 class="counter">360</h2>
                        <p>Готовых проектов</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="single-count white-text text-center">
                        <span class="icon-wine "></span>
                        <h2 class="counter">690</h2>
                        <p>Чашек кофе выпито</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="single-count white-text text-center">
                        <span class="icon-lightbulb"></span>
                        <h2 class="counter">420</h2>
                        <p>Воплотили супер-йдей</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="single-count white-text text-center">
                        <span class="icon-happy"></span>
                        <h2 class="counter">115</h2>
                        <p>Счастливых клиентов</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Наши работы -->


    <section class="work-area pt-90 pb-60" id="portfolio">
        <div class="container">
            <div class="row">
                <div class="section-heading text-center mb-70">
                    <h2>Портфолио</h2>
                    <p>Лучший способ найти хорошую команду - это посмотреть результаты её работы</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="portfolio-menu brand-filter text-center mb-70">
                        <div class="filter" data-filter="all">Все</div>
                        <div class="filter" data-filter=".landing">Лендинги</div>
                        <div class="filter" data-filter=".internet_shop">Интренет магазины</div>
                        <div class="filter" data-filter=".promo">Промо сайты</div>
                        <div class="filter" data-filter=".corporative_site">Корпоративные порталы</div>
                    </div>
                </div>
                <div id="Container">
                    <div class="col-md-4 col-sm-6 col-xs-12 mb-30 mix landing promo">
                        <div class="portfolio-wrapper portfolio-title">
                            <div class="portfolio-img">
                                <img src="img/portfolio/1.jpg" alt=""/>
                                <div class="work-text brand-bg">
                                    <div class="inner-text">
                                        <a class="view-portfolio image-link" href="img/portfolio/1.jpg">
                                            <span class="plus"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="portfolio-heading pd-15">
                                <h4 class="mb-10">
                                    <a href="#">Green Planet</a>
                                </h4>
                                <h5 class="m-0">Дизайн</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 mb-30 mix internet_shop corporative_site">
                        <div class="portfolio-wrapper portfolio-title">
                            <div class="portfolio-img">
                                <img src="img/portfolio/2.jpg" alt=""/>
                                <div class="work-text brand-bg">
                                    <div class="inner-text">
                                        <a class="view-portfolio image-link" href="img/portfolio/2.jpg">
                                            <span class="plus"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="portfolio-heading pd-15">
                                <h4 class="mb-10">
                                    <a href="#">Creative developer</a>
                                </h4>
                                <h5 class="m-0">Разработка лендинга</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 mb-30 mix landing">
                        <div class="portfolio-wrapper portfolio-title">
                            <div class="portfolio-img">
                                <img src="img/portfolio/3.jpg" alt=""/>
                                <div class="work-text brand-bg">
                                    <div class="inner-text">
                                        <a class="view-portfolio image-link" href="img/portfolio/3.jpg"><span class="plus"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="portfolio-heading pd-15">
                                <h4 class="mb-10">
                                    <a href="portfolio_online_shop.html">Dress & Jeans</a>
                                </h4>
                                <h5 class="m-0">Разработка интернет-магазина</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 mb-30 mix internet_shop">
                        <div class="portfolio-wrapper portfolio-title">
                            <div class="portfolio-img">
                                <img src="img/portfolio/4.jpg" alt=""/>
                                <div class="work-text brand-bg">
                                    <div class="inner-text">
                                        <a class="view-portfolio image-link" href="img/portfolio/4.jpg"><span
                                                class="plus"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="portfolio-heading pd-15">
                                <h4 class="mb-10">
                                    <a href="portfolio_landing.html">Mountain King</a>
                                </h4>
                                <h5 class="m-0">Разработка сайта визитки</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 mb-30 mix corporative_site">
                        <div class="portfolio-wrapper portfolio-title">
                            <div class="portfolio-img">
                                <img src="img/portfolio/5.jpg" alt=""/>
                                <div class="work-text brand-bg">
                                    <div class="inner-text">
                                        <a class="view-portfolio image-link" href="img/portfolio/5.jpg">
                                            <span class="plus"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="portfolio-heading pd-15">
                                <h4 class="mb-10">
                                    <a href="#">Beauty SPA</a>
                                </h4>
                                <h5 class="m-0">Разработка сайта визитки</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 mb-30 mix promo">
                        <div class="portfolio-wrapper portfolio-title">
                            <div class="portfolio-img">
                                <img src="img/portfolio/6.jpg" alt=""/>
                                <div class="work-text brand-bg">
                                    <div class="inner-text">
                                        <a class="view-portfolio image-link" href="img/portfolio/6.jpg"><span class="plus"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="portfolio-heading pd-15">
                                <h4 class="mb-10">
                                    <a href="#">Bent Application</a>
                                </h4>
                                <h5 class="m-0">Разработка лендинга</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <!-- Отзывы клиентов -->
    <section class="testimonial-area bg-color pad-90">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="testimonial-active dots-style">
                        <div class="single-testimonial black-text text-center">
                            <div class="testimonial-title">
                                <span class="icon-quote"></span>
                                <h3 class="black-text">Сроки не проблема!</h3>
                            </div>
                            <p><span>"</span>Спасут любой проект с самыми горящими сроками! Ребята действительно
                                             профессионалы своего дела.<span>"</span>
                            </p>
                            <div class="testimonial-author text-uppercase">
                                <span>- Андрей Александров, Best Shop.</span>
                            </div>
                        </div>
                        <div class="single-testimonial black-text text-center">
                            <div class="testimonial-title">
                                <span class="icon-quote"></span>
                                <h3 class="black-text">Это взрыв!</h3>
                            </div>
                            <p><span>"</span>Я рад, что мы получили такой классный продукт на выходе!
                                             Думаю, что совместными усилиями мы реализуем ещё не один
                                             проект.<span>"</span></p>
                            <div class="testimonial-author text-uppercase">
                                <span>- Виталий Нохрин, NA'MAN Rec.</span>
                            </div>
                        </div>
                        <div class="single-testimonial black-text text-center">
                            <div class="testimonial-title">
                                <span class="icon-quote"></span>
                                <h3 class="black-text">Большая удача?</h3>
                            </div>
                            <p><span>"</span>Мы нашли WeCoders после десятка неудачных проектов с другими web студиями. И…
                                             Это большая удача, <span>"</span></p>
                            <div class="testimonial-author text-uppercase">
                                <span>- Ирина Граф, Cars & Cars company</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>