<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);
if (!empty($_REQUEST['domen'])) {
    $domen = $_REQUEST['name_server'];
    $com = $_REQUEST['com_server'];
    $sql = "SELECT * FROM group_acc WHERE name_group = ?";
    $args = [$nserv];
    $ch = selectAll($sql, $args);
    if (empty($ch)) {
        $sql = "INSERT INTO group_acc (name_group, comment) VALUES (?, ?)";
        $args = [$nserv, $com];
        $ch = insert($sql, $args);
        header('Location: groups.php');
    }
}
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
    <title>FB Combo | Add mail service</title>
</head>
<body>
<?php
include_once 'inc/header.php'
?>
<main class="container-fluid ">
    <div class="row text-center">
        <h2>Add mail service</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">


            <div class="alert alert-info" role="alert">
                Enter the IMAP settings of the mail services you use
                <br>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <form method="post">
                <div class="form-group">
                    <label for="domen">Mail account domain</label>
                    <input type="text" class="form-control"  name = "domen"  id="domen"   placeholder="Mail account domain">
                </div>
                <div class="form-group">
                    <label for="domen">IMAP server</label>
                    <input type="text" class="form-control"  name = "imap"  id="imap"   placeholder="IMAP server">
                </div>
                <div class="form-group">
                    <label for="domen">Port IMAP</label>
                    <input type="text" class="form-control"  name = "port"  id="port"   placeholder="Port IMAP">
                </div>

                    <button type="submit" class="btn btn-primary">ADD mail service</button>
                </div>
            </form>

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
