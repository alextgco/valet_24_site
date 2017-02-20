<?php
    session_start();
    $PHPSESSID=session_id();
    // Get user
    $user_url = $global_prot . '://' . $global_url. '/site_api';

    $user_req = '{"command":"get_user","params":{}}';

    $user_post_data = http_build_query(array(
        'sid' => $PHPSESSID,
        'site' => $global_site,
        'json' => $user_req
    ));

    $user_ch = curl_init();

    curl_setopt($user_ch, CURLOPT_URL, $user_url );
    curl_setopt($user_ch, CURLOPT_POST, 1 );
    curl_setopt($user_ch, CURLOPT_POSTFIELDS, $user_post_data);
    curl_setopt($user_ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($user_ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($user_ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($user_ch,CURLOPT_TIMEOUT,10);
    curl_setopt($user_ch,CURLOPT_TIMEOUT,10);

    $user_resp = curl_exec($user_ch);

    if (curl_errno($user_ch)) {
        print curl_error($user_ch);
    }
    curl_close($user_ch);

    $user_jData = json_decode($user_resp, true);
    $user_exists = ($user_jData['code'] == 0);



    if($user_exists){
        echo '<div class="to-pa"><i class="fa fa-user"></i>&nbsp;&nbsp;Личный кабинет</div>';
    }else{
        echo '<div class="pa-btn"><i class="fa fa-lock"></i>&nbsp;&nbsp;Войти</div>';
    }


?>

<?php if ( foundation_is_theme_using_module( 'custom-latest-posts' ) && wptouch_fdn_is_custom_latest_posts_page() ) { ?>

	<?php wptouch_fdn_custom_latest_posts_query(); ?>
	<?php get_template_part( 'index' ); ?>

<?php } else { ?>





	<?php get_header(); ?>

	<div id="content">



		<?php if ( wptouch_have_posts() ) { ?>
			<?php wptouch_the_post(); ?>
			<?php get_template_part( 'page-content' ); ?>
		<?php } ?>
	</div> <!-- content -->

	<?php if ( comments_open() || have_comments() ) { ?>
		<div id="comments">
			<?php comments_template(); ?>
		</div>
	<?php } ?>

    <div class="page-mobile-content">

        <?php
        include 'root_categories.php';
        ?>
    </div>




	<?php get_footer(); ?>

<?php } ?>