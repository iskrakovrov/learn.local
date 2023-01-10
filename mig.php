<?php
require_once('inc/version.php');
$sql = "SELECT * FROM options";
$qw = select($sql);
$ver = $qw['ver'];
if (is_null($ver)){
    $sql = "SHOW COLUMNS FROM options WHERE FIELD = 'ver'";
    $qw = create($sql);
    if(empty($qw)){
        $sql = "ALTER TABLE `options` ADD `ver` VARCHAR(25) NULL AFTER `proxy`";
        $qw = create($sql);
        header('Location: new.php');
        exit();
    }

    $sql = "UPDATE options SET ver = '$vers'";
    $qw = update($sql);
    header('Location: new.php');
    exit();
}
$sql = "UPDATE options SET ver = '$vers'";
$qw = update($sql);

$sql = "SHOW COLUMNS FROM groups_fb WHERE FIELD = 'url'";
$qw = create($sql);
if(empty($qw)) {
    $sql = "ALTER TABLE `groups_fb` ADD `url` VARCHAR(255) NULL AFTER `name`, ADD `count` INT(11) NULL AFTER `url`";
    $qw = create($sql);
    $sql = "ALTER TABLE `groups_fb` CHANGE `id_fb` `id_fb` INT(25) NULL";
    $qw = create($sql);
}
$sql = "SHOW TABLES LIKE 'login_change'";
$qw = create($sql);
if(empty($qw)) {


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
if(empty($qw)) {


    $sql = "CREATE TABLE `posting` (`id` INT NOT NULL AUTO_INCREMENT , `id_acc` INT NOT NULL , `id_post` INT NOT NULL , `target` INT NULL , `created` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $qw = create($sql);
}
$sql = "SHOW TABLES LIKE 'stat_post'";
$qw = create($sql);
if(empty($qw)) {


    $sql = "CREATE TABLE `stat_post` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `id_acc` INT(11) NOT NULL , `id_post` INT(11) NOT NULL , `target` VARCHAR(255) NULL , `created` INT(25) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $qw = create($sql);
}
$sql = $sql = "SHOW COLUMNS FROM options WHERE FIELD = 'change_proxy'";
$qw = create($sql);
if(empty($qw)) {
    $sql = "ALTER TABLE `options` ADD `change_proxy` INT(2) NOT NULL AFTER `ver`;";
    $qw = create($sql);

}
$sql = "SELECT * FROM status WHERE id = 18";
$qw = select($sql);
if(empty($qw)) {
$sql = "INSERT INTO `status` (`id`, `status`) VALUES ('18', 'bad proxy')";
$qw = insert($sql);
}
$sql = "SHOW TABLES LIKE 'likes'";
$qw = create($sql);
if(empty($qw)) {


    $sql = "CREATE TABLE `likes` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `create` INT(25) NOT NULL , `id_acc` INT(11) NOT NULL , `cat` INT(11) NOT NULL , `id_v` INT(11) NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $qw = create($sql);
}