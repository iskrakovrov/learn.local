<?php
require_once('inc/db.php'); // Подключаем файл с настройками подключения к базе данных
function tt($value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}

//Проверка выполнения запроса дк б
// Функция обработки ошибок базы данных
function dbCheckError($query) {
    $errorInfo = $query->errorInfo();
    if ($errorInfo[0] !== PDO::ERR_NONE) {
        // Лучше не выводить ошибку на экран, а логировать ее
        error_log("Error: " . $errorInfo[2]);
        return false;
    }
    return true;
}

// Запрос Select к базе данных (возвращает одну строку)
function select($sql, $args = []) {
    global $pdo;
    $query = $pdo->prepare($sql);
    if ($query->execute($args)) {
        if (dbCheckError($query)) {
            return $query->fetch(PDO::FETCH_ASSOC);
        }
    }
    return false;
}

// Запрос Select к базе данных (возвращает все строки)
function selectAll($sql, $args = []) {
    global $pdo;
    $query = $pdo->prepare($sql);
    if ($query->execute($args)) {
        if (dbCheckError($query)) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    return false;
}


function execute($sql, $args = []): bool
{
    global $pdo;
    $query = $pdo->prepare($sql);
    if ($query->execute($args)) {
        return dbCheckError($query);
    }
    return false;
}

function insert($ins, $args = []): bool
{
    return execute($ins, $args);
}

function update($upd, $args = []): bool
{

    return execute($upd, $args);


}

function get_extension($imagetype)
{
    if (empty($imagetype)) return false;
    switch ($imagetype) {
        case 'image/bmp':
            return '.bmp';
        case 'image/cis-cod':
            return '.cod';
        case 'image/gif':
            return '.gif';
        case 'image/ief':
            return '.ief';
        case 'image/jpeg':
            return '.jpg';
        case 'image/pipeg':
            return '.jfif';
        case 'image/tiff':
            return '.tif';
        case 'image/x-cmu-raster':
            return '.ras';
        case 'image/x-cmx':
            return '.cmx';
        case 'image/x-icon':
            return '.ico';
        case 'image/x-portable-anymap':
            return '.pnm';
        case 'image/x-portable-bitmap':
            return '.pbm';
        case 'image/x-portable-graymap':
            return '.pgm';
        case 'image/x-portable-pixmap':
            return '.ppm';
        case 'image/x-rgb':
            return '.rgb';
        case 'image/x-xbitmap':
            return '.xbm';
        case 'image/x-xpixmap':
            return '.xpm';
        case 'image/x-xwindowdump':
            return '.xwd';
        case 'image/png':
            return '.png';
        case 'image/x-jps':
            return '.jps';
        case 'image/x-freehand':
            return '.fh';
        default:
            return false;
    }
}



function delete($del, $args = []): string
{

    return execute($del, $args);

}

function parse_proxy($pr, $comm, $pg): ?array
{
    if ($pg == 0) {
        $pg = 'null';
    }

    $link = explode("|", $pr);
    $prx = $link[0];
    $arr_pr = parse_url($prx);

    $mode = $arr_pr['scheme'] ?? 'http';
    $host = $arr_pr['host'] ?? null;
    $port = $arr_pr['port'] ?? null;
    $user = $arr_pr['user'] ?? null;
    $pass = $arr_pr['pass'] ?? null;
    $link = $link[1] ?? 'NULL';
    $comm = $comm ?? 'NULL';

    if (empty($host)) {
        return null;
    }

    $time = time();
    $sql1 = "SELECT * FROM proxy WHERE proxy = '$pr'";
    $sql = "INSERT INTO `proxy` (`id`, `protocol`, `proxy`, `ip`, `port`, `login`, `pswd`, `link_proxy`, `status`, `work`, `created`, `comment`, `use_proxy`, `group_proxy`) VALUES (NULL, '$mode', '$pr', '$host', '$port', '$user', '$pass', '$link', 'ok','0', '$time', '$comm', 0, $pg)";
    return [$sql, $sql1];
}

function parse_acc1($acc, $comm, $serv, $group): ?array
{


    $accs = explode(';', $acc);
    $login = $accs[0];
    $pass = $accs[1];
    if (empty($login)) {
        return null;

    }
    if (empty($pass)) {
        return null;
    }
    $sql = "SELECT * FROM accounts WHERE login_fb = '$login'";
    $querty = selectAll($sql);
    if (!empty($querty)) {
        return null;
    }
    $time = Time();
    $sql = "INSERT INTO `accounts` (`id`, `login_fb`, `pass_fb`, `id_fb`, `name`, `bd`, `mb`, `yb`, `gender`, `avatar`, `created`, `comment`, `group_acc`, `server`, `id_proxy`, `status`, `works`, `useacc`, `friends`, `last_start`) VALUES (NULL, '$login', '$pass', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$time', '$comm', '$group', '$serv', NULL, '1', NULL, NULL, NULL, NULL)";
    return [$sql];

}

function parse_acc2($acc, $comm, $serv, $group, $cock, $pg)
{

    if (empty($comm)) {
        $comm = null;
    }

    $accs = explode(";", $acc);
    $login = $accs[0];
    $pass = $accs[1];
    if (empty($login)) {
        $sql = null;
        return;

    }
    if (empty($pass)) {
        $sql = null;
        return;
    }
    $mail = $accs[2];
    $passmail = $accs [3];
    $imappass = $accs[4];
    $fa = $accs[5];
    $phone = $accs [6];
    $cock = $accs [7];
    $bd = $accs [8];
    $mb = $accs [9];
    $yb = $accs [10];
    $sql = 'SELECT * FROM accounts WHERE login_fb = ?';
    $args = [$login];
    $querty = select($sql, $args);
    if (!empty($querty)) {
        $sql = null;
        return;
    }
    if (empty($phone)) {
        $id_phone = 'NULL';
    } else {
        $phone = trim($phone, '+');


    }
    if (empty($passmail)) {
        $passmail = 'NULL';

    }
    if (empty($imappass)) {
        $imappass = 'NULL';
    }
    if (empty($mail)) {
        $id_mail = 'NULL';
    }
    if (empty($cock)) {
        $cock = 'NULL';
    }
    if (empty($fa)) {
        $fa = 'NULL';
    }
    if (empty($bd)) {
        $bd = 'NULL';
    }
    if (empty($mb)) {
        $mb = 'NULL';
    }
    if (empty($yb)) {
        $yb = 'NULL';
    }

    $time = Time();

    $sql = "INSERT INTO accounts (id, login_fb, pass_fb, id_fb, name, bd, mb, yb, gender, avatar, created, comment, group_acc, server, id_proxy, status, works, useacc, friends, last_start, id_mail, id_phone, coockie, tocken, 2fa, ua, mail, mail_pass, imap_mail, phone, adv, gpoup_proxy) VALUES (NULL,'$login', '$pass', NULL, NULL, '$bd', '$mb', '$yb', NULL, NULL, $time, '$comm', $group, $serv,NULL, 19, 0, 0, NULL, NULL, NULL, NULL, '$cock', NULL, '$fa', NULL, '$mail', '$passmail', '$imappass', '$phone', 0, $pg)";

    return [$sql];

}


function add_task($add_task, $json_data, $time, $account) {
    $a = $account;

    $sql = 'SELECT id FROM task WHERE task = ? AND account = ?';
    $args = [$add_task, $a];
    $query = select($sql, $args);

    if (empty($query)) {
        $sql = 'INSERT INTO task (id, account, task, setup, created) VALUES (NULL, ?, ?, ?, ?)';
        $args = [$a, $add_task, $json_data, $time];
    } else {
        $sql = 'UPDATE task SET setup = ?, created = ? WHERE id = ?';
        $args = [$json_data, $time, $query['id']];
    }

    $query = execute($sql, $args);
}

function parse_key($key): array
{

    if (empty($key)) {
        $sql = null;
    } else {
        $cat = $_REQUEST['id'];
        $sql = "SELECT * FROM value_lists WHERE list = $cat AND value = ?";
        $args = [$key];
        $query = select($sql, $args);
        if (empty($query)) {

            $sql = "INSERT INTO value_lists (id,value,list) VALUES (NULL, ?, $cat )";

        } else {
            $sql = null;
        }
    }
    return [$sql];
}

function parse_name($key): array
{

    if (empty($key)) {
        $sql = null;
    } else {
        $cat = $_REQUEST['cat'];
        $sql = 'SELECT * FROM name_lists WHERE id_list = ? AND value = ?';
        $args = [$cat, $key];
        $query = select($sql, $args);
        if (empty($query)) {
            $sql = "INSERT INTO name_lists (id,value,id_list) VALUES (NULL, '$key', $cat )";
        } else {
            $sql = null;
        }
    }
    return [$sql];
}

function create($create)
{
    global $pdo;
    $sql = $create;
    try {
        $query = $pdo->prepare($sql);
        $query->execute();
    } catch(PDOException $e) {
        echo 'Error: Unable to execute query. SQL: ' . $sql . ' Error message: ' . $e->getMessage();
        die();
    }
    dbCheckError($query);
    return $query->fetchAll();
}

function parse_post($key, $folder)
{
    $folder = $_REQUEST['folder'];
    if (empty($folder)) {
        $folder = 'NULL';
    }
    if (empty($key)) {
        $sql = null;
    } else {
        $cat = $_REQUEST['id'];


        $sql = "INSERT INTO posts (id,cat,txt,img,tipe) VALUES (NULL, $cat, '$key' , '$folder', 1 )";

    }
    return [$sql];
}

function add_template($add_task, $json_data, $time, $numberTemplate)
{
    $a = $numberTemplate;
    $sql = 'INSERT INTO template (id, id_template, task, setup) VALUES (NULL, ?, ?, ?)';
    $args = [$a, $add_task, $json_data];
    $query = insert($sql, $args);


}

function checkAPIKey($apiKey) {
    $url = 'https://api.openai.com/v1/engines/text-davinci-003/completions';

    $headers = array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey
    );

    $data = array(
        'prompt' => 'Привет, как дела?'
    );

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    try {
        $response = curl_exec($ch);
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpStatus === 200) {
            $decodedResponse = json_decode($response, true);
            if (isset($decodedResponse['id']) && isset($decodedResponse['object']) && isset($decodedResponse['model'])) {
                return true; // Ключ действителен
            } else {
                $err1 = $decodedResponse['error'];
                $err = $err1['code'];
                return [false, $err];
            }
        } else {
            return false; // Неудачный HTTP-статус
        }
    } catch (Exception $e) {
        return false; // Ошибка CURL
    }
}


