<?php

/*
    Template Name: prepare_order
*/

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
<body>
<?php
include 'header.php';
?>

<div class="site-content prepare-order-page">

    <div class="container">

        <div class="row">

            <div class="category-title-nomargin">Оформление заказа</div>
        </div>

        <div class="row">

            <div class=" col-md-8">

                <div class="prepare-order-holder">

                    <h3>Заполните поля ниже:</h3>



                        <div class="row">
                            <div class=" col-md-12">
                                <div class="form-group">
                                    <label>Укажите адрес:</label>
                                    <input type="text" class="form-control" id="address" value="<?php echo $user_jData['user']['address']; ?>"/>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class=" col-md-12">
                                <div class="form-group">
                                    <label>Имя:</label>
                                    <input type="text" class="form-control"  id="name" value="<?php echo $user_jData['user']['name']; ?>"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class=" col-md-6">
                                <div class="form-group">
                                    <label><span class="redStar">*</span>Телефон:</label>
                                    <input type="text" class="form-control"  id="phone" value="<?php echo $user_jData['user']['phone']; ?>"/>
                                </div>
                            </div>

                            <div class=" col-md-6">
                                <div class="form-group">
                                    <label>Почта:</label>
                                    <input type="text" class="form-control"  id="email" value="<?php echo $user_jData['user']['email']; ?>"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class=" col-md-6">
                                <div class="form-group">
                                    <label>Подъезд:</label>
                                    <input type="text" class="form-control"  id="gate" value="<?php echo $user_jData['user']['gate']; ?>" />
                                </div>
                            </div>
                            <div class=" col-md-6">
                                <div class="form-group">
                                    <label>Код домофона:</label>
                                    <input type="text" class="form-control"  id="gatecode" value="<?php echo $user_jData['user']['gatecode']; ?>"/>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class=" col-md-6">
                                <div class="form-group">
                                    <label>Этаж:</label>
                                    <input type="text" class="form-control"  id="level" value="<?php echo $user_jData['user']['level']; ?>"/>
                                </div>
                            </div>
                            <div class=" col-md-6">
                                <div class="form-group">
                                    <label>Квартира:</label>
                                    <input type="text" class="form-control"  id="flat" value="<?php echo $user_jData['user']['level']; ?>"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class=" col-md-12">
                                <div class="form-group">
                                    <label>Комментарий:</label>
                                    <textarea rows="5" class="form-control resizeVer"  id="comment"></textarea>
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

                                Итого с доставкой (<span class="current-delivery-price"><?php echo get_delivery_price(); ?> руб</span>): <span class="cart-amount-with-delivery"> <?php echo number_format($total_price_with_delivery,2); ?><i class="fa fa-ruble"></i></span>
                            </div>

<!--                            <a href="/success">-->

                                <div class="cart-prepare-order cart-confirm-order"><i class="fa fa-paper-plane-o"></i>&nbsp;&nbsp;Оформить заказ</div>

<!--                            </a>-->

                        </div>



                </div>

            </div>

            <div class="invis-sm col-md-4 posRel">

                <div class="cart-total-holder">
                    <h3>Ваш заказ:</h3>

                    <div class="cart-sidebar-items">


                        <?php

                        $cart_products_html = '';

                        foreach($cart_jData['products'] as $cp_key=>$cp_value){


                            $cart_products_html .= render_product($cp_value, 'sidebar');


                        }

                        echo $cart_products_html;

                        ?>
                        <div class="cart-total-holder">
                            <h3>Итого:</h3>
                            <div class="cart-total-values">
                                <?php
                                $itemsWord = getNoun($cart_products_count, 'Товар', 'Товара', 'Товаров');
                                ?>
                                <span class="cart-products-count"><?php echo $cart_products_count.' '.$itemsWord; ?></span>
                                <span class="cart-amount-holder"><?php echo number_format($cart_amount,2); ?> <i class="fa fa-ruble"></i></span>
                            </div>

                            <div class="prepare-order-with-delivery-holder prepare-order-with-delivery-holder-sidebar">


                                <?php

                                (int)$delivery_price = (date('H') >= 00 and date('H') < 10)? 250 : 150 ;



                                $total_price_with_delivery = round($delivery_price,2) + round($cart_amount,2);

                                ?>

                                Итого с доставкой (<span class="current-delivery-price"><?php echo get_delivery_price(); ?> руб</span>): <span class="cart-amount-with-delivery"> <?php echo number_format($total_price_with_delivery,2); ?><i class="fa fa-ruble"></i></span>
                            </div>


<!--                            <a class="--><?php //echo ($cart_products_count == 0)? 'disabled': ''; ?><!--" href="/success">-->

                                <div class="cart-prepare-order cart-confirm-order"><i class="fa fa-paper-plane-o"></i>&nbsp;&nbsp;Оформить заказ</div>

<!--                            </a>-->

                        </div>


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