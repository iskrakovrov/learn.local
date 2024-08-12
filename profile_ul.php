<?php
// Убедитесь, что папка "profile" существует и имеет права на запись
$targetDir = "profile/";

// Проверяем, есть ли файл в POST запросе
if(isset($_FILES["file"])) {
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);

    // Перемещаем загруженный файл в целевую папку
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        echo "Файл успешно загружен.";
    } else {
        echo "Произошла ошибка при загрузке файла.";
    }
} else {
    echo "Файл не был передан в POST запросе.";
}