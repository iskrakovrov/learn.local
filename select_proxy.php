<?php



require_once('inc/db.php');
require_once('function/function.php');

$pr = $_GET["pr"];
$sql = "SELECT count(works) FROM accounts WHERE id_proxy = '$pr'";

$sel = select($sql);

$json_data = json_encode($sel);
print $json_data;