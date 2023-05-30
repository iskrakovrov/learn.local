<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$id = $_REQUEST['id'];

$sql = 'SELECT code FROM oai WHERE id = ?';
$argc = [$id];
$query = select($sql, $argc);
$apiKey = $query['code'];


if (checkAPIKey($apiKey)) {
    $sql = 'UPDATE oai SET status = 0 WHERE id = ? ';

} else {
    $sql = 'UPDATE oai SET status = 1 WHERE id = ? ';
}
$argc = [$id];
$query = update($sql, $argc);


$balance = checkAPIBalance($apiKey);

if ($balance !== false) {
    $sql = "UPDATE oai SET oai.usage = '$balance' WHERE id = ?";
} else {
    $sql = 'UPDATE oai SET oai.usage = NULL WHERE id = ?';
}
$argc = [$id];
$query = update($sql, $argc);

header('Location: open_ai.php');

