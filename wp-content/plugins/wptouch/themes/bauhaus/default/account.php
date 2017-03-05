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



$cc_name = 'Личный кабинет';

?>

<?php if ( foundation_is_theme_using_module( 'custom-latest-posts' ) && wptouch_fdn_is_custom_latest_posts_page() ) { ?>

    <?php wptouch_fdn_custom_latest_posts_query(); ?>
    <?php get_template_part( 'index' ); ?>

<?php } else { ?>


    <?php

    include 'basket_top.php';
    include 'header-account.php';

    ?>


<?php } ?>







<div class="site-content">

    <div class="container">

    <div class="row">





    <div class="tabsParent mmb-tabsParent sc_tabulatorParent" style="display: block;">
        <div class="tabsTogglersRow sc_tabulatorToggleRow">

            <div class="tabToggle sc_tabulatorToggler opened" dataitem="0" title="" style="width: 50%;">
                <span class=""><i class="fa fa-bars"></i>&nbsp;&nbsp;Ваши заказы</span>
            </div>

            <div class="tabToggle sc_tabulatorToggler" dataitem="1" title=""  style="width: 50%;">
                <span class=""><i class="fa fa-heart-o"></i>&nbsp;&nbsp;Избранное</span>
            </div>

        </div>

        <div class="ddRow notZindexed sc_tabulatorDDRow">

            <div class="tabulatorDDItem sc_tabulatorDDItem  noMaxHeight chromeScroll opened" dataitem="0">

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
                                            '<div class="c-item-date-holder">'.
                                                '<div class="c-item-circle"></div>'.
                                                '<div class="c-item-prefix">Заказ</div>'.
                                                '<div class="c-item-date">'.$o_date.'. На сумму '.$o_amount.' руб.</div>'.
                                            '</div>'.
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

            <div class="tabulatorDDItem sc_tabulatorDDItem  noMaxHeight chromeScroll" dataitem="1">


                <div class="inline-help">
                    Отмечайте понравившиеся Вам товары кликнув на <i class="fa fa-heart-o"></i>, они будут храниться здесь, Вы всегда сможете быстро
                    добавить их в корину!
                </div>

                <div class="favorites-list">

                    <?php

                    $f_count = 0;

                    $cart_products_html = '';



                    foreach($f_jData['data'] as $cp_key=>$cp_value){

                        $cart_products_html .= render_product_m($cp_value, 'favorite', $f_columns);

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


</div>
</body>
</html>

