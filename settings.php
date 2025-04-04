<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');



$l = $_SESSION['lang'];
if ($l === 0){
    $sql = 'SELECT lang FROM users';
    $res = select($sql);
    $lang = $res['lang'];
    $_SESSION['lang'] = $lang;
}
$lang = $_SESSION['lang'] . '.php';
require_once($lang);

// Обработка отправки формы
if (!empty($_POST['login']))
{
    $login = $_POST['login'];
    $sql = "UPDATE users SET login = ? WHERE id = 1";
    $args = [$login];
    $qw=update($sql, $args);
}
if (!empty($_POST['pass']))
{
    $pass = $_POST['pass'];
    $sql = "UPDATE users SET pass = ? WHERE id = 1";
    $args = [$pass];
    $qw = update($sql, $args);
}
if (!empty($_POST['api_key']) && strlen($_POST['api_key']) >= 20)
{
    $api_key = $_POST['api_key'];
    $sql = "UPDATE users SET api_key = ? WHERE id = 1";
    $args = [$api_key];
    $qw = update($sql, $args);
}
if ($_POST['lng'] !== 'Select' && (!empty($_POST['lng'])))
{
    $lng = $_POST['lng'];
    $sql = "UPDATE users SET lang = ? WHERE id = 1";
    $args = [$lng];
    $qw = update($sql, $args);
    $sql = 'SELECT lang FROM users';
    $lang = select($sql);
    $_SESSION['admin'] = 1;
    $lang = $lang['lang'];
    $_SESSION['lang'] = $lang;
    header('Refresh: 0');
}

$sql = 'SELECT * FROM users limit 1';
$user = select($sql);
?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
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
    </head>
</head>
<body>
<?php include_once 'inc/header.php' ?>
<main class="container-fluid ">
    <div class="row text-center">
        <h2>Settings</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <div class="alert alert-info" role="alert">
                <strong><?php echo $txtsett?></strong><br>
                <br>
            </div>
        </div>
    </div>

    <br>
    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <form method="post">
                <label for="login">Login</label>
                <input type="text" class="form-control rounded-0" id="login" name="login"
                       value="<?php echo $user['login']?>">

                <br>
                <label for="pass">Password</label>
                <input type="text" class="form-control rounded-0" id="pass" name="pass"
                       value="<?php echo $user['pass']?>">

                <br>
                <label for="api_key">API Key (min 20 chars)</label>
                <input type="text" class="form-control rounded-0" id="api_key" name="api_key"
                       value="<?php echo $user['api_key'] ?? '' ?>" minlength="20">

                <br>
                <label for="lng">Language</label>
                <div class="form-floating">
                    <select class="form-select" id="lng" name="lng">
                        <option value="1"<?php if ($lang == 1) echo ' selected';?>>Russian</option>
                        <option value="2"<?php if ($lang == 2) echo ' selected';?>>English</option>
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</main>

<!-- Скрипты -->
</body>
</html>