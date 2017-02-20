<?php
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



?>

<!DOCTYPE html>

<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php wp_title( ' | ', true, 'right' ); ?></title>
    <?php wptouch_head(); ?>
    <?php
    if ( !is_single() && !is_archive() && !is_page() && !is_search() ) {
        wptouch_canonical_link();
    }

    if ( isset( $_REQUEST[ 'wptouch_preview_theme' ] ) || isset( $_REQUEST[ 'wptouch_switch' ] ) )  {
        echo '<meta name="robots" content="noindex" />';
    }
    ?>
</head>


<body <?php body_class( wptouch_get_body_classes() ); ?>>

<div class="inner-page">

<?php do_action( 'wptouch_preview' ); ?>
<?php do_action( 'wptouch_body_top' ); ?>



<div class="pushit <?php if ( bauhaus_is_menu_position_default() ) { echo 'pushit-left'; } else { echo 'pushit-right'; } ?>">
    <div id="menu" class="wptouch-menu show-hide-menu">
        <?php if ( wptouch_has_menu( 'primary_menu' ) ) { wptouch_show_menu( 'primary_menu' ); } ?>

        <?php if ( function_exists( 'wptouch_fdn_show_login' ) && wptouch_fdn_show_login() ) { ?>
            <ul class="menu-tree login-link">
                <li>
                    <?php if ( !is_user_logged_in() ) { ?>
                        <a class="login-toggle tappable" href="<?php echo wp_login_url( esc_url_raw( $_SERVER['REQUEST_URI'] ) ); ?>">
                            <i class="wptouch-icon-key"></i> Login
                        </a>
                    <?php } else { ?>
                        <a href="<?php echo wp_logout_url( esc_url_raw( $_SERVER['REQUEST_URI'] ) ); ?>" class="tappable" title="<?php _e( 'Logout', 'wptouch-pro' ); ?>">
                            <i class="wptouch-icon-user"></i>
                            <?php _e( 'Logout', 'wptouch-pro' ); ?>
                        </a>
                    <?php } ?>
                </li>
            </ul>
        <?php } ?>
    </div>
</div>


<!-- Back Button for Web-App Mode -->
<div class="wptouch-icon-arrow-left back-button tappable"><!-- css-button --></div>

<div class="page-wrapper">
    <?php if ( bauhaus_should_show_search() ) { ?>


        <?php

        $openedSearch = (strpos($_SERVER['REQUEST_URI'], 'search_results'))? 'toggled' : '';

        if($user_exists){
            echo    '<div class=""><div class="account-edit" data-id="'. $user_jData['user']['id'].'">Редактировать</div>'.
                    '<div class="account-exit" data-id="'. $user_jData['user']['id'] .'">Выйти</div></div>';
        }else{
            echo '<script type="text/javascript">document.location.href = "/"; </script>';
        }

        ?>






        <div id="search-dropper" class="<?php echo $openedSearch;?>">
            <div id="wptouch-search-inner">
                <form method="get" id="searchform" action="/search_results">

                    <?php

                    $curr_search_keyword = $_GET['search_keyword'];

                    ?>

                    <input type="text" name="search_keyword" id="search-text" placeholder="Поиск по продуктам" value="<?php echo $curr_search_keyword; ?>"/>
                    <input type="submit" id="search-submit" value="Найти" class="button-dark" />
                </form>
            </div>
        </div>
    <?php } ?>
    <header id="header-title-logo" class="no-bg">

        <?php if ( bauhaus_should_show_search() ) { ?>
            <div id="search-toggle" class="inner-page search-toggle tappable <?php if ( bauhaus_is_menu_position_default() ) { echo 'search-right'; } else { echo 'search-left'; } ?>" role="button"><!--icon-search--></div>
        <?php } ?>

        <a href="<?php wptouch_bloginfo( 'url' ); ?>" class="header-center tappable">
            <?php if ( foundation_has_logo_image() ) { ?>
                <!--				<img id="header-logo" src="--><?php //foundation_the_logo_image(); ?><!--" alt="logo image" />-->
            <?php } else { ?>
                <h1 class="heading-font"><?php wptouch_bloginfo( 'site_title' ); ?></h1>
            <?php } ?>
        </a>

        <!--        <div id="menu-toggle" class="menu-btn tappable show-hide-toggle-->
        <?php
        #if ( bauhaus_is_menu_position_default() ) { echo 'menu-left'; } else { echo 'menu-right'; }
        ?>
        <!--        " data-effect-target="menu" data-menu-target="menu" role="button"></div>-->

    </header>

    <div class="content-wrap">




    <?php do_action( 'wptouch_body_top_second' ); ?>




<div class="<?php wptouch_post_classes(); ?>">
    <div class="post-page-head-area bauhaus">



        <div id="mobile-logo-title" class="site-title">

            <img src="<?php $global_images_dir; ?>/images/circle_logo_inner.png" />

        </div>

        <a href="<?php wptouch_bloginfo( 'url' ); ?>" id="header-logo-my" class="header-center tappable <?php echo $openedSearch; ?>">

            <img id="header-logo" src="<?php foundation_the_logo_image(); ?>" alt="logo image" />

        </a>

        <div class="taCenter header-text-holder">



            <?php

            if(strlen($cc_name) > 0){
                echo '<span class="header-text"><span class="ptbold">'.$cc_name.'</span></span>';
            }else{
                echo '<span class="header-text">Доставка продуктов за <span class="ptbold">47</span> минут!</span>';
            }

            ?>


        </div>
    </div>

    <div class="post-page-content">



        <?php if ( bauhaus_should_show_thumbnail() && wptouch_has_post_thumbnail() ) { ?>
            <div class="post-page-thumbnail">
                <?php the_post_thumbnail('large', array( 'class' => 'post-thumbnail wp-post-image' ) ); ?>
            </div>
        <?php } ?>

        <?php wptouch_the_content() ; ?>

    </div>
</div>