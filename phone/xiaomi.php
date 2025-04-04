<?php

// Создание таблицы
$sql = "CREATE TABLE `xiaomi_devices` (
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

// Вставка данных с явным указанием колонок
$sql = "INSERT INTO `xiaomi_devices` 
(`product_line`, `model_name`, `codename`, `tac_prefix`, `serial_pattern`, `mac_prefix`, 
 `android_min`, `android_max`, `screen_size`, `resolution`, `refresh_rate`, 
 `ram_options`, `storage_options`, `chipset`, `battery_capacity`, 
 `release_date`, `is_5g`, `is_current`, `security_patch`) 
VALUES
('Xiaomi', 'Xiaomi 13 Ultra', 'ishtar', '865456', 'XM13U%06d', '64:CC:22', '13.0', '17.0', 6.73, '3200x1440', '120Hz', '12GB,16GB', '256GB,512GB,1TB', 'Snapdragon 8 Gen 2', '5000', '2023-04-18', 1, 1, '2023-12-01'),
('Xiaomi', 'Xiaomi 13 Pro', 'nuwa', '865457', 'XM13P%06d', '64:CC:23', '13.0', '17.0', 6.73, '3200x1440', '120Hz', '8GB,12GB', '128GB,256GB,512GB', 'Snapdragon 8 Gen 2', '4820', '2022-12-11', 1, 1, '2023-12-01'),
('Redmi', 'Redmi K60 Pro', 'socrates', '865458', 'RMK6P%06d', '64:CC:24', '13.0', '17.0', 6.67, '3200x1440', '120Hz', '8GB,12GB,16GB', '128GB,256GB,512GB', 'Snapdragon 8 Gen 2', '5000', '2022-12-27', 1, 1, '2023-12-01'),
('POCO', 'POCO F5 Pro', 'mondrian', '865459', 'POF5P%06d', '64:CC:25', '13.0', '17.0', 6.67, '3200x1440', '120Hz', '8GB,12GB', '256GB,512GB', 'Snapdragon 8+ Gen 1', '5160', '2023-05-09', 1, 1, '2023-12-01'),
('Redmi Note', 'Redmi Note 12 Pro+', 'xaga', '865460', 'RMN12P%06d', '64:CC:26', '12.0', '16.0', 6.67, '2400x1080', '120Hz', '6GB,8GB,12GB', '128GB,256GB', 'Dimensity 1080', '5000', '2022-10-27', 1, 1, '2023-12-01'),
('Xiaomi', 'Xiaomi 12T Pro', 'diting', '865461', 'XM12TP%06d', '64:CC:27', '12.0', '16.0', 6.67, '2712x1220', '120Hz', '8GB,12GB', '128GB,256GB', 'Snapdragon 8+ Gen 1', '5000', '2022-10-04', 1, 0, '2023-12-01'),
('Black Shark', 'Black Shark 5 Pro', 'kaiser', '865462', 'BLS5P%06d', '64:CC:28', '12.0', '16.0', 6.67, '2400x1080', '144Hz', '8GB,12GB,16GB', '128GB,256GB,512GB', 'Snapdragon 8 Gen 1', '4650', '2022-03-30', 1, 0, '2023-12-01'),
('Xiaomi Pad', 'Xiaomi Pad 6 Pro', 'liuqin', '865463', 'XMP6P%06d', '64:CC:29', '13.0', '17.0', 11.0, '2880x1800', '144Hz', '8GB,12GB', '128GB,256GB,512GB', 'Snapdragon 8+ Gen 1', '8600', '2023-04-18', 1, 1, '2023-12-01'),
('Redmi', 'Redmi K50 Gaming', 'ingres', '865464', 'RMK5G%06d', '64:CC:30', '12.0', '16.0', 6.67, '2400x1080', '120Hz', '8GB,12GB', '128GB,256GB', 'Snapdragon 8 Gen 1', '4700', '2022-02-16', 1, 0, '2023-12-01'),
('Xiaomi Mi Mix', 'Xiaomi Mi Mix Fold 3', 'babylon', '865465', 'XMMF3%06d', '64:CC:31', '13.0', '17.0', 8.03, '2160x1914', '120Hz', '12GB,16GB', '256GB,512GB,1TB', 'Snapdragon 8 Gen 2', '4800', '2023-08-14', 1, 1, '2023-12-01')";

$result = insert($sql);

$sql = "INSERT INTO `xiaomi_devices` (`product_line`, `model_name`, `codename`, `tac_prefix`, `serial_pattern`, `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, `refresh_rate`, `ram_options`, `storage_options`, `chipset`, `battery_capacity`, `release_date`, `is_5g`, `is_current`, `security_patch`) VALUES
('Xiaomi', 'Mi 10', 'umi', '861234', 'MI10-%04d%04d', 'A0:B1:C2', '10.0', '13.0', 6.67, '2340x1080', '90Hz', '8GB,12GB', '128GB,256GB', 'Snapdragon 865', '4780', '2020-02-13', 1, 0, '2023-12-01'),
('Xiaomi', 'Mi 10 Pro', 'cmi', '861235', 'MIP10-%04d%04d', 'A0:B1:C3', '10.0', '13.0', 6.67, '2340x1080', '90Hz', '8GB,12GB', '256GB,512GB', 'Snapdragon 865', '4500', '2020-02-13', 1, 0, '2023-12-01'),
('Xiaomi', 'Mi 9', 'cepheus', '861236', 'MI9-%04d%04d', 'A0:B1:C4', '9.0', '11.0', 6.39, '2340x1080', '60Hz', '6GB,8GB', '64GB,128GB', 'Snapdragon 855', '3300', '2019-02-20', 0, 0, '2021-12-01'),
('Xiaomi', 'Mi 9T Pro', 'raphael', '861237', 'MI9TP-%04d%04d', 'A0:B1:C5', '9.0', '11.0', 6.39, '2340x1080', '60Hz', '6GB,8GB', '64GB,128GB,256GB', 'Snapdragon 855', '4000', '2019-08-20', 0, 0, '2021-12-01');";

