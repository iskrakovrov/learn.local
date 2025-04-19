<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

// Установите отображение ошибок для отладки
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

try {
    // Получаем параметры от DataTables
    $draw = isset($_POST['draw']) ? intval($_POST['draw']) : 0;
    $start = isset($_POST['start']) ? intval($_POST['start']) : 0;
    $length = isset($_POST['length']) ? intval($_POST['length']) : 10;
    $searchValue = $_POST['search']['value'] ?? '';
    $minFriends = isset($_POST['minFriends']) ? intval($_POST['minFriends']) : null;
    $maxFriends = isset($_POST['maxFriends']) ? intval($_POST['maxFriends']) : null;

    // Базовый SQL-запрос
    $sql = "SELECT * FROM accounts WHERE 1=1";
    $params = [];

    // Поиск
    if (!empty($searchValue)) {
        $sql .= " AND (login LIKE :search OR mail LIKE :search OR phone LIKE :search)";
        $params['search'] = '%' . $searchValue . '%';
    }

    // Фильтрация по количеству друзей
    if (!empty($minFriends)) {
        $sql .= " AND friends >= :minFriends";
        $params['minFriends'] = $minFriends;
    }

    if (!empty($maxFriends)) {
        $sql .= " AND friends <= :maxFriends";
        $params['maxFriends'] = $maxFriends;
    }

    // Получаем общее количество записей
    $totalRecords = $pdo->query("SELECT COUNT(*) FROM accounts")->fetchColumn();

    // Получаем количество записей после фильтрации
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM ($sql) AS filtered");
    $stmt->execute($params);
    $totalFiltered = $stmt->fetchColumn();

    // Добавляем сортировку и лимиты для пагинации
    $orderColumn = $_POST['order'][0]['column'] ?? 0;
    $orderDir = $_POST['order'][0]['dir'] ?? 'asc';
    $columns = ['ids', 'login', 'mail', 'phone', 'gender', 'avatar', 'proxy', 'server', 'group', 'tag', 'status', 'task', 'use', 'life', 'friends', 'tocken', 'adv', 'last_start', 'ar', 'fa', 'ig', 'created_acc'];

    if (isset($columns[$orderColumn])) {
        $sql .= " ORDER BY {$columns[$orderColumn]} $orderDir";
    }

    $sql .= " LIMIT :start, :length";
    $params['start'] = $start;
    $params['length'] = $length;

    // Выполняем основной запрос
    $stmt = $pdo->prepare($sql);
    foreach ($params as $key => &$value) {
        $stmt->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
    }
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Формируем ответ
    $response = [
        "draw" => $draw,
        "recordsTotal" => $totalRecords,
        "recordsFiltered" => $totalFiltered,
        "data" => $data
    ];

    // Для отладки (можно раскомментировать при тестировании)
    // echo json_encode(['query' => $sql, 'params' => $params]); exit;

    echo json_encode($response, JSON_THROW_ON_ERROR);
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
    exit;
}