function checkAPIBalance($apiKey)
{


    $dates = getLast100Days();
    $startDate = $dates[0];
    $endDate = $dates[1];

// Создание URL с использованием полученных дат
    $url = 'https://api.openai.com/v1/dashboard/billing/usage?start_date=' . $startDate . '&end_date=' . $endDate;

    $headers = array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey
    );

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    curl_close($ch);

    if ($response === false) {
        return false; // Ошибка при отправке запроса
    }

    $decodedResponse = json_decode($response, true);

    if (isset($decodedResponse['total_usage'])) {
        $totalUsage = $decodedResponse['total_usage'];
        return $totalUsage; // Возвращает общее количество токенов
    } else {
        return false; // Не удалось получить информацию о балансе
    }
}

function getLast100Days()
{
    $endDate = date('Y-m-d'); // Текущая дата

    $startDate = date('Y-m-d', strtotime('-100 days', strtotime($endDate))); // Вычисление даты, отстоящей от текущей на 100 дней

    return array($startDate, $endDate); // Возвращает массив с начальной и конечной датами
}

function del_acc($args): bool
{
    extracted($args);

    return true;
}

/**
 * @param $args
 * @return void
 */
function d_acc($args): void
{
    global $pdo; // Используем глобальное соединение

    $sql = 'DELETE FROM task WHERE account = ?
            OR account = ?;

            DELETE FROM temp_task WHERE account = ?
            OR account = ?;

            DELETE FROM stat_comm WHERE id_acc = ?
            OR id_acc = ?;

            DELETE FROM stat_invite WHERE id_acc = ?
            OR id_acc = ?;

            DELETE FROM stat_like WHERE id_acc = ?
            OR id_acc = ?;

            DELETE FROM stat_post WHERE id_acc = ?
            OR id_acc = ?;

            DELETE FROM friends WHERE id_acc = ?
            OR id_acc = ?;

            DELETE FROM stat_sugg WHERE id_acc = ?
            OR id_acc = ?';

    try {
        $pdo->beginTransaction();

        // Выполняем объединенный SQL-запрос
        $deleteSuccess = execute($sql, array_merge(
            $args, $args, // Для таблицы task
            $args, $args, // Для таблицы temp_task
            $args, $args, // Для таблицы stat_comm
            $args, $args, // Для таблицы stat_invite
            $args, $args, // Для таблицы stat_like
            $args, $args, // Для таблицы stat_post
            $args, $args, // Для таблицы friends
            $args, $args  // Для таблицы stat_sugg
        ));

        // Если операция DELETE не выполнена успешно, откатываем транзакцию
        if (!$deleteSuccess) {
            $pdo->rollBack();
            // Обработка ошибки, например, логирование или вывод сообщения
            die("Ошибка при выполнении SQL-запросов");
        }

        // Если все операции DELETE выполнены успешно, фиксируем транзакцию
        $pdo->commit();

    } catch (PDOException $e) {
        $pdo->rollBack();
        // Обработка ошибки, например, логирование или вывод сообщения
        die("Ошибка при выполнении SQL-запросов: " . $e->getMessage());
    }
}

