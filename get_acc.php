<?php
require_once('inc/db.php');
require_once('function/function.php');
$name = 'ONE';
//$name = $_GET['server'];
$sql = "SELECT * FROM servers WHERE name_server = '$name'";
$query = select($sql);
$server = $query['id'];
$sql = "SELECT accounts.* FROM accounts, task where accounts.id = task.account and accounts.useacc <> 1 and accounts.server = '$server' ORDER BY accounts.last_start LIMIT 1";
$data = select($sql);
$json_data = json_encode($data, JSON_THROW_ON_ERROR);
if (empty($data)) {
    $json_data = 'no accounts';
}
else {

$id = $data['id'];

$sql = "UPDATE accounts SET accounts.useacc = 1 WHERE accounts.id = $id";
$query = update($sql);
}
echo $json_data;

