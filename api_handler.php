<?php
declare(strict_types=1);
include_once('inc/init.php');
require_once('inc/db.php');
header('Content-Type: application/json');
require_once('function/function.php');

// Включить логгирование ошибок
ini_set('display_errors', '0');
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/api_errors.log');

try {
    // 1. Получаем и фильтруем параметры
    $params = [
        'action' => $_GET['action'] ?? null,
        'api_key' => $_GET['api_key'] ?? null,  //ЗДЕСЬ БРАТЬ ИЗ БАЗЫ ДАННЫХ
        'domain' => isset($_GET['domain']) ? filter_var($_GET['domain'], FILTER_SANITIZE_URL) : null,
        'country' => isset($_GET['country']) ? (int)$_GET['country'] : null,
        'service' => isset($_GET['service']) ? preg_replace('/[^a-zA-Z0-9_-]/', '', $_GET['service']) : null,
        'id' => isset($_GET['id']) ? (int)$_GET['id'] : null,
        'status' => isset($_GET['status']) ? (int)$_GET['status'] : null,
        'forward' => isset($_GET['forward']) ? filter_var($_GET['forward'], FILTER_VALIDATE_BOOLEAN) : false,
        'operator' => isset($_GET['operator']) ? preg_replace('/[^a-zA-Z0-9_-]/', '', $_GET['operator']) : null
    ];

    // 2. Валидация обязательных параметров
    $required = [
        'action' => 'Не указано действие (action)',
        'api_key' => 'Не указан API ключ',
        'domain' => 'Не указан домен API'
    ];

    foreach ($required as $param => $error) {
        if (empty($params[$param])) {
            throw new InvalidArgumentException($error);
        }
    }

    // 3. Дополнительная валидация домена
    if (!filter_var($params['domain'], FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
        throw new InvalidArgumentException('Некорректный домен API');
    }

    // 4. Обработка действий
    $result = [];
    switch ($params['action']) {
        case 'getBalance':
            $result = ['balance' => getBalance($params['api_key'], $params['domain'])];
            break;

        case 'getNumber':
            if (empty($params['service'])) {
                throw new InvalidArgumentException('Не указан сервис');
            }
            if ($params['country'] === null) {
                throw new InvalidArgumentException('Не указана страна');
            }

            $numberData = getNumber(
                $params['api_key'],
                $params['service'],
                $params['domain'],
                $params['country'],
                $params['forward'],
                $params['operator']
            );
            $result = [
                'activation_id' => $numberData[1],
                'phone_number' => $numberData[2]
            ];
            break;

        case 'getStatus':
            if (empty($params['id'])) {
                throw new InvalidArgumentException('Не указан ID активации');
            }

            $statusData = getStatus($params['api_key'], $params['id'], $params['domain']);
            $result = [
                'status' => $statusData[0],
                'code' => $statusData[1] ?? null
            ];
            break;

        case 'setStatus':
            if (empty($params['id'])) {
                throw new InvalidArgumentException('Не указан ID активации');
            }
            if ($params['status'] === null) {
                throw new InvalidArgumentException('Не указан статус');
            }

            $result = [
                'result' => setStatus(
                    $params['api_key'],
                    $params['id'],
                    $params['status'],
                    $params['domain'],
                    $params['forward']
                )
            ];
            break;

        case 'getCountries':
            $result = getCountries($params['api_key'], $params['domain']);
            break;

        case 'getPrices':
            $result = getPrices(
                $params['api_key'],
                $params['domain'],
                $params['country'],
                $params['service'],
                $params['operator']
            );
            break;

        default:
            throw new InvalidArgumentException('Неизвестное действие');
    }

    // 5. Успешный ответ
    echo json_encode([
        'success' => true,
        'data' => $result,
        'timestamp' => time()
    ], JSON_THROW_ON_ERROR);

} catch (InvalidArgumentException $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
        'error_type' => 'invalid_parameters'
    ], JSON_THROW_ON_ERROR);
} catch (RuntimeException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
        'error_type' => 'api_error'
    ], JSON_THROW_ON_ERROR);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Внутренняя ошибка сервера',
        'error_type' => 'server_error'
    ], JSON_THROW_ON_ERROR);
}