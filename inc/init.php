<?php
ini_set('Timeout', 7200);


session_start();

if (basename($_SERVER['SCRIPT_NAME']) != 'login.php' && !isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
$lang = $_SESSION['lang'];
$lang = $_SESSION['lang'] . '.php';
gc_collect_cycles();
