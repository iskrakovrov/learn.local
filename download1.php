<?php

// URL удаленного архива
$remoteZipFile = 'https://soft.fbcombo.com/update_host.zip';

// Путь к каталогу, куда нужно распаковать архив (в корень сайта)
$extractTo = $_SERVER['DOCUMENT_ROOT'];

// Скачиваем архив
$zipFile = $extractTo . '/update.zip';
file_put_contents($zipFile, file_get_contents($remoteZipFile));

// Распаковываем архив
$zip = new ZipArchive;
if ($zip->open($zipFile) === TRUE) {
    $zip->extractTo($extractTo);
    $zip->close();
    echo 'Ok';
    // Удаляем загруженный архив
    unlink($zipFile);
} else {
    echo 'No ok';
}

// Переход на index.php
header('Location: index.php');
exit;