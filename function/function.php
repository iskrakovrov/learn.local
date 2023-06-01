<?php

function tt($value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}

//Проверка выполнения запроса к бд
function dbCheckError($query)
{

    $errorInfo = $query->errorInfo();


    if ($errorInfo[0] !== PDO::ERR_NONE) {
        echo $errorInfo[2];
        exit();
    }
    return true;

}

// Запрос Select к бд
function select($sel, $args = [])
{
    global $pdo;
    $sql = $sel;
    $query = $pdo->prepare($sql);
    $query->execute($args);
    dbCheckError($query);
    return $query->fetch();
}

function selectAll($sel, $args = [])
{
    global $pdo;
    $sql = $sel;
    $query = $pdo->prepare($sql);
    $query->execute($args);
    dbCheckError($query);
    return $query->fetchAll();
}

function insert($ins, $args = [])
{

    global $pdo;
    $sql = $ins;
    $query = $pdo->prepare($sql);
    $query->execute($args);
    dbCheckError($query);


}

function update($upd, $args = [])
{

    global $pdo;
    $sql = $upd;
    $query = $pdo->prepare($sql);
    $query->execute($args);
    dbCheckError($query);


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

function processForm($array)
{

    // обрабатываешь данные формы и возвращаешь сообщение о результате

    if ($a == 1) {

        // Если регистрация прошла успешно
        return '<p class="alert alert-success">СЕРВЕР НЕ ДОБАВЛЕН</p>';
    }

// Если регистрация не удалась
    return '<p class="alert alert-danger">Сервер  добавлен</p>';

}

function delete($del, $args = [])
{

    global $pdo;
    $sql = $del;
    $query = $pdo->prepare($sql);
    $query->execute($args);
    dbCheckError($query);
    return 'ok';

}

function parse_proxy($pr, $comm)
{
    $link = explode("|", $pr);
    $prx = $link[0];


    $arr_pr = parse_url($prx);


    $mode = $arr_pr['scheme'];
    $host = $arr_pr['host'];
    $port = $arr_pr['port'];
    $user = $arr_pr['user'];
    $pass = $arr_pr['pass'];
    $link = $link[1];
    if (empty ($host)) {
        $sql = null;
        return $sql;
    }
    if (empty($mode)) {
        $mode = 'http';

    }
    if (empty($link)) {
        $link = 'NULL';
    }
    if (empty($comm)) {
        $comm = 'NULL';
    }
    $time = Time();
    $sql1 = "SELECT * FROM proxy WHERE proxy = '$pr'";
    $sql = "INSERT INTO `proxy` (`id`, `protocol`, `proxy`, `ip`, `port`, `login`, `pswd`, `link_proxy`, `status`, `work`, `created`, `comment`, `use_proxy`, `ban`) VALUES (NULL, '$mode', '$pr', '$host', '$port', '$user', '$pass', '$link', 'ok','0', '$time', '$comm', 0, 0)";
    return [$sql, $sql1];
}

function parse_acc1($acc, $comm, $serv, $group)
{


    $accs = explode(";", $acc);
    $login = $accs[0];
    $pass = $accs[1];
    if (empty($login)) {
        $sql = null;
        return $sql;

    }
    if (empty($pass)) {
        $sql = null;
        return $sql;
    }
    $sql = "SELECT * FROM accounts WHERE login_fb = '$login'";
    $querty = selectAll($sql);
    if (!empty($querty)) {
        $sql = null;
        return $sql;
    }
    $time = Time();
    $sql = "INSERT INTO `accounts` (`id`, `login_fb`, `pass_fb`, `id_fb`, `name`, `bd`, `mb`, `yb`, `gender`, `avatar`, `created`, `comment`, `group_acc`, `server`, `id_proxy`, `status`, `works`, `useacc`, `friends`, `last_start`) VALUES (NULL, '$login', '$pass', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$time', '$comm', '$group', '$serv', NULL, '1', NULL, NULL, NULL, NULL)";
    return [$sql];

}

function parse_acc2($acc, $comm, $serv, $group, $cock)
{
    $comm = $comm;
    $group = $group;
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
    $sql = "SELECT * FROM accounts WHERE login_fb = ?";
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
        $cock = "NULL";
    }
    if (empty($fa)) {
        $fa = "NULL";
    }
    if (empty($bd)) {
        $bd = "NULL";
    }
    if (empty($mb)) {
        $mb = "NULL";
    }
    if (empty($yb)) {
        $yb = "NULL";
    }

    $time = Time();

    $sql = "INSERT INTO accounts (id, login_fb, pass_fb, id_fb, name, bd, mb, yb, gender, avatar, created, comment, group_acc, server, id_proxy, status, works, useacc, friends, last_start, id_mail, id_phone, coockie, tocken, 2fa, ua, mail, mail_pass, imap_mail, phone, adv) VALUES (NULL,'$login', '$pass', NULL, NULL, '$bd', '$mb', '$yb', NULL, NULL, $time, '$comm', $group, $serv,NULL, 19, 0, 0, NULL, NULL, NULL, NULL, '$cock', NULL, '$fa', NULL, '$mail', '$passmail', '$imappass', '$phone', 0)";

    return [$sql];

}



function add_task($add_task, $json_data, $time, $account)
{
    $a = $account;


    $sql = "SELECT id FROM task WHERE task = ? AND account = ?";
    $args = [$add_task, $a];
    $query = select($sql, $args);
    $id_tr = $query['id'];
    if (empty($query)) {
        $sql = "INSERT INTO task (id, account, task, setup, created) VALUES (NULL, ?, ?, ?, ?)";
        $args = [$a, $add_task, $json_data, $time];
        $query = insert($sql, $args);
    } else {
        $sql = "UPDATE task SET setup = ?, created = ? WHERE id = ?";
        $args = [$json_data, $time, $id_tr];
        $query = update($sql, $args);

    }
}

function parse_key($key)
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

function parse_name($key)
{

    if (empty($key)) {
        $sql = null;
    } else {
        $cat = $_REQUEST['cat'];
        $sql = "SELECT * FROM name_lists WHERE id_list = ? AND value = ?";
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
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}
function parse_post($key, $folder)
{
    $folder = $_REQUEST['folder'];
if (empty($folder)){
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
    // Создание HTTP-запроса к API-серверу для проверки ключа
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

    $response = curl_exec($ch);

    curl_close($ch);

    // Проверка ответа от API-сервера
    if ($response === false) {
        return false; // Ошибка при отправке запроса
    }

    $decodedResponse = json_decode($response, true);

    if (isset($decodedResponse['id']) && isset($decodedResponse['object']) && isset($decodedResponse['model'])) {
        return true; // Ключ действителен
    } else {
        return false; // Ключ недействителен
    }
}


function checkAPIBalance($apiKey)  {


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

function getLast100Days() {
    $endDate = date('Y-m-d'); // Текущая дата

    $startDate = date('Y-m-d', strtotime('-100 days', strtotime($endDate))); // Вычисление даты, отстоящей от текущей на 100 дней

    return array($startDate, $endDate); // Возвращает массив с начальной и конечной датами
}