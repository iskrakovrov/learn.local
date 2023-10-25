<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$id = $_REQUEST['id'];

function updateApiKeyStatus($id, $statusAI, $apiKey) {
    $time = Time();
    if ($statusAI === true) {
        $sql = "UPDATE oai SET status = 0, error = 'no error', oai.used = ?  WHERE id = ?";
        $argc = [$time, $id];
    } else {
        $err = $statusAI[1];
        $sql = 'UPDATE oai SET status = 1, error = ? WHERE id = ? ';
        $argc = [$err, $id];
    }
    update($sql, $argc);
}

function updateApiKeyUsage($id, $balance) {
    if ($balance !== false) {
        $sql = "UPDATE oai SET oai.usage = ? WHERE id = ?";
        $argc = [$balance, $id];
    } else {
        $sql = 'UPDATE oai SET oai.usage = NULL WHERE id = ?';
        $argc = [$id];
    }
    update($sql, $argc);
}

$sql = 'SELECT code FROM oai WHERE id = ?';
$argc = [$id];
$query = select($sql, $argc);
$apiKey = $query['code'];

$statusAI = checkAPIKey($apiKey);
updateApiKeyStatus($id, $statusAI, $apiKey);

$balance = checkAPIBalance($apiKey);
updateApiKeyUsage($id, $balance);

header('Location: open_ai.php');
