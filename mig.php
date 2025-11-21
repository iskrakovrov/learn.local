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
    ) ENGINE = InnoDB",

    'note' => "CREATE TABLE `note` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `created` INT(11) NOT NULL,
        `text` TEXT(16000) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB",

    'stat_share' => "CREATE TABLE `stat_share` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `created` INT(20) NOT NULL,
        `url` VARCHAR(255) NOT NULL,
        `id_fb` BIGINT(20) NOT NULL,
        `id_acc` INT(11) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB",

    'all_stat' => "CREATE TABLE `all_stat` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `all_friends` INT(11) NOT NULL,
        `created` INT(11) NOT NULL,
        `type` INT(11) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB",

    'instagram' => "CREATE TABLE `instagram` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `login_i` VARCHAR(255) NOT NULL,
        `pass_i` VARCHAR(255) NOT NULL,
        `mail` VARCHAR(255) NULL,
        `pass_mail` VARCHAR(255) NULL,
        `cookies_i` LONGTEXT NULL,
        `id_acc` INT(11) NULL,
        `id_fb` BIGINT(255) NULL,
        `created` INT(11) NULL,
        `sch` INT(11) NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB"
];

foreach ($additionalTables as $tableName => $createSql) {
    if (!tableExists($tableName)) {
        create($createSql);
    }
}

