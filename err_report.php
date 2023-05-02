<?php

include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);

$id = $_SESSION['ids'];
$today = date('Y-m-d-H-i-s');
$fname = 'error-' . $today . '.txt';

$fp = fopen('tmp/' . $fname, 'w');
foreach ($id as $b) {
    $sql = 'SELECT * FROM err WHERE id = ?';
    $args = [$b];
    $qu = selectAll($sql, $args);
    $err = $qu['value'];
    foreach ($qu as $r) {
        $sql = "SELECT login_fb, pass_fb, mail, mail_pass, imap_mail, 2fa, phone, coockie, bd, mb, yb, tocken FROM accounts WHERE id = ?";
        $args = [$r];
        $query = selectAll($sql, $args);

    // Открываем поток для записи
    foreach ($query as $a) {
        //   echo $a;
        //       fputcsv($fp, $a, ";");  // Записываем строки в поток
        fwrite($fp, implode(';', $a) . "\r\n");
    }
    }
}
fclose($fp);
?>

<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <!-- Required meta tags -->
   <?php
   require_once 'inc/meta.php';
   ?>
    <title>FB Combo ERROR REPORT</title>
</head>
<body>
<?php
include_once 'inc/header.php';


?>
<main class="container-fluid ">
    <div class="row text-center">
        <h2>Export ERROR REPORT</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">


            <div class="alert alert-info" role="alert">
                <?php echo $txtexp ?>

                <br>
            </div>
        </div>
    </div>

    <br>
    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <form method="post">

                <br>
                <br>
                <a class="btn btn-secondary" href="<?php echo 'tmp/'. $fname ?>" role="button" download>
                    DOWNLOAD</a>
                <br>

            </form>
        </div>
    </div>
    <br>


</main>

</body>
</html>

