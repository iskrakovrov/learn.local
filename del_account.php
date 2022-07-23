<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$id=$_GET['id'];


$sql = "INSERT INTO trash (id_acc, login_fb, pass_fb, id_fb, name, bd, mb, yb, gender, avatar, created, comment, group_acc, server, id_proxy, status, works, useacc, friends, last_start, id_mail, id_phone, coockie, tocken, ua) SELECT * FROM accounts WHERE id_acc='$id'";
$querty = insert($sql);
$sql="DELETE FROM accounts WHERE id_acc='$id'";
$querty = delete($sql);
header("Location: ".$_SERVER['HTTP_REFERER']);