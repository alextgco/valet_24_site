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

function ahah(){
    return 'asdas';
}


function render_product_m($p, $mode, $columns){

    $global_images_dir = 'http://valet24.ru/images/';
    $tpl = '';



    if($mode == 'card'){

        $id =               $p[array_search('id', $columns)];
        $name =             $p[array_search('name', $columns)];
        $price =            $p[array_search('price_site', $columns)];
        $product_count =    $p[array_search('product_count', $columns)];

        $image =            (strlen($p[array_search('image', $columns)]) > 0) ? $p[array_search('image', $columns)] : $global_images_dir . 'cat-default.jpg';
        $is_gramm =         ($p[array_search('qnt_type_sys', $columns)] == 'KG')? true : false;
        $in_basket_count =  $p[array_search('in_basket_count', $columns)];
        $is_in_favorites =  ($p[array_search('in_favorite', $columns)] == true)? 'in_favorite' : '';

        if($is_gramm){

            if($in_basket_count > 0){
                $btn_html = '<div class="modify-gt-value gramm-type added" data-id="'.$id.'">'.
                    '<div class="gt-ib-values-holder">'.
                    '<div class="gt-ib-count"><span class="gt-ib-count-int">'.$in_basket_count.'</span> кг</div>'.
                    '</div>'.
                    '<div class="gt-ib-modify">'.
                    '<div class="gt-ib-amount">'. round($in_basket_count * $p[array_search('price_site',$columns)], 2) .' р.</div>'.
                    '<div class="gt-ib-modify-text">Изменить</div>'.
                    '</div>'.
                    '</div>';

            }else{
                $btn_html = '<div class="first-add-cart gramm-type">В корзину</div>';
            }

        }else{

            if($in_basket_count > 0){
                $btn_html = '<div class="inc-btn-holder"><div class="inc-btn-dec" data-id="'.$id.'">-</div><div class="inc-btn-value">'.$in_basket_count.'</div><div class="inc-btn-inc" data-id="'.$id.'">+</div></div>';
            }else{
                $btn_html = '<div class="first-add-cart">В корзину</div>';
            }

        }

        $price = ($is_gramm)? '<span class="product-item-price-int">'.$p[array_search('price_site',$columns)].'</span>' . '<span class="price-rub">&nbsp;руб/кг</span>' : '<span class="product-item-price-int">'.$p[array_search('price_site',$columns)].'</span>' .'<span class="price-rub">&nbsp;руб.</span>';

        $addedClass = ($in_basket_count > 0)?'added': '';

        $tpl .= '<div class="product-item" data-id="'.$id.'">'.
            '<div class="product-image-holder"><img src="'.$image.'" alt=" '.$name.'"/></div>'.
            '<div class="product-info-holder"><div class="product-name-holder">'.$name.'</div>'.
            '<div class="product-price-holder">'.$price.'</div></div>'.
            '<div class="cart-item-to-favorite '.$is_in_favorites.'" data-id="'.$id.'"><i class="fa fa-heart-o"></i><div class="cart-item-to-favorite-dd">Добавить в избранное</div></div>'.
            '<div class="product-add-holder sc-product-add '.$addedClass.'"  data-id="'.$id.'">'.$btn_html.'</div></div>';

    }else if($mode == 'favorite'){

        $id = $p[array_search('product_id', $columns)];
        $name = $p[array_search('product_name', $columns)];
        $price = $p[array_search('product_price_site',$columns)];

        $product_count = $p[array_search('product_count',$columns)];
        $in_basket_count = (strlen($p[array_search('in_basket_count',$columns)]) > 0)? $p[array_search('in_basket_count',$columns)] : 0;


        $total = number_format($price * $in_basket_count,2);

        $image = (strlen($p[array_search('product_image',$columns)]) > 0) ? $p[array_search('product_image',$columns)] : $global_images_dir . 'cat-default.jpg';

        $is_gramm = ($p[array_search('product_qnt_type_sys',$columns)] == 'KG')? true : false;
        $is_gramm_html = ($is_gramm)? 'gramm-type': '';
        $it_or_kg = $p[array_search('product_qnt_type', $columns)];

        $is_in_favorites =  ($p[array_search('in_favorite',$columns)] == true)? 'in_favorite' : '';



        $tpl .=
            '<div class="cart-item cart-item-prices" data-id="'.$id.'">'.
            '<div class="cart-item-image-holder">'.
            '<img src="'.$image.'" alt="'.$name.'"/>'.
            '</div>'.

            '<div class="cart-item-info-holder">'.
            '<div class="cart-item-title">'.$name.'</div>'.
            '<div class="cart-item-single-price">Цена: <span class="product-item-price-int">'.$price.'</span> <i class="fa fa-ruble"></i></div>'.

            '<div class="cart-item-to-favorite '.$is_in_favorites.'" data-id="'.$id.'"><i class="fa fa-trash-o"></i></div>'.
            '<div class="cart-item-qnt">'.
            '<div class="cart-item-qnt-dec fa fa-minus-circle '.$is_gramm_html.'"  data-id="'.$id.'"  data-price="'.$price.'"></div>'.
            '<div class="cart-item-qnt-value-holder"><span class="cart-item-qnt-value">'.$in_basket_count.'</span> '.$it_or_kg.'</div>'.
            '<div class="cart-item-qnt-inc fa fa-plus-circle '.$is_gramm_html.'" data-id="'.$id.'" data-price="'.$price.'"></div>'.
            '</div>'.
            '</div>'.

            '<div class="cart-item-total"><span class="cart-item-total-value">'.$total.'</span> <i class="fa fa-ruble"></i></div>'.
            '</div>';

    }else{

        $id = $p['product_id'];
        $name = $p['name'];
        $price = $p['price_site'];
        $product_count = $p['product_count'];
        $total = number_format($price * $product_count,2);
        $image = (strlen($p['image']) > 0) ? $p['image'] : $global_images_dir . 'cat-default.jpg';
        $is_gramm = ($p['qnt_type_sys'] == 'KG')? true : false;
        $is_gramm_html = ($is_gramm)? 'gramm-type': '';
        $it_or_kg = $p['qnt_type'];
        $in_basket_count = $p['in_basket_count'];
        $is_in_favorites =  ($p['in_favorite'] == true)? 'in_favorite' : '';

        switch($mode){

            case 'sidebar':

                $tpl .=
                    '<div class="cart-item cart-sidebar-tpl" data-id="'.$id.'">'.
                    '<div class="cart-item-image-holder">'.
                    '<img src="'.$image.'" alt="'.$name.'"/>'.
                    '</div>'.
                    '<div class="cart-item-title">'.$name.'</div>'.
                    '<div class="cart-item-to-favorite '.$is_in_favorites.'" data-id="'.$id.'"><i class="fa fa-heart-o"></i></div>'.
                    '<div class="cart-item-prices">'.
                    '<div class="cart-item-price">'.
                    '<div class="cart-item-single-price">Цена: <span class="product-item-price-int">'.$price.'</span> <i class="fa fa-ruble"></i></div>'.
                    '<div class="cart-item-qnt">'.
                    '<div class="cart-item-qnt-dec '.$is_gramm_html.' fa fa-minus-circle" data-id="'.$id.'" data-price="'.$price.'"></div>'.
                    '<div class="cart-item-qnt-value-holder"><span class="cart-item-qnt-value">'.$product_count.'</span> '.$it_or_kg.'</div>'.
                    '<div class="cart-item-qnt-inc '.$is_gramm_html.' fa fa-plus-circle" data-id="'.$id.'" data-price="'.$price.'"></div>'.
                    '</div>'.
                    '</div>'.
                    '<div class="cart-item-total"><span class="cart-item-total-value">'.$total.'</span> <i class="fa fa-ruble"></i></div>'.
                    '</div>'.
                    '</div>';

                break;

            case 'cart':

                $tpl .=
                    '<div class="cart-item cart-item-prices" data-id="'.$id.'">'.
                    '<div class="cart-item-image-holder">'.
                    '<img src="'.$image.'" alt="'.$name.'"/>'.
                    '</div>'.

                    '<div class="cart-item-info-holder">'.
                    '<div class="cart-item-title">'.$name.'</div>'.
                    '<div class="cart-item-single-price">Цена: <span class="product-item-price-int">'.$price.'</span> <i class="fa fa-ruble"></i></div>'.

                    '<div class="cart-item-to-favorite '.$is_in_favorites.'" data-id="'.$id.'"><i class="fa fa-heart-o"></i></div>'.
                    '<div class="cart-item-qnt">'.
                    '<div class="cart-item-qnt-dec fa fa-minus-circle '.$is_gramm_html.'"  data-id="'.$id.'"  data-price="'.$price.'"></div>'.
                    '<div class="cart-item-qnt-value-holder"><span class="cart-item-qnt-value">'.$product_count.'</span> '.$it_or_kg.'</div>'.
                    '<div class="cart-item-qnt-inc fa fa-plus-circle '.$is_gramm_html.'" data-id="'.$id.'" data-price="'.$price.'"></div>'.
                    '</div>'.
                    '</div>'.

                    '<div class="cart-item-total"><span class="cart-item-total-value">'.$total.'</span> <i class="fa fa-ruble"></i></div>'.
                    '</div>';

                break;

        }

    }



    return $tpl;

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
    wp_enqueue_script('uitabs',         get_stylesheet_directory_uri() . '/assets/js/uiTabs.js');
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


?>