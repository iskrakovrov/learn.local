<?php
$sql = "CREATE TABLE IF NOT EXISTS `huawei_devices` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `product_line` enum('HUAWEI','Honor','Mate','P','Nova','Y','Enjoy') NOT NULL,
    `model_name` varchar(50) NOT NULL,
    `codename` varchar(30) NOT NULL,
    `tac_prefix` varchar(8) NOT NULL COMMENT 'Первые 6 цифр IMEI',
    `serial_pattern` varchar(50) DEFAULT NULL,
    `mac_prefix` varchar(8) DEFAULT NULL,
    `android_min` varchar(10) DEFAULT NULL,
    `android_max` varchar(10) DEFAULT NULL,
    `screen_size` decimal(3,1) DEFAULT NULL,
    `resolution` varchar(15) DEFAULT NULL,
    `refresh_rate` varchar(10) DEFAULT '60Hz',
    `ram_options` varchar(50) DEFAULT NULL,
    `storage_options` varchar(50) DEFAULT NULL,
    `chipset` varchar(30) DEFAULT NULL,
    `battery_capacity` varchar(10) DEFAULT NULL,
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

// Первый INSERT с IGNORE для игнорирования дубликатов
$sql = "INSERT IGNORE INTO `huawei_devices` 
    (`product_line`, `model_name`, `codename`, `tac_prefix`, `serial_pattern`, `mac_prefix`, 
     `android_min`, `android_max`, `screen_size`, `resolution`, `refresh_rate`, 
     `ram_options`, `storage_options`, `chipset`, `battery_capacity`, 
     `release_date`, `is_5g`, `is_current`, `security_patch`) 
