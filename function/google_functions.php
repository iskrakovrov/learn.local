<?php

require_once 'function/function.php';

/**
 * Генерирует IMEI для устройств Xiaomi
 */
function generate_xiaomi_imei($tacPrefix) {
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
 * Генерирует серийный номер Xiaomi устройства
 */
function generate_xiaomi_serial($pattern) {
    if (strpos($pattern, '%') !== false) {
        return vsprintf($pattern, [mt_rand(0, 999999)]);
    }
    return $pattern . strtoupper(bin2hex(random_bytes(3)));
}

/**
 * Генерирует MAC-адрес для Xiaomi устройств
 */
function generate_xiaomi_mac($prefix) {
    $mac = $prefix;
    for ($i = 0; $i < 3; $i++) {
        $mac .= ':' . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }
    return $mac;
}

/**
 * Получает случайное устройство Xiaomi из БД
 */
function get_random_xiaomi_device() {
    $sql = "SELECT * FROM xiaomi_devices WHERE is_current = 1 ORDER BY RAND() LIMIT 1";
    return select($sql);
}

/**
 * Генерирует номер сборки в формате Xiaomi
 */
function generate_xiaomi_build_number($androidVersion, $modelName) {
    $versionPrefixes = [
        'Redmi' => 'RKQ',
        'Xiaomi' => 'V',
        'POCO' => 'RKQ',
        'Black Shark' => 'SKQ'
    ];

    $prefix = 'V';
    foreach ($versionPrefixes as $brand => $code) {
        if (strpos($modelName, $brand) === 0) {
            $prefix = $code;
            break;
        }
    }

    $quarter = ceil(date('m') / 3);
    return sprintf("%s%s.%d.%s.%s",
        $prefix,
        date('y'),
        $quarter,
        str_replace('.', '', $androidVersion),
        strtoupper(bin2hex(random_bytes(2)))
    );
}

/**
 * Генерирует полные данные устройства Xiaomi
 */
function generate_xiaomi_device_data($modelName = null) {
    $device = $modelName
        ? select("SELECT * FROM xiaomi_devices WHERE model_name = ?", [$modelName])
        : get_random_xiaomi_device();

    if (!$device) {
        return ['error' => 'Xiaomi device not found'];
    }

    return [
        'product_line' => $device['product_line'],
        'model_name' => $device['model_name'],
        'codename' => $device['codename'],
        'imei' => generate_xiaomi_imei($device['tac_prefix']),
        'serial_number' => generate_xiaomi_serial($device['serial_pattern']),
        'mac_address' => generate_xiaomi_mac($device['mac_prefix']),
        'android_version' => get_random_android_version($device['android_min'], $device['android_max']),
        'security_patch' => $device['security_patch'],
        'ram' => get_random_option($device['ram_options']),
        'storage' => get_random_option($device['storage_options']),
        'screen' => $device['screen_size'] . '" ' . $device['resolution'] . ' ' . $device['refresh_rate'],
        'chipset' => $device['chipset'],
        'battery' => $device['battery_capacity'] . ' mAh',
        'release_date' => $device['release_date'],
        'is_5g' => (bool)$device['is_5g'],
        'build_number' => generate_xiaomi_build_number($device['android_min'], $device['model_name'])
    ];
}