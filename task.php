<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$ids = $_SESSION['ids'];
$i = 0;
session_start();
$_SESSION['ids'] = $ids;
$url = $_POST['addTask'];
header('Location: ' . $url);