VALUES
    ('Mate', 'Mate 60 Pro+', 'LNA-AL00', '869000', 'HWM60P%06d', '48:9B:12', '12.0', '14.0', 6.8, '2720x1260', '120Hz', '12GB,16GB', '256GB,512GB,1TB', 'Kirin 9000S', '5000', '2023-08-29', 1, 1, '2023-12-01'),
    ('P', 'P60 Pro', 'LNA-AL10', '869001', 'HWP60P%06d', '48:9B:13', '12.0', '14.0', 6.7, '2700x1220', '120Hz', '8GB,12GB', '256GB,512GB', 'Kirin 9000', '4815', '2023-03-23', 1, 1, '2023-12-01'),
    ('Nova', 'Nova 12 Ultra', 'ANG-AN00', '869002', 'HWN12U%06d', '48:9B:14', '12.0', '14.0', 6.7, '2412x1080', '120Hz', '8GB,12GB', '256GB,512GB', 'Kirin 9000S', '4600', '2023-12-26', 1, 1, '2023-12-01'),
    ('Mate', 'Mate X3', 'ALT-AL00', '869003', 'HWMX3%06d', '48:9B:15', '12.0', '14.0', 7.9, '2496x2224', '120Hz', '12GB,16GB', '256GB,512GB,1TB', 'Kirin 9000', '4800', '2023-04-07', 1, 1, '2023-12-01'),
    ('P', 'P50 Pro', 'JAD-AL50', '869004', 'HWP50P%06d', '48:9B:16', '11.0', '13.0', 6.6, '2700x1228', '120Hz', '8GB,12GB', '128GB,256GB,512GB', 'Kirin 9000', '4360', '2021-07-29', 1, 0, '2023-08-01'),
    ('Mate', 'Mate 40 Pro', 'NOH-AN00', '869005', 'HWM40P%06d', '48:9B:17', '10.0', '12.0', 6.8, '2772x1344', '90Hz', '8GB,12GB', '128GB,256GB,512GB', 'Kirin 9000', '4400', '2020-10-22', 1, 0, '2023-06-01'),
    ('Nova', 'Nova 11 Pro', 'GOA-AL00', '869006', 'HWN11P%06d', '48:9B:18', '12.0', '14.0', 6.7, '2412x1080', '120Hz', '8GB,12GB', '256GB,512GB', 'Snapdragon 778G', '4500', '2023-04-17', 1, 1, '2023-12-01'),
    ('Honor', 'Honor 90 Pro', 'REA-AN00', '869007', 'HON90P%06d', '48:9B:19', '12.0', '14.0', 6.7, '2640x1200', '120Hz', '8GB,12GB,16GB', '256GB,512GB', 'Snapdragon 8+ Gen 1', '5000', '2023-05-29', 1, 1, '2023-12-01'),
    ('Mate', 'Mate 50 Pro', 'DCO-AL00', '869008', 'HWM50P%06d', '48:9B:20', '12.0', '14.0', 6.7, '2616x1212', '120Hz', '8GB,12GB', '256GB,512GB', 'Snapdragon 8+ Gen 1', '4700', '2022-09-06', 1, 1, '2023-12-01'),
    ('P', 'P40 Pro+', 'ELS-AN00', '869009', 'HWP40P%06d', '48:9B:21', '10.0', '12.0', 6.6, '2640x1200', '90Hz', '8GB,12GB', '256GB,512GB', 'Kirin 990', '4200', '2020-04-07', 1, 0, '2023-04-01'),
    ('Y', 'Y90', 'CTR-AN00', '869010', 'HWY90%06d', '48:9B:22', '12.0', '14.0', 6.7, '2400x1080', '144Hz', '8GB,12GB', '128GB,256GB', 'Snapdragon 888', '4300', '2022-02-28', 1, 0, '2023-10-01'),
    ('Enjoy', 'Enjoy 50 Pro', 'FNE-AN00', '869011', 'HWE50P%06d', '48:9B:23', '12.0', '14.0', 6.7, '2388x1080', '90Hz', '6GB,8GB', '128GB,256GB', 'Snapdragon 680', '5000', '2022-06-06', 0, 1, '2023-12-01'),
    ('Nova', 'Nova 10 Pro', 'GLA-AL00', '869012', 'HWN10P%06d', '48:9B:24', '12.0', '14.0', 6.7, '2652x1200', '120Hz', '8GB,12GB', '128GB,256GB', 'Snapdragon 778G', '4500', '2022-07-04', 1, 1, '2023-12-01'),
    ('Mate', 'Mate Xs 2', 'PAL-AL00', '869013', 'HWMXS2%06d', '48:9B:25', '12.0', '14.0', 7.8, '2480x2200', '120Hz', '8GB,12GB', '256GB,512GB', 'Snapdragon 888', '4880', '2022-04-28', 1, 1, '2023-12-01'),
    ('P', 'Pocket S', 'BAL-AL00', '869014', 'HWPS%06d', '48:9B:26', '12.0', '14.0', 6.9, '2790x1188', '120Hz', '8GB,12GB', '128GB,256GB,512GB', 'Kirin 9000', '4000', '2022-11-02', 1, 1, '2023-12-01'),
    ('Honor', 'Honor Magic5 Pro', 'PGT-AN00', '869015', 'HOM5P%06d', '48:9B:27', '13.0', '15.0', 6.8, '2848x1312', '120Hz', '8GB,12GB,16GB', '256GB,512GB', 'Snapdragon 8 Gen 2', '5450', '2023-02-27', 1, 1, '2023-12-01'),
    ('Nova', 'Nova 9 Pro', 'NAM-AL00', '869016', 'HWN9P%06d', '48:9B:28', '11.0', '13.0', 6.7, '2676x1236', '120Hz', '8GB,12GB', '128GB,256GB', 'Snapdragon 778G', '4000', '2021-09-23', 1, 0, '2023-08-01'),
    ('Mate', 'Mate 30 Pro', 'LIO-AN00', '869017', 'HWM30P%06d', '48:9B:29', '10.0', '12.0', 6.5, '2400x1176', '60Hz', '8GB,12GB', '128GB,256GB,512GB', 'Kirin 990', '4500', '2019-09-19', 1, 0, '2023-02-01'),
    ('P', 'P30 Pro', 'VOG-AL00', '869018', 'HWP30P%06d', '48:9B:30', '9.0', '11.0', 6.5, '2340x1080', '60Hz', '6GB,8GB', '128GB,256GB,512GB', 'Kirin 980', '4200', '2019-03-26', 0, 0, '2022-12-01'),
    ('Honor', 'Honor 70 Pro+', 'FNE-AN00', '869019', 'HON70P%06d', '48:9B:31', '12.0', '14.0', 6.7, '2412x1080', '120Hz', '8GB,12GB', '256GB,512GB', 'Dimensity 8000', '4500', '2022-05-30', 1, 1, '2023-12-01')";

