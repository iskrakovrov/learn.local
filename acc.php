<?php

include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

//$start = microtime(true);
//$sql = 'SELECT id, login_fb, pass_fb, id_fb, name, gender, avatar, created, group_acc, server, id_proxy, status, works, useacc, friends, last_start, tocken, mail, phone, adv, 2fa, ar, created_acc, ig, life, gpoup_proxy  FROM accounts ';

 $sql = 'SELECT
   accounts.id, login_fb, pass_fb, id_fb, name, gender, avatar, accounts.created, group_acc, account_tags,
   server, id_proxy, status, works, useacc, friends, last_start, tocken, mail, phone,
   adv, 2fa, ar, created_acc, ig, life, gpoup_proxy, COUNT(task.task) as task_count
FROM
   accounts
LEFT JOIN
   task ON accounts.id = task.account
GROUP BY
   accounts.id';
//$sql = 'SELECT
//   acc.id, login_fb, pass_fb, id_fb, name, gender, avatar, acc.created, group_acc,
//   server, id_proxy, status, works, useacc, acc.friends, last_start, tocken, mail, phone,
//   adv, 2fa, ar, created_acc, ig, life, gpoup_proxy,
//   COUNT(task.task) AS task_count,
//   (
//   SELECT
//         f1.friends
//      FROM
//         friends f1
//      WHERE
//         f1.id_acc = acc.id
//      ORDER BY
//         f1.created DESC
//      LIMIT 1 OFFSET 1
//   ) AS friends_friends
//FROM
//   accounts acc
//LEFT JOIN
//   task ON acc.id = task.account
//GROUP BY
//   acc.id';


$query = selectAll($sql);
$sql = 'SELECT * FROM group_acc';
$gr1 = selectAll($sql);
$sql = 'SELECT * FROM servers';
$ser1 = selectAll($sql);
$sql = 'SELECT * FROM status';
$st1 = selectAll($sql);
$sql = 'SELECT * FROM account_tags';
$tag1 = selectAll($sql);

foreach ($query as $a) {
    if (!empty ($a['avatar'])) {
        $ava = 'OK';
    } else {
        $ava = 'NO';
    }
    if ($a['gpoup_proxy']===NULL) {
        $pr = 'NO';
    } else {
        if ($a['gpoup_proxy'] === 0) {
            $pr = 'FREE';
        } else {
            $idp = $a['gpoup_proxy'];
            $sql = "SELECT * FROM group_proxy WHERE id=$idp";
            $nn = select($sql);
            $pr = $nn['name_group'];
        }
    }
    if ($a['useacc'] == '0') {
        $use = 'FREE';
    } else {
        $use = 'WORK'; //ooo
    }
    $find = 'EAAB';
    $tock = $a['tocken'];
    $pos1 = stripos($tock, $find);
    if ($pos1 !== false) {
        $tocken = 'YES';
    } else {
        $tocken = 'NO';
    }


    $tk = $a['task_count'] - 1;

    if ($tk < 0) {
        $tk = 0;
    }


    $id_gr = $a['group_acc'];
    $gr2 = array_filter($gr1, fn(array $data2): bool => $data2['id'] == $id_gr);
    if (!empty($gr2)) {


        foreach ($gr2 as $z) {
            $gr = $z['name_group'];
        }
    } else {
        $gr = 'No Group';
    }

    $id_tag = $a['account_tags'];
    $tag2 = array_filter($tag1, fn(array $data4): bool => $data4['id'] == $id_tag);
    if (!empty($tag2)) {


        foreach ($tag2 as $x) {
            $t = $x['tag'];
        }
    } else {
        $t = 'No tag';
    }


    $life = $a['life'];



    $id_s = $a['server'];
    $ser2 = array_filter($ser1, fn(array $data1): bool => $data1['id'] == $id_s);
    if (!empty($ser2)) {


        foreach ($ser2 as $y) {
            $ser = $y['name_server'];
        }
    } else {
        $ser = 'No Server';
    }
    $name = $a['name'];

    if ($a['works'] == '0') {
        $spst = '';
    } else {
        $spst = 'incorrect pass';
    }

    $st = $a['status'];

    foreach ($st1 as $z) {
        if ($z['id'] == $st) {
            $st = $z['status'];
        }
    }


//    $fr = $a['friends']-$a['friends_friends'];
//    if ($fr===0){
//        $friends .= '<strong>';
//    }else if ($colorFriends < 0) {
//           $friends .= '<strong>';
//      } else {
//         $friends .= '<strong>';
//      }

//    $id1 = $a['id'];
 //   $sql = "SELECT friends FROM friends WHERE id_acc = {$id1}  ORDER BY created DESC LIMIT 1, 1 ";

 //   $qw7 = select($sql);


//  if ($a['friends_friends'] === false) {
//        $friends = '<div style="color: #000000FF"><strong>';
//    } else {
//        $colorFriends = $a['friends'] - $a['friends_friends'];
//       if ($colorFriends < 0) {
//           $friends = '<div style="color: #b70202"><strong>';
//      } else {
//           $friends = '<div style="color: #02b711"><strong>';
//       }
//  }
    $friends = $a['friends'];

//    $friends .= '</strong>';


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


    $cr_acc = $data = $a['created_acc'];

    //   $data = date('d  M Y', $a['created']);


    $id_s = $a['server'];
    $ser2 = array_filter($ser1, fn(array $data1): bool => $data1['id'] == $id_s);
    //$ls = date('d  M Y G:i', $a['last_start']);
    $ls = $a['last_start'];
    if ($a['adv'] == 1) {
        $adv = 'YES';
    } else {
        $adv = 'NO';
    }
    $idf = $a['id_fb'];

    if (!empty($idf)) {
        $lfb = '<a href="https://facebook.com/';
        $lfb .= $idf;
        $lfb .= ' "target="_blank">';
        $lfb .= $a['login_fb'];
        $lfb .= '</a>';
    } else {
        $lfb = $a['login_fb'];
    }
    $fa = $a['2fa'];
    if ($fa == 'NULL' || $fa == 'None') {
        $fa = '-';
    } else {
        $fa = '+';
    }

    $ig1 = $a['ig'];
    if ($ig1 == 1) {
        $ig = 'bad';
    } else if (empty($ig1)) {
        $ig = '';
    } else {
        $ig = 'ok';
    }

    $ares = $a['ar'];
    if ($ares == '1') {
        $ar = 'OK';
    } else if ($ares == '2') {
        $ar = 'No Ok';
    } else {
        $ar = '?';
    }

    $mysql_data[] = array(

        'ids' => $id,
        'login' => $lfb,
        'mail' => $a['mail'],
        'phone' => $a['phone'],
        'gender' => $a['gender'],
        'avatar' => $ava,
        'proxy' => $pr,
        'server' => $ser,
        'group' => $gr,
        'tag' => $t,
        'status' => $st,
        'task' => $tk,
        'use' => $use,
        'life' => $life,
        'friends' => $friends,
        'tocken' => $tocken,
        'adv' => $adv,
        'last_start' => $ls,
        'action' => $action,
        'spst' => $spst,
        'fa' => $fa,
        'ar' => $ar,
        'created_acc' => $cr_acc,
        'name' => $name,
        'ig' => $ig,

    );
}
$data = array(

    'data' => $mysql_data,
);

// Convert PHP array to JSON array
try {
    $json_data = json_encode($data, JSON_THROW_ON_ERROR);
} catch (JsonException $e) {
}

print $json_data;

//$time = microtime(true) - $start;



