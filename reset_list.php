<?php

include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$id = $_GET['id'];
$sql = 'DELETE FROM stat_parse WHERE cat=?';
$args = [$id];
$querty = delete($sql, $args);
header('Location: ' . $_SERVER['HTTP_REFERER']);
