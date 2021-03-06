<?php
/*
    Template Name: single_venue
*/
//$cur_url = $_SERVER["REQUEST_URI"];
//
//$venue_alias = substr($cur_url, 1, (strlen($cur_url) - 2));
//$venue_alias = (strpos($venue_alias, '-') > -1)? substr($venue_alias,0, strpos($venue_alias, '-')) : substr($cur_url, 1, (strlen($cur_url) - 2));

$href = request_url();
$arr = parse_url($href);
$venue_alias = preg_replace('/^\//','',$arr['path']);
$venue_alias = preg_replace('/(^\w+)\/.*/','$1',$venue_alias);

$url = $global_prot . "://" . $global_url . "/cgi-bin/site?request=<command>get_venue</command><url>mirbileta.ru</url><venue_url_alias>".$venue_alias."</venue_url_alias>";

$ch = curl_init();

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

$resp = curl_exec($ch);

if (curl_errno($ch))
    print curl_error($ch);
else
    curl_close($ch);

$jData = json_decode($data);

$columns = json_decode($resp)->results["0"]->data_columns;
$data = json_decode($resp)->results["0"]->data[0];
$venue_id = $data[array_search("VENUE_ID", $columns)];

$address = $data[array_search("VENUE_ADDRESS", $columns)];
$g_address = $data[array_search("VENUE_GOGLE_ADDRESS", $columns)];

?>


<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->


<head>

    <meta charset="UTF-8"/>

    <title><?php wp_title('-', true, 'right'); ?></title>

    <!--    <title>&nbsp;&nbsp;Мир Билета - Электронные билеты</title>-->

    <link href="/wp-content/themes/mirbileta_new_life/assets/img/favicon.png" rel="shortcut icon" type="image/i-icon">

    <meta name="viewport" content="width=device-width">


    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel='stylesheet' id='main-style' href='<?php echo get_stylesheet_uri(); ?>' type='text/css' media='all'/>

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>  data-venue="<?php echo $venue_id;?>" data-page="inner">
<div class="page-holder actor-page">


<?php
get_header();
?>

    <div class="mmb-big-image" style="background-image: url('<?php echo $data[array_search("VENUE_URL_IMAGE_BIG", $columns)]; ?>')"></div>

    <div class="mmb-big-title"><?php echo $data[array_search("VENUE_NAME", $columns)]; ?></div>

    <div class="mmb-sub-title"><?php echo $data[array_search("VENUE_ADDRESS", $columns)]; ?></div>

    <?php if(strlen($address) > 0): ?>

        <div class="single-map-holder">

            <input id="address" type="hidden" value="<?php echo $g_address; ?>" />

            <div style=" width: 100%; height: 280px;" id="map_canvas"></div>

        </div>

    <?php endif ?>

    <?php

    if($data[array_search("VENUE_SITE_URL", $columns)]){
        echo '<a class="single-ext-link" href="'. $data[array_search("VENUE_SITE_URL", $columns)] .'" target="_blank">Сайт площадки</a>';
    }

    ?>


    <?php if(strlen($data[array_search("VENUE_DESCRIPTION", $columns)]) > 0): ?>

        <div class="mmb-plain-text"><?php echo $data[array_search("VENUE_DESCRIPTION", $columns)]; ?></div>

    <?php endif ?>



    <div class="mmb-mid-title">
        Мероприятия:
    </div>

    <div class="actions-wrapper flLeft wid100pr">
        <?php

        $url = $global_prot . "://" . $global_url . "/cgi-bin/site?request=<command>get_afisha</command><url>mirbileta.ru</url><page_no>1</page_no><rows_max_num>15</rows_max_num><venue_id>" . $venue_id . "</venue_id>";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        $resp = curl_exec($ch);

        if (curl_errno($ch))
            print curl_error($ch);
        else
            curl_close($ch);


        $columns = json_decode($resp)->results["0"]->data_columns;
        $data = json_decode($resp)->results["0"]->data;
        $actions_count = count($data);
        $show_next_button = $actions_count == 15;

        $actionsHtml = "";

        foreach ($data as $key => $value) {

            $act_id = $value[array_search("ACTION_ID", $columns)];
            $alias = (strlen($value[array_search("SHOW_URL_ALIAS", $columns)]) > 0) ? $value[array_search("SHOW_URL_ALIAS", $columns)] : $value[array_search("ACTION_URL_ALIAS", $columns)];
            $venue_alias = $value[array_search("VENUE_URL_ALIAS", $columns)];
            $frame = $value[array_search("FRAME", $columns)];
            $act_name = $value[array_search("ACTION_NAME", $columns)];
            $thumb =    (strlen($value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) > 0)? (strpos("http", $value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) == -1) ? 'https://shop.mirbileta.ru/upload/' . $value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] : $value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]: $defaultPoster;
            $poster =   (strlen($value[array_search("ACTION_POSTER_IMAGE", $columns)]) > 0 ) ? (strpos("http" , $value[array_search("ACTION_POSTER_IMAGE", $columns)]) == -1)? 'https://shop.mirbileta.ru/upload/' . $value[array_search("ACTION_POSTER_IMAGE", $columns)]: $value[array_search("ACTION_POSTER_IMAGE", $columns)] : $defaultPoster;
