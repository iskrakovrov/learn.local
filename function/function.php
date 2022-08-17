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
function select($sel)
{
    global $pdo;
    $sql = $sel;
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    $data = $query->fetch();
    return $data;
}

function selectAll($sel)
{
    global $pdo;
    $sql = $sel;
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    $data = $query->fetchAll();
    return $data;
}

function insert($ins)
{

    global $pdo;
    $sql = $ins;
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);


}

function update($upd)
{

    global $pdo;
    $sql = $upd;
    $query = $pdo->prepare($sql);
    $query->execute();
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

    if ($a === 1) {

        // Если регистрация прошла успешно
        return '<p class="alert alert-success">СЕРВЕР НЕ ДОБАВЛЕН</p>';
    } else {

        // Если регистрация не удалась
        return '<p class="alert alert-danger">Сервер  добавлен</p>';
    }

}

function delete($del)
{

    global $pdo;
    $sql = $del;
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);


}

function parse_proxy($pr, $comm)
{
    $comm = $comm;
    $proxy = $pr;
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
        return;
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
    $comm = $comm;
    $serv = $serv;
    $group = $group;
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
    $sql = "SELECT * FROM accounts WHERE login_fb = '$login'";
    $querty = selectAll($sql);
    if (!empty($querty)) {
        $sql = null;
        return;
    }
    $time = Time();
    $sql = "INSERT INTO `accounts` (`id_acc`, `login_fb`, `pass_fb`, `id_fb`, `name`, `bd`, `mb`, `yb`, `gender`, `avatar`, `created`, `comment`, `group_acc`, `server`, `id_proxy`, `status`, `works`, `useacc`, `friends`, `last_start`) VALUES (NULL, '$login', '$pass', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$time', '$comm', '$group', '$serv', NULL, '1', NULL, NULL, NULL, NULL)";
    return [$sql];

}

function parse_acc2($acc, $comm, $serv, $group, $cock)
{
    $comm = $comm;
    $serv = $serv;
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
    $sql = "SELECT * FROM accounts WHERE login_fb = '$login'";
    $querty = select($sql);
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

    $time = Time();

    $sql = "INSERT INTO accounts (id, login_fb, pass_fb, id_fb, name, bd, mb, yb, gender, avatar, created, comment, group_acc, server, id_proxy, status, works, useacc, friends, last_start, id_mail, id_phone, coockie, tocken, 2fa, ua, mail, mail_pass, imap_mail, phone, adv) VALUES (NULL,'$login', '$pass', NULL, NULL, NULL, NULL, NULL, NULL, NULL, $time, '$comm', $group, $serv,NULL, 1, 0, 0, NULL, NULL, NULL, NULL, '$cock', NULL, $fa, NULL, '$mail', '$passmail', '$imappass', '$phone', 0)";

    return [$sql];

}

function mails($m1, $p1)
{
    if (empty($m1)) {
        return;
    }
    $sql = "SELECT * FROM mail WHERE mail = '$m1'";
    $query = selectAll($sql);
    if (empty($query)) {
        $m2 = 'good';
        return [$m2];
    }
    $m2 = 'double';
    return [$m2];

}

function phones($p1)
{
    if (empty ($p1)) {
        return;
    }
    $sql = "SELECT * FROM phones WHERE phone = '$p1'";
    $query = selectAll($sql);
    if (empty($query)) {
        $p2 = 'good';
        return [$p2];
    }
    $p2 = 'double';
    return [$p2];
}

function addmail($mail)
{
    return;
}

function addphone($prone)
{
    return;
}

function add_task($add_task, $json_data, $time, $account)
{
    $add_task = $add_task;
    $json_data = $json_data;
    $time = $time;
    $a = $account;


    $sql = "SELECT id FROM task WHERE task = '$add_task' AND account = $a";
    $query = select($sql);
    $id_tr = $query['id'];
    if (empty($query)) {
        $sql = "INSERT INTO task (id, account, task, setup, created) VALUES (NULL, $a, '$add_task', '$json_data', $time)";
        $query = insert($sql);
    } else {
        $sql = "UPDATE task SET setup = '$json_data', created = $time WHERE id = $id_tr";
        $query = update($sql);

    }
}

function parse_key($key)
{
    $key = $key;
    if (empty($key)) {
        $sql = null;
    } else {
        $cat = $_REQUEST['cat'];
        $sql = "SELECT * FROM value_lists WHERE list = $cat AND value = '$key'";
        $query = select($sql);
        if (empty($query)) {
            $sql = "INSERT INTO value_lists (id,value,list) VALUES (NULL, '$key', $cat )";
        } else {
            $sql = null;
        }
    }
    return [$sql];
}
