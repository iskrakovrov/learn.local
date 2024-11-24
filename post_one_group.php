<?php
// Устанавливаем соединение с базой данных
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
die("Ошибка соединения: " . $conn->connect_error);
}

// Получаем текущую дату и время
$current_time = date('Y-m-d H:i:s');
$yesterday = date('Y-m-d H:i:s', strtotime('-1 day', strtotime($current_time)));

// Запрос на выборку группы, в которой не было постов последние сутки
$sql = "SELECT vl.id, vl.value
FROM value_lists vl
LEFT JOIN post_logs pl ON vl.id = pl.group_id
WHERE (pl.post_time IS NULL OR pl.post_time < ?)
LIMIT 1";

$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $yesterday);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
$group_id = $row['id'];
$group_url = $row['value'];

// Здесь выполняются необходимые действия с группой
echo "Отправляем пост в группу: " . $group_url;

// После отправки поста сохраняем информацию в post_logs
$sql_insert = "INSERT INTO post_logs (group_id, post_time) VALUES (?, ?)";
$stmt_insert = $conn->prepare($sql_insert);
$stmt_insert->bind_param('is', $group_id, $current_time);
$stmt_insert->execute();
} else {
echo "Нет доступных групп для постинга.";
}

$stmt->close();
$conn->close();