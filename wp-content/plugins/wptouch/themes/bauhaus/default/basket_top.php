<div class="site-fader-holder">

    <div class="container posRel">
        <div class="site-fader-close"></div>
        <div class="site-fader-content">

        </div>
    </div>
</div>

<?php
/**
 * Created by PhpStorm.
 * User: aig
 * Date: 07.08.2016
 * Time: 20:31
 */

    session_start();
    $PHPSESSID=session_id();

    $cart_url = $global_prot . '://' . $global_url. '/site_api';

    $cart_req = '{"command":"get_cart","params":{}}';

    $cart_post_data = http_build_query(array(
        'sid' => $PHPSESSID,
        'site' => $global_site,
        'json' => $cart_req
    ));

    $cart_ch = curl_init();

    curl_setopt($cart_ch, CURLOPT_URL, $cart_url );
    curl_setopt($cart_ch, CURLOPT_POST, 1 );
    curl_setopt($cart_ch, CURLOPT_POSTFIELDS, $cart_post_data);
    curl_setopt($cart_ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($cart_ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($cart_ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($cart_ch,CURLOPT_TIMEOUT,10000);

    $cart_resp = curl_exec($cart_ch);

    if (curl_errno($cart_ch)) {
        print curl_error($cart_ch);
    }
    curl_close($cart_ch);

    $cart_jData = json_decode($cart_resp, true);

    $cart_products_count = $cart_jData['product_count'];
    $cart_amount = $cart_jData['amount'];

?>


<link href="http://valet24.ru/wp-content/themes/valet24/assets/img/favicon.png" rel="shortcut icon" type="image/i-icon">
<title>Valet24 | Круглосуточная курьерская служба</title>


<a href="/cart">
    <div class="cart-holder">
        <div class="cart-title">Корзина:</div>
        <div class="cart-value">

        <?php

            $itemsWord = getNoun($cart_products_count, 'Товар', 'Товара', 'Товаров');

            if($cart_products_count > 0){
                echo '<span class="cart-products-count">'.$cart_products_count.' '.$itemsWord.'</span><span class="cart-amount-holder">'.$cart_amount.'&nbsp;<i class="fa fa-ruble"></i></span>';
            }else{
                echo '<span class="cart-products-count">0 Товаров</span><br/><span class="cart-amount-holder first-time-update">0.00&nbsp;<i class="fa fa-ruble"></i></span>';
            }

        ?>



        </div>
        <div class="to-top">Наверх</div>
    </div>
</a>


