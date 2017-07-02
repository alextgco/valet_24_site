<?php

/*
    Template Name: review
*/

    session_start();
    $PHPSESSID=session_id();

    $href = request_url();
    $arr = parse_url($href);

    $url = $global_prot . '://' . $global_url. '/site_api';

    $req = '{"command":"get_reviews","params":{}}';

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


    $cc_back = '/shop/';



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


            <?php

                var_export($data);

            ?>


        </div>


    </div>



</div>
<?php

include 'footer.php';
include 'foot_js.php';
?>


</body>
</html>