<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$id = $_SESSION['ids'];
$yy = $_GET['se'];
if (!empty($yy)) {
    foreach ($id as $a) {
        $sql = "UPDATE accounts SET server = ? WHERE id = ?";
        $args = [$yy, $a];
        $q = update($sql, $args);
    }
}
header('Location: accounts.php');
exit;

