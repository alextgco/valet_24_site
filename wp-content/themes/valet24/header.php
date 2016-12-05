<?php



    $search_keyword = $_GET['search_keyword'];



?>


<div class="preheader">
    <div class="container">
        <div class="phone-holder">+7 (499) 684-21-11</div>
        <div class="email-holder sc-feedback-init">info@valet24.ru</div>
        <div class="hours-holder"><span class="invis-sm">Часы работы: </span><span class="big-white">КРУГЛОСУТОЧНО, БЕЗ ВЫХОДНЫХ</span></div>
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