// Добавляем столбец step_order в таблицу template
if (!columnExists('template', 'step_order')) {
    $sql = "ALTER TABLE `template` ADD `step_order` INT(11) NOT NULL DEFAULT 0 AFTER `task`";
    create($sql);
    
    // Обновляем существующие записи, устанавливая порядок по ID
    $sql = "UPDATE `template` SET `step_order` = `id` WHERE `step_order` = 0";
    create($sql);
    
    // Добавляем индекс для оптимизации сортировки
    if (!indexExists('template', 'idx_step_order')) {
        $sql = "ALTER TABLE `template` ADD INDEX `idx_step_order` (`id_template`, `step_order`)";
        create($sql);
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

// 35. Таблица использования почты
if (!tableExists('use_mail')) {
    $sql = "CREATE TABLE `use_mail` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `mail` VARCHAR(255) NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `unique_mail` (`mail`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    create($sql);
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

// 27. Таблица IMAP настроек для почтовых серверов
if (!tableExists('imap_settings')) {
    $sql = "CREATE TABLE `imap_settings` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `name_mail` VARCHAR(255) NOT NULL COMMENT 'Название почтового сервиса',
        `imap_server` VARCHAR(255) NOT NULL COMMENT 'IMAP сервер',
        `port` INT(5) NOT NULL COMMENT 'Порт IMAP',
        `encryption` VARCHAR(10) NOT NULL DEFAULT 'ssl' COMMENT 'Шифрование (ssl/tls/none)',
        `catchall` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '1 - catchall сервер, 0 - обычный сервер',
        `catchall_login` VARCHAR(255) NULL COMMENT 'Логин для catchall ящика',
        `catchall_password` VARCHAR(255) NULL COMMENT 'Пароль для catchall ящика',
        `active` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '1 - активно, 0 - неактивно',
        `max_emails_per_hour` INT(11) DEFAULT 50 COMMENT 'Максимум писем в час',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        INDEX `idx_active` (`active`),
        INDEX `idx_catchall` (`catchall`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    create($sql);

    // Добавляем примеры популярных IMAP серверов
    $defaultImapSettings = [
        [
            'name_mail' => 'Gmail',
            'imap_server' => 'imap.gmail.com',
            'port' => 993,
            'encryption' => 'ssl',
            'catchall' => 0
        ],
        [
            'name_mail' => 'Outlook',
            'imap_server' => 'outlook.office365.com',
            'port' => 993,
            'encryption' => 'ssl',
            'catchall' => 0
        ],
        [
            'name_mail' => 'Yandex',
            'imap_server' => 'imap.yandex.ru',
            'port' => 993,
            'encryption' => 'ssl',
            'catchall' => 0
        ]
    ];

    foreach ($defaultImapSettings as $setting) {
        $sql = "INSERT INTO `imap_settings` 
                (`name_mail`, `imap_server`, `port`, `encryption`, `catchall`) 
                VALUES (?, ?, ?, ?, ?)";
        insert($sql, [
            $setting['name_mail'],
            $setting['imap_server'],
            $setting['port'],
            $setting['encryption'],
            $setting['catchall']
        ]);
    }
}

// 28. Дополнительные таблицы из второго файла
$additionalTablesFromSecond = [
    'post_group' => "CREATE TABLE `post_group` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `id_acc` INT(11) NOT NULL,
        `id_gr` INT(11) NOT NULL,
        `created` INT(25) NOT NULL,
        `type` INT(11) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB",

    'post_logs' => "CREATE TABLE post_logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        group_id INT NOT NULL,
        project_id INT NOT NULL,
        post_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (group_id) REFERENCES value_lists(id)
    )",

    'current_position' => "CREATE TABLE current_position (
        project_id INT PRIMARY KEY,
        last_group_id INT
    )",

    'group_locks' => "CREATE TABLE group_locks (
        group_id INT NOT NULL,
        project_id INT NOT NULL,
        locked_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (group_id, project_id),
        FOREIGN KEY (group_id) REFERENCES value_lists(id)
    )",

    'smsService' => "CREATE TABLE `smsService` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `service` VARCHAR(255) NOT NULL,
        `domain` VARCHAR(255) NOT NULL,
        `apikey` VARCHAR(255) NULL,
        `type` VARCHAR(50) NULL,
        PRIMARY KEY (`id`),
        UNIQUE (`service`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",

    'country1' => "CREATE TABLE country1 (
        id INT PRIMARY KEY,
        name VARCHAR(255) NOT NULL
    )",

    'service_countries' => "CREATE TABLE `service_countries` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `service_id` int(11) NOT NULL,
        `country_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
        `country_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `service_country` (`service_id`,`country_code`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",

    'proxy_usage' => "CREATE TABLE `proxy_usage` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `proxy_id` int(11) NOT NULL,
        `last_used` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `usage_count` int(11) NOT NULL DEFAULT 0,
        `is_active` tinyint(1) NOT NULL DEFAULT 1,
        PRIMARY KEY (`id`),
        UNIQUE KEY `proxy_id` (`proxy_id`),
        FOREIGN KEY (`proxy_id`) REFERENCES `proxy`(`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",

    'vm_work' => "CREATE TABLE `vm_work` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name_vm` varchar(255) NOT NULL,
        `дата_создания` datetime DEFAULT current_timestamp(),
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    'mail_is' => "CREATE TABLE `mail_is` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `mail` INT NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB"
];

foreach ($additionalTablesFromSecond as $tableName => $createSql) {
    if (!tableExists($tableName)) {
        create($createSql);
    }
}

// 29. Таблицы устройств (выполняются через require)
$deviceTables = [
    'samsung_devices',
    'google_devices', 
    'huawei_devices',
    'oneplus_devices',
    'xiaomi_devices',
    'oppo_devices'
];

foreach ($deviceTables as $tableName) {
    if (!tableExists($tableName)) {
        $phoneFile = 'phone/' . str_replace('_devices', '', $tableName) . '.php';
        if (file_exists($phoneFile)) {
            require $phoneFile;
        }
    }
}

// 30. Заполняем таблицу country1 данными
$sql = "SELECT COUNT(*) as count FROM country1";
$qw = select($sql);
if ($qw['count'] == 0) {
    $countriesData = [
        0 => 'Russia', 1 => 'Ukraine', 2 => 'Kazakhstan', 3 => 'China', 4 => 'Philippines',
        5 => 'Myanmar', 6 => 'Indonesia', 7 => 'Malaysia', 8 => 'Kenya', 9 => 'Tanzania',
        10 => 'Vietnam', 11 => 'Kyrgyzstan', 13 => 'Israel', 14 => 'Hong Kong', 15 => 'Poland',
        16 => 'United Kingdom', 17 => 'Madagascar', 18 => 'Dem. Congo', 19 => 'Nigeria',
        20 => 'Macau', 21 => 'Egypt', 22 => 'India', 23 => 'Ireland', 24 => 'Cambodia',
        25 => 'Laos', 26 => 'Haiti', 27 => 'Ivory Coast', 28 => 'Gambia', 29 => 'Serbia',
        30 => 'Yemen', 31 => 'South Africa', 32 => 'Romania', 33 => 'Colombia', 34 => 'Estonia',
        35 => 'Azerbaijan', 36 => 'Canada', 37 => 'Morocco', 38 => 'Ghana', 39 => 'Argentina',
        40 => 'Uzbekistan', 41 => 'Cameroon', 42 => 'Chad', 43 => 'Germany', 44 => 'Lithuania',
        45 => 'Croatia', 46 => 'Sweden', 47 => 'Iraq', 48 => 'Netherlands', 49 => 'Latvia',
        50 => 'Austria', 51 => 'Belarus', 52 => 'Thailand', 53 => 'Saudi Arabia', 54 => 'Mexico',
        55 => 'Taiwan', 56 => 'Spain', 57 => 'Iran', 58 => 'Algeria', 59 => 'Slovenia',
        60 => 'Bangladesh', 61 => 'Senegal', 62 => 'Turkey', 63 => 'Czech Republic', 64 => 'Sri Lanka',
        65 => 'Peru', 66 => 'Pakistan', 67 => 'New Zealand', 68 => 'Guinea', 69 => 'Mali',
        70 => 'Venezuela', 71 => 'Ethiopia', 72 => 'Mongolia', 73 => 'Brazil', 74 => 'Afghanistan',
        75 => 'Uganda', 76 => 'Angola', 77 => 'Cyprus', 78 => 'France', 79 => 'Papua New Guinea',
        80 => 'Mozambique', 81 => 'Nepal', 82 => 'Belgium', 83 => 'Bulgaria', 84 => 'Hungary',
        85 => 'Moldova', 86 => 'Italy', 87 => 'Paraguay', 88 => 'Honduras', 89 => 'Tunisia',
        90 => 'Nicaragua', 91 => 'Timor-Leste', 92 => 'Bolivia', 93 => 'Costa Rica', 94 => 'Guatemala',
        95 => 'UAE', 96 => 'Zimbabwe', 97 => 'Puerto Rico', 98 => 'Sudan', 99 => 'Togo',
        100 => 'Kuwait', 101 => 'El Salvador', 102 => 'Libya', 103 => 'Jamaica', 104 => 'Trinidad and Tobago',
        105 => 'Ecuador', 106 => 'Eswatini', 107 => 'Oman', 108 => 'Bosnia and Herzegovina', 109 => 'Dominican Republic',
        110 => 'Syria', 111 => 'Qatar', 112 => 'Panama', 113 => 'Cuba', 114 => 'Mauritania',
        115 => 'Sierra Leone', 116 => 'Jordan', 117 => 'Portugal', 118 => 'Barbados', 119 => 'Burundi',
        120 => 'Benin', 121 => 'Brunei', 122 => 'Bahamas', 123 => 'Botswana', 124 => 'Belize',
        125 => 'Central African Republic', 126 => 'Dominica', 127 => 'Grenada', 128 => 'Georgia',
        129 => 'Greece', 130 => 'Guinea-Bissau', 131 => 'Guyana', 132 => 'Iceland', 133 => 'Comoros',
        134 => 'Saint Kitts and Nevis', 135 => 'Liberia', 136 => 'Lesotho', 137 => 'Malawi',
        138 => 'Namibia', 139 => 'Niger', 140 => 'Rwanda', 141 => 'Slovakia', 142 => 'Suriname',
        143 => 'Tajikistan', 144 => 'Monaco', 145 => 'Bahrain', 146 => 'Reunion', 147 => 'Zambia',
        148 => 'Armenia', 149 => 'Somalia', 150 => 'Congo', 151 => 'Chile', 152 => 'Burkina Faso',
        153 => 'Lebanon', 154 => 'Gabon', 155 => 'Albania', 156 => 'Uruguay', 157 => 'Mauritius',
        158 => 'Bhutan', 159 => 'Maldives', 160 => 'Guadeloupe', 161 => 'Turkmenistan', 162 => 'French Guiana',
        163 => 'Finland', 164 => 'Saint Lucia', 165 => 'Luxembourg', 166 => 'Saint Vincent and the Grenadines',
        167 => 'Equatorial Guinea', 168 => 'Djibouti', 169 => 'Antigua and Barbuda', 170 => 'Cayman Islands',
        171 => 'Montenegro', 172 => 'Denmark', 173 => 'Switzerland', 174 => 'Norway', 175 => 'Australia',
        176 => 'Eritrea', 177 => 'South Sudan', 178 => 'Sao Tome and Principe', 179 => 'Aruba',
        180 => 'Montserrat', 181 => 'Anguilla', 182 => 'Japan', 183 => 'North Macedonia', 184 => 'Seychelles',
        185 => 'New Caledonia', 186 => 'Cape Verde', 187 => 'USA', 188 => 'Palestine', 189 => 'Fiji',
        196 => 'Singapore', 199 => 'Malta', 201 => 'Gibraltar', 203 => 'Kosovo', 204 => 'Niue'
    ];

    foreach ($countriesData as $id => $name) {
        $sql = "INSERT INTO country1 (id, name) VALUES (?, ?)";
        insert($sql, [$id, $name]);
    }
}

// 31. Добавляем SMS сервисы по умолчанию
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

foreach ($defaultServices as $service) {
    $sql = "SELECT id FROM sms_services WHERE name = ?";
    $qw = select($sql, [$service['name']]);
    if (empty($qw)) {
        $sql = "INSERT INTO sms_services (name, title, api_url, is_active) VALUES (?, ?, ?, ?)";
        insert($sql, [
            $service['name'],
            $service['title'], 
            $service['api_url'],
            (int)$service['is_active']
        ]);
    }
}

// 32. Заполняем таблицу service_countries
$sql = "SELECT COUNT(*) as count FROM service_countries";
$qw = select($sql);
if ($qw['count'] == 0) {
    $countriesMapping = [
        "0" => "Russia", "1" => "Ukraine", "2" => "Kazakhstan", "3" => "China", "4" => "Philippines",
        "5" => "Myanmar", "6" => "Indonesia", "7" => "Malaysia", "8" => "Kenya", "9" => "Tanzania",
        "10" => "Vietnam", "11" => "Kyrgyzstan", "13" => "Israel", "14" => "Hong Kong", "15" => "Poland",
        "16" => "United Kingdom", "17" => "Madagascar", "18" => "DR Congo", "19" => "Nigeria",
        "20" => "Macau", "21" => "Egypt", "22" => "India", "23" => "Ireland", "24" => "Cambodia",
        "25" => "Laos", "26" => "Haiti", "27" => "Ivory Coast", "28" => "Gambia", "29" => "Serbia",
        "30" => "Yemen", "31" => "South Africa", "32" => "Romania", "33" => "Colombia", "34" => "Estonia",
        "35" => "Azerbaijan", "36" => "Canada", "37" => "Morocco", "38" => "Ghana", "39" => "Argentina",
        "40" => "Uzbekistan", "41" => "Cameroon", "42" => "Chad", "43" => "Germany", "44" => "Lithuania",
        "45" => "Croatia", "46" => "Sweden", "47" => "Iraq", "48" => "Netherlands", "49" => "Latvia",
        "50" => "Austria", "51" => "Belarus", "52" => "Thailand", "53" => "Saudi Arabia", "54" => "Mexico",
        "55" => "Taiwan", "56" => "Spain", "57" => "Iran", "58" => "Algeria", "59" => "Slovenia",
        "60" => "Bangladesh", "61" => "Senegal", "62" => "Turkey", "63" => "Czech Republic", "64" => "Sri Lanka",
        "65" => "Peru", "66" => "Pakistan", "67" => "New Zealand", "68" => "Guinea", "69" => "Mali",
        "70" => "Venezuela", "71" => "Ethiopia", "72" => "Mongolia", "73" => "Brazil", "74" => "Afghanistan",
        "75" => "Uganda", "76" => "Angola", "77" => "Cyprus", "78" => "France", "79" => "Papua New Guinea",
        "80" => "Mozambique", "81" => "Nepal", "82" => "Belgium", "83" => "Bulgaria", "84" => "Hungary",
        "85" => "Moldova", "86" => "Italy", "87" => "Paraguay", "88" => "Honduras", "89" => "Tunisia",
        "90" => "Nicaragua", "91" => "Timor-Leste", "92" => "Bolivia", "93" => "Costa Rica", "94" => "Guatemala",
        "95" => "United Arab Emirates", "96" => "Zimbabwe", "97" => "Puerto Rico", "98" => "Sudan", "99" => "Togo",
        "100" => "Kuwait", "101" => "El Salvador", "102" => "Libya", "103" => "Jamaica", "104" => "Trinidad and Tobago",
        "105" => "Ecuador", "106" => "Eswatini", "107" => "Oman", "108" => "Bosnia and Herzegovina", "109" => "Dominican Republic",
        "110" => "Syria", "111" => "Qatar", "112" => "Panama", "113" => "Cuba", "114" => "Mauritania",
        "115" => "Sierra Leone", "116" => "Jordan", "117" => "Portugal", "118" => "Barbados", "119" => "Burundi",
        "120" => "Benin", "121" => "Brunei", "122" => "Bahamas", "123" => "Botswana", "124" => "Belize",
        "125" => "Central African Republic", "126" => "Dominica", "127" => "Grenada", "128" => "Georgia",
        "129" => "Greece", "130" => "Guinea-Bissau", "131" => "Guyana", "132" => "Iceland", "133" => "Comoros",
        "134" => "Saint Kitts and Nevis", "135" => "Liberia", "136" => "Lesotho", "137" => "Malawi",
        "138" => "Namibia", "139" => "Niger", "140" => "Rwanda", "141" => "Slovakia", "142" => "Suriname",
        "143" => "Tajikistan", "144" => "Monaco", "145" => "Bahrain", "146" => "Réunion", "147" => "Zambia",
        "148" => "Armenia", "149" => "Somalia", "150" => "Congo", "151" => "Chile", "152" => "Burkina Faso",
        "153" => "Lebanon", "154" => "Gabon", "155" => "Albania", "156" => "Uruguay", "157" => "Mauritius",
        "158" => "Bhutan", "159" => "Maldives", "160" => "Guadeloupe", "161" => "Turkmenistan", "162" => "French Guiana",
        "163" => "Finland", "164" => "Saint Lucia", "165" => "Luxembourg", "166" => "Saint Vincent and the Grenadines",
        "167" => "Equatorial Guinea", "168" => "Djibouti", "169" => "Antigua and Barbuda", "170" => "Cayman Islands",
        "171" => "Montenegro", "172" => "Denmark", "173" => "Switzerland", "174" => "Norway", "175" => "Australia",
        "176" => "Eritrea", "177" => "South Sudan", "178" => "Sao Tome and Principe", "179" => "Aruba",
        "180" => "Montserrat", "181" => "Anguilla", "182" => "Japan", "183" => "North Macedonia", "184" => "Seychelles",
        "185" => "New Caledonia", "186" => "Cape Verde", "187" => "United States", "188" => "Palestine", "189" => "Fiji",
        "196" => "Singapore", "199" => "Malta", "201" => "Gibraltar", "203" => "Kosovo", "204" => "Niue"
    ];

    foreach ($countriesMapping as $code => $name) {
        $sql = "INSERT INTO service_countries (service_id, country_code, country_name) VALUES (0, ?, ?)";
        insert($sql, [$code, $name]);
    }
}

// 33. Проверяем и добавляем недостающие столбцы
$missingColumns = [
    'sms_services' => [
        'balance' => "ALTER TABLE `sms_services` ADD `balance` DECIMAL(10,2) DEFAULT NULL AFTER `is_active`",
        'balance_updated' => "ALTER TABLE `sms_services` ADD `balance_updated` DATETIME NULL AFTER `balance`",
        'proxy_id' => "ALTER TABLE `sms_services` ADD COLUMN `proxy_id` INT(11) DEFAULT NULL AFTER `api_key`"
    ],
    'reg_options' => [
        'mcc_mnc_source' => "ALTER TABLE `reg_options` ADD `mcc_mnc_source` TINYINT DEFAULT NULL AFTER `last_name`",
        'bio' => "ALTER TABLE `reg_options` ADD `bio` INT(11) NOT NULL DEFAULT 0 AFTER `mode`"
    ]
];

foreach ($missingColumns as $table => $columns) {
    foreach ($columns as $column => $sql) {
        if (!columnExists($table, $column)) {
            create($sql);
        }
    }
}

// 34. Создаем таблицу mcc_mnc если нужно
if (!tableExists('mcc_mnc')) {
    require_once('function/mcc.php');
}
?>