function gen_task($ids, $st, $add_task, $numberTemplate) {
    $data = array(
        'data' => $st,
    );

    try {
        $json_data = json_encode($data, JSON_THROW_ON_ERROR);
    } catch (JsonException $e) {
        // Обработка ошибки JSON, если необходимо
    }

    $time = Time();

    foreach ($ids as $a) {
        if ($a != 't') {
            add_task($add_task, $json_data, $time, $a);
        } else {
            add_template($add_task, $json_data, $time, $numberTemplate);
        }
    }
}

function check_proxy($pr) {
    $ip = $pr['ip'];
    $port = $pr['port'];
    $protocol = $pr['protocol'];
    $login = $pr['login'];
    $pswd = $pr['pswd'];

    $pr1 = "$ip:$port";
    $proxyauth = $login !== '' ? "$login:$pswd" : '';

    $url = 'http://ip-api.com/json';
    $ch = curl_init();

    $proxytype = $protocol === 'socks5' ? CURLPROXY_SOCKS5 : CURLPROXY_HTTP;

    curl_setopt_array($ch, [
        CURLOPT_PROXYTYPE => $proxytype,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36',
        CURLOPT_URL => $url,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_PROXY => $pr1,
        CURLOPT_PROXYUSERPWD => $proxyauth,
        CURLOPT_FOLLOWLOCATION => 1,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_HEADER => 0,
    ]);

    $curl_scraped_page = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($curl_scraped_page, true);
    $st = $response['status'] === 'success' ? $response['countryCode'] . ',' . $response['city'] : 'bad';
    $id = $pr['id'];

    $sql = "UPDATE proxy SET status = '$st' WHERE id = $id";
    update($sql);
}

