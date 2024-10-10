<?php
// Проверяем, был ли запрос POST и был ли файл отправлен
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {

    // Указываем директорию, куда будем сохранять загруженные файлы
    $upload_dir = 'uploads/';

    // Проверяем, существует ли директория, если нет — создаем её
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Получаем имя файла
    $file_name = basename($_FILES['file']['name']);

    // Полный путь для сохранения файла
    $upload_file = $upload_dir . $file_name;

    // Перемещаем загруженный файл в указанную директорию
    if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
        echo "Файл успешно загружен: " . $upload_file;
    } else {
        echo "Ошибка при загрузке файла.";
    }
} else {
    echo "Файл не получен.";
}
