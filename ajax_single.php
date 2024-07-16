<?php
require_once('inc/db.php');
require_once('function/function.php');

// Пример массива ID
$id = $_GET['id']; // Предполагается, что это массив из ID, например: [1, 2, 3]

// Проверка и приведение данных
if (!is_array($id)) {
    die('Invalid ID format. ID should be an array.');
}

// Создание плейсхолдеров для подготовленного запроса
$in  = str_repeat('?,', count($id) - 1) . '?';

$sql = "SELECT created, MAX(all_friends) AS s_friends
        FROM s_stat
        WHERE type IN ($in) AND created >= UNIX_TIMESTAMP(CURRENT_DATE - INTERVAL 200 DAY)
        GROUP BY DATE(FROM_UNIXTIME(created))";

// Подготовка параметров для запроса
$params = array_map('intval', $id); // Преобразование всех ID в целые числа

$qwery = selectall($sql, $params);

// Инициализация массивов для хранения данных
$regtime = [];
$delay = [];

// Обработка результата запроса
foreach ($qwery as $row) {
    $regtime[] = $row['created'];
    $delay[] = $row['s_friends'];
}

// Формирование массива данных для JSON
$result = [
    'regtime' => $regtime,
    'delay' => $delay
];

// Кодирование данных в JSON
$json_data = json_encode($result, JSON_UNESCAPED_UNICODE);

// Вывод JSON
header('Content-Type: application/json');
echo $json_data;
