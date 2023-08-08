<!doctype html>
<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
if (!empty($_REQUEST['add_task'])){
  $url = $_REQUEST['add_task'];
  $ids = $_POST['a'];

    session_start();
    $_SESSION['ids'] = $ids;
    header("Location: $url");
    return true;
}

    header('Location: accounts.php');



