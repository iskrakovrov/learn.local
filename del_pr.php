<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');


$array = $_POST['a'];
foreach ($array as $a) {
    $i++;
    $id = $a;
    $sql = "DELETE FROM proxy WHERE id='$id'";
    $querty = delete($sql);

}

header("Location: ".$_SERVER['HTTP_REFERER']);