<?php
/*
    Template Name: 404
*/

    $href = request_url();
    $arr = parse_url($href);


    $action_alias = preg_replace('/^\//','',$arr['path']);
    $action_alias = preg_replace('/(^\w+)\/.*/','$1',$action_alias);
    $category_full = preg_replace('/(^\w+)\/.*/','$1',$action_alias);
    $category_id = preg_replace('/category_/','$1', $category_full);

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

<?php include 'header.php'; ?>

<div class="after-header">
    <div class="container">
        <div class="main-greetings">
<!--            Добро пожаловать в наш онлайн супермаркет!<br/>-->
            <div class="feature-1"><i class="feature-icon fa fa-clock-o"></i>&nbsp;&nbsp;Доставим Ваш заказ за <span class="feature-number">59</span> минут!</div>
            <div class="feature-2"><i class="feature-icon fa fa-money"></i>&nbsp;&nbsp;Доставка <span class="feature-number">150</span> рублей!</div>
            <div class="feature-3"><i class="feature-icon fa fa-thumbs-o-up"></i>&nbsp;&nbsp;Гарантия качества и свежести!</div>
        </div>
    </div>
</div>

<div class="site-content">

    <div class="container">


        <?php if($category_id == 4037 || $category_id == 4038): ?>

            <div id="content">


                <?php

                $customText = ($category_id == 4038)? 'Привезем Вам цветы':'Привезем Вашу любимую еду из ресторанов быстрого обслуживания';

                ?>

                    <h2 style="padding-right: 10px; padding-left: 10px;">
                        <?php echo $customText; ?>, звоните:<br/><br/>

                        <b>+7 (495) 134-39-12</b><br/><br/>

                        или оставляйте заявки на почте:<br/><br/>

                        <b>info@valet24.ru</b>

                    </h2>

            </div>

        <?php endif; ?>

        <?php if($category_id != 4037 && $category_id != 4038): ?>

            <div class="main-page-headline"><b>404</b>, страница не найдена, попробуйте начать с <a href="/">главной стрницы</a>=)</div>

            <div class="row">

            </div>

            <div class="row">

                <?php include 'sets.php'; ?>

            </div>
        <?php endif; ?>




    </div>



</div>

<?php

include 'footer.php';

?>
<!--SCRIPTS-->

<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/assets/plugins/jquery/jquery-1.12.0.min.js"></script>
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
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/assets/js/script.js"></script>

</body>
</html>