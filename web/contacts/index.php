<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Контакты');
$APPLICATION->SetPageProperty('title', 'We coders | Контакты');
?>

    <!-- Контакты + ФОС -->
    <div class="contact-form pt-90 pb-30">
        <div class="container">
            <div class="row">
                <div class="section-heading text-center mb-70">
                    <h2>Нужен классный сайт?</h2>
                    <p>Оставьте заявку в форме ниже и мы всё сделаем!</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="contact-info">
                        <address>
                            <ul>
                                <li>
                                    <i aria-hidden="true" class="fa fa-map-marker brand-color"></i>
                                    <div class="address">
                                        Мы находимся по адресу:
                                        <hr>
                                        <p>г. Тюмень, ул. Республики 94, офис 23</p>
                                    </div>
                                </li>
                                <li>
                                    <i aria-hidden="true" class="fa fa-phone brand-color"></i>
                                    <div class="phone">
                                        <p>8-123-456-7899</p>
                                    </div>
                                </li>
                                <li>
                                    <i class="fa fa-envelope brand-color"></i>
                                    <div class="mail">
                                        <p>
                                            <a href="mailto:#">wecoders@wecodres.com</a>
                                        </p>
                                    </div>
                                </li>
                                <li></li>
                            </ul>
                        </address>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <form id="contact-form" class="default-form" action="#" method="post">
                            <div class="col-md-4 col-sm-6">
                                <input name="name" type="text" placeholder="Имя"/>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <input name="email" type="email" placeholder="Email"/>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <input name="subject" type="text" placeholder="Телефон"/>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <textarea name="message" cols="30" rows="10" placeholder="Сообщение"></textarea>
                                <button class="btn mt-30">Отправить</button>
                            </div>
                        </form>
                        <p class="form-messege"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Карта -->
    <div class="map-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="map" class="mtb-90"></div>
                </div>
            </div>
        </div>
    </div>

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>