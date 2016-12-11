<?php

date_default_timezone_set('Europe/Moscow');

add_action( 'foundation_enqueue_scripts', 'bauhaus_enqueue_scripts' );
add_filter( 'amp_should_show_featured_image_in_header', 'bauhaus_should_show_thumbnail' );
add_filter( 'foundation_featured_show', 'bauhaus_show_featured_slider', 10, 2 );

$global_prot = 'http';
$global_url = '78.107.237.51:81';
$global_site = 'valet24.ru';
$global_images_dir = 'http://valet24.ru/images/';


function  getNoun($number, $one, $two, $five) {
    $number = abs($number);

    $number %= 100;

    if ($number >= 5 && $number <= 20) {
        return $five;
    }
    $number %= 10;
    if ($number == 1) {
        return $one;
    }
    if ($number >= 2 && $number <= 4) {
        return $two;
    }
    return $five;
}

function bauhaus_enqueue_scripts() {
	wp_enqueue_script(
		'bauhaus-js',
		BAUHAUS_URL . '/default/bauhaus.js',
		array( 'jquery' ),
		BAUHAUS_THEME_VERSION,
		true
	);
}

function get_delivery_price(){

    $day = 150;
    $night = 250;


    $minyt = date("i");
    $chasov = date("H");


    if($chasov >= 00 and $chasov < 10) {
        $resp = $night;
    }else{
        $resp = $day;
    }

    echo (int)$resp;
}

function my_theme_load_resources() {

//    wp_enqueue_style('bootstrap',       get_stylesheet_directory_uri() . '/assets/plugins/bootstrap-3.3.6-dist/css/bootstrap.min.css');
    wp_enqueue_style('fontawesome',     get_stylesheet_directory_uri() . '/assets/plugins/font-awesome-4.5.0/css/font-awesome.min.css');
    wp_enqueue_style('toastr',          get_stylesheet_directory_uri() . '/assets/plugins/toastr/toastr.min.css');

    wp_enqueue_script('jquery_my',      get_stylesheet_directory_uri() . '/assets/plugins/jquery/jquery-1.12.0.min.js');
    wp_enqueue_script('bootstrap',      get_stylesheet_directory_uri() . '/assets/plugins/bootstrap-3.3.6-dist/js/bootstrap.min.js');
    wp_enqueue_script('mustache',       get_stylesheet_directory_uri() . '/assets/plugins/mustache/mustache.js');
    wp_enqueue_script('toastr',         get_stylesheet_directory_uri() . '/assets/plugins/toastr/toastr.min.js');
    wp_enqueue_script('core',           get_stylesheet_directory_uri() . '/assets/js/core.js');
    wp_enqueue_script('script',         get_stylesheet_directory_uri() . '/assets/js/script.js');

}

add_action('wp_enqueue_scripts', 'my_theme_load_resources');



function request_url()
{
    $result = ''; // Пока результат пуст
    $default_port = 80; // Порт по-умолчанию

    // А не в защищенном-ли мы соединении?
    if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=='on')) {
        // В защищенном! Добавим протокол...
        $result .= 'https://';
        // ...и переназначим значение порта по-умолчанию
        $default_port = 443;
    } else {
        // Обычное соединение, обычный протокол
        $result .= 'http://';
    }
    // Имя сервера, напр. site.com или www.site.com
    $result .= $_SERVER['SERVER_NAME'];

    // А порт у нас по-умолчанию?
    if ($_SERVER['SERVER_PORT'] != $default_port) {
        // Если нет, то добавим порт в URL
        $result .= ':'.$_SERVER['SERVER_PORT'];
    }
    // Последняя часть запроса (путь и GET-параметры).
    $result .= $_SERVER['REQUEST_URI'];
    // Уфф, вроде получилось!

    return $result;
}

function bauhaus_should_show_thumbnail() {
	$settings = bauhaus_get_settings();

	switch( $settings->bauhaus_use_thumbnails ) {
		case 'none':
			return false;
		case 'index':
			return is_home();
		case 'index_single':
			return is_home() || is_single();
		case 'index_single_page':
			return is_home() || is_single() || is_page();
		case 'all':
			return is_home() || is_single() || is_page() || is_archive() || is_search();
		default:
			// in case we add one at some point
			return false;
	}
}

function bauhaus_should_show_taxonomy() {
	$settings = bauhaus_get_settings();

	if ( $settings->bauhaus_show_taxonomy ) {
		return true;
	} else {
		return false;
	}
}

function bauhaus_should_show_date(){
	$settings = bauhaus_get_settings();

	if ( $settings->bauhaus_show_date ) {
		return true;
	} else {
		return false;
	}
}

function bauhaus_should_show_author(){
	$settings = bauhaus_get_settings();

	if ( $settings->bauhaus_show_author ) {
		return true;
	} else {
		return false;
	}
}

function bauhaus_should_show_search(){
	$settings = bauhaus_get_settings();

	if ( $settings->bauhaus_show_search ) {
		return true;
	} else {
		return false;
	}
}

function bauhaus_should_show_comment_bubbles(){
	$settings = bauhaus_get_settings();

	if ( $settings->bauhaus_show_comment_bubbles ) {
		return true;
	} else {
		return false;
	}
}

function bauhaus_is_menu_position_default(){
	$settings = bauhaus_get_settings();

	if ( $settings->bauhaus_menu_position == 'left-side' ) {
		return true;
	} else {
		return false;
	}
}

function bauhaus_show_featured_slider( $show_featured_slider, $featured_slider_enabled ) {
	if ( bauhaus_allow_featured_slider_override() ) {
		$settings = bauhaus_get_settings();

		global $post;
		if ( $settings->featured_slider_page !== false && $post->ID == $settings->featured_slider_page ) {
			$show_featured_slider = true;
		} elseif ( $settings->featured_slider_page == true ) {
			$show_featured_slider = false;
		}
	}

	return $show_featured_slider;
}