function check_facebook_access($pr) {
    $ip = $pr['ip'];
    $port = $pr['port'];
    $protocol = $pr['protocol'];
    $login = $pr['login'];
    $pswd = $pr['pswd'];

    $pr1 = "$ip:$port";
    $proxyauth = $login !== '' ? "$login:$pswd" : '';

    $url = 'https://www.facebook.com';

    $ch = curl_init();

    $proxytype = $protocol === 'socks5' ? CURLPROXY_SOCKS5 : CURLPROXY_HTTP;

    curl_setopt_array($ch, [
        CURLOPT_PROXYTYPE => $proxytype,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36',
        CURLOPT_URL => $url,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_PROXY => $pr1,
        CURLOPT_PROXYUSERPWD => $proxyauth,
        CURLOPT_NOBODY => true, // Запрос только заголовков, чтобы уменьшить загрузку страницы
        CURLOPT_FOLLOWLOCATION => true, // Разрешить следовать перенаправлениям
    ]);

    curl_exec($ch);
    $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpStatus === 200 || ($httpStatus >= 301 && $httpStatus <= 303)) {
        $st = 'access_granted';
    } else {
        $st = 'access_denied';
    }

    $id = $pr['id'];

    $sql = "UPDATE proxy SET status = '$st' WHERE id = $id";
    update($sql);
}

