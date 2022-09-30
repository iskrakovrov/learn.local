<?php


require_once('inc/db.php');
require_once('function/function.php');

$sql = $_GET["sql"];
$sql = (string)$sql;

$sel = delete($sql);

$json_data = json_encode($sel, JSON_THROW_ON_ERROR);
print $json_data;