$result = insert($sql);

// Последующие INSERT-запросы также с IGNORE
$sql = "INSERT IGNORE INTO `huawei_devices` 
    (`product_line`, `model_name`, `codename`, `tac_prefix`, `serial_pattern`, `mac_prefix`, 
     `android_min`, `android_max`, `screen_size`, `resolution`, `refresh_rate`, 
     `ram_options`, `storage_options`, `chipset`, `battery_capacity`, 
     `release_date`, `is_5g`, `is_current`, `security_patch`) 
VALUES
    ('P', 'P30 Pro', 'VOG-L29', '861234', 'P30P-%04d%04d', 'A0:C1:D2', '9.0', '12.0', 6.47, '2340x1080', '60Hz', '8GB', '128GB,256GB,512GB', 'Kirin 980', '4200', '2019-03-26', 0, 0, '2021-12-01'),
    ('P', 'P30', 'ELE-L29', '861235', 'P30-%04d%04d', 'A0:C1:D3', '9.0', '12.0', 6.1, '2340x1080', '60Hz', '6GB,8GB', '64GB,128GB,256GB', 'Kirin 980', '3650', '2019-03-26', 0, 0, '2021-12-01'),
    ('Mate', 'Mate 30 Pro', 'LIO-L29', '861236', 'M30P-%04d%04d', 'A0:C1:D4', '10.0', '12.0', 6.53, '2400x1176', '60Hz', '8GB', '128GB,256GB', 'Kirin 990', '4500', '2019-09-19', 1, 0, '2022-06-01'),
    ('Mate', 'Mate 20 Pro', 'LYA-L29', '861237', 'M20P-%04d%04d', 'A0:C1:D5', '9.0', '11.0', 6.39, '3120x1440', '60Hz', '6GB,8GB', '128GB,256GB', 'Kirin 980', '4200', '2018-10-16', 0, 0, '2021-06-01'),
    ('P', 'P40 Pro', 'ELS-N29', '861238', 'P40P-%04d%04d', 'A0:C1:D6', '10.0', '12.0', 6.58, '2640x1200', '90Hz', '8GB', '128GB,256GB,512GB', 'Kirin 990', '4200', '2020-03-26', 1, 0, '2022-12-01')";

$result = insert($sql);

$sql = "INSERT IGNORE INTO `huawei_devices` (`product_line`, `model_name`, `codename`, `tac_prefix`, `serial_pattern`, `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, `refresh_rate`, `ram_options`, `storage_options`, `chipset`, `battery_capacity`, `release_date`, `is_5g`, `is_current`, `security_patch`) VALUES
('Nova', 'Nova 5T', 'YAL-L21', '861345', 'N5T-%04d%04d', 'A0:C2:D1', '9.0', '11.0', 6.26, '2340x1080', '60Hz', '6GB,8GB', '128GB', 'Kirin 980', '3750', '2019-08-23', 0, 0, '2021-12-01'),
('Nova', 'Nova 7i', 'JNY-L21', '861346', 'N7I-%04d%04d', 'A0:C2:D2', '10.0', '12.0', 6.4, '2310x1080', '60Hz', '8GB', '128GB', 'Kirin 810', '4200', '2020-02-14', 0, 0, '2022-06-01'),
('Nova', 'Nova 5 Pro', 'SEA-AL10', '861347', 'N5P-%04d%04d', 'A0:C2:D3', '9.0', '11.0', 6.39, '2340x1080', '60Hz', '8GB', '128GB,256GB', 'Kirin 980', '3500', '2019-06-21', 0, 0, '2021-12-01')";
$result = insert($sql);

