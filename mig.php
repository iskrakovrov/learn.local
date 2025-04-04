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


//$sql = "SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))";  //Hosting
//$qw = create($sql);
//$sql = "SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))"; // Windows
//$qw = create($sql);

if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_ADDR'] == '127.0.0.1') {
    // Если это локальный сервер (OpenServer)
    $sql = "SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))";
} else {
    // Если это хостинг
    $sql = "SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))";
}

// Выполняем выбранный запрос
$qw = create($sql);

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

    $sql = "CREATE TABLE `note` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `created` INT(11) NOT NULL , `text` TEXT(16000) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB";
    $qw = create($sql);
}
$sql = "SHOW TABLES LIKE 'stat_share'";
$qw = create($sql);

if (empty($qw)) {

    $sql = "CREATE TABLE `stat_share` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `create` INT(20) NOT NULL , `url` VARCHAR(255) NOT NULL , `id_fb` BIGINT(20) NOT NULL , `id_acc` INT(11) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $qw = create($sql);
}
$sql = "SHOW TABLES LIKE 'all_stat'";
$qw = create($sql);

if (empty($qw)) {

    $sql = "CREATE TABLE `all_stat` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `all_friends` INT(11) NOT NULL , `created` INT(11) NOT NULL , `type` INT(11) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $qw = create($sql);
}


$sql = "SHOW COLUMNS FROM accounts WHERE FIELD = 'created_acc'";
$qw = create($sql);
if (empty($qw)) {
    $sql = "ALTER TABLE `accounts` ADD `created_acc` INT(11) NULL AFTER `ar`;";
    $qw = create($sql);
}

$sql = "SELECT * FROM status WHERE id = 20";
$qw = select($sql);
if (empty($qw)) {
    $sql = "INSERT INTO `status` (`id`, `status`) VALUES ('21', 'ОК CHK MAIL')";
    $qw = insert($sql);
}

$sql = "SHOW TABLES LIKE 'instagram'";
$qw = create($sql);

if (empty($qw)) {

    $sql = "CREATE TABLE `instagram` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `login_i` VARCHAR(255) NOT NULL , `pass_i` VARCHAR(255) NOT NULL , `mail` VARCHAR(255) NULL , `cookies_i` LONGTEXT NULL , `id_acc` INT(11) NULL , `id_fb` BIGINT(255) NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $qw = create($sql);
    $sql = "ALTER TABLE `instagram` ADD `pass_mail` VARCHAR(255)  NULL AFTER `mail`";
    $qw = create($sql);
    $sql = "ALTER TABLE `instagram` ADD `created` INT(11) NULL AFTER `id_fb`";
    $qw = create($sql);
    $sql = "ALTER TABLE `instagram` ADD `sch` INT(11) NULL AFTER `created`";
    $qw = create($sql);
}
$sql = "SHOW COLUMNS FROM accounts WHERE FIELD = 'life'";
$qw = create($sql);
if (empty($qw)) {
    $sql = "ALTER TABLE `accounts` ADD `life` VARCHAR(255) NULL AFTER `created_acc`;";
    $qw = create($sql);

}
$sql = "SHOW COLUMNS FROM accounts WHERE FIELD = 'ig'";
$qw = create($sql);
if (empty($qw)) {
    $sql = "ALTER TABLE `accounts` ADD `ig` INT(11) NULL AFTER `life`;";
    $qw = create($sql);

}

$sql = "SHOW TABLES LIKE 'group_proxy'";
$qw = create($sql);


if (empty($qw)) {

    $sql = "CREATE TABLE `group_proxy` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `name_group` VARCHAR(50) NOT NULL , `comment` VARCHAR(255) NULL , PRIMARY KEY (`id`), UNIQUE `n_g` (`name_group`)) ENGINE = InnoDB;";
    $qw = create($sql);
    $sql = "ALTER TABLE `proxy` CHANGE `ban` `group_proxy` INT(11) NULL DEFAULT NULL";
    $qw = create($sql);
    $sql = "UPDATE `proxy` SET `group_proxy`= NULL;";
    $qw = create($sql);
    $sql = "ALTER TABLE `accounts` ADD `gpoup_proxy` INT(11) NULL AFTER `id_proxy`;";
    $qw = create($sql);
}

