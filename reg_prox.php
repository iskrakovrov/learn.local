<?php
require_once('inc/db.php');
require_once 'function/function.php';

header('Content-Type: application/json');

// Получаем группу из запроса
$group_id = (int)($_GET['pr_group'] ?? 0);
if ($group_id <= 0) {
    try {
        die(json_encode(['error' => 'Invalid group ID'], JSON_THROW_ON_ERROR));
    } catch (JsonException $e) {

    }
}

// 1. Пробуем найти неиспользованный прокси
$proxy = select("
    SELECT p.* 
    FROM proxy p
    LEFT JOIN proxy_usage pu ON p.id = pu.proxy_id
    WHERE p.group_proxy = ? AND pu.proxy_id IS NULL
    LIMIT 1
", [$group_id]);

// 2. Если не нашли - берем самый старый использованный
if (!$proxy) {
    $proxy = select("
        SELECT p.* 
        FROM proxy p
        JOIN proxy_usage pu ON p.id = pu.proxy_id
        WHERE p.group_proxy = ?
        ORDER BY pu.last_used ASC
        LIMIT 1
    ", [$group_id]);

    // 3. Если и это не сработало - сбрасываем все использования
    if (!$proxy) {
        delete("DELETE FROM proxy_usage WHERE proxy_id IN (
            SELECT id FROM proxy WHERE group_proxy = ?
        )", [$group_id]);

        // Повторяем первый запрос
        $proxy = select("
            SELECT p.* 
            FROM proxy p
            LEFT JOIN proxy_usage pu ON p.id = pu.proxy_id
            WHERE p.group_proxy = ? 
            LIMIT 1
        ", [$group_id]);
    }
}

// Если вообще нет прокси в группе
if (!$proxy) {
    die(json_encode(['error' => 'No proxies in this group'], JSON_THROW_ON_ERROR));
}

// Обновляем запись об использовании
if (!select("SELECT 1 FROM proxy_usage WHERE proxy_id = ?", [$proxy['id']])) {
    insert("INSERT INTO proxy_usage (proxy_id) VALUES (?)", [$proxy['id']]);
} else {
    update("UPDATE proxy_usage SET last_used = NOW() WHERE proxy_id = ?", [$proxy['id']]);
}

// Формируем полный ответ со всеми данными прокси
$response = [
    'id' => $proxy['id'],
    'proxy' => $proxy['proxy'], // Важное поле!
    'full_data' => $proxy,      // Вся запись из таблицы
    'connection' => [
        'ip' => $proxy['ip'],
        'port' => $proxy['port'],
        'auth' => $proxy['login'] ? $proxy['login'].':'.$proxy['pswd'] : null
    ],
    'group' => $group_id,
    'meta' => [
        'protocol' => $proxy['protocol'],
        'status' => $proxy['status'],
        'comment' => $proxy['comment']
    ]
];

try {
    echo json_encode($response, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);
} catch (JsonException $e) {

}
