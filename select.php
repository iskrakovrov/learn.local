<?php

require_once('inc/db.php');
require_once('function/function.php');


$sql = $_GET['sql'];
$sql = (string)$sql;

$sel = select($sql);

try {
    $json_data = json_encode($sel, JSON_THROW_ON_ERROR);
} catch (JsonException $e) {
}
print $json_data;