$sql = "SHOW COLUMNS FROM oai WHERE FIELD = 'error'";
$qw = create($sql);
if (empty($qw)) {
    $sql = "ALTER TABLE `oai` ADD `error` VARCHAR(255) NULL AFTER `usage`";
    $qw = create($sql);

}
$sql = "SHOW COLUMNS FROM oai WHERE FIELD = 'used'";
$qw = create($sql);
if (empty($qw)) {
    $sql = "ALTER TABLE `oai` ADD `used` INT(25) NULL AFTER `error`";
    $qw = create($sql);

}
$sql = "SHOW COLUMNS FROM oai WHERE FIELD = 'working'";
$qw = create($sql);
if (empty($qw)) {
    $sql = "ALTER TABLE `oai` ADD `working` INT(1) NULL AFTER `used`";
    $qw = create($sql);

}

$sql = "SHOW COLUMNS FROM stat_share WHERE FIELD = 'create'";
$qw = create($sql);
if (!empty($qw)) {
    $sql = "ALTER TABLE `stat_share` CHANGE `create` `created` INT(20) NULL";
    $qw = create($sql);

}

$sql = "SHOW TABLES LIKE 'account_tags'";
$qw = create($sql);

if (empty($qw)) {

    $sql = "CREATE TABLE `account_tags` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `tag` VARCHAR(50) NOT NULL , PRIMARY KEY (`id`), UNIQUE `tag` (`tag`)) ENGINE = InnoDB;";
    $qw = create($sql);
    $sql = "ALTER TABLE `accounts` ADD `account_tags` INT(11) NULL AFTER `group_acc`";
    $qw = create($sql);
}
if (version_compare($ver, '5.05.19') < 0) { //Проверяем текущая версия ниже 5.05.18 ?
    $sql = "ALTER TABLE accounts ADD PRIMARY KEY (id);";
    $qw = update($sql);
    $sql = "CREATE INDEX idx_accounts_id_created_acc ON accounts (id, created_acc);";
    $qw = update($sql);
    $sql = "CREATE INDEX idx_task_account ON task (account);";
    $qw = update($sql);
    $sql = "CREATE INDEX idx_friends_id_acc_created ON friends (id_acc, created);";
    $qw = update($sql);
    $sql = "CREATE INDEX idx_friends_id_acc ON friends (id_acc);";
    $qw = update($sql);
}
$sql = "SHOW TABLES LIKE 's_stat'";
$qw = create($sql);

if (empty($qw)) {

    $sql = "CREATE TABLE `s_stat` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `all_friends` INT(11) NOT NULL , `created` INT(11) NOT NULL , `type` INT(11) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $qw = create($sql);
}
$sql = "SHOW TABLES LIKE 'stat_rss'";
$qw = create($sql);

if (empty($qw)) {

    $sql = "CREATE TABLE `stat_rss` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `id_acc` INT NOT NULL , `url` VARCHAR(255) NOT NULL , `created` INT(25) NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB";
    $qw = create($sql);
}


$sql = "ALTER TABLE value_lists CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
$qw = create($sql);

$sql = "SHOW TABLES LIKE 'stat_rss'";
$qw = create($sql);

if (empty($qw)) {

    $sql = "CREATE TABLE `st_gr` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `post` INT(11) NOT NULL , `id_acc` INT(11) NOT NULL , `created` INT(25) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $qw = create($sql);
    $sql ="ALTER TABLE `st_gr` ADD `list` INT(11) NOT NULL AFTER `id_acc`";
    $qw = create($sql);
    $sql = "ALTER TABLE `st_gr` ADD `gr` INT NOT NULL AFTER `id`";
    $qw = create($sql);
}
$sql = "CREATE TABLE IF NOT EXISTS selected_values (
  id INT AUTO_INCREMENT PRIMARY KEY,
  value_id INT,
  post INT,
  id_acc INT,
  created INT(25),
  UNIQUE KEY (value_id)
);";
$qw = create($sql);

$sql = "SELECT * FROM status WHERE id = 21";
$qw = select($sql);
if (empty($qw)) {
    $sql = "INSERT INTO `status` (`id`, `status`) VALUES ('21', 'Update mail')";
    $qw = insert($sql);
}

