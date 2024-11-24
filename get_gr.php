<?php

require_once('inc/config.php');
require_once('function/function.php');

// Указываем номер проекта и список, получаем их через GET-запрос
$project_id = isset($_GET['project_id']) ? (int)$_GET['project_id'] : null;
$list_id = isset($_GET['list_id']) ? (int)$_GET['list_id'] : null;

// Проверяем, указаны ли значения project_id и list_id
if ($project_id === null) {
    die('Ошибка: не указан проект.');
}

if ($list_id === null) {
    die('Ошибка: не указан список.');
}

// Получаем следующую группу с блокировкой
$sql_next_group = 'SELECT vl.id, vl.value 
                   FROM value_lists vl 
                   LEFT JOIN group_locks gl ON vl.id = gl.group_id AND gl.project_id = ?
                   WHERE gl.group_id IS NULL AND vl.list = ?
                   ORDER BY vl.id ASC LIMIT 1';

$group = select($sql_next_group, [$project_id, $list_id]);

if ($group) {
    $group_id = $group['id'];
    $group_url = $group['value'];

    // Блокируем группу для других клиентов
    group_lock($group_id, $project_id);
    echo $group_id . ';' . $group_url;

}