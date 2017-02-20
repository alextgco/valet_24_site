<?php

/*
    Template Name: account
*/

    session_start();
    $PHPSESSID=session_id();

    $f_url = $global_prot . '://' . $global_url. '/site_api';

    $f_req = '{"command":"get_favorite","params":{}}';

    $f_post_data = http_build_query(array(
        'sid' => $PHPSESSID,
        'site' => $global_site,
        'json' => $f_req
    ));

    $f_ch = curl_init();

    curl_setopt($f_ch, CURLOPT_URL, $f_url );
    curl_setopt($f_ch, CURLOPT_POST, 1 );
    curl_setopt($f_ch, CURLOPT_POSTFIELDS, $f_post_data);
    curl_setopt($f_ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($f_ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($f_ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($f_ch, CURLOPT_TIMEOUT, 10);

    $f_resp = curl_exec($f_ch);

    if (curl_errno($f_ch)) {
        print curl_error($f_ch);
    }
    curl_close($f_ch);

    $f_jData = json_decode($f_resp, true);


    $f_columns = $f_jData['data_columns'];
//    $f_data = $f_jData['data'];


//-----------GET BASKETS--------------


    $o_req = '{"command":"get_orders","params":{}}';

    $o_post_data = http_build_query(array(
        'sid' => $PHPSESSID,
        'site' => $global_site,
        'json' => $o_req
    ));

    $o_ch = curl_init();

    curl_setopt($o_ch, CURLOPT_URL, $f_url );
    curl_setopt($o_ch, CURLOPT_POST, 1 );
    curl_setopt($o_ch, CURLOPT_POSTFIELDS, $o_post_data);
    curl_setopt($o_ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($o_ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($o_ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($o_ch, CURLOPT_TIMEOUT, 10);

    $o_resp = curl_exec($o_ch);

    if (curl_errno($o_ch)) {
        print curl_error($o_ch);
    }
    curl_close($o_ch);

    $o_jData = json_decode($o_resp, true);

    $o_columns = $o_jData['data_columns'];




?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Доставка продуктов без комиссии!</title>
    <link href="<?php echo get_stylesheet_directory_uri() ?>/assets/img/favicon.png" rel="shortcut icon"
          type="image/i-icon">
    <?php include 'head_css.php'; ?>

</head>
<body data-user="<?php echo $user_exists?>">
<?php
include 'header.php';
?>


<script type="text/javascript">
    if(!<?php var_export($user_exists);?>){
        document.location.href = '/';
    }
</script>

<div class="site-content">

    <div class="container">

        <div class="row posRel">

            <div class="category-title-nomargin">Личный кабинет</div>
            <div class="account-edit" data-id="<?php echo $user_jData['user']['id'];?>">Редактировать аккаунт</div>
            <div class="account-exit" data-id="<?php echo $user_jData['user']['id'];?>">Выйти</div>
        </div>

        <div class="row">

            <div class="account-content-holder">

                <div class="col-sm-8 col-md-8 orders-holder">

                    <h3><i class="fa fa-bars"></i>&nbsp;&nbsp;Ваши заказы:</h3>
                    <div class="inline-help">
                        Вы можете положить один или несколько Ваших заказов в корзину целиком или
                        выбрать из них несколько товаров, попробуйте сами!
                    </div>


                    <div class="carts-list">



                        <?php

                        $orders_html = '';
                        $orders_count = 0;

                        foreach($o_jData['data'] as $cp_key=>$cp_value){

                            $o_id = $cp_value[array_search('id', $o_columns)];
                            $o_date = $cp_value[array_search('order_date', $o_columns)];
                            $o_amount = $cp_value[array_search('amount', $o_columns)];

                            $orders_html .= '<div class="c-item-wrapper posRel">'.
                                                '<div class="c-item-date">'.$o_date.'. На сумму '.$o_amount.' руб.</div>'.
                                                '<div class="c-item-btns-holder">'.
                                                    '<div class="c-item-open pa-s-button" data-id="'.$o_id.'">Смотреть товары</div>'.
                                                    '<div class="c-item-to-basket pa-s-button" data-id="'.$o_id.'"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;В корзину</div>'.
                                                '</div>'.
                                                '<div class="c-item-dd">'.
                                                    '<div class="cart-list-holder" data-id="'.$o_id.'"></div>'.
                                                '</div>'.
                                            '</div>';
                            $orders_count++;

                        }


                        echo $orders_html;

                        if($orders_count == 0){

                            echo '<div class="no-favorites">Список заказов пока пуст.</div>';

                        }

                        ?>





                    </div>
                </div>

                <div class="col-sm-4 col-md-4 cart-total-holder">

                    <h3><i style="color: #007cfb;" class="fa fa-heart-o"></i>&nbsp;&nbsp;Избранные товары:</h3>
                    <div class="inline-help">
                        Отмечайте понравившиеся Вам товары, они будут храниться здесь, Вы всегда сможете быстро
                        добавить их в корину!
                    </div>

                    <div class="favorites-list cart-sidebar-items">
                        <?php

                        $cart_products_html = '';
                        $f_count = 0;

                        foreach($f_jData['data'] as $cp_key=>$cp_value){


                            $cart_products_html .= render_product($cp_value, 'favorite', $f_columns);
                            $f_count++;

                        }

                        echo $cart_products_html;

                        if($f_count == 0){

                            echo '<div class="no-favorites">Список избранного пока пуст.</div>';

                        }

                        ?>
                    </div>

                </div>

            </div>

            </div>


        </div>


    </div>

    <?php

    include 'footer.php';
    include 'foot_js.php';
    ?>



</body>
</html>