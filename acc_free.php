<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$ids = $_SESSION['ids'];
foreach ($ids as $id) {
    $sql = "UPDATE accounts SET useacc = 0 WHERE id_acc = $id";
    $query = update($sql);
}
header("Location: /accounts.php");