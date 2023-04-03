<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$ids = $_SESSION['ids'];
foreach ($ids as $id) {
    $sql = "DELETE FROM task WHERE account = ?";
    $args = [$id];
    $query = delete($sql, $args);

    $sql = "DELETE FROM temp_task WHERE account = ?";
    $args = [$id];
    $query = delete($sql, $args);
}
header('Location: /accounts.php');