//$sql = "CREATE INDEX IF NOT EXISTS idx_id ON accounts (id);";
//$qw = create($sql);
//$sql = "CREATE INDEX IF NOT EXISTS idx_id_acc ON friends (id_acc)";
//$qw = create($sql);
//$sql = "CREATE INDEX IF NOT EXISTS  idx_account ON task (account);";
//$qw = create($sql);
//$sql = "CREATE INDEX IF NOT EXISTS idx_id_acc_created ON friends (id_acc, created)";
//$qw = create($sql);
//$sql = "CREATE INDEX IF NOT EXISTS  idx_id_acc ON friends (id_acc)";
//$qw = create($sql);

$sql = "SHOW TABLES LIKE 'post_group'";
$qw = create($sql);

if (empty($qw)) {

    $sql = "CREATE TABLE `post_group` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `id_acc` INT(11) NOT NULL , `id_gr` INT(11) NOT NULL , `created` INT(25) NOT NULL , `type` INT(11) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $qw = create($sql);
}


$sql = "SHOW COLUMNS FROM selected_values WHERE FIELD = 'task'";
$qw = create($sql);
if (empty($qw)) {
    $sql = "ALTER TABLE `selected_values` ADD `task` INT(11) NOT NULL AFTER `id_acc`";
    $qw = create($sql);

}
$sql = "SHOW INDEX FROM selected_values WHERE Key_name = 'value_id'";
$qw = create($sql);

if (!empty($qw)) {
    $sql = "ALTER TABLE selected_values DROP INDEX value_id";
    $qw = create($sql);
}
$sql = "SHOW TABLES LIKE 'mess'";
$qw = create($sql);

if (empty($qw)) {

    $sql = "CREATE TABLE `mess` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `id_acc` INT NOT NULL , `url` VARCHAR(700) NOT NULL , `text_mess` VARCHAR(700) NULL , `answer` INT NULL , `name` VARCHAR(250) NULL , `data_mess` INT(24) NULL , `type` INT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $qw = create($sql);
    $sql = " ALTER TABLE `mess` ADD UNIQUE(`url`);";
    $qw = create($sql);
    $sql = " ALTER TABLE `mess` ADD UNIQUE(`text_mess`);";
    $qw = create($sql);

}

$sql = "ALTER TABLE `value_lists` CHANGE `value` `value` VARCHAR(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL";
$qw = create($sql);

$sql = "SHOW TABLES LIKE 'bad_mail'";
$qw = create($sql);

if (empty($qw)) {

    $sql = "CREATE TABLE `bad_mail` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `mail` VARCHAR(255) NOT NULL , `pass_mail` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $qw = create($sql);
}

$sql = "SHOW TABLES LIKE 'post_logs'";
$qw = create($sql);

if (empty($qw)) {

    $sql = "CREATE TABLE post_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    group_id INT NOT NULL,
    project_id INT NOT NULL,
    post_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (group_id) REFERENCES value_lists(id)
);";
    $qw = create($sql);
}
$sql = "SHOW TABLES LIKE 'current_position'";
$qw = create($sql);

if (empty($qw)) {
    $sql = "CREATE TABLE current_position (
        project_id INT PRIMARY KEY,
    last_group_id INT
);";
    $qw = create($sql);
}

$sql = "SHOW TABLES LIKE 'group_locks'";
$qw = create($sql);

if (empty($qw)) {
    $sql = "CREATE TABLE IF NOT EXISTS group_locks (
    group_id INT NOT NULL,
    project_id INT NOT NULL,
    locked_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (group_id, project_id),
    FOREIGN KEY (group_id) REFERENCES value_lists(id)
);;";
    $qw = create($sql);
}
$sql = "SHOW TABLES LIKE 'hm'";
$qw = create($sql);

if (empty($qw)) {

    $sql = "CREATE TABLE `hm` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `mail` VARCHAR(150) NOT NULL , `pass_mail` VARCHAR(150) NOT NULL , `hm` VARCHAR(150) NULL , `hmpass` VARCHAR(150) NULL , `phone` VARCHAR(150) NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $qw = create($sql);
}
$sql = "SHOW TABLES LIKE 'groups'";
$qw = create($sql);

if (empty($qw)) {

    $sql = "CREATE TABLE `groups` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `group` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $qw = create($sql);
}



