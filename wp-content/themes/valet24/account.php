<?php

/*
    Template Name: account
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

            <div class="category-title-nomargin">Личный кабинет</div>
        </div>

        <div class="row">



            <div class="col-sm-8 col-md-8 ">

                <h3><i class="fa fa-bars"></i>&nbsp;&nbsp;Ваши заказы:</h3>
                <div class="inline-help">
                    Вы можете положить один или несколько Ваших заказов в корзину целиком или
                    выбрать из них несколько товаров, попробуйте сами!
                </div>


                <div class="carts-list">

                    <div class="c-item-wrapper">

                        <div class="c-item-date">16 января, 14:35. На сумму 1596.00 руб.</div>
                        <div class="c-item-second-row">

                            <div class="c-item-images-list">
                                <div class="c-item-img"><img src="/images_new/IMG_2364_frukti_ovoshi.jpg" alt=""/></div>
                                <div class="c-item-img"><img src="/images_new/IMG_1745_siri.jpg" alt=""/></div>
                                <div class="c-item-img"><img src="/images_new/IMG_7628_alko.jpg" alt=""/></div>
                            </div>

                            <div class="c-item-btns-holder">
                                <div class="c-item-open pa-s-button">Смотреть товары</div>
                                <div class="c-item-to-basket pa-s-button">Положить в корзину</div>
                            </div>

                        </div>
                        <div class="c-item-dd">

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

                                    $is_gramm = ($cp_value['qnt_type_sys'] == 'KG')? true : false;
                                    $is_gramm_html = ($is_gramm)? 'gramm-type': '';

                                    $it_or_kg = $cp_value['qnt_type'];

                                    $cart_products_html .=  '<div class="cart-item" data-id="'.$id.'">'.
                                        '<div class="cart-item-sm-title">'.$name.'</div>'.
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

                        </div>
                    </div>

                    <div class="c-item-wrapper">

                        <div class="c-item-date">19 января, 19:01. На сумму 742.50 руб.</div>

                        <div class="c-item-second-row">

                            <div class="c-item-images-list">
                                <div class="c-item-img"><img src="/images_new/IMG_2364_frukti_ovoshi.jpg" alt=""/></div>
                                <div class="c-item-img"><img src="/images_new/IMG_1745_siri.jpg" alt=""/></div>
                                <div class="c-item-img"><img src="/images_new/IMG_7628_alko.jpg" alt=""/></div>
                            </div>

                            <div class="c-item-btns-holder">
                                <div class="c-item-open pa-s-button">Смотреть товары</div>
                                <div class="c-item-to-basket pa-s-button">Положить в корзину</div>
                            </div>

                        </div>

                        <div class="c-item-dd">

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

                                    $is_gramm = ($cp_value['qnt_type_sys'] == 'KG')? true : false;
                                    $is_gramm_html = ($is_gramm)? 'gramm-type': '';

                                    $it_or_kg = $cp_value['qnt_type'];

                                    $cart_products_html .=  '<div class="cart-item" data-id="'.$id.'">'.
                                                                '<div class="cart-item-sm-title">'.$name.'</div>'.
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
                                ?>


                        </div>
                    </div>

                </div>

            </div>

            <div class="col-sm-4 col-md-4 ">

                <h3><i style="color: #007cfb;" class="fa fa-thumbs-up"></i>&nbsp;&nbsp;Избранные товары:</h3>
                <div class="inline-help">
                    Отмечайте понравившиеся Вам товары, они будут храниться здесь, Вы всегда сможете быстро
                    добавить их в корину!
                </div>

                <div class="favorites-list">
                    <?php

                    $cart_products_html = '';

                    foreach($cart_jData['products'] as $cp_key=>$cp_value){

                        $id = $cp_value['product_id'];
                        $name = $cp_value['name'];
                        $price = $cp_value['price_site'];
                        $product_count = $cp_value['product_count'];
                        $total = number_format($price * $product_count,2);

                        $image = (strlen($cp_value['image']) > 0) ? $cp_value['image'] : $global_images_dir . 'cat-default.jpg';

//                            $is_gramm = true;//$cp_value['control_of_fractional_amounts'];
//                            $is_gramm_html = ($is_gramm)? 'gramm-type': '';
//                            $it_or_kg = ($is_gramm)? 'кг': 'шт';

                        $is_gramm = ($cp_value['qnt_type_sys'] == 'KG')? true : false;
                        $is_gramm_html = ($is_gramm)? 'gramm-type': '';
                        $it_or_kg = $cp_value['qnt_type'];

                        $cart_products_html .=  '<div class="cart-item" data-id="'.$id.'">'.
                                                    '<div class="cart-item-image-holder">'.
                                                        '<img src="'.$image.'" alt="'.$name.'"/>'.
                                                    '</div>'.
                                                    '<div class="cart-item-title">'.$name.'</div>'.
                                                    '<div class="cart-item-price">Цена: <span class="product-item-price-int">'.$price.'</span> <i class="fa fa-ruble"></i></div>'.
                                                '</div>';

                    }

                    echo $cart_products_html;

                    ?>
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