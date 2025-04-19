<?php
// Создание таблицы OPPO с дополненной структурой
$sql = "CREATE TABLE IF NOT EXISTS `oppo_devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_line` enum('Find X','Reno','A','K','F','Find N','Pad') NOT NULL,
  `model_name` varchar(50) NOT NULL,
  `codename` varchar(30) NOT NULL,
  `tac_prefix` varchar(8) NOT NULL COMMENT 'Первые 6 цифр IMEI',
  `serial_pattern` varchar(50) DEFAULT NULL,
  `mac_prefix` varchar(8) DEFAULT NULL,
  `android_min` varchar(10) DEFAULT NULL,
  `android_max` varchar(10) DEFAULT NULL,
  `screen_size` decimal(3,1) DEFAULT NULL,
  `resolution` varchar(15) DEFAULT NULL,
  `refresh_rate` varchar(10) DEFAULT '90Hz',
  `ram_options` varchar(50) DEFAULT NULL,
  `storage_options` varchar(50) DEFAULT NULL,
  `chipset` varchar(30) DEFAULT NULL,
  `battery_capacity` varchar(10) DEFAULT NULL,
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
  `coloros_version` varchar(20) DEFAULT NULL COMMENT 'Версия ColorOS',
  `manufacturer` varchar(20) DEFAULT 'OPPO',
  PRIMARY KEY (`id`),
  UNIQUE KEY `model_name` (`model_name`),
  KEY `product_line` (`product_line`),
  KEY `release_date` (`release_date`),
  KEY `tac_prefix` (`tac_prefix`),
  KEY `mac_prefix` (`mac_prefix`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$result = create($sql);

// Заполнение таблицы устройствами OPPO с расширенными данными
$devices = [
    // Флагманские модели 2022-2023
    ['Find X', 'Find X6 Pro', 'PGEM10', '861000', 'OPX6P%06d', 'D4:6A:6A', '13.0', '17.0', 6.8, '3168x1440', '120Hz', '12GB,16GB', '256GB,512GB', 'Snapdragon 8 Gen 2', '5000', '100W', '2023-03-21', 1, 1, '2023-12-01', 'OPPO/PGEM10/OP594BL1:13/SKQ1.221119.001/1678874567:user/release-keys', 'PGEM10_11_A.08', '5.10.101-android13-8-g9c3737d8d2ab', 'release-keys', '5.3', 'Wi-Fi 6E', 33, 'ColorOS 13.1', 'OPPO'],
    ['Reno', 'Reno 10 Pro+', 'PHU110', '861001', 'OPR10P%06d', 'D4:6A:6B', '13.0', '17.0', 6.7, '2772x1240', '120Hz', '12GB,16GB', '256GB,512GB', 'Snapdragon 8+ Gen 1', '4700', '100W', '2023-07-08', 1, 1, '2023-12-01', 'OPPO/PHU110/OP516BL1:13/SKQ1.221119.001/1678874566:user/release-keys', 'PHU110_11_A.07', '5.10.101-android13-8-g9c3737d8d2ab', 'release-keys', '5.2', 'Wi-Fi 6E', 33, 'ColorOS 13.1', 'OPPO'],
    ['Find X', 'Find X5 Pro', 'PFEM10', '861002', 'OPX5P%06d', 'D4:6A:6C', '12.0', '16.0', 6.7, '3216x1440', '120Hz', '8GB,12GB', '256GB,512GB', 'Snapdragon 8 Gen 1', '5000', '80W', '2022-02-24', 1, 1, '2023-12-01', 'OPPO/PFEM10/OP516BL1:12/SKQ1.211113.001/1658765432:user/release-keys', 'PFEM10_11_A.12', '5.10.81-android12-9-g7c3737d8d2ab', 'release-keys', '5.2', 'Wi-Fi 6E', 31, 'ColorOS 13', 'OPPO'],

    // Reno серия
    ['Reno', 'Reno 8 Pro', 'PFDM00', '861003', 'OPR8P%06d', 'D4:6A:6D', '12.0', '16.0', 6.7, '2412x1080', '120Hz', '8GB,12GB', '128GB,256GB', 'Dimensity 8100', '4500', '80W', '2022-05-23', 1, 1, '2023-12-01', 'OPPO/PFDM00/OP514BL1:12/SKQ1.211113.001/1658765431:user/release-keys', 'PFDM00_11_A.10', '5.10.81-android12-9-g7c3737d8d2ab', 'release-keys', '5.2', 'Wi-Fi 6', 31, 'ColorOS 13', 'OPPO'],
    ['Reno', 'Reno 6 Pro+', 'PEPM00', '861006', 'OPR6P%06d', 'D4:6A:70', '11.0', '14.0', 6.5, '2400x1080', '90Hz', '8GB,12GB', '128GB,256GB', 'Snapdragon 870', '4500', '65W', '2021-07-05', 1, 0, '2023-08-01', 'OPPO/PEPM00/OP516BL1:11/RKQ1.201105.002/1634567890:user/release-keys', 'PEPM00_11_C.62', '5.4.88-android11-7-g7c3737d8d2ab', 'release-keys', '5.1', 'Wi-Fi 6', 30, 'ColorOS 12', 'OPPO'],

    // Бюджетные модели
    ['A', 'A98 5G', 'PHJ110', '861004', 'OPA98%06d', 'D4:6A:6E', '13.0', '17.0', 6.7, '2400x1080', '120Hz', '8GB,12GB', '128GB,256GB', 'Snapdragon 695', '5000', '67W', '2023-04-14', 1, 1, '2023-12-01', 'OPPO/PHJ110/OP594BL1:13/SKQ1.221119.001/1678874565:user/release-keys', 'PHJ110_11_A.06', '5.10.101-android13-8-g9c3737d8d2ab', 'release-keys', '5.1', 'Wi-Fi 5', 33, 'ColorOS 13.1', 'OPPO'],
    ['K', 'K10 5G', 'PGZ110', '861007', 'OPK10%06d', 'D4:6A:71', '12.0', '16.0', 6.6, '2412x1080', '120Hz', '6GB,8GB,12GB', '128GB,256GB', 'Dimensity 8000', '5000', '67W', '2022-04-24', 1, 1, '2023-12-01', 'OPPO/PGZ110/OP514BL1:12/SKQ1.211113.001/1658765430:user/release-keys', 'PGZ110_11_A.05', '5.10.81-android12-9-g7c3737d8d2ab', 'release-keys', '5.1', 'Wi-Fi 5', 31, 'ColorOS 13', 'OPPO'],

    // Складные устройства
    ['Find N', 'Find N2 Flip', 'PGU110', '861008', 'OPNF%06d', 'D4:6A:72', '13.0', '17.0', 6.8, '2520x1080', '120Hz', '8GB,16GB', '256GB,512GB', 'Dimensity 9000+', '4300', '44W', '2022-12-15', 1, 1, '2023-12-01', 'OPPO/PGU110/OP594BL1:13/SKQ1.221119.001/1678874564:user/release-keys', 'PGU110_11_A.04', '5.10.101-android13-8-g9c3737d8d2ab', 'release-keys', '5.2', 'Wi-Fi 6', 33, 'ColorOS 13.1', 'OPPO'],
    ['Find N', 'Find N', 'PEUM00', '861015', 'OPN%06d', 'D4:6A:79', '11.0', '14.0', 7.1, '1792x1920', '120Hz', '8GB,12GB', '256GB,512GB', 'Snapdragon 888', '4500', '33W', '2021-12-15', 1, 0, '2023-08-01', 'OPPO/PEUM00/OP516BL1:11/RKQ1.201105.002/1634567891:user/release-keys', 'PEUM00_11_C.63', '5.4.88-android11-7-g7c3737d8d2ab', 'release-keys', '5.1', 'Wi-Fi 6', 30, 'ColorOS 12', 'OPPO'],

    // Планшеты
    ['Pad', 'Pad 2', 'OPD2202', '861014', 'OPP2%06d', 'D4:6A:78', '13.0', '17.0', 11.6, '2800x2000', '144Hz', '8GB,12GB', '128GB,256GB,512GB', 'Dimensity 9000', '9510', '67W', '2023-07-01', 1, 1, '2023-12-01', 'OPPO/OPD2202/OP594BL1:13/SKQ1.221119.001/1678874563:user/release-keys', 'OPD2202_11_A.03', '5.10.101-android13-8-g9c3737d8d2ab', 'release-keys', '5.2', 'Wi-Fi 6', 33, 'ColorOS 13.1', 'OPPO'],

    // Старые модели (2019-2021)
    ['Find X', 'Find X3 Pro', 'CPH2173', '861005', 'OPX3P%06d', 'D4:6A:6F', '11.0', '14.0', 6.7, '3216x1440', '120Hz', '8GB,12GB', '256GB,512GB', 'Snapdragon 888', '4500', '65W', '2021-03-11', 1, 0, '2023-08-01', 'OPPO/CPH2173/OP516BL1:11/RKQ1.201105.002/1634567892:user/release-keys', 'CPH2173_11_C.64', '5.4.88-android11-7-g7c3737d8d2ab', 'release-keys', '5.1', 'Wi-Fi 6', 30, 'ColorOS 12', 'OPPO'],
    ['Reno', 'Reno 5 5G', 'PDSM00', '861009', 'OPR5%06d', 'D4:6A:73', '11.0', '14.0', 6.4, '2400x1080', '90Hz', '8GB,12GB', '128GB,256GB', 'Snapdragon 765G', '4300', '65W', '2020-12-10', 1, 0, '2023-06-01', 'OPPO/PDSM00/OP516BL1:11/RKQ1.201105.002/1634567893:user/release-keys', 'PDSM00_11_C.65', '5.4.88-android11-7-g7c3737d8d2ab', 'release-keys', '5.0', 'Wi-Fi 5', 30, 'ColorOS 12', 'OPPO'],
    ['Find X', 'Find X2 Pro', 'CPH2025', '861012', 'OPX2P%06d', 'D4:6A:76', '10.0', '13.0', 6.7, '3168x1440', '120Hz', '8GB,12GB', '256GB,512GB', 'Snapdragon 865', '4260', '65W', '2020-03-06', 1, 0, '2023-04-01', 'OPPO/CPH2025/OP516BL1:10/QKQ1.191222.002/1578765432:user/release-keys', 'CPH2025_11_H.38', '4.19.157-android10-7-g7c3737d8d2ab', 'release-keys', '5.0', 'Wi-Fi 6', 29, 'ColorOS 12', 'OPPO']
];

foreach ($devices as $device) {
    $sql = "INSERT INTO `oppo_devices` 
        (`product_line`, `model_name`, `codename`, `tac_prefix`, `serial_pattern`, 
         `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, `refresh_rate`, 
         `ram_options`, `storage_options`, `chipset`, `battery_capacity`, `fast_charge`, 
         `release_date`, `is_5g`, `is_current`, `security_patch`, `fingerprint`, `bootloader_version`,
         `kernel_version`, `build_tags`, `bluetooth_version`, `wifi_version`, `api_level`, `coloros_version`, `manufacturer`) 
        VALUES 
        ('{$device[0]}', '{$device[1]}', '{$device[2]}', '{$device[3]}', '{$device[4]}', 
         '{$device[5]}', '{$device[6]}', '{$device[7]}', {$device[8]}, '{$device[9]}', '{$device[10]}', 
         '{$device[11]}', '{$device[12]}', '{$device[13]}', '{$device[14]}', '{$device[15]}', 
         '{$device[16]}', {$device[17]}, {$device[18]}, '{$device[19]}', '{$device[20]}', '{$device[21]}',
         '{$device[22]}', '{$device[23]}', '{$device[24]}', '{$device[25]}', {$device[26]}, '{$device[27]}', '{$device[28]}')";

    $result = insert($sql);
}