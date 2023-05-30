<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$id = $_REQUEST['id'];
$sql = "CREATE TABLE tmp_tab AS SELECT DISTINCT * FROM value_lists WHERE list = $id";
$qw = create($sql);
$sql = "DELETE FROM value_lists WHERE list = $id";
$qw  = delete($sql);
$sql = 'INSERT INTO value_lists (value, list) SELECT value,list FROM tmp_tab';
$qw = insert($sql);
$sql = 'DROP TABLE tmp_tab';
$qw  = create($sql);
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;