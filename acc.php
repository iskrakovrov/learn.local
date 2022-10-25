<?php

include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$start = microtime(true);
$sql = "SELECT id, login_fb, pass_fb, name, gender, avatar, created, group_acc, server, id_proxy, status, works, useacc, friends, last_start, tocken, mail, phone, adv FROM accounts";
$query = selectAll($sql);
$sql = "SELECT * FROM group_acc";
$gr1 = selectAll($sql);
$sql = "SELECT * FROM servers";
$ser1 = selectAll($sql);
$sql = "SELECT * FROM status";
$st1 = selectAll($sql);


foreach ($query as $a) {
    if (!empty ($a['avatar'])) {
        $ava = "OK";
    } else {
        $ava = "NO";
    }
    if (is_null($a['id_proxy'])) {
        $pr = "NO";
    } else {
        if($a['id_proxy'] == 0){
            $pr = 'FREE';
        }
        else {
            $pr = "OK";
        }
    }
    if ($a['useacc'] == '0') {
        $use = "FREE";
    } else {
        $use = "WORK"; //ooo
    }
    $find = "EAAB";
    $pos1 = stripos($a['tocken'], $find);
    if ($pos1 == false) {
        $tocken = "NO";
    } else {
        $tocken = "YES";
    }
    $t = $a['id'];
    $sql = "SELECT count(task) FROM task WHERE account = $t";
    $tk = selectAll($sql);
  $tk = $tk[0];
   $tk = $tk['count(task)']-1;
   if($tk<0){
       $tk=0;
   }
    $id_gr = $a['group_acc'];


    foreach ($gr1 as $z) {
        if ($z['id'] == $id_gr) {
            $gr = $z['name_group'];
        }
    }


    $data = date('d  M Y', $a["created"]);
    $id_s = $a['server'];

    foreach ($ser1 as $z) {
        if ($z['id'] == $id_s) {
            $ser = $z['name_server'];
        }
    }


    $st = $a['status'];

    foreach ($st1 as $z) {
        if ($z['id'] == $st) {
            $st = $z['status'];
        }
    }

    $id = '<div style="text-align: center;"><input type="checkbox" name="a[]" value="';
    $id .= $a['id'];
    $id .= '"></div>';
    //$id = 0;
    $action = '<div class="btn-group"><a href="edit_account.php?id=';
    $action .= $a['id'];
    $action .= '" class="btn btn-success" title="Edit" ><i class="bi bi-pencil-square"></i></a><a href="stat_account.php?id=';
    $action .= $a['id'];
    $action .= '" class="btn btn-success" title="Statistics"><i class="bi bi-star"></i></a><a href="del_account.php?id=';
    $action .= $a['id'];
    $action .= '" class="btn btn-danger" title="Delete Account" onClick="return confirm( ';
    $action .= "'WARNING!!! DELETE ACCOUNT?' )";
    $action .= '"><i class="bi bi-x-circle-fill"></i></a></div>';
    $ls = date('d  M Y G:i', $a["last_start"]);
    if ($a['adv'] == 1) {
        $adv = "YES";
    } else {
        $adv = "NO";
    }
    $mysql_data[] = array(

        "ids" => $id,
        "login" => $a["login_fb"],
        "mail" => $a["mail"],
        "phone" => $a["phone"],
        "gender" => $a["gender"],
        "avatar" => $ava,
        "proxy" => $pr,
        "server" => $ser,
        "group" => $gr,
        "status" => $st,
        "task" => $tk,
        "use" => $use,
        "create" => $data,
        "friends" => $a["friends"],
        "tocken" => $tocken,
        "adv" => $adv,
        "last_start" => $ls,
        "action" => $action,

    );
}
$data = array(

    "data" => $mysql_data,
);

// Convert PHP array to JSON array
$json_data = json_encode($data, JSON_THROW_ON_ERROR);
print $json_data;
$time = microtime(true) - $start;


