<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Создаем папку tmp если не существует
if (!file_exists('tmp')) {
    mkdir('tmp', 0755, true);
}

// Очистка файлов старше 24 часов
foreach (glob("tmp/list-*.txt") as $file) {
    if (filemtime($file) < time() - 86400) { // 86400 секунд = 24 часа
        unlink($file);
    }
}

include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$lang = $_SESSION['lang'] . '.php';
require_once($lang);

$id = $_REQUEST['id'];
$today = date('Y-m-d-H-i-s');
$fname = 'list-' . $today . '.txt';

// Проверяем и очищаем имя файла от недопустимых символов
$fname = preg_replace('/[^a-zA-Z0-9\-\.]/', '', $fname);
$filepath = 'tmp/' . $fname;

// Записываем данные в файл
$fp = fopen($filepath, 'w');
if ($fp) {
    $sql = 'SELECT value FROM value_lists WHERE list = ?';
    $args = [$id];
    $query = selectAll($sql, $args);

    foreach ($query as $a) {
        fwrite($fp, implode(';', $a) . "\r\n");
    }
    fclose($fp);
} else {
    die("Error: Could not create file $filepath");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="css/dt.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="css/style.css" rel="stylesheet">
    <title>FB Combo EXPORT list</title>
</head>
<body>
<?php include_once 'inc/header.php'; ?>

<main class="container-fluid">
    <div class="row text-center">
        <h2>Export list</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <div class="alert alert-info" role="alert">
                <?php echo $txtexp ?>
                <br>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <form method="post">
                <a class="btn btn-secondary" href="<?php echo htmlspecialchars($filepath) ?>" role="button" download>
                    DOWNLOAD
                </a>
            </form>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>