<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$id  = $_REQUEST['id'];
$sql = "SELECT * FROM posts WHERE cat = ?";
$args = [$id];
$qw = selectAll($sql, $args);
foreach ($qw as $a) {
    $sql = "DELETE FROM stat_post WHERE id_post = ?";
    $args = array($a['id']);
    delete($sql, $args);
}

header('Location: ' .$_SERVER['HTTP_REFERER']);
exit;
