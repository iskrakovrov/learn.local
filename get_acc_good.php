<?php
require_once('inc/db.php');
require_once('function/function.php');
$name = 'ONE';
// $name = $_GET['server'];
$sql = "SELECT * FROM servers WHERE name_server = ?";
$args = [$name];
$query = select($sql, $args);
$server = $query['id_server'];
$sql = "SELECT accounts.* FROM accounts, task WHERE accounts.id_acc = task.account AND accounts.works <> 1 AND accounts.status = 1 AND accounts.server = ? ORDER BY accounts.useacc LIMIT 1";
$args = [$server];
$data = select($sql, $args);

if (!empty($data)) {
    $json_data = json_encode($data);
    $id = $data['id_acc'];
    $time = Time();
    $sql = "UPDATE accounts SET accounts.works = 1, accounts.useacc = ? WHERE accounts.id_acc = ?";
    $args = [$time, $id];
    $query = update($sql, $args);
    echo $json_data;
}
else {
    echo "No accounts found";
}
