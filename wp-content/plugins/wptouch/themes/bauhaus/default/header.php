<!DOCTYPE html>

<html <?php language_attributes(); ?>>
	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<title>Valet24 | круглосуточная доставка продуктов!</title>

        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-WZPNKCM');</script>
        <!-- End Google Tag Manager -->

        <link href="http://valet24.ru/wp-content/themes/valet24/assets/img/favicon.png" rel="shortcut icon" type="image/i-icon">
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


    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZPNKCM"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

		<?php do_action( 'wptouch_preview' ); ?>
		<?php do_action( 'wptouch_body_top' ); ?>
		<?php get_template_part( 'header-bottom' ); ?>
		<?php do_action( 'wptouch_body_top_second' ); ?>

