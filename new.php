<?php

$filename = 'mig.php';

if (file_exists($filename)) {
    echo "Файл $filename существует";
    unlink($filename);
} else {
    echo "Файл $filename не существует";
}

