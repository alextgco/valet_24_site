<?php

date_default_timezone_set('Europe/Moscow');

$global_prot = 'http';
$global_url = '78.107.237.51:81';
$global_site = 'valet24.ru';
$global_images_dir = 'http://valet24.tmweb.ru/images/';

function is_in_basket(){

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


function my_theme_load_resources() {


    wp_enqueue_style('bootstrap',       get_stylesheet_directory_uri() . '/assets/plugins/bootstrap-3.3.6-dist/css/bootstrap.min.css');
    wp_enqueue_style('fontawesome',     get_stylesheet_directory_uri() . '/assets/plugins/font-awesome-4.5.0/css/font-awesome.min.css');
    wp_enqueue_style('normalize',       get_stylesheet_directory_uri() . '/assets/css/normalize.css');
    wp_enqueue_style('core',            get_stylesheet_directory_uri() . '/assets/css/core.css');
//    wp_enqueue_style('style',           get_stylesheet_directory_uri() . '/assets/css/style.css');

    wp_enqueue_script('jquery_my',      get_stylesheet_directory_uri() . '/assets/plugins/jquery/jquery-1.12.0.min.js');
    wp_enqueue_script('bootstrap',      get_stylesheet_directory_uri() . '/assets/plugins/bootstrap-3.3.6-dist/js/bootstrap.min.js');
    wp_enqueue_script('script',         get_stylesheet_directory_uri() . '/assets/js/script.js');
    wp_enqueue_script('uitabs',         get_stylesheet_directory_uri() . '/assets/js/uiTabs.js');

}

add_action('wp_enqueue_scripts', 'my_theme_load_resources');

?>
