<?php
/**
 * Created by PhpStorm.
 * User: aig
 * Date: 16.08.2016
 * Time: 1:06
 */

?>

<a id="float-cart" href="/cart">
    <div class="cart-holder">
        <div class="cart-title">Корзина:</div>
        <div class="cart-value">

            <?php

            $itemsWord = getNoun($cart_products_count, 'Товар', 'Товара', 'Товаров');

            if($cart_products_count > 0){
                echo '<span class="cart-products-count">'.$cart_products_count.' '.$itemsWord.'</span><br/><span class="cart-amount-holder">'.$cart_amount.'&nbsp;<i class="fa fa-ruble"></i></span>';
            }else{
                echo '<span class="cart-products-count">0 Товаров</span><br/><span class="cart-amount-holder first-time-update">0.00&nbsp;<i class="fa fa-ruble"></i></span>';
            }

            ?>

        </div>
    </div>
</a>