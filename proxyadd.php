<?php
require_once('inc/db.php');
require_once('function/function.php');
$proxy = $_GET['proxy'];
$mode = $_GET['mode'];
$acc = $_GET['acc'];
if ($mode==='add') {

    $sql = "SELECT * FROM proxy WHERE id = $proxy";

    $query = select($sql);
    $count = $query['use_proxy'];
    $count = ++$count;
    $id = $query['id'];
    $time = Time();

    $sql = "UPDATE proxy SET use_proxy = $count, work = $time WHERE id = $id";
    $query1 = update($sql);
    $sql = "UPDATE accounts SET id_proxy = $proxy WHERE id = $acc";
    $query1 = update($sql);
    echo 'ok';
}