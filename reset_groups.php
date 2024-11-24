<?php

require 'inc/db.php';
require 'function/function.php';

try {
    // Определяем, пришел ли POST или GET запрос
    if (($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ntask'])) ||
        ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['ntask']))) {

        // Получаем ntask в зависимости от типа запроса
        $ntask = $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['ntask'] : $_GET['ntask'];

        if ($ntask === 'all') {
            // Удаление всех записей
            $result = delete("DELETE FROM group_locks WHERE 1=1");
            $message = $result ? "Все записи успешно удалены." : "Ошибка при удалении всех записей.";
        } else {
            // Удаление записей по конкретному project_id
            $result = delete("DELETE FROM group_locks WHERE project_id = :ntask", [':ntask' => $ntask]);
            $message = $result ? "Записи для project_id $ntask успешно удалены." : "Ошибка при удалении записей для project_id $ntask.";
        }

        // Перенаправляем обратно на страницу с GET-параметром message (для POST-запросов)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Location: ' . $_SERVER['HTTP_REFERER'] . '?message=' . urlencode($message));
            exit; // Завершаем выполнение скрипта после редиректа
        } else {
            // Для GET-запросов просто выводим сообщение
            echo $message;
        }

    } else {
        // Если запрос не содержит данных или не POST/GET, выводим сообщение об ошибке
        echo "Неверный запрос. Не указано значение ntask.";
    }
} catch (Exception $e) {
    // Обработка ошибок
    echo "Ошибка: " . $e->getMessage();
}