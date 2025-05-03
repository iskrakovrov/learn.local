<?php
require_once 'function/function.php';

function getServicesWithCountriesJson() {
    // 1. Проверка API ключа пользователя
    if (empty($_GET['api_key'])) {
        http_response_code(401);
        die(json_encode(['error' => 'API key is required']));
    }

    $userApiKey = $_GET['api_key'];
    $userSql = "SELECT id FROM users WHERE api_key = ? LIMIT 1";
    $user = select($userSql, [$userApiKey]);

    if (!$user) {
        http_response_code(403);
        die(json_encode(['error' => 'Invalid API key']));
    }

    // 2. SQL-запрос только для сервисов с привязанными странами
    $sql = "
        SELECT 
            ss.id,
            ss.name,
            ss.title,
            ss.api_url,
            ss.api_key,
            ss.is_active,
            ss.balance,
            ss.balance_updated,
            ss.created_at,
            GROUP_CONCAT(sc.country_code) AS country_codes,
            GROUP_CONCAT(sc.country_name) AS country_names
        FROM 
            sms_services ss
        INNER JOIN  -- Используем INNER JOIN вместо LEFT JOIN для фильтрации
            service_countries sc ON ss.id = sc.service_id
        WHERE 
            ss.is_active = 1
        GROUP BY 
            ss.id
        HAVING
            country_codes IS NOT NULL  -- Гарантируем, что есть страны
    ";

    $services = selectAll($sql);

    // 3. Формируем ответ
    $result = [];
    foreach ($services as $service) {
        $countries = [];
        $countryCodes = explode(',', $service['country_codes']);
        $countryNames = explode(',', $service['country_names']);

        for ($i = 0, $iMax = count($countryCodes); $i < $iMax; $i++) {
            $countries[] = [
                'code' => $countryCodes[$i],
                'name' => $countryNames[$i]
            ];
        }

        $result[] = [
            'id' => (int)$service['id'],
            'name' => $service['name'],
            'title' => $service['title'],
            'api_url' => $service['api_url'],
            'api_key' => $service['api_key'],
            'is_active' => (bool)$service['is_active'],
            'balance' => $service['balance'] !== null ? (float)$service['balance'] : null,
            'balance_updated' => $service['balance_updated'],
            'created_at' => $service['created_at'],
            'countries' => $countries
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

getServicesWithCountriesJson();