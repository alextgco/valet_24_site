<?php

/*
    Template Name: set
*/

        session_start();
        $PHPSESSID=session_id();

        $href = request_url();
        $arr = parse_url($href);
        $action_alias = preg_replace('/^\//','',$arr['path']);
        $action_alias = preg_replace('/(^\w+)\/.*/','$1',$action_alias);

        $category_full = preg_replace('/(^\w+)\/.*/','$1',$action_alias);
        $set_id = preg_replace('/set_/','$1', $category_full);



        $url = $global_prot . '://' . $global_url. '/site_api';

        $req = '{"command":"get_set_products","params":{"set_id":"'.$set_id.'"}}';

        $post_data = http_build_query(array(
            'sid' => $PHPSESSID,
            'site' => $global_site,
            'json' => $req
        ));

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url );
        curl_setopt($ch, CURLOPT_POST, 1 );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_TIMEOUT,10);

        $resp = curl_exec($ch);

        if (curl_errno($ch)) {
            print curl_error($ch);
        }
        curl_close($ch);

        $jData = json_decode($resp, true);

        $columns = $jData['products']['data_columns'];
        $data = $jData['products']['data'];

        $set_price = 0;

        foreach($data as $pk=>$pv){

            $set_price += round(($pv[array_search('in_set_count', $columns)] * $pv[array_search('price_site', $columns)]), 2);

        }


        //--SETS---------------------

        $req2 = '{"command":"get_sets","params":{}}';

        $post_data2 = http_build_query(array(
            'sid' => $PHPSESSID,
            'site' => $global_site,
            'json' => $req2
        ));

        $ch2 = curl_init();

        curl_setopt($ch2, CURLOPT_URL, $url );
        curl_setopt($ch2, CURLOPT_POST, 1 );
        curl_setopt($ch2, CURLOPT_POSTFIELDS, $post_data2);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch2,CURLOPT_TIMEOUT,10);

        $resp2 = curl_exec($ch2);

        if (curl_errno($ch2)) {
            print curl_error($ch2);
        }
        curl_close($ch2);


    $jData2 = json_decode($resp2, true);
    $sets_data = $jData2['product_sets'];

    $current_set = array();

    foreach($sets_data as $skey=>$sval){
        if($sval['id'] == $set_id){
            $current_set = $sval;
        }
    }

    $cc_back = '/';


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Доставка продуктов за 1 час!</title>
    <link href="<?php echo get_stylesheet_directory_uri() ?>/assets/img/favicon.png" rel="shortcut icon" type="image/i-icon">
    <?php include 'head_css.php'; ?>

</head>
<body>
<?php
include 'header.php';
include 'float_cart.php';



?>



<div class="after-header">
    <div class="container">
        <a class="notd" href="<?php echo $cc_back; ?>"><div class="back-page"><i class="fa fa-arrow-circle-o-left "></i>&nbsp;&nbsp;Назад</div></a>
        <div class="category-title">
            <?php
            echo $current_set['name'];
            ?>
        </div>
    </div>
</div>


<div class="site-content">

    <div class="container">

        <div class="row">

            <div class="col-sm-3 col-md-3">

                <div class="sidebar-headline">Пакеты:</div>

                <div class="category-sidebar">

                    <?php

                    $sets_html = '';

                    foreach($sets_data as $skey2=>$sval2){

                        $is_current = '';

                        if($sval2['id'] == $set_id){
                            $is_current = 'current-set';
                        }

                        $sets_html .= '<div class="sidebar-set-item" data-id="'.$sval2['id'].'">'.
                        '<a href="/set_'.$sval2['id'].'" class="sidebar-set-item-link">'.$sval2['name'].
                        '</a>'.
                        '</div>';

                    }

                    echo $sets_html;

                    ?>

<!--                    --><?php //include 'set_sidebar_menu.php'; ?>
                </div>

            </div>

            <div class="col-sm-9 col-md-9">

                <div class="add-set-to-basket-box">
                    <div class="add-set-to-basket-title">Стоимость пакета: <?php echo $set_price;?> руб.</div>
                    <div class="add-set-to-basket-button" data-id="<?php echo $current_set['id'];?>">Добавить пакет в корзину</div>
                </div>

                <div class="set-products-box">
                <?php

                    $products_html = '';
                    $poducts_counter = 0;

                    if(count($data) > 0){

                        foreach($data as $key2=>$val){

                            $products_html .= render_product($val, 'set', $columns);


                            $poducts_counter++;

                        }
                    }

                    echo $products_html;

                    if($poducts_counter >= $perPage){
                        echo '<div class="load-next-row"><div class="load-next" data-page="1" data-category="'.$category_id.'"  data-search="EMPTY" >Загрузить еще</div></div>';
                    }


                ?>
                </div>

                <div class="add-set-to-basket-box-bottom">
                    <div class="add-set-to-basket-title">Стоимость пакета: <?php echo $set_price;?> руб.</div>
                    <div class="add-set-to-basket-button" data-id="<?php echo $current_set['id'];?>">Добавить пакет в корзину</div>
                </div>


            </div>




            <div class="cat-dd-row"></div>

        </div>


    </div>



</div>
<?php

include 'footer.php';
include 'foot_js.php';
?>


</body>
</html>