<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$ids = $_SESSION['ids'];
foreach ($ids as $a){
    $sql = "UPDATE accounts SET id_proxy = 0 WHERE id = ?";
    $args = [$a];
    $qu = update($sql, $args);
}

header('Location: accounts.php');
exit;
