<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из POST запроса
    $messageId = $_POST['messageId'];

    // Удаляем запись из базы данных
    $sql = 'DELETE FROM mess WHERE id = ?';
    $params = [$messageId];
    $result = delete($sql, $params); // Предполагается, что у вас есть функция delete для выполнения запроса

    if ($result) {
        // Возвращаем успешный ответ
        echo json_encode(['success' => true]);
        exit;
    } else {
        // Возвращаем ошибку
        echo json_encode(['success' => false, 'error' => 'Failed to delete message']);
        exit;
    }
}