$sql = "ALTER TABLE `task` CHANGE `setup` `setup` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;";
$qw = create($sql);
$sql = "ALTER TABLE `task` CHANGE `setup` `setup` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;";
$qw = create($sql);
$sql = "ALTER TABLE `temp_task` CHANGE `setup` `setup` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;";
$qw = create($sql);
$sql = "ALTER TABLE `template` CHANGE `setup` `setup` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;";
$qw = create($sql);

$sql = "SHOW TABLES LIKE 'a_groups'";
$qw = create($sql);
if (empty($qw)) {

    $sql = "CREATE TABLE `a_groups` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `id_acc` INT(11) NOT NULL , `group` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $qw = create($sql);
}

$sql = "SHOW COLUMNS FROM stat_parse WHERE FIELD = 'cat'";
$qw = create($sql);
if (empty($qw)) {
    $sql = "ALTER TABLE `stat_parse` ADD `cat` INT(11) NOT NULL AFTER `id_url`;";
    $qw = create($sql);
}

$sql = "SELECT * FROM `status` WHERE `status` = 'BLOCK'";
$qw = select($sql); // Предполагается, что `create()` выполняет запрос и возвращает результат.

if (empty($qw)) {
    $sql = "INSERT INTO `status` (`status`) VALUES ('BLOCK')";
    $qw = insert($sql); // Выполняем запрос на добавление строки.
}
$sql = "SELECT * FROM `status` WHERE `status` = 'LANG'";
$qw = select($sql); // Предполагается, что `create()` выполняет запрос и возвращает результат.

if (empty($qw)) {
    $sql = "INSERT INTO `status` (`status`) VALUES ('LANG')";
    $qw = insert($sql); // Выполняем запрос на добавление строки.
}


// Проверяем существование таблицы smsService
$sql = "SHOW TABLES LIKE 'smsService'";
$result = select($sql);