$sql = "INSERT IGNORE INTO `huawei_devices` (`product_line`, `model_name`, `codename`, `tac_prefix`, `serial_pattern`, `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, `refresh_rate`, `ram_options`, `storage_options`, `chipset`, `battery_capacity`, `release_date`, `is_5g`, `is_current`, `security_patch`) VALUES
('Y', 'Y9 Prime 2019', 'STK-L21', '861456', 'Y9P-%04d%04d', 'A0:C3:D1', '9.0', '10.0', 6.59, '2340x1080', '60Hz', '4GB', '64GB,128GB', 'Kirin 710F', '4000', '2019-07-20', 0, 0, '2020-12-01'),
('Y', 'Y7 Pro 2019', 'DUB-LX3', '861457', 'Y7P-%04d%04d', 'A0:C3:D2', '9.0', '10.0', 6.26, '1520x720', '60Hz', '3GB,4GB', '32GB,64GB', 'Snapdragon 450', '4000', '2019-02-01', 0, 0, '2020-12-01'),
('Y', 'Y6 Pro 2019', 'MED-LX9', '861458', 'Y6P-%04d%04d', 'A0:C3:D3', '9.0', '10.0', 6.09, '1560x720', '60Hz', '3GB', '64GB', 'Mediatek MT6761', '3020', '2019-04-25', 0, 0, '2020-12-01')";
$result = insert($sql);

$sql="INSERT IGNORE INTO `huawei_devices` (`product_line`, `model_name`, `codename`, `tac_prefix`, `serial_pattern`, `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, `refresh_rate`, `ram_options`, `storage_options`, `chipset`, `battery_capacity`, `release_date`, `is_5g`, `is_current`, `security_patch`) VALUES
('Enjoy', 'Enjoy 20 Pro', 'CDY-AN90', '861567', 'EY20P-%04d%04d', 'A0:C4:D1', '10.0', '12.0', 6.5, '2400x1080', '60Hz', '6GB,8GB', '128GB', 'Dimensity 800', '4000', '2020-06-19', 1, 0, '2022-06-01'),
('Enjoy', 'Enjoy 10 Plus', 'STK-AL00', '861568', 'EY10P-%04d%04d', 'A0:C4:D2', '9.0', '11.0', 6.59, '2340x1080', '60Hz', '4GB,6GB', '64GB,128GB', 'Kirin 710F', '4000', '2019-09-05', 0, 0, '2021-06-01')";
$result = insert($sql);

$sql="INSERT IGNORE INTO `huawei_devices` (`product_line`, `model_name`, `codename`, `tac_prefix`, `serial_pattern`, `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, `refresh_rate`, `ram_options`, `storage_options`, `chipset`, `battery_capacity`, `release_date`, `is_5g`, `is_current`, `security_patch`) VALUES
('Honor', 'Honor 20 Pro', 'YAL-L41', '861678', 'H20P-%04d%04d', 'A0:C5:D1', '9.0', '11.0', 6.26, '2340x1080', '60Hz', '8GB', '256GB', 'Kirin 980', '4000', '2019-05-21', 0, 0, '2021-12-01'),
('Honor', 'Honor 9X', 'STK-LX1', '861679', 'H9X-%04d%04d', 'A0:C5:D2', '9.0', '11.0', 6.59, '2340x1080', '60Hz', '4GB,6GB', '64GB,128GB', 'Kirin 710F', '4000', '2019-07-23', 0, 0, '2021-06-01'),
('Honor', 'Honor 10', 'COL-AL10', '861680', 'H10-%04d%04d', 'A0:C5:D3', '8.1', '10.0', 5.84, '2280x1080', '60Hz', '4GB,6GB', '64GB,128GB', 'Kirin 970', '3400', '2018-04-19', 0, 0, '2020-12-01'),
('Honor', 'Honor 8X', 'JSN-L21', '861681', 'H8X-%04d%04d', 'A0:C5:D4', '8.1', '10.0', 6.5, '2340x1080', '60Hz', '4GB,6GB', '64GB,128GB', 'Kirin 710', '3750', '2018-09-05', 0, 0, '2020-12-01');";
$result = insert($sql);