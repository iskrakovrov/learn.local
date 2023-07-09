<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$id = $_GET['id'];
$args = [$id];
$sql = 'SELECT name_group FROM group_proxy WHERE id = ?';
$qw = select($sql, $args);
$ng = $qw['name_group'];

$id1 = NULL;
$sql = 'UPDATE accounts SET id_proxy = NULL WHERE gpoup_proxy = ?';
$args = [$id];
$qw = update($sql, $args);
$sql = 'UPDATE accounts SET gpoup_proxy = ? WHERE gpoup_proxy  = ?';
$args = [$id1, $id];
$qw = update($sql, $args);
$sql = 'DELETE FROM group_proxy WHERE id = ?';
$args = [$id];
$querty = delete($sql, $args);

header('Location: ' .$_SERVER['HTTP_REFERER']);

