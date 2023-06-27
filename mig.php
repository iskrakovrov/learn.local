<?php
require_once('inc/version.php');
$sql = "SELECT * FROM options";
$qw = select($sql);
$ver = $qw['ver'];
if (is_null($ver)) {
    $sql = "SHOW COLUMNS FROM options WHERE FIELD = 'ver'";
    $qw = create($sql);
    if (empty($qw)) {
        $sql = "ALTER TABLE `options` ADD `ver` VARCHAR(25) NULL AFTER `proxy`";
        $qw = create($sql);
        header('Location: new.php');
        exit();
    }

    $sql = "UPDATE options SET ver = ?";
    $args = [$vers];
    $qw = update($sql, $args);
    header('Location: new.php');
    exit();
}
$sql = "UPDATE options SET ver = ?";
$args = [$vers];
$qw = update($sql, $args);

$sql = "SHOW COLUMNS FROM groups_fb WHERE FIELD = 'url'";
$qw = create($sql);
if (empty($qw)) {
    $sql = "ALTER TABLE `groups_fb` ADD `url` VARCHAR(255) NULL AFTER `name`, ADD `count` INT(11) NULL AFTER `url`";
    $qw = create($sql);
    $sql = "ALTER TABLE `groups_fb` CHANGE `id_fb` `id_fb` INT(25) NULL";
    $qw = create($sql);
}
$sql = "SHOW TABLES LIKE 'login_change'";
$qw = create($sql);
if (empty($qw)) {


    $sql = "CREATE TABLE `login_change` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `old_l` VARCHAR(255) NOT NULL , `new_l` VARCHAR(255) NOT NULL , `created` INT(25) NOT NULL , `id_acc` INT(11) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB";
    $qw = create($sql);
}
$sql = "SHOW COLUMNS FROM posts WHERE FIELD = 'tipe'";
$qw = create($sql);
if (empty($qw)) {
    $sql = "ALTER TABLE `posts` ADD `tipe` INT(5) NOT NULL AFTER `img`";
    $qw = create($sql);

}

$sql = "ALTER TABLE `posts` CHANGE `img` `img` VARCHAR(255) NULL DEFAULT NULL";
$qw = create($sql);

$sql = "SELECT id FROM cat_lists WHERE `cat` = 11";
$qw = select($sql);
if (!$qw) {
    $sql = "INSERT INTO `cat_lists` (`id`, `cat`, `name`) VALUES (11, '11', 'URL List')";
    $qw = insert($sql);
}

$sql = "SHOW TABLES LIKE 'posting'";
$qw = create($sql);
if (empty($qw)) {


    $sql = "CREATE TABLE `posting` (`id` INT NOT NULL AUTO_INCREMENT , `id_acc` INT NOT NULL , `id_post` INT NOT NULL , `target` INT NULL , `created` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $qw = create($sql);
}
$sql = "SHOW TABLES LIKE 'stat_post'";
$qw = create($sql);
if (empty($qw)) {


    $sql = "CREATE TABLE `stat_post` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `id_acc` INT(11) NOT NULL , `id_post` INT(11) NOT NULL , `target` VARCHAR(255) NULL , `created` INT(25) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $qw = create($sql);
}
$sql = $sql = "SHOW COLUMNS FROM options WHERE FIELD = 'change_proxy'";
$qw = create($sql);
if (empty($qw)) {
    $sql = "ALTER TABLE `options` ADD `change_proxy` INT(2) NOT NULL AFTER `ver`;";
    $qw = create($sql);

}
$sql = "SELECT * FROM status WHERE id = 18";
$qw = select($sql);
if (empty($qw)) {
    $sql = "INSERT INTO `status` (`id`, `status`) VALUES ('18', 'bad proxy')";
    $qw = insert($sql);
}
$sql = "SHOW TABLES LIKE 'likes'";
$qw = create($sql);
if (empty($qw)) {


    $sql = "CREATE TABLE `likes` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `create` INT(25) NOT NULL , `id_acc` INT(11) NOT NULL , `cat` INT(11) NOT NULL , `id_v` INT(11) NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $qw = create($sql);
}
$sql = "SHOW TABLES LIKE 'stat_comm'";
$qw = create($sql);
if (empty($qw)) {


    $sql = "CREATE TABLE `stat_comm` ( `id` INT NOT NULL AUTO_INCREMENT , `id_acc` INT NOT NULL , `id_post` INT NOT NULL , `target` INT NOT NULL , `created` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $qw = create($sql);
}

$sql = "SHOW TABLES LIKE 'stat_sugg'";
$qw = create($sql);
if (empty($qw)) {


    $sql = "CREATE TABLE `stat_sugg` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `id_acc` INT(11) NOT NULL , `created` INT(25) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $qw = create($sql);
}

$sql = "SHOW TABLES LIKE 'workzp'";
$qw = create($sql);
if (empty($qw)) {


    $sql = "CREATE TABLE `workzp` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `instance` INT(11) NOT NULL , `id_acc` INT(11) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $qw = create($sql);
}
$sql = "SELECT * FROM status WHERE id = 19";
$qw = select($sql);
if (empty($qw)) {
    $sql = "INSERT INTO `status` (`id`, `status`) VALUES ('19', 'NEW')";
    $qw = insert($sql);
}
$sql = "SHOW TABLES LIKE 'change_login'";
$qw = create($sql);
if (empty($qw)) {

    $sql = "CREATE TABLE `change_login` ( `id` INT NOT NULL AUTO_INCREMENT , `old_login` VARCHAR(255) NOT NULL , `new_login` VARCHAR(255) NOT NULL , `id_acc` INT(11) NOT NULL , `created` INT(25) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB";
    $qw = create($sql);
}

