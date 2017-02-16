<?php

/*
    Template Name: confirm_registration_order
*/

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


<div class="site-content prepare-order-page">



    <div class="container">

        <div class="row">

            <div class="category-title-nomargin">Завершение регистарции, осталось только придумать пароль!</div>
        </div>

        <div class="row">

            <div class="col-md-8">

                <div class="prepare-order-holder">

                    <label class="pa-m-label">Придумайте пароль (запишите чтобы не забыть):</label>
                    <input class="pa-m-input" type="password" id="pa-password" placeholder="Пароль"/>
                    <label class="pa-m-label">Повторите пароль:</label>
                    <input class="pa-m-input" type="password" id="pa-password-rpt" placeholder="Пароль ещё раз"/>

                    <div class="pa-m-register-order pa-button"><i class="fa fa-lock"></i>&nbsp;&nbsp;Сохранить пароль</div>


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