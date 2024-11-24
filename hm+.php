<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$data = $_POST['data'];
if (!$data) {
    die("Нет данных для обработки.");
}

// Разбиваем данные на строки
$rows = explode("\n", $data);

// Подготовка для пакетной вставки
$batch_size = 1000;  // Оптимальный размер пакета
$batch_data = [];


// Обрабатываем каждую строку
foreach ($rows as $row) {
    // Очищаем строку от пробелов и разделяем на элементы
    $row = trim($row);
    if (empty($row)) {
        continue;
    }

    $fields = explode(';', $row);

    // Если полей меньше 5, добавляем пустые значения для отсутствующих полей
    if (count($fields) < 5) {
        $fields = array_pad($fields, 5, ''); // Дополняем до 5 элементов пустыми значениями
    }

    list($mail, $pass_mail, $hm, $hmpass, $phone) = $fields;

    // Проверяем условия фильтрации
    if (empty($pass_mail) || empty($hmpass)) {
        continue; // Пропускаем, если отсутствуют пароли
    }

    if (empty($hm) && empty($hmpass) && empty($phone)) {
        continue; // Пропускаем, если все 3 последние значения пусты
    }

    // Собираем данные для вставки
    $batch_data[] = [
        'mail' => $mail,
        'pass_mail' => $pass_mail,
        'hm' => $hm,
        'hmpass' => $hmpass,
        'phone' => $phone
    ];

    // Если накопилось достаточно данных для вставки, выполняем вставку
    if (count($batch_data) >= $batch_size) {
        insertBatch($batch_data);
        $batch_data = []; // Очищаем пакет после вставки
    }
}

// Вставляем оставшиеся данные, если они есть
if (!empty($batch_data)) {
    insertBatch($batch_data);
}

echo "Загрузка данных завершена.";