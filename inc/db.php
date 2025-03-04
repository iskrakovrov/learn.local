
<?php
ini_set('max_execution_time', 3600);
ini_set('max_input_vars', 10000);
ini_set('upload_max_filesize', '999M');
ini_set('post_max_size', '999M');
ini_set('max_input_time', 9999);

require_once('inc/config.php');

$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'"];

try {
    $pdo = new PDO(
        "$driver:host=$host;dbname=$db_name;charset=$charset", $db_user, $db_pass, $options
    );
} catch (PDOException $i) {
    die('Ошибка подключения к базе данных');
}
