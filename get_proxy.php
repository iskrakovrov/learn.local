<?php

require_once('inc/db.php');
require_once('function/function.php');

$gp = $_GET['gp'];

// Используйте тернарный оператор для установки значения переменной $sql
$sqlLock = 'LOCK TABLES `proxy` WRITE';
$data = create($sqlLock);

$sqlSelect = "SELECT * FROM proxy WHERE status != 'bad' AND group_proxy = $gp ORDER BY `work` , `use_proxy`  LIMIT 1";
$query = select($sqlSelect);

$id = $query['id'];
$time = time() + 60;

$sqlUpdate = 'UPDATE proxy SET work = ? WHERE id = ?';
$argsUpdate = [$time, $id];
$query1 = update($sqlUpdate, $argsUpdate);

$sqlUnlock = 'UNLOCK TABLES';
$data = create($sqlUnlock);

try {
    $json_data = json_encode($query, JSON_THROW_ON_ERROR);
} catch (JsonException $e) {
}

echo $json_data;

