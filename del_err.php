<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$id = $_REQUEST['id'];
$sql = "DELETE FROM err WHERE id = $id";
$q = delete($sql);
header("Location: " . $_SERVER['HTTP_REFERER']);
exit;