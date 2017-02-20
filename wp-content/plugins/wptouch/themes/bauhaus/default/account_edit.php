<?php

/*
    Template Name: account_edit
*/

$cc_name = 'Редактирование профиля';

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
            <a class="notd" href="/account/"><div class="back-page"><i class="fa fa-arrow-left"></i><br/>Аккаунт</div></a>

            <div class="sidebar-search-holder">

                <div class="fill-delivery">Рекдактирование:</div>

            </div>

            <!--        <div class="category-title">--><?php //echo $cc_name; ?><!--</div>-->
        </div>
    </div>

<?php  endif;?>


<div class="site-content">

    <div class="container">

        <div class="row">

            <div class="col-md-12">


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
                            <input type="email" class="form-control"  id="email" placeholder="Почта:" value="<?php echo $user_jData['user']['email']; ?>"/>
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


                <div class="save-account pa-button" data-id="<?php echo $user_jData['user']['id'];?>"><i class="fa fa-save"></i>&nbsp;&nbsp;Сохранить</div>

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
