<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);
require_once('inc/version.php');


?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <!-- Required meta tags -->
    <?php
    require_once('inc/meta.php');
    ?>
    <title>FB Combo </title>
</head>
<body>
<?php

require_once 'inc/header.php'

?>





<main class="container-fluid ">
    <div class="row text-center">
        <h2>FB COMBO v<?php echo $vers ?></h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-8 text-center">


                <div class="alert alert-info" role="alert">
				<?php echo $txtindex1 ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-8 text-center">

                <br>

                Текущая версия панели
                <br>
                <a href="#">Актуальная версия панели СКАЧАТЬ</a>
                <br>
                <a href="#">Как обновить</a>
                <br>
                <a href="https://soft.fbcombo.com/putevoditel/">Инструкции</a>
                <br>
                <a href="https://soft.fbcombo.com/putevoditel/">https://t.me/iskrakovrov</a>
                <br>
                <br>
                <br>
                СОВЕТЫ
                <br>
                Если вы работаете без прокси - обратите внимание на количество потоков, чтоб одновременно не работало более 2-3 аккаунтов
                <br>
                Если вы работаете с одной прокси со ссылкой или с одним модемом со сменой IP при старте аккаунта - работайте в 1 поток, чтоб смена IP не мешала работе аккаунтов.
                <br>



            </div>
        </div>
    </div>


</main>





<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->
</body>
</html>