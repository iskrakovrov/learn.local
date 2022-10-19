<?php
CREATE TABLE `admin_facebook`.`groups_fb` ( `id` INT(11) NOT NULL , `id_fb` INT(25) NOT NULL , `name` VARCHAR(255) NOT NULL ) ENGINE = InnoDB;
CREATE TABLE `admin_facebook`.`acc_group` ( `id` INT NOT NULL AUTO_INCREMENT , `account` INT NOT NULL , `id_gr` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;