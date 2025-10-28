<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);

// Функция для безопасного получения change log
function getChangeLogContent() {
    $remoteUrl = 'http://soft.fbcombo.com/cl.txt';

    // Настройки для запроса
    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'timeout' => 5, // Таймаут 5 секунд
            'ignore_errors' => true
        ]
    ]);

    // Пытаемся получить содержимое через file_get_contents
    $content = @file_get_contents($remoteUrl, false, $context);

    // Если не получилось, пробуем через cURL
    if ($content === false && function_exists('curl_init')) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $remoteUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $content = curl_exec($ch);
        curl_close($ch);
    }

    if ($content !== false) {
        // Очищаем содержимое от потенциально опасных элементов
        $content = strip_tags($content);
        $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
        return nl2br($content);
    }

    return "Change log is currently unavailable. Please try again later.";
}

// Помечаем change log как прочитанный при первом заходе
if (!isset($_SESSION['change_log_read'])) {
    if (!file_exists('cache')) {
        mkdir('cache', 0755, true);
    }
    file_put_contents('cache/cl_last_read.txt', time());
    $_SESSION['change_log_read'] = true;
}

// Если нажали кнопку "Mark as read"
if (isset($_GET['read'])) {
    file_put_contents('cache/cl_last_read.txt', time());
    $_SESSION['change_log_read'] = true;
    header("Location: change_log.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap"
          rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link href="css/dt.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <title>Change Log - FB Combo</title>

    <style>
        .change-log-container {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .change-log-header {
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 10px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .change-log-content {
            white-space: pre-line;
            font-family: 'Courier New', monospace;
            line-height: 1.6;
            font-size: 14px;
        }

        .mark-as-read-btn {
            margin-left: 15px;
        }

        @media (max-width: 768px) {
            .change-log-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .mark-as-read-btn {
                margin-left: 0;
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
<?php include_once 'inc/header.php'; ?>

<main class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="change-log-container">
                <div class="change-log-header">
                    <h2 class="mb-0">Change Log</h2>
                    <a href="change_log.php?read=1" class="btn btn-primary btn-sm mark-as-read-btn">
                        <i class="fas fa-check-circle"></i> Mark as read
                    </a>
                </div>
                <div class="change-log-content">
                    <?php echo getChangeLogContent(); ?>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- DataTables jQuery -->
<script src="js/dtjquery.js"></script>

</body>
</html>