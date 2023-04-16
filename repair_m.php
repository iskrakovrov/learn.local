<?php

include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$sql = 'SELECT id, login_fb FROM accounts';
$qw = selectAll($sql);
foreach ($qw as $a){
    if (filter_var($a['login_fb'], FILTER_VALIDATE_EMAIL)) {
        $sql = 'UPDATE accounts SET mail = ? WHERE id = ?';
        $arg = [$a['login_fb'],$a['id']];
        $QW = update($sql,$arg);
    }
}
