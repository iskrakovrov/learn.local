<?php
header('Content-Type: text/plain');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем все cookies из формы
    $cookies = [
        'c_user' => $_POST['c_user'] ?? '',
        'xs' => urldecode($_POST['xs'] ?? ''),
        'datr' => $_POST['datr'] ?? '',
        'fr' => $_POST['fr'] ?? '',
        'sb' => $_POST['sb'] ?? '',
        'wd' => $_POST['wd'] ?? ''
    ];

    // Проверяем обязательные cookies
    if (empty($cookies['c_user']) || empty($cookies['xs'])) {
        die("Not OK: Отсутствуют обязательные cookies (c_user и xs)");
    }

    // Формируем строку cookies для запроса
    $cookieString = '';
    foreach ($cookies as $name => $value) {
        if (!empty($value)) {
            $cookieString .= "$name=$value; ";
        }
    }

    // Настройки запроса
    $url = 'https://www.facebook.com/me';
    $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
    curl_setopt($ch, CURLOPT_COOKIE, $cookieString);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, true);

    // Добавляем дополнительные заголовки
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
        'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
        'Connection: keep-alive',
        'Sec-Fetch-Dest: document',
        'Sec-Fetch-Mode: navigate',
        'Sec-Fetch-Site: same-origin',
        'Referer: https://www.facebook.com/',
        'Upgrade-Insecure-Requests: 1',
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Разделяем заголовки и тело ответа
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headers = substr($response, 0, $header_size);
    $body = substr($response, $header_size);

    curl_close($ch);

    echo "====== HTTP Code: {$httpCode} ======\n\n";
    echo "====== Headers ======\n{$headers}\n\n";
    echo "====== Body (first 1000 chars) ======\n" . substr($body, 0, 100000000) . "\n\n";

    // Проверяем успешность авторизации
    if ($httpCode === 200) {
        if (strpos($body, 'id="ssrb_root_start"') !== false) {
            echo "RESULT: OK (Авторизация успешна)";
        } elseif (strpos($body, 'login.php') !== false) {
            echo "RESULT: Not OK (Требуется вход в систему)";
        } else {
            echo "RESULT: Not OK (Неизвестный ответ от Facebook)";
        }
    } else {
        echo "RESULT: Not OK (Ошибка доступа)";
    }
} else {
    echo "Not OK: Данные не отправлены (используйте POST-запрос)";
}