function escapeString($string)
{
    global $pdo;

    return $pdo->quote($string);

}

function generate_article_with_markup($title, $keywords, $language, $api_key, $desired_lengths) {


    // Создаем заголовок статьи
    $article_content = '<!-- Заголовок статьи -->';
    $article_content .= '<h1>' . $title . '</h1>';

    // Добавляем мета-теги для поисковой оптимизации
    $article_content .= '<!-- Теги для поисковой оптимизации -->';
    $article_content .= '<meta name="keywords" content="' . $keywords . '">';
    $article_content .= '<meta name="description" content="' . $title . '">';

    // Получаем ключевые слова как массив
    $keywords_array = explode(', ', $keywords);

    // Генерируем текст для каждого ключевого слова (подзаголовки)
    foreach ($keywords_array as $index => $keyword) {
        // Получаем желаемую длину для текущей части статьи (подзаголовка)
        $desired_length = $desired_lengths[$index];

        // Генерируем текст с помощью OpenAI API
        $generated_text = generate_text_by_keyword($keyword, $language, $api_key, $desired_length);

        // Добавляем сгенерированный текст с подзаголовком в статью
        $article_content .= '<!-- Подзаголовок: ' . $keyword . ' -->';
        $article_content .= '<h2>' . $keyword . '</h2>';
        $article_content .= '<div class="article-content">';
        $article_content .= $generated_text;
        $article_content .= '</div>';

        // Добавляем задержку между запросами, чтобы не превышать лимиты
        sleep(30);
    }


    return $article_content;
}

// Функция для генерации текста по ключевому слову с помощью OpenAI API
function generate_text_by_keyword($keyword, $language, $api_key, $desired_length) {
    $url = 'https://api.openai.com/v1/chat/completions';

    // Формируем prompt с ключевым словом
    $prompt = "Тема: $keyword\nЯзык: $language\n\n";

    // Строка для хранения сгенерированного текста
    $generated_text = '';

    // Выполняем цикл до тех пор, пока не сгенерируем достаточное количество токенов
    while (strlen($generated_text) < $desired_length) {
        // Максимальное количество токенов, которое можно сгенерировать за один запрос
        $max_tokens_per_request = 4000;

        // Вычисляем количество токенов, которое нужно сгенерировать в текущем запросе
        $tokens_to_generate = min($desired_length - strlen($generated_text), $max_tokens_per_request);

        $data = array(
            'model' => 'text-davinci-003',
            'prompt' => $prompt . $generated_text,
            'max_tokens' => $tokens_to_generate,
            'temperature' => 0.7, // Уровень "творчества" генератора (от 0.2 до 1.0)
            'stop' => ['\n'], // Массив с условиями для остановки генерации текста
        );

        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $api_key,
        );

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);

        // Добавляем сгенерированный текст к общему результату
        $generated_text .= $result['choices'][0]['text'];
    }

    return $generated_text;
}
function generateAndExecuteTask($add_task, $st, $ids, $numberTemplate) {
    gen_task($ids, $st, $add_task, $numberTemplate);
}


function getAccountsData() {
    // $sql = 'SELECT
    //  accounts.id, login_fb, pass_fb, id_fb, name, gender, avatar, accounts.created, group_acc, account_tags,
//   server, id_proxy, status, works, useacc, friends, last_start, tocken, mail, phone,
//   adv, 2fa, ar, created_acc, ig, life, gpoup_proxy, COUNT(task.task) as task_count
//FROM
//   accounts
//LEFT JOIN
//   task ON accounts.id = task.account
//GROUP BY
    //  accounts.id'; // ваш SQL-запрос


    $sql = 'SELECT
    accounts.id,
    login_fb,
    pass_fb,
    id_fb,
    name,
    gender,
    avatar,
    accounts.created,
    group_acc,
    account_tags,
    server,
    id_proxy,
    status,
    works,
    useacc,
    friends,
    (
        SELECT friends
        FROM friends
        WHERE id_acc = accounts.id
        ORDER BY friends.created DESC
        LIMIT 1,1
    ) as friends1,
    last_start,
    tocken,
    mail,
    phone,
    adv,
    2fa,
    ar,
    created_acc,
    ig,
    life,
    gpoup_proxy,
    COUNT(task.task) as task_count
FROM
    accounts
LEFT JOIN
    task ON accounts.id = task.account
GROUP BY
    accounts.id
   ';
    return selectAll($sql);
}

