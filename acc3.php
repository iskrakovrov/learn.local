<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

// Получаем данные сортировки из запроса DataTables
$order_column = isset($_GET['order'][0]['column']) ? $_GET['order'][0]['column'] : 0;  // Столбец для сортировки
$order_dir = isset($_GET['order'][0]['dir']) ? $_GET['order'][0]['dir'] : 'asc';  // Направление сортировки
$search_value = isset($_GET['search']['value']) ? $_GET['search']['value'] : ''; // Поиск по всем столбцам

// Определяем, по какому столбцу будет производиться сортировка
$columns = ['id', 'login_fb', 'mail', 'phone', 'gender', 'avatar', 'proxy', 'server', 'group', 'tag', 'status', 'task', 'use', 'life', 'friends', 'friends1', 'tocken', 'adv', 'last_start', 'action', 'spst', 'fa', 'ar', 'created_acc', 'name', 'ig', 'idf'];
$sort_column = $columns[$order_column]; // Извлекаем имя столбца для сортировки

// Строим SQL-запрос с учетом сортировки
$sql = 'SELECT
    accounts.id,
    login_fb,
    pass_fb,
    id_fb,
    name,
    gender,
    avatar,
    accounts.created,
    group_acc,
    account_tags,
    server,
    id_proxy,
    status,
    works,
    useacc,
    friends,
    (
        SELECT friends
        FROM friends
        WHERE id_acc = accounts.id
        ORDER BY friends.created DESC
        LIMIT 1,1
    ) as friends1,
    last_start,
    tocken,
    mail,
    phone,
    adv,
    2fa,
    ar,
    created_acc,
    ig,
    life,
    gpoup_proxy,
    COUNT(task.task) as task_count
FROM
    accounts
LEFT JOIN
    task ON accounts.id = task.account';

// Если есть значение для поиска, добавляем фильтрацию по всем столбцам
if ($search_value) {
    $sql .= " WHERE login_fb LIKE :search OR mail LIKE :search OR phone LIKE :search OR name LIKE :search";
}

// Добавляем группировку
$sql .= ' GROUP BY accounts.id';

// Добавляем сортировку по выбранному столбцу и направлению
$sql .= " ORDER BY $sort_column $order_dir";

// Получаем параметры пагинации
$limit = isset($_GET['start']) ? (int)$_GET['start'] : 0;  // Начальная позиция
$length = isset($_GET['length']) ? (int)$_GET['length'] : 100; // Количество записей на странице
$sql .= " LIMIT $limit, $length";

// Подготавливаем запрос и выполняем
$stmt = $pdo->prepare($sql);

// Если есть значение поиска, привязываем параметр
if ($search_value) {
    $stmt->bindValue(':search', '%' . $search_value . '%', PDO::PARAM_STR);
}

// Выполняем запрос
$stmt->execute();

// Получаем результаты
$accountsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Маппинг данных для ускорения поиска
$proxyGroups = getProxyGroup();
$groupData = getGroupData();
$getServerData = getServerData();
$statusData = getStatusData();
$accountTagsData = getAccountTagsData();
$proxyGroupsMap = array_column($proxyGroups, 'name_group', 'id');
$groupDataMap = array_column($groupData, 'name_group', 'id');
$accountTagsDataMap = array_column($accountTagsData, 'tag', 'id');
$statusDataMap = array_column($statusData, 'status', 'id');
$serverDataMap = array_column($getServerData, 'name_server', 'id');

$mysql_data = [];

foreach ($accountsData as $a) {
    // Ваш код маппинга данных
    $ava = !empty($a['avatar']) ? 'OK' : 'NO';
    $pr_gr = $a['gpoup_proxy'] ?? null;
    $pr = $proxyGroupsMap[$pr_gr] ?? 'NO group';
    $use = ($a['useacc'] == '0') ? 'FREE' : 'WORK';
    $find = 'EAAB';
    $tocken = (stripos($a['tocken'], $find) !== false) ? 'YES' : 'NO';
    $tk = max(0, $a['task_count'] - 1);
    $gr = $groupDataMap[$a['group_acc']] ?? 'No Group';
    $t = $accountTagsDataMap[$a['account_tags']] ?? 'No tag';
    $life = !empty($a['life']) ? $a['life'] : 'No';
    $ser = $serverDataMap[$a['server']] ?? 'No server';
    $spst = ($a['works'] == '0') ? '' : 'incorrect pass';
    $st = $statusDataMap[$a['status']] ?? 'No';
    $friends = $a['friends'];
    $friends1 = $a['friends1'];
    $cr_acc = $a['created_acc'];
    $ls = $a['last_start'];
    $adv = ($a['adv'] == 1) ? 'YES' : 'NO';
    $fa = ($a['2fa'] == 'NULL' || $a['2fa'] == 'None') ? '-' : '+';
    $ig = ($a['ig'] == 1) ? 'bad' : ($a['ig'] == null ? '' : 'ok');
    $ar = ($a['ar'] == '1') ? 'OK' : (($a['ar'] == '2') ? 'No Ok' : '?');

    $mysql_data[] = array(
        'ids' => $a['id'],
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
        'task' => $tk,
        'use' => $use,
        'life' => $life,
        'friends' => $friends,
        'friends1' => $friends1,
        'tocken' => $tocken,
        'adv' => $adv,
        'last_start' => $ls,
        'action' => $a['id'],
        'spst' => $spst,
        'fa' => $fa,
        'ar' => $ar,
        'created_acc' => $cr_acc,
        'name' => $a['name'],
        'ig' => $ig,
        'idf' => $a['id_fb'],
    );
}

// Подсчет общего количества записей
$countSql = 'SELECT COUNT(*) FROM accounts';
$countStmt = $pdo->query($countSql);
$totalRecords = $countStmt->fetchColumn();

// Ответ для DataTable
$data = array(
    'draw' => isset($_GET['draw']) ? (int)$_GET['draw'] : 0, // Поддержка запросов с множественными страницами
    'recordsTotal' => $totalRecords, // Общее количество записей
    'recordsFiltered' => $totalRecords, // Количество отфильтрованных записей
    'data' => $mysql_data // Отправляем данные
);

// Преобразование в JSON и отправка
header('Content-Type: application/json');
echo json_encode($data, JSON_PRETTY_PRINT);

