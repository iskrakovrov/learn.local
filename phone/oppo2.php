<?php

$sql="INSERT IGNORE INTO `oppo_devices` (`product_line`, `model_name`, `codename`, `tac_prefix`, `serial_pattern`, `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, `refresh_rate`, `ram_options`, `storage_options`, `chipset`, `battery_capacity`, `fast_charge`, `release_date`, `is_5g`, `is_current`, `security_patch`) VALUES
('Find X', 'Find X2 Pro', 'CPH2025', '861234', 'OPFX2P%06d', 'A0:B1:C2', '10.0', '12.0', 6.7, '3168x1440', '120Hz', '12GB', '256GB,512GB', 'Snapdragon 865', '4260', '65W', '2020-03-06', 1, 0, '2022-12-01'),
('Find X', 'Find X2', 'CPH2023', '861235', 'OPFX2%06d', 'A0:B1:C3', '10.0', '12.0', 6.7, '3168x1440', '120Hz', '8GB,12GB', '128GB,256GB', 'Snapdragon 865', '4200', '65W', '2020-03-06', 1, 0, '2022-12-01'),
('Find X', 'Find X', 'PAHM00', '861236', 'OPFX%06d', 'A0:B1:C4', '9.0', '10.0', 6.4, '2340x1080', '60Hz', '8GB', '128GB,256GB', 'Snapdragon 845', '3730', '50W', '2018-06-19', 0, 0, '2021-06-01')";
$result = insert($sql);

$sql="INSERT IGNORE INTO `oppo_devices` (`product_line`, `model_name`, `codename`, `tac_prefix`, `serial_pattern`, `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, `refresh_rate`, `ram_options`, `storage_options`, `chipset`, `battery_capacity`, `fast_charge`, `release_date`, `is_5g`, `is_current`, `security_patch`) VALUES
('Reno', 'Reno 10x Zoom', 'CPH1919', '861345', 'OPR10Z%06d', 'A0:B2:C1', '9.0', '11.0', 6.6, '2340x1080', '60Hz', '6GB,8GB', '128GB,256GB', 'Snapdragon 855', '4065', '20W', '2019-04-24', 0, 0, '2021-12-01'),
('Reno', 'Reno 2', 'CPH1907', '861346', 'OPR2%06d', 'A0:B2:C2', '9.0', '11.0', 6.5, '2400x1080', '60Hz', '8GB', '128GB,256GB', 'Snapdragon 730G', '4000', '20W', '2019-08-28', 0, 0, '2021-12-01'),
('Reno', 'Reno 3 Pro', 'CPH2035', '861347', 'OPR3P%06d', 'A0:B2:C3', '10.0', '12.0', 6.5, '2400x1080', '90Hz', '8GB,12GB', '128GB,256GB', 'Mediatek P95', '4025', '30W', '2019-12-31', 1, 0, '2022-06-01'),
('Reno', 'Reno 4 Pro', 'CPH2109', '861348', 'OPR4P%06d', 'A0:B2:C4', '10.0', '12.0', 6.5, '2400x1080', '90Hz', '8GB,12GB', '128GB,256GB', 'Snapdragon 720G', '4000', '65W', '2020-06-05', 1, 0, '2022-12-01')";
$result = insert($sql);

$sql="INSERT IGNORE INTO `oppo_devices` (`product_line`, `model_name`, `codename`, `tac_prefix`, `serial_pattern`, `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, `refresh_rate`, `ram_options`, `storage_options`, `chipset`, `battery_capacity`, `fast_charge`, `release_date`, `is_5g`, `is_current`, `security_patch`) VALUES
('A', 'A9 2020', 'CPH1937', '861456', 'OPA920%06d', 'A0:B3:C1', '9.0', '11.0', 6.5, '1600x720', '60Hz', '4GB,8GB', '128GB', 'Snapdragon 665', '5000', '18W', '2019-09-16', 0, 0, '2021-12-01'),
('A', 'A5 2020', 'CPH1931', '861457', 'OPA520%06d', 'A0:B3:C2', '9.0', '11.0', 6.5, '1600x720', '60Hz', '3GB,4GB', '64GB,128GB', 'Mediatek P35', '5000', '10W', '2019-04-20', 0, 0, '2021-06-01'),
('A', 'A91', 'CPH2021', '861458', 'OPA91%06d', 'A0:B3:C3', '10.0', '12.0', 6.4, '2400x1080', '60Hz', '8GB', '128GB', 'Mediatek P70', '4025', '20W', '2019-12-20', 0, 0, '2022-06-01'),
('A', 'A31 2020', 'CPH2015', '861459', 'OPA31%06d', 'A0:B3:C4', '9.0', '11.0', 6.5, '1600x720', '60Hz', '4GB', '64GB,128GB', 'Mediatek P35', '4230', '10W', '2020-02-14', 0, 0, '2021-12-01')";
$result = insert($sql);

$sql="INSERT IGNORE INTO `oppo_devices` (`product_line`, `model_name`, `codename`, `tac_prefix`, `serial_pattern`, `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, `refresh_rate`, `ram_options`, `storage_options`, `chipset`, `battery_capacity`, `fast_charge`, `release_date`, `is_5g`, `is_current`, `security_patch`) VALUES
('K', 'K3', 'PCGM00', '861567', 'OPK3%06d', 'A0:B4:C1', '9.0', '10.0', 6.5, '2340x1080', '60Hz', '6GB,8GB', '64GB,128GB', 'Snapdragon 710', '3765', '20W', '2019-05-23', 0, 0, '2021-06-01'),
('K', 'K5', 'PCNM00', '861568', 'OPK5%06d', 'A0:B4:C2', '9.0', '11.0', 6.4, '2340x1080', '60Hz', '6GB,8GB', '128GB,256GB', 'Snapdragon 730G', '4000', '30W', '2019-10-14', 0, 0, '2021-12-01'),
('K', 'K7 5G', 'PDKM00', '861569', 'OPK75%06d', 'A0:B4:C3', '10.0', '12.0', 6.4, '2400x1080', '60Hz', '8GB', '128GB,256GB', 'Snapdragon 765G', '4025', '30W', '2020-08-11', 1, 0, '2022-06-01')";
$result = insert($sql);

$sql="INSERT IGNORE INTO `oppo_devices` (`product_line`, `model_name`, `codename`, `tac_prefix`, `serial_pattern`, `mac_prefix`, `android_min`, `android_max`, `screen_size`, `resolution`, `refresh_rate`, `ram_options`, `storage_options`, `chipset`, `battery_capacity`, `fast_charge`, `release_date`, `is_5g`, `is_current`, `security_patch`) VALUES
('F', 'F15', 'CPH2001', '861678', 'OPF15%06d', 'A0:B5:C1', '9.0', '11.0', 6.4, '2400x1080', '60Hz', '4GB,8GB', '64GB,128GB', 'Mediatek P70', '4025', '20W', '2020-01-16', 0, 0, '2021-12-01'),
('F', 'F17 Pro', 'CPH2095', '861679', 'OPF17P%06d', 'A0:B5:C2', '10.0', '12.0', 6.4, '2400x1080', '60Hz', '8GB', '128GB', 'Mediatek P95', '4015', '30W', '2020-09-02', 0, 0, '2022-06-01'),
('F', 'F11 Pro', 'CPH1969', '861680', 'OPF11P%06d', 'A0:B5:C3', '9.0', '11.0', 6.5, '2340x1080', '60Hz', '6GB', '64GB,128GB', 'Mediatek P70', '4000', '20W', '2019-03-15', 0, 0, '2021-12-01')";
$result = insert($sql);