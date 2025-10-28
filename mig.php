<?php
require_once('inc/version.php');

// --- Вспомогательные функции для проверки существования таблиц и столбцов ---
function tableExists($tableName) {
    $sql = "SHOW TABLES LIKE ?";
    $result = select($sql, [$tableName]);
    return !empty($result);
}

function columnExists($tableName, $columnName) {
    $sql = "SHOW COLUMNS FROM `$tableName` WHERE FIELD = ?";
    $result = select($sql, [$columnName]);
    return !empty($result);
}

function indexExists($tableName, $indexName) {
    $sql = "SHOW INDEX FROM `$tableName` WHERE Key_name = ?";
    $result = select($sql, [$indexName]);
    return !empty($result);
}

// --- Логика работы с версией ---
$sql = "SELECT * FROM options";
$qw = select($sql);
$ver = $qw['ver'] ?? null;

if (is_null($ver)) {
    if (!columnExists('options', 'ver')) {
        $sql = "ALTER TABLE `options` ADD `ver` VARCHAR(25) NULL AFTER `proxy`";
        create($sql);
        header('Location: new.php');
        exit();
    }

    $sql = "UPDATE options SET ver = ?";
    $args = [$vers];
    update($sql, $args);
    header('Location: new.php');
    exit();
}

// Обновляем версию в самом начале
$sql = "UPDATE options SET ver = ?";
$args = [$vers];
update($sql, $args);

// --- Настройка SQL Mode ---
if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_ADDR'] == '127.0.0.1') {
    $sql = "SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))";
} else {
    $sql = "SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))";
}
create($sql);

// --- Структура таблиц и данные ---
// 1. Группы Facebook
if (!columnExists('groups_fb', 'url')) {
    $sql = "ALTER TABLE `groups_fb` 
            ADD `url` VARCHAR(255) NULL AFTER `name`, 
            ADD `count` INT(11) NULL AFTER `url`,
            CHANGE `id_fb` `id_fb` INT(25) NULL";
    create($sql);
}

// 2. Таблица смены логина
if (!tableExists('login_change')) {
    $sql = "CREATE TABLE `login_change` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `old_l` VARCHAR(255) NOT NULL,
        `new_l` VARCHAR(255) NOT NULL,
        `created` INT(25) NOT NULL,
        `id_acc` INT(11) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB";
    create($sql);
}

// 3. Посты
if (!columnExists('posts', 'tipe')) {
    $sql = "ALTER TABLE `posts` 
            ADD `tipe` INT(5) NOT NULL AFTER `img`,
            CHANGE `img` `img` VARCHAR(255) NULL DEFAULT NULL";
    create($sql);
}

// 4. Категории
$sql = "SELECT id FROM cat_lists WHERE `cat` = 11";
$qw = select($sql);
if (!$qw) {
    $sql = "INSERT INTO `cat_lists` (`id`, `cat`, `name`) VALUES (11, '11', 'URL List')";
    insert($sql);
}

// 5. Таблицы для статистики
$tablesToCreate = [
    'posting' => "CREATE TABLE `posting` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `id_acc` INT NOT NULL,
        `id_post` INT NOT NULL,
        `target` INT NULL,
        `created` INT NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB",

    'stat_post' => "CREATE TABLE `stat_post` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `id_acc` INT(11) NOT NULL,
        `id_post` INT(11) NOT NULL,
        `target` VARCHAR(255) NULL,
        `created` INT(25) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB",

    'stat_comm' => "CREATE TABLE `stat_comm` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `id_acc` INT NOT NULL,
        `id_post` INT NOT NULL,
        `target` INT NOT NULL,
        `created` INT NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB",

    'stat_sugg' => "CREATE TABLE `stat_sugg` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `id_acc` INT(11) NOT NULL,
        `created` INT(25) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB",

    'workzp' => "CREATE TABLE `workzp` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `instance` INT(11) NOT NULL,
        `id_acc` INT(11) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB"
];

foreach ($tablesToCreate as $tableName => $createSql) {
    if (!tableExists($tableName)) {
        create($createSql);
    }
}

