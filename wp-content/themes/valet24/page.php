<?php

//    $href = request_url();
//    $arr = parse_url($href);
//    $action_alias = preg_replace('/^\//','',$arr['path']);
//    $action_alias = preg_replace('/(^\w+)\/.*/','$1',$action_alias);

    session_start();
    $PHPSESSID=session_id();

    $url = $global_prot . '://' . $global_url. '/site_api';

    $post_data = http_build_query(array(
        'sid' => $PHPSESSID,
        'site' => $global_site,
        'json' => '{"command":"get_category","params":{"is_root":true}}'
    ));

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url );
    curl_setopt($ch, CURLOPT_POST, 1 );
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $resp = curl_exec($ch);

    if (curl_errno($ch)) {
        print curl_error($ch);
    }
    curl_close($ch);


    $jData = json_decode($resp, true);

    $columns = $jData['data_columns'];
    $data = $jData['data'];

//echo '<pre>';
//var_dump($jData['data_columns']);
//var_dump($jData['data']);
//echo '-----------------';
//    var_dump($data);
//
//?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Доставка продуктов без комиссии!</title>

    <link href="<?php echo get_stylesheet_directory_uri() ?>/assets/img/favicon.png" rel="shortcut icon" type="image/i-icon">

    <?php include 'head_css.php'; ?>


</head>
<body>

<?php include 'header.php'; ?>

<div class="after-header">
    <div class="container">
        <div class="main-greetings">
<!--            Добро пожаловать в наш онлайн супермаркет!<br/>-->
            <div class="feature-1"><i class="feature-icon fa fa-clock-o"></i>&nbsp;&nbsp;Доставим Ваш заказ за <span class="feature-number">59</span> минут!</div>
            <div class="feature-2"><i class="feature-icon fa fa-money"></i>&nbsp;&nbsp;Доставка <span class="feature-number">150</span> рублей!</div>
            <div class="feature-3"><i class="feature-icon fa fa-thumbs-o-up"></i>&nbsp;&nbsp;Гарантия качества и свежести!</div>
        </div>
    </div>
</div>

<div class="site-content">

    <div class="container">

        <div class="main-page-headline">Выбирайте, мы привезем!</div>

        <div class="row">

<!--            <div class="col-md-2">-->
<!--                <div class="cat-item" data-id="123">-->
<!--                    <div class="cat-image-holder"><img src="--><?php //echo get_stylesheet_directory_uri() ?><!--/assets/img/cat-1.jpg" /></div>-->
<!--                    <div class="cat-title-holder">-->
<!--                        Пакеты-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

            <?php

            $cats_html = '';

            foreach($data as $key => $value){

                $id = $value[array_search('id',$columns)];
                $name = $value[array_search('name',$columns)];
                $image = (strlen($value[array_search('image',$columns)]) > 0) ? $value[array_search('image',$columns)] : $global_images_dir . 'cat-default.jpg';

                $alt_name = (strpos($image, 'cat-default.jpg'))? 'name-visible' : '';

//                var_dump($value);


                $cats_html .= '<div class="col-md-2 notd">'.
                                    '<a href="/category_'.$id.'/"><div class="cat-item '.$alt_name.'" data-id="'.$id.'">'.
                                        '<div class="cat-image-holder"><img src="'.$image.'" alt=" '.$name.'"/></div>'.
                                        '<div class="cat-title-holder">'.$name.'</div>'.
                                    '</div></a>'.
                                '</div>';

            }

            echo $cats_html;


            ?>




        </div>

        <div class="row">

            <?php include 'sets.php'; ?>

        </div>


    </div>



</div>

<?php

include 'footer.php';
include 'foot_js.php';

?>
<!--SCRIPTS-->


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

</body>
</html>