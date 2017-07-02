<?php

/*
    Template Name: cart
*/

    $cc_name = 'Корзина';

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
        <a class="notd" href="/"><div class="back-page"><i class="fa fa-home "></i><br/>Главная</div></a>

        <div class="sidebar-search-holder">

            <a class="<?php echo ($cart_products_count == 0)? 'disabled': ''; ?>" href="/prepare_order"><div class="cart-prepare-order"><i class="fa fa-paper-plane-o"></i>&nbsp;&nbsp;Оформить заказ</div></a>

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

                <div class="cart-total-holder">

                    <?php if($cart_products_count > 0): ?>

                        <h3>Ваш заказ:</h3>
                        <div class="cart-total-values">
                            <?php
                            $itemsWord = getNoun($cart_products_count, 'Товар', 'Товара', 'Товаров');
                            ?>
                            <span class="cart-products-count"><?php echo $cart_products_count.' '.$itemsWord; ?></span>
                            <span class="cart-amount-holder"><?php echo number_format($cart_amount,2); ?> <i class="fa fa-ruble"></i></span>
                        </div>

                    <?php endif; ?>



                </div>

                <div class="cart-list-holder">
                    <?php



                    $cart_products_html = '';

                    foreach($cart_jData['products'] as $cp_key=>$cp_value){

                        $cart_products_html .= render_product_m($cp_value, 'cart');


//                        $id = $cp_value['product_id'];
//                        $name = $cp_value['name'];
//                        $price = $cp_value['price_site'];
//                        $product_count = $cp_value['product_count'];
//                        $total = number_format($price * $product_count,2);
//
//                        $image = (strlen($cp_value['image']) > 0) ? $cp_value['image'] : $global_images_dir . 'cat-default.jpg';
//
//                        $is_gramm = ($cp_value['qnt_type_sys'] == 'KG')? true : false;
//                        $is_gramm_html = ($is_gramm)? 'gramm-type': '';
//
//                        $it_or_kg = $cp_value['qnt_type'];
//
//                        $cart_products_html .=  '<div class="cart-item cart-item-prices" data-id="'.$id.'">'.
//                                                    '<div class="cart-item-image-holder">'.
//                                                        '<img src="'.$image.'" alt="'.$name.'"/>'.
//                                                    '</div>'.
//
//                                                    '<div class="cart-item-info-holder">'.
//                                                        '<div class="cart-item-title">'.$name.'</div>'.
//                                                        '<div class="cart-item-single-price">Цена: <span class="product-item-price-int">'.$price.'</span> <i class="fa fa-ruble"></i></div>'.
//
//                                                        '<div class="cart-item-qnt">'.
//                                                            '<div class="cart-item-qnt-dec fa fa-minus-circle '.$is_gramm_html.'"  data-id="'.$id.'"  data-price="'.$price.'"></div>'.
//                                                            '<div class="cart-item-qnt-value-holder"><span class="cart-item-qnt-value">'.$product_count.'</span> '.$it_or_kg.'</div>'.
//                                                            '<div class="cart-item-qnt-inc fa fa-plus-circle '.$is_gramm_html.'" data-id="'.$id.'" data-price="'.$price.'"></div>'.
//                                                        '</div>'.
//                                                    '</div>'.
//
//                                                    '<div class="cart-item-total"><span class="cart-item-total-value">'.$total.'</span> <i class="fa fa-ruble"></i></div>'.
//                                                '</div>';


                    }

                    echo $cart_products_html;

                    echo '</div>';
                    ?>

            </div>

            <div class="cart-total-holder">

                <?php if($cart_products_count > 0): ?>

                    <h3>Ваш заказ:</h3>
                    <div class="cart-total-values">
                        <?php
                        $itemsWord = getNoun($cart_products_count, 'Товар', 'Товара', 'Товаров');
                        ?>
                        <span class="cart-products-count"><?php echo $cart_products_count.' '.$itemsWord; ?></span>
                        <span class="cart-amount-holder"><?php echo number_format($cart_amount,2); ?> <i class="fa fa-ruble"></i></span>
                    </div>





                <div class="as-after-header">
                    <div class="container">

                        <div class="clear-as-back-page">
                            <div class="cart-clear <?php echo ($cart_products_count == 0)? 'disabled': ''; ?>">
                                <i class="fa fa-refresh"></i><br/>Очистить корзину</div>
                        </div>



                        <div class="sidebar-search-holder">

                            <a class="<?php echo ($cart_products_count == 0)? 'disabled': ''; ?>" href="/prepare_order"><div class="cart-prepare-order"><i class="fa fa-paper-plane-o"></i>&nbsp;&nbsp;Оформить заказ</div></a>

                        </div>

                        <!--        <div class="category-title">--><?php //echo $cc_name; ?><!--</div>-->
                    </div>
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
