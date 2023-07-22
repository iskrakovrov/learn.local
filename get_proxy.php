<?php
require_once('inc/db.php');
require_once('function/function.php');
$gp=$_GET['gp'];
//$gp=2;
$sql= 'LOCK TABLES `proxy` WRITE';
$data = create($sql);
$sql = "SELECT * FROM proxy WHERE status != 'bad' AND group_proxy = $gp ORDER BY `work` , `use_proxy`  LIMIT 1";
//$sql = "SELECT * FROM proxy, accounts WHERE proxy.status = 'ok' ORDER BY 'proxy.use_proxy' ASC, 'proxy.work' ASC";
$query = select($sql);
$id = $query['id'];
$time = Time()+60;
$sql = 'UPDATE proxy SET work = ? WHERE id = ?';
$args = [$time, $id];
$query1 = update($sql, $args);

$sql ='UNLOCK TABLES';
$data = create($sql);

try {
    $json_data = json_encode($query, JSON_THROW_ON_ERROR);
} catch (JsonException $e) {
}
echo $json_data;
