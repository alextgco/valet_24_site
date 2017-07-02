<?php

/*
    Template Name: about
*/

        $href = request_url();
        $arr = parse_url($href);
        $action_alias = preg_replace('/^\//','',$arr['path']);
        $action_alias = preg_replace('/(^\w+)\/.*/','$1',$action_alias);

        $category_full = preg_replace('/(^\w+)\/.*/','$1',$action_alias);
        $category_id = preg_replace('/category_/','$1', $category_full);



        $url = $global_prot . '://' . $global_url. '/site_api';

        $req = '{"command":"get_category","params":{}}';

        $post_data = http_build_query(array(
            'site' => $global_site,
            'json' => $req
        ));

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url );
        curl_setopt($ch, CURLOPT_POST, 1 );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_TIMEOUT,10);
        $resp = curl_exec($ch);

        if (curl_errno($ch)) {
            print curl_error($ch);
        }
        curl_close($ch);


        $jData = json_decode($resp, true);

        $columns = $jData['data_columns'];
        $data = $jData['data'];

        //        "id",
        //        "name",
        //        "is_root",
        //        "parent_category_id",
        //        "parent_category",
        //        "image",
        //        "products_count",

        $children_arr = array();
        $products_arr = array();

        foreach($data as $key=>$category){

            $id = $category[array_search('id',$columns)];
            $name = $category[array_search('name',$columns)];
            $is_root = $category[array_search('is_root',$columns)];
            $parent_category_id = $category[array_search('parent_category_id',$columns)];
            $parent_category = $category[array_search('parent_category',$columns)];
            $image = $category[array_search('image',$columns)];
            $products_count = $category[array_search('products_count',$columns)];


            if($id == $category_id){
                $current_category = $category;
            }

            if($parent_category_id == $category_id){

                array_push($children_arr, $category);

            }

        }

    $page_id = get_the_ID();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Доставка продуктов за 1 час!</title>
    <link href="<?php echo get_stylesheet_directory_uri() ?>/assets/img/favicon.png" rel="shortcut icon" type="image/i-icon">
    <?php include 'head_css.php'; ?>

    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/assets/css/about.css" />
    <script src="https://api-maps.yandex.ru/1.1/index.xml" type="text/javascript"></script>
</head>
<body>
<?php
include 'header.php';
?>


<div class="site-content" style="background-color: #fff;background-image: none;">

    <div class="row">

        <div class="container">





<!--            <div id="YMapsID" style="width:600px;height:400px"></div>-->

            <script type="text/javascript">
                // Создает обработчик события window.onLoad
                YMaps.jQuery(function () {
                    // Создает экземпляр карты и привязывает его к созданному контейнеру
                    var map = new YMaps.Map(YMaps.jQuery("#YMapsID")[0]);

                    // Устанавливает начальные параметры отображения карты: центр карты и коэффициент масштабирования
                    map.setCenter(new YMaps.GeoPoint(55.75399400, 37.62209300), 16);
                })
            </script>





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

            <a href="/" class="about-cta">Перейти в магазин</a>

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

            <img style="    margin: 0 auto;display: block;margin-top: 30px;width: 360px;" alt="valet24.ru удобный интерфейс для заказа доставки продуктов по районам Гагаринский, Академический, Ломоносовский, Черемушки" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/about-lk.png" />

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

            <a href="/" class="about-cta">Перейти в магазин</a>

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
            <a class="cta-link" href="/">Перейти к выбору продуктов</a>


        </div>

    </div>

</div>

<?php

include 'footer.php';
include 'foot_js.php';
?>

<!--SCRIPTS-->

<script type="text/javascript">

    var map = new YMaps.Map(YMaps.jQuery("#YMapsID")[0]);

    map.setCenter(new YMaps.GeoPoint(55.75399400, 37.62209300), 10);


</script>



<!--<script type="text/javascript" src="--><?php //echo get_stylesheet_directory_uri() ?><!--/assets/plugins/jquery/jquery-1.12.0.min.js"></script>-->
<!---->
<!---->
<!--<script type="text/javascript" src="assets/plugins/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>-->
<!--<script type="text/javascript" src="assets/plugins/blur/blur.js"></script>-->
<!--<script type="text/javascript" src="assets/plugins/mb-chekbox/mb-checkbox.js"></script>-->
<!--<script type="text/javascript" src="assets/plugins/mustache/mustache.js"></script>-->
<!--<script type="text/javascript" src="assets/plugins/ion.rangeSlider-2.1.2/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>-->
<!---->
<!--<script type="text/javascript" src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>-->
<!--<script type="text/javascript" src="assets/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.ru.min.js"></script>-->
<!---->
<!--<script type="text/javascript" src="assets/js/core.js"></script>-->
<!---->
<!--<script type="text/javascript" src="--><?php //echo get_stylesheet_directory_uri() ?><!--/assets/js/script.js"></script>-->

</body>
</html>