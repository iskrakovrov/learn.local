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
    <?php
    require_once 'inc/meta.php';
    ?>
    <title>Generation Text</title>
</head>
<body>
<?php
include_once 'inc/header.php';
$ids = $_SESSION['ids'];
$i = 0;
session_start();
$_SESSION['ids'] = $ids;


?>
<main class="container-fluid ">
    <div class="row text-center">
        <h2>Generate text for posting</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">


            <div class="alert alert-info" role="alert">
                <?php echo $txttask1 ?>
            </div>

            <form method="post" action="task.php">
                <div class="form-group">
                    <label for="promt">Promt</label>
                    <textarea class="form-control" id="promt" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="text">text</label>
                    <textarea class="form-control" id="text" rows="10"></textarea>
                </div>

                </select>

                <br>
                <button class="btn btn-secondary">ACTIVATE
                </button>
            </form>


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
