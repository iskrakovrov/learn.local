<?php


require_once('inc/db.php');
require_once('function/function.php');

$sql = $_GET["sql"];

$upd = update($sql);

$json_data = json_encode($upd);
print $json_data;