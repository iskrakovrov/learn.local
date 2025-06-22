<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

// Инициализация языка
$l = $_SESSION['lang'] ?? 0;
if ($l === 0) {
    $sql = 'SELECT lang FROM users LIMIT 1';
    $res = select($sql);
    $lang = $res['lang'];
    $_SESSION['lang'] = $lang;
}
$lang_file = $_SESSION['lang'] . '.php';
require_once($lang_file);

// Получаем текущие данные пользователя
$sql = 'SELECT * FROM users LIMIT 1';
$user = select($sql);

// Обработка отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sqlArgs = [];
    $updates = [];
    $need_refresh = false;

    // Проверяем и добавляем только заполненные и измененные поля
    if (!empty($_POST['login']) && $_POST['login'] != $user['login']) {
        $updates[] = "login = ?";
        $sqlArgs[] = $_POST['login'];
    }

    if (!empty($_POST['pass']) && $_POST['pass'] != $user['pass']) {
        $updates[] = "pass = ?";
        $sqlArgs[] = $_POST['pass'];
    }

    if (!empty($_POST['api_key']) && strlen($_POST['api_key']) >= 20 && $_POST['api_key'] != $user['api_key']) {
        $updates[] = "api_key = ?";
        $sqlArgs[] = $_POST['api_key'];
    }

    if (!empty($_POST['lng']) && $_POST['lng'] != 'Select' && $_POST['lng'] != $user['lang']) {
        $updates[] = "lang = ?";
        $sqlArgs[] = $_POST['lng'];
        $_SESSION['lang'] = $_POST['lng'];
        $need_refresh = true;
    }

    // Если есть изменения - обновляем базу
    if (!empty($updates)) {
        $sql = "UPDATE users SET " . implode(', ', $updates) . " WHERE id = 1";
        $qw = update($sql, $sqlArgs);

        if ($qw) {
            // Обновляем данные пользователя после сохранения
            $user = select('SELECT * FROM users LIMIT 1');

            // Если изменился язык - перезагружаем страницу
            if ($need_refresh) {
                header('Location: ' . $_SERVER['PHP_SELF']);
                exit;
            }

            // Сообщение об успехе
            $success_message = 'Settings saved successfully!';
        } else {
            $error_message = 'Error saving settings!';
        }
    } else {
        $info_message = 'No changes detected.';
    }
}
?>
<!doctype html>
<html lang="en">
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
    <link href="css/style.css" rel="stylesheet">
    <title>FB Combo</title>
    <script>
        function generateApiKey() {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let key = '';
            for (let i = 0; i < 32; i++) {
                key += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            document.getElementById('api_key').value = key;
        }
    </script>
</head>
<body>
<?php include_once 'inc/header.php' ?>
<main class="container-fluid">
    <div class="row text-center">
        <h2>Settings</h2>
    </div>

    <?php if (!empty($success_message)): ?>
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $success_message ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($error_message)): ?>
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $error_message ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($info_message)): ?>
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <?= $info_message ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <div class="alert alert-info" role="alert">
                <strong><?= $txtsett ?? 'Settings management' ?></strong>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-3">
        <div class="col-md-6">
            <form method="post">
                <div class="mb-3">
                    <label for="login" class="form-label">Login</label>
                    <input type="text" class="form-control" id="login" name="login"
                           value="<?= htmlspecialchars($user['login'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label for="pass" class="form-label">Password</label>
                    <input type="text" class="form-control" id="pass" name="pass"
                           value="<?= htmlspecialchars($user['pass'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label for="api_key" class="form-label">API Key (min 20 chars)</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="api_key" name="api_key"
                               value="<?= htmlspecialchars($user['api_key'] ?? '') ?>"
                               minlength="20" <?= empty($user['api_key']) ? 'required' : '' ?>>
                        <button type="button" class="btn btn-outline-secondary" onclick="generateApiKey()">
                            Generate new API key
                        </button>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="lng" class="form-label">Language</label>
                    <select class="form-select" id="lng" name="lng" required>
                        <option value="Select" disabled>Select language</option>
                        <option value="1" <?= ($user['lang'] ?? 0) == 1 ? 'selected' : '' ?>>Russian</option>
                        <option value="2" <?= ($user['lang'] ?? 0) == 2 ? 'selected' : '' ?>>English</option>
                    </select>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Save Settings</button>
                </div>
            </form>
        </div>
    </div>
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>