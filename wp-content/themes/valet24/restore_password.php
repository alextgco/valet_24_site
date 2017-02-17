<?php

/*
    Template Name: restore_password
*/

    $key = $_GET['key'];
    $key2 = $_GET['key2'];



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

            <h4 class="conf-order-account-header">Восстановление пароля, укажите новый пароль в форме ниже.</h4>

        </div>

        <div class="row">

            <div class="col-md-8">

                <div class="prepare-order-holder">

                    <label class="pa-m-label">Придумайте пароль (запишите чтобы не забыть):</label>
                    <input class="pa-m-input" type="password" id="pa-o-password" placeholder="Пароль "/>
                    <label class="pa-m-label">Повторите пароль:</label>
                    <input class="pa-m-input" type="password" id="pa-o-password-rpt" placeholder="Пароль ещё раз"/>
                    <div class="pa-m-restore-password pa-button" data-key="<?php echo $key;?>" data-key2="<?php echo $key2;?>"><i class="fa fa-lock"></i>&nbsp;&nbsp;Сохранить пароль</div>

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