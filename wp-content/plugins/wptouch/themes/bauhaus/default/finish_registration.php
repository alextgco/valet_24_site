<?php

/*
    Template Name: confirm_registration
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

            <div class="category-title-nomargin">Почти готово!</div>
        </div>

        <div class="row">

            <div class="col-md-8">

                <div class="prepare-order-holder">

                    <h4>
                        На Вашу почту было отправлено письмо с подтверждением регистрации, проверьте почту, откройте письмо от нас и нажмите <span style="color: #106ed2;">"подтвердить регистрацию"</span>.
                    </h4>


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