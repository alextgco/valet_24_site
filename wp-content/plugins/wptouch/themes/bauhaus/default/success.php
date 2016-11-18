<?php

/*
    Template Name: success
*/

    $order_id = $_GET['order_id'];

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


<div class="site-content prepare-order-page">



    <div class="container">

        <div class="row">

            <div class="category-title-nomargin">Спасибо за заказ!</div>
        </div>

        <div class="row">

            <div class="col-md-8">

                <div class="prepare-order-holder">

                    <h3>
                        Ваш заказ № <span class="boldtext"><?php echo $order_id; ?></span> оформлен и находится в обработке, наш менеджер свяжется с Вами в ближайшее время.<br/><br/>
                        Спасибо что выбрали Valet24!.<br/><br/>
                        Перейти на <a href="/">главную страницу</a>
                    </h3>


                </div>

            </div>

            <div class="col-md-4 posRel">



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