<?php

/*
    Template Name: finish_registration
*/

    session_start();
    $PHPSESSID=session_id();


    // Get user

    $key = $_GET['key'];
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

<div class="site-content prepare-order-page">

    <div class="container">

        <div class="row">



<!--            <div class="category-title-nomargin">Ура, всё готово!</div>-->
        </div>

        <div class="row">

            <div class="col-md-8">

                <div class="prepare-order-holder">

                    <?php

                    if($с_jData['code'] == 0){

                        echo '<script type="text/javascript">document.location.href = "/"; </script> ';

                    }else{

                        if($с_jData['code'] == -999){
                            echo $с_jData['err']['message'] . ' Вы можете войти в личный кабинет используя свой адрес электронной почты и Ваш пароль.';
                        }else{
                            echo $с_jData['err']['message'];
                        }



                    }

                    ?>

<!--                    <h4 style="line-height: 27px;">-->
<!--                        Теперь Вы можете-->
<!--                    </h4>-->


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