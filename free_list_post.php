<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$id  = $_REQUEST['id'];
$sql = "SELECT * FROM posts WHERE cat = id";
$qw = select($sql);
foreach ($qw as $a) {
    $sql = "DELETE FROM stat_post WHERE id_post = $a";
}

header("Location: ".$_SERVER['HTTP_REFERER']);
exit;
