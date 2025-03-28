<?php

require_once('inc/config.php');
require_once('function/function.php');

// Получаем значения project_id и list_id из GET-запроса
$project_id = isset($_GET['project_id']) ? (int)$_GET['project_id'] : null;
$list_id = isset($_GET['list_id']) ? (int)$_GET['list_id'] : null;
//$project_id = 3;
//$list_id = 52;
// Проверяем, указаны ли значения project_id и list_id
if ($project_id === null) {
    die('Ошибка: не указан project_id.');
}

if ($list_id === null) {
    die('Ошибка: не указан list_id.');
}

// Шаг 1: Найти следующую доступную запись
$sql_next_group = 'SELECT vl.id, vl.value 
                   FROM value_lists vl
                   LEFT JOIN group_locks gl ON vl.id = gl.group_id AND gl.project_id = ?
                   WHERE vl.list = ? AND gl.group_id IS NULL
                   ORDER BY vl.id ASC LIMIT 1';
$group = select($sql_next_group, [$project_id, $list_id]);

if ($group) {
    // Шаг 2: Заблокировать найденную запись
    $group_id = $group['id'];
    $group_value = $group['value'];

    $sql_lock_group = 'INSERT INTO group_locks (group_id, project_id) VALUES (?, ?)';
    execute($sql_lock_group, [$group_id, $project_id]);

    // Возвращаем результат в формате "id;value"
    echo "{$group_id};{$group_value}";
} else {
    // Шаг 3: Если все записи заблокированы, очищаем блокировки для данного проекта
    $sql_clear_locks = 'DELETE FROM group_locks WHERE project_id = ?';
    execute($sql_clear_locks, [$project_id]);

    // Сообщаем, что обработка завершена
    echo "lock";
}


