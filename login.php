<?php
include_once "inc/init.php";
require_once('inc/db.php');
require_once('function/function.php');
$error = "";


if (!empty($_REQUEST["submit"])) {
    $login = isset($_POST["login"]) ? trim($_POST["login"]) : "";
    $pswd = isset($_POST["pswd"]) ? trim($_POST["pswd"]) : "";
    $sql = "SELECT * FROM users WHERE login = '$login' AND pass = '$pswd'";
    $x = select($sql);
    if (empty($x)) {
        $error = "Неправильный логин или пароль";

    }
    if ($error === "") {
        $sql = "SELECT lang FROM users";
        $lang = select($sql);
        $_SESSION["admin"] = 1;
        $lang = $lang['lang'];
        $_SESSION["lang"] = $lang;

        header("Location: accounts.php");
    }
}



?>

<html lang="en">
<head>
    <?php
    require_once('inc/meta.php');


    ?>

    <title>FB Combo</title>
</head>
<body>

<main class="container-fluid ">

    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">

            <div class="col-xs-1 col-sm-3 col-md-3 col-lg-4">
                &nbsp;
            </div>

            <div class="col-xs-10 col-sm-6 col-md-6 col-lg-4">


                <h4 class="text-center mb-4">FBcombo</h4>
                <?php
                if (!empty($error))
                {

                    echo  '<div class="alert alert-danger" role="alert">
  Uncorrect password
</div>';


                }
                ?>
                <div id="loginbox">

                    <form method="post">
                        <div class="form-group">
                            <label for="login">Login</label>
                            <input type="text" name="login" class="form-control" id="login" placeholder=""
                                   autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="pswd">Password</label>
                            <input type="password" name="pswd" class="form-control" id="pswd" placeholder=""
                                   autocomplete="off">
                        </div>
                        &nbsp;
                        &nbsp;
                        <div class="text-center">
                            <button type="submit" name="submit" value="1" class="btn btn-primary">Sign In</button>
                        </div>
                    </form>


                </div>

            </div>

            <div class="col-xs-1 col-sm-3 col-md-3 col-lg-4">
                &nbsp;
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