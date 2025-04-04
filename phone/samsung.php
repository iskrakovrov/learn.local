<?php
$sql = "CREATE TABLE IF NOT EXISTS `samsung_devices` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `model_group` enum('Galaxy S','Galaxy Note','Galaxy Z','Galaxy A','Galaxy M','Galaxy F','Galaxy Tab','Other') NOT NULL,
  `model_name` varchar(100) NOT NULL,
  `tac_prefix` varchar(8) NOT NULL COMMENT 'Первые 6-8 цифр IMEI',
  `serial_pattern` varchar(20) DEFAULT 'SM-%04d%04d%04d',
  `mac_prefix` varchar(8) DEFAULT 'A0:11:22',
  `android_min` varchar(10) DEFAULT NULL,
  `android_max` varchar(10) DEFAULT NULL,
  `screen_size` decimal(3,1) DEFAULT NULL,
  `resolution` varchar(12) DEFAULT NULL,
  `ram_options` varchar(50) DEFAULT NULL,
  `storage_options` varchar(50) DEFAULT NULL,
  `chipset` varchar(50) DEFAULT NULL,
  `release_quarter` char(8) DEFAULT NULL COMMENT 'Формат: YYYY-Q',
  `is_5g` tinyint(1) DEFAULT 0,
  `is_current` tinyint(1) DEFAULT 0 COMMENT 'Актуальная модель',
  PRIMARY KEY (`id`),
  UNIQUE KEY `model_name` (`model_name`),
  KEY `model_group` (`model_group`),
  KEY `release_quarter` (`release_quarter`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
$result = create ($sql);

// Вставка данных для Galaxy S серии
$sql ="INSERT INTO `samsung_devices` (`model_group`, `model_name`, `tac_prefix`, `serial_pattern`, `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, `ram_options`, `storage_options`, `chipset`, `release_quarter`, `is_5g`, `is_current`) VALUES
('Galaxy S', 'Galaxy S23 Ultra', '350234', 'S23U-%04d%04d', 'A0:11:BA', '13.0', '14.0', 6.8, '3088x1440', '8GB,12GB', '256GB,512GB,1TB', 'Snapdragon 8 Gen 2', '2023-Q1', 1, 1),
('Galaxy S', 'Galaxy S23+', '350235', 'S23P-%04d%04d', 'A0:11:BB', '13.0', '14.0', 6.6, '2340x1080', '8GB', '256GB,512GB', 'Snapdragon 8 Gen 2', '2023-Q1', 1, 1),
('Galaxy S', 'Galaxy S23', '350236', 'S23-%04d%04d', 'A0:11:BC', '13.0', '14.0', 6.1, '2340x1080', '8GB', '128GB,256GB', 'Snapdragon 8 Gen 2', '2023-Q1', 1, 1),
('Galaxy S', 'Galaxy S22 Ultra', '352345', 'S22U-%04d%04d', 'A0:12:AA', '12.0', '14.0', 6.8, '3088x1440', '8GB,12GB', '128GB,256GB,512GB,1TB', 'Exynos 2200/Snapdragon 8 Gen 1', '2022-Q1', 1, 0),
('Galaxy S', 'Galaxy S21 FE', '355678', 'S21F-%04d%04d', 'A0:13:AB', '12.0', '14.0', 6.4, '2340x1080', '6GB,8GB', '128GB,256GB', 'Exynos 2100/Snapdragon 888', '2022-Q1', 1, 0)";

//Вставка данных для Galaxy Z серии
$sql = "INSERT INTO `samsung_devices` (`model_group`, `model_name`, `tac_prefix`, `serial_pattern`, `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, `ram_options`, `storage_options`, `chipset`, `release_quarter`, `is_5g`, `is_current`) VALUES
('Galaxy Z', 'Galaxy Z Fold5', '351567', 'ZF5-%04d%04d', 'A0:21:AA', '13.0', '14.0', 7.6, '2176x1812', '12GB', '256GB,512GB,1TB', 'Snapdragon 8 Gen 2', '2023-Q3', 1, 1),
('Galaxy Z', 'Galaxy Z Flip5', '352678', 'ZP5-%04d%04d', 'A0:21:AB', '13.0', '14.0', 6.7, '2640x1080', '8GB', '256GB,512GB', 'Snapdragon 8 Gen 2', '2023-Q3', 1, 1),
('Galaxy Z', 'Galaxy Z Fold4', '353789', 'ZF4-%04d%04d', 'A0:21:AC', '12.0', '14.0', 7.6, '2176x1812', '12GB', '256GB,512GB,1TB', 'Snapdragon 8+ Gen 1', '2022-Q3', 1, 0)";
$result = insert ($sql);

//Вставка данных для Galaxy A серии (20+ моделей)
$sql = "INSERT INTO `samsung_devices` (`model_group`, `model_name`, `tac_prefix`, `serial_pattern`, `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, `ram_options`, `storage_options`, `chipset`, `release_quarter`, `is_5g`, `is_current`) VALUES
('Galaxy A', 'Galaxy A54 5G', '351234', 'A54-%04d%04d', 'A0:31:AA', '13.0', '15.0', 6.4, '2340x1080', '6GB,8GB', '128GB,256GB', 'Exynos 1380', '2023-Q1', 1, 1),
('Galaxy A', 'Galaxy A34 5G', '352456', 'A34-%04d%04d', 'A0:31:AB', '13.0', '15.0', 6.6, '2340x1080', '6GB,8GB', '128GB,256GB', 'Dimensity 1080', '2023-Q1', 1, 1),
('Galaxy A', 'Galaxy A14 5G', '357890', 'A14-%04d%04d', 'A0:31:AC', '13.0', '15.0', 6.6, '2408x1080', '4GB,6GB', '64GB,128GB', 'Dimensity 700', '2023-Q1', 1, 1),
('Galaxy A', 'Galaxy A73 5G', '358123', 'A73-%04d%04d', 'A0:31:AD', '12.0', '14.0', 6.7, '2400x1080', '6GB,8GB', '128GB,256GB', 'Snapdragon 778G', '2022-Q2', 1, 0),
('Galaxy A', 'Galaxy A52s 5G', '358456', 'A52S-%04d%04d', 'A0:31:AE', '11.0', '13.0', 6.5, '2400x1080', '6GB,8GB', '128GB,256GB', 'Snapdragon 778G', '2021-Q3', 1, 0)";
$result = insert ($sql);
//Вставка данных для Galaxy M серии
$sql ="INSERT INTO `samsung_devices` (`model_group`, `model_name`, `tac_prefix`, `serial_pattern`, `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, `ram_options`, `storage_options`, `chipset`, `release_quarter`, `is_5g`, `is_current`) VALUES
('Galaxy M', 'Galaxy M54 5G', '350000', 'M54-%04d%04d', 'A0:41:AA', '13.0', '15.0', 6.7, '2400x1080', '8GB', '128GB,256GB', 'Exynos 1380', '2023-Q2', 1, 1),
('Galaxy M', 'Galaxy M33 5G', '350123', 'M33-%04d%04d', 'A0:41:AB', '12.0', '14.0', 6.6, '2408x1080', '6GB,8GB', '128GB', 'Exynos 1280', '2022-Q2', 1, 0)";
$result = insert ($sql);
//Вставка данных для Galaxy Tab серии
$sql = "INSERT INTO `samsung_devices` (`model_group`, `model_name`, `tac_prefix`, `serial_pattern`, `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, `ram_options`, `storage_options`, `chipset`, `release_quarter`, `is_5g`, `is_current`) VALUES
('Galaxy Tab', 'Galaxy Tab S9 Ultra', '357777', 'TSU-%04d%04d', 'A0:51:AA', '13.0', '15.0', 14.6, '2960x1848', '12GB,16GB', '256GB,512GB,1TB', 'Snapdragon 8 Gen 2', '2023-Q3', 1, 1),
('Galaxy Tab', 'Galaxy Tab S8+', '357888', 'TS8P-%04d%04d', 'A0:51:AB', '12.0', '14.0', 12.4, '2800x1752', '8GB,12GB', '128GB,256GB,512GB', 'Snapdragon 8 Gen 1', '2022-Q1', 1, 0)";
$result = insert ($sql);
//Вставка данных для других серий (Galaxy F, Galaxy XCover и т.д.)
$sql = "INSERT INTO `samsung_devices` (`model_group`, `model_name`, `tac_prefix`, `serial_pattern`, `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, `ram_options`, `storage_options`, `chipset`, `release_quarter`, `is_5g`, `is_current`) VALUES
('Other', 'Galaxy XCover6 Pro', '359999', 'XC6-%04d%04d', 'A0:61:AA', '12.0', '14.0', 6.6, '2408x1080', '6GB', '64GB,128GB', 'Snapdragon 778G', '2022-Q3', 1, 1),
('Other', 'Galaxy F54 5G', '359000', 'F54-%04d%04d', 'A0:61:AB', '13.0', '15.0', 6.7, '2400x1080', '8GB', '128GB,256GB', 'Exynos 1380', '2023-Q2', 1, 1)";
$result = insert ($sql);
$sql = "INSERT INTO `samsung_devices` (`model_group`, `model_name`, `tac_prefix`, `serial_pattern`, `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, `ram_options`, `storage_options`, `chipset`, `release_quarter`, `is_5g`, `is_current`) VALUES
('Galaxy A', 'Galaxy A51', '351111', 'A51-%04d%04d', 'A0:31:C1', '10.0', '13.0', 6.5, '2400x1080', '4GB,6GB,8GB', '64GB,128GB', 'Exynos 9611', '2019-Q4', 0, 0),
('Galaxy A', 'Galaxy A51 5G', '351112', 'A51-%04d%04d', 'A0:31:C2', '10.0', '13.0', 6.5, '2400x1080', '6GB,8GB', '128GB', 'Exynos 980', '2020-Q2', 1, 0),
('Galaxy A', 'Galaxy A71', '352222', 'A71-%04d%04d', 'A0:31:C3', '10.0', '13.0', 6.7, '2400x1080', '6GB,8GB', '128GB', 'Snapdragon 730', '2019-Q4', 0, 0),
('Galaxy A', 'Galaxy A71 5G', '352223', 'A71-%04d%04d', 'A0:31:C4', '10.0', '13.0', 6.7, '2400x1080', '6GB,8GB', '128GB', 'Exynos 980', '2020-Q2', 1, 0),
('Galaxy A', 'Galaxy A52', '353333', 'A52-%04d%04d', 'A0:31:C5', '11.0', '14.0', 6.5, '2400x1080', '4GB,6GB,8GB', '64GB,128GB,256GB', 'Snapdragon 720G', '2021-Q1', 0, 0),
('Galaxy A', 'Galaxy A52 5G', '353334', 'A52-%04d%04d', 'A0:31:C6', '11.0', '14.0', 6.5, '2400x1080', '6GB,8GB', '128GB,256GB', 'Snapdragon 750G', '2021-Q1', 1, 0),
('Galaxy A', 'Galaxy A31', '354444', 'A31-%04d%04d', 'A0:31:C7', '10.0', '12.0', 6.4, '2400x1080', '4GB,6GB', '64GB,128GB', 'Helio P65', '2020-Q2', 0, 0),
('Galaxy A', 'Galaxy A32', '355555', 'A32-%04d%04d', 'A0:31:C8', '11.0', '14.0', 6.4, '2400x1080', '4GB,6GB,8GB', '64GB,128GB', 'Helio G80', '2021-Q1', 0, 0),
('Galaxy A', 'Galaxy A32 5G', '355556', 'A32-%04d%04d', 'A0:31:C9', '11.0', '14.0', 6.5, '1600x720', '4GB,6GB,8GB', '64GB,128GB', 'Dimensity 720', '2021-Q1', 1, 0),
('Galaxy A', 'Galaxy A50', '356666', 'A50-%04d%04d', 'A0:31:D1', '9.0', '11.0', 6.4, '2340x1080', '4GB,6GB', '64GB,128GB', 'Exynos 9610', '2019-Q1', 0, 0),
('Galaxy A', 'Galaxy A70', '357777', 'A70-%04d%04d', 'A0:31:D2', '9.0', '11.0', 6.7, '2400x1080', '6GB,8GB', '128GB', 'Snapdragon 675', '2019-Q2', 0, 0),
('Galaxy A', 'Galaxy A80', '358888', 'A80-%04d%04d', 'A0:31:D3', '9.0', '11.0', 6.7, '2400x1080', '8GB', '128GB', 'Snapdragon 730', '2019-Q2', 0, 0),
('Galaxy A', 'Galaxy A01', '359999', 'A01-%04d%04d', 'A0:31:D4', '10.0', '12.0', 5.7, '1520x720', '2GB', '16GB,32GB', 'Snapdragon 439', '2020-Q1', 0, 0),
('Galaxy A', 'Galaxy A02s', '360000', 'A02-%04d%04d', 'A0:31:D5', '10.0', '12.0', 6.5, '1600x720', '3GB,4GB', '32GB,64GB', 'Snapdragon 450', '2021-Q1', 0, 0),
('Galaxy A', 'Galaxy A10', '361111', 'A10-%04d%04d', 'A0:31:D6', '9.0', '11.0', 6.2, '1520x720', '2GB,3GB', '32GB', 'Exynos 7884', '2019-Q1', 0, 0),
('Galaxy A', 'Galaxy A20', '362222', 'A20-%04d%04d', 'A0:31:D7', '9.0', '11.0', 6.4, '1560x720', '3GB', '32GB,64GB', 'Exynos 7884', '2019-Q2', 0, 0),
('Galaxy A', 'Galaxy A30', '363333', 'A30-%04d%04d', 'A0:31:D8', '9.0', '11.0', 6.4, '2340x1080', '3GB,4GB', '32GB,64GB', 'Exynos 7904', '2019-Q1', 0, 0),
('Galaxy A', 'Galaxy A40', '364444', 'A40-%04d%04d', 'A0:31:D9', '9.0', '11.0', 5.9, '2340x1080', '4GB', '64GB', 'Exynos 7904', '2019-Q2', 0, 0),
('Galaxy A', 'Galaxy A41', '365555', 'A41-%04d%04d', 'A0:31:E1', '10.0', '12.0', 6.1, '2400x1080', '4GB', '64GB', 'Helio P65', '2020-Q2', 0, 0),
('Galaxy A', 'Galaxy A21s', '366666', 'A21-%04d%04d', 'A0:31:E2', '10.0', '12.0', 6.5, '1600x720', '3GB,4GB,6GB', '32GB,64GB', 'Exynos 850', '2020-Q2', 0, 0);";
$result = insert ($sql);