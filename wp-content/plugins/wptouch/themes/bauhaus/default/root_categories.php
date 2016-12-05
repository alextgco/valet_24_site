<?php

        $url = $global_prot . '://' . $global_url. '/site_api';

        $post_data = http_build_query(array(
            'site' => $global_site,
            'json' => '{"command":"get_category","params":{"is_root":true}}'
        ));

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url );
        curl_setopt($ch, CURLOPT_POST, 1 );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $resp = curl_exec($ch);

        if (curl_errno($ch)) {
            print curl_error($ch);
        }
        curl_close($ch);


        $jData = json_decode($resp, true);

        $columns = $jData['data_columns'];
        $data = $jData['data'];


        include 'basket_top.php';

        echo '<div class="categories-holder">';
        $cats_html = '';

        foreach($data as $key => $value){

            $id = $value[array_search('id',$columns)];
            $name = $value[array_search('name',$columns)];
            $image = (strlen($value[array_search('image',$columns)]) > 0) ? $value[array_search('image',$columns)] : $global_images_dir . 'cat-default.jpg';


            $cats_html .=  '<div class="pr50 notd"><a class="notd" href="/category_'.$id.'">'.
                                '<div class="cat-item" data-id="'.$id.'">'.
                                    '<div class="cat-image-holder"><img src="'.get_stylesheet_directory_uri().'/assets/img/'.$image.'"  alt="'.$name.'"/></div>'.
                                '</div>'.
                            '</a></div>';

        }



        echo $cats_html;
        echo '</div>';

?>

