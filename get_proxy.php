<?php
require_once('inc/db.php');
require_once('function/function.php');
$sql = "SELECT * FROM proxy WHERE status = 'ok' ORDER BY `use_proxy`, `work`  LIMIT 1";
//$sql = "SELECT * FROM proxy, accounts WHERE proxy.status = 'ok' ORDER BY 'proxy.use_proxy' ASC, 'proxy.work' ASC";
$query = select($sql);
$id = $query['id'];
$time = Time();
$sql = "UPDATE proxy SET work = $time WHERE id = $id";
$query1 = update($sql);



$json_data = json_encode($query, JSON_THROW_ON_ERROR);
echo $json_data;