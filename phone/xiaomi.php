<?php
// Создание таблицы Xiaomi с дополненной структурой
$sql = "CREATE TABLE IF NOT EXISTS `xiaomi_devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_line` enum('Redmi','Xiaomi','POCO','Black Shark','Redmi Note','Xiaomi Mi Mix','Xiaomi Pad') NOT NULL,
  `model_name` varchar(50) NOT NULL,
  `codename` varchar(30) NOT NULL,
  `tac_prefix` varchar(8) NOT NULL COMMENT 'Первые 6 цифр IMEI',
  `serial_pattern` varchar(50) DEFAULT NULL,
  `mac_prefix` varchar(8) DEFAULT NULL,
  `android_min` varchar(10) DEFAULT NULL,
  `android_max` varchar(10) DEFAULT NULL,
  `screen_size` decimal(3,1) DEFAULT NULL,
  `resolution` varchar(15) DEFAULT NULL,
  `refresh_rate` varchar(10) DEFAULT NULL COMMENT 'Hz',
  `ram_options` varchar(50) DEFAULT NULL,
  `storage_options` varchar(50) DEFAULT NULL,
  `chipset` varchar(30) DEFAULT NULL,
  `battery_capacity` varchar(10) DEFAULT NULL COMMENT 'mAh',
  `fast_charge` varchar(20) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `is_5g` tinyint(1) DEFAULT 0,
  `is_current` tinyint(1) DEFAULT 0,
  `security_patch` date DEFAULT NULL,
  `fingerprint` varchar(150) DEFAULT NULL COMMENT 'Build fingerprint',
  `bootloader_version` varchar(50) DEFAULT NULL,
  `kernel_version` varchar(100) DEFAULT NULL,
  `build_tags` varchar(30) DEFAULT NULL COMMENT 'release-keys/test-keys',
  `bluetooth_version` varchar(10) DEFAULT NULL,
  `wifi_version` varchar(15) DEFAULT NULL,
  `api_level` smallint(4) DEFAULT NULL,
  `miui_version` varchar(20) DEFAULT NULL COMMENT 'Версия MIUI/HyperOS',
  `manufacturer` varchar(20) DEFAULT 'Xiaomi',
  PRIMARY KEY (`id`),
  UNIQUE KEY `model_name` (`model_name`),
  KEY `product_line` (`product_line`),
  KEY `release_date` (`release_date`),
  KEY `tac_prefix` (`tac_prefix`),
  KEY `mac_prefix` (`mac_prefix`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$result = create($sql);

// Заполнение таблицы устройствами Xiaomi с расширенными данными
$devices = [
    // Флагманские модели 2022-2023
    ['Xiaomi', 'Xiaomi 14 Pro', 'houji', '865466', 'XM14P%06d', '64:CC:32', '14.0', '18.0', 6.73, '3200x1440', '120Hz', '12GB,16GB', '256GB,512GB,1TB', 'Snapdragon 8 Gen 3', '4880', '120W', '2023-10-26', 1, 1, '2023-12-01', 'Xiaomi/houji/houji:14/UP1A.231005.007/houji-user:user/release-keys', 'houji-1.0-231005', '5.15.110-android14-11-g4b0e5d9e0d0b', 'release-keys', '5.3', 'Wi-Fi 7', 34, 'HyperOS 1.0', 'Xiaomi'],
    ['Xiaomi', 'Xiaomi 13 Ultra', 'ishtar', '865456', 'XM13U%06d', '64:CC:22', '13.0', '17.0', 6.73, '3200x1440', '120Hz', '12GB,16GB', '256GB,512GB,1TB', 'Snapdragon 8 Gen 2', '5000', '90W', '2023-04-18', 1, 1, '2023-12-01', 'Xiaomi/ishtar/ishtar:13/TQ1A.230405.003/ishtar-user:user/release-keys', 'ishtar-1.0-230405', '5.15.74-android13-9-g7c3737d8d2ab', 'release-keys', '5.3', 'Wi-Fi 6E', 33, 'MIUI 14', 'Xiaomi'],
    ['Xiaomi', 'Xiaomi 13 Pro', 'nuwa', '865457', 'XM13P%06d', '64:CC:23', '13.0', '17.0', 6.73, '3200x1440', '120Hz', '8GB,12GB', '128GB,256GB,512GB', 'Snapdragon 8 Gen 2', '4820', '120W', '2022-12-11', 1, 1, '2023-12-01', 'Xiaomi/nuwa/nuwa:13/TQ1A.230405.003/nuwa-user:user/release-keys', 'nuwa-1.0-230405', '5.15.74-android13-9-g7c3737d8d2ab', 'release-keys', '5.3', 'Wi-Fi 6E', 33, 'MIUI 14', 'Xiaomi'],

    // Redmi K/Note серия
    ['Redmi', 'Redmi K70 Pro', 'vermeer', '865467', 'RMK7P%06d', '64:CC:33', '14.0', '18.0', 6.67, '3200x1440', '120Hz', '12GB,16GB,24GB', '256GB,512GB,1TB', 'Snapdragon 8 Gen 3', '5000', '120W', '2023-11-29', 1, 1, '2023-12-01', 'Xiaomi/vermeer/vermeer:14/UP1A.231005.007/vermeer-user:user/release-keys', 'vermeer-1.0-231005', '5.15.110-android14-11-g4b0e5d9e0d0b', 'release-keys', '5.3', 'Wi-Fi 7', 34, 'HyperOS 1.0', 'Xiaomi'],
    ['Redmi Note', 'Redmi Note 13 Pro+', 'garnet', '865468', 'RN13P%06d', '64:CC:34', '13.0', '17.0', 6.67, '2712x1220', '120Hz', '8GB,12GB,16GB', '256GB,512GB', 'Dimensity 7200-Ultra', '5000', '120W', '2023-09-21', 1, 1, '2023-12-01', 'Xiaomi/garnet/garnet:13/TQ3A.230805.001/garnet-user:user/release-keys', 'garnet-1.0-230805', '5.15.74-android13-9-g7c3737d8d2ab', 'release-keys', '5.3', 'Wi-Fi 6', 33, 'MIUI 14', 'Xiaomi'],

    // POCO серия
    ['POCO', 'POCO X6 Pro', 'duchamp', '865469', 'POX6P%06d', '64:CC:35', '14.0', '18.0', 6.67, '2712x1220', '120Hz', '8GB,12GB', '256GB,512GB', 'Dimensity 8300-Ultra', '5000', '67W', '2024-01-11', 1, 1, '2024-01-01', 'Xiaomi/duchamp/duchamp:14/UP1A.231005.007/duchamp-user:user/release-keys', 'duchamp-1.0-231005', '5.15.110-android14-11-g4b0e5d9e0d0b', 'release-keys', '5.3', 'Wi-Fi 6', 34, 'HyperOS 1.0', 'Xiaomi'],
    ['POCO', 'POCO F5', 'marble', '865470', 'POF5%06d', '64:CC:36', '13.0', '17.0', 6.67, '2400x1080', '120Hz', '8GB,12GB', '128GB,256GB', 'Snapdragon 7+ Gen 2', '5000', '67W', '2023-05-09', 1, 1, '2023-12-01', 'Xiaomi/marble/marble:13/TQ3A.230805.001/marble-user:user/release-keys', 'marble-1.0-230805', '5.15.74-android13-9-g7c3737d8d2ab', 'release-keys', '5.2', 'Wi-Fi 6', 33, 'MIUI 14', 'Xiaomi'],

    // Складные устройства и планшеты
    ['Xiaomi Mi Mix', 'Xiaomi Mix Fold 3', 'babylon', '865465', 'XMMF3%06d', '64:CC:31', '13.0', '17.0', 8.03, '2160x1914', '120Hz', '12GB,16GB', '256GB,512GB,1TB', 'Snapdragon 8 Gen 2', '4800', '67W', '2023-08-14', 1, 1, '2023-12-01', 'Xiaomi/babylon/babylon:13/TQ3A.230805.001/babylon-user:user/release-keys', 'babylon-1.0-230805', '5.15.74-android13-9-g7c3737d8d2ab', 'release-keys', '5.3', 'Wi-Fi 6E', 33, 'MIUI Fold 14', 'Xiaomi'],
    ['Xiaomi Pad', 'Xiaomi Pad 6 Max', 'yudi', '865471', 'XMP6M%06d', '64:CC:37', '13.0', '17.0', 14.0, '2880x1800', '120Hz', '12GB,16GB', '256GB,512GB,1TB', 'Snapdragon 8+ Gen 1', '10000', '67W', '2023-08-14', 1, 1, '2023-12-01', 'Xiaomi/yudi/yudi:13/TQ3A.230805.001/yudi-user:user/release-keys', 'yudi-1.0-230805', '5.15.74-android13-9-g7c3737d8d2ab', 'release-keys', '5.3', 'Wi-Fi 6E', 33, 'MIUI Pad 14', 'Xiaomi'],

    // Игровые смартфоны
    ['Black Shark', 'Black Shark 6 Pro', 'kalama', '865472', 'BLS6P%06d', '64:CC:38', '13.0', '17.0', 6.67, '2400x1080', '144Hz', '12GB,16GB', '256GB,512GB', 'Snapdragon 8 Gen 2', '5000', '120W', '2023-04-04', 1, 1, '2023-12-01', 'BlackShark/kalama/kalama:13/TQ3A.230805.001/kalama-user:user/release-keys', 'kalama-1.0-230805', '5.15.74-android13-9-g7c3737d8d2ab', 'release-keys', '5.3', 'Wi-Fi 6E', 33, 'JoyUI 14', 'Black Shark'],

    // Старые модели (2019-2021)
    ['Xiaomi', 'Mi 11 Ultra', 'star', '865473', 'MI11U%06d', '64:CC:39', '11.0', '14.0', 6.81, '3200x1440', '120Hz', '8GB,12GB', '256GB,512GB', 'Snapdragon 888', '5000', '67W', '2021-03-29', 1, 0, '2023-08-01', 'Xiaomi/star/star:11/RKQ1.200826.002/21.9.15:user/release-keys', 'star-1.0-210915', '5.4.88-android11-9-g7c3737d8d2ab', 'release-keys', '5.2', 'Wi-Fi 6', 30, 'MIUI 12.5', 'Xiaomi'],
    ['Redmi Note', 'Redmi Note 10 Pro', 'sweet', '861345', 'RN10P%06d', 'A0:B2:C1', '11.0', '13.0', 6.67, '2400x1080', '120Hz', '6GB,8GB', '64GB,128GB', 'Snapdragon 732G', '5020', '33W', '2021-03-04', 0, 0, '2023-12-01', 'Redmi/sweet/sweet:11/RP1A.200720.011/sweet-user:user/release-keys', 'sweet-1.0-200720', '4.19.157-android11-7-g7c3737d8d2ab', 'release-keys', '5.1', 'Wi-Fi 5', 30, 'MIUI 12.5', 'Redmi'],
    ['POCO', 'POCO F3', 'alioth', '865474', 'POF3%06d', '64:CC:40', '11.0', '14.0', 6.67, '2400x1080', '120Hz', '6GB,8GB', '128GB,256GB', 'Snapdragon 870', '4520', '33W', '2021-03-22', 1, 0, '2023-08-01', 'POCO/alioth/alioth:11/RKQ1.200826.002/21.9.15:user/release-keys', 'alioth-1.0-210915', '5.4.88-android11-9-g7c3737d8d2ab', 'release-keys', '5.2', 'Wi-Fi 6', 30, 'MIUI 12.5', 'POCO'],

    // Бюджетные модели
    ['Redmi', 'Redmi 12', 'sky', '865475', 'RM12%06d', '64:CC:41', '13.0', '17.0', 6.79, '2460x1080', '90Hz', '4GB,6GB,8GB', '128GB,256GB', 'Helio G88', '5000', '18W', '2023-06-15', 0, 1, '2023-12-01', 'Redmi/sky/sky:13/TQ3A.230805.001/sky-user:user/release-keys', 'sky-1.0-230805', '5.15.74-android13-9-g7c3737d8d2ab', 'release-keys', '5.2', 'Wi-Fi 5', 33, 'MIUI 14', 'Redmi'],
    ['Redmi', 'Redmi A2', 'water', '865476', 'RMA2%06d', '64:CC:42', '12.0', '14.0', 6.52, '1600x720', '60Hz', '2GB,3GB,4GB', '32GB,64GB', 'Helio G36', '5000', '10W', '2023-05-19', 0, 1, '2023-12-01', 'Redmi/water/water:12/SP1A.210812.016/water-user:user/release-keys', 'water-1.0-210812', '5.10.66-android12-9-g7c3737d8d2ab', 'release-keys', '5.0', 'Wi-Fi 4', 31, 'MIUI Go', 'Redmi']
];

foreach ($devices as $device) {
    $sql = "INSERT INTO `xiaomi_devices` 
        (`product_line`, `model_name`, `codename`, `tac_prefix`, `serial_pattern`, 
         `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, `refresh_rate`, 
         `ram_options`, `storage_options`, `chipset`, `battery_capacity`, `fast_charge`, 
         `release_date`, `is_5g`, `is_current`, `security_patch`, `fingerprint`, `bootloader_version`,
         `kernel_version`, `build_tags`, `bluetooth_version`, `wifi_version`, `api_level`, `miui_version`, `manufacturer`) 
        VALUES 
        ('{$device[0]}', '{$device[1]}', '{$device[2]}', '{$device[3]}', '{$device[4]}', 
         '{$device[5]}', '{$device[6]}', '{$device[7]}', {$device[8]}, '{$device[9]}', '{$device[10]}', 
         '{$device[11]}', '{$device[12]}', '{$device[13]}', '{$device[14]}', '{$device[15]}', 
         '{$device[16]}', {$device[17]}, {$device[18]}, '{$device[19]}', '{$device[20]}', '{$device[21]}',
         '{$device[22]}', '{$device[23]}', '{$device[24]}', '{$device[25]}', {$device[26]}, '{$device[27]}', '{$device[28]}')";

    $result = insert($sql);
}