// 6. Опции и статусы
if (!columnExists('options', 'change_proxy')) {
    $sql = "ALTER TABLE `options` ADD `change_proxy` INT(2) NOT NULL AFTER `ver`";
    create($sql);
}

$statusesToAdd = [
    18 => 'bad proxy',
    19 => 'NEW',
    20 => 'TimeOut',
    21 => 'ОК CHK MAIL',
    22 => 'Update mail'
];

foreach ($statusesToAdd as $id => $status) {
    $sql = "SELECT * FROM status WHERE id = ?";
    $qw = select($sql, [$id]);
    if (empty($qw)) {
        $sql = "INSERT INTO `status` (`id`, `status`) VALUES (?, ?)";
        insert($sql, [$id, $status]);
    }
}

// 7. Дополнительные таблицы
$additionalTables = [
    'likes' => "CREATE TABLE `likes` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `create` INT(25) NOT NULL,
        `id_acc` INT(11) NOT NULL,
        `cat` INT(11) NOT NULL,
        `id_v` INT(11) NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB",

    'change_login' => "CREATE TABLE `change_login` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `old_login` VARCHAR(255) NOT NULL,
        `new_login` VARCHAR(255) NOT NULL,
        `id_acc` INT(11) NOT NULL,
        `created` INT(25) NOT NULL,
        `id_fb` BIGINT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB",

    'stat_parse' => "CREATE TABLE `stat_parse` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `id_url` INT(11) NOT NULL,
        `cat` INT(11) NOT NULL,
        `created` INT(26) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB",

    'templates' => "CREATE TABLE `templates` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(100) NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE (`name`)
    ) ENGINE = InnoDB",

    'template' => "CREATE TABLE `template` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `id_template` INT NOT NULL,
        `task` VARCHAR(25) NOT NULL,
        `setup` VARCHAR(1000) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB"
];

foreach ($additionalTables as $tableName => $createSql) {
    if (!tableExists($tableName)) {
        create($createSql);
    }
}

// 8. AI и комментарии
if (!tableExists('oai')) {
    $sql = "CREATE TABLE `oai` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `code` VARCHAR(100) NOT NULL,
        `status` INT(2) NULL,
        `usage` VARCHAR(255) NULL,
        `error` VARCHAR(255) NULL,
        `used` INT(25) NULL,
        `working` INT(1) NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB";
    create($sql);
}

$sql = "SELECT * FROM cat_lists WHERE id = 12";
$qw = select($sql);
if (empty($qw)) {
    $sql = "INSERT INTO `cat_lists` (`id`, `cat`, `name`) VALUES ('12', '12', 'Chat GPT Prompts')";
    insert($sql);
}

if (!tableExists('commentoai')) {
    $sql = "CREATE TABLE `commentoai` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `url_post` VARCHAR(255) NOT NULL,
        `text_post` TEXT NOT NULL,
        `comment` TEXT NOT NULL,
        `id_acc` INT(11) NOT NULL,
        `posted` INT(2) NULL,
        `created` INT(25) NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB";
    create($sql);
}

// 9. Аккаунты и дополнительные поля
$accountColumns = [
    'bid' => "ALTER TABLE `accounts` ADD `bid` VARCHAR(255) NULL AFTER `adv`",
    'ar' => "ALTER TABLE `accounts` ADD `ar` INT(11) NULL AFTER `bid`",
    'created_acc' => "ALTER TABLE `accounts` ADD `created_acc` INT(11) NULL AFTER `ar`",
    'life' => "ALTER TABLE `accounts` ADD `life` VARCHAR(255) NULL AFTER `created_acc`",
    'ig' => "ALTER TABLE `accounts` ADD `ig` INT(11) NULL AFTER `life`"
];

foreach ($accountColumns as $column => $alterSql) {
    if (!columnExists('accounts', $column)) {
        create($alterSql);
    }
}

