<?php
header('Content-Type: application/json; charset=utf-8');

require_once('inc/db.php');
require_once('function/function.php');

try {
    // 1. Проверка API-ключа в запросе
    if (!isset($_GET['api']) || empty($_GET['api'])) {
        throw new Exception('API key is required');
    }

    $apiKey = $_GET['api'];

    // 2. Аутентификация пользователя
    $user = select(
        "SELECT id FROM users 
         WHERE api_key = :api_key 
         AND api_key IS NOT NULL 
         AND api_key != ''",
        ['api_key' => $apiKey]
    );

    if (!$user) {
        throw new Exception('Bad API');
    }

    // 3. Получаем сервисы с API-ключом и странами (включая api_key)
    $services = selectAll(
        "SELECT 
            s.id, 
            s.title, 
            s.api_url, 
            s.api_key,  
            s.balance,
            s.is_active,
            DATE_FORMAT(s.balance_updated, '%Y-%m-%d %H:%i:%s') as balance_updated
         FROM sms_services s
         INNER JOIN service_countries sc ON s.id = sc.service_id
         WHERE s.api_key IS NOT NULL 
         AND s.api_key != ''
         GROUP BY s.id
         ORDER BY s.title"
    );

    // 4. Для каждого сервиса получаем его страны
    $result = [];
    foreach ($services as $service) {
        $countries = selectAll(
            "SELECT country_code, country_name 
             FROM service_countries 
             WHERE service_id = ?",
            [$service['id']]
        );

        $service['countries'] = array_map(function ($c) {
            return [
                'code' => $c['country_code'],
                'name' => $c['country_name']
            ];
        }, $countries);

        $result[] = $service;
    }

    // 5. Формируем JSON-ответ
    echo json_encode([
        'success' => true,
        'data' => $result,
        'count' => count($result),
        'timestamp' => date('Y-m-d H:i:s')
    ], JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Database error',
        'message' => $e->getMessage()
    ], JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    $responseCode = $e->getMessage() === 'Bad API' ? 403 : 400;
    http_response_code($responseCode);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage() === 'Bad API' ? 'Auth failed' : 'Request failed',
        'message' => $e->getMessage()
    ], JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
}