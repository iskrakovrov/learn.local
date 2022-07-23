<?php

include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$sql = "SELECT * FROM accounts";
$query = selectAll($sql);


foreach ($query as $a) {
    if (!empty ($a['avatar'])) {
        $ava = "OK";
    } else {
        $ava = "NO";
    }
    if (empty($a['id_proxy'])) {
        $pr = "NO";
    } else {
        $pr = "OK"; //ооо
    }
    if ($a['useacc'] === '0') {
        $use = "FREE";
    } else {
        $use = "WORK";
    }
    $find = "EAAB";
    $pos1 = stripos($a['tocken'], $find);
    if ($pos1 === false) {
        $tocken = "NO";
    } else {
        $tocken = "YES";
    }
    $t = $a['id_acc'];
    $sql = "SELECT count(task) FROM task WHERE account = $t";
    $tk = selectAll($sql);
    $tk = $tk[0];
    $tk = $tk['count(task)'];
    $id_gr = $a['group_acc'];
    $sql = "SELECT name_group FROM group_acc where id_gr = $id_gr LIMIT 1";
    $gr = select($sql);
    $data = date('d  M Y', $a["created"]);
    $id_s = $a['server'];
    $sql = "SELECT name_server FROM servers where id_server = $id_s LIMIT 1";
    $ser = select($sql);
    $st = $a['status'];
    $sql = "SELECT status FROM status WHERE id_status = $st LIMIT 1";
    $st = select($sql);
    $id = '<div style="text-align: center;"><input type="checkbox" name="a[]" value="';
    $id .= $a['id_acc'];
    $id .= '"></div>';
    //$id = 0;
    $action = '<div class="btn-group"><a href="edit_account.php?id=';
    $action .= $a['id_acc'];
    $action .= '" class="btn btn-success" title="Edit" ><i class="bi bi-pencil-square"></i></a><a href="stat_account.php?id=';
    $action .= $a['id_acc'];
    $action .= '" class="btn btn-success" title="Statistics"><i class="bi bi-star"></i></a><a href="del_account.php?id=';
    $action .= $a['id_acc'];
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
        "server" => $ser['name_server'],
        "group" => $gr['name_group'],
        "status" => $st['status'],
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
$json_data = json_encode($data);
print $json_data;