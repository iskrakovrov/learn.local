<?php
// Включение отображения всех ошибок
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Убираем session_start() здесь, так как он уже есть в inc/init.php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] . '.php' : 'ru.php';
if (file_exists($lang)) {
    require_once($lang);
} else {
    echo "Языковой файл $lang не найден!";
}

$ids = isset($_SESSION['ids']) ? $_SESSION['ids'] : [];
$numberTemplate = isset($_SESSION['numberTemplate']) ? $_SESSION['numberTemplate'] : '';
$add_task = isset($_POST['add_task']) ? $_POST['add_task'] : '';
$setup = isset($_POST['action']) ? $_POST['action'] : [];

// Функция для безопасного получения значений из REQUEST
function getRequestValue($key, $default = '') {
    return isset($_REQUEST[$key]) ? $_REQUEST[$key] : $default;
}

// Конфигурация всех типов задач
$taskConfigs = [
    'login' => [
        'sbor' => isset($setup[0]) ? $setup[0] : '',
        'delphone' => isset($setup[1]) ? $setup[1] : '',
        'smart' => isset($setup[2]) ? $setup[2] : '',
        'tock' => isset($setup[3]) ? $setup[3] : '',
        'minvite' => isset($setup[4]) ? $setup[4] : '',
        'msuggest' => isset($setup[5]) ? $setup[5] : '',
        'mlike' => isset($setup[6]) ? $setup[6] : '',
        'mcomments' => isset($setup[7]) ? $setup[7] : '',
        'mmessage' => isset($setup[8]) ? $setup[8] : '',
        'tstart' => isset($setup[9]) ? $setup[9] : '',
        'nproxy' => isset($setup[10]) ? $setup[10] : '',
        'get' => isset($setup[11]) ? $setup[11] : '',
        'bat' => isset($setup[12]) ? $setup[12] : '',
        'ava' => isset($setup[13]) ? $setup[13] : '',
        'sf' => isset($setup[14]) ? $setup[14] : '',
        'end' => isset($setup[15]) ? $setup[15] : '',
        'hand' => isset($setup[16]) ? $setup[16] : '',
        'per' => isset($setup[17]) ? $setup[17] : '',
        'groups' => isset($setup[18]) ? $setup[18] : '',
    ],
    'new_accounts' => [
        'listid' => getRequestValue('listid'),
        'geo' => getRequestValue('geo'),
        'num_i' => getRequestValue('num_i'),
        'pause' => getRequestValue('pause'),
        'confirm' => getRequestValue('confirm'),
        'num_co' => getRequestValue('num_co'),
        'f24' => getRequestValue('f24'),
    ],
    'create_pages' => [
        'mode' => getRequestValue('mode'),
        'names' => getRequestValue('names'),
        'num_p' => getRequestValue('num_p'),
    ],
    'global_invite' => [
        'ti0' => getRequestValue('ti0'),
        'ti1' => getRequestValue('ti1'),
        'ti2' => getRequestValue('ti2'),
        'ti3' => getRequestValue('ti3'),
        'ti4' => getRequestValue('ti4'),
        'ti5' => getRequestValue('ti5'),
    ],
    'banhammer' => [
        'bh1' => getRequestValue('bh'),
    ],
    'instagram' => [
        'cm' => getRequestValue('cm'),
        'f24' => getRequestValue('f24'),
    ],
    'rss_post' => [
        'cat' => getRequestValue('cat'),
        'mode' => getRequestValue('mode'),
        'txt' => getRequestValue('txt'),
        'uniq' => getRequestValue('uniq'),
        'prc' => getRequestValue('prc'),
        'save' => getRequestValue('save'),
        'f24' => getRequestValue('f24'),
    ],
    'invite_like' => [
        'num_i' => getRequestValue('num_i'),
        'pause' => getRequestValue('pause'),
        'posts' => getRequestValue('posts'),
        'confirm' => getRequestValue('confirm'),
        'num_co' => getRequestValue('num_co'),
        'f24' => getRequestValue('f24'),
    ],
    'coockie' => [
        'cat' => getRequestValue('cat'),
        'num_s' => getRequestValue('num_s'),
    ],
    'add_mail' => [
        'am' => getRequestValue('am'),
        'cm' => getRequestValue('cm'),
    ],
    'farm' => [
        'cat' => getRequestValue('cat'),
        'like_page' => getRequestValue('like_page'),
        'num_lp' => getRequestValue('num_lp'),
        'like_gr' => getRequestValue('like_gr'),
        'num_gr' => getRequestValue('num_gr'),
        'like_gr1' => getRequestValue('like_gr1'),
        'num_gr1' => getRequestValue('num_gr1'),
        'cat1' => getRequestValue('cat1'),
        'like_feed' => getRequestValue('feed'),
        'num_l' => getRequestValue('num_l'),
        'like_adv' => getRequestValue('like_adv'),
        'p_like_adv' => getRequestValue('p_like_adv'),
        'f24' => getRequestValue('f24'),
    ],
    'filling_accounts' => [
        'currc' => getRequestValue('currc'),
        'edu' => getRequestValue('edu'),
        'work' => getRequestValue('work'),
        'fname' => getRequestValue('fname'),
        'lname' => getRequestValue('lname'),
        'cover' => getRequestValue('cover'),
        'ava' => getRequestValue('ava'),
        'apost' => getRequestValue('apost'),
        'priv' => getRequestValue('priv'),
    ],
    'mess_sbor' => [
        'vm' => getRequestValue('vm'),
        'f24' => getRequestValue('f24'),
    ],
    'post_to_group' => [
        'ntask' => getRequestValue('ntask'),
        'mode3' => getRequestValue('mode3'),
        'type' => getRequestValue('type'),
        'post' => getRequestValue('post'),
        'mod1' => getRequestValue('mod1'),
        'res' => getRequestValue('res'),
        'npost' => getRequestValue('npost'),
        'nday' => getRequestValue('nday'),
        'nfr' => getRequestValue('nfr'),
        'nl' => getRequestValue('nl'),
        'ng' => getRequestValue('ng'),
        'scr' => getRequestValue('scr'),
        'mod4' => getRequestValue('mod4'),
        'spost' => getRequestValue('spost'),
        'fname' => getRequestValue('fname'),
        'f24' => getRequestValue('f24'),
    ],
    'a_post_to_group' => [
        'ntask' => getRequestValue('ntask'),
        'mode3' => getRequestValue('mode3'),
        'type' => getRequestValue('type'),
        'post' => getRequestValue('post'),
        'mod1' => getRequestValue('mod1'),
        'res' => getRequestValue('res'),
        'npost' => getRequestValue('npost'),
        'scr' => getRequestValue('scr'),
        'mod4' => getRequestValue('mod4'),
        'spost' => getRequestValue('spost'),
        'fname' => getRequestValue('fname'),
        'f24' => getRequestValue('f24'),
    ],
    'erase_invite' => [
        'num_e' => getRequestValue('num_e'),
    ],
    'parse_group' => [
        'key' => getRequestValue('cat'),
        'group' => getRequestValue('cat1'),
        'num' => getRequestValue('num'),
    ],
    'invite_suggestions' => [
        'geo' => getRequestValue('geo'),
        'num_i' => getRequestValue('num_i'),
        'pause' => getRequestValue('pause'),
        'filter' => getRequestValue('filter'),
        'wln' => getRequestValue('wln'),
        'bln' => getRequestValue('bln'),
        'gbl' => getRequestValue('gbl'),
        'confirm' => getRequestValue('confirm'),
        'num_co' => getRequestValue('num_co'),
        'f24' => getRequestValue('f24'),
    ],
    'invite_from_group' => [
        'gr' => getRequestValue('gr'),
        'mode' => getRequestValue('mode'),
        'geo' => getRequestValue('geo'),
        'num_i' => getRequestValue('num_i'),
        'pause' => getRequestValue('pause'),
        'filter' => getRequestValue('filter'),
        'wln' => getRequestValue('wln'),
        'bln' => getRequestValue('bln'),
        'gbl' => getRequestValue('gbl'),
        'confirm' => getRequestValue('confirm'),
        'num_co' => getRequestValue('num_co'),
        'parse' => getRequestValue('parse'),
        'f24' => getRequestValue('f24'),
    ],
    'post_to_profile' => [
        'cat' => getRequestValue('cat'),
        'day' => getRequestValue('day'),
        'multi1' => getRequestValue('multi1'),
        'multi2' => getRequestValue('multi2'),
        'spost' => getRequestValue('spost'),
        'prc' => getRequestValue('prc'),
        'tag' => getRequestValue('tag'),
        'tag1' => getRequestValue('tag1'),
        'f24' => getRequestValue('f24'),
    ],
    'like' => [
        'cat' => getRequestValue('cat'),
        'num_l' => getRequestValue('num_l'),
        'pause' => getRequestValue('pause'),
        'f24' => getRequestValue('f24'),
    ],
    'join_group' => [
        'cat' => getRequestValue('cat'),
        'num_l' => getRequestValue('num_l'),
        'pause' => getRequestValue('pause'),
        'f24' => getRequestValue('f24'),
    ],
    'happy' => [
        'cat' => getRequestValue('cat'),
        'none' => getRequestValue('none'),
        'f24' => getRequestValue('f24'),
    ],
    'page_invite' => [
        'cat' => getRequestValue('cat'),
        'inv' => getRequestValue('inv'),
        'n_inv' => getRequestValue('n_inv'),
        'f24' => getRequestValue('f24'),
    ],
    'invite_to_group' => [
        'cat' => getRequestValue('cat'),
        'n_gr' => getRequestValue('n_gr'),
        'n_inv' => getRequestValue('n_inv'),
        'f24' => getRequestValue('f24'),
    ],
    'commenting' => [
        'url' => getRequestValue('url'),
        'coml' => getRequestValue('coml'),
        'num_cp' => getRequestValue('num_cp'),
        'num_cd' => getRequestValue('num_cd'),
        'pause' => getRequestValue('pause'),
        'uq' => getRequestValue('uq'),
        'like' => getRequestValue('like'),
        'f24' => getRequestValue('f24'),
        'scr' => getRequestValue('scr'),
        'fname' => getRequestValue('fname'),
    ],
    'review_page' => [
        'url' => getRequestValue('url'),
        'coml' => getRequestValue('coml'),
        'num_cp' => getRequestValue('num_cp'),
        'like' => getRequestValue('like'),
        'f24' => getRequestValue('f24'),
    ],
    'share' => [
        'one' => getRequestValue('one'),
        'url' => getRequestValue('url'),
        'acc' => getRequestValue('acc'),
        'stxt' => getRequestValue('stxt'),
        'num_cp' => getRequestValue('num_cp'),
        'num_sd' => getRequestValue('num_sd'),
        'prc' => getRequestValue('prc'),
        'pause' => getRequestValue('pause'),
        'like' => getRequestValue('like'),
        'f24' => getRequestValue('f24'),
    ],
    'comm_public' => [
        'url' => getRequestValue('url'),
        'coml' => getRequestValue('coml'),
        'num_cp' => getRequestValue('num_cp'),
        'num_cd' => getRequestValue('num_cd'),
        'pause' => getRequestValue('pause'),
        'like' => getRequestValue('like'),
        'f24' => getRequestValue('f24'),
    ],
    'comoai' => [
        'url' => getRequestValue('url'),
        'coml' => getRequestValue('coml'),
        'num_cp' => getRequestValue('num_cp'),
        'num_cd' => getRequestValue('num_cd'),
        'pause' => getRequestValue('pause'),
        'like' => getRequestValue('like'),
        'f24' => getRequestValue('f24'),
    ],
    'accept_friends' => [
        'cat' => getRequestValue('cat'),
        'filter' => getRequestValue('filter'),
        'black' => getRequestValue('black'),
        'white' => getRequestValue('white'),
        'one_s' => getRequestValue('one_s'),
        'pause' => getRequestValue('pause'),
        'f24' => getRequestValue('f24'),
    ],
    'post_oai' => [
        'promt' => getRequestValue('promt'),
        'img' => getRequestValue('img'),
        'f24' => getRequestValue('f24'),
    ],
    'parse_active' => [
        'urls' => getRequestValue('cat'),
        'save_l' => getRequestValue('cat1'),
    ],
    '2fa' => [
        '2fa' => getRequestValue('2fa'),
    ],
];

