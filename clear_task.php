<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$ids = $_SESSION['ids'];
foreach ($ids as $id) {
    $sql = "DELETE FROM task WHERE account = $id";
    $query = delete($sql);
    $sql = "DELETE FROM temp_task WHERE account = $id";
    $query = delete($sql);

}
header('Location: /accounts.php');
