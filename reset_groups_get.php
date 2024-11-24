<?php


require 'inc/db.php';
require 'function/function.php';

try {
    // Проверяем, есть ли GET-параметр ntask
    if (isset($_GET['ntask'])) {
        $ntask = $_GET['ntask'];

        if ($ntask === 'all') {
            // Удаление всех записей и тех, что старше суток
            $result = delete("DELETE FROM group_locks WHERE locked_at < NOW() - INTERVAL 1 DAY");
            $message = $result ? "Все старые записи успешно удалены." : "Ошибка при удалении записей.";
        } else {
            // Удаление записей для конкретного project_id, старше суток
            $result = delete("DELETE FROM group_locks WHERE project_id = :ntask AND locked_at < NOW() - INTERVAL 1 DAY", [':ntask' => $ntask]);
            $message = $result ? "Записи для project_id $ntask, старше суток, успешно удалены." : "Ошибка при удалении записей для project_id $ntask.";
        }

        // Выводим сообщение
        echo $message;
    } else {
        echo "Неверный запрос. Не указано значение ntask.";
    }
} catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage();
}