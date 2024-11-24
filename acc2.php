<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

// Получаем данные для фильтрации и сортировки
$start = $_GET['start'] ?? 0;  // Начало (с какого индекса начать)
$length = $_GET['length'] ?? 10;  // Количество записей на странице
$order_column_index = $_GET['order'][0]['column'] ?? 0;  // Индекс сортируемой колонки
$order_dir = $_GET['order'][0]['dir'] ?? 'asc';  // Направление сортировки (asc или desc)
$search_value = $_GET['search']['value'] ?? '';  // Значение для поиска

// Массив соответствий индексов колонок для сортировки
$columns = ['login_fb', 'mail', 'phone', 'gender', 'avatar', 'proxy', 'server', 'group', 'tag', 'status', 'task', 'use', 'life', 'friends', 'friends1', 'tocken', 'adv', 'last_start', 'action', 'spst', 'fa', 'ar', 'created_acc', 'name', 'ig', 'idf'];

// Получаем данные из базы
$accountsData = getAccountsData();
$groupData = getGroupData();
$getServerData = getServerData();
$statusData = getStatusData();
$accountTagsData = getAccountTagsData();
$proxyGroups = getProxyGroup();

// Переменная для хранения отфильтрованных данных
$mysql_data = [];

// Поиск и фильтрация по значениям
foreach ($accountsData as $a) {
    if (!empty($search_value) && stripos($a['login_fb'], $search_value) === false && stripos($a['mail'], $search_value) === false) {
        continue;  // Пропускаем записи, которые не соответствуют поисковому запросу
    }

    // Логика обработки данных как в вашем коде
    // Пример:
    $ava = !empty($a['avatar']) ? 'OK' : 'NO';
    $pr = getProxyGroupName($a['gpoup_proxy'], $proxyGroups);
    $use = $a['useacc'] == '0' ? 'FREE' : 'WORK';
    $tocken = stripos($a['tocken'], 'EAAB') !== false ? 'YES' : 'NO';
    $gr = getGroupName($a['group_acc'], $groupData);
    $t = getTagName($a['account_tags'], $accountTagsData);
    $ser = getServerName($a['server'], $getServerData);
    $st = getStatusName($a['status'], $statusData);
    $life = !empty($a['life']) ? $a['life'] : 'No';

    $mysql_data[] = array(
        'login' => $a['login_fb'],
        'mail' => $a['mail'],
        'phone' => $a['phone'],
        'gender' => $a['gender'],
        'avatar' => $ava,
        'proxy' => $pr,
        'server' => $ser,
        'group' => $gr,
        'tag' => $t,
        'status' => $st,
        'task' => $a['task_count'] - 1,
        'use' => $use,
        'life' => $life,
        'friends' => $a['friends'],
        'friends1' => $a['friends1'],
        'tocken' => $tocken,
        'adv' => $a['adv'] == 1 ? 'YES' : 'NO',
        'last_start' => $a['last_start'],
        'action' => $a['id'],
        'spst' => $a['works'] == '0' ? '' : 'incorrect pass',
        'fa' => $a['2fa'] == 'NULL' || $a['2fa'] == 'None' ? '-' : '+',
        'ar' => $a['ar'] == '1' ? 'OK' : ($a['ar'] == '2' ? 'No Ok' : '?'),
        'created_acc' => $a['created_acc'],
        'name' => $a['name'],
        'ig' => $a['ig'] == 1 ? 'bad' : ($a['ig'] == 2 ? 'ok' : ''),
        'idf' => $a['id_fb'],
    );
}

// Сортировка данных
$mysql_data = array_slice($mysql_data, $start, $length);

// Получаем общее количество записей
$total_records = count($accountsData);

// Возвращаем данные в формате JSON
$data = [
    'draw' => $_GET['draw'] ?? 1,  // Для синхронизации с DataTables
    'recordsTotal' => $total_records,
    'recordsFiltered' => $total_records,  // Можно изменить, если используется фильтрация
    'data' => $mysql_data,
];

header('Content-Type: application/json');
echo json_encode($data);


