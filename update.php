<?php


require_once('inc/db.php');
require_once('function/function.php');
if(empty($_GET['sql'])){
    $sql = $_POST['sql'];
}
else{
    $sql = $_GET['sql'];
}


$upd = update($sql);

try {
    $json_data = json_encode($upd, JSON_THROW_ON_ERROR);
} catch (JsonException $e) {
}
print $json_data;
