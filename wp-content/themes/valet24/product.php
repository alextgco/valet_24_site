<?php

/*
    Template Name: product
*/

        session_start();
        $PHPSESSID=session_id();

        $href = request_url();
        $arr = parse_url($href);
        $action_alias = preg_replace('/^\//','',$arr['path']);
        $action_alias = preg_replace('/(^\w+)\/.*/','$1',$action_alias);

        $product_full = preg_replace('/(^\w+)\/.*/','$1',$action_alias);
        $product_id = preg_replace('/product_/','$1', $product_full);



        $url = $global_prot . '://' . $global_url. '/site_api';

        $req = '{"command":"get_category","params":{}}';

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
        $resp = curl_exec($ch);

        if (curl_errno($ch)) {
            print curl_error($ch);
        }
        curl_close($ch);


        $jData = json_decode($resp, true);

        $columns = $jData['data_columns'];
        $data = $jData['data'];




        $url2 = $global_prot . '://' . $global_url. '/site_api';

        $req2 = '{"command":"get_product","params":{"id":"'.$product_id.'"}}';

        $post_data2 = http_build_query(array(
            'sid' => $PHPSESSID,
            'site' => $global_site,
            'json' => $req2
        ));

        $ch2 = curl_init();

        curl_setopt($ch2, CURLOPT_URL, $url2 );
        curl_setopt($ch2, CURLOPT_POST, 1 );
        curl_setopt($ch2, CURLOPT_POSTFIELDS, $post_data2);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        $resp2 = curl_exec($ch2);

        if (curl_errno($ch2)) {
            print curl_error($ch2);
        }
        curl_close($ch2);


        $jData2 = json_decode($resp2, true);

        $columns2 = $jData2['data_columns'];
        $data2 = $jData2['data'][0];


        $parent_category_id = $data2[array_search('parent_category_id',$columns2)];
        $category_id = $data2[array_search('category_id',$columns2)];

        $cc_back = strlen($data2[array_search('category_id',$columns2)] > 0)? '/category_'.$data2[array_search('category_id',$columns2)] : '/';


        $root_category_id = $parent_category_id;



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Доставка продуктов без комиссии!</title>
    <link href="<?php echo get_stylesheet_directory_uri() ?>/assets/img/favicon.png" rel="shortcut icon" type="image/i-icon">
    <?php include 'head_css.php'; ?>

</head>
<body>
<?php
include 'header.php';
?>

<div class="after-header">
    <div class="container">
        <a class="notd" href="<?php echo $cc_back; ?>"><div class="back-page"><i class="fa fa-arrow-circle-o-left "></i>&nbsp;&nbsp;Назад</div></a>
        <div class="category-title"><?php echo $data2[array_search('name', $columns2)]; ?></div>
    </div>
</div>


<div class="site-content">

    <div class="container">

        <div class="row">

            <div class="col-md-3">

                <div class="sidebar-search-holder">
                    <i class="sidebar-search-icon fa fa-search"></i>
                    <input type="text" placeholder="Быстрый поиск" id="sidebar-search">
                </div>

                <div class="sidebar-headline">Категории:</div>

                <div class="category-sidebar">
                    <?php include 'sidebar_menu.php'; ?>
                </div>

            </div>

            <div class="col-md-9">



                <?php

                    $id = $data2[array_search('id',$columns2)];
                    $name = $data2[array_search('name',$columns2)];
                    $desc = (count($data2[array_search('description',$columns2)]) > 1) ? $data2[array_search('description',$columns2)] : 'Описание отсутствует';
                    $price = $data2[array_search('price_site',$columns2)];

                    $image = (strlen($data2[array_search('image',$columns2)]) > 0) ? $data2[array_search('image',$columns2)] : $global_images_dir . 'cat-default.jpg';

                    $in_basket_count = $data2[array_search('in_basket_count',$columns2)];

                    $btn_html = ($in_basket_count > 0)? '<div class="inc-btn-holder"><div class="inc-btn-dec" data-id="'.$id.'">-</div><div class="inc-btn-value">'.$in_basket_count.'</div><div class="inc-btn-inc" data-id="'.$id.'">+</div></div>' : '<div class="first-add-cart">В корзину</div>';

                    $addedClass = ($in_basket_count > 0)?'added': '';


                ?>

                <div class="col-md-4">

                    <div class="prod-item-image-holder"><img src="<?php echo $image; ?>"></div>

                </div>
                <div class="col-md-8">

                    <div class="prod-item-desc">

                        <?php echo $desc; ?>

                    </div>

                    <div class="single-product-footer">

                        <div class="prod-item-price"><?php echo $price; ?>&nbsp;<i class="fa fa-ruble"></i></div>

                        <div class="single-product-add-holder product-add-holder sc-product-add <?php echo $addedClass; ?>"  data-id="<?php echo $id; ?>">
                            <?php echo $btn_html; ?>
                        </div>

                    </div>

                </div>

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