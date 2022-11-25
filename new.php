<?php
include_once ('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$filename = 'mig.php';

if (file_exists($filename)) {
    require_once ($filename);
  //  unlink($filename);
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}
header("Location: " . $_SERVER['HTTP_REFERER']);
