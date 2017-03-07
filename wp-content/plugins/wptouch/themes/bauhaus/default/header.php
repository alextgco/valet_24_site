<!DOCTYPE html>

<html <?php language_attributes(); ?>>
	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<title>Valet24 | круглосуточная доставка продуктов!</title>
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

		<?php do_action( 'wptouch_preview' ); ?>
		<?php do_action( 'wptouch_body_top' ); ?>
		<?php get_template_part( 'header-bottom' ); ?>
		<?php do_action( 'wptouch_body_top_second' ); ?>

