<?php

/*
    Template Name: account_edit
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
<body data-user="<?php echo $user_exists?>">
<?php
include 'header.php';
?>


<script type="text/javascript">
    if(!<?php var_export($user_exists);?>){
        document.location.href = '/';
    }
</script>

<div class="site-content">

    <div class="container">

        <div class="row posRel">

            <div class="category-title-nomargin">Редактирование персональных данных</div>
            <div class="account-edit-back" data-id="<?php echo $user_jData['user']['id'];?>">В кабинет</div>
            <div class="account-exit" data-id="<?php echo $user_jData['user']['id'];?>">Выйти</div>
        </div>

        <div class="row">



            <div class="col-md-8">

                <div class="row">
                    <div class=" col-md-12">
                        <div class="form-group">
                            <label>Ваш адрес:</label>
                            <input type="text" class="form-control" id="address" value="<?php echo $user_jData['user']['address']; ?>"/>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class=" col-md-12">
                        <div class="form-group">
                            <label>Имя:</label>
                            <input type="text" class="form-control"  id="name" value="<?php echo $user_jData['user']['name']; ?>"/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class=" col-md-6">
                        <div class="form-group">
                            <label><span class="redStar">*</span>Телефон:</label>
                            <input type="text" class="form-control"  id="phone" value="<?php echo $user_jData['user']['phone']; ?>"/>
                        </div>
                    </div>

                    <div class=" col-md-6">
                        <div class="form-group">
                            <label>Почта:</label>
                            <input type="text" class="form-control"  id="email" value="<?php echo $user_jData['user']['email']; ?>"/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class=" col-md-6">
                        <div class="form-group">
                            <label>Подъезд:</label>
                            <input type="text" class="form-control"  id="gate" value="<?php echo $user_jData['user']['gate']; ?>" />
                        </div>
                    </div>
                    <div class=" col-md-6">
                        <div class="form-group">
                            <label>Код домофона:</label>
                            <input type="text" class="form-control"  id="gatecode" value="<?php echo $user_jData['user']['gatecode']; ?>"/>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class=" col-md-6">
                        <div class="form-group">
                            <label>Этаж:</label>
                            <input type="text" class="form-control"  id="level" value="<?php echo $user_jData['user']['level']; ?>"/>
                        </div>
                    </div>
                    <div class=" col-md-6">
                        <div class="form-group">
                            <label>Квартира:</label>
                            <input type="text" class="form-control"  id="flat" value="<?php echo $user_jData['user']['level']; ?>"/>
                        </div>
                    </div>
                </div>

                <div class="save-account pa-button" data-id="<?php echo $user_jData['user']['id'];?>"><i class="fa fa-save"></i>&nbsp;&nbsp;Сохранить</div>

            </div>


        </div>


    </div>

    <?php

    include 'footer.php';
    include 'foot_js.php';
    ?>



</body>
</html>