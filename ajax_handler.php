<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

// Если запрос на получение уникальных имен
if (isset($_GET['action']) && $_GET['action'] === 'getNames') {
    try {
        // Получаем уникальные имена из базы данных
        $stmt = $pdo->query("SELECT DISTINCT name FROM test");
        $names = $stmt->fetchAll(PDO::FETCH_COLUMN);  // Извлекаем только столбец "name"

        // Проверяем, если имена получены
        if ($names) {
            // Если имена есть, отправляем их обратно в формате JSON
            echo json_encode(['names' => $names]);
        } else {
            // Если имена не найдены, возвращаем пустой массив
            echo json_encode(['names' => []]);
        }
    } catch (Exception $e) {
        // Обработка ошибок
        echo json_encode(['error' => 'Ошибка при получении имен: ' . $e->getMessage()]);
    }
    exit;
}

// Здесь будет обработка других запросов, таких как пагинация и фильтрация
// Пример:
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $nameFilter = isset($_GET['nameFilter']) ? $_GET['nameFilter'] : '';

    // Строим запрос для выборки данных
    $query = "SELECT id, name, friends, server, time FROM test WHERE 1";

    if ($nameFilter) {
        $query .= " AND name LIKE :nameFilter";
    }

    $stmt = $pdo->prepare($query);
    if ($nameFilter) {
        $stmt->bindValue(':nameFilter', "%$nameFilter%", PDO::PARAM_STR);
    }
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Получаем общее количество записей
    $totalRecordsQuery = "SELECT COUNT(*) FROM test";
    $totalRecordsStmt = $pdo->query($totalRecordsQuery);
    $totalRecords = $totalRecordsStmt->fetchColumn();

    echo json_encode([
        'recordsTotal' => $totalRecords,
        'recordsFiltered' => $totalRecords,
        'data' => $data
    ]);
}