$result = insert($sql);
$sql = "INSERT INTO `xiaomi_devices` (`product_line`, `model_name`, `codename`, `tac_prefix`, `serial_pattern`, `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, `refresh_rate`, `ram_options`, `storage_options`, `chipset`, `battery_capacity`, `release_date`, `is_5g`, `is_current`, `security_patch`) VALUES
('Redmi Note', 'Redmi Note 10 Pro', 'sweet', '861345', 'RN10P-%04d%04d', 'A0:B2:C1', '11.0', '13.0', 6.67, '2400x1080', '120Hz', '6GB,8GB', '64GB,128GB', 'Snapdragon 732G', '5020', '2021-03-04', 0, 0, '2023-12-01'),
('Redmi Note', 'Redmi Note 9 Pro', 'joyeuse', '861346', 'RN9P-%04d%04d', 'A0:B2:C2', '10.0', '12.0', 6.67, '2400x1080', '60Hz', '6GB,8GB', '64GB,128GB', 'Snapdragon 720G', '5020', '2020-03-12', 0, 0, '2022-12-01'),
('Redmi Note', 'Redmi Note 8 Pro', 'begonia', '861347', 'RN8P-%04d%04d', 'A0:B2:C3', '9.0', '11.0', 6.53, '2340x1080', '60Hz', '6GB,8GB', '64GB,128GB', 'Helio G90T', '4500', '2019-08-29', 0, 0, '2021-12-01'),
('Redmi Note', 'Redmi Note 7', 'lavender', '861348', 'RN7-%04d%04d', 'A0:B2:C4', '9.0', '11.0', 6.3, '2340x1080', '60Hz', '3GB,4GB,6GB', '32GB,64GB,128GB', 'Snapdragon 660', '4000', '2019-01-10', 0, 0, '2021-12-01')";
$result = insert($sql);

$sql = "INSERT INTO `xiaomi_devices` (`product_line`, `model_name`, `codename`, `tac_prefix`, `serial_pattern`, `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, `refresh_rate`, `ram_options`, `storage_options`, `chipset`, `battery_capacity`, `release_date`, `is_5g`, `is_current`, `security_patch`) VALUES
('POCO', 'POCO F2 Pro', 'lmi', '861456', 'POF2P-%04d%04d', 'A0:B3:C1', '10.0', '12.0', 6.67, '2400x1080', '60Hz', '6GB,8GB', '128GB,256GB', 'Snapdragon 865', '4700', '2020-05-12', 1, 0, '2022-12-01'),
('POCO', 'POCO X3 NFC', 'surya', '861457', 'POX3-%04d%04d', 'A0:B3:C2', '10.0', '12.0', 6.67, '2400x1080', '120Hz', '6GB,8GB', '64GB,128GB', 'Snapdragon 732G', '5160', '2020-09-07', 0, 0, '2022-12-01'),
('POCO', 'POCO F1', 'beryllium', '861458', 'POF1-%04d%04d', 'A0:B3:C3', '9.0', '10.0', 6.18, '2246x1080', '60Hz', '6GB,8GB', '64GB,128GB,256GB', 'Snapdragon 845', '4000', '2018-08-22', 0, 0, '2020-12-01')";

$result = insert($sql);
$sql = "INSERT INTO `xiaomi_devices` (`product_line`, `model_name`, `codename`, `tac_prefix`, `serial_pattern`, `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, `refresh_rate`, `ram_options`, `storage_options`, `chipset`, `battery_capacity`, `release_date`, `is_5g`, `is_current`, `security_patch`) VALUES
('Redmi', 'Redmi 9', 'lancelot', '861567', 'RM9-%04d%04d', 'A0:B4:C1', '10.0', '12.0', 6.53, '2340x1080', '60Hz', '3GB,4GB,6GB', '32GB,64GB,128GB', 'Helio G80', '5020', '2020-06-10', 0, 0, '2022-12-01'),
('Redmi', 'Redmi 8', 'olive', '861568', 'RM8-%04d%04d', 'A0:B4:C2', '9.0', '11.0', 6.22, '1520x720', '60Hz', '3GB,4GB', '32GB,64GB', 'Snapdragon 439', '5000', '2019-10-09', 0, 0, '2021-12-01'),
('Redmi', 'Redmi 7', 'onclite', '861569', 'RM7-%04d%04d', 'A0:B4:C3', '9.0', '10.0', 6.26, '1520x720', '60Hz', '2GB,3GB,4GB', '16GB,32GB,64GB', 'Snapdragon 632', '4000', '2019-03-18', 0, 0, '2020-12-01')";
$result = insert($sql);