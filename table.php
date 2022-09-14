<!doctype html>
<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);
?>
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
    <title>FB Combo | Edit Task</title>
</head>
<body>
<?php
include_once 'inc/header.php';
?>

<br>
<div class="container-fluid">
    <div class="row justify-content-md-center">
        <div class="col-1">
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInputGrid"  >
                <label for="floatingInputGrid">Login</label>
            </div>
        </div>
        <div class="col-1">
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInputGrid" >
                <label for="floatingInputGrid">Email address</label>
            </div>
        </div>
        <div class="col-1">
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInputGrid" >
                <label for="floatingInputGrid">Phone</label>
            </div>
        </div>
        <div class="col-1">
            <div class="form-floating">
                <select class="form-select" id="floatingSelectGrid" aria-label="Floating label select example">
                    <option value="0" selected>Open this select menu</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                    <option value="3">None</option>
                </select>
                <label for="floatingSelectGrid">Gender</label>
            </div>
        </div>
        <div class="col-1">
            <div class="form-floating">
                <select class="form-select" id="floatingSelectGrid" aria-label="Floating label select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
                <label for="floatingSelectGrid">Works with selects</label>
            </div>
        </div>
        <div class="col-1">
            <div class="form-floating">
                <select class="form-select" id="floatingSelectGrid" aria-label="Floating label select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
                <label for="floatingSelectGrid">Works with selects</label>
            </div>
        </div>
        <div class="col-1">
            <div class="form-floating">
                <select class="form-select" id="floatingSelectGrid" aria-label="Floating label select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
                <label for="floatingSelectGrid">Works with selects</label>
            </div>
        </div>
    </div>

</div>
<br>
<table id="dr_table" class="cell-border" style="width:100%">
    <thead>
    <tr>
        <th class="check" style="text-align: center;">
            <input type="checkbox" id="all" value=""/>
        </th>
        <th>Login</th>
        <th>Mail</th>
        <th>Phone</th>
        <th>Gender</th>
        <th>Avatar</th>
        <th>Proxy On</th>
        <th>Server</th>
        <th>Group</th>
        <th>Status</th>
        <th>Task</th>
        <th>Use</th>
        <th>Create</th>
        <th>Friends</th>
        <th>Tocken</th>
        <th>ADV</th>
        <th>Last Start</th>
        <th>Action</th>

    </tr>
    </thead>
    <tbody>


    </tbody>
    <tfoot>
    <tr>
        <th></th>
        <th>Login</th>
        <th>Mail</th>
        <th>Phone</th>
        <th>Gender</th>
        <th>Avatar</th>
        <th>Proxy On</th>
        <th>Server</th>
        <th>Group</th>
        <th>Status</th>
        <th>Task</th>
        <th>Use</th>
        <th>Create</th>
        <th>Friends</th>
        <th>Tocken</th>
        <th>ADV</th>
        <th>Last Start</th>
        <th>Action</th>

    </tr>
    </tfoot>
</table>

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
