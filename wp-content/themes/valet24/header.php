<?php


    session_start();
    $PHPSESSID=session_id();


    $search_keyword = ($_GET['search_keyword'])? $_GET['search_keyword']: '';

    // Get user

    $user_url = $global_prot . '://' . $global_url. '/site_api';

    $user_req = '{"command":"get_user","params":{}}';

    $user_post_data = http_build_query(array(
        'sid' => $PHPSESSID,
        'site' => $global_site,
        'json' => $user_req
    ));

    $user_ch = curl_init();

    curl_setopt($user_ch, CURLOPT_URL, $user_url );
    curl_setopt($user_ch, CURLOPT_POST, 1 );
    curl_setopt($user_ch, CURLOPT_POSTFIELDS, $user_post_data);
    curl_setopt($user_ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($user_ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($user_ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($user_ch,CURLOPT_TIMEOUT,10000);
    curl_setopt($user_ch,CURLOPT_TIMEOUT,10000);

    $user_resp = curl_exec($user_ch);

    if (curl_errno($user_ch)) {
        print curl_error($user_ch);
    }
    curl_close($user_ch);

    $user_jData = json_decode($user_resp, true);
    $user_exists = ($user_jData['code'] == 0);



?>

<div class="site-fader-holder">

    <div class="container posRel">
        <div class="site-fader-close"></div>
        <div class="site-fader-content">

        </div>
    </div>
</div>

<div class="preheader">
    <div class="container">
        <div class="phone-holder">+7 (499) 684-21-11</div>
        <div class="email-holder sc-feedback-init">info@valet24.ru</div>

        <?php

        if($user_exists){
            echo '<div class="to-pa">'. $user_jData['user']['name'] .', здесь Ваш личный кабинет!</div>';
        }else{
            echo '<div class="pa-btn"><i class="fa fa-lock"></i>&nbsp;&nbsp;Личный кабинет</div>';
        }

        ?>


        <div id="ooo-ooo">


            <?php

            var_export($user_jData);

            ?>

        </div>


        <div class="hours-holder">
            <span class="invis-sm">Часы работы: </span>
            <span class="big-white-icon"></span>
<!--            <span class="big-white">КРУГЛОСУТОЧНО, БЕЗ ВЫХОДНЫХ</span>-->
        </div>
    </div>
</div>
<div class="header just_loaded">

    <div class="top-bg-image-holder"></div>

    <div class="container">

        <div class="logo-holder">
            <a href="/">
                <div class="logo">
                    <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/logo_new.png" />
                </div>
                <div class="logo-text main-site-title">
                    КРУГЛОСУТОЧНАЯ<br/>
                    КУРЬЕРСКАЯ<br/>
                    СЛУЖБА
                </div>
            </a>

        </div>


        <div class="search-holder">

            <form action="/search_results" method="GET">
                <input id="main-search" name="search_keyword" placeholder="Найти товар, категорию" value="<?php echo $search_keyword;?>"/>
                <input type="submit" class="search-confirm fa fa-search" value=""/>
                <div class="search-confirm-icon fa fa-search"></div>
<!--                search_keyword-->
            </form>




            <div class="search-dd">

            </div>

        </div>

        <div class="to-top"><i class="fa fa-arrow-up"></i><br/>Наверх</div>

        <?php

            include "basket_top.php";

        ?>




<!--        <div class="contacts-holder">-->
<!--            <div class="contacts-phone">-->
<!--                +7 (499) 684-77-12-->
<!--            </div>-->
<!--            <div class="contacts-email">-->
<!--                valet24@mail.ru-->
<!--            </div>-->
<!--            <div class="timeofwork">-->
<!--                Круглосуточно!-->
<!--            </div>-->
<!--        </div>-->

    </div>

</div>
