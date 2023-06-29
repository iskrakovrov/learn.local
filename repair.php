<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$argc = [0];
$sql = 'DELETE FROM friends WHERE (id_acc) NOT IN (SELECT id FROM accounts )';
$qw = delete($sql,$argc);
$sql = 'DELETE FROM stat_sugg WHERE (id_acc) NOT IN (SELECT id FROM accounts )';
$qw = delete($sql,$argc);
$sql = 'DELETE FROM stat_post WHERE (id_acc) NOT IN (SELECT id FROM accounts )';
$qw = delete($sql,$argc);
$sql = 'DELETE FROM stat_comm WHERE (id_acc) NOT IN (SELECT id FROM accounts )';
$qw = delete($sql,$argc);
$sql = 'DELETE FROM stat_like WHERE (id_acc) NOT IN (SELECT id FROM accounts )';
$qw = delete($sql,$argc);
$sql = 'DELETE FROM stat_invite WHERE (id_acc) NOT IN (SELECT id FROM accounts )';
$qw = delete($sql,$argc);



header('Location: accounts.php');
