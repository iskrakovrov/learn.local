<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);
require_once('inc/version.php');
$filename = 'mig.php';
require_once ($filename);
//$homepage = file_get_contents('https://soft.fbcombo.com/ver.php');

?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <!-- Required meta tags -->
    <?php
    require_once('inc/meta.php');
    ?>
    <title>FB Combo </title>
    <style>
        .description-box {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            border-left: 5px solid #1877f2;
        }
        .description-title {
            color: #1877f2;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }
        .feature-list {
            list-style-type: none;
            padding-left: 0;
        }
        .feature-list li {
            padding: 0.5rem 0;
            position: relative;
            padding-left: 2rem;
        }
        .feature-list li:before {
            content: "✓";
            color: #28a745;
            position: absolute;
            left: 0;
            font-weight: bold;
        }
        .update-notice {
            background-color: #fff3cd;
            border-left: 5px solid #ffc107;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(255,193,7,0.4); }
            70% { box-shadow: 0 0 0 10px rgba(255,193,7,0); }
            100% { box-shadow: 0 0 0 0 rgba(255,193,7,0); }
        }
    </style>
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
                <div class="description-box">
                    <h3 class="description-title">FBcombo - Professional Facebook Automation Suite</h3>
                    <p>FBcombo is a powerful software platform designed for managing and automating multiple Facebook accounts efficiently. Our solution provides:</p>
                    <ul class="feature-list">
                        <li>Multi-threaded account management with browser automation</li>
                        <li>Comprehensive tools for account registration and maintenance</li>
                        <li>Advanced automation of common Facebook activities</li>
                        <li>Secure proxy integration for account protection</li>
                        <li>Detailed statistics and performance monitoring</li>
                    </ul>

                    <hr>

                    <h3 class="description-title">FBcombo - Профессиональный комплекс для автоматизации Facebook</h3>
                    <p>FBcombo - это мощная платформа для управления и автоматизации работы множества аккаунтов Facebook. Наше решение предоставляет:</p>
                    <ul class="feature-list">
                        <li>Многопоточное управление аккаунтами с автоматизацией браузера</li>
                        <li>Комплексные инструменты для регистрации и обслуживания аккаунтов</li>
                        <li>Продвинутую автоматизацию стандартных действий в Facebook</li>
                        <li>Безопасную работу через прокси для защиты аккаунтов</li>
                        <li>Детальную статистику и мониторинг производительности</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-8 text-center">
                <h2>UPDATE</h2>
                <form action="download.php" method="post">
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
                <br>

                <div class="alert update-notice" role="alert">
                    <h4>Mobile Module Announcement</h4>
                    <p>The Facebook Account Creator is now in beta testing mode. <a href="/acc_creator.php">Read more here</a>.</p>
                    <hr>
                    <h4>Объявление о мобильном модуле</h4>
                    <p>Регистратор аккаунтов Facebook запущен в тестовом режиме. Подробнее читайте <a href="/acc_creator.php">Read more here</a></p>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>