<?php


require_once('inc/db.php');
require_once('function/function.php');

$sql = $_GET["sql"];

$upd = update($sql);

$json_data = json_encode($upd, JSON_THROW_ON_ERROR);
print $json_data;