function getGroupData() {
    $sql = 'SELECT * FROM group_acc';
    return selectAll($sql);
}

function getServerData() {
    $sql = 'SELECT * FROM servers';
    return selectAll($sql);
}

function getStatusData() {
    $sql = 'SELECT * FROM status';
    return selectAll($sql);
}

function getAccountTagsData() {
    $sql = 'SELECT * FROM account_tags';
    return selectAll($sql);
}
function getProxyGroup() {
    $sql = 'SELECT * FROM group_proxy';
    return selectAll($sql);
}
function beginTransaction() {
    global $pdo;
    return $pdo->beginTransaction();
}

function commit() {
    global $pdo;
    return $pdo->commit();
}

function rollBack() {
    global $pdo;
    return $pdo->rollBack();
}
function group_lock($group_id, $project_id) {
    global $pdo;
    $sql = 'INSERT INTO group_locks (group_id, project_id) VALUES (?, ?) 
            ON DUPLICATE KEY UPDATE locked_at = CURRENT_TIMESTAMP';

    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$group_id, $project_id]);
}

function group_unlock($group_id, $project_id) {
    global $pdo;
    $sql = 'DELETE FROM group_locks WHERE group_id = ? AND project_id = ?';
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$group_id, $project_id]);
}

function is_locked($group_id, $project_id) {
    global $pdo;
    $sql = 'SELECT COUNT(*) as count FROM group_locks WHERE group_id = ? AND project_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$group_id, $project_id]);
    return $stmt->fetchColumn() > 0;
}
// Функция для вставки данных в базу
function insertBatch($batch_data) {
    foreach ($batch_data as $item) {
        // Подготавливаем SQL-запрос для вставки данных
        $sql = 'INSERT INTO `hm` (`mail`, `pass_mail`, `hm`, `hmpass`, `phone`) 
                VALUES (:mail, :pass_mail, :hm, :hmpass, :phone)';

        // Выполняем вставку данных
        insert($sql, [
            'mail' => $item['mail'],
            'pass_mail' => $item['pass_mail'],
            'hm' => $item['hm'],
            'hmpass' => $item['hmpass'],
            'phone' => $item['phone']
        ]);
    }
}

// Функция для получения имени группы прокси
function getProxyGroupName($proxyGroupId, $proxyGroups) {
    foreach ($proxyGroups as $pgr) {
        if ($pgr['id'] == $proxyGroupId) {
            return $pgr['name_group'];
        }
    }
    return 'No group'; // Если группа не найдена
}

// Функция для получения имени группы аккаунта
function getGroupName($groupId, $groupData) {
    foreach ($groupData as $group) {
        if ($group['id'] == $groupId) {
            return $group['name_group'];
        }
    }
    return 'No Group'; // Если группа не найдена
}

// Функция для получения имени тега
function getTagName($tagId, $accountTagsData) {
    foreach ($accountTagsData as $tag) {
        if ($tag['id'] == $tagId) {
            return $tag['tag'];
        }
    }
    return 'No tag'; // Если тег не найден
}

// Функция для получения имени сервера
function getServerName($serverId, $getServerData) {
    foreach ($getServerData as $ser) {
        if ($ser['id'] == $serverId) {
            return $ser['name_server'];
        }
    }
    return 'No server'; // Если сервер не найден
}

// Функция для получения статуса аккаунта
function getStatusName($statusId, $statusData) {
    foreach ($statusData as $status) {
        if ($status['id'] == $statusId) {
            return $status['status'];
        }
    }
    return 'No'; // Если статус не найден
}


/**
 * SMS API Error Messages (English)
 */


