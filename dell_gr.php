<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$id=$_GET['id'];
$sql = "SELECT name_group FROM group_acc WHERE id = $id";
$qw = select($sql);
$ng = $qw['name_group'];
if ($ng =='combo'){
    header('Location: ' .$_SERVER['HTTP_REFERER']);
    exit();
}
$sql = "SELECT * FROM group_acc WHERE name_group = 'combo'";
$qw = select($sql);
if (!$qw){
    $sql = "INSERT INTO group_acc (id, name_group, comment) VALUES (NULL,'combo', 'RESERVE')";
$qw1 = insert($sql);

}
$sql = "SELECT * FROM group_acc WHERE name_group = 'combo'";
$qw = select($sql);
$id1 = $qw['id'];
$sql = "UPDATE accounts set group_acc = $id1 WHERE group_acc = $id";
$qw = update($sql);
$sql="DELETE FROM group_acc WHERE id='$id'";
$querty = delete($sql);
header('Location: ' .$_SERVER['HTTP_REFERER']);