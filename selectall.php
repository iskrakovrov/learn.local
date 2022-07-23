<?php


require_once('inc/db.php');
require_once('function/function.php');

$sql = $_GET["sql"];
$sql = "$sql";

$sel = selectAll($sql);

$json_data = json_encode($sel);
print $json_data;