/**
 * SMS API Integration (Improved Version)
 * - No hardcoded values
 * - All parameters passed via variables
 * - Proper error handling
 * - Strict typing
 */

/**
 * SMS Error Messages (English)
 */
function getSMSErrorMessages() {
    return [
        'ACCESS_ACTIVATION' => 'Service successfully activated',
        'ACCESS_CANCEL'     => 'Activation canceled',
        'ACCESS_READY'      => 'Waiting for new SMS',
        'ACCESS_RETRY_GET'  => 'Number readiness confirmed',
        'ACCOUNT_INACTIVE'  => 'No available numbers',
        'ALREADY_FINISH'    => 'Rent already finished',
        'ALREADY_CANCEL'    => 'Rent already canceled',
        'BAD_ACTION'        => 'Invalid action (action parameter)',
        'BAD_SERVICE'       => 'Invalid service name (service parameter)',
        'BAD_KEY'           => 'Invalid API access key',
        'BAD_STATUS'        => 'Attempt to set non-existent status',
        'BANNED'            => 'Account banned',
        'CANT_CANCEL'       => 'Cannot cancel rent (more than 20 minutes passed)',
        'ERROR_SQL'         => 'One of parameters has invalid value',
        'NO_NUMBERS'        => 'No available numbers for SMS reception',
        'NO_BALANCE'       => 'Insufficient balance',
        'NO_YULA_MAIL'     => 'Need more than 500 RUB balance for Mail.ru and Mamba services',
        'NO_CONNECTION'    => 'No connection to sms-activate servers',
        'NO_ID_RENT'       => 'Rent ID not specified',
        'NO_ACTIVATION'    => 'Specified activation ID doesn\'t exist',
        'STATUS_CANCEL'    => 'Activation/rent canceled',
        'STATUS_FINISH'    => 'Rent paid and finished',
        'STATUS_WAIT_CODE' => 'Waiting for first SMS',
        'STATUS_WAIT_RETRY'=> 'Waiting for code clarification',
        'SQL_ERROR'        => 'One of parameters has invalid value',
        'INVALID_PHONE'    => 'Number not rented by you (wrong rent ID)',
        'INCORECT_STATUS'  => 'Missing or invalid status',
        'WRONG_SERVICE'    => 'Service doesn\'t support forwarding',
        'WRONG_SECURITY'   => 'Error trying to pass activation ID without forwarding, or completed/inactive activation'
    ];
}

/**
 * Unified API Request Handler
 */
function sendSMSRequest(
    string $apiKey,
    array $requestData,
    string $method,
    string $smsDomain,
    bool $parseAsJSON = false
) {
    $baseUrl = "https://$smsDomain/stubs/handler_api.php";
    $method = strtoupper($method);

    // Validate HTTP method
    if (!in_array($method, ['GET', 'POST'])) {
        throw new InvalidArgumentException('Invalid HTTP method. Only GET or POST allowed.');
    }

    // Add API key to request data
    $requestData['api_key'] = $apiKey;
    $queryString = http_build_query($requestData);

    // Prepare request context
    $contextOptions = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => $method,
            'content' => $method === 'POST' ? $queryString : null
        ]
    ];

    $requestUrl = $method === 'GET' ? "$baseUrl?$queryString" : $baseUrl;
    $context = stream_context_create($contextOptions);

    // Execute request
    $response = file_get_contents($requestUrl, false, $context);

    if ($response === false) {
        throw new RuntimeException('Failed to connect to SMS service.');
    }

    // Check for API errors
    $errorMessages = getSMSErrorMessages();
    if (isset($errorMessages[$response])) {
        throw new RuntimeException($errorMessages[$response]);
    }

    return $parseAsJSON ? json_decode($response, true) : $response;
}

/**
 * Get Account Balance
 */
function getBalance(
    string $apiKey,
    string $smsDomain
): string {
    return sendSMSRequest(
        $apiKey,
        ['action' => 'getBalance'],
        'GET',
        $smsDomain
    );
}

/**
 * Request Phone Number
 */
