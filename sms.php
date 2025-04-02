<?php
header('Content-Type: application/json; charset=utf-8');

require_once('inc/db.php');
require_once('function/function.php');

try {
    // Проверка API-ключа в запросе
    if (!isset($_GET['api']) || empty($_GET['api'])) {
        throw new Exception('API key is required');
    }

    $apiKey = $_GET['api'];

    // Аутентификация пользователя
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

    // Получаем полные данные о сервисах, включая api_key
    $services = selectAll(
        "SELECT 
            id,
            name,
            title,
            api_url,
            api_key,  
            is_active,
            balance,
            DATE_FORMAT(balance_updated, '%Y-%m-%d %H:%i:%s') as balance_updated,
            DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s') as created_at
         FROM sms_services 
         WHERE api_key IS NOT NULL 
         AND api_key != ''
         ORDER BY title"
    );

    // Формируем ответ
    echo json_encode([
        'success' => true,
        'data' => $services,
        'count' => count($services),
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