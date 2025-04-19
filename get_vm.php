<?php
require_once('inc/db.php');
require_once('function/function.php');

header('Content-Type: application/json');

try {
    // Получаем список всех VM из БД
    $sql = "SELECT name_vm FROM vm_work";
    $dbVms = selectAll($sql);
    $existingVms = array_column($dbVms, 'name_vm');

    // Возвращаем список всех VM из БД
    echo json_encode([
        'success' => true,
        'data' => $existingVms
    ], JSON_THROW_ON_ERROR);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ], JSON_THROW_ON_ERROR);
}
