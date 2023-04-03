<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$id = $_REQUEST['id'];
$sql = "DELETE FROM err WHERE id = ?";
$args = [$id];
$q = delete($sql, $args);
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
