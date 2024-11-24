<?php
include_once('inc/init.php');
require_once('inc/db.php');

if (isset($_GET['action']) && $_GET['action'] == 'getNames') {
    // Получаем уникальные имена из базы данных
    $stmt = $pdo->prepare('SELECT DISTINCT name FROM test');
    $stmt->execute();
    $names = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Проверим, что имена действительно получены
    if ($names) {
        // Отправляем результат в формате JSON
        echo json_encode(['names' => $names]);
    } else {
        echo json_encode(['names' => []]); // Если имена не найдены
    }
    exit;
}
