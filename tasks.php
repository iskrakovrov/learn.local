<!doctype html>
<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);


$ids = $_SESSION['ids'];
$numberTemplate = $_SESSION['numberTemplate'];
$add_task = $_POST['add_task'];
$setup = $_POST['action'];


if ($add_task == 'login') {

    $st[] = array(

        'sbor' => $setup[0],
        'delphone' => $setup[1],
        'smart' => $setup[2],
        'tock' => $setup[3],
        'minvite' => $setup[4],
        'msuggest' => $setup[5],
        'mlike' => $setup[6],
        'mcomments' => $setup[7],
        'mmessage' => $setup[8],
        'tstart' => $setup[9],
        'nproxy' => $setup[10],
        'get' => $setup[11],
        'bat' => $setup[12],
        'ava' => $setup[13],
        'sf' => $setup[14],
        'end' => $setup[15],
        'hand' => $setup[16],
        'per' => $setup[17],
        'groups' => $setup[18],


    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}

if ($add_task == 'new_accounts') {
    $st[] = array(
        'listid' => $_REQUEST['listid'],
        'geo' => $_REQUEST['geo'],
        'num_i' => $_REQUEST['num_i'],
        'pause' => $_REQUEST['pause'],
        'confirm' => $_REQUEST['confirm'],
        'num_co' => $_REQUEST['num_co'],
        'f24' => $_REQUEST['f24'],


    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}

if ($add_task == 'create_pages') {
    $st[] = array(
        'mode' => $_REQUEST['mode'],
        'names' => $_REQUEST['names'],
        'num_p' => $_REQUEST['num_p'],


    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}

if ($add_task == 'global_invite') {
    $st[] = array(
        'ti0' => $_REQUEST['ti0'],
        'ti1' => $_REQUEST['ti1'],
        'ti2' => $_REQUEST['ti2'],
        'ti3' => $_REQUEST['ti3'],
        'ti4' => $_REQUEST['ti4'],
        'ti5' => $_REQUEST['ti5'],


    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}
if ($add_task == 'banhammer') {

    $options = implode(',', $_POST['bh']);

    $st[] = array(
        'bh1' => $_REQUEST['bh'],


    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}
if ($add_task == 'instagram') {
    $st[] = array(

        'cm' => $_REQUEST['cm'],
        'f24' => $_REQUEST['f24'],


    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}


if ($add_task == 'rss_post') {
    $st[] = array(

        'cat' => $_REQUEST['cat'],
        'mode' => $_REQUEST['mode'],
        'txt' => $_REQUEST['txt'],
        'uniq' => $_REQUEST['uniq'],
        'prc' => $_REQUEST['prc'],
        'save' => $_REQUEST['save'],
        'f24' => $_REQUEST['f24'],


    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}


if ($add_task == 'coockie') {
    $st[] = array(
        'cat' => $_REQUEST['cat'],
        'num_s' => $_REQUEST['num_s'],

    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}
if ($add_task == 'add_mail') {
    $st[] = array(
        'am' => $_REQUEST['am'],
        'cm' => $_REQUEST['cm'],


    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}

if ($add_task == 'farm') {
    $st[] = array(
        'cat' => $_REQUEST['cat'],
        'like_page' => $_REQUEST['like_page'],
        'num_lp' => $_REQUEST['num_lp'],
        'like_gr' => $_REQUEST['like_gr'],
        'num_gr' => $_REQUEST['num_gr'],
        'like_gr1' => $_REQUEST['like_gr1'],
        'num_gr1' => $_REQUEST['num_gr1'],
        'cat1' => $_REQUEST['cat1'],
        'like_feed' => $_REQUEST['feed'],
        'num_l' => $_REQUEST['num_l'],
        'like_adv' => $_REQUEST['like_adv'],
        'p_like_adv' => $_REQUEST['p_like_adv'],
        'f24' => $_REQUEST['f24'],
    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}
if ($add_task == 'filling_accounts') {
    $st[] = array(
        'currc' => $_REQUEST['currc'],
        'edu' => $_REQUEST['edu'],
        'work' => $_REQUEST['work'],
        'fname' => $_REQUEST['fname'],
        'lname' => $_REQUEST['lname'],
        'cover' => $_REQUEST['cover'],
        'ava' => $_REQUEST['ava'],
        'apost' => $_REQUEST['apost'],
        'priv' => $_REQUEST['priv'],

    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}

if ($add_task == 'mess_sbor') {
    $st[] = array(
        'vm' => $_REQUEST['vm'],
        'f24' => $_REQUEST['f24'],

    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}

if ($add_task == 'post_to_group') {
    $st[] = array(
        'ntask' => $_REQUEST['ntask'],
        'mode3' => $_REQUEST['mode3'],
        'type' => $_REQUEST['type'],
        'post' => $_REQUEST['post'],
        'mod1' => $_REQUEST['mod1'],
        'res' => $_REQUEST['res'],
        'npost' => $_REQUEST['npost'],
        'scr' => $_REQUEST['scr'],
        'mod4' => $_REQUEST['mod4'],
        'spost' => $_REQUEST['spost'],
        'fname' => $_REQUEST['fname'],
        'f24' => $_REQUEST['f24'],

    );

    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);

}
if ($add_task == 'a_post_to_group') {
    $st[] = array(
        'ntask' => $_REQUEST['ntask'],
        'mode3' => $_REQUEST['mode3'],
        'type' => $_REQUEST['type'],
        'post' => $_REQUEST['post'],
        'mod1' => $_REQUEST['mod1'],
        'res' => $_REQUEST['res'],
        'npost' => $_REQUEST['npost'],
        'scr' => $_REQUEST['scr'],
        'mod4' => $_REQUEST['mod4'],
        'spost' => $_REQUEST['spost'],
        'fname' => $_REQUEST['fname'],
        'f24' => $_REQUEST['f24'],

    );

    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);

}
if ($add_task == 'erase_invite') {
    $st[] = array(
        'num_e' => $_REQUEST['num_e'],

    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}

if ($add_task == 'parse_group') {
    $setup = $_POST['action'];
    $st[] = array(

        'key' => $_REQUEST['cat'],
        'group' => $_REQUEST['cat1'],
        'num' => $_REQUEST['num'],


    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}
if ($add_task == 'invite_suggestions') {
    $setup = $_POST['action'];
    $st[] = array(

        'geo' => $_REQUEST['geo'],
        'num_i' => $_REQUEST['num_i'],
        'pause' => $_REQUEST['pause'],
        'filter' => $_REQUEST['filter'],
        'wln' => $_REQUEST['wln'],
        'bln' => $_REQUEST['bln'],
        'gbl' => $_REQUEST['gbl'],
        'confirm' => $_REQUEST['confirm'],
        'num_co' => $_REQUEST['num_co'],
        'f24' => $_REQUEST['f24'],


    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}

if ($add_task == 'invite_from_group') {
    $setup = $_POST['action'];
    $st[] = array(
        'gr' => $_REQUEST['gr'],
        'mode' => $_REQUEST['mode'],
        'geo' => $_REQUEST['geo'],
        'num_i' => $_REQUEST['num_i'],
        'pause' => $_REQUEST['pause'],
        'filter' => $_REQUEST['filter'],
        'wln' => $_REQUEST['wln'],
        'bln' => $_REQUEST['bln'],
        'gbl' => $_REQUEST['gbl'],
        'confirm' => $_REQUEST['confirm'],
        'num_co' => $_REQUEST['num_co'],
        'parse' => $_REQUEST['parse'],
        'f24' => $_REQUEST['f24'],


    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}

if ($add_task == 'post_to_profile') {
    $setup = $_POST['action'];
    $st[] = array(


        'cat' => $_REQUEST['cat'],
        'day' => $_REQUEST['day'],
        'multi1' => $_REQUEST['multi1'],
        'multi2' => $_REQUEST['multi2'],
        'spost' => $_REQUEST['spost'],
        'prc' => $_REQUEST['prc'],
        'f24' => $_REQUEST['f24'],


    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}

if ($add_task == 'like') {
    $setup = $_POST['action'];
    $st[] = array(


        'cat' => $_REQUEST['cat'],
        'num_l' => $_REQUEST['num_l'],
        'pause' => $_REQUEST['pause'],
        'f24' => $_REQUEST['f24'],


    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}
if ($add_task == 'join_group') {
    $setup = $_POST['action'];
    $st[] = array(


        'cat' => $_REQUEST['cat'],
        'num_l' => $_REQUEST['num_l'],
        'pause' => $_REQUEST['pause'],
        'f24' => $_REQUEST['f24'],


    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}
if ($add_task == 'happy') {
    $setup = $_POST['action'];
    $st[] = array(


        'cat' => $_REQUEST['cat'],

        'none' => $_REQUEST['none'],
        'f24' => $_REQUEST['f24'],


    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}
if ($add_task == 'page_invite') {
    $setup = $_POST['action'];
    $st[] = array(


        'cat' => $_REQUEST['cat'],
        'inv' => $_REQUEST['inv'],
        'n_inv' => $_REQUEST['n_inv'],
        'f24' => $_REQUEST['f24'],


    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}
if ($add_task == 'invite_to_group') {
    $setup = $_POST['action'];
    $st[] = array(


        'cat' => $_REQUEST['cat'],
        'n_gr' => $_REQUEST['n_gr'],
        'n_inv' => $_REQUEST['n_inv'],
        'f24' => $_REQUEST['f24'],


    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}

if ($add_task == 'commenting') {

    $st[] = array(


        'url' => $_REQUEST['url'],
        'coml' => $_REQUEST['coml'],
        'num_cp' => $_REQUEST['num_cp'],
        'num_cd' => $_REQUEST['num_cd'],
        'pause' => $_REQUEST['pause'],
        'uq' => $_REQUEST['uq'],
        'like' => $_REQUEST['like'],
        'f24' => $_REQUEST['f24'],
        'scr' => $_REQUEST['scr'],
        'fname' => $_REQUEST['fname'],


    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}

if ($add_task == 'review_page') {

    $st[] = array(


        'url' => $_REQUEST['url'],
        'coml' => $_REQUEST['coml'],
        'num_cp' => $_REQUEST['num_cp'],

        'like' => $_REQUEST['like'],
        'f24' => $_REQUEST['f24'],


    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}

if ($add_task == 'share') {
    $setup = $_POST['action'];
    $st[] = array(

        'one' => $_REQUEST['one'],
        'url' => $_REQUEST['url'],
        'acc' => $_REQUEST['acc'],
        'stxt' => $_REQUEST['stxt'],
        'num_cp' => $_REQUEST['num_cp'],
        'num_sd' => $_REQUEST['num_sd'],
        'prc' => $_REQUEST['prc'],
        'pause' => $_REQUEST['pause'],
        'like' => $_REQUEST['like'],
        'f24' => $_REQUEST['f24'],


    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}
if ($add_task == 'comm_public') {

    $st[] = array(


        'url' => $_REQUEST['url'],
        'coml' => $_REQUEST['coml'],
        'num_cp' => $_REQUEST['num_cp'],
        'num_cd' => $_REQUEST['num_cd'],
        'pause' => $_REQUEST['pause'],
        'like' => $_REQUEST['like'],
        'f24' => $_REQUEST['f24'],


    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}

if ($add_task == 'comoai') {
    $setup = $_POST['action'];
    $st[] = array(


        'url' => $_REQUEST['url'],
        'coml' => $_REQUEST['coml'],
        'num_cp' => $_REQUEST['num_cp'],
        'num_cd' => $_REQUEST['num_cd'],
        'pause' => $_REQUEST['pause'],
        'like' => $_REQUEST['like'],
        'f24' => $_REQUEST['f24'],


    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}

if ($add_task == 'accept_friends') {
    $setup = $_POST['action'];
    $st[] = array(

        'cat' => $_REQUEST['cat'],
        'filter' => $_REQUEST['filter'],
        'black' => $_REQUEST['black'],
        'white' => $_REQUEST['white'],
        'one_s' => $_REQUEST['one_s'],
        'pause' => $_REQUEST['pause'],
        'f24' => $_REQUEST['f24'],


    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}
if ($add_task == 'post_oai') {
    $setup = $_POST['action'];
    $st[] = array(

        'promt' => $_REQUEST['promt'],
        'img' => $_REQUEST['img'],
        'f24' => $_REQUEST['f24'],


    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}

if ($add_task == 'parse_active') {
    $setup = $_POST['action'];
    $st[] = array(

        'urls' => $_REQUEST['cat'],
        'save_l' => $_REQUEST['cat1'],


    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);
}

if ($add_task == '2fa') {
    $st[] = array(
        '2fa' => $_REQUEST['2fa'],

    );
    generateAndExecuteTask($add_task, $st, $ids, $numberTemplate);

}


$ids = $_SESSION['ids'];
$task = $_REQUEST['task'];
if (empty($task)) {
    $task = $_SESSION['task'];
}

?>
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

$w = $task[0];
if (!empty($w)) {
    $url = 'action' . '/' . $w;
    array_shift($task);
    include_once($url);
} else {
    header('Location: accounts.php');
    exit;
}
session_start();
$_SESSION['task'] = $task;
$_SESSION['ids'] = $ids;


?>


<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>


<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->

</body>
</html>



