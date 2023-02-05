<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

    $sql = 'DELETE FROM task';
    $query = delete($sql);
    $sql = 'DELETE FROM temp_task';
    $query = delete($sql);

header('Location: /accounts.php');