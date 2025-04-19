<?php
$sql = "CREATE TABLE `google_devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_line` enum('Pixel','Pixel Fold','Pixel Tablet','Pixelbook','Nest') NOT NULL,
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
  `fingerprint` varchar(150) DEFAULT NULL COMMENT 'Build fingerprint (ro.build.fingerprint)',
  `bootloader_version` varchar(50) DEFAULT NULL,
  `kernel_version` varchar(100) DEFAULT NULL,
  `build_tags` varchar(30) DEFAULT NULL COMMENT 'e.g., release-keys, dev-keys',
  `bluetooth_version` varchar(10) DEFAULT NULL,
  `wifi_version` varchar(15) DEFAULT NULL,
  `api_level` smallint(4) DEFAULT NULL,
  `manufacturer` varchar(20) DEFAULT 'Google',
  PRIMARY KEY (`id`),
  UNIQUE KEY `model_name` (`model_name`),
  KEY `product_line` (`product_line`),
  KEY `release_date` (`release_date`),
  KEY `tac_prefix` (`tac_prefix`),
  KEY `mac_prefix` (`mac_prefix`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$result = create($sql);

// Вставка данных
$devices = [
    // Pixel 8 Series
    ['Pixel', 'Pixel 8 Pro', 'husky', '359916', 'FP8P%%06d', 'D8:EB:98', '14.0', '17.0', 6.7, '3120x1440', '12GB', '128GB,256GB,512GB,1TB', 'Tensor G3', '2023-10-04', 1, 1, '2023-12-05', 'google/husky/husky:14/UP1A.231005.007/10750268:user/release-keys', 'husky-1.0-11070241', '5.15.110-android14-11-g4b0e5d9e0d0b-ab11070241', 'release-keys', '5.3', 'Wi-Fi 6E', 34, 'Google'],
    ['Pixel', 'Pixel 8', 'shiba', '359917', 'FP8%%06d', 'D8:EB:99', '14.0', '17.0', 6.2, '2400x1080', '8GB', '128GB,256GB', 'Tensor G3', '2023-10-04', 1, 1, '2023-12-05', 'google/shiba/shiba:14/UP1A.231005.007/10750268:user/release-keys', 'shiba-1.0-11070241', '5.15.110-android14-11-g4b0e5d9e0d0b-ab11070241', 'release-keys', '5.3', 'Wi-Fi 6E', 34, 'Google'],

    // Pixel 7 Series
    ['Pixel', 'Pixel 7 Pro', 'cheetah', '359914', 'FP7P%%06d', 'D8:EB:96', '13.0', '16.0', 6.7, '3120x1440', '12GB', '128GB,256GB,512GB', 'Tensor G2', '2022-10-06', 1, 1, '2023-12-05', 'google/cheetah/cheetah:13/TP1A.221005.002/9382332:user/release-keys', 'cheetah-1.2-9382332', '5.10.110-android13-8-g1b1e5d9e0d0b-ab9382332', 'release-keys', '5.2', 'Wi-Fi 6E', 33, 'Google'],
    ['Pixel', 'Pixel 7', 'panther', '359915', 'FP7%%06d', 'D8:EB:97', '13.0', '16.0', 6.3, '2400x1080', '8GB', '128GB,256GB', 'Tensor G2', '2022-10-06', 1, 1, '2023-12-05', 'google/panther/panther:13/TP1A.221005.002/9382332:user/release-keys', 'panther-1.2-9382332', '5.10.110-android13-8-g1b1e5d9e0d0b-ab9382332', 'release-keys', '5.2', 'Wi-Fi 6E', 33, 'Google'],

    // Pixel 6 Series
    ['Pixel', 'Pixel 6 Pro', 'raven', '359912', 'FP6P%%06d', 'D8:EB:94', '12.0', '15.0', 6.7, '3120x1440', '12GB', '128GB,256GB,512GB', 'Tensor G1', '2021-10-28', 1, 0, '2023-12-05', 'google/raven/raven:12/SP2A.220505.008/8681884:user/release-keys', 'raven-1.2-8681884', '5.10.66-android12-9-g4b0e5d9e0d0b-ab8681884', 'release-keys', '5.2', 'Wi-Fi 6E', 32, 'Google'],
    ['Pixel', 'Pixel 6', 'oriole', '359913', 'FP6%%06d', 'D8:EB:95', '12.0', '15.0', 6.4, '2400x1080', '8GB', '128GB,256GB', 'Tensor G1', '2021-10-28', 1, 0, '2023-12-05', 'google/oriole/oriole:12/SP2A.220505.008/8681884:user/release-keys', 'oriole-1.2-8681884', '5.10.66-android12-9-g4b0e5d9e0d0b-ab8681884', 'release-keys', '5.2', 'Wi-Fi 6E', 32, 'Google'],

    // Pixel Fold
    ['Pixel', 'Pixel Fold', 'felix', '359918', 'FPF%%06d', 'D8:EB:9A', '13.0', '16.0', 7.6, '2208x1840', '12GB', '256GB,512GB', 'Tensor G2', '2023-06-27', 1, 1, '2023-12-05', 'google/felix/felix:13/TQ3A.230805.001/10316531:user/release-keys', 'felix-1.1-10316531', '5.10.110-android13-8-g1b1e5d9e0d0b-ab10316531', 'release-keys', '5.2', 'Wi-Fi 6E', 33, 'Google'],

    // Старые модели (Android 8-11)
    ['Pixel', 'Pixel 5', 'redfin', '359911', 'FP5%%06d', 'D8:EB:93', '11.0', '14.0', 6.0, '2340x1080', '8GB', '128GB', 'Snapdragon 765G', '2020-10-15', 1, 0, '2023-12-05', 'google/redfin/redfin:11/RQ3A.211001.001/7641976:user/release-keys', 'redfin-1.2-7641976', '4.19.157-android11-7-g4b0e5d9e0d0b-ab7641976', 'release-keys', '5.0', 'Wi-Fi 5', 30, 'Google'],
    ['Pixel', 'Pixel 4 XL', 'coral', '359910', 'FP4XL%%06d', 'D8:EB:92', '10.0', '13.0', 6.3, '3040x1440', '6GB', '64GB,128GB', 'Snapdragon 855', '2019-10-24', 0, 0, '2023-12-05', 'google/coral/coral:10/QD1A.190821.014/5972272:user/release-keys', 'coral-1.2-5972272', '4.14.117-android10-7-g4b0e5d9e0d0b-ab5972272', 'release-keys', '5.0', 'Wi-Fi 5', 29, 'Google'],
    ['Pixel', 'Pixel 3a XL', 'bonito', '359909', 'FP3AXL%%06d', 'D8:EB:91', '9.0', '12.0', 6.0, '2160x1080', '4GB', '64GB', 'Snapdragon 670', '2019-05-07', 0, 0, '2023-12-05', 'google/bonito/bonito:9/PQ3A.190801.002/5670241:user/release-keys', 'bonito-1.2-5670241', '4.9.186-android9-7-g4b0e5d9e0d0b-ab5670241', 'release-keys', '5.0', 'Wi-Fi 5', 28, 'Google'],
    ['Pixel', 'Pixel 2 XL', 'taimen', '359908', 'FP2XL%%06d', 'D8:EB:90', '8.0', '11.0', 6.0, '2880x1440', '4GB', '64GB,128GB', 'Snapdragon 835', '2017-10-19', 0, 0, '2023-12-05', 'google/taimen/taimen:8/OPM4.171019.021.P1/4820017:user/release-keys', 'taimen-1.2-4820017', '4.4.78-android8-7-g4b0e5d9e0d0b-ab4820017', 'release-keys', '5.0', 'Wi-Fi 5', 27, 'Google']
];

foreach ($devices as $device) {
    $sql = "INSERT INTO `google_devices` 
        (`product_line`, `model_name`, `codename`, `tac_prefix`, `serial_pattern`, 
         `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, 
         `ram_options`, `storage_options`, `chipset`, `release_date`, 
         `is_5g`, `is_current`, `security_patch`, `fingerprint`, `bootloader_version`,
         `kernel_version`, `build_tags`, `bluetooth_version`, `wifi_version`, `api_level`, `manufacturer`) 
        VALUES 
        ('{$device[0]}', '{$device[1]}', '{$device[2]}', '{$device[3]}', '{$device[4]}', 
         '{$device[5]}', '{$device[6]}', '{$device[7]}', {$device[8]}, '{$device[9]}', 
         '{$device[10]}', '{$device[11]}', '{$device[12]}', '{$device[13]}', 
         {$device[14]}, {$device[15]}, '{$device[16]}', '{$device[17]}', '{$device[18]}',
         '{$device[19]}', '{$device[20]}', '{$device[21]}', '{$device[22]}', {$device[23]}, '{$device[24]}')";

    $result = insert($sql);
}