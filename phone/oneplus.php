<?php

// Создание таблицы
$sql = "CREATE TABLE `oneplus_devices` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `product_line` enum('OnePlus','Nord','Ace','R') NOT NULL,
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
  `warp_charge` varchar(20) DEFAULT NULL,
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
$sql = "INSERT INTO `oneplus_devices` 
(`product_line`, `model_name`, `codename`, `tac_prefix`, `serial_pattern`, `mac_prefix`, 
 `android_min`, `android_max`, `screen_size`, `resolution`, `refresh_rate`, 
 `ram_options`, `storage_options`, `chipset`, `battery_capacity`, `warp_charge`, 
 `release_date`, `is_5g`, `is_current`, `security_patch`) 
VALUES
('OnePlus', 'OnePlus 11 5G', 'CPH2447', '358000', 'OP11%06d', 'C4:2D:5A', '13.0', '17.0', 6.7, '3216x1440', '120Hz', '8GB,16GB', '128GB,256GB,512GB', 'Snapdragon 8 Gen 2', '5000', '100W', '2023-01-04', 1, 1, '2023-12-01'),
('OnePlus', 'OnePlus 11R 5G', 'CPH2487', '358001', 'OP11R%06d', 'C4:2D:5B', '13.0', '17.0', 6.7, '2772x1240', '120Hz', '8GB,16GB', '128GB,256GB', 'Snapdragon 8+ Gen 1', '5000', '100W', '2023-02-07', 1, 1, '2023-12-01'),
('OnePlus', 'OnePlus 10 Pro 5G', 'NE2210', '358002', 'OP10P%06d', 'C4:2D:5C', '12.0', '16.0', 6.7, '3216x1440', '120Hz', '8GB,12GB', '128GB,256GB,512GB', 'Snapdragon 8 Gen 1', '5000', '80W', '2022-01-11', 1, 1, '2023-12-01'),
('Nord', 'OnePlus Nord 3 5G', 'CPH2491', '358003', 'OPN3%06d', 'C4:2D:5D', '13.0', '17.0', 6.7, '2412x1080', '120Hz', '8GB,16GB', '128GB,256GB', 'Dimensity 9000', '5000', '80W', '2023-07-05', 1, 1, '2023-12-01'),
('OnePlus', 'OnePlus 9 Pro 5G', 'LE2120', '358004', 'OP9P%06d', 'C4:2D:5E', '11.0', '14.0', 6.7, '3216x1440', '120Hz', '8GB,12GB', '128GB,256GB', 'Snapdragon 888', '4500', '65W', '2021-03-23', 1, 0, '2023-08-01'),
('Nord', 'OnePlus Nord CE 3 5G', 'CPH2569', '358005', 'OPNCE3%06d', 'C4:2D:5F', '13.0', '17.0', 6.7, '2412x1080', '120Hz', '8GB,12GB', '128GB,256GB', 'Snapdragon 782G', '5000', '80W', '2023-08-04', 1, 1, '2023-12-01'),
('OnePlus', 'OnePlus 8T 5G', 'KB2000', '358006', 'OP8T%06d', 'C4:2D:60', '11.0', '13.0', 6.5, '2400x1080', '120Hz', '8GB,12GB', '128GB,256GB', 'Snapdragon 865', '4500', '65W', '2020-10-14', 1, 0, '2023-06-01'),
('Ace', 'OnePlus Ace 2V', 'PHK110', '358007', 'OPA2V%06d', 'C4:2D:61', '13.0', '17.0', 6.7, '2772x1240', '120Hz', '12GB,16GB', '256GB,512GB', 'Dimensity 9000', '5000', '80W', '2023-03-07', 1, 1, '2023-12-01'),
('OnePlus', 'OnePlus 7 Pro 5G', 'GM1910', '358008', 'OP7P%06d', 'C4:2D:62', '9.0', '12.0', 6.7, '3120x1440', '90Hz', '6GB,8GB,12GB', '128GB,256GB', 'Snapdragon 855', '4000', '30W', '2019-05-14', 1, 0, '2022-12-01'),
('Nord', 'OnePlus Nord 2 5G', 'DN2101', '358009', 'OPN2%06d', 'C4:2D:63', '11.0', '14.0', 6.4, '2400x1080', '90Hz', '6GB,8GB,12GB', '128GB,256GB', 'Dimensity 1200', '4500', '65W', '2021-07-22', 1, 0, '2023-08-01'),
('OnePlus', 'OnePlus 6 5G', 'A6000', '358010', 'OP6%06d', 'C4:2D:64', '8.0', '11.0', 6.3, '2280x1080', '60Hz', '6GB,8GB', '64GB,128GB,256GB', 'Snapdragon 845', '3300', '20W', '2018-05-16', 0, 0, '2021-12-01'),
('R', 'OnePlus 5 5G', 'A5000', '358011', 'OP5%06d', 'C4:2D:65', '7.0', '10.0', 5.5, '1920x1080', '60Hz', '6GB,8GB', '64GB,128GB', 'Snapdragon 835', '3300', 'Dash 20W', '2017-06-20', 0, 0, '2020-12-01'),
('OnePlus', 'OnePlus 10T 5G', 'CPH2415', '358012', 'OP10T%06d', 'C4:2D:66', '12.0', '16.0', 6.7, '2412x1080', '120Hz', '8GB,12GB,16GB', '128GB,256GB', 'Snapdragon 8+ Gen 1', '4800', '150W', '2022-08-03', 1, 1, '2023-12-01'),
('Nord', 'OnePlus Nord 2T 5G', 'DN2103', '358013', 'OPN2T%06d', 'C4:2D:67', '12.0', '16.0', 6.4, '2400x1080', '90Hz', '6GB,8GB,12GB', '128GB,256GB', 'Dimensity 1300', '4500', '80W', '2022-05-19', 1, 1, '2023-12-01'),
('Ace', 'OnePlus Ace Pro 5G', 'PGP110', '358014', 'OPAP%06d', 'C4:2D:68', '12.0', '16.0', 6.7, '2412x1080', '120Hz', '12GB,16GB', '256GB,512GB', 'Snapdragon 8+ Gen 1', '4800', '150W', '2022-08-09', 1, 1, '2023-12-01'),
('OnePlus', 'OnePlus 9 5G', 'LE2110', '358015', 'OP9%06d', 'C4:2D:69', '11.0', '14.0', 6.5, '2400x1080', '120Hz', '8GB,12GB', '128GB,256GB', 'Snapdragon 888', '4500', '65W', '2021-03-23', 1, 0, '2023-08-01'),
('Nord', 'OnePlus Nord CE 2 5G', 'IV2201', '358016', 'OPNCE2%06d', 'C4:2D:70', '11.0', '14.0', 6.4, '2400x1080', '90Hz', '6GB,8GB,12GB', '128GB,256GB', 'Dimensity 900', '4500', '65W', '2022-02-17', 1, 0, '2023-08-01'),
('OnePlus', 'OnePlus 8 5G', 'IN2010', '358017', 'OP8%06d', 'C4:2D:71', '10.0', '13.0', 6.6, '2400x1080', '90Hz', '8GB,12GB', '128GB,256GB', 'Snapdragon 865', '4300', '30W', '2020-04-14', 1, 0, '2023-06-01'),
('R', 'OnePlus 7T 5G', 'HD1900', '358018', 'OP7T%06d', 'C4:2D:72', '10.0', '12.0', 6.6, '2400x1080', '90Hz', '8GB', '128GB,256GB', 'Snapdragon 855+', '3800', '30W', '2019-09-26', 1, 0, '2022-12-01'),
('OnePlus', 'OnePlus 12 5G', 'CPH2581', '358019', 'OP12%06d', 'C4:2D:73', '14.0', '18.0', 6.8, '3168x1440', '120Hz', '12GB,16GB,24GB', '256GB,512GB,1TB', 'Snapdragon 8 Gen 3', '5400', '100W', '2023-12-05', 1, 1, '2023-12-01')";

$result = insert($sql);