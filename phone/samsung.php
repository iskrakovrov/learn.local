<?php
// Создание таблицы Samsung с дополненной структурой
$sql = "CREATE TABLE IF NOT EXISTS `samsung_devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_line` enum('Galaxy S','Galaxy Note','Galaxy Z','Galaxy A','Galaxy M','Galaxy F','Galaxy Tab','Other') NOT NULL,
  `model_name` varchar(50) NOT NULL,
  `codename` varchar(30) NOT NULL,
  `tac_prefix` varchar(8) NOT NULL COMMENT 'Первые 6 цифр IMEI',
  `serial_pattern` varchar(50) DEFAULT 'SM-%04d%04d',
  `mac_prefix` varchar(8) DEFAULT 'A0:11:22',
  `android_min` varchar(10) DEFAULT NULL,
  `android_max` varchar(10) DEFAULT NULL,
  `screen_size` decimal(3,1) DEFAULT NULL,
  `resolution` varchar(15) DEFAULT NULL,
  `refresh_rate` varchar(10) DEFAULT '120Hz',
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
  `oneui_version` varchar(20) DEFAULT NULL COMMENT 'Версия One UI',
  `manufacturer` varchar(20) DEFAULT 'Samsung',
  PRIMARY KEY (`id`),
  UNIQUE KEY `model_name` (`model_name`),
  KEY `product_line` (`product_line`),
  KEY `release_date` (`release_date`),
  KEY `tac_prefix` (`tac_prefix`),
  KEY `mac_prefix` (`mac_prefix`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$result = create($sql);

// Заполнение таблицы устройствами Samsung с расширенными данными
$devices = [
    // Флагманские модели 2022-2023
    ['Galaxy S', 'Galaxy S23 Ultra', 'S918', '352001', 'S23U-%04d%04d', 'A0:12:01', '13.0', '17.0', 6.8, '3088x1440', '120Hz', '8GB,12GB', '256GB,512GB,1TB', 'Snapdragon 8 Gen 2', '5000', '45W', '2023-02-01', 1, 1, '2023-12-01', 'samsung/s1sxew/s918:13/TP1A.220624.014/S918BXXU1AWBE:user/release-keys', 'S918BXXU1AWBE', '5.15.74-android13-9-g7c3737d8d2ab', 'release-keys', '5.3', 'Wi-Fi 6E', 33, 'One UI 5.1', 'Samsung'],
    ['Galaxy S', 'Galaxy S22 Ultra', 'S908', '352345', 'S22U-%04d%04d', 'A0:12:AA', '12.0', '16.0', 6.8, '3088x1440', '120Hz', '8GB,12GB', '128GB,256GB,512GB,1TB', 'Exynos 2200/Snapdragon 8 Gen 1', '5000', '45W', '2022-02-25', 1, 1, '2023-12-01', 'samsung/s1sxew/s908:12/SP1A.210812.016/S908BXXU2CVF7:user/release-keys', 'S908BXXU2CVF7', '5.10.66-android12-9-g7c3737d8d2ab', 'release-keys', '5.2', 'Wi-Fi 6E', 31, 'One UI 5.1', 'Samsung'],
    ['Galaxy S', 'Galaxy S21 Ultra', 'G998', '355678', 'S21U-%04d%04d', 'A0:13:AA', '11.0', '14.0', 6.8, '3200x1440', '120Hz', '12GB,16GB', '128GB,256GB,512GB', 'Exynos 2100/Snapdragon 888', '5000', '25W', '2021-01-29', 1, 0, '2023-08-01', 'samsung/o1s/g998:11/RP1A.200720.012/G998BXXU3DWB5:user/release-keys', 'G998BXXU3DWB5', '5.4.39-android11-9-g7c3737d8d2ab', 'release-keys', '5.1', 'Wi-Fi 6', 30, 'One UI 5.0', 'Samsung'],

    // Galaxy Z серия
    ['Galaxy Z', 'Galaxy Z Fold 5', 'F946', '352002', 'ZF5-%04d%04d', 'A0:31:01', '13.0', '17.0', 7.6, '2176x1812', '120Hz', '12GB', '256GB,512GB,1TB', 'Snapdragon 8 Gen 2', '4400', '25W', '2023-08-11', 1, 1, '2023-12-01', 'samsung/f2q/f946:13/TP1A.220624.014/F946BXXU1AWBE:user/release-keys', 'F946BXXU1AWBE', '5.15.74-android13-9-g7c3737d8d2ab', 'release-keys', '5.3', 'Wi-Fi 6E', 33, 'One UI 5.1.1', 'Samsung'],
    ['Galaxy Z', 'Galaxy Z Flip 5', 'F731', '352003', 'ZP5-%04d%04d', 'A0:31:02', '13.0', '17.0', 6.7, '2640x1080', '120Hz', '8GB', '256GB,512GB', 'Snapdragon 8 Gen 2', '3700', '25W', '2023-08-11', 1, 1, '2023-12-01', 'samsung/f2q/f731:13/TP1A.220624.014/F731BXXU1AWBE:user/release-keys', 'F731BXXU1AWBE', '5.15.74-android13-9-g7c3737d8d2ab', 'release-keys', '5.3', 'Wi-Fi 6E', 33, 'One UI 5.1.1', 'Samsung'],

    // Galaxy A серия
    ['Galaxy A', 'Galaxy A54 5G', 'A546', '352004', 'A54-%04d%04d', 'A0:41:01', '13.0', '17.0', 6.4, '2340x1080', '120Hz', '6GB,8GB', '128GB,256GB', 'Exynos 1380', '5000', '25W', '2023-03-15', 1, 1, '2023-12-01', 'samsung/a54x/a546:13/TP1A.220624.014/A546BXXU1AWBE:user/release-keys', 'A546BXXU1AWBE', '5.15.74-android13-9-g7c3737d8d2ab', 'release-keys', '5.2', 'Wi-Fi 6', 33, 'One UI 5.1', 'Samsung'],
    ['Galaxy A', 'Galaxy A34 5G', 'A346', '352005', 'A34-%04d%04d', 'A0:41:02', '13.0', '17.0', 6.6, '2340x1080', '120Hz', '6GB,8GB', '128GB,256GB', 'Dimensity 1080', '5000', '25W', '2023-03-15', 1, 1, '2023-12-01', 'samsung/a34x/a346:13/TP1A.220624.014/A346BXXU1AWBE:user/release-keys', 'A346BXXU1AWBE', '5.15.74-android13-9-g7c3737d8d2ab', 'release-keys', '5.2', 'Wi-Fi 6', 33, 'One UI 5.1', 'Samsung'],

    // Galaxy Tab серия
    ['Galaxy Tab', 'Galaxy Tab S9 Ultra', 'T938', '352006', 'TSU-%04d%04d', 'A0:61:01', '13.0', '17.0', 14.6, '2960x1848', '120Hz', '12GB,16GB', '256GB,512GB,1TB', 'Snapdragon 8 Gen 2', '11200', '45W', '2023-08-01', 1, 1, '2023-12-01', 'samsung/tab-s9/t938:13/TP1A.220624.014/T938BXXU1AWBE:user/release-keys', 'T938BXXU1AWBE', '5.15.74-android13-9-g7c3737d8d2ab', 'release-keys', '5.3', 'Wi-Fi 6E', 33, 'One UI 5.1', 'Samsung'],
    ['Galaxy Tab', 'Galaxy Tab S8+', 'T938', '357888', 'TS8P-%04d%04d', 'A0:61:AA', '12.0', '16.0', 12.4, '2800x1752', '120Hz', '8GB,12GB', '128GB,256GB,512GB', 'Snapdragon 8 Gen 1', '10090', '45W', '2022-02-09', 1, 1, '2023-12-01', 'samsung/tab-s8/t938:12/SP1A.210812.016/T938BXXU2CVF7:user/release-keys', 'T938BXXU2CVF7', '5.10.66-android12-9-g7c3737d8d2ab', 'release-keys', '5.2', 'Wi-Fi 6E', 31, 'One UI 5.1', 'Samsung'],

    // Старые модели (2018-2020)
    ['Galaxy Note', 'Galaxy Note 20 Ultra', 'N986', '357890', 'N20U-%04d%04d', 'A0:21:AA', '10.0', '13.0', 6.9, '3088x1440', '120Hz', '12GB', '128GB,256GB,512GB', 'Exynos 990/Snapdragon 865+', '4500', '25W', '2020-08-21', 1, 0, '2023-08-01', 'samsung/c1s/n986:10/QP1A.190711.020/N986BXXU3EVB5:user/release-keys', 'N986BXXU3EVB5', '4.19.113-android10-9-g7c3737d8d2ab', 'release-keys', '5.0', 'Wi-Fi 6', 29, 'One UI 5.0', 'Samsung'],
    ['Galaxy S', 'Galaxy S10+', 'G975', '358901', 'S10P-%04d%04d', 'A0:15:AA', '9.0', '12.0', 6.4, '3040x1440', '60Hz', '8GB,12GB', '128GB,512GB,1TB', 'Exynos 9820/Snapdragon 855', '4100', '15W', '2019-03-08', 0, 0, '2023-04-01', 'samsung/beyond2/g975:9/PPR1.180610.011/G975FXXU5EVB5:user/release-keys', 'G975FXXU5EVB5', '4.9.186-android9-7-g7c3737d8d2ab', 'release-keys', '5.0', 'Wi-Fi 5', 28, 'One UI 4.1', 'Samsung'],

    // Galaxy M серия
    ['Galaxy M', 'Galaxy M53 5G', 'M536', '352007', 'M53-%04d%04d', 'A0:51:01', '12.0', '16.0', 6.7, '2400x1080', '120Hz', '6GB,8GB', '128GB,256GB', 'Dimensity 900', '5000', '25W', '2022-04-22', 1, 0, '2023-12-01', 'samsung/m53x/m536:12/SP1A.210812.016/M536BXXU2CVF7:user/release-keys', 'M536BXXU2CVF7', '5.10.66-android12-9-g7c3737d8d2ab', 'release-keys', '5.2', 'Wi-Fi 6', 31, 'One UI 5.1', 'Samsung'],
    ['Galaxy M', 'Galaxy M33 5G', 'M336', '352008', 'M33-%04d%04d', 'A0:51:02', '12.0', '16.0', 6.6, '2400x1080', '120Hz', '6GB,8GB', '128GB', 'Exynos 1280', '5000', '25W', '2022-04-22', 1, 0, '2023-12-01', 'samsung/m33x/m336:12/SP1A.210812.016/M336BXXU2CVF7:user/release-keys', 'M336BXXU2CVF7', '5.10.66-android12-9-g7c3737d8d2ab', 'release-keys', '5.2', 'Wi-Fi 6', 31, 'One UI 5.1', 'Samsung']
];

foreach ($devices as $device) {
    $sql = "INSERT INTO `samsung_devices` 
        (`product_line`, `model_name`, `codename`, `tac_prefix`, `serial_pattern`, 
         `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, `refresh_rate`, 
         `ram_options`, `storage_options`, `chipset`, `battery_capacity`, `fast_charge`, 
         `release_date`, `is_5g`, `is_current`, `security_patch`, `fingerprint`, `bootloader_version`,
         `kernel_version`, `build_tags`, `bluetooth_version`, `wifi_version`, `api_level`, `oneui_version`, `manufacturer`) 
        VALUES 
        ('{$device[0]}', '{$device[1]}', '{$device[2]}', '{$device[3]}', '{$device[4]}', 
         '{$device[5]}', '{$device[6]}', '{$device[7]}', {$device[8]}, '{$device[9]}', '{$device[10]}', 
         '{$device[11]}', '{$device[12]}', '{$device[13]}', '{$device[14]}', '{$device[15]}', 
         '{$device[16]}', {$device[17]}, {$device[18]}, '{$device[19]}', '{$device[20]}', '{$device[21]}',
         '{$device[22]}', '{$device[23]}', '{$device[24]}', '{$device[25]}', {$device[26]}, '{$device[27]}', '{$device[28]}')";

    $result = insert($sql);
}
$additional_devices = [
    // Galaxy S серия (дополнительные модели)
    ['Galaxy S', 'Galaxy S20 FE', 'G780', '356801', 'S20FE-%04d%04d', 'A0:14:AD', '10.0', '13.0', 6.5, '2400x1080', '120Hz', '6GB,8GB', '128GB,256GB', 'Exynos 990/Snapdragon 865', '4500', '25W', '2020-10-02', 1, 0, '2023-08-01', 'samsung/r8q/g780:11/RP1A.200720.012/G780FXXU3DWB5:user/release-keys', 'G780FXXU3DWB5', '5.4.39-android11-9-g7c3737d8d2ab', 'release-keys', '5.1', 'Wi-Fi 6', 30, 'One UI 5.0', 'Samsung'],
    ['Galaxy S', 'Galaxy S10 Lite', 'G770', '358904', 'S10L-%04d%04d', 'A0:15:AD', '10.0', '12.0', 6.7, '2400x1080', '60Hz', '6GB,8GB', '128GB,256GB', 'Snapdragon 855', '4500', '25W', '2020-01-03', 0, 0, '2022-08-01', 'samsung/r5q/g770:10/QP1A.190711.020/G770FXXU3EVB5:user/release-keys', 'G770FXXU3EVB5', '4.19.113-android10-9-g7c3737d8d2ab', 'release-keys', '5.0', 'Wi-Fi 5', 29, 'One UI 4.1', 'Samsung'],

    // Galaxy Note серия (дополнительные модели)
    ['Galaxy Note', 'Galaxy Note 10 Lite', 'N770', '358903', 'N10L-%04d%04d', 'A0:22:AC', '10.0', '12.0', 6.7, '2400x1080', '60Hz', '6GB,8GB', '128GB', 'Exynos 9810', '4500', '25W', '2020-01-21', 0, 0, '2022-08-01', 'samsung/r5q/n770:10/QP1A.190711.020/N770FXXU3EVB5:user/release-keys', 'N770FXXU3EVB5', '4.19.113-android10-9-g7c3737d8d2ab', 'release-keys', '5.0', 'Wi-Fi 5', 29, 'One UI 4.1', 'Samsung'],
    ['Galaxy Note', 'Galaxy Note 8', 'N950', '359124', 'N8-%04d%04d', 'A0:23:AB', '7.1', '9.0', 6.3, '2960x1440', '60Hz', '6GB', '64GB,128GB,256GB', 'Exynos 8895/Snapdragon 835', '3300', '15W', '2017-09-15', 0, 0, '2020-04-01', 'samsung/greatlte/n950:8/NRD90M/N950FXXU7DSA2:user/release-keys', 'N950FXXU7DSA2', '4.4.78-android8-7-g7c3737d8d2ab', 'release-keys', '5.0', 'Wi-Fi 5', 26, 'One UI 1.0', 'Samsung'],

    // Galaxy A серия (дополнительные модели)
    ['Galaxy A', 'Galaxy A73 5G', 'A736', '352009', 'A73-%04d%04d', 'A0:41:03', '12.0', '16.0', 6.7, '2400x1080', '120Hz', '6GB,8GB', '128GB,256GB', 'Snapdragon 778G', '5000', '25W', '2022-04-22', 1, 0, '2023-12-01', 'samsung/a73x/a736:12/SP1A.210812.016/A736BXXU2CVF7:user/release-keys', 'A736BXXU2CVF7', '5.10.66-android12-9-g7c3737d8d2ab', 'release-keys', '5.2', 'Wi-Fi 6', 31, 'One UI 5.1', 'Samsung'],
    ['Galaxy A', 'Galaxy A13 5G', 'A136', '352010', 'A13-%04d%04d', 'A0:41:04', '12.0', '16.0', 6.5, '1600x720', '90Hz', '4GB,6GB', '64GB,128GB', 'Dimensity 700', '5000', '15W', '2021-12-03', 1, 0, '2023-12-01', 'samsung/a13x/a136:12/SP1A.210812.016/A136BXXU2CVF7:user/release-keys', 'A136BXXU2CVF7', '5.10.66-android12-9-g7c3737d8d2ab', 'release-keys', '5.1', 'Wi-Fi 5', 31, 'One UI 5.1', 'Samsung'],
    ['Galaxy A', 'Galaxy A04s', 'A047', '352011', 'A04S-%04d%04d', 'A0:41:05', '12.0', '14.0', 6.5, '1600x720', '60Hz', '3GB,4GB', '32GB,64GB,128GB', 'Exynos 850', '5000', '15W', '2022-08-31', 0, 0, '2023-12-01', 'samsung/a04sx/a047:12/SP1A.210812.016/A047BXXU2CVF7:user/release-keys', 'A047BXXU2CVF7', '5.10.66-android12-9-g7c3737d8d2ab', 'release-keys', '5.0', 'Wi-Fi 5', 31, 'One UI Core 5.1', 'Samsung'],

    // Galaxy M серия (дополнительные модели)
    ['Galaxy M', 'Galaxy M14 5G', 'M146', '352012', 'M14-%04d%04d', 'A0:51:03', '13.0', '17.0', 6.6, '2408x1080', '90Hz', '4GB,6GB', '64GB,128GB', 'Exynos 1330', '6000', '25W', '2023-03-08', 1, 1, '2023-12-01', 'samsung/m14x/m146:13/TP1A.220624.014/M146BXXU1AWBE:user/release-keys', 'M146BXXU1AWBE', '5.15.74-android13-9-g7c3737d8d2ab', 'release-keys', '5.2', 'Wi-Fi 5', 33, 'One UI Core 5.1', 'Samsung'],
    ['Galaxy M', 'Galaxy M04', 'M046', '352013', 'M04-%04d%04d', 'A0:51:04', '12.0', '14.0', 6.5, '1600x720', '60Hz', '4GB', '64GB,128GB', 'Helio P35', '5000', '15W', '2022-12-09', 0, 0, '2023-12-01', 'samsung/m04x/m046:12/SP1A.210812.016/M046BXXU2CVF7:user/release-keys', 'M046BXXU2CVF7', '5.10.66-android12-9-g7c3737d8d2ab', 'release-keys', '5.0', 'Wi-Fi 5', 31, 'One UI Core 5.1', 'Samsung'],

    // Galaxy F серия
    ['Galaxy F', 'Galaxy F54 5G', 'F546', '352014', 'F54-%04d%04d', 'A0:71:01', '13.0', '17.0', 6.7, '2400x1080', '120Hz', '6GB,8GB', '128GB,256GB', 'Exynos 1380', '6000', '25W', '2023-06-06', 1, 1, '2023-12-01', 'samsung/f54x/f546:13/TP1A.220624.014/F546BXXU1AWBE:user/release-keys', 'F546BXXU1AWBE', '5.15.74-android13-9-g7c3737d8d2ab', 'release-keys', '5.2', 'Wi-Fi 6', 33, 'One UI 5.1', 'Samsung'],
    ['Galaxy F', 'Galaxy F14 5G', 'F146', '352015', 'F14-%04d%04d', 'A0:71:02', '13.0', '17.0', 6.6, '2408x1080', '90Hz', '4GB,6GB', '64GB,128GB', 'Exynos 1330', '6000', '25W', '2023-03-24', 1, 1, '2023-12-01', 'samsung/f14x/f146:13/TP1A.220624.014/F146BXXU1AWBE:user/release-keys', 'F146BXXU1AWBE', '5.15.74-android13-9-g7c3737d8d2ab', 'release-keys', '5.1', 'Wi-Fi 5', 33, 'One UI Core 5.1', 'Samsung'],

    // Galaxy Tab серия (дополнительные модели)
    ['Galaxy Tab', 'Galaxy Tab A8', 'T295', '352016', 'TA8-%04d%04d', 'A0:61:02', '11.0', '13.0', 10.5, '1920x1200', '60Hz', '3GB,4GB', '32GB,64GB,128GB', 'Unisoc T618', '7040', '15W', '2021-12-15', 0, 0, '2023-08-01', 'samsung/tab-a8/t295:11/RP1A.200720.012/T295XXU3CWB5:user/release-keys', 'T295XXU3CWB5', '5.4.39-android11-9-g7c3737d8d2ab', 'release-keys', '5.0', 'Wi-Fi 5', 30, 'One UI Core 5.0', 'Samsung'],
    ['Galaxy Tab', 'Galaxy Tab S6 Lite', 'P613', '352017', 'TS6L-%04d%04d', 'A0:61:03', '12.0', '14.0', 10.4, '2000x1200', '60Hz', '4GB', '64GB,128GB', 'Exynos 9611', '7040', '15W', '2022-05-23', 0, 0, '2023-12-01', 'samsung/tab-s6-lite/p613:12/SP1A.210812.016/P613XXU3CVF7:user/release-keys', 'P613XXU3CVF7', '5.10.66-android12-9-g7c3737d8d2ab', 'release-keys', '5.0', 'Wi-Fi 5', 31, 'One UI 5.1', 'Samsung'],

    // Другие устройства
    ['Other', 'Galaxy XCover 6 Pro', 'G736', '352018', 'XC6P-%04d%04d', 'A0:81:01', '12.0', '16.0', 6.6, '2408x1080', '120Hz', '6GB', '128GB', 'Snapdragon 778G', '4050', '25W', '2022-07-13', 1, 1, '2023-12-01', 'samsung/xcover6/g736:12/SP1A.210812.016/G736BXXU2CVF7:user/release-keys', 'G736BXXU2CVF7', '5.10.66-android12-9-g7c3737d8d2ab', 'release-keys', '5.2', 'Wi-Fi 6', 31, 'One UI 5.1', 'Samsung'],
    ['Other', 'Galaxy Quantum 2', 'A826', '352019', 'GQ2-%04d%04d', 'A0:81:02', '11.0', '13.0', 6.7, '2400x1080', '120Hz', '6GB,8GB', '128GB', 'Snapdragon 855+', '4500', '25W', '2021-04-23', 1, 0, '2023-08-01', 'samsung/quantum2/a826:11/RP1A.200720.012/A826BXXU3DWB5:user/release-keys', 'A826BXXU3DWB5', '5.4.39-android11-9-g7c3737d8d2ab', 'release-keys', '5.1', 'Wi-Fi 6', 30, 'One UI 5.0', 'Samsung']
];

foreach ($additional_devices as $device) {
    $sql = "INSERT INTO `samsung_devices` 
        (`product_line`, `model_name`, `codename`, `tac_prefix`, `serial_pattern`, 
         `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, `refresh_rate`, 
         `ram_options`, `storage_options`, `chipset`, `battery_capacity`, `fast_charge`, 
         `release_date`, `is_5g`, `is_current`, `security_patch`, `fingerprint`, `bootloader_version`,
         `kernel_version`, `build_tags`, `bluetooth_version`, `wifi_version`, `api_level`, `oneui_version`, `manufacturer`) 
        VALUES 
        ('{$device[0]}', '{$device[1]}', '{$device[2]}', '{$device[3]}', '{$device[4]}', 
         '{$device[5]}', '{$device[6]}', '{$device[7]}', {$device[8]}, '{$device[9]}', '{$device[10]}', 
         '{$device[11]}', '{$device[12]}', '{$device[13]}', '{$device[14]}', '{$device[15]}', 
         '{$device[16]}', {$device[17]}, {$device[18]}, '{$device[19]}', '{$device[20]}', '{$device[21]}',
         '{$device[22]}', '{$device[23]}', '{$device[24]}', '{$device[25]}', {$device[26]}, '{$device[27]}', '{$device[28]}')";

    $result = insert($sql);
}