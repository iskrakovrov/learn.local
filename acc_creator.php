<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);
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
        <h2>About the Account Creator.</h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-8 text-center">


                <p class="alert alert-info" role="alert">
                    We present to you a new software product, the Account Creator. This program is integrated with the FB Combo panel for creating Facebook accounts.
                    The software is designed to register accounts using SMS or email (depending on what Facebook allows) and also for the initial setup of accounts
                    immediately after registration. In the future, additional modes will be added to the program, which are not available in the desktop version of Facebook.
                    These include features such as increasing followers on accounts, an advanced mode for mass posting in Facebook groups, more convenient modes for inviting
                    friends to groups and pages, and much more. The program will operate within mobile device emulators, such as Bluestacks. It includes support for proxies,
                    device fingerprinting, and utilizes the new Facebook app for Android.
            <br>
                The program's release is scheduled for April. The price will be $410, plus small monthly fees (including the Zennoposter activation cost). Until April or the release (if it happens earlier), the pre-order price is $360 for a version without additional payments (including the Zennoposter activation cost).

                    For any questions, contact Viktor on Telegram: @iskrakovrov.</p>
                </div>
            </div>


    </div>
    <div class="row justify-content-center">
        <div class="col-8 text-center">


            <p class="alert alert-info" role="alert">
                Представляем вам новый программный продукт Создатель аккаунтов. Это программа интегрированная с панелью FB Combo для создания аккаунтов Facebook. Программа предназначена для регистрации аккаунтов с помощью СМС или почт (в зависимости от того, как это позволяет сделать Facebook), а так же для первоначального заполнения аккаунтов сразу после регистрации.
                В будущем помимо регистрации в программу будут добавляться дополнительные режимы, недоступные в desktop версии Facebook, такие, как Увеличение подписчиков на аккаунтах, расширенный режим массового постинга по группам Facebook, более удобные режимы приглашения в группы и на страницы друзей аккаунтов.
                Работа будет вестись в эмуляторах мобильных устройств - Bluestacks. Реализована работа с прокси, уникализация устройств, используется новое приложение Facebook для Android.
                <br>
                Релиз программы намечен на апрель. Цена программы будет 410$ + небольшие ежемесячные оплаты (с ценой активации Zennoposter). До апреля или релиза, если он произойдет раньше апреля цена предварительного заказа 360$ за версию без дополнительных оплат (с ценой активации Zennoposter) По всем вопросам пишите Виктору в телеграм iskrakovrov.</p>
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
