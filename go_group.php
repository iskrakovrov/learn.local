<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$id = $_SESSION['ids'];
$yy = $_GET['gr'];
foreach ($id as $a) {
$sql = 'UPDATE accounts SET group_acc = ? WHERE id = ?';
$args = [$yy, $a];
$q = update($sql, $args);
}
header('Location: accounts.php');
exit;
