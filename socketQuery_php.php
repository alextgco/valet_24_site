<?php

    session_start();
    $PHPSESSID=session_id();
    //echo $PHPSESSID;


    $global_prot = 'http';
    $global_url = '78.107.237.51:81';
    $global_site = 'valet24.ru';
    $global_images_dir = 'http://valet24.tmweb.ru/images/';

    $json = $_POST['json'];

    $url = $global_prot . '://' . $global_url. '/site_api';

    $post_data = http_build_query(array(
        'sid' => $PHPSESSID,
        'site' => $global_site,
        'json' => $json
    ));

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url );
    curl_setopt($ch, CURLOPT_POST, 1 );
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch,CURLOPT_TIMEOUT,10);

    $resp = curl_exec($ch);

    if (curl_errno($ch)) {
        print curl_error($ch);
    }
    curl_close($ch);


//    $jData = json_decode($resp['responseText'], true);

//    $columns = $jData['data_columns'];
//    $data = $jData['data'];

    echo $resp;

//var o = {
//    site:'valet24.ru',
//        json:JSON.stringify(obj)
//    };
//    $.ajax({
//        url: 'http://192.168.1.35:81/site_api',
//        method: 'GET',
//        data: o ,
//        dataType: "jsonp",
//        error: function (err) {
//    toastr.error('Не удалось подключиться к серверу jsonp.', 'Ошибка!');
//    console.log(err);
//    //if (typeof callback == 'function') callback('NOT_AVALIBLE');
//},
//        success: function (result) {
//    console.log(result);
//    if (typeof callback == 'function') callback(JSON.stringify(result));
//        }
//    });


?>