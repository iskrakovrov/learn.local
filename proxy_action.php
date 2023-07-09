<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
if (!empty($_REQUEST['pa'])){
    $url = $_REQUEST['pa'];
    $ids = $_POST['a'];

    session_start();
    $_SESSION['ids'] = $ids;
    header("Location: $url");
    return true;
}else if (!empty($_REQUEST['del'])){
    $array = $_POST['a'];
    foreach ($array as $a) {

        $id = $a;
        $sql = 'DELETE FROM proxy WHERE id=?';
        $args = [$id];
        $querty = delete($sql, $args);

    }

    header('Location: ' .$_SERVER['HTTP_REFERER']);

}
if (empty($_REQUEST['add_task'])){
    header('Location: proxy.php');
}
