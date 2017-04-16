<?php

/*
    Template Name: inner
*/

$page_id = get_the_ID();
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

        <?php

        echo get_post($page_id)->post_content;

        ?>


    </div>


</div>

<?php

include 'footer.php';
include 'foot_js.php';
?>


</body>
</html>