// Обработка задачи, если она есть в конфигурации
if (!empty($add_task)) {
    if (isset($taskConfigs[$add_task])) {
        $st[] = $taskConfigs[$add_task];
        if (function_exists('generateAndExecuteTask')) {
            generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
        } else {
            echo "Функция generateAndExecuteTask не найдена!";
        }
    } else {
        echo "Конфигурация для задачи '$add_task' не найдена!";
    }
}

$ids = isset($_SESSION['ids']) ? $_SESSION['ids'] : [];
$task = isset($_REQUEST['task']) ? $_REQUEST['task'] : (isset($_SESSION['task']) ? $_SESSION['task'] : []);

?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
            href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap"
            rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="css/dt.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css"/>
    <link href="css/style.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <title>FB Combo | Edit Task</title>
</head>
<body>
<?php

if (!empty($task) && is_array($task)) {
    $w = $task[0];
    if (!empty($w)) {
        $url = 'action' . '/' . $w;
        array_shift($task);
        if (file_exists($url)) {
            include_once($url);
        } else {
            echo "<div class='alert alert-danger'>Файл $url не найден!</div>";
        }
    } else {
        header('Location: accounts.php');
        exit;
    }
} else {
    header('Location: accounts.php');
}

// Убираем session_start() здесь тоже
$_SESSION['task'] = $task;
$_SESSION['ids'] = $ids;

?>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
</body>
</html>