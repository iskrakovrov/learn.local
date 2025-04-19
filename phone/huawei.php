<?php
// Создание таблицы Huawei с дополненной структурой
$sql = "CREATE TABLE IF NOT EXISTS `huawei_devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_line` enum('P','Mate','Nova','Y','Enjoy','Mate X','P Smart','P Lite','P Pro','MatePad','MediaPad','Other') NOT NULL,
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
  `emui_version` varchar(20) DEFAULT NULL COMMENT 'Версия EMUI/HarmonyOS',
  `manufacturer` varchar(20) DEFAULT 'Huawei',
  PRIMARY KEY (`id`),
  UNIQUE KEY `model_name` (`model_name`),
  KEY `product_line` (`product_line`),
  KEY `release_date` (`release_date`),
  KEY `tac_prefix` (`tac_prefix`),
  KEY `mac_prefix` (`mac_prefix`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$result = create($sql);

// Заполнение таблицы устройствами Huawei с расширенными данными
$devices = [
    // Флагманские модели
    ['Mate', 'Mate 60 Pro+', 'ALN-AL10', '861170', 'HUAWEI%04d%04d', 'AC:12:22', '12.0', '14.0', 6.8, '2720x1260', '12GB,16GB', '256GB,512GB,1TB', 'Kirin 9000S', '2023-08-29', 1, 1, '2023-12-01', 'HUAWEI/ALN-AL10/HWALN-H:12/HarmonyOS-4.0.0.168/CHN-C00:user/release-keys', 'ALN-AL10-1.0.0.168', '5.10.110-harmony-4.0', 'release-keys', '5.2', 'Wi-Fi 6', 31, 'HarmonyOS 4.0', 'Huawei'],
    ['P', 'P60 Art', 'MNA-AL00', '861171', 'HUAWEI%04d%04d', 'AC:12:23', '12.0', '14.0', 6.7, '2700x1220', '12GB', '512GB,1TB', 'Snapdragon 8+ Gen 1', '2023-03-31', 1, 1, '2023-12-01', 'HUAWEI/MNA-AL00/HWMNA-H:12/HarmonyOS-3.1.0.156/CHN-C00:user/release-keys', 'MNA-AL00-1.0.0.156', '5.10.110-harmony-3.1', 'release-keys', '5.2', 'Wi-Fi 6', 31, 'HarmonyOS 3.1', 'Huawei'],

    // Ваши текущие устройства
    ['Mate', 'Mate 50 Pro', 'DCO-LX9', '861151', 'HUAWEI%04d%04d', 'AC:12:03', '12.0', '14.0', 6.7, '2616x1212', '8GB,12GB', '128GB,256GB,512GB', 'Snapdragon 8+ Gen 1', '2022-09-28', 1, 1, '2023-12-01', 'HUAWEI/DCO-LX9/HWDCO-H:12/HarmonyOS-3.0.0.205/C00E205R6P5:user/release-keys', 'DCO-LX9-1.0.0.205', '5.10.110-harmony-3.0', 'release-keys', '5.2', 'Wi-Fi 6', 31, 'HarmonyOS 3.0', 'Huawei'],
    ['P', 'P60 Pro', 'LNA-LX9', '861152', 'HUAWEI%04d%04d', 'AC:12:04', '12.0', '14.0', 6.7, '2700x1220', '8GB,12GB', '256GB,512GB', 'Snapdragon 8+ Gen 1', '2023-03-31', 1, 1, '2023-12-01', 'HUAWEI/LNA-LX9/HWLNA-H:12/HarmonyOS-3.1.0.156/CHN-C00:user/release-keys', 'LNA-LX9-1.0.0.156', '5.10.110-harmony-3.1', 'release-keys', '5.2', 'Wi-Fi 6', 31, 'HarmonyOS 3.1', 'Huawei'],
    ['Mate', 'Mate X3', 'ALT-L29', '861153', 'HUAWEI%04d%04d', 'AC:12:05', '12.0', '14.0', 7.8, '2496x2224', '12GB', '256GB,512GB,1TB', 'Snapdragon 8+ Gen 1', '2023-04-26', 1, 1, '2023-12-01', 'HUAWEI/ALT-L29/HWALT-H:12/HarmonyOS-3.1.0.156/CHN-C00:user/release-keys', 'ALT-L29-1.0.0.156', '5.10.110-harmony-3.1', 'release-keys', '5.2', 'Wi-Fi 6', 31, 'HarmonyOS 3.1', 'Huawei'],

    // Старые модели
    ['P', 'P40 Pro+', 'ELS-N39', '861158', 'HUAWEI%04d%04d', 'AC:12:10', '10.0', '12.0', 6.6, '2640x1200', '8GB,12GB', '256GB,512GB', 'Kirin 990', '2020-04-07', 1, 0, '2023-06-01', 'HUAWEI/ELS-N39/HWELS-H:10/EMUI-12.0.0.300/C00E300R6P5:user/release-keys', 'ELS-N39-1.0.0.300', '4.19.116-emui-12.0', 'release-keys', '5.1', 'Wi-Fi 6', 29, 'EMUI 12.0', 'Huawei'],
    ['Mate', 'Mate 30 Pro', 'LIO-AL00', '861163', 'HUAWEI%04d%04d', 'AC:12:15', '10.0', '12.0', 6.5, '2400x1176', '8GB,12GB', '128GB,256GB', 'Kirin 990', '2019-09-19', 1, 0, '2023-06-01', 'HUAWEI/LIO-AL00/HWLIO-H:10/EMUI-12.0.0.300/C00E300R6P5:user/release-keys', 'LIO-AL00-1.0.0.300', '4.19.116-emui-12.0', 'release-keys', '5.1', 'Wi-Fi 5', 29, 'EMUI 12.0', 'Huawei'],
    ['P', 'P30 Pro', 'VOG-L29', '861164', 'HUAWEI%04d%04d', 'AC:12:16', '9.0', '12.0', 6.5, '2340x1080', '6GB,8GB', '128GB,256GB,512GB', 'Kirin 980', '2019-03-26', 0, 0, '2023-06-01', 'HUAWEI/VOG-L29/HWVOG-H:9/EMUI-12.0.0.300/C00E300R6P5:user/release-keys', 'VOG-L29-1.0.0.300', '4.14.116-emui-12.0', 'release-keys', '5.0', 'Wi-Fi 5', 28, 'EMUI 12.0', 'Huawei'],

    // Бюджетные модели
    ['Nova', 'Nova 12', 'BAC-AL00', '861172', 'HUAWEI%04d%04d', 'AC:12:24', '12.0', '14.0', 6.7, '2412x1084', '8GB,12GB', '128GB,256GB', 'Kirin 830', '2023-12-26', 1, 1, '2023-12-01', 'HUAWEI/BAC-AL00/HWBAC-H:12/HarmonyOS-4.0.0.168/CHN-C00:user/release-keys', 'BAC-AL00-1.0.0.168', '5.10.110-harmony-4.0', 'release-keys', '5.1', 'Wi-Fi 5', 31, 'HarmonyOS 4.0', 'Huawei'],
    ['Enjoy', 'Enjoy 60', 'CTR-AL20', '861173', 'HUAWEI%04d%04d', 'AC:12:25', '12.0', '14.0', 6.7, '1600x720', '6GB,8GB', '128GB,256GB', 'Kirin 710A', '2023-03-23', 0, 1, '2023-12-01', 'HUAWEI/CTR-AL20/HWCTR-H:12/HarmonyOS-3.0.0.156/CHN-C00:user/release-keys', 'CTR-AL20-1.0.0.156', '5.10.110-harmony-3.0', 'release-keys', '5.0', 'Wi-Fi 5', 31, 'HarmonyOS 3.0', 'Huawei'],

    // Планшеты
    ['MatePad', 'MatePad Pro 13.2', 'GOT-AL09', '861174', 'HUAWEI%04d%04d', 'AC:12:26', '13.0', '14.0', 13.2, '2880x1920', '12GB,16GB', '256GB,512GB,1TB', 'Kirin 9000S', '2023-09-25', 1, 1, '2023-12-01', 'HUAWEI/GOT-AL09/HWGOT-H:13/HarmonyOS-4.0.0.168/CHN-C00:user/release-keys', 'GOT-AL09-1.0.0.168', '5.10.110-harmony-4.0', 'release-keys', '5.2', 'Wi-Fi 6', 33, 'HarmonyOS 4.0', 'Huawei'],
    ['MediaPad', 'MediaPad T5', 'AGS2-L09', '861175', 'HUAWEI%04d%04d', 'AC:12:27', '8.0', '10.0', 10.1, '1920x1200', '3GB,4GB', '32GB,64GB', 'Kirin 659', '2018-07-18', 0, 0, '2023-06-01', 'HUAWEI/AGS2-L09/HWAGS2-H:8/EMUI-8.0.0.300/C00E300R6P5:user/release-keys', 'AGS2-L09-1.0.0.300', '4.4.116-emui-8.0', 'release-keys', '4.2', 'Wi-Fi 4', 26, 'EMUI 8.0', 'Huawei']
];

foreach ($devices as $device) {
    $sql = "INSERT INTO `huawei_devices` 
        (`product_line`, `model_name`, `codename`, `tac_prefix`, `serial_pattern`, 
         `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, 
         `ram_options`, `storage_options`, `chipset`, `release_date`, 
         `is_5g`, `is_current`, `security_patch`, `fingerprint`, `bootloader_version`,
         `kernel_version`, `build_tags`, `bluetooth_version`, `wifi_version`, `api_level`, `emui_version`, `manufacturer`) 
        VALUES 
        ('{$device[0]}', '{$device[1]}', '{$device[2]}', '{$device[3]}', '{$device[4]}', 
         '{$device[5]}', '{$device[6]}', '{$device[7]}', {$device[8]}, '{$device[9]}', 
         '{$device[10]}', '{$device[11]}', '{$device[12]}', '{$device[13]}', 
         {$device[14]}, {$device[15]}, '{$device[16]}', '{$device[17]}', '{$device[18]}',
         '{$device[19]}', '{$device[20]}', '{$device[21]}', '{$device[22]}', {$device[23]}, '{$device[24]}', '{$device[25]}')";

    $result = insert($sql);
}