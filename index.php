<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);
require_once('inc/version.php');
$filename = 'mig.php';
require_once ($filename);
//$homepage = file_get_contents('https://soft.fbcombo.com/ver.php');

?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <!-- Required meta tags -->
    <?php
    require_once('inc/meta.php');
    ?>
    <title>FB Combo </title>
</head>
<body>
<?php

require_once 'inc/header.php'

?>



<main class="container-fluid ">
    <div class="row text-center">
        <h2>FB COMBO v<?php echo $vers ?></h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-8 text-center">


                <div class="alert alert-info" role="alert">
				<?php echo $txtindex1?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-8 text-center">

                <br>


                <a href="http://soft.fbcombo.com/update.zip"><?php echo $txtindex11?> <strong><?php echo $homepage?></strong> <span>DOWNLOAD FOR Windows</span></a>
                <br>
                <a href="http://soft.fbcombo.com/update_host.zip"><?php echo $txtindex11?> <strong><?php echo $homepage?></strong> <span>DOWNLOAD FOR Hosting</span></a>
                <br>

<br>




                <h2>Auto update for Windows</h2>
                <form action="download.php" method="post">
                    <button type="submit">Update</button>
                </form>
                <br>
                <h2>Auto update for Unix hosting</h2>
                <form action="download.php" method="post">
                    <button type="submit">Update</button>
                </form>
                <br>
                </html>
                <div class="alert alert-success" role="alert">
                    <?php echo $txtindex5 ?>
                </div>


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