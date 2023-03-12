<?php

include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$id = $_GET['id'];
$sql = "DELETE FROM stat_parse WHERE id='$id'";
$querty = delete($sql);
header('Location: ' . $_SERVER['HTTP_REFERER']);