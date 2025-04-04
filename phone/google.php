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
  PRIMARY KEY (`id`),
  UNIQUE KEY `model_name` (`model_name`),
  KEY `product_line` (`product_line`),
  KEY `release_date` (`release_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$result = create($sql);

// Вставка данных
$devices = [
    ['Pixel', 'Pixel 8 Pro', 'husky', '359916', 'FP8P%%06d', 'D8:EB:98', '14.0', '17.0', 6.7, '3120x1440', '12GB', '128GB,256GB,512GB,1TB', 'Tensor G3', '2023-10-04', 1, 1, '2023-12-05'],
    ['Pixel', 'Pixel 8', 'shiba', '359917', 'FP8%%06d', 'D8:EB:99', '14.0', '17.0', 6.2, '2400x1080', '8GB', '128GB,256GB', 'Tensor G3', '2023-10-04', 1, 1, '2023-12-05'],
    ['Pixel', 'Pixel 7 Pro', 'cheetah', '359914', 'FP7P%%06d', 'D8:EB:96', '13.0', '16.0', 6.7, '3120x1440', '12GB', '128GB,256GB,512GB', 'Tensor G2', '2022-10-06', 1, 1, '2023-12-05'],
    ['Pixel', 'Pixel 7', 'panther', '359915', 'FP7%%06d', 'D8:EB:97', '13.0', '16.0', 6.3, '2400x1080', '8GB', '128GB,256GB', 'Tensor G2', '2022-10-06', 1, 1, '2023-12-05'],
    ['Pixel', 'Pixel 6 Pro', 'raven', '359912', 'FP6P%%06d', 'D8:EB:94', '12.0', '15.0', 6.7, '3120x1440', '12GB', '128GB,256GB,512GB', 'Tensor G1', '2021-10-28', 1, 0, '2023-12-05'],
    ['Pixel', 'Pixel 6', 'oriole', '359913', 'FP6%%06d', 'D8:EB:95', '12.0', '15.0', 6.4, '2400x1080', '8GB', '128GB,256GB', 'Tensor G1', '2021-10-28', 1, 0, '2023-12-05'],
    ['Pixel', 'Pixel Fold', 'felix', '359918', 'FPF%%06d', 'D8:EB:9A', '13.0', '16.0', 7.6, '2208x1840', '12GB', '256GB,512GB', 'Tensor G2', '2023-06-27', 1, 1, '2023-12-05'],
];

foreach ($devices as $device) {
    $sql = "INSERT INTO `google_devices` 
        (`product_line`, `model_name`, `codename`, `tac_prefix`, `serial_pattern`, 
         `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, 
         `ram_options`, `storage_options`, `chipset`, `release_date`, 
         `is_5g`, `is_current`, `security_patch`) 
        VALUES 
        ('{$device[0]}', '{$device[1]}', '{$device[2]}', '{$device[3]}', '{$device[4]}', 
         '{$device[5]}', '{$device[6]}', '{$device[7]}', {$device[8]}, '{$device[9]}', 
         '{$device[10]}', '{$device[11]}', '{$device[12]}', '{$device[13]}', 
         {$device[14]}, {$device[15]}, '{$device[16]}')";

    $result = insert($sql);
}