<?php
require_once('inc/db.php');
require_once('function/function.php');

// SQL запрос для получения данных
$sql = 'SELECT created, MAX(all_friends) AS all_friends
        FROM all_stat
        WHERE created >= UNIX_TIMESTAMP(CURRENT_DATE - INTERVAL 200 DAY)
        GROUP BY DATE(FROM_UNIXTIME(created))';

$query = selectall($sql);

// Инициализация массивов для хранения данных
$regtime = [];
$delay = [];

// Обработка результата запроса
foreach ($query as $row) {
    $regtime[] = $row['created'];
    $delay[] = $row['all_friends'];
}

// Формирование массива данных для JSON
$result = [
    'regtime' => $regtime,
    'delay' => $delay
];

// Кодирование данных в JSON
$json_data = json_encode($result, JSON_UNESCAPED_UNICODE);

// Вывод JSON
print $json_data;
