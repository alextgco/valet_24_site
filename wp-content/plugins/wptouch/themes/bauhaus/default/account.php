<?php

/*
    Template Name: account
*/

$cc_name = 'Личный кабинет';

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

                    <div class="c-item-wrapper">
                        <div class="c-item-date-holder">
                            <div class="c-item-circle"></div>
                            <div class="c-item-prefix">Заказ</div>
                            <div class="c-item-date">16 января, 14:35. На сумму 1596.00 р.</div>
                        </div>

                        <div class="c-item-second-row">

                            <div class="c-item-images-list">
                                <div class="c-item-img"><img src="/images_new/IMG_2364_frukti_ovoshi.jpg" alt=""/></div>
                                <div class="c-item-img"><img src="/images_new/IMG_1745_siri.jpg" alt=""/></div>
                                <div class="c-item-img"><img src="/images_new/IMG_7628_alko.jpg" alt=""/></div>
                            </div>

                            <div class="c-item-btns-holder">
                                <div class="c-item-open pa-s-button"><i class="fa fa-eye"></i>&nbsp;&nbsp;Смотреть товары</div>
                                <div class="c-item-to-basket pa-s-button"><i class="fa fa-cart-arrow-down"></i>&nbsp;&nbsp;Положить в корзину</div>
                            </div>

                        </div>

                        <div class="c-item-dd">

                            <div class="cart-list-holder">

                                <?php

                                $cart_products_html = '';

                                foreach($cart_jData['products'] as $cp_key=>$cp_value){

                                    $cart_products_html .= render_product_m($cp_value, 'cart');

                                }

                                echo $cart_products_html;

                                ?>
                            </div>

                        </div>
                    </div>

                    <div class="c-item-wrapper">
                        <div class="c-item-date-holder">
                            <div class="c-item-circle"></div>
                            <div class="c-item-prefix">Заказ</div>
                            <div class="c-item-date">16 января, 14:35. На сумму 1596.00 р.</div>
                        </div>

                        <div class="c-item-second-row">

                            <div class="c-item-images-list">
                                <div class="c-item-img"><img src="/images_new/IMG_2364_frukti_ovoshi.jpg" alt=""/></div>
                                <div class="c-item-img"><img src="/images_new/IMG_1745_siri.jpg" alt=""/></div>
                                <div class="c-item-img"><img src="/images_new/IMG_7628_alko.jpg" alt=""/></div>
                            </div>

                            <div class="c-item-btns-holder">
                                <div class="c-item-open pa-s-button"><i class="fa fa-eye"></i>&nbsp;&nbsp;Смотреть товары</div>
                                <div class="c-item-to-basket pa-s-button"><i class="fa fa-cart-arrow-down"></i>&nbsp;&nbsp;Положить в корзину</div>
                            </div>

                        </div>
                        <div class="c-item-dd">

                            <div class="cart-list-holder">

                                <?php

                                $cart_products_html = '';

                                foreach($cart_jData['products'] as $cp_key=>$cp_value){

                                    $cart_products_html .= render_product_m($cp_value, 'cart');

                                }

                                echo $cart_products_html;
                                ?>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

            <div class="tabulatorDDItem sc_tabulatorDDItem  noMaxHeight chromeScroll" dataitem="1">


                <div class="inline-help">
                    Отмечайте понравившиеся Вам товары кликнув на <i class="fa fa-heart-o"></i>, они будут храниться здесь, Вы всегда сможете быстро
                    добавить их в корину!
                </div>

                <div class="favorites-list">
                    <?php

                    $cart_products_html = '';

                    foreach($cart_jData['products'] as $cp_key=>$cp_value){

                        $cart_products_html .= render_product_m($cp_value, 'cart');

                    }

                    echo $cart_products_html;

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
