<?php

include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
if (empty ($_REQUEST['id'])) {

    $sql = 'SELECT * FROM proxy';

    $querty = selectAll($sql);
    foreach ($querty as $a) {
    $pr = $a;
check_proxy($pr);

    }
}else{
    $id=$_REQUEST['id'];
    $sql = 'SELECT * FROM proxy WHERE id = ?';
    $args = [$id];
    $querty = select($sql,$args);
        check_proxy($querty);
}



header('Location: ' . $_SERVER['HTTP_REFERER']);

