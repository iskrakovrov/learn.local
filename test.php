<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$sql = 'SELECT id_fb FROM accounts';
$qw = selectAll($sql);
foreach ($qw as $a) {
$id = $a['id_fb'];
// Указываем URL, для которого нужно получить заголовки
    $url .= 'https://www.facebook.com/';
    $url .= '$id';
// Задаем пользовательский User-Agent
    $user_agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36';

// Создаем пользовательский контекст запроса с заданным User-Agent
    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'header' => "User-Agent: $user_agent\r\n",
        ],
    ]);

// Получаем заголовки HTTP с помощью функции get_headers() и пользовательского контекста
    $headers = get_headers($url, 1, $context);

// Выводим полученные заголовки
    $chk = $headers['accept-ch'];
if ($http_response_header[0]!='HTTP/1.1.200 OK'){
    echo $http_response_header[0];
}
}


