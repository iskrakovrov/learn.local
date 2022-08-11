<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);
$red = $_REQUEST['add_task'];
$ids = $_REQUEST['a'];
session_start();
$_SESSION['ids'] = $ids;
header("Location: $red");