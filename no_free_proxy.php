<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$ids = $_SESSION['ids'];
foreach ($ids as $a) {
    $sql = "SELECT id_proxy FROM accounts WHERE id = $a";
    $qu = select($sql);
    $p = $qu['id_proxy'];
    if (!is_null($p)) {
        if ($p !== 0) {
            $sql = "SELECT use_proxy FROM proxy WHERE id = $p";
            $qu1 = select($sql);
            $p1 = $qu1['use_proxy'];
            --$p1;
            if ($p1 < 0) {
                $p1 = 0;
            }

            $sql = "UPDATE proxy SET use_proxy = '$p1' WHERE id = $p";
            $qu = update($sql);

        }
        $sql = "UPDATE accounts SET id_proxy = NULL where id = $a ";
        $qu = update($sql);

    }
}




header("Location: accounts.php");
exit;