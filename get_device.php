<?php
header('Content-Type: application/json');
require_once('inc/db.php');
require_once('function/function.php');

function generateRandomHex($length = 2) {
    return bin2hex(random_bytes($length / 2));
}

function generateRandomNumbers($length) {
    return str_pad(mt_rand(0, pow(10, $length) - 1), $length, '0', STR_PAD_LEFT);
}

function generateSerial($pattern) {
    // Проверяем, что шаблон содержит корректный формат
    if (strpos($pattern, '%') === false) {
        throw new Exception("Некорректный шаблон серийного номера: $pattern");
    }
    return str_replace(
        ['%04d', '%06d'],
        [generateRandomNumbers(4), generateRandomNumbers(6)],
        $pattern
    );
}

function getRandomAndroidVersion($min, $max) {
    $versions = [
        '8.0' => '26',
        '9.0' => '28',
        '10.0' => '29',
        '11.0' => '30',
        '12.0' => '31',
        '13.0' => '33',
        '14.0' => '34'
    ];

    $selected = number_format(mt_rand($min * 10, $max * 10) / 10, 1);

    return [
        'version' => $selected,
        'sdk' => $versions[$selected] ?? '33'
    ];
}

try {
    $tables = ['samsung_devices', 'google_devices', 'huawei_devices', 'oppo_devices', 'xiaomi_devices', 'oneplus_devices'];
    $table = $tables[array_rand($tables)];
    $brand = ucfirst(explode('_', $table)[0]);

    $device = selectAll("SELECT * FROM $table ORDER BY RAND() LIMIT 1")[0];
    if (!$device) {
        throw new Exception("No devices found in the table $table");
    }

    // Генерация случайных идентификаторов
    $android_id = generateRandomHex(8);
    $imei = $device['tac_prefix'] . generateRandomNumbers(9);
    $serial_pattern = $device['serial_pattern'] ?? 'SN%06d';

    // Проверка и генерация серийного номера
    try {
        $serial = generateSerial($serial_pattern);
    } catch (Exception $e) {
        throw new Exception("Ошибка при генерации серийного номера: " . $e->getMessage());
    }

    $mac_prefix = $device['mac_prefix'] ?? 'A0:11:22';
    $mac = $mac_prefix . ':' . generateRandomHex() . ':' . generateRandomHex() . ':' . generateRandomHex();
    $android = getRandomAndroidVersion($device['android_min'], $device['android_max']);

    // Формируем массив данных
    $response = [
        'status' => 'success',
        'device_data' => [
            'brand' => $brand,
            'manufacturer' => $device['manufacturer'] ?? $brand,
            'model' => $device['model_name'] ?? 'Unknown Model',
            'codename' => $device['codename'] ?? 'Unknown Codename',
            'product_line' => $device['product_line'] ?? 'N/A',

            // Идентификаторы
            'android_id' => $android_id,
            'imei' => $imei,
            'serial_number' => $serial,
            'mac_address' => $mac,
            'build_fingerprint' => $device['fingerprint'] ?? 'Unknown Fingerprint',

            // Версии ПО
            'android_version' => $android['version'],
            'android_sdk' => $android['sdk'],
            'security_patch' => $device['security_patch'] ?? 'Unknown',
            'kernel_version' => $device['kernel_version'] ?? 'Unknown',
            'bootloader_version' => $device['bootloader_version'] ?? 'Unknown',

            // Аппаратные характеристики
            'chipset' => $device['chipset'] ?? 'Unknown',
            'gpu' => $device['gpu'] ?? 'Unknown',
            'ram_options' => $device['ram_options'] ?? 'Unknown',
            'storage_options' => $device['storage_options'] ?? 'Unknown',

            // Дисплей
            'screen_size' => $device['screen_size'] ?? 'Unknown',
            'resolution' => $device['resolution'] ?? 'Unknown',
            'refresh_rate' => $device['refresh_rate'] ?? '60Hz',

            // Особенности
            'is_5g' => (bool)($device['is_5g'] ?? false),
            'brand_specific' => [
                'oneui_version' => $device['oneui_version'] ?? null,
                'miui_version' => $device['miui_version'] ?? null,
                'emui_version' => $device['emui_version'] ?? null,
                'coloros_version' => $device['coloros_version'] ?? null
            ]
        ],
        'meta' => [
            'source_table' => $table,
            'generated_at' => date('Y-m-d H:i:s')
        ]
    ];

    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ], JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);
}
