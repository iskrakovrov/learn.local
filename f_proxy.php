<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');


$id=$_GET['id'];



$sql = "UPDATE proxy SET use_proxy = 0 WHERE id = $id";

$qu = update($sql);
$sql = "UPDATE accounts SET id_proxy = NULL WHERE id_proxy = $id";
header('Location: ' .$_SERVER['HTTP_REFERER']);
exit;
