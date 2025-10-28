<?php
$baseUrl = "https://eurabota.com/job";
$maxPages = 50;

$proxyListFile = __DIR__ . '/proxy.txt';
$logFile = __DIR__ . '/proxy_log.txt';
$requestLimitPerProxy = 50;

$allLinks = [];
libxml_use_internal_errors(true);

// Загружаем список прокси
$proxies = file($proxyListFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
if (!$proxies) {
    die("Не удалось загрузить прокси из файла proxy.txt\n");
}

$currentProxyIndex = 0;
$currentRequestCount = 0;

function logMessage($message) {
    global $logFile;
    $time = date("[Y-m-d H:i:s]");
    file_put_contents($logFile, "$time $message\n", FILE_APPEND);
}

function getCurrentProxy() {
    global $proxies, $currentProxyIndex;
    return $proxies[$currentProxyIndex];
}

function switchProxy($reason = 'manual') {
    global $proxies, $currentProxyIndex, $currentRequestCount;

    $oldProxy = $proxies[$currentProxyIndex];
    $currentProxyIndex = ($currentProxyIndex + 1) % count($proxies);
    $newProxy = $proxies[$currentProxyIndex];
    $currentRequestCount = 0;

    logMessage("Смена прокси [$reason]: $oldProxy → $newProxy");
}

function getPageWithProxy($url) {
    global $currentRequestCount, $requestLimitPerProxy;

    $proxy = getCurrentProxy();

    $opts = [
        "http" => [
            "method" => "GET",
            "timeout" => 15,
        ]
    ];

    $context = stream_context_create($opts);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_PROXY, $proxy);
    curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0");

    $html = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($html === false || $httpCode === 500 || $httpCode === 403) {
        logMessage("Ошибка $httpCode при запросе $url через $proxy");
        switchProxy("HTTP $httpCode");
        curl_close($ch);
        return false;
    }

    curl_close($ch);

    $currentRequestCount++;
    if ($currentRequestCount >= $requestLimitPerProxy) {
        switchProxy("достигнут лимит $requestLimitPerProxy");
    }

    return $html;
}

// Основной цикл
for ($i = 1; $i <= $maxPages; $i++) {
    $url = $baseUrl . "?p=$i";
    echo "Обрабатываем страницу: $url\n";

    $html = getPageWithProxy($url);
    if ($html === false) {
        echo "Пропускаем страницу $url из-за ошибки.\n";
        continue;
    }

    $dom = new DOMDocument();
    $dom->loadHTML($html);
    $xpath = new DOMXPath($dom);

    $nodes = $xpath->query("//div[contains(@class, 'lld')]/a[contains(@href, '/v/')]");

    foreach ($nodes as $node) {
        $href = $node->getAttribute('href');
        $fullUrl = "https://eurabota.com/" . ltrim($href, '/');
        $allLinks[] = $fullUrl;
    }

    sleep(1);
}

libxml_clear_errors();

$allLinks = array_unique($allLinks);
echo "Найдено " . count($allLinks) . " уникальных ссылок.\n";

// Можно сохранить в файл:
file_put_contents("links.txt", implode(PHP_EOL, $allLinks));

echo "Парсинг завершен. Результат сохранён в links.txt\n";
