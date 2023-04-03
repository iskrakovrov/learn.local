<?php
require_once('inc/db.php');
require_once('function/function.php');
$proxy = $_GET['proxy'];
$mode = $_GET['mode'];
$acc = $_GET['acc'];
if ($mode==='add') {

    $sql = "SELECT * FROM proxy WHERE id = ?";

    $args = [$proxy];
    $query = select($sql, $args);
    $count = $query['use_proxy'];
    $count = ++$count;
    $id = $query['id'];
    $time = Time();

    $sql = "UPDATE proxy SET use_proxy = ?, work = ? WHERE id = ?";
    $args = [$count, $time, $id];
    $query1 = update($sql, $args);

    $sql = "UPDATE accounts SET id_proxy = ? WHERE id = ?";
    $args = [$proxy, $acc];
    $query1 = update($sql, $args);
    echo 'ok';
}
