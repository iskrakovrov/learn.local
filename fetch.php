<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $c_user = $_POST['c_user'] ?? '';
    $xs = $_POST['xs'] ?? '';
    $url = $_POST['url'] ?? '';

    if (empty($c_user) || empty($xs) || empty($url)) {
        die("Ошибка: заполните все поля!");
    }

    // User-Agent (Chrome 138)
    $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36';

    // Настройка кук
    $cookies = "c_user={$c_user}; xs={$xs}";

    // Настройка cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
    curl_setopt($ch, CURLOPT_COOKIE, $cookies);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Разрешить редиректы
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Отключить проверку SSL (небезопасно!)

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    // Проверка ответа
    if ($httpCode === 200) {
        echo "<h2>Успешно! Ответ получен.</h2>";

        // Сохраняем HTML в файл
        file_put_contents('facebook_page.html', $response);
        echo "<p>Страница сохранена в <b>facebook_page.html</b></p>";

        // Можно вывести часть содержимого
        echo "<pre>" . htmlspecialchars(substr($response, 0, 1000)) . "...</pre>";
    } else {
        echo "<h2>Ошибка: HTTP-код {$httpCode}</h2>";
        echo "<p>Facebook мог заблокировать запрос.</p>";
    }
} else {
    echo "<h2>Ошибка: форма не отправлена!</h2>";
}
?>