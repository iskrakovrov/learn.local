<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$id = $_GET['id'];

$sql = 'SELECT tag FROM account_tags WHERE id = ?';
$args = [$id];
$qw = select($sql, $args);
$ng = $qw['tag'];

if ($ng == 'combo') {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

$sql = "SELECT * FROM account_tags WHERE tag = 'combo'";
$qw = select($sql);

if (!$qw) {
    $sql = "INSERT INTO account_tags (id, tag) VALUES (NULL, 'combo')";
    $qw1 = insert($sql);
}

$sql = "SELECT * FROM account_tags WHERE tag = 'combo'";
$qw = select($sql);
$id1 = $qw['id'];

$sql = 'UPDATE accounts SET account_tags = ? WHERE account_tags = ?';
$args = [$id1, $id];
$qw = update($sql, $args);

$sql = 'DELETE FROM account_tags WHERE id = ?';
$args = [$id];
$querty = delete($sql, $args);
header('Location: ' .$_SERVER['HTTP_REFERER']);

