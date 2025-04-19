<?php
// Создание таблицы OnePlus с дополненной структурой
$sql = "CREATE TABLE IF NOT EXISTS `oneplus_devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_line` enum('OnePlus','Nord','Ace','R','T','X','CE') NOT NULL,
  `model_name` varchar(50) NOT NULL,
  `codename` varchar(30) NOT NULL,
  `tac_prefix` varchar(8) NOT NULL COMMENT 'Первые 6 цифр IMEI',
  `serial_pattern` varchar(50) DEFAULT NULL,
  `mac_prefix` varchar(8) DEFAULT NULL,
  `android_min` varchar(10) DEFAULT NULL,
  `android_max` varchar(10) DEFAULT NULL,
  `screen_size` decimal(3,1) DEFAULT NULL,
  `resolution` varchar(15) DEFAULT NULL,
  `ram_options` varchar(30) DEFAULT NULL,
  `storage_options` varchar(30) DEFAULT NULL,
  `chipset` varchar(30) DEFAULT NULL,
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
  `oxygenos_version` varchar(20) DEFAULT NULL COMMENT 'Версия OxygenOS',
  `manufacturer` varchar(20) DEFAULT 'OnePlus',
  PRIMARY KEY (`id`),
  UNIQUE KEY `model_name` (`model_name`),
  KEY `product_line` (`product_line`),
  KEY `release_date` (`release_date`),
  KEY `tac_prefix` (`tac_prefix`),
  KEY `mac_prefix` (`mac_prefix`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$result = create($sql);

// Заполнение таблицы устройствами OnePlus с расширенными данными
$devices = [
    // Флагманские модели 2022-2023
    ['OnePlus', 'OnePlus 11 5G', 'CPH2447', '861234', 'OP%04d%04d', 'AC:5B:EA', '13.0', '15.0', 6.7, '3216x1440', '8GB,16GB', '128GB,256GB,512GB', 'Snapdragon 8 Gen 2', '2023-01-04', 1, 1, '2023-12-01', 'OnePlus/CPH2447/OP594BL1:13/SKQ1.221119.001/1678874567:user/release-keys', 'CPH2447_11_A.08', '5.10.101-android13-8-g9c3737d8d2ab', 'release-keys', '5.3', 'Wi-Fi 6E', 33, 'OxygenOS 13.1', 'OnePlus'],
    ['OnePlus', 'OnePlus 10 Pro 5G', 'NE2213', '861235', 'OP%04d%04d', 'AC:5B:EB', '12.0', '14.0', 6.7, '3216x1440', '8GB,12GB', '128GB,256GB,512GB', 'Snapdragon 8 Gen 1', '2022-01-11', 1, 1, '2023-12-01', 'OnePlus/NE2213/OP516BL1:12/SKQ1.211113.001/1658765432:user/release-keys', 'NE2213_11_A.12', '5.10.81-android12-9-g7c3737d8d2ab', 'release-keys', '5.2', 'Wi-Fi 6E', 31, 'OxygenOS 13', 'OnePlus'],
    ['OnePlus', 'OnePlus 10T 5G', 'CPH2417', '861249', 'OP%04d%04d', 'AC:5C:AD', '12.0', '14.0', 6.7, '2412x1080', '8GB,12GB,16GB', '128GB,256GB', 'Snapdragon 8+ Gen 1', '2022-08-03', 1, 1, '2023-12-01', 'OnePlus/CPH2417/OP514BL1:12/SKQ1.211113.001/1658765431:user/release-keys', 'CPH2417_11_A.10', '5.10.81-android12-9-g7c3737d8d2ab', 'release-keys', '5.2', 'Wi-Fi 6', 31, 'OxygenOS 13', 'OnePlus'],

    // Nord серия
    ['Nord', 'OnePlus Nord 3 5G', 'CPH2491', '861240', 'OP%04d%04d', 'AC:5B:FA', '13.0', '15.0', 6.7, '2412x1080', '8GB,16GB', '128GB,256GB', 'Dimensity 9000', '2023-07-05', 1, 1, '2023-12-01', 'OnePlus/CPH2491/OP594BL1:13/SKQ1.221119.001/1678874566:user/release-keys', 'CPH2491_11_A.07', '5.10.101-android13-8-g9c3737d8d2ab', 'release-keys', '5.2', 'Wi-Fi 6', 33, 'OxygenOS 13.1', 'OnePlus'],
    ['Nord', 'OnePlus Nord CE 3 5G', 'CPH2569', '861241', 'OP%04d%04d', 'AC:5B:FB', '13.0', '15.0', 6.7, '2412x1080', '8GB,12GB', '128GB,256GB', 'Snapdragon 782G', '2023-08-15', 1, 1, '2023-12-01', 'OnePlus/CPH2569/OP594BL1:13/SKQ1.221119.001/1678874565:user/release-keys', 'CPH2569_11_A.06', '5.10.101-android13-8-g9c3737d8d2ab', 'release-keys', '5.2', 'Wi-Fi 6', 33, 'OxygenOS 13.1', 'OnePlus'],

    // Старые флагманы
    ['OnePlus', 'OnePlus 9 Pro', 'LE2123', '861236', 'OP%04d%04d', 'AC:5B:EC', '11.0', '13.0', 6.7, '3216x1440', '8GB,12GB', '128GB,256GB', 'Snapdragon 888', '2021-03-23', 1, 0, '2023-08-01', 'OnePlus/LE2123/OP516BL1:11/RKQ1.201105.002/1634567890:user/release-keys', 'LE2123_11_C.62', '5.4.88-android11-7-g7c3737d8d2ab', 'release-keys', '5.1', 'Wi-Fi 6', 30, 'OxygenOS 12', 'OnePlus'],
    ['OnePlus', 'OnePlus 8 Pro', 'IN2023', '861238', 'OP%04d%04d', 'AC:5B:EE', '10.0', '12.0', 6.8, '3168x1440', '8GB,12GB', '128GB,256GB', 'Snapdragon 865', '2020-04-14', 1, 0, '2023-06-01', 'OnePlus/IN2023/OP516BL1:10/QKQ1.191222.002/1578765432:user/release-keys', 'IN2023_11_H.38', '4.19.157-android10-7-g7c3737d8d2ab', 'release-keys', '5.0', 'Wi-Fi 6', 29, 'OxygenOS 12', 'OnePlus'],

    // Бюджетные модели
    ['Nord', 'OnePlus Nord N30 5G', 'CPH2515', '861245', 'OP%04d%04d', 'AC:5B:FF', '13.0', '15.0', 6.7, '2400x1080', '8GB', '128GB', 'Snapdragon 695', '2023-06-28', 1, 1, '2023-12-01', 'OnePlus/CPH2515/OP594BL1:13/SKQ1.221119.001/1678874564:user/release-keys', 'CPH2515_11_A.05', '5.10.101-android13-8-g9c3737d8d2ab', 'release-keys', '5.1', 'Wi-Fi 5', 33, 'OxygenOS 13.1', 'OnePlus'],
    ['Nord', 'OnePlus Nord CE 3 Lite 5G', 'CPH2465', '861251', 'OP%04d%04d', 'AC:5C:AF', '13.0', '15.0', 6.7, '2400x1080', '8GB', '128GB,256GB', 'Snapdragon 695', '2023-04-04', 1, 1, '2023-12-01', 'OnePlus/CPH2465/OP594BL1:13/SKQ1.221119.001/1678874563:user/release-keys', 'CPH2465_11_A.04', '5.10.101-android13-8-g9c3737d8d2ab', 'release-keys', '5.1', 'Wi-Fi 5', 33, 'OxygenOS 13.1', 'OnePlus'],

    // Ace серия
    ['Ace', 'OnePlus Ace 2V', 'PHP110', '861246', 'OP%04d%04d', 'AC:5C:AA', '13.0', '15.0', 6.7, '2772x1240', '12GB,16GB', '256GB,512GB', 'Dimensity 9000', '2023-03-07', 1, 1, '2023-12-01', 'OnePlus/PHP110/OP594BL1:13/SKQ1.221119.001/1678874562:user/release-keys', 'PHP110_11_A.03', '5.10.101-android13-8-g9c3737d8d2ab', 'release-keys', '5.2', 'Wi-Fi 6', 33, 'OxygenOS 13.1', 'OnePlus'],
    ['Ace', 'OnePlus Ace 2', 'PHK110', '861247', 'OP%04d%04d', 'AC:5C:AB', '13.0', '15.0', 6.7, '2772x1240', '12GB,16GB', '256GB,512GB', 'Snapdragon 8+ Gen 1', '2023-02-07', 1, 1, '2023-12-01', 'OnePlus/PHK110/OP594BL1:13/SKQ1.221119.001/1678874561:user/release-keys', 'PHK110_11_A.02', '5.10.101-android13-8-g9c3737d8d2ab', 'release-keys', '5.2', 'Wi-Fi 6', 33, 'OxygenOS 13.1', 'OnePlus'],

    // Старые модели (2017-2019)
    ['OnePlus', 'OnePlus 7 Pro', 'GM1917', '861253', 'OP%04d%04d', 'AC:5C:BB', '9.0', '12.0', 6.7, '3120x1440', '6GB,8GB,12GB', '128GB,256GB', 'Snapdragon 855', '2019-05-14', 0, 0, '2023-06-01', 'OnePlus/GM1917/OP516BL1:9/PKQ1.190322.001/1548765432:user/release-keys', 'GM1917_11_F.16', '4.14.117-android9-7-g7c3737d8d2ab', 'release-keys', '5.0', 'Wi-Fi 5', 28, 'OxygenOS 12', 'OnePlus'],
    ['OnePlus', 'OnePlus 6T', 'A6013', '861257', 'OP%04d%04d', 'AC:5C:BF', '9.0', '11.0', 6.4, '2340x1080', '6GB,8GB', '128GB,256GB', 'Snapdragon 845', '2018-11-01', 0, 0, '2021-08-01', 'OnePlus/A6013/OP516BL1:9/PKQ1.180716.001/1534567890:user/release-keys', 'A6013_11_F.12', '4.9.186-android9-7-g7c3737d8d2ab', 'release-keys', '5.0', 'Wi-Fi 5', 28, 'OxygenOS 11', 'OnePlus'],
    ['OnePlus', 'OnePlus 5T', 'A5010', '861259', 'OP%04d%04d', 'AC:5D:AB', '7.1', '10.0', 6.0, '2160x1080', '6GB,8GB', '64GB,128GB', 'Snapdragon 835', '2017-11-21', 0, 0, '2020-12-01', 'OnePlus/A5010/OP516BL1:7/N2G47H/1508765432:user/release-keys', 'A5010_11_H.08', '4.4.78-android7-7-g7c3737d8d2ab', 'release-keys', '4.2', 'Wi-Fi 5', 25, 'OxygenOS 10', 'OnePlus']
];

foreach ($devices as $device) {
    $sql = "INSERT INTO `oneplus_devices` 
        (`product_line`, `model_name`, `codename`, `tac_prefix`, `serial_pattern`, 
         `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, 
         `ram_options`, `storage_options`, `chipset`, `release_date`, 
         `is_5g`, `is_current`, `security_patch`, `fingerprint`, `bootloader_version`,
         `kernel_version`, `build_tags`, `bluetooth_version`, `wifi_version`, `api_level`, `oxygenos_version`, `manufacturer`) 
        VALUES 
        ('{$device[0]}', '{$device[1]}', '{$device[2]}', '{$device[3]}', '{$device[4]}', 
         '{$device[5]}', '{$device[6]}', '{$device[7]}', {$device[8]}, '{$device[9]}', 
         '{$device[10]}', '{$device[11]}', '{$device[12]}', '{$device[13]}', 
         {$device[14]}, {$device[15]}, '{$device[16]}', '{$device[17]}', '{$device[18]}',
         '{$device[19]}', '{$device[20]}', '{$device[21]}', '{$device[22]}', {$device[23]}, '{$device[24]}', '{$device[25]}')";

    $result = insert($sql);
}