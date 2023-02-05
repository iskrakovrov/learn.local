<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$sql = 'UPDATE accounts SET useacc = 0';
$query = update($sql);

header('Location: /accounts.php');
