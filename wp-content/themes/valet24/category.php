<?php

/*
    Template Name: category
*/

        session_start();
        $PHPSESSID=session_id();

        $href = request_url();
        $arr = parse_url($href);
        $action_alias = preg_replace('/^\//','',$arr['path']);
        $action_alias = preg_replace('/(^\w+)\/.*/','$1',$action_alias);

        $category_full = preg_replace('/(^\w+)\/.*/','$1',$action_alias);
        $category_id = preg_replace('/category_/','$1', $category_full);



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
        curl_setopt($ch,CURLOPT_TIMEOUT,10);

        $resp = curl_exec($ch);

        if (curl_errno($ch)) {
            print curl_error($ch);
        }
        curl_close($ch);


        $jData = json_decode($resp, true);

        $columns = $jData['data_columns'];
        $data = $jData['data'];

//        "id",
//        "name",
//        "is_root",
//        "parent_category_id",
//        "parent_category",
//        "image",
//        "products_count",

        $children_arr = array();
        $products_arr = array();
        $root_category_id = 'EMPTY';

        foreach($data as $key=>$category){

            $id = $category[array_search('id',$columns)];
            $name = $category[array_search('name',$columns)];
            $is_root = $category[array_search('is_root',$columns)];
            $parent_category_id = $category[array_search('parent_category_id',$columns)];
            $parent_category = $category[array_search('parent_category',$columns)];
            $image = $category[array_search('image',$columns)];
            $products_count = $category[array_search('products_count',$columns)];


            if($id == $category_id){
                $current_category = $category;

                $root_category_id = $parent_category_id;

            }

            if($parent_category_id == $category_id){



                array_push($children_arr, $category);

            }


        }

        if(count($children_arr) == 0){



            $url2 = $global_prot . '://' . $global_url. '/site_api';

            $req2 = '{"command":"get_product","params":{"category_id":"'.$category_id.'","limit": "'.$perPage.'","page_no":"1"}}';

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
            curl_setopt($ch2,CURLOPT_TIMEOUT,10);

            $resp2 = curl_exec($ch2);

            if (curl_errno($ch2)) {
                print curl_error($ch2);
            }
            curl_close($ch2);


            $jData2 = json_decode($resp2, true);

            $columns2 = $jData2['data_columns'];
            $data2 = $jData2['data'];

        }

        $cc_name = $current_category[array_search('name',$columns)];
        $cc_back = strlen($current_category[array_search('parent_category_id',$columns)] > 0)? '/category_'.$current_category[array_search('parent_category_id',$columns)] : '/';



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
        <div class="category-title"><?php echo $cc_name; ?></div>
    </div>
</div>


<div class="site-content">

    <div class="container">

        <div class="row">

            <div class="col-sm-3 col-md-3">

                <div class="sidebar-search-holder">
                    <i class="sidebar-search-icon fa fa-search"></i>
                    <input type="text" placeholder="Быстрый поиск" id="sidebar-search">
                </div>

                <div class="sidebar-headline">Категории:</div>

                <div class="category-sidebar">
                    <?php include 'sidebar_menu.php'; ?>
                </div>

            </div>

            <div class="col-sm-9 col-md-9">



                <?php

                if(count($children_arr) > 0){

                    $cats_html = '';

                    foreach($children_arr as $key1=>$val1){

                        $id = $val1[array_search('id',$columns)];
                        $name = $val1[array_search('name',$columns)];
                        $image = (strlen($val1[array_search('image',$columns)]) > 0) ? $val1[array_search('image',$columns)] : $global_images_dir . 'cat-default.jpg';


                        $cats_html .= '<div class="col-sm-6 col-md-4">'.
                            '<a href="/category_'.$id.'"><div class="inner-cat-item" data-id="'.$id.'">'.
                            '<div class="cat-image-holder"><img src="'.$image.'" alt=" '.$name.'"/></div>'.
                            '<div class="cat-title-holder">'.$name.'</div>'.
                            '</div></a>'.
                            '</div>';

                    }

                    echo $cats_html;


                }else{


                    $products_html = '';
                    $poducts_counter = 0;

                    if(count($data2) > 0){

                        foreach($data2 as $key2=>$val2){


                            $products_html .= render_product($val2, 'card', $columns2);


                            $poducts_counter++;

                        }
                    }

                    echo $products_html;

                    if($poducts_counter >= $perPage){
                        echo '<div class="load-next-row"><div class="load-next" data-page="1" data-category="'.$category_id.'"  data-search="EMPTY" >Загрузить еще</div></div>';
                    }



                }




                ?>



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