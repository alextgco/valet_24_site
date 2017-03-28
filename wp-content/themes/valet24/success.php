<?php

/*
    Template Name: success
*/

    $order_id = $_GET['order_id'];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Доставка продуктов за 1 час!</title>
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

            <div class="category-title-nomargin">Спасибо за заказ!</div>
        </div>

        <div class="row">

            <div class="col-md-8">

                <div class="prepare-order-holder">

                    <h3>
                        Ваш заказ № <span class="boldtext"><?php echo $order_id; ?></span> оформлен и находится в обработке, наш менеджер свяжется с Вами в ближайшее время.<br/><br/>
                        Спасибо что выбрали Valet24!.<br/><br/>
                        Перейти на <a href="/">главную страницу</a>
                    </h3>


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