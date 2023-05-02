<?php

include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);

$err = $_GET['id'];
$today = date('Y-m-d-H-i-s');
$fname = 'error-' . $today . '.txt';
$sql = 'SELECT * FROM err WHERE value = ?';
$args = [$err];
$qu = selectAll($sql, $args);
$fp = fopen('tmp/' . $fname, 'w');


foreach ($qu as $r) {
    $err = $r['value'];
    $id = $r['id_acc'];
    $sql = 'SELECT login_fb, pass_fb, mail, mail_pass, imap_mail, 2fa, phone, coockie, bd, mb, yb, tocken FROM accounts WHERE id = ?';
    $args = [$id];
    $query = selectAll($sql, $args);

    // Открываем поток для записи
    foreach ($query as $a) {

        fwrite($fp, implode(';', $a) . "|" . $err . "\r\n");

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
                <a class="btn btn-secondary" href="<?php echo 'tmp/' . $fname ?>" role="button" download>
                    DOWNLOAD</a>
                <br>

            </form>
        </div>
    </div>
    <br>


</main>

</body>
</html>

