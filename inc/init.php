<?php session_start();

if (basename($_SERVER["SCRIPT_NAME"]) != "login.php" && !isset($_SESSION["admin"])) {
header("Location: ../login.php");
exit;
}

