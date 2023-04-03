<?php
require_once('inc/db.php');
require_once('function/function.php');
//$name = 'ONE';
$name = $_GET['server'];
$sql = "SELECT * FROM servers WHERE name_server = ?";
$args = [$name];
$query = select($sql, $args);
$server = $query['id'];

$sql = 'LOCK TABLES `accounts` WRITE, `task` WRITE';
$data = create($sql);

$sql = "SELECT accounts.* FROM accounts, task WHERE accounts.id = task.account AND accounts.useacc <> 1 AND accounts.server = ? ORDER BY accounts.last_start LIMIT 1";
$args = [$server];
$data = select($sql, $args);
$json_data = json_encode($data, JSON_THROW_ON_ERROR);
if (empty($data)) {
    $json_data = 'no accounts';
}
else {
    $id = $data['id'];

    $sql = "UPDATE accounts SET accounts.useacc = 1 WHERE accounts.id = ?";
    $args = [$id];
    $query = update($sql, $args);
}
$sql ='UNLOCK TABLES';
$data = create($sql);
echo $json_data;

