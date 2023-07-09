<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$id = $_SESSION['ids'];
$yy = $_GET['gr'];
foreach ($id as $a) {
    $sql = 'UPDATE proxy SET group_proxy = ? WHERE id = ?';
    $args = [$yy, $a];
    $q = update($sql, $args);
}
header('Location: proxy.php');
exit;
