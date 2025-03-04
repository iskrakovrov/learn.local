<?php

// Логируем начало обработки
$log_file = 'post_debug.log';
function write_log($message, $file = 'post_debug.log') {
    file_put_contents($file, date('Y-m-d H:i:s') . " - " . $message . PHP_EOL, FILE_APPEND);
}

write_log("Обработка POST-запроса начата");

// Проверяем метод запроса
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    write_log("Метод запроса: POST");

    // Получаем данные из $_POST
    if (!empty($_POST)) {
        write_log("Данные из POST: " . print_r($_POST, true));
        echo "Полученные данные из POST:\n";
        echo "<pre>" . print_r($_POST, true) . "</pre>";
    } else {
        write_log("Данные в POST-переменной отсутствуют");
        echo "POST-переменная пуста.";
    }

    // Получаем данные из $_FILES
    if (!empty($_FILES)) {
        write_log("Данные из FILES: " . print_r($_FILES, true));
        echo "Полученные данные из FILES:\n";
        echo "<pre>" . print_r($_FILES, true) . "</pre>";
    } else {
        write_log("Данные в FILES-переменной отсутствуют");
        echo "FILES-переменная пуста.";
    }

    // Получаем "сырой" входной поток для анализа
    $raw_input = file_get_contents('php://input');
    if ($raw_input) {
        write_log("Сырой входной поток: " . $raw_input);
        echo "Сырой входной поток:\n";
        echo "<pre>" . htmlspecialchars($raw_input) . "</pre>";
    } else {
        write_log("Сырой входной поток пуст");
        echo "Сырой входной поток пуст.";
    }
} else {
    write_log("Ошибка: запрос не POST");
    echo "Этот скрипт обрабатывает только POST-запросы.";
}

write_log("Обработка POST-запроса завершена");
