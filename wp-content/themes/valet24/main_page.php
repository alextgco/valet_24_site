<?php

/*
    Template Name: main_page
*/

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
curl_setopt($ch,CURLOPT_TIMEOUT,10);
$resp = curl_exec($ch);

if (curl_errno($ch)) {
    print curl_error($ch);
}
curl_close($ch);


$jData = json_decode($resp, true);

$columns = $jData['data_columns'];
$data = $jData['data'];


//---SETS----------------------------

$post_data2 = http_build_query(array(
    'sid' => $PHPSESSID,
    'site' => $global_site,
    'json' => '{"command":"get_sets","params":{}}'
));

$ch2 = curl_init();

curl_setopt($ch2, CURLOPT_URL, $url );
curl_setopt($ch2, CURLOPT_POST, 1 );
curl_setopt($ch2, CURLOPT_POSTFIELDS, $post_data2);
curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch2,CURLOPT_TIMEOUT,10);
$resp2 = curl_exec($ch2);

if (curl_errno($ch2)) {
    print curl_error($ch2);
}
curl_close($ch2);


$jData2 = json_decode($resp2, true);

$columns2 = $jData2['data_columns'];
$data2 = $jData2['data'];



    //---ACTION PRODUCTS----------------------------

//    $post_data3 = http_build_query(array(
//        'sid' => $PHPSESSID,
//        'site' => $global_site,
//        'json' => '{"command":"get_action_product","params":{}}'
//    ));
//
//    $ch3 = curl_init();
//
//    curl_setopt($ch3, CURLOPT_URL, $url );
//    curl_setopt($ch3, CURLOPT_POST, 1 );
//    curl_setopt($ch3, CURLOPT_POSTFIELDS, $post_data3);
//    curl_setopt($ch3, CURLOPT_SSL_VERIFYHOST, 0);
//    curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, 0);
//    curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);
//    curl_setopt($ch3,CURLOPT_TIMEOUT,10);
//    $resp3 = curl_exec($ch3);
//
//    if (curl_errno($ch3)) {
//        print curl_error($ch3);
//    }
//    curl_close($ch3);
//
//
//    $jData3 = json_decode($resp3, true);
//
//    $action_products_columns = $jData3['data_columns'];
//    $action_products_data = $jData3['data'];




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
    <title>Доставка продуктов за 1 час!</title>

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
            <div class="feature-3"><i class="feature-icon fa fa-phone"></i>&nbsp;&nbsp;Заказывайте по телефону!</div>
        </div>
    </div>
</div>

<div class="site-content">

    <div class="container">

        <div class="main-page-headline">Выбирайте, мы привезем!</div>


    </div>

    <?php include 'action_products.php'; ?>

    <div class="container">


        <div class="main-page-headline">Категории товаров:</div>

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


                $cats_html .= '<div class="col-sm-3 col-md-2 notd">'.
                    '<a href="/category_'.$id.'/"><div class="cat-item '.$alt_name.'" data-id="'.$id.'">'.
                    '<div class="cat-image-holder"><img src="'.get_stylesheet_directory_uri().'/assets/img/'.$image.'" alt=" '.$name.'"/></div>'.
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


</body>
</html>