//                    $poster = (strpos("http", $value[array_search("ACTION_POSTER_IMAGE", $columns)]) == -1) ? 'https://shop.mirbileta.ru/upload/' . $value[array_search("ACTION_POSTER_IMAGE", $columns)] : $value[array_search("ACTION_POSTER_IMAGE", $columns)];
            $act_date = $value[array_search("ACTION_DATE_STR", $columns)];
            $act_time = $value[array_search("ACTION_TIME_STR", $columns)];
            $hall = $value[array_search("HALL", $columns)];
            $genre = $value[array_search("SHOW_GENRE", $columns)];
            $venue = $value[array_search("VENUE_NAME", $columns)];
            $minprice = $value[array_search("MIN_PRICE", $columns)];
            $maxprice = $value[array_search("MAX_PRICE", $columns)];

            $isInfo = strlen($description) > 0;
            $description = $value[array_search("DESCRIPTION", $columns)];

            $ageCat = strlen($value[array_search("AGE_CATEGORY", $columns)]) ? $value[array_search("AGE_CATEGORY", $columns)] : '0+';
            $act_date_time = $value[array_search("ACTION_DATE_TIME", $columns)];

            $short_date = to_afisha_date($act_date_time, "short_date", "rus");
            $short_date_with_year = to_afisha_date($act_date_time, "short_date_with_year", "rus");
            $week_and_time = to_afisha_date($act_date_time, "week_and_time", "rus");
            $weekday = to_afisha_date($act_date_time, "weekday", "rus");
            $time = to_afisha_date($act_date_time, "time", "rus");
            $price_range = ($minprice && $maxprice)? ($minprice == $maxprice)? 'по ' . $minprice . ' руб.' : $minprice . ' - ' . $maxprice . ' руб.' : '';
            $isShow = (strlen($value[array_search("SHOW_URL_ALIAS", $columns)]) > 0) ? 'c': '';

            $actionsHtml .= '<a href="/'.$alias.'"><div class="mb-me-action" data-id="'.$act_id.'">'
                .'<div class="mb-me-a-image" style="background-image: url(\''.$poster.'\');"></div>'
                .'<div class="mb-me-a-title">'.$act_name.'<span class="mb-me-a-age">'.$ageCat.'</span></div>'
                .'<div class="mb-me-a-venue">'.$venue.'</div>'
                .'<div class="mb-me-a-price">'.$price_range.'</div>'
                .'<div class="mb-me-a-date">'.$isShow.' '.$act_date.', <span class="mb-a-time">'.$act_time.'</span></div>'
                .'</div></a>';
        }

        if (strlen($actionsHtml) == 0) {
            echo '<div class="somethinggoeswrong">Что-то пошло не так, звоните +7 (906) 063-88-66</div>';
        } else {
            echo $actionsHtml;
        }

        //            echo $url;
        ?>
    </div>

    <?php if($show_next_button): ?>
        <div class="flLeft wid100pr">
            <div id="load_next" class="load_next_style_1">Загрузить еще</div>
        </div>

    <?php endif ?>




<?php

include('custom_footer.php');

?>

</div>
</body>
<?php if(strlen($address) > 0): ?>
    <script type="text/javascript">
        $(document).ready(function(){
            var geocoder;
            var map;
            var address = $('#address').val();
            function initialize() {
                geocoder = new google.maps.Geocoder();
                var latlng = new google.maps.LatLng(-34.397, 150.644);
                var myOptions = {
                    zoom: 16,
                    center: latlng,
                    mapTypeControl: true,
                    mapTypeControlOptions: {
                        style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
                    },
                    navigationControl: true,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };

                map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

                if (geocoder) {
                    geocoder.geocode({
                        'address': address
                    }, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
                                map.setCenter(results[0].geometry.location);

                                var infowindow = new google.maps.InfoWindow({
                                    content: '<b>' + address + '</b>',
                                    size: new google.maps.Size(150, 50)
                                });

                                var marker = new google.maps.Marker({
                                    position: results[0].geometry.location,
                                    map: map,
                                    title: address
                                });
                                google.maps.event.addListener(marker, 'click', function() {
                                    infowindow.open(map, marker);
                                });

                            } else {
                                //                            alert("No results found");
                            }
                        } else {
                            //                        alert("Geocode was not successful for the following reason: " + status);
                        }
                    });
                }
            }
            google.maps.event.addDomListener(window, 'load', initialize);
        });
    </script>
<?php endif ?>