if (empty($result)) {
    // Если таблица не существует - создаем ее
    $sql = "CREATE TABLE `smsService` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `service` VARCHAR(255) NOT NULL,
        `domain` VARCHAR(255) NOT NULL,
        `apikey` VARCHAR(255) NULL,
        `type` VARCHAR(50) NULL,
        PRIMARY KEY (`id`),
        UNIQUE (`service`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

    $createResult = create($sql);

}

$sql = "SHOW TABLES LIKE 'country1'";
$result = select($sql);

if (empty($result)) {
    // Создаем таблицу
    $sql = "CREATE TABLE country1 (
        id INT PRIMARY KEY,
        name VARCHAR(255) NOT NULL
    )";
    create($sql);

    // Вставляем данные
    $insertSql = "INSERT INTO country1 (id, name) VALUES 
        (0, 'Russia'),
        (1, 'Ukraine'),
        (2, 'Kazakhstan'),
        (3, 'China'),
        (4, 'Philippines'),
        (5, 'Myanmar'),
        (6, 'Indonesia'),
        (7, 'Malaysia'),
        (8, 'Kenya'),
        (9, 'Tanzania'),
        (10, 'Vietnam'),
        (11, 'Kyrgyzstan'),
        (13, 'Israel'),
        (14, 'Hong Kong'),
        (15, 'Poland'),
        (16, 'United Kingdom'),
        (17, 'Madagascar'),
        (18, 'Dem. Congo'),
        (19, 'Nigeria'),
        (20, 'Macau'),
        (21, 'Egypt'),
        (22, 'India'),
        (23, 'Ireland'),
        (24, 'Cambodia'),
        (25, 'Laos'),
        (26, 'Haiti'),
        (27, 'Ivory Coast'),
        (28, 'Gambia'),
        (29, 'Serbia'),
        (30, 'Yemen'),
        (31, 'South Africa'),
        (32, 'Romania'),
        (33, 'Colombia'),
        (34, 'Estonia'),
        (35, 'Azerbaijan'),
        (36, 'Canada'),
        (37, 'Morocco'),
        (38, 'Ghana'),
        (39, 'Argentina'),
        (40, 'Uzbekistan'),
        (41, 'Cameroon'),
        (42, 'Chad'),
        (43, 'Germany'),
        (44, 'Lithuania'),
        (45, 'Croatia'),
        (46, 'Sweden'),
        (47, 'Iraq'),
        (48, 'Netherlands'),
        (49, 'Latvia'),
        (50, 'Austria'),
        (51, 'Belarus'),
        (52, 'Thailand'),
        (53, 'Saudi Arabia'),
        (54, 'Mexico'),
        (55, 'Taiwan'),
        (56, 'Spain'),
        (57, 'Iran'),
        (58, 'Algeria'),
        (59, 'Slovenia'),
        (60, 'Bangladesh'),
        (61, 'Senegal'),
        (62, 'Turkey'),
        (63, 'Czech Republic'),
        (64, 'Sri Lanka'),
        (65, 'Peru'),
        (66, 'Pakistan'),
        (67, 'New Zealand'),
        (68, 'Guinea'),
        (69, 'Mali'),
        (70, 'Venezuela'),
        (71, 'Ethiopia'),
        (72, 'Mongolia'),
        (73, 'Brazil'),
        (74, 'Afghanistan'),
        (75, 'Uganda'),
        (76, 'Angola'),
        (77, 'Cyprus'),
        (78, 'France'),
        (79, 'Papua New Guinea'),
        (80, 'Mozambique'),
        (81, 'Nepal'),
        (82, 'Belgium'),
        (83, 'Bulgaria'),
        (84, 'Hungary'),
        (85, 'Moldova'),
        (86, 'Italy'),
        (87, 'Paraguay'),
        (88, 'Honduras'),
        (89, 'Tunisia'),
        (90, 'Nicaragua'),
        (91, 'Timor-Leste'),
        (92, 'Bolivia'),
        (93, 'Costa Rica'),
        (94, 'Guatemala'),
        (95, 'UAE'),
        (96, 'Zimbabwe'),
        (97, 'Puerto Rico'),
        (98, 'Sudan'),
        (99, 'Togo'),
        (100, 'Kuwait'),
        (101, 'El Salvador'),
        (102, 'Libya'),
        (103, 'Jamaica'),
        (104, 'Trinidad and Tobago'),
        (105, 'Ecuador'),
        (106, 'Eswatini'),
        (107, 'Oman'),
        (108, 'Bosnia and Herzegovina'),
        (109, 'Dominican Republic'),
        (110, 'Syria'),
        (111, 'Qatar'),
        (112, 'Panama'),
        (113, 'Cuba'),
        (114, 'Mauritania'),
        (115, 'Sierra Leone'),
        (116, 'Jordan'),
        (117, 'Portugal'),
        (118, 'Barbados'),
        (119, 'Burundi'),
        (120, 'Benin'),
        (121, 'Brunei'),
        (122, 'Bahamas'),
        (123, 'Botswana'),
        (124, 'Belize'),
        (125, 'Central African Republic'),
        (126, 'Dominica'),
        (127, 'Grenada'),
        (128, 'Georgia'),
        (129, 'Greece'),
        (130, 'Guinea-Bissau'),
        (131, 'Guyana'),
        (132, 'Iceland'),
        (133, 'Comoros'),
        (134, 'Saint Kitts and Nevis'),
        (135, 'Liberia'),
        (136, 'Lesotho'),
        (137, 'Malawi'),
        (138, 'Namibia'),
        (139, 'Niger'),
        (140, 'Rwanda'),
        (141, 'Slovakia'),
        (142, 'Suriname'),
        (143, 'Tajikistan'),
        (144, 'Monaco'),
        (145, 'Bahrain'),
        (146, 'Reunion'),
        (147, 'Zambia'),
        (148, 'Armenia'),
        (149, 'Somalia'),
        (150, 'Congo'),
        (151, 'Chile'),
        (152, 'Burkina Faso'),
        (153, 'Lebanon'),
        (154, 'Gabon'),
        (155, 'Albania'),
        (156, 'Uruguay'),
        (157, 'Mauritius'),
        (158, 'Bhutan'),
        (159, 'Maldives'),
        (160, 'Guadeloupe'),
        (161, 'Turkmenistan'),
        (162, 'French Guiana'),
        (163, 'Finland'),
        (164, 'Saint Lucia'),
        (165, 'Luxembourg'),
        (166, 'Saint Vincent and the Grenadines'),
        (167, 'Equatorial Guinea'),
        (168, 'Djibouti'),
        (169, 'Antigua and Barbuda'),
        (170, 'Cayman Islands'),
        (171, 'Montenegro'),
        (172, 'Denmark'),
        (173, 'Switzerland'),
        (174, 'Norway'),
        (175, 'Australia'),
        (176, 'Eritrea'),
        (177, 'South Sudan'),
        (178, 'Sao Tome and Principe'),
        (179, 'Aruba'),
        (180, 'Montserrat'),
        (181, 'Anguilla'),
        (182, 'Japan'),
        (183, 'North Macedonia'),
        (184, 'Seychelles'),
        (185, 'New Caledonia'),
        (186, 'Cape Verde'),
        (187, 'USA'),
        (188, 'Palestine'),
        (189, 'Fiji'),
        (196, 'Singapore'),
        (199, 'Malta'),
        (201, 'Gibraltar'),
        (203, 'Kosovo'),
        (204, 'Niue')";

    create($insertSql);
}




