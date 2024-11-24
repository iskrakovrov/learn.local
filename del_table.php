<?php



require_once('inc/db.php');
require_once('function/function.php');
$sql = 'DROP TABLE IF EXISTS current_position;';
$qw = create($sql);
$sql = 'DROP TABLE IF EXISTS post_logs;';
$qw = create($sql);
$sql = 'DROP TABLE IF EXISTS group_locks;';
$qw = create($sql);
$sql = 'DROP TABLE IF EXISTS hm;';
$qw = create($sql);
