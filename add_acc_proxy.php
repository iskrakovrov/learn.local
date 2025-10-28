<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);

// Функция для логирования в файл
function log_message($message) {
    $log_file = $_SERVER['DOCUMENT_ROOT'] . '/account_import.log';
    $timestamp = date('Y-m-d H:i:s');
    $message = "[$timestamp] " . $message . "\n";
    file_put_contents($log_file, $message, FILE_APPEND | LOCK_EX);
    // Также дублируем в стандартный error_log для надежности
    error_log($message);
}

// Начинаем логирование
log_message("=== START INDIVIDUAL PROXY ACCOUNT ADDITION ===");

// Получаем списки для выпадающих меню
$sql = 'SELECT * FROM servers';
$ser = selectAll($sql);
$sql = 'SELECT * FROM group_acc';
$gr = selectAll($sql);

// Обработка отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['accs'])) {
    $accsInput = $_POST['accs'];
    $serv = $_POST['server'];
    $group_acc = $_POST['group'];
    $comm = $_POST['comms1'] ?? '';

    log_message("Form submitted. Server: $serv, Group: $group_acc, Comment: $comm");
    log_message("Input data length: " . strlen($accsInput) . " chars");

    // Разбиваем текстarea на строки
    $accountsArray = explode("\r\n", $accsInput);
    log_message("Found " . count($accountsArray) . " lines in input");

    $processedCount = 0;
    $skippedCount = 0;

    foreach ($accountsArray as $index => $accountLine) {
        log_message("--- Processing line $index: '$accountLine' ---");

        // Пропускаем пустые строки
        if (empty(trim($accountLine))) {
            log_message("Line $index is empty, skipping");
            $skippedCount++;
            continue;
        }

        // Разбираем строку аккаунта
        $accData = explode(";", $accountLine);
        log_message("Line split into " . count($accData) . " parts: " . implode(" | ", $accData));

        // Проверяем минимальное количество полей (логин, пароль и прокси обязательны)
        if (count($accData) < 9) {
            log_message("ERROR: Invalid account format. Expected 9 parts, got " . count($accData));
            $skippedCount++;
            continue;
        }

        // Присваиваем данные переменным
        $login = trim($accData[0]);
        $pass = trim($accData[1]);
        $mail = trim($accData[2]);
        $passmail = trim($accData[3]);
        $imappass = trim($accData[4]);
        $fa = trim($accData[5]);
        $phone = trim($accData[6]);
        $cookie = trim($accData[7]);
        $proxyStr = trim($accData[8]);

        log_message("Parsed data - Login: '$login', Proxy: '$proxyStr'");

        // Проверяем, существует ли уже аккаунт с таким логином
        $sqlCheckAcc = 'SELECT id FROM accounts WHERE login_fb = ?';
        $args = [$login];
        log_message("Checking if account exists: " . $sqlCheckAcc . " with params: " . implode(", ", $args));

        $existingAcc = select($sqlCheckAcc, $args);

        if (!empty($existingAcc)) {
            log_message("SKIP: Account already exists with ID: " . $existingAcc['id']);
            $skippedCount++;
            continue;
        } else {
            log_message("Account does not exist, proceeding...");
        }

        // 1. РАБОТА С ПРОКСИ - ОПРЕДЕЛЯЕМ ГРУППУ
        $sqlCheckProxy = 'SELECT id, group_proxy FROM proxy WHERE proxy = ?';
        $args = [$proxyStr];
        log_message("Checking if proxy exists: " . $sqlCheckProxy . " with params: " . implode(", ", $args));

        $existingProxy = select($sqlCheckProxy, $args);
        $proxyGroupId = null;

        if (!empty($existingProxy)) {
            // Прокси найден - используем ЕГО группу
            $proxyGroupId = $existingProxy['group_proxy'];
            log_message("Proxy found! Using existing group ID: " . $proxyGroupId);
        } else {
            log_message("Proxy not found, creating new group...");

            // Прокси не найден - нужно создать новую группу и добавить прокси в нее
            $sqlCheckProxyGroup = 'SELECT id FROM group_proxy WHERE name_group = ?';
            $args = [$login];
            log_message("Checking if proxy group exists: " . $sqlCheckProxyGroup . " with params: " . implode(", ", $args));

            $existingGroup = select($sqlCheckProxyGroup, $args);

            if (empty($existingGroup)) {
                // Группы нет, создаем новую с именем = логин
                $sqlInsertGroup = 'INSERT INTO group_proxy (name_group, comment) VALUES (?, ?)';
                $args = [$login, "Auto-generated for account $login"];
                log_message("Creating new proxy group: " . $sqlInsertGroup . " with params: " . implode(", ", $args));

                $result = insert($sqlInsertGroup, $args);

                if ($result) {
                    // Получаем ID последней вставленной записи альтернативным способом
                    $sqlGetLastId = 'SELECT LAST_INSERT_ID() as last_id';
                    $lastIdResult = select($sqlGetLastId);
                    $proxyGroupId = $lastIdResult['last_id'];
                    log_message("SUCCESS: Created new proxy group with ID: " . $proxyGroupId);
                } else {
                    log_message("ERROR: Failed to create proxy group!");
                    $skippedCount++;
                    continue;
                }
            } else {
                // Группа с таким именем уже существует
                $proxyGroupId = $existingGroup['id'];
                log_message("Using existing proxy group ID: " . $proxyGroupId);
            }

            // Добавляем новый прокси в созданную группу
            log_message("Calling parse_proxy function with: '$proxyStr', 'For account: $login', '$proxyGroupId'");
            $proxyData = parse_proxy($proxyStr, "For account: $login", $proxyGroupId);

            if ($proxyData !== null && !empty($proxyData[0])) {
                log_message("parse_proxy returned SQL: " . $proxyData[0]);
                $result = insert($proxyData[0]);

                if ($result) {
                    log_message("SUCCESS: Added new proxy to database");
                } else {
                    log_message("ERROR: Failed to add proxy to database!");
                }
            } else {
                log_message("ERROR: parse_proxy returned null or empty!");
            }
        }

        // 2. ДОБАВЛЯЕМ АККАУНТ
        // Собираем строку заново, но без прокси
        $accDataForFunc = array_slice($accData, 0, 8);
        $accStringForFunc = implode(';', $accDataForFunc);

        log_message("Calling parse_acc2 with: '$accStringForFunc', '$comm', '$serv', '$group_acc', '$cookie', '$proxyGroupId'");

        $accountSQLArray = parse_acc2($accStringForFunc, $comm, $serv, $group_acc, $cookie, $proxyGroupId);

        if (!empty($accountSQLArray) && !empty($accountSQLArray[0])) {
            log_message("parse_acc2 returned SQL: " . $accountSQLArray[0]);

            $result = insert($accountSQLArray[0]);

            if ($result) {
                log_message("SUCCESS: Account added to database");
                $processedCount++;
            } else {
                log_message("ERROR: Failed to add account to database!");
                $skippedCount++;
            }
        } else {
            log_message("ERROR: parse_acc2 returned empty result!");
            $skippedCount++;
        }
    }

    log_message("=== PROCESSING COMPLETE ===");
    log_message("Processed: $processedCount, Skipped: $skippedCount");

    // Перенаправляем после обработки
    $_SESSION['alert'] = 2; // Успех
    header('Location: accounts.php');
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <link href="css/dt.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <title>FB Combo | Add Accounts (Individual Proxy)</title>
</head>
<body>
<?php include_once 'inc/header.php'; ?>
<main class="container-fluid ">
    <div class="row text-center">
        <h2><?php echo $txtaddacc ?> (Individual Proxy)</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <div class="alert alert-info" role="alert">

                <strong>Format:</strong> login;password;mail;password_mail;IMAP_pass;2fa;Phone;JSON_cookie;proxy<br>
                <small>Example: user@example.com;pass123;user@mail.com;mailpass;imappass;123456;+1234567890;{"cookie":"value"};socks5://proxyuser:proxypass@proxy.ip:port</small>
                <br><br>
                <strong>Important:</strong> FOR SERVER PROXIES WORK ONLY
                <br>
                <strong>Log file:</strong> account_import.log in root directory
            </div>
            <form method="post">
                <div class="form-group">
                    <br>
                    <strong><label><?php echo $txtaddacc3 ?></label></strong>
                    <select class="form-select" name="server" required>
                        <option disabled selected value>Open this select menu</option>
                        <?php foreach ($ser as $a) : ?>
                            <option value="<?php echo $a['id'] ?>"><?php echo $a['name_server'] ?></option>
                        <?php endforeach; ?>
                    </select>

                    <strong><label><?php echo $txtaddacc4 ?></label></strong>
                    <select class="form-select" name="group" required>
                        <option disabled selected value>Open this select menu</option>
                        <?php foreach ($gr as $b) : ?>
                            <option value="<?php echo $b['id'] ?>"><?php echo $b['name_group'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <br>

                    <strong><label>Accounts Data (with proxy)</label></strong>
                    <textarea class="form-control rounded-0" id="accs" name="accs" rows="10" placeholder="<?php echo $txtnewline ?>" required></textarea>
                    <br>

                    <strong><label><?php echo $txtnoreq ?></label></strong>
                    <input type="text" class="form-control" id="comms1" name="comms1" placeholder="<?php echo $txtcomm ?>">
                    <br>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <br>
                </div>
            </form>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>