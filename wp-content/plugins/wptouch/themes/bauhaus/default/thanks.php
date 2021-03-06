<?php
/*
    Template Name: thanks
*/


    $order_id =         $_POST['cf'];   // номер нашего заказа
    $ext_order_id =     $_POST['cf2'];  // внешний номер заказа
    $frame =            $_POST['cf3'];  // Фрейм
    $payment_id =       $_POST['paymentcode'];  // id платежа
    $email =            $_POST['email'];


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

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-WZPNKCM');</script>
    <!-- End Google Tag Manager -->

    <!--    <title>&nbsp;&nbsp;Мир Билета - Электронные билеты</title>-->

    <link href="/wp-content/themes/mirbileta_new_life/assets/img/favicon.png" rel="shortcut icon" type="image/i-icon">

    <meta name="viewport" content="width=device-width">


    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel='stylesheet' id='main-style' href='<?php echo get_stylesheet_uri(); ?>' type='text/css' media='all'/>

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?> data-page="inner" >

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZPNKCM"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


<div class="mmb-page-holder blank-page">
    <?php
    get_header();
    ?>

    <div class="mmb-blank-wrapper">

        <div class="mmb-headline">Спасибо!</div>

        <div class="thx-content">

<!--            <div class="thx-thx">Спасибо!</div>-->
            <div class="thx-order">
                Ваш заказ № <span class="order_id"><?php echo $order_id; ?></span> успешно оплачен, билеты<br>
                отправлены вам на почту. <span class="thx-email">(<?php echo $email;?>)</span>
            </div>
<!--        </div>-->

<!--        <div class="contest-fast-result-holder">-->
<!--            <div class="contest-fast-congrats">-->
<!--                Поздравляем!-->
<!--            </div>-->
<!--            <div class="contest-fast-result-wrapper">-->
<!--                <div class="contest-fast-result-text">Ваш результат:</div>-->
<!--                <div class="contest-fast-result"></div>-->
<!--            </div>-->
<!---->
<!--            <div class="contest-fast-timer-rate"><div class="contest-fast-go">Улучшить результат!</div></div>-->
<!--            <div class="contest-fast-timer-img"></div>-->
<!--            <a target="_blank" href="/contest-fast"><div class="contest-fast-watch-results">-->
<!--                    Смотреть все результаты-->
<!--                </div></a>-->
<!---->
<!--        </div>-->

<!--        <div class="thx-content">-->


            <div class="thx-contacts">
                По всем вопросам обращайтесь:<br>
                <br>
                +7 (499) 391-61-97<br>
                info@mirbileta.ru
            </div>



        </div>
        <div class="thx-footer">
            <div class="thx-footer-text">
                Приятного просмотра!
            </div>
        </div>

    </div>

    <?php if(strlen($order_id) > 0): ?>

        <input type="hidden" id="ORDER_ID" value="<?php echo $order_id; ?>"/>
        <input type="hidden" id="FRAME" value="<?php echo $frame; ?>"/>
        <input type="hidden" id="PAYMENT_ID" value="<?php echo $payment_id; ?>"/>

        <script type="text/javascript">
            $(document).ready(function(){
                return false;
                if(!!localStorage){

                    var isFinished = localStorage.getItem('mb-fast-contest-finished');
                    var contestData = localStorage.getItem('mb-fast-contest');

                    if(contestData != null){

                        socketQuery_b2e({

                            command:   'get_external_order_id',
                            order_id:   $('#ORDER_ID').val(),
                            cf3:        $('#FRAME').val(),
                            payment_id: $('#PAYMENT_ID').val()

                        }, function(res){

                            var jRes = JSON.parse(res).results[0];
                            if(jRes.code == 0){

                                var totalDelta = jRes['TOTAL_TIME'];

                                var s2 = moment(totalDelta).format('mm:ss:SS');

                                $('.contest-fast-result-holder').show(0);

                                var timeCase;
                                var text;
                                var image;

                                if(totalDelta <= 80000){
                                    timeCase = 'veryfast';
                                }else if(totalDelta > 80000 && totalDelta <= 120000){
                                    timeCase = 'fast';
                                }else if(totalDelta > 120000 && totalDelta <= 180000){
                                    timeCase = 'good';
                                }else if(totalDelta > 180000 && totalDelta <= 300000){
                                    timeCase = 'slow';
                                }else if(totalDelta > 300000 && totalDelta <= 600000){
                                    timeCase = 'veryslow';
                                }else{
                                    timeCase = 'veryslow';
                                }


                                switch (timeCase){
                                    case 'veryfast':
                                        text = 'Ого, вот это скорость!';
                                        image = 'veryfast';
                                        break;

                                    case 'fast':
                                        text = 'Отлично!';
                                        image = 'fast';
                                        break;

                                    case 'good':
                                        text = 'Хорошо!';
                                        image = 'good';
                                        break;

                                    case 'slow':
                                        text = 'Неспешно...';
                                        image = 'slow';
                                        break;

                                    case 'veryslow':
                                        text = 'Это было медленно =)';
                                        image = 'veryslow';
                                        break;

                                    default :
                                        text = 'Это было медленно =)';
                                        image = 'veryslow';
                                        break;
                                }

                                $('.contest-fast-timer-img').addClass(image);
                                $('.contest-fast-timer-rate').html(text);
                                $('.contest-fast-result').html(s2);


                                localStorage.removeItem('mb-fast-contest');
                                localStorage.setItem('mb-fast-contest-finished', 'TRUE');
                                localStorage.setItem('mb-fast-contest-finished-result', totalDelta);

                            }else{
                                $('.contest-fast-result-holder').hide(0);

//                            toastr['error']('Ошибка сервера');
                            }
                            console.log("RES", res);

                        });

                    }else if(isFinished != null && isFinished == 'TRUE'){


                        var totalDelta = +localStorage.getItem('mb-fast-contest-finished-result');

                        var s2 = moment(totalDelta).format('mm:ss:SS');

                        $('.contest-fast-result-holder').show(0);

                        var timeCase;
                        var text;
                        var image;

                        if(totalDelta <= 80000){
                            timeCase = 'veryfast';
                        }else if(totalDelta > 80000 && totalDelta <= 120000){
                            timeCase = 'fast';
                        }else if(totalDelta > 120000 && totalDelta <= 180000){
                            timeCase = 'good';
                        }else if(totalDelta > 180000 && totalDelta <= 300000){
                            timeCase = 'slow';
                        }else if(totalDelta > 300000 && totalDelta <= 600000){
                            timeCase = 'veryslow';
                        }else{
                            timeCase = 'veryslow';
                        }


                        switch (timeCase){
                            case 'veryfast':
                                text = 'Ого, вот это скорость!';
                                image = 'veryfast';
                                break;

                            case 'fast':
                                text = 'Отлично!';
                                image = 'fast';
                                break;

                            case 'good':
                                text = 'Хорошо!';
                                image = 'good';
                                break;

                            case 'slow':
                                text = 'Неспешно...';
                                image = 'slow';
                                break;

                            case 'veryslow':
                                text = 'Это было медленно =)';
                                image = 'veryslow';
                                break;

                            default :
                                text = 'Это было медленно =)';
                                image = 'veryslow';
                                break;
                        }

                        $('.contest-fast-timer-img').remove();//.addClass(image);//
                        $('.contest-fast-timer-rate').find('.contest-fast-go').show(0);
                        $('.contest-fast-result').html(s2);

                    }

                }

                $('.contest-fast-timer').remove();

            });
        </script>

    <?php endif ?>

    <?php

    include('custom_footer.php');

    ?>
</div>



</body>

