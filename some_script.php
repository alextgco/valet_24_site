<?php
/**
 * Created by PhpStorm.
 * User: aig
 * Date: 19.03.2017
 * Time: 18:49
 */

if(isset($_POST['width']) && isset($_POST['height'])) {
    $_SESSION['screen_width'] = $_POST['width'];
    $_SESSION['screen_height'] = $_POST['height'];
    echo json_encode(array('outcome'=>'success'));
} else {
    echo json_encode(array('outcome'=>'error','error'=>"Couldn't save dimension info"));
}

?>

