<?php
require_once 'function/function.php';

/**
 * Генерирует IMEI для устройств Huawei
 */
function generate_huawei_imei($tacPrefix) {
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
 * Генерирует серийный номер Huawei устройства
 */
function generate_huawei_serial($pattern) {
    if (strpos($pattern, '%') !== false) {
        return vsprintf($pattern, [mt_rand(0, 999999)]);
    }
    return $pattern . strtoupper(bin2hex(random_bytes(3)));
}

/**
 * Генерирует MAC-адрес для Huawei устройств
 */
function generate_huawei_mac($prefix) {
    $mac = $prefix;
    for ($i = 0; $i < 3; $i++) {
        $mac .= ':' . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }
    return $mac;
}

/**
 * Получает случайное устройство Huawei из БД
 */
function get_random_huawei_device() {
    $sql = "SELECT * FROM huawei_devices WHERE is_current = 1 ORDER BY RAND() LIMIT 1";
    return select($sql);
}

/**
 * Генерирует номер сборки в формате Huawei
 */
function generate_huawei_build_number($androidVersion, $modelName) {
    $versionPrefix = 'HW';
    $regionCode = 'C';
    $branchCodes = ['E', 'R', 'D', 'C'];

    $branch = $branchCodes[array_rand($branchCodes)];
    $version = str_replace('.', '', $androidVersion);

    return sprintf("%s%s%s%02d%03d%s",
        $versionPrefix,
        $branch,
        $regionCode,
        date('y'),
        mt_rand(100, 999),
        strtoupper(substr(md5($modelName), 0, 3))
    );
}

/**
 * Генерирует полные данные устройства Huawei
 */
function generate_huawei_device_data($modelName = null) {
    $device = $modelName
        ? select("SELECT * FROM huawei_devices WHERE model_name = ?", [$modelName])
        : get_random_huawei_device();

    if (!$device) {
        return ['error' => 'Huawei device not found'];
    }

    return [
        'product_line' => $device['product_line'],
        'model_name' => $device['model_name'],
        'codename' => $device['codename'],
        'imei' => generate_huawei_imei($device['tac_prefix']),
        'serial_number' => generate_huawei_serial($device['serial_pattern']),
        'mac_address' => generate_huawei_mac($device['mac_prefix']),
        'android_version' => get_random_android_version($device['android_min'], $device['android_max']),
        'security_patch' => $device['security_patch'],
        'ram' => get_random_option($device['ram_options']),
        'storage' => get_random_option($device['storage_options']),
        'screen' => $device['screen_size'] . '" ' . $device['resolution'] . ' ' . $device['refresh_rate'],
        'chipset' => $device['chipset'],
        'battery' => $device['battery_capacity'] . ' mAh',
        'release_date' => $device['release_date'],
        'is_5g' => (bool)$device['is_5g'],
        'build_number' => generate_huawei_build_number($device['android_min'], $device['model_name']),
        'emui_version' => 'EMUI ' . ((float)$device['android_min'] + 2.0)
    ];
}

/**
 * Дополнительная функция для генерации EMUI версии
 */
function generate_emui_version($androidVersion) {
    $base = (floatval($androidVersion) >= 10.0) ? 12.0 : 8.0;
    return 'EMUI ' . ($base + (floatval($androidVersion) - floor(floatval($androidVersion))));
}
