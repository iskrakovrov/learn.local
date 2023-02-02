<?php


include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$sql = 'DELETE FROM err';
$query = delete($sql);
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
