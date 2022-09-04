<?php

include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$id = $_GET['id'];
$sql = "DELETE FROM value_lists WHERE list = $id";
$query = delete($sql);
$sql = "DELETE FROM lists WHERE id = $id";
header("Location: " . $_SERVER['HTTP_REFERER']);
