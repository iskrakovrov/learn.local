<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);



include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);


$id = $_SESSION['ids'];
$today = date('Y-m-d-H-i-s');
$fname = 'accounts-' . $today . '.txt';

$fp = fopen('tmp/' . $fname, 'w');
foreach ($id as $b) {
    $sql = "SELECT login_fb, pass_fb, mail, mail_pass, imap_mail, 2fa, phone, coockie, bd, mb, yb, tocken, CONCAT('www.facebook.com/', id_fb), ua AS facebook_url FROM accounts WHERE id = ?";

    $args = [$b];
    $query = selectAll($sql, $args);

    // Открываем поток для записи
    foreach ($query as $a) {
     //   echo $a;
 //       fputcsv($fp, $a, ";");  // Записываем строки в поток
        fwrite($fp, implode(';', $a) . "\r\n");
    }
}
fclose($fp);
?>

<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap"
          rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="css/dt.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="css/style.css" rel="stylesheet">
    <title>FB Combo EXPORT accounts</title>
</head>
<body>
<?php
include_once 'inc/header.php';


?>
<main class="container-fluid ">
    <div class="row text-center">
        <h2>Export accounts</h2>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>
