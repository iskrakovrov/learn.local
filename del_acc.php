<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$id = $_SESSION['id'];

foreach ($id as $a) {
    $sql = "SELECT * FROM accounts WHERE id = $a";
    $qu = select($sql);


    $sql = "INSERT IGNORE INTO  trash (id, login_fb, pass_fb, id_fb, name, bd, mb, yb, gender, avatar, created, comment, group_acc, server, id_proxy, status, works, useacc, friends, last_start, id_mail, id_phone, coockie, tocken, `2fa`, ua, mail, mail_pass, imap_mail, phone, adv) SELECT * FROM accounts WHERE id = $a";
    $qu1 = insert($sql);
    $sql = "DELETE FROM task WHERE account = $a";
    $qu1 = delete($sql);
    $sql = "DELETE FROM temp_task WHERE account = $a";
    $qu1 = delete($sql);
    $p = $qu['$id_proxy'];
    if (!empty($p) && ($p !== 0)) {

        $sql = "UPDATE proxy SET use_proxy = use_proxy - 1 WHERE id = $p";
        $qu1 = update($sql);

    }
    $sql = "DELETE FROM accounts WHERE id =$a";
    $qu1 = delete($sql);
}

$querty = delete($sql);
header('Location: ' . $_SERVER['HTTP_REFERER']);