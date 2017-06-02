<?php




    $type_valet =         $_GET['type']; // CATEGORY | PRODUCT | SET
    $alias_url =          $_GET['alias'];
    $title_valet =        $_GET['name'];
    $code_valet =         $_GET['code'];


    function the_slug_exists($post_name) {
        global $wpdb;
        if($wpdb->get_row("SELECT post_name FROM wp_posts WHERE post_name = '" . $post_name . "'", 'ARRAY_A')) {
            return true;
        } else {
            return false;
        }
    }

    if($code_valet == 'SfL22ljis989128juaOaXCbsh91siuHHFs'){


        require_once('wp-load.php');

            if(!the_slug_exists($alias_url)){
                $tpl = '';

                switch($type_valet){
                    case 'CATEGORY':
                        $tpl = 'category.php';
                        break;
                    case 'PRODUCT':
                        $tpl = 'product.php';
                        break;
                    case 'SET':
                        $tpl = 'set.php';
                        break;
                }


                $my_post = array(
                    'post_title' => $title_valet,
                    'post_name' => $alias_url,
                    'post_type' => 'page',
                    'post_content' => '',
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_category' => array(8,39)
                );

                // Вставляем запись в базу данных
                $newPageId =  wp_insert_post( $my_post );

                update_post_meta($newPageId, '_wp_page_template', $tpl);


                echo '<STATUS>SUCCESS</STATUS>';
            }else{

                echo '<STATUS>ALREADY_EXSISTS</STATUS>';

            }

    }else{

//        echo 'ERROR:' . $_GET['type'] . ' - ' . $_GET['alias'] . ' - ' . $_GET['name'] . ' - ' . $_GET['code'];

        echo '<STATUS>ERROR</STATUS>';
    }

?>