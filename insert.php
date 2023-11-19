<?php

require_once('inc/db.php');
require_once('function/function.php');

// Используйте тернарный оператор для установки значения переменной $sql
$sql = (empty($_GET["sql"])) ? $_POST["sql"] : $_GET["sql"];

// Вызывайте функцию insert и сохраняйте результат в переменной $upd
$upd = insert($sql);

// Преобразуйте массив $upd в формат JSON и выводите его
$json_data = json_encode($upd, JSON_THROW_ON_ERROR);
print $json_data;
?>