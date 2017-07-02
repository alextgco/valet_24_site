<?php



$page_id = get_the_ID();
?>

<?php if ( foundation_is_theme_using_module( 'custom-latest-posts' ) && wptouch_fdn_is_custom_latest_posts_page() ) { ?>

    <?php wptouch_fdn_custom_latest_posts_query(); ?>
    <?php get_template_part( 'index' ); ?>

<?php } else { ?>


    <?php

    include 'basket_top.php';
    include 'header-inner.php';

    ?>


<?php } ?>


<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/assets/css/about.css" />

<a  class="go-shop-link" href="/shop/">ПЕРЕЙТИ В МАГАЗИН</a>

<div class="site-content prepare-order-page">


    <div class="row">

        <div class="container">

            <div class="about-row">
                <img alt="valet24.ru круглосуточная доставка продуктов по районам Гагаринский, Академический, Ломоносовский, Черемушки" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/about_1.png" />
            </div>

        </div>

        <div class="about-wave"></div>

        <div class="container">

            <div class="f-konkord">
                КРУГЛОСУТОЧНЫЙ ЭКСПРЕСС СЕРВИС<br/>
                ДОСТАВКИ ПРОДУКТОВ
            </div>

            <a href="/shop/" class="about-cta">Перейти в магазин</a>

        </div>

        <div class="about-wave"></div>

        <div class="container">

            <div class="f-stampbor">
                БЫСТРЫЙ
            </div>

            <img style="margin: 0 auto;display: block;" alt="valet24.ru быстрая доставка продуктов по районам Гагаринский, Академический, Ломоносовский, Черемушки" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/about-fast.png" />

            <div class="f-nexa">
                Привезу <span style="color: red;">Ваш</span> заказ уже через час  после подтверждения
            </div>

            <div class="about-wave-2"></div>

            <div class="f-stampbor">
                ПРОСТОЙ
            </div>

            <img style="margin: 0 auto;display: block;" alt="valet24.ru простой выбор продуктов на доставку по районам Гагаринский, Академический, Ломоносовский, Черемушки" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/about-easy.png" />

            <div class="f-nexa">
                Современный  и наглядный  интерфейс сайта делает<br/>
                процесс заказа простым и приятным
            </div>

            <div class="about-wave-2"></div>

            <div class="f-stampbor">
                УДОБНЫЙ
            </div>

            <img style="    margin: 0 auto;display: block;margin-top: 30px;width: 100%;" alt="valet24.ru удобный интерфейс для заказа доставки продуктов по районам Гагаринский, Академический, Ломоносовский, Черемушки" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/about-lk.png" />

            <div class="f-nexa">
                <span style="color: red;">Ваши</span> заказы сохраняются в истории, а<br/>
                любимые продукты можно добавить в избранное,<br/>
                благодаря личному кабинету оформление<br/>
                заказа занимает пару минут!
            </div>

            <div class="about-wave-2"></div>

            <div class="f-stampbor" style="    color: #282828;font-size: 2em;line-height: 48px;">
                У МЕНЯ <span style="color: red;">НЕТ ОГРАНИЧЕНИЙ</span> НА СУММУ ПОКУПКИ,<br/>
                ВЫ МОЖЕТЕ ЗАКАЗАТЬ<br/>
                КАК ПАКЕТ МОЛОКА, ТАК И МЕСЯЧНЫЙ ЗАПАС ПРОДУКТОВ
            </div>

            <a href="/shop/" class="about-cta">Перейти в магазин</a>

            <div class="about-wave-3"></div>

            <div class="f-marske">
                <span style="color: red;">8</span> ПРИЧИН<br/>
                ПОДРУЖИТЬСЯ<br/>
                СО МНОЙ
            </div>

            <div class="about-wave-3"></div>

            <div style="width: 80%; margin: 0 auto;" class="about-reasons">

                <div class="row">
                    <div class="col-md-5">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/about-r-1.png">
                    </div>
                    <div class="col-md-7 about-text-block">
                        Доставлю <span style="color: red;">Ваш</span> заказ<br/>
                        в любую погоду,<br/>
                        будь то жара<br/>
                        или лютый мороз
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/about-r-2.png">
                    </div>
                    <div class="col-md-7 about-text-block">
                        Со мной<br/>
                        <span style="color: red;">Вы</span> забудете<br/>
                        о неловком и<br/>
                        раздражающем<br/>
                        ожидании в очередях
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/about-r-3.png">
                    </div>
                    <div class="col-md-7 about-text-block">
                        <span style="color: red;">Вы</span> не дожны<br/>
                        носить пакеты,<br/>
                        это Вас должны носить<br/>
                        ваши кавалеры
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/about-r-4.png">
                    </div>
                    <div class="col-md-7 about-text-block">
                        Если нагрянут гости,<br/>
                        <span style="color: red;">Вам</span> не придётся<br/>
                        бежать в магазин,<br/>
                        я всё устрою
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-5">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/about-r-5.png">
                    </div>
                    <div class="col-md-7 about-text-block">
                        Если <span style="color: red;">Вы</span><br/>
                        утомились  на работе,<br/>
                        а в холодильнике хоть<br/>
                        шаром покати
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/about-r-6.png">
                    </div>
                    <div class="col-md-7 about-text-block">
                        Помогу <span style="color: red;">Вам</span><br/>
                        позаботиться  о близких ,<br/>
                        не отвлекаясь от дел
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/about-r-7.png">
                    </div>
                    <div class="col-md-7 about-text-block">
                        Буду незаменим,<br/>
                        если <span style="color: red;">Вы</span> решите устроить<br/>
                        лёгкий романтический ужин<br/>
                        среди ночи
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/about-r-8.png">
                    </div>
                    <div class="col-md-7 about-text-block">
                        Сэкономлю  <span style="color: red;">Вам</span> время<br/>
                        на дела поважнее,<br/>
                        чем хождение по магазинам
                    </div>
                </div>

            </div>

            <div class="f-stampbor-big">
                ЗАКАЗЫВАЙТЕ!
            </div>
            <a class="cta-link" href="/shop/">Перейти к выбору продуктов</a>


        </div>

    </div>


</div>

<?php

include 'footer.php';
include 'foot_js.php';
?>


</body>
</html>
