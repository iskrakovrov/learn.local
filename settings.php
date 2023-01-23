<?php
include_once ('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$l = $_SESSION['lang'];
if ($l === 0){
    $sql = "SELECT lang FROM users";
    $res = select($sql);
    $lang = $res['lang'];
    $_SESSION["lang"] = $lang;
}
$lang = $_SESSION['lang'] . '.php';
require_once($lang);

if (!empty($_POST['login']))
{
    $login = $_POST['login'];
    $sql = "UPDATE users set login = '$login' where id = 1";
    $qw=update($sql);
}
if (!empty($_POST['pass']))
{
    $pass = $_POST['pass'];
    $sql = "UPDATE users set pass = '$pass' where id = 1";
    $qw = update($sql);
}
if ($_POST['lng'] !== 'Select' && (!empty($_POST['lng'])))
{
    $lng = $_POST['lng'];
    $sql = "UPDATE users set lang = '$lng' where id = 1";
    $qw = update($sql);
    $sql = "SELECT lang FROM users";
    $lang = select($sql);
    $_SESSION["admin"] = 1;
    $lang = $lang['lang'];
    $_SESSION["lang"] = $lang;
    header("Refresh: 0");
}
$sql = "SELECT * FROM users limit 1";
$user = select($sql);
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
    <link href="css/style.css" rel="stylesheet">
    <title>FB Combo</title>
</head>
<body>
<?php
include_once 'inc/header.php'
?>
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
                <label for="pass">Login</label>
                <input type="text" class="form-control rounded-0" id="pass" name="pass"
                          value="<?php echo $user['pass']?>">
                <br>
                <label for="lng">Language</label>
                <div class="form-floating">

                <select class="form-select" id="lng" name="lng">
                    <option value="1"<?php if ($lang == 1) echo ' selected';?>>Russian</option>
                    <option value="2"<?php if ($lang == 2) echo ' selected';?>>English</option>

                </select>
                </div>
                <br>
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
                <br>
            </form>
        </div>
    </div>
    <br>



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