<?php
require_once 'function/function.php';

/**
 * Генерирует IMEI для устройств OnePlus
 */
function generate_oneplus_imei($tacPrefix) {
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
 * Генерирует серийный номер OnePlus устройства
 */
function generate_oneplus_serial($pattern) {
    if (strpos($pattern, '%') !== false) {
        return vsprintf($pattern, [mt_rand(0, 999999)]);
    }
    return $pattern . strtoupper(bin2hex(random_bytes(3)));
}

/**
 * Генерирует MAC-адрес для OnePlus устройств
 */
function generate_oneplus_mac($prefix) {
    $mac = $prefix;
    for ($i = 0; $i < 3; $i++) {
        $mac .= ':' . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }
    return $mac;
}

/**
 * Получает случайное устройство OnePlus из БД
 */
function get_random_oneplus_device() {
    $sql = "SELECT * FROM oneplus_devices WHERE is_current = 1 ORDER BY RAND() LIMIT 1";
    return select($sql);
}

/**
 * Генерирует номер сборки в формате OnePlus
 */
function generate_oneplus_build_number($androidVersion, $modelName) {
    $versionPrefix = 'OP';
    $regionCodes = ['CN', 'IN', 'EU', 'GLO'];
    $region = $regionCodes[array_rand($regionCodes)];

    $versionParts = explode('.', $androidVersion);
    $majorVersion = $versionParts[0];

    return sprintf("%s%s%s%02d%03d",
        $versionPrefix,
        $region,
        $majorVersion,
        date('y'),
        random_int(100, 999));
}

/**
 * Генерирует полные данные устройства OnePlus
 */
function generate_oneplus_device_data($modelName = null) {
    $device = $modelName
        ? select("SELECT * FROM oneplus_devices WHERE model_name = ?", [$modelName])
        : get_random_oneplus_device();

    if (!$device) {
        return ['error' => 'OnePlus device not found'];
    }

    return [
        'product_line' => $device['product_line'],
        'model_name' => $device['model_name'],
        'codename' => $device['codename'],
        'imei' => generate_oneplus_imei($device['tac_prefix']),
        'serial_number' => generate_oneplus_serial($device['serial_pattern']),
        'mac_address' => generate_oneplus_mac($device['mac_prefix']),
        'android_version' => get_random_android_version($device['android_min'], $device['android_max']),
        'security_patch' => $device['security_patch'],
        'ram' => get_random_option($device['ram_options']),
        'storage' => get_random_option($device['storage_options']),
        'screen' => $device['screen_size'] . '" ' . $device['resolution'] . ' ' . $device['refresh_rate'],
        'chipset' => $device['chipset'],
        'battery' => $device['battery_capacity'] . ' mAh',
        'warp_charge' => $device['warp_charge'],
        'release_date' => $device['release_date'],
        'is_5g' => (bool)$device['is_5g'],
        'build_number' => generate_oneplus_build_number($device['android_min'], $device['model_name']),
        'oxygenos_version' => 'OxygenOS ' . (floatval($device['android_min']) + 0.1)
    ];
}

/**
 * Дополнительная функция для генерации OxygenOS версии
 */
function generate_oxygenos_version($androidVersion) {
    $base = (float)$androidVersion;
    return 'OxygenOS ' . ($base + 0.1 + (mt_rand(0, 9) / 10));
}
