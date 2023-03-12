<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);
$id = $_REQUEST['id'];
$sql = 'SELECT * FROM friends WHERE id = $id  ORDER BY created DESC LIMIT 20';
$statFriends = selectAll($sql);