$defaultServices = [
    [
        'name' => 'sms-activate',
        'title' => 'SMS-Activate',
        'api_url' => 'https://sms-activate.org/stubs/handler_api.php',
        'is_active' => true
    ],
    [
        'name' => 'sms-hub',
        'title' => 'SMS-Hub',
        'api_url' => 'https://smshub.org/stubs/handler_api.php',
        'is_active' => true
    ],
    [
        'name' => 'vak-sms',
        'title' => 'VAK-SMS',
        'api_url' => 'https://vak-sms.com/stubs/handler_api.php',
        'is_active' => true
    ],
    [
        'name' => 'grizzly-sms',
        'title' => '7GrizzlySMS',
        'api_url' => 'https://api.7grizzlysms.com/stubs/handler_api.php',
        'is_active' => true
    ],
    [
        'name' => 'api-365',
        'title' => '365API',
        'api_url' => 'https://365api.net/stubs/handler_api.php',
        'is_active' => true
    ],
    [
        'name' => 'sms-bower',
        'title' => 'SMSBower',
        'api_url' => 'https://smsbower.online/stubs/handler_api.php',
        'is_active' => true
    ],
    [
        'name' => 'sms-live',
        'title' => 'SMSLive',
        'api_url' => 'https://api.smslive.pro/stubs/handler_api.php',
        'is_active' => true
    ]
];

try {
    // 1. Проверяем существование таблицы sms_services
    $tableExists = create("SHOW TABLES LIKE 'sms_services'");

    if (empty($tableExists)) {
        // Создаем таблицу со всеми нужными столбцами
        $createTable = "CREATE TABLE `sms_services` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `name` VARCHAR(50) NOT NULL COMMENT 'Системное название',
            `title` VARCHAR(100) NOT NULL COMMENT 'Название для интерфейса',
            `api_url` VARCHAR(255) NOT NULL,
            `api_key` VARCHAR(255) NULL,
            `is_active` BOOLEAN DEFAULT TRUE,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            UNIQUE KEY `uk_name` (`name`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

        create($createTable);
    } else {
        // 2. Проверяем существование столбца api_key
        $columnCheck = create("SHOW COLUMNS FROM `sms_services` LIKE 'api_key'");
        if (empty($columnCheck)) {
            create("ALTER TABLE `sms_services` ADD COLUMN `api_key` VARCHAR(255) NULL AFTER `api_url`");
        }
    }

    // 3. Добавляем/обновляем сервисы
    foreach ($defaultServices as $service) {
        $exists = create("SELECT id FROM sms_services WHERE name = '".$service['name']."'");

        if (empty($exists)) {
            $sql = "INSERT INTO sms_services (name, title, api_url, is_active) VALUES (
                '".$service['name']."',
                '".$service['title']."',
                '".$service['api_url']."',
                ".(int)$service['is_active']."
            )";
            create($sql);
        }
    }
} catch (PDOException $e) {
    die('Ошибка базы данных: ' . $e->getMessage());
}

$sql = "SHOW TABLES LIKE 'service_countries'";
$result = select($sql);

