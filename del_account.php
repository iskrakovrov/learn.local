<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$id = $_GET['id'];


$sql = 'SELECT * FROM accounts WHERE id = ?';
$args = [$id];
$qu = select($sql, $args);


d_acc($args);

$p = $qu['$id_proxy'];
if (!empty($p) && ($p !== 0)) {
    $sql = 'UPDATE proxy SET use_proxy = use_proxy - 1 WHERE id = ?';
    $args = [$p];
    $qu1 = update($sql, $args);
}

$sql = 'DELETE FROM accounts WHERE id = ?';
$args = [$id];
$qu1 = delete($sql, $args);
header('Location: ' . $_SERVER['HTTP_REFERER']);
