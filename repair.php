<?php

include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');


$sql = 'DELETE FROM friends WHERE (id_acc) NOT IN (SELECT id FROM accounts )';
$qw = delete($sql);
$sql = 'DELETE FROM stat_sugg WHERE (id_acc) NOT IN (SELECT id FROM accounts )';
$qw = delete($sql);
$sql = 'DELETE FROM stat_post WHERE (id_acc) NOT IN (SELECT id FROM accounts )';
$qw = delete($sql);
$sql = 'DELETE FROM stat_comm WHERE (id_acc) NOT IN (SELECT id FROM accounts )';
$qw = delete($sql);
$sql = 'DELETE FROM stat_like WHERE (id_acc) NOT IN (SELECT id FROM accounts )';
$qw = delete($sql);
$sql = 'DELETE FROM stat_invite WHERE (id_acc) NOT IN (SELECT id FROM accounts )';
$qw = delete($sql,);
$sql = 'DELETE FROM ava WHERE (id_acc) NOT IN (SELECT id FROM accounts )';
$qw = delete($sql);
$sql = 'DELETE FROM task WHERE (account) NOT IN (SELECT id FROM accounts )';
$qw = delete($sql);
$sql = 'DELETE FROM temp_task WHERE (account) NOT IN (SELECT id FROM accounts )';
$qw = delete($sql);
$sql = 'DELETE FROM all_stat WHERE all_friends < 2';
$qw = delete($sql);


header('Location: accounts.php');