// 10. Прокси и группы
if (!tableExists('group_proxy')) {
    $sql = "CREATE TABLE `group_proxy` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `name_group` VARCHAR(50) NOT NULL,
        `comment` VARCHAR(255) NULL,
        PRIMARY KEY (`id`),
        UNIQUE `n_g` (`name_group`)
    ) ENGINE = InnoDB";
    create($sql);

    $sql = "ALTER TABLE `proxy` CHANGE `ban` `group_proxy` INT(11) NULL DEFAULT NULL";
    create($sql);

    $sql = "UPDATE `proxy` SET `group_proxy` = NULL";
    create($sql);

    $sql = "ALTER TABLE `accounts` ADD `gpoup_proxy` INT(11) NULL AFTER `id_proxy`";
    create($sql);
}

// 11. Теги аккаунтов
if (!tableExists('account_tags')) {
    $sql = "CREATE TABLE `account_tags` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `tag` VARCHAR(50) NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE `tag` (`tag`)
    ) ENGINE = InnoDB";
    create($sql);

    $sql = "ALTER TABLE `accounts` ADD `account_tags` INT(11) NULL AFTER `group_acc`";
    create($sql);
}

// 12. Оптимизация индексов
if (version_compare($ver, '5.05.19') < 0) {
    $indexes = [
        "ALTER TABLE accounts ADD PRIMARY KEY (id)",
        "CREATE INDEX idx_accounts_id_created_acc ON accounts (id, created_acc)",
        "CREATE INDEX idx_task_account ON task (account)",
        "CREATE INDEX idx_friends_id_acc_created ON friends (id_acc, created)",
        "CREATE INDEX idx_friends_id_acc ON friends (id_acc)"
    ];

    foreach ($indexes as $sql) {
        update($sql);
    }
}

// 13. Дополнительные статистические таблицы
$statTables = [
    's_stat' => "CREATE TABLE `s_stat` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `all_friends` INT(11) NOT NULL,
        `created` INT(11) NOT NULL,
        `type` INT(11) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB",

    'stat_rss' => "CREATE TABLE `stat_rss` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `id_acc` INT NOT NULL,
        `url` VARCHAR(255) NOT NULL,
        `created` INT(25) NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB",

    'st_gr' => "CREATE TABLE `st_gr` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `gr` INT NOT NULL,
        `post` INT(11) NOT NULL,
        `id_acc` INT(11) NOT NULL,
        `list` INT(11) NOT NULL,
        `created` INT(25) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB"
];

foreach ($statTables as $tableName => $createSql) {
    if (!tableExists($tableName)) {
        create($createSql);
    }
}

// 14. Конвертация кодировки
$sql = "ALTER TABLE value_lists CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
create($sql);

// 15. Selected values
if (!tableExists('selected_values')) {
    $sql = "CREATE TABLE selected_values (
        id INT AUTO_INCREMENT PRIMARY KEY,
        value_id INT,
        post INT,
        id_acc INT,
        task INT(11) NOT NULL,
        created INT(25),
        UNIQUE KEY (value_id)
    )";
    create($sql);
}

// 16. Сообщения
if (!tableExists('mess')) {
    $sql = "CREATE TABLE `mess` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `id_acc` INT NOT NULL,
        `url` VARCHAR(700) NOT NULL,
        `text_mess` VARCHAR(700) NULL,
        `answer` INT NULL,
        `name` VARCHAR(250) NULL,
        `data_mess` INT(24) NULL,
        `type` INT NULL,
        PRIMARY KEY (`id`),
        UNIQUE(`url`),
        UNIQUE(`text_mess`)
    ) ENGINE = InnoDB";
    create($sql);
}

if (!tableExists('join_group')) {
    $sql = "CREATE TABLE join_group (
        id INT AUTO_INCREMENT PRIMARY KEY,
        id_acc INT NOT NULL,
        url VARCHAR(250) NOT NULL,
        join_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        INDEX idx_id_acc (id_acc),
        INDEX idx_join_date (join_date)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    create($sql);
}

