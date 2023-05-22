<?php

// Заданное ключевое слово
$keyword = '4g proxy';

// Формируем URL для поискового запроса в Bing
$searchUrl = 'https://www.bing.com/search?q=' . urlencode($keyword);

// Получаем HTML-код страницы результатов поиска
$html = file_get_contents($searchUrl);

// Извлекаем первые 10 сниппетов с помощью регулярного выражения
$pattern = '/<div class="b_caption">(.*?)<\/div>/s';
preg_match_all($pattern, $html, $matches);

// Выводим сниппеты
$snippets = $matches[0];
$count = count($snippets);

for ($i = 0; $i < $count && $i < 10; $i++) {
    $decodedSnippet = html_entity_decode(strip_tags($snippets[$i]));
    echo 'Сниппет ' . ($i + 1) . ': ' . $decodedSnippet . '<br><br>';
}