function getNumber(
    string $apiKey,
    string $service,
    string $smsDomain,
    int $countryCode,
    bool $forward = false,
    ?string $operator = null,
    ?string $referral = null
): array {
    $requestData = [
        'action' => 'getNumber',
        'service' => $service,
        'country' => $countryCode,
        'forward' => (int)$forward
    ];

    if ($operator !== null) {
        $requestData['operator'] = $operator;
    }

    if ($referral !== null) {
        $requestData['ref'] = $referral;
    }

    $response = sendSMSRequest($apiKey, $requestData, 'POST', $smsDomain);
    return explode(':', $response);
}

/**
 * Check Activation Status
 */
function getStatus(
    string $apiKey,
    int $activationId,
    string $smsDomain
): array {
    $response = sendSMSRequest(
        $apiKey,
        ['action' => 'getStatus', 'id' => $activationId],
        'GET',
        $smsDomain
    );
    return explode(':', $response);
}

/**
 * Update Activation Status
 */
function setStatus(
    string $apiKey,
    int $activationId,
    int $status,
    string $smsDomain,
    bool $forward = false
): string {
    $requestData = [
        'action' => 'setStatus',
        'id' => $activationId,
        'status' => $status,
        'forward' => (int)$forward
    ];

    return sendSMSRequest($apiKey, $requestData, 'POST', $smsDomain);
}

/**
 * Get Available Countries
 */
function getCountries(
    string $apiKey,
    string $smsDomain
): array {
    return sendSMSRequest(
        $apiKey,
        ['action' => 'getCountries'],
        'GET',
        $smsDomain,
        true
    );
}

/**
 * Get Service Prices
 */
function getPrices(
    string $apiKey,
    string $smsDomain,
    ?int $countryCode = null,
    ?string $service = null,
    ?string $operator = null
): array {
    $requestData = ['action' => 'getPrices'];

    if ($countryCode !== null) {
        $requestData['country'] = $countryCode;
    }

    if ($service !== null) {
        $requestData['service'] = $service;
    }

    if ($operator !== null) {
        $requestData['operator'] = $operator;
    }

    return sendSMSRequest($apiKey, $requestData, 'GET', $smsDomain, true);
}
function new_insert($sql, $args = []) {
    global $pdo;
    // Автоматически экранируем имена таблиц в INSERT запросах
    $sql = preg_replace('/INSERT\s+INTO\s+(\w+)/i', 'INSERT INTO `$1`', $sql);
    $stmt = $pdo->prepare($sql);
    return $stmt->execute($args);
}

function new_update($sql, $args = []) {
    global $pdo;
    // Экранируем имена таблиц и полей в UPDATE
    $sql = preg_replace('/UPDATE\s+(\w+)/i', 'UPDATE `$1`', $sql);
    $sql = preg_replace('/SET\s+(\w+)\s*=/i', 'SET `$1` =', $sql);
    $stmt = $pdo->prepare($sql);
    return $stmt->execute($args);
}

function new_delete($sql, $args = []) {
    global $pdo;
    // Экранируем имена таблиц в DELETE
    $sql = preg_replace('/DELETE\s+FROM\s+(\w+)/i', 'DELETE FROM `$1`', $sql);
    $sql = preg_replace('/WHERE\s+(\w+)\s*=/i', 'WHERE `$1` =', $sql);
    $stmt = $pdo->prepare($sql);
    return $stmt->execute($args);
}

function new_selectAll($sql, $args = []) {
    global $pdo;
    // Экранируем имена таблиц в SELECT
    $sql = preg_replace('/(FROM|JOIN)\s+(\w+)/i', '$1 `$2`', $sql);
    $stmt = $pdo->prepare($sql);
    $stmt->execute($args);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function log_to_file($message) {
    if (!file_exists(__DIR__ . '/error.log')) {
        file_put_contents(__DIR__ . '/error.log', "Log file created\n");
        chmod(__DIR__ . '/error.log', 0666); // Устанавливаем разрешения
    }
    $log_file = __DIR__ . '/error.log';
    $timestamp = date('[Y-m-d H:i:s]');
    $message = is_array($message) ? print_r($message, true) : $message;
    file_put_contents($log_file, "$timestamp $message\n", FILE_APPEND);
}