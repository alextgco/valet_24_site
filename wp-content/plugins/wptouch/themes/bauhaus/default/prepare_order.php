<?php

/*
    Template Name: prepare_order
*/

    $cc_name = 'Оформление заказа';

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




<?php if($cart_products_count > 0): ?>

<div class="after-header">
    <div class="container">
        <a class="notd" href="/cart/"><div class="back-page"><i class="fa fa-shopping-cart"></i><br/>Корзина</div></a>

        <div class="sidebar-search-holder">

            <div class="fill-delivery">Заполните поля доставки:</div>

        </div>

        <!--        <div class="category-title">--><?php //echo $cc_name; ?><!--</div>-->
    </div>
</div>

<?php  endif;?>


<div class="site-content">

    <div class="container">

        <div class="row">

            <div class="col-md-9">



                <?php
                $hiddenClass = ($cart_products_count == 0)? '': 'hidden';
                echo '<div class="empty-basket-holder '.$hiddenClass.'">Корзина пуста, перейти к <a href="/">выбору продуктов</a></div>';

                ?>



                <div class="row">
                    <div class=" col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control"  id="name" placeholder="Представьтесь, пожалуйста"  value="<?php echo $user_jData['user']['name']; ?>"/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class=" col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" id="address" placeholder="Укажите адрес:" value="<?php echo $user_jData['user']['address']; ?>" />
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class=" col-md-6">
                        <div class="form-group">
                            <input type="tel" class="form-control"  id="phone" placeholder="Телефон:*" value="<?php echo $user_jData['user']['phone']; ?>"/>
                        </div>
                    </div>

                    <div class=" col-md-6">
                        <div class="form-group">
                            <input type="email" class="form-control"  id="email" placeholder="Почта:*" value="<?php echo $user_jData['user']['email']; ?>"/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class=" col-md-6">
                        <div class="form-group">
                            <input type="number" class="form-control"  id="gate" placeholder="Подъезд:" value="<?php echo $user_jData['user']['gate']; ?>"/>
                        </div>
                    </div>
                    <div class=" col-md-6">
                        <div class="form-group">

                            <input type="text" class="form-control"  id="gatecode" placeholder="Код домофона:" value="<?php echo $user_jData['user']['gatecode']; ?>"/>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class=" col-md-6">
                        <div class="form-group">

                            <input type="number" class="form-control"  id="level" placeholder="Этаж:" value="<?php echo $user_jData['user']['level']; ?>"/>
                        </div>
                    </div>
                    <div class=" col-md-6">
                        <div class="form-group">

                            <input type="number" class="form-control"  id="flat" placeholder="Квартира:" value="<?php echo $user_jData['user']['flat']; ?>"/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class=" col-md-12">
                        <div class="form-group">

                            <textarea rows="5" class="form-control resizeVer"  id="comment" placeholder="Комментарий:"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class=" col-md-12">
                        <div class="form-group">

                            <input type="number" class="form-control"  id="promocode" placeholder="Промокод:" value=""/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class=" col-md-12">
                        <div class="form-group payment_type_fg">
                            <label>Способ оплаты:</label><br/>
                            <input type="radio" name="payment_type" value="CASH" checked="checked" /> Наличными курьеру<br/>
                            <input type="radio" name="payment_type" value="CARD" /> Оплата картой курьеру<br/>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class=" col-md-12">
                        <div class="i-agree-holder">
                            <div class="form-group">
                                <input type="checkbox" class="form-control"  id="agreement"/>
                                <label><span class="redStar">*</span>Я согласен(а) с <a href="http://valet24.tmweb.ru/docs/main_agreement.pdf" target="_blank">правилами</a> покупки.</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class=" col-md-12">
                        <div class="i-agree-subscription">
                            <div class="form-group">
                                <input type="checkbox" class="form-control" checked id="subscription"/>
                                <label>Я согласен(а) получать информационные рассылки о проводимых акциях (Кратко и по делу).</label>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="cart-total-holder">

                <?php if($cart_products_count > 0): ?>


                <div class="as-after-header">

                    <div class="prepare-order-title">Ваш заказ:</div>
                    <div class="prepare-order-confirm">

                        <div class="cart-total-values">
                            <?php
                            $itemsWord = getNoun($cart_products_count, 'Товар', 'Товара', 'Товаров');
                            ?>
                            <span class="cart-products-count"><?php echo $cart_products_count.' '.$itemsWord; ?></span>
                            <span class="cart-amount-holder"><?php echo number_format($cart_amount,2); ?> <i class="fa fa-ruble"></i></span>
                        </div>
                        <div class="prepare-order-with-delivery-holder">


                            <?php

                            (int)$delivery_price = (date('H') >= 00 and date('H') < 10)? 250 : 150 ;

                            $total_price_with_delivery = round($delivery_price,2) + round($cart_amount,2);

                            ?>

                            Итого с доставкой (<span class="current-delivery-price"><?php echo get_delivery_price(); ?> руб</span>):<br/> <span class="cart-amount-with-delivery"> <?php echo number_format($total_price_with_delivery,2); ?>&nbsp;<i class="fa fa-ruble"></i></span>

                        </div>
                    </div>

                    <div class="g-recaptcha" data-sitekey="6LcfPyQUAAAAADsuhlTL_oiOg5O6Yt6rVTJiju4E"></div>
                    
                    <div class="cart-prepare-order cart-confirm-order"><i class="fa fa-paper-plane-o"></i>&nbsp;&nbsp;Оформить заказ</div>

                </div>

                <?php endif; ?>



            </div>




            <div class="cat-dd-row"></div>

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
