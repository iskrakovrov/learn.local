<?php
include_once('inc/init.php');
//require_once('inc/db.php');
require_once('function/function.php');
$sql = 'UPDATE accounts SET id_proxy = NULL';
$qu = update($sql);
$sql = 'UPDATE proxy SET use_proxy = 0';
$qu = update($sql);
header('Location: accounts.php');
exit;
