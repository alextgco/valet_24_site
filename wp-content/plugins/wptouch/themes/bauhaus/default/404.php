
<?php

    $href = request_url();
    $arr = parse_url($href);


    $action_alias = preg_replace('/^\//','',$arr['path']);
    $action_alias = preg_replace('/(^\w+)\/.*/','$1',$action_alias);
    $category_full = preg_replace('/(^\w+)\/.*/','$1',$action_alias);
    $category_id = preg_replace('/category_/','$1', $category_full);

    include 'basket_top.php';
    include 'header-inner.php';

?>



    <?php if($category_id == 4037): ?>

        <div id="content">
            <div class="<?php wptouch_post_classes(); ?>">

                <h2 style="padding-right: 10px; padding-left: 10px;">
                    Привезем Вашу любимую еду из ресторанов быстрого обслуживания, звоните:<br/><br/>

                    <b>+7 (495) 134-39-12</b><br/><br/>

                    или оставляйте заявки на почте:<br/><br/>

                    <b>info@valet24.ru</b>

                </h2>


            </div>
        </div>

    <?php endif; ?>

    <?php if($category_id != 4037): ?>


        <div id="content">
            <div class="<?php wptouch_post_classes(); ?>">
                <p class="not-found heading-font">
                    <?php _e( '404 Not Found', 'wptouch-pro' ); ?>
                </p>

                <a style="font-size: 20px; display: block; width: 100%; text-align: center; font-weight:bold;" href="/">ВЕРНУТЬСЯ НА ГЛАВНУЮ</a>

                <!--			<p class="not-found-text">--><?php //_e( 'The post or page you requested is no longer available.', 'wptouch-pro' ); ?><!--</p>-->



            </div>
        </div>

    <?php endif; ?>

	 <!-- content -->

<?php get_footer(); ?>