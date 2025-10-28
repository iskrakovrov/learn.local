<?php
// Файлы
$linksFile = 'links.txt';
$proxyFile = 'proxy.txt';
$outputCsv = 'jobs.csv';
$logFile = 'parser.log';

// Читаем ссылки
$links = file($linksFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
if (!$links) {
    die("Не удалось прочитать файл $linksFile\n");
}

// Читаем прокси
$proxies = file($proxyFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
if (!$proxies) {
    die("Не удалось прочитать файл $proxyFile\n");
}

$proxyIndex = 0;
$requests = 0;
$maxRequestsPerProxy = 50;

// Открываем CSV (дозапись)
$fp = fopen($outputCsv, 'a');
if (!$fp) {
    die("Не удалось открыть $outputCsv для записи\n");
}

// Если файл пустой — пишем заголовок
if (filesize($outputCsv) === 0) {
    fputcsv($fp, ['ID', 'Заголовок', 'Автор', 'Расположение', 'Дата публикации', 'Описание']);
}

// Функция логирования
function logMessage(string $msg) {
    global $logFile;
    $time = date('[Y-m-d H:i:s]');
    file_put_contents($logFile, "$time $msg\n", FILE_APPEND);
    echo "$time $msg\n";
}

// Очистка описания от тегов и пробелов
function cleanDescription(string $html): string {
    $text = strip_tags($html);
    $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $text = trim(preg_replace('/\s+/', ' ', $text));
    return $text;
}

// Получение HTML через прокси
function getHtmlWithProxy(string $url, string $proxy): ?array {
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CONNECTTIMEOUT => 15,
        CURLOPT_TIMEOUT => 20,
        CURLOPT_PROXY => $proxy,
        CURLOPT_PROXYTYPE => CURLPROXY_SOCKS5,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/124.0.0.0 Safari/537.36',
        CURLOPT_HEADER => true,
    ]);
    $response = curl_exec($ch);

    if ($response === false) {
        curl_close($ch);
        return null;
    }

    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $body = substr($response, $headerSize);

    curl_close($ch);

    return ['body' => $body, 'httpCode' => $httpCode];
}

libxml_use_internal_errors(true);

foreach ($links as $i => $url) {
    if ($requests > 0 && $requests % $maxRequestsPerProxy === 0) {
        $oldProxy = $proxies[$proxyIndex];
        $proxyIndex = ($proxyIndex + 1) % count($proxies);
        $newProxy = $proxies[$proxyIndex];
        logMessage("Смена прокси после $requests запросов: $oldProxy → $newProxy");
    }

    $proxy = $proxies[$proxyIndex];
    logMessage("Парсим: $url через $proxy");

    $result = getHtmlWithProxy($url, $proxy);
    if ($result === null) {
        logMessage("[{$proxy}] Ошибка curl_exec при запросе $url");
        $proxyIndex = ($proxyIndex + 1) % count($proxies);
        continue;
    }

    $body = $result['body'];
    $httpCode = $result['httpCode'];

    if (in_array($httpCode, [403, 500]) || trim($body) === '') {
        logMessage("[{$proxy}] Ошибка HTTP $httpCode или пустой ответ при запросе $url");
        $oldProxy = $proxy;
        $proxyIndex = ($proxyIndex + 1) % count($proxies);
        $newProxy = $proxies[$proxyIndex];
        logMessage("Смена прокси [HTTP $httpCode]: $oldProxy → $newProxy");
        continue;
    }

    $dom = new DOMDocument();
    $dom->loadHTML($body);
    $xpath = new DOMXPath($dom);

    $jobId = $xpath->evaluate("string(//input[@id='job_id']/@value)");
    $title = $xpath->evaluate("string(//h2[@class='job_title']/span[@itemprop='title'])");
    $author = $xpath->evaluate("string(//span[@itemprop='name' and contains(@class,'authorName')])");
    $location = $xpath->evaluate("string(//span[@itemprop='address'])");
    $datePosted = $xpath->evaluate("string(//meta[@itemprop='datePosted']/@content)");

    $descNode = $xpath->query("//div[@id='job-description']");
    $description = '';
    if ($descNode->length > 0) {
        $htmlDesc = $dom->saveHTML($descNode->item(0));
        $description = cleanDescription($htmlDesc);
    }

    fputcsv($fp, [$jobId, $title, $author, $location, $datePosted, $description]);

    $requests++;
    sleep(1);
}

fclose($fp);
libxml_clear_errors();

logMessage("Парсинг завершён. Результаты в файле $outputCsv\n");
