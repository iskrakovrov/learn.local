<?php

require_once('inc/db.php');
require_once('function/function.php');

$sql = 'SELECT code FROM oai WHERE status = ? LIMIT 1';
$argc = [0];
$qw1 = select($sql,$argc);
$apioai = $qw1['code'];



$title = 'Как пользоваться мобильными прокси?';
$keywords = '4g mobile proxy, lte mobile proxy, мобильные прокси';
$topic = 'Для чего используются мобильные прокси в SEO';
$language = 'Русский'; // Или "English" для английского языка
$desired_lengths = array(2000, 2500, 1500); // Желаемые длины для каждой части статьи (подзаголовка)

$article_markup = generate_article_with_markup($title, $keywords, $language, $apioai, $desired_lengths);

// Выводим размеченную статью
echo $article_markup;