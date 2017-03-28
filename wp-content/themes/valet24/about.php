<?php

/*
    Template Name: about
*/

        $href = request_url();
        $arr = parse_url($href);
        $action_alias = preg_replace('/^\//','',$arr['path']);
        $action_alias = preg_replace('/(^\w+)\/.*/','$1',$action_alias);

        $category_full = preg_replace('/(^\w+)\/.*/','$1',$action_alias);
        $category_id = preg_replace('/category_/','$1', $category_full);



        $url = $global_prot . '://' . $global_url. '/site_api';

        $req = '{"command":"get_category","params":{}}';

        $post_data = http_build_query(array(
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
            }

            if($parent_category_id == $category_id){

                array_push($children_arr, $category);

            }

        }

    $page_id = get_the_ID();

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
?>

<div class="after-header">
    <div class="container">
        <a class="notd" href="/"><div class="back-page"><i class="fa fa-arrow-circle-o-left "></i>&nbsp;&nbsp;Назад</div></a>
        <div class="category-title"><?php echo get_the_title($page_id); ?></div>
    </div>
</div>


<div class="site-content">

    <div class="container">

        <div class="row">


            <div class="col-md-12">


                <?php

                    echo get_post($page_id)->post_content;

                ?>

            </div>


        </div>


    </div>



</div>
<?php

include 'footer.php';
include 'foot_js.php';
?>

<!--SCRIPTS-->

<!--<script type="text/javascript" src="--><?php //echo get_stylesheet_directory_uri() ?><!--/assets/plugins/jquery/jquery-1.12.0.min.js"></script>-->
<!---->
<!---->
<!--<script type="text/javascript" src="assets/plugins/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>-->
<!--<script type="text/javascript" src="assets/plugins/blur/blur.js"></script>-->
<!--<script type="text/javascript" src="assets/plugins/mb-chekbox/mb-checkbox.js"></script>-->
<!--<script type="text/javascript" src="assets/plugins/mustache/mustache.js"></script>-->
<!--<script type="text/javascript" src="assets/plugins/ion.rangeSlider-2.1.2/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>-->
<!---->
<!--<script type="text/javascript" src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>-->
<!--<script type="text/javascript" src="assets/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.ru.min.js"></script>-->
<!---->
<!--<script type="text/javascript" src="assets/js/core.js"></script>-->
<!---->
<!--<script type="text/javascript" src="--><?php //echo get_stylesheet_directory_uri() ?><!--/assets/js/script.js"></script>-->

</body>
</html>