<?php

/*
    Template Name: confirm_email
*/

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

            <div class="category-title-nomargin">Почти готово!</div>
        </div>

        <div class="row">

            <div class="col-md-8">

                <div class="prepare-order-holder">

                    <h4 style="line-height: 27px;">
                        На Вашу почту было отправлено письмо с подтверждением регистрации, проверьте почту, откройте письмо от нас и нажмите <span style="color: #32b549;">"Завершить регистарцию"</span>.
                    </h4>


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