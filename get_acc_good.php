<?php
require_once('inc/db.php');
require_once('function/function.php');
$name = 'ONE';
// $name = $_GET['server'];
$sql = "SELECT * FROM servers WHERE name_server = '$name'";
$query = select($sql);
$server = $query['id_server'];
$sql = "SELECT accounts.* FROM accounts, task where accounts.id_acc = task.account and accounts.works <> 1 and accounts.status = 1 and accounts.server = $server ORDER BY accounts.useacc LIMIT 1";
$data = select($sql);
$json_data = json_encode($data);
if (!empty($data)) {
    $id = $data['id_acc'];
    $time = Time();
    $sql = "UPDATE accounts SET accounts.works = 1, accounts.useacc = $time WHERE accounts.id_acc = $id";
    $query = update($sql);
    echo $json_data;
}
else {
    echo "No accounts found";
}
