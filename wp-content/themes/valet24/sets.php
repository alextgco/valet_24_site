<?php
/**
 * Created by PhpStorm.
 * User: aig
 * Date: 02.08.2016
 * Time: 1:45
 */
?>


<div class="sets-holder">

    <div class="main-page-headline">Готовые наборы продуктов, если Вы спешите:</div>

    <div class="col-sm-6 col-md-3">
        <a class="notd" href="/category_139"><div class="cat-item" data-id="123">
            <div class="cat-image-holder"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/cat_old/cat-1.jpg" /></div>
            <div class="cat-title-holder">
                Еда на неделю
            </div>
        </div></a>
    </div>

    <div class="col-sm-6 col-md-3">
        <a class="notd" href="/category_139"><div class="cat-item" data-id="123">
            <div class="cat-image-holder"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/cat_old/cat-4.jpg" /></div>
            <div class="cat-title-holder">
                Вегетарианский
            </div>
        </div></a>
    </div>

    <div class="col-sm-6 col-md-3">
        <a class="notd" href="/category_139"><div class="cat-item" data-id="123">
            <div class="cat-image-holder"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/cat_old/cat-42.jpg" /></div>
            <div class="cat-title-holder">
                Мясной ужин
            </div>
        </div></a>
    </div>

    <div class="col-sm-6 col-md-3">
        <a class="notd" href="/category_139">
            <div class="cat-item" data-id="123">
            <div class="cat-image-holder"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/cat_old/cat-41.jpg" /></div>
            <div class="cat-title-holder">
                Романтический вечер
            </div>
        </div>
        </a>
    </div>


<!--    --><?php
//
//
//        $sets_html = '';
//
//        foreach($jData2['product_sets'] as $key => $value){
//
//            $id = $value['id'];
//            $name = $value['name'];
//            $image = get_stylesheet_directory_uri() .'/assets/img/cat_old/cat-1.jpg';
//            //$value['image'];
//
//            $sets_html .= '<div class="col-sm-6 col-md-3">'
//                            .'<a class="notd" href="/set_'.$id.'">'
//                                .'<div class="cat-item" data-id="'.$id.'">'
//                                .'<div class="cat-image-holder"><img src="'.$image.'" /></div>'
//                                .'<div class="cat-title-holder">'.$name
//
//                                .'</div>'
//                            .'</div>'
//                            .'</a>'
//                        .'</div>';
//
//
//        }
//
//        echo $sets_html;
//
//
//    ?>

    <?php


    $sets_html = '';

    foreach($jData2['product_sets'] as $key => $value){

        $id = $value['id'];
        $name = $value['name'];
        $image = get_stylesheet_directory_uri() .'/assets/img/cat_old/cat-1.jpg';
        //$value['image'];

        $sets_html .= '<a class="notd" style="font-size: 10px;" href="/set_'.$id.'">'.$name.'</a>';


    }

    echo $sets_html;


    ?>


</div>