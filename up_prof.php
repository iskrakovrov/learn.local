<?php
// Проверяем, был ли запрос POST и был ли файл отправлен
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    // Получаем информацию о загруженном файле
    $file_name = basename($_FILES['file']['name']);
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    $tmp_name = $_FILES['file']['tmp_name'];

    // Путь для сохранения загруженного файла
    $upload_dir = 'profiles/';

    // Проверяем, существует ли директория, если нет — создаем её
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Перемещаем загруженный файл в указанную директорию
    if (move_uploaded_file($tmp_name, $upload_dir . $file_name)) {
        echo "Файл успешно загружен: " . $file_name . "<br>";
        echo "Размер файла: " . $file_size . " байт<br>";
        echo "Тип файла: " . $file_type . "<br>";
        echo "Временный путь: " . $tmp_name . "<br>";
    } else {
        echo "Ошибка при загрузке файла.";
    }
} else {
    echo "Файл не получен.";
}