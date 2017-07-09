<?php
/**
 * Created by PhpStorm.
 * User: aig
 * Date: 02.08.2016
 * Time: 1:45
 */
?>


<div class="ap-holder">

    <div class="container">

            <div class="main-page-headline ap-header">Товары по акции:&nbsp;&nbsp;&nbsp;<a href="/action_products/">Все товары по акции</a></div>

        <?php


        $ap_html = '';

        foreach($action_products_data as $key => $value){

            $ap_html .= render_product($value, 'action_card', $action_products_columns);

        }

        echo $ap_html;


        ?>
    </div>



</div>