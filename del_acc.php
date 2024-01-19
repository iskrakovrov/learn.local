<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

// Получаем массив идентификаторов из сессии
$id = $_SESSION['ids'];

// Проверяем, что массив не пустой и является массивом
if (!empty($id) && is_array($id)) {

    // Размер порции для обработки (например, 100)
    $batchSize = 300;

    // Разбиваем массив на порции
    for ($i = 0; $i < count($id); $i += $batchSize) {
        $chunk = array_slice($id, $i, $batchSize);

        // Для каждой порции выполняем необходимые действия
        foreach ($chunk as $a) {
            $args = [$a];
            $sql = 'SELECT * FROM accounts WHERE id = ?';
            $qu = select($sql, $args);

     //       d_acc($args);

            $p = $qu['$id_proxy'];
            if (!empty($p) && ($p !== 0)) {
                $sql = 'UPDATE proxy SET use_proxy = use_proxy - 1 WHERE id = ?';
                $args = [$p];
                $qu1 = update($sql, $args);
            }

            $sql = 'DELETE FROM accounts WHERE id = ?';
            $args = [$a];
            $qu1 = delete($sql, $args);
        }

        // Дополнительная обработка для каждой порции, если необходимо
        // Например, логирование или другие действия
    }

    // После завершения обработки всех порций можешь добавить дополнительные действия, если нужно

    // Пример удаления из сессии (если это необходимо)
    unset($_SESSION['ids']);

    header('Location: repair.php');
} else {
    // Обработка ситуации, когда массив ids пуст или не является массивом
    // Можешь добавить соответствующий код или сообщение об ошибке
}