<?php

/*
    Template Name: finish_registration_order
*/


    session_start();
    $PHPSESSID=session_id();


    // Get user

    $key = $_GET['confirm_key'];
    $key2 = $_GET['key2'];

    $c_url = $global_prot . '://' . $global_url. '/site_api';

    $c_req = '{"command":"confirm_registration","params":{"confirm_key": "'.$key.'", "confirm_key2": "'.$key2.'"}}';

    $c_post_data = http_build_query(array(
        'sid' => $PHPSESSID,
        'site' => $global_site,
        'json' => $c_req
    ));

    $c_ch = curl_init();

    curl_setopt($c_ch, CURLOPT_URL, $c_url );
    curl_setopt($c_ch, CURLOPT_POST, 1 );
    curl_setopt($c_ch, CURLOPT_POSTFIELDS, $c_post_data);
    curl_setopt($c_ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($c_ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($c_ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c_ch,CURLOPT_TIMEOUT,10);
    curl_setopt($c_ch,CURLOPT_TIMEOUT,10);

    $с_resp = curl_exec($c_ch);

    if (curl_errno($c_ch)) {
        print curl_error($c_ch);
    }
    curl_close($c_ch);

    $с_jData = json_decode($с_resp, true);


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Доставка продуктов без комиссии!</title>
    <link href="<?php echo get_stylesheet_directory_uri() ?>/assets/img/favicon.png" rel="shortcut icon"
          type="image/i-icon">

    <?php include 'head_css.php'; ?>

</head>
<body>
<?php
include 'header.php';
?>

<div class="site-content prepare-order-page finish_registration_order">

    <div class="container">

        <div class="row">

            <?php

            if($с_jData['code'] == 0){

                echo '<div class="category-title-nomargin">Завершение регистарции, осталось только придумать пароль!</div>';

            }else{

                echo $cart_jData['toastr']['message'];

            }

            ?>


        </div>

        <div class="row">

            <div class="col-md-8">

                <div class="prepare-order-holder">

                    <?php

                    if($с_jData['code'] == 0){

                        echo '<label class="pa-m-label">Придумайте пароль (запишите чтобы не забыть):</label>'.
                                '<input class="pa-m-input" type="password" id="pa-password" placeholder="Пароль"/>'.
                                '<label class="pa-m-label">Повторите пароль:</label>'.
                                '<input class="pa-m-input" type="password" id="pa-password-rpt" placeholder="Пароль ещё раз"/>'.
                                '<div class="pa-m-register-order pa-button"><i class="fa fa-lock"></i>&nbsp;&nbsp;Сохранить пароль</div>';

                    }else{

                        echo $cart_jData['toastr']['message'];

                    }

                    ?>



                </div>

            </div>

            <div class="col-md-4 posRel">



            </div>





        </div>


    </div>


</div>

<?php

include 'footer.php';
include 'foot_js.php';
?>


</body>
</html>