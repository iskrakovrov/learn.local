<?php
require_once 'function/function.php';

/**
 * Генерирует валидный IMEI на основе TAC-префикса
 */
function generate_samsung_imei($tacPrefix) {
    $randomPart = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
    $imeiBase = substr($tacPrefix . $randomPart, 0, 14);

    $sum = 0;
    for ($i = 0; $i < 14; $i++) {
        $digit = (int)$imeiBase[$i];
        $sum += ($i % 2 === 0) ? $digit : (($digit * 2 > 9) ? $digit * 2 - 9 : $digit * 2);
    }
    $checksum = (10 - ($sum % 10)) % 10;

    return $imeiBase . $checksum;
}

/**
 * Генерирует серийный номер по шаблону
 */
function generate_samsung_serial($pattern) {
    if (strpos($pattern, '%') !== false) {
        return vsprintf($pattern, [mt_rand(0, 9999), mt_rand(0, 9999), mt_rand(0, 9999)]);
    }
    return $pattern . strtoupper(bin2hex(random_bytes(3)));
}

/**
 * Генерирует MAC-адрес с заданным префиксом
 */
function generate_samsung_mac($prefix) {
    $mac = $prefix;
    for ($i = 0; $i < 3; $i++) {
        $mac .= ':' . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }
    return $mac;
}

/**
 * Выбирает случайное значение из строки с вариантами
 */
function get_random_option($options) {
    $parts = array_map('trim', explode(',', $options));
    return $parts[array_rand($parts)];
}

/**
 * Получает случайную версию Android в диапазоне
 */
function get_random_android_version($min, $max) {
    $versions = [];
    $current = (float)$min;
    $end = (float)$max;

    while ($current <= $end) {
        $versions[] = number_format($current, 1);
        $current += 0.1;
    }

    return $versions[array_rand($versions)];
}

/**
 * Получает случайное устройство Samsung из БД
 */
function get_random_samsung_device() {
    $sql = "SELECT * FROM samsung_devices WHERE is_current = 1 ORDER BY RAND() LIMIT 1";
    return select($sql);
}

/**
 * Генерирует полные данные устройства
 */
function generate_samsung_device_data($modelName = null) {
    $device = $modelName
        ? select("SELECT * FROM samsung_devices WHERE model_name = ?", [$modelName])
        : get_random_samsung_device();

    if (!$device) {
        return ['error' => 'Device not found'];
    }

    return [
        'model_group' => $device['model_group'],
        'model_name' => $device['model_name'],
        'imei' => generate_samsung_imei($device['tac_prefix']),
        'serial_number' => generate_samsung_serial($device['serial_pattern']),
        'mac_address' => generate_samsung_mac($device['mac_prefix']),
        'android_version' => get_random_android_version($device['android_min'], $device['android_max']),
        'ram' => get_random_option($device['ram_options']),
        'storage' => get_random_option($device['storage_options']),
        'screen' => $device['screen_size'] . '" ' . $device['resolution'],
        'chipset' => $device['chipset'],
        'release_quarter' => $device['release_quarter'],
        'is_5g' => (bool)$device['is_5g'],
        'is_current' => (bool)$device['is_current']
    ];
}
