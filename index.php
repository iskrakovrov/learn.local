<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);
require_once('inc/version.php');
$homepage = file_get_contents('https://soft.fbcombo.com/ver.php');

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
                <a href="https://soft.fbcombo.com/update.zip">Актуальная версия панели <?php echo $homepage?> <span>DOWNLOAD</span></a>
                <br>
                <span>После установки обновления не забудьте нажать UPDATE в верхнем меню для обновления структуры базы данных</span>
                <a href="#">Как обновить</a>
                <br>
                <a href="https://soft.fbcombo.com/putevoditel/">Инструкции</a>
                <br>

                <a href="https://t.me/iskrakovrov">Техподдержка в Telegram</a>
                <br>
                <br>
                СОВЕТЫ
                <br>
                Если вы работаете без прокси - обратите внимание на количество потоков, чтоб одновременно не работало более 2-3 аккаунтов
                <br>
                Если вы работаете с одной прокси со ссылкой или с одним модемом со сменой IP при старте аккаунта - работайте в 1 поток, чтоб смена IP не мешала работе аккаунтов.
                <br>
<br>
                <div class="alert alert-success" role="alert">
                    <strong><p> После тестирования и запуска всех режимов, что в планах.</p></strong>
                    <p> Запуск общей базы для инвайта по гео с 750 млн пользователями FB со всего мира. Чтоб вы могли делать выгрузки для себя</p>
                    <p> Разработка новых сервисных режимов для переброски и копирования ваших списков</p>
                    <p> Ну и как всегда, жду ваших идей</p>
                </div>


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