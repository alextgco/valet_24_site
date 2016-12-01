<?php

/*
    Template Name: cart
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

<div class="site-content">

    <div class="container">

        <div class="row">

            <div class="category-title-nomargin">Корзина</div>
        </div>

        <div class="row">

            <div class="col-md-8 ">

                <?php
                $hiddenClass = ($cart_products_count == 0)? '': 'hidden';
                echo '<div class="empty-basket-holder '.$hiddenClass.'">Корзина пуста, перейти к <a href="/">выбору продуктов</a></div>';

                ?>

                <div class="cart-list-holder">
                <?php



                $cart_products_html = '';

                foreach($cart_jData['products'] as $cp_key=>$cp_value){

                    $id = $cp_value['product_id'];
                    $name = $cp_value['name'];
                    $price = $cp_value['price_site'];
                    $product_count = $cp_value['product_count'];
                    $total = number_format($price * $product_count,2);

                    $image = (strlen($cp_value['image']) > 0) ? $cp_value['image'] : $global_images_dir . 'cat-default.jpg';

//                    $is_gramm = true;//$cp_value['control_of_fractional_amounts'];
                    $is_gramm = ($cp_value['qnt_type_sys'] == 'KG')? true : false;
                    $is_gramm_html = ($is_gramm)? 'gramm-type': '';
//                    $it_or_kg = ($is_gramm)? 'кг.': 'шт.';
                    $it_or_kg = $cp_value['qnt_type'];

                    $cart_products_html .=  '<div class="cart-item" data-id="'.$id.'">'.
                                                '<div class="cart-item-image-holder">'.
                                                    '<img src="'.$image.'" alt="'.$name.'"/>'.
                                                '</div>'.
                                                '<div class="cart-item-title">'.$name.'</div>'.
                                                '<div class="cart-item-prices">'.
                                                    '<div class="cart-item-price">'.
                                                        '<div class="cart-item-single-price">Цена: <span class="product-item-price-int">'.$price.'</span> <i class="fa fa-ruble"></i></div>'.
                                                        '<div class="cart-item-qnt">'.
                                                            '<div class="cart-item-qnt-dec '.$is_gramm_html.' fa fa-minus-circle"  data-id="'.$id.'"  data-price="'.$price.'"></div>'.
                                                            '<div class="cart-item-qnt-value-holder"><span class="cart-item-qnt-value">'.$product_count.'</span> '.$it_or_kg.'</div>'.
                                                            '<div class="cart-item-qnt-inc '.$is_gramm_html.' fa fa-plus-circle" data-id="'.$id.'" data-price="'.$price.'"></div>'.
                                                        '</div>'.
                                                    '</div>'.
                                                    '<div class="cart-item-total"><span class="cart-item-total-value">'.$total.'</span> <i class="fa fa-ruble"></i></div>'.
                                                '</div>'.
                                            '</div>';

                }

                echo $cart_products_html;

                echo '</div>';






                ?>






            </div>

            <div class="col-md-4 posRel">

                <div class="cart-total-holder">
                    <h3>Ваш заказ:</h3>
                    <div class="cart-total-values">
                        <?php
                            $itemsWord = getNoun($cart_products_count, 'Товар', 'Товара', 'Товаров');
                        ?>
                        <span class="cart-products-count"><?php echo $cart_products_count.' '.$itemsWord; ?></span>
                        <span class="cart-amount-holder"><?php echo number_format($cart_amount,2); ?> <i class="fa fa-ruble"></i></span>
                    </div>

                    <a class="<?php echo ($cart_products_count == 0)? 'disabled': ''; ?>" href="/prepare_order"><div class="cart-prepare-order"><i class="fa fa-paper-plane-o"></i>&nbsp;&nbsp;Оформить заказ</div></a>
                    <div class="cart-clear <?php echo ($cart_products_count == 0)? 'disabled': ''; ?>"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Очистить корзину</div>

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