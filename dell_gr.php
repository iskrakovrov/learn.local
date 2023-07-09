<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$id = $_GET['id'];

$sql = 'SELECT name_group FROM group_acc WHERE id = ?';
$args = [$id];
$qw = select($sql, $args);
$ng = $qw['name_group'];

if ($ng == 'combo') {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

$sql = "SELECT * FROM group_acc WHERE name_group = 'combo'";
$qw = select($sql);

if (!$qw) {
    $sql = "INSERT INTO group_acc (id, name_group, comment) VALUES (NULL, 'combo', 'RESERVE')";
    $qw1 = insert($sql);
}

$sql = "SELECT * FROM group_acc WHERE name_group = 'combo'";
$qw = select($sql);
$id1 = $qw['id'];

$sql = 'UPDATE accounts SET group_acc = ? WHERE group_acc = ?';
$args = [$id1, $id];
$qw = update($sql, $args);

$sql = 'DELETE FROM group_acc WHERE id = ?';
$args = [$id];
$querty = delete($sql, $args);
header('Location: ' .$_SERVER['HTTP_REFERER']);
