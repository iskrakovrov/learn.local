<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

if ($id !== null) {
    // Создаем временную таблицу с уникальными значениями
    $sql = "CREATE TABLE tmp_tab AS SELECT DISTINCT value FROM value_lists WHERE list = $id";
    $qw = create($sql);

    // Удаляем существующие значения из исходной таблицы
    $sql = "DELETE FROM value_lists WHERE list = $id";
    $qw = delete($sql);

    // Вставляем уникальные значения обратно в исходную таблицу
    $sql = "INSERT INTO value_lists (value, list) SELECT value, $id FROM tmp_tab";
    $qw = insert($sql);

    // Удаляем временную таблицу
    $sql = 'DROP TABLE tmp_tab';
    $qw = create($sql);
}

// Перенаправляем обратно на страницу-источник
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;