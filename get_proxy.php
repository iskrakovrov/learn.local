<?php
require_once('inc/db.php');
require_once('function/function.php');
$sql = "SELECT * FROM proxy WHERE status = 'ok' AND use_proxy = (SELECT min(use_proxy) from proxy) LIMIT 1";
$query = select($sql);
$count = $query['use_proxy'];
$count = ++$count;
$id = $query['id_proxy'];
$sql = "UPDATE proxy SET use_proxy = $count WHERE id_proxy = $id";
$query1 = update($sql);
$json_data = json_encode($query);
echo $json_data;