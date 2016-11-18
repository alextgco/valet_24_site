<?php

/*
    Template Name: search_results
*/

    session_start();
    $PHPSESSID=session_id();

    $search_keyword = $_GET['search_keyword'];

    $href = request_url();
    $arr = parse_url($href);
    $action_alias = preg_replace('/^\//','',$arr['path']);
    $action_alias = preg_replace('/(^\w+)\/.*/','$1',$action_alias);

    $category_full = preg_replace('/(^\w+)\/.*/','$1',$action_alias);
    $category_id = preg_replace('/category_/','$1', $category_full);



    $url = $global_prot . '://' . $global_url. '/site_api';

    $req = '{"command":"get_category","params":{}}';

    $post_data = http_build_query(array(
        'sid' => $PHPSESSID,
        'site' => $global_site,
        'json' => $req
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

    //        "id",
    //        "name",
    //        "is_root",
    //        "parent_category_id",
    //        "parent_category",
    //        "image",
    //        "products_count",

    $children_arr = array();
    $products_arr = array();

    foreach($data as $key=>$category){

        $id = $category[array_search('id',$columns)];
        $name = $category[array_search('name',$columns)];
        $is_root = $category[array_search('is_root',$columns)];
        $parent_category_id = $category[array_search('parent_category_id',$columns)];
        $parent_category = $category[array_search('parent_category',$columns)];
        $image = $category[array_search('image',$columns)];
        $products_count = $category[array_search('products_count',$columns)];


        if($id == $category_id){
            $current_category = $category;
        }

        if($parent_category_id == $category_id){

            array_push($children_arr, $category);

        }

    }



    $url2 = $global_prot . '://' . $global_url. '/site_api';

    $req2 = '{"command":"get_product","params":{"name":"'.$search_keyword.'","limit": "30","page_no":"1"}}';

    $post_data2 = http_build_query(array(
        'sid' => $PHPSESSID,
        'site' => $global_site,
        'json' => $req2
    ));

    $ch2 = curl_init();

    curl_setopt($ch2, CURLOPT_URL, $url2 );
    curl_setopt($ch2, CURLOPT_POST, 1 );
    curl_setopt($ch2, CURLOPT_POSTFIELDS, $post_data2);
    curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
    $resp2 = curl_exec($ch2);

    if (curl_errno($ch2)) {
        print curl_error($ch2);
    }
    curl_close($ch2);


    $jData2 = json_decode($resp2, true);

    $columns2 = $jData2['data_columns'];
    $data2 = $jData2['data'];



    $cc_name = $current_category[array_search('name',$columns)];
    $cc_back = strlen($current_category[array_search('parent_category_id',$columns)] > 0)? '/category_'.$current_category[array_search('parent_category_id',$columns)] : '/';



    var_export($data2);
?>