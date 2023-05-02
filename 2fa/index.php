<?php
require_once 'GoogleAuthenticator.php';
if(isset($_GET['key'])){
    $key = trim($_GET['key']);
    $ga = new PHP_GoogleAuthenticator();
    $code = $ga->getCode($key);
    $list = ['key' =>$key, 'code' =>$code];
    echo json_encode($list, JSON_PRETTY_PRINT);
}
if(isset($_POST['key'])){
    $key = trim($_POST['key']);
    $ga = new PHP_GoogleAuthenticator();
    $code = $ga->getCode($key);
    $list = ['key' =>$key, 'code' =>$code];
    echo json_encode($list, JSON_PRETTY_PRINT);
}
if(isset($_REQUEST['key'])){
    $key = trim($_REQUEST['key']);
    $ga = new PHP_GoogleAuthenticator();
    $code = $ga->getCode($key);
    $list = ['key' =>$key, 'code' =>$code];
    echo json_encode($list, JSON_PRETTY_PRINT);
}
?>
