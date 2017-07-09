<?php

/*
    Template Name: action_products
*/

    session_start();
    $PHPSESSID=session_id();

    $url = $global_prot . '://' . $global_url. '/site_api';

    //---ACTION PRODUCTS----------------------------

    $post_data4 = http_build_query(array(
        'sid' => $PHPSESSID,
        'site' => $global_site,
        'json' => '{"command":"get_action_product","params":{}}'
    ));

    $ch4 = curl_init();

    curl_setopt($ch4, CURLOPT_URL, $url );
    curl_setopt($ch4, CURLOPT_POST, 1 );
    curl_setopt($ch4, CURLOPT_POSTFIELDS, $post_data4);
    curl_setopt($ch4, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch4, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch4, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch4,CURLOPT_TIMEOUT,10);
    $resp4 = curl_exec($ch4);

    if (curl_errno($ch4)) {
        print curl_error($ch4);
    }
    curl_close($ch4);


    $jData4 = json_decode($resp4, true);

    $action_products_columns_all = $jData4['data_columns'];
    $action_products_data_all = $jData4['data'];

    $cc_name = 'Товары по акции';



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
        <a class="notd" href="/shop/"><div class="back-page"><i class="fa fa-arrow-circle-o-left "></i>&nbsp;&nbsp;Назад</div></a>
        <div class="category-title"><?php echo $cc_name; ?></div>
    </div>
</div>


<div class="site-content">

    <div class="container">


            <?php


            $ap_html = '';

            foreach($action_products_data_all as $key => $value){

                $ap_html .= render_product($value, 'action_card', $action_products_columns_all);

            }

            echo $ap_html;


            ?>


    </div>



</div>
<?php

include 'footer.php';
include 'foot_js.php';
?>


</body>
</html>