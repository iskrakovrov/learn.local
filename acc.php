<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$accountsData = getAccountsData();
$groupData = getGroupData();
$getServerData = getServerData();
$statusData = getStatusData();
$accountTagsData = getAccountTagsData();
$proxyGroups = getProxyGroup();
$mysql_data = [];
foreach ($accountsData as $a) {
    if (!empty ($a['avatar'])) {
        $ava = 'OK';
    } else {
        $ava = 'NO';
    }


    $pr_gr = $a['gpoup_proxy'];

    foreach ($proxyGroups as $pgr) {
        if ($pgr['id'] == $pr_gr) {
            $pgr2 = $pgr['name_group']; // Нашли совпадение, сохраняем name
            break; // Можно выйти из цикла, так как совпадение найдено
        }
    }

     if ($pgr2===0) {
        $pr = 'FREE';
    } else if ($pgr2 !== null) {
        $pr = $pgr2;
    }  else {
        $pr = 'NO group';
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
    foreach ($groupData as $group) {
        if ($group['id'] == $id_gr) {
            $gr2 = $group['name_group']; // Нашли совпадение, сохраняем name
            break; // Можно выйти из цикла, так как совпадение найдено
        }
    }

    if ($gr2 !== null) {
        $gr = $gr2;
    } else {
        $gr = 'No Group';
    }


    $id_tag = $a['account_tags'];
    if ($id_tag == null) {
        $t = 'No tag';
    } else {
        foreach ($accountTagsData as $tag) {
            if ($tag['id'] == $id_tag) {
                $tag2 = $tag['tag']; // Нашли совпадение, сохраняем name
                break; // Можно выйти из цикла, так как совпадение найдено
            }
        }

        if ($tag2 !== null) {
            $t = $tag2;
        } else {
            $t = 'No tag';
        }
    }

    $life = !empty($a['life']) ? $a['life'] : 'No';

    $id_s = $a['server'];
    foreach ($getServerData as $ser) {
        if ($ser['id'] == $id_s) {
            $ser2 = $ser['name_server']; // Нашли совпадение, сохраняем name
            break; // Можно выйти из цикла, так как совпадение найдено
        }
    }

    if ($ser2 !== null) {
        $ser = $ser2;
    } else {
        $ser = 'No server';
    }


    $name = $a['name'];

    if ($a['works'] == '0') {
        $spst = '';
    } else {
        $spst = 'incorrect pass';
    }

    $id_stat = $a['status'];
    foreach ($statusData as $status) {
        if ($status['id'] == $id_stat) {
            $status2 = $status['status']; // Нашли совпадение, сохраняем name
            break; // Можно выйти из цикла, так как совпадение найдено
        }
    }

    if ($status2 !== null) {
        $st = $status2;
    } else {
        $st = 'No';
    }




$friends = $a['friends'];
$friends1 = $a['friends1'];

// Проверяем условия
if ($friends > $friends1) {
    // Если friends больше friends1
    $friends =  '<span style="font-weight: bold; color: green;">' . $friends .  '</span>';
} elseif ($friends < $friends1) {
    // Если friends меньше friends1
    $friends = '<span style="font-weight: bold; color: red;">' . $friends .  '</span>';
} else {
    // Если friends равно friends1
    $friends =  '<span style="font-weight: bold;">' . $friends . '</span>';
}


    $id = '<div style="text-align: center;"><input type="checkbox" name="a[]" value="';
    $id .= $a['id'];
    $id .= '"></div>';

    $action = '<div class="btn-group"><a href="edit_account.php?id=';
    $action .= $a['id'];
    $action .= '" class="btn btn-success" title="Edit" ><i class="bi bi-pencil-square"></i></a><a href="stat_account.php?id=';
    $action .= $a['id'];
    $action .= '" class="btn btn-success" title="Stat"><i class="bi bi-star"></i></a><a href="del_account.php?id=';
    $action .= $a['id'];
    $action .= '" class="btn btn-danger" title="Del"><i class="bi bi-x-circle-fill"></i></a></div>';


    $cr_acc = $data = $a['created_acc'];

    //   $data = date('d  M Y', $a['created']);


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

try {
    $json_data = json_encode($data, JSON_THROW_ON_ERROR);
} catch (JsonException $e) {
}

print $json_data;