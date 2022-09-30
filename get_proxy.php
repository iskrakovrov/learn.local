<?php
require_once('inc/db.php');
require_once('function/function.php');
$sql = "SELECT * FROM proxy WHERE status = 'ok' ORDER BY `use_proxy` ASC, `work` ASC LIMIT 1;";
$query = select($sql);
$count = $query['use_proxy'];
$count = ++$count;
$id = $query['id'];
$time = Time();

$sql = "UPDATE proxy SET use_proxy = $count, work = $time WHERE id = $id";
$query1 = update($sql);
$json_data = json_encode($query, JSON_THROW_ON_ERROR);
echo $json_data;