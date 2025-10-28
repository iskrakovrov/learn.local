<?php
require_once 'function/function.php';

function getRegOptionsJson() {
    // Получаем все данные из таблицы reg_options
    $sql = "SELECT * FROM reg_options";
    $options = selectAll($sql);

    // Форматируем результат
    $result = [];
    foreach ($options as $option) {
        $result[] = [
            'id' => (int)$option['id'],
            'user_id' => (int)$option['user_id'],
            'proxy_group' => $option['proxy_group'] !== null ? (int)$option['proxy_group'] : null,
            'server' => $option['server'] !== null ? (int)$option['server'] : null,
            'account_group' => $option['account_group'] !== null ? (int)$option['account_group'] : null,
            'email' => (int)$option['email'],
            'registration_method' => $option['registration_method'] !== null ? (int)$option['registration_method'] : null,
            'link_email' => (int)$option['link_email'],
            'gender' => $option['gender'] !== null ? (int)$option['gender'] : null,
            'avatar' => $option['avatar'] !== null ? (int)$option['avatar'] : null,
            'city' => (int)$option['city'],
            'first_name' => $option['first_name'] !== null ? (int)$option['first_name'] : null,
            'last_name' => $option['last_name'] !== null ? (int)$option['last_name'] : null,
            'mode' => (int)$option['mode'],
            'bio' => (int)$option['bio'],
            'created_at' => $option['created_at'],
            'updated_at' => $option['updated_at']
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

getRegOptionsJson();
