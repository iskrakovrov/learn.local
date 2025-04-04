<?php

// Создание таблицы
$sql = "CREATE TABLE `oppo_devices` (
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `model_name` (`model_name`),
  KEY `product_line` (`product_line`),
  KEY `release_date` (`release_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$result = create($sql);

// Вставка данных с явным указанием колонок
$sql = "INSERT INTO `oppo_devices` 
(`product_line`, `model_name`, `codename`, `tac_prefix`, `serial_pattern`, `mac_prefix`, 
 `android_min`, `android_max`, `screen_size`, `resolution`, `refresh_rate`, 
 `ram_options`, `storage_options`, `chipset`, `battery_capacity`, `fast_charge`, 
 `release_date`, `is_5g`, `is_current`, `security_patch`) 
VALUES
('Find X', 'Find X6 Pro', 'PGEM10', '861000', 'OPX6P%06d', 'D4:6A:6A', '13.0', '17.0', 6.8, '3168x1440', '120Hz', '12GB,16GB', '256GB,512GB', 'Snapdragon 8 Gen 2', '5000', '100W', '2023-03-21', 1, 1, '2023-12-01'),
('Reno', 'Reno 10 Pro+', 'PHU110', '861001', 'OPR10P%06d', 'D4:6A:6B', '13.0', '17.0', 6.7, '2772x1240', '120Hz', '12GB,16GB', '256GB,512GB', 'Snapdragon 8+ Gen 1', '4700', '100W', '2023-07-08', 1, 1, '2023-12-01'),
('Find X', 'Find X5 Pro', 'PFEM10', '861002', 'OPX5P%06d', 'D4:6A:6C', '12.0', '16.0', 6.7, '3216x1440', '120Hz', '8GB,12GB', '256GB,512GB', 'Snapdragon 8 Gen 1', '5000', '80W', '2022-02-24', 1, 1, '2023-12-01'),
('Reno', 'Reno 8 Pro', 'PFDM00', '861003', 'OPR8P%06d', 'D4:6A:6D', '12.0', '16.0', 6.7, '2412x1080', '120Hz', '8GB,12GB', '128GB,256GB', 'Dimensity 8100', '4500', '80W', '2022-05-23', 1, 1, '2023-12-01'),
('A', 'A98 5G', 'PHJ110', '861004', 'OPA98%06d', 'D4:6A:6E', '13.0', '17.0', 6.7, '2400x1080', '120Hz', '8GB,12GB', '128GB,256GB', 'Snapdragon 695', '5000', '67W', '2023-04-14', 1, 1, '2023-12-01'),
('Find X', 'Find X3 Pro', 'CPH2173', '861005', 'OPX3P%06d', 'D4:6A:6F', '11.0', '14.0', 6.7, '3216x1440', '120Hz', '8GB,12GB', '256GB,512GB', 'Snapdragon 888', '4500', '65W', '2021-03-11', 1, 0, '2023-08-01'),
('Reno', 'Reno 6 Pro+', 'PEPM00', '861006', 'OPR6P%06d', 'D4:6A:70', '11.0', '14.0', 6.5, '2400x1080', '90Hz', '8GB,12GB', '128GB,256GB', 'Snapdragon 870', '4500', '65W', '2021-07-05', 1, 0, '2023-08-01'),
('K', 'K10 5G', 'PGZ110', '861007', 'OPK10%06d', 'D4:6A:71', '12.0', '16.0', 6.6, '2412x1080', '120Hz', '6GB,8GB,12GB', '128GB,256GB', 'Dimensity 8000', '5000', '67W', '2022-04-24', 1, 1, '2023-12-01'),
('Find N', 'Find N2 Flip', 'PGU110', '861008', 'OPNF%06d', 'D4:6A:72', '13.0', '17.0', 6.8, '2520x1080', '120Hz', '8GB,16GB', '256GB,512GB', 'Dimensity 9000+', '4300', '44W', '2022-12-15', 1, 1, '2023-12-01'),
('Reno', 'Reno 5 5G', 'PDSM00', '861009', 'OPR5%06d', 'D4:6A:73', '11.0', '14.0', 6.4, '2400x1080', '90Hz', '8GB,12GB', '128GB,256GB', 'Snapdragon 765G', '4300', '65W', '2020-12-10', 1, 0, '2023-06-01'),
('A', 'A77 5G', 'CPH2359', '861010', 'OPA77%06d', 'D4:6A:74', '12.0', '16.0', 6.6, '2400x1080', '90Hz', '6GB,8GB', '128GB,256GB', 'Dimensity 810', '5000', '33W', '2022-06-15', 1, 0, '2023-12-01'),
('F', 'F21 Pro 5G', 'CPH2513', '861011', 'OPF21%06d', 'D4:6A:75', '12.0', '16.0', 6.4, '2400x1080', '90Hz', '8GB,12GB', '128GB,256GB', 'Snapdragon 695', '4500', '67W', '2022-04-12', 1, 1, '2023-12-01'),
('Find X', 'Find X2 Pro', 'CPH2025', '861012', 'OPX2P%06d', 'D4:6A:76', '10.0', '13.0', 6.7, '3168x1440', '120Hz', '8GB,12GB', '256GB,512GB', 'Snapdragon 865', '4260', '65W', '2020-03-06', 1, 0, '2023-04-01'),
('Reno', 'Reno 4 Pro', 'PDNM00', '861013', 'OPR4P%06d', 'D4:6A:77', '10.0', '13.0', 6.5, '2400x1080', '90Hz', '8GB,12GB', '128GB,256GB', 'Snapdragon 765G', '4000', '65W', '2020-06-05', 1, 0, '2023-06-01'),
('Pad', 'Pad 2', 'OPD2202', '861014', 'OPP2%06d', 'D4:6A:78', '13.0', '17.0', 11.6, '2800x2000', '144Hz', '8GB,12GB', '128GB,256GB,512GB', 'Dimensity 9000', '9510', '67W', '2023-07-01', 1, 1, '2023-12-01'),
('Find X', 'Find N', 'PEUM00', '861015', 'OPN%06d', 'D4:6A:79', '11.0', '14.0', 7.1, '1792x1920', '120Hz', '8GB,12GB', '256GB,512GB', 'Snapdragon 888', '4500', '33W', '2021-12-15', 1, 0, '2023-08-01'),
('Reno', 'Reno 7 5G', 'PFDM00', '861016', 'OPR7%06d', 'D4:6A:80', '12.0', '16.0', 6.4, '2400x1080', '90Hz', '8GB,12GB', '128GB,256GB', 'Dimensity 900', '4500', '60W', '2021-11-25', 1, 0, '2023-08-01'),
('A', 'A96 5G', 'CPH2303', '861017', 'OPA96%06d', 'D4:6A:81', '12.0', '16.0', 6.6, '2412x1080', '120Hz', '6GB,8GB,12GB', '128GB,256GB', 'Snapdragon 695', '5000', '33W', '2022-01-10', 1, 0, '2023-12-01'),
('K', 'K9 5G', 'PEXM00', '861018', 'OPK9%06d', 'D4:6A:82', '11.0', '14.0', 6.4, '2400x1080', '90Hz', '6GB,8GB', '128GB,256GB', 'Snapdragon 768G', '4300', '60W', '2021-05-06', 1, 0, '2023-08-01'),
('Find X', 'Find X5 Lite', 'CPH2371', '861019', 'OPX5L%06d', 'D4:6A:83', '12.0', '16.0', 6.4, '2400x1080', '90Hz', '8GB,12GB', '128GB,256GB', 'Dimensity 900', '4500', '65W', '2022-02-24', 1, 1, '2023-12-01')";

$result = insert($sql);