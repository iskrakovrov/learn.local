<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$sql = 'SELECT id_acc FROM stat_invite WHERE (id_acc) NOT IN (SELECT id  FROM accounts )';
$qw = selectAll($sql);
foreach ($qw as $a){
    $argc = [$a['id_acc']];
    $sql = 'DELETE FROM stat_invite WHERE id_acc = ?';
    $qw = delete($sql,$argc);
}
$sql = 'SELECT id_acc FROM stat_like WHERE (id_acc) NOT IN (SELECT id  FROM accounts )';
$qw = selectAll($sql);
foreach ($qw as $a){
    $argc = [$a['id_acc']];
    $sql = 'DELETE FROM stat_like WHERE id_acc = ?';
    $qw = delete($sql,$argc);
}
$sql = 'SELECT id_acc FROM stat_comm WHERE (id_acc) NOT IN (SELECT id  FROM accounts )';
$qw = selectAll($sql);
foreach ($qw as $a){
    $argc = [$a['id_acc']];
    $sql = 'DELETE FROM stat_comm WHERE id_acc = ?';
    $qw = delete($sql,$argc);
}
$sql = 'SELECT id_acc FROM stat_post WHERE (id_acc) NOT IN (SELECT id  FROM accounts )';
$qw = selectAll($sql);
foreach ($qw as $a){
    $argc = [$a['id_acc']];
    $sql = 'DELETE FROM stat_post WHERE id_acc = ?';
    $qw = delete($sql,$argc);
}
$sql = 'SELECT id_acc FROM stat_sugg WHERE (id_acc) NOT IN (SELECT id  FROM accounts )';
$qw = selectAll($sql);
foreach ($qw as $a){
    $argc = [$a['id_acc']];
    $sql = 'DELETE FROM stat_sugg WHERE id_acc = ?';
    $qw = delete($sql,$argc);
}
header('Location: accounts.php');