if (empty($result)) {
    // Создаем таблицу
    $sql = "CREATE TABLE `service_countries` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `service_id` int(11) NOT NULL,
        `country_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
        `country_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `service_country` (`service_id`,`country_code`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

    create($sql);

    // Маппинг стран (код => название на английском)
    $countries = [
        "0" => "Russia",
        "1" => "Ukraine",
        "2" => "Kazakhstan",
        "3" => "China",
        "4" => "Philippines",
        "5" => "Myanmar",
        "6" => "Indonesia",
        "7" => "Malaysia",
        "8" => "Kenya",
        "9" => "Tanzania",
        "10" => "Vietnam",
        "11" => "Kyrgyzstan",
        "13" => "Israel",
        "14" => "Hong Kong",
        "15" => "Poland",
        "16" => "United Kingdom",
        "17" => "Madagascar",
        "18" => "DR Congo",
        "19" => "Nigeria",
        "20" => "Macau",
        "21" => "Egypt",
        "22" => "India",
        "23" => "Ireland",
        "24" => "Cambodia",
        "25" => "Laos",
        "26" => "Haiti",
        "27" => "Ivory Coast",
        "28" => "Gambia",
        "29" => "Serbia",
        "30" => "Yemen",
        "31" => "South Africa",
        "32" => "Romania",
        "33" => "Colombia",
        "34" => "Estonia",
        "35" => "Azerbaijan",
        "36" => "Canada",
        "37" => "Morocco",
        "38" => "Ghana",
        "39" => "Argentina",
        "40" => "Uzbekistan",
        "41" => "Cameroon",
        "42" => "Chad",
        "43" => "Germany",
        "44" => "Lithuania",
        "45" => "Croatia",
        "46" => "Sweden",
        "47" => "Iraq",
        "48" => "Netherlands",
        "49" => "Latvia",
        "50" => "Austria",
        "51" => "Belarus",
        "52" => "Thailand",
        "53" => "Saudi Arabia",
        "54" => "Mexico",
        "55" => "Taiwan",
        "56" => "Spain",
        "57" => "Iran",
        "58" => "Algeria",
        "59" => "Slovenia",
        "60" => "Bangladesh",
        "61" => "Senegal",
        "62" => "Turkey",
        "63" => "Czech Republic",
        "64" => "Sri Lanka",
        "65" => "Peru",
        "66" => "Pakistan",
        "67" => "New Zealand",
        "68" => "Guinea",
        "69" => "Mali",
        "70" => "Venezuela",
        "71" => "Ethiopia",
        "72" => "Mongolia",
        "73" => "Brazil",
        "74" => "Afghanistan",
        "75" => "Uganda",
        "76" => "Angola",
        "77" => "Cyprus",
        "78" => "France",
        "79" => "Papua New Guinea",
        "80" => "Mozambique",
        "81" => "Nepal",
        "82" => "Belgium",
        "83" => "Bulgaria",
        "84" => "Hungary",
        "85" => "Moldova",
        "86" => "Italy",
        "87" => "Paraguay",
        "88" => "Honduras",
        "89" => "Tunisia",
        "90" => "Nicaragua",
        "91" => "Timor-Leste",
        "92" => "Bolivia",
        "93" => "Costa Rica",
        "94" => "Guatemala",
        "95" => "United Arab Emirates",
        "96" => "Zimbabwe",
        "97" => "Puerto Rico",
        "98" => "Sudan",
        "99" => "Togo",
        "100" => "Kuwait",
        "101" => "El Salvador",
        "102" => "Libya",
        "103" => "Jamaica",
        "104" => "Trinidad and Tobago",
        "105" => "Ecuador",
        "106" => "Eswatini",
        "107" => "Oman",
        "108" => "Bosnia and Herzegovina",
        "109" => "Dominican Republic",
        "110" => "Syria",
        "111" => "Qatar",
        "112" => "Panama",
        "113" => "Cuba",
        "114" => "Mauritania",
        "115" => "Sierra Leone",
        "116" => "Jordan",
        "117" => "Portugal",
        "118" => "Barbados",
        "119" => "Burundi",
        "120" => "Benin",
        "121" => "Brunei",
        "122" => "Bahamas",
        "123" => "Botswana",
        "124" => "Belize",
        "125" => "Central African Republic",
        "126" => "Dominica",
        "127" => "Grenada",
        "128" => "Georgia",
        "129" => "Greece",
        "130" => "Guinea-Bissau",
        "131" => "Guyana",
        "132" => "Iceland",
        "133" => "Comoros",
        "134" => "Saint Kitts and Nevis",
        "135" => "Liberia",
        "136" => "Lesotho",
        "137" => "Malawi",
        "138" => "Namibia",
        "139" => "Niger",
        "140" => "Rwanda",
        "141" => "Slovakia",
        "142" => "Suriname",
        "143" => "Tajikistan",
        "144" => "Monaco",
        "145" => "Bahrain",
        "146" => "Réunion",
        "147" => "Zambia",
        "148" => "Armenia",
        "149" => "Somalia",
        "150" => "Congo",
        "151" => "Chile",
        "152" => "Burkina Faso",
        "153" => "Lebanon",
        "154" => "Gabon",
        "155" => "Albania",
        "156" => "Uruguay",
        "157" => "Mauritius",
        "158" => "Bhutan",
        "159" => "Maldives",
        "160" => "Guadeloupe",
        "161" => "Turkmenistan",
        "162" => "French Guiana",
        "163" => "Finland",
        "164" => "Saint Lucia",
        "165" => "Luxembourg",
        "166" => "Saint Vincent and the Grenadines",
        "167" => "Equatorial Guinea",
        "168" => "Djibouti",
        "169" => "Antigua and Barbuda",
        "170" => "Cayman Islands",
        "171" => "Montenegro",
        "172" => "Denmark",
        "173" => "Switzerland",
        "174" => "Norway",
        "175" => "Australia",
        "176" => "Eritrea",
        "177" => "South Sudan",
        "178" => "Sao Tome and Principe",
        "179" => "Aruba",
        "180" => "Montserrat",
        "181" => "Anguilla",
        "182" => "Japan",
        "183" => "North Macedonia",
        "184" => "Seychelles",
        "185" => "New Caledonia",
        "186" => "Cape Verde",
        "187" => "United States",
        "188" => "Palestine",
        "189" => "Fiji",
        "196" => "Singapore",
        "199" => "Malta",
        "201" => "Gibraltar",
        "203" => "Kosovo",
        "204" => "Niue"
    ];

    // Заполняем таблицу данными стран (service_id = 0 для базового списка)
    foreach ($countries as $code => $name) {
        $sql = "INSERT INTO service_countries (service_id, country_code, country_name) 
                VALUES (0, '$code', '$name')";
        create($sql);
    }
}
// Проверяем существование столбца balance
$sql = "SHOW COLUMNS FROM `sms_services` WHERE Field = 'balance'";
$qw = create($sql);

if (empty($qw)) {
    // Если столбец не существует - добавляем его
    $sql = "ALTER TABLE `sms_services` ADD `balance` DECIMAL(10,2) DEFAULT NULL AFTER `is_active`";
    $qw = create($sql);
}
$column_exists = new_selectAll(
    "SHOW COLUMNS FROM `sms_services` LIKE 'balance_updated'"
);

if (empty($column_exists)) {
    @new_update(
        "ALTER TABLE `sms_services` ADD `balance_updated` DATETIME NULL AFTER `balance`"
    );
}
$sql = "SHOW COLUMNS FROM `users` WHERE Field = 'api_key'";
$column_check = new_selectAll($sql);

if (empty($column_check)) {
    // 2. Добавляем столбец api_key
    $sql = "ALTER TABLE `users` 
            ADD `api_key` VARCHAR(64) NULL DEFAULT NULL AFTER `pass`";
    new_update($sql);
}
$sql = "SHOW TABLES LIKE 'samsung_devices'";
$result = select($sql);

if (empty($result)) {
    require 'phone/samsung.php';
}
$sql = "SHOW TABLES LIKE 'google_devices'";
$result = select($sql);

if (empty($result)) {
    require 'phone/google.php';
}
$sql = "SHOW TABLES LIKE 'huawei_devices'";
$result = select($sql);

if (empty($result)) {
    require 'phone/huawei.php';
}
$sql = "SHOW TABLES LIKE 'oneplus_devices'";
$result = select($sql);

if (empty($result)) {
    require 'phone/oneplus.php';
}
$sql = "SHOW TABLES LIKE 'xiaomi_devices'";
$result = select($sql);

if (empty($result)) {
    require 'phone/xiaomi.php';
}
$sql = "SHOW TABLES LIKE 'oppo_devices'";
$result = select($sql);

if (empty($result)) {
    require 'phone/oppo.php';
}

$sql = "SELECT * FROM `cat_lists` WHERE `id` = 13 AND `name` = 'Email lists'";
$row = select($sql);

if (!$row) {
    // Если строки нет, добавляем ее
    $sql = "INSERT INTO `cat_lists` (`id`, `cat`, `name`) VALUES (13, 13, 'Email lists')";
    $result = insert($sql);
}