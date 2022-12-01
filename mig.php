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

$sql = $sql = "SHOW COLUMNS FROM groups_fb WHERE FIELD = 'url'";
$qw = create($sql);
if(empty($qw)) {
    $sql = "ALTER TABLE `groups_fb` ADD `url` VARCHAR(255) NULL AFTER `name`, ADD `count` INT(11) NULL AFTER `url`";
    $qw = create($sql);
    $sql = "ALTER TABLE `groups_fb` CHANGE `id_fb` `id_fb` INT(25) NULL";
    $qw = create($sql);
}