$sql = "SHOW TABLES LIKE 'stat_parse'";
$qw = create($sql);
if (empty($qw)) {

    $sql = "CREATE TABLE `stat_parse` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `id_url` INT(11) NOT NULL , `created` INT(26) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $qw = create($sql);
}

$sql = "SHOW COLUMNS FROM stat_parse WHERE FIELD = 'cat'";
$qw = create($sql);
if (empty($qw)) {
    $sql = "ALTER TABLE `stat_parse` ADD `cat` INT(11) NOT NULL AFTER `id_url`;";
    $qw = create($sql);
}
$sql = "SHOW COLUMNS FROM change_login WHERE FIELD = 'id_fb'";
$qw = create($sql);
if (empty($qw)) {
    $sql = "ALTER TABLE `change_login` ADD `id_fb` BIGINT NULL AFTER `created`";
    $qw = create($sql);
    $sql = "ALTER TABLE `change_password` ADD `id_fb` BIGINT NULL AFTER `created`";
    $qw = create($sql);
}
$sql = "SHOW COLUMNS FROM change_mail WHERE FIELD = 'id_fb'";
$qw = create($sql);
if (empty($qw)) {
    $sql = "ALTER TABLE `change_mail` ADD `id_fb` BIGINT NOT NULL AFTER `new_mail_pass`";
    $qw = create($sql);

}

$sql = "SHOW TABLES LIKE 'templates'";
$qw = create($sql);

if (empty($qw)) {

    $sql = "CREATE TABLE `templates` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `name` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`), UNIQUE (`name`)) ENGINE = InnoDB;";
    $qw = create($sql);
}

$sql = "SHOW TABLES LIKE 'template'";
$qw = create($sql);

if (empty($qw)) {

    $sql = "CREATE TABLE `template` ( `id` INT NOT NULL AUTO_INCREMENT , `id_template` INT NOT NULL , `task` VARCHAR(25) NOT NULL , `setup` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $qw = create($sql);
}

$sql = "SHOW TABLES LIKE 'oai'";
$qw = create($sql);

if (empty($qw)) {

    $sql = "CREATE TABLE `oai` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `code` VARCHAR(100) NOT NULL , `status` INT(2) NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB";
    $qw = create($sql);
}
$sql = "SELECT * FROM cat_lists WHERE id = 12";
$qw = select($sql);
if (empty($qw)) {
    $sql = "INSERT INTO `cat_lists` (`id`, `cat`, `name`) VALUES ('12', '12', 'Chat GPT Prompts')";
    $qw = insert($sql);
}
$sql = "SHOW TABLES LIKE 'commentoai'";
$qw = create($sql);

if (empty($qw)) {

    $sql = "CREATE TABLE `commentoai` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `url_post` VARCHAR(255) NOT NULL , `text_post` TEXT NOT NULL , `comment` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $qw = create($sql);
    $sql = "ALTER TABLE `commentoai` ADD `id_acc` INT(11) NOT NULL AFTER `comment`;";
    $qw = create($sql);
}

$sql = "SELECT * FROM status WHERE id = 20";
$qw = select($sql);
if (empty($qw)) {
    $sql = "INSERT INTO `status` (`id`, `status`) VALUES ('20', 'TimeOut')";
    $qw = insert($sql);
}
$sql = "SHOW COLUMNS FROM commentoai WHERE FIELD = 'posted'";
$qw = create($sql);
if (empty($qw)) {
    $sql = "ALTER TABLE `commentoai` ADD `posted` INT(2) NULL AFTER `id_acc`";
    $qw = create($sql);
}
$sql = "SHOW COLUMNS FROM oai WHERE FIELD = 'usage'";
$qw = create($sql);
if (empty($qw)) {
    $sql = "ALTER TABLE `oai` ADD `usage` VARCHAR(255) NULL AFTER `status`";
    $qw = create($sql);
}
$sql = "SHOW COLUMNS FROM commentoai WHERE FIELD = 'created'";
$qw = create($sql);
if (empty($qw)) {
    $sql = "ALTER TABLE `commentoai` ADD `created` int(25) NULL AFTER `posted`";
    $qw = create($sql);
}
$sql = "SHOW COLUMNS FROM accounts WHERE FIELD = 'ar'";
$qw = create($sql);
if (empty($qw)) {
    $sql = "ALTER TABLE `accounts` ADD `bid` INT(25) NULL AFTER `adv`, ADD `ar` INT(11) NULL AFTER `bid`;";
    $qw = create($sql);
    $sql = "ALTER TABLE `accounts` CHANGE `bid` `bid` VARCHAR(255) NULL DEFAULT NULL;";
    $qw = create($sql);
}
$sql = "SHOW TABLES LIKE 'note'";
$qw = create($sql);

if (empty($qw)) {

    $sql = "CREATE TABLE `note` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `created` INT(11) NOT NULL , `text` VARCHAR(60000) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB";
    $qw = create($sql);
}