// 17. Почта и логи
$emailTables = [
    'bad_mail' => "CREATE TABLE `bad_mail` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `mail` VARCHAR(255) NOT NULL,
        `pass_mail` VARCHAR(255) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB",

    'hm' => "CREATE TABLE `hm` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `mail` VARCHAR(150) NOT NULL,
        `pass_mail` VARCHAR(150) NOT NULL,
        `hm` VARCHAR(150) NULL,
        `hmpass` VARCHAR(150) NULL,
        `phone` VARCHAR(150) NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB"
];

foreach ($emailTables as $tableName => $createSql) {
    if (!tableExists($tableName)) {
        create($createSql);
    }
}

// 18. Группы и постинг
if (!tableExists('groups')) {
    $sql = "CREATE TABLE `groups` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `group` VARCHAR(255) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB";
    create($sql);
}

// 19. Обновление длин полей
$varcharUpdates = [
    "ALTER TABLE `task` CHANGE `setup` `setup` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL",
    "ALTER TABLE `temp_task` CHANGE `setup` `setup` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL",
    "ALTER TABLE `template` CHANGE `setup` `setup` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL",
    "ALTER TABLE `value_lists` CHANGE `value` `value` VARCHAR(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL"
];

foreach ($varcharUpdates as $sql) {
    create($sql);
}

// 20. Группы аккаунтов
if (!tableExists('a_groups')) {
    $sql = "CREATE TABLE `a_groups` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `id_acc` INT(11) NOT NULL,
        `group` VARCHAR(255) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB";
    create($sql);
}

// 21. SMS сервисы
if (!tableExists('sms_services')) {
    $sql = "CREATE TABLE `sms_services` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(50) NOT NULL COMMENT 'Системное название',
        `title` VARCHAR(100) NOT NULL COMMENT 'Название для интерфейса',
        `api_url` VARCHAR(255) NOT NULL,
        `api_key` VARCHAR(255) NULL,
        `is_active` BOOLEAN DEFAULT TRUE,
        `balance` DECIMAL(10,2) DEFAULT NULL,
        `balance_updated` DATETIME NULL,
        `proxy_id` INT(11) DEFAULT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        UNIQUE KEY `uk_name` (`name`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    create($sql);
}

// 22. Добавляем API ключ для пользователей
if (!columnExists('users', 'api_key')) {
    $sql = "ALTER TABLE `users` ADD `api_key` VARCHAR(64) NULL DEFAULT NULL AFTER `pass`";
    create($sql);
}

// 23. Прокси серверы
if (!tableExists('proxy_servers')) {
    $sql = "CREATE TABLE `proxy_servers` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `proxy_url` VARCHAR(255) NOT NULL COMMENT 'Полный URL прокси',
        `proxy_type` VARCHAR(20) NOT NULL DEFAULT 'http' COMMENT 'Тип прокси',
        `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
        `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    create($sql);
}

// 24. Опции регистрации
if (!tableExists('reg_options')) {
    $sql = "CREATE TABLE reg_options (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        proxy_group INT,
        server INT,
        account_group INT,
        email INT,
        registration_method INT,
        link_email INT,
        gender INT,
        avatar INT,
        city INT,
        first_name INT,
        last_name INT,
        mcc_mnc_source TINYINT DEFAULT NULL,
        mode INT,
        bio INT(11) NOT NULL DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        UNIQUE KEY (user_id)
    )";
    create($sql);
}

// 25. Добавляем недостающие статусы
$missingStatuses = ['BLOCK', 'LANG', 'vselphy'];
foreach ($missingStatuses as $status) {
    $sql = "SELECT * FROM `status` WHERE `status` = ?";
    $qw = select($sql, [$status]);
    if (empty($qw)) {
        $sql = "INSERT INTO `status` (`status`) VALUES (?)";
        insert($sql, [$status]);
    }
}

// 26. Добавляем недостающую категорию
$sql = "SELECT * FROM `cat_lists` WHERE `id` = 13 AND `name` = 'Email lists'";
$row = select($sql);
if (!$row) {
    $sql = "INSERT INTO `cat_lists` (`id`, `cat`, `name`) VALUES (13, 13, 'Email lists')";
    insert($sql);
}

