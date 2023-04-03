<?php

include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$id = $_GET['id'];
$sql = "DELETE FROM value_lists WHERE list = ?";
$args = [$id];
$query = delete($sql, $args);
header('Location: ' . $_SERVER['HTTP_REFERER']);
