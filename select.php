<?php


require_once('inc/db.php');
require_once('function/function.php');

$sql = $_GET["sql"];
$sql = (string)$sql;

$sel = select($sql);

$json_data = json_encode($sel);
print $json_data;