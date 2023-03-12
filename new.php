<?php
include_once ('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$filename = 'mig.php';

if (file_exists($filename)) {
    require_once ($filename);
    session_start();
    $_SESSION['alert'] = 1;
    header('Location: accounts.php');
    exit();
}
session_start();
$_SESSION['alert'] = 1;
header('Location: accounts.php');
exit();