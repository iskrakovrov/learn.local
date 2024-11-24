<?php

require_once('inc/config.php');
require_once('function/function.php');


// Указываем номер проекта и список, получаем их через GET-запрос
$project_id = isset($_GET['project_id']) ? (int)$_GET['project_id'] : null;
$group_id = isset($_GET['$group_id']) ? (int)$_GET['$group_id'] : null;

echo $project_id;
echo $group_id;

