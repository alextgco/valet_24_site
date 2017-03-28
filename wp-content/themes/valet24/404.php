<?php
/*
    Template Name: 404
*/

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
            <div class="feature-1"><i class="feature-icon fa fa-clock-o"></i>&nbsp;&nbsp;Доставим Ваш заказ за 50 минут!</div>
            <div class="feature-2"><i class="feature-icon fa fa-money"></i>&nbsp;&nbsp;Бесплатная доставка от 1000 <i class="fa fa-ruble"></i></div>
            <div class="feature-3"><i class="feature-icon fa fa-thumbs-o-up"></i>&nbsp;&nbsp;Гарантия качества и свежести!</div>
        </div>
    </div>
</div>

<div class="site-content">

    <div class="container">

        <div class="main-page-headline"><b>404</b>, страница не найдена, попробуйте начать с <a href="/">главной стрницы</a>=)</div>

        <div class="row">


        </div>

        <div class="row">

            <?php include 'sets.php'; ?>

        </div>


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