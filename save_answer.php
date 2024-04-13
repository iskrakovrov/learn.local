<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из POST запроса
    $messageId = $_POST['messageId'];
    $answer = $_POST['answer'];

    // Обновляем запись в базе данных
    $sql = 'UPDATE mess SET answer = ? WHERE id = ?';
    $params = [$answer, $messageId];
    $result = update($sql, $params); // Предполагается, что у вас есть функция update для выполнения запроса

    if ($result) {
        // Возвращаем успешный ответ
        echo json_encode(['success' => true]);
        exit;
    } else {
        // Возвращаем ошибку
        echo json_encode(['success' => false, 'error' => 'Failed to update answer']);
        exit;
    }
}
