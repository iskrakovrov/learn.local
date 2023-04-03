<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);



?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <!-- Required meta tags -->
    <?php
    require_once('inc/meta.php');
    ?>
    <title>STATISTIC </title>
</head>
<body>
<?php

require_once 'inc/header.php';
$sql = 'SELECT COUNT(id) AS count FROM stat_invite';
$dall = $d30 = select($sql);

$sql = 'SELECT COUNT(id) AS count FROM stat_invite WHERE  created >= unix_timestamp(now()-interval 30 day)';
$d30 = select($sql);
$sql = 'SELECT COUNT(id) AS count FROM stat_invite WHERE created >= unix_timestamp(now()-interval 7 day)';
$d7 = select($sql);
$sql = 'SELECT COUNT(id) AS count FROM stat_invite WHERE created >= unix_timestamp(now()-interval 1 day)';
$d1 = select($sql);
$dall = $dall['count'];
$d30 = $d30['count'];
$d7 = $d7['count'];
$d1 = $d1['count'];
$sql = 'SELECT COUNT(id) AS count FROM stat_like';
$lall = select($sql);
$sql = 'SELECT COUNT(id) AS count FROM stat_like WHERE created >= unix_timestamp(now()-interval 30 day)';
$l30 = select($sql);
$sql = 'SELECT COUNT(id) AS count FROM stat_like WHERE created >= unix_timestamp(now()-interval 7 day)';
$l7 = select($sql);
$sql = 'SELECT COUNT(id) AS count FROM stat_like WHERE created >= unix_timestamp(now()-interval 1 day)';
$l1 = select($sql);
$lall = $lall['count'];
$l30 = $l30['count'];
$l7 = $l7['count'];
$l1 = $l1['count'];
?>





<main class="container-fluid ">
    <div class="row text-center">
        <h2>Statistic</h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-8 text-center">


                <div class="alert alert-info" role="alert">
                    <strong>Account <?php echo $login ?></strong>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-8 text-center">

                <div class="card text-center">
                    <div class="card-header">
                        <h5> Invites </h5>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">All invite</h5>
                        <p class="card-text"><strong><?php echo $dall ?></strong></p>
                        <h5 class="card-title">30 day invites</h5>
                        <p class="card-text"><strong><?php echo $d30 ?></strong></p>
                        <h5 class="card-title">7 day invites</h5>
                        <p class="card-text"><strong><?php echo $d7 ?></strong></p>
                        <h5 class="card-title">24 hours invites</h5>
                        <p class="card-text"><strong><?php echo $d1 ?></strong></p>

                    </div>

                </div>
                <div class="card text-center">
                    <div class="card-header">
                        <h5> Likes </h5>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">All likes</h5>
                        <p class="card-text"><strong><?php echo $lall ?></strong></p>
                        <h5 class="card-title">30 day likes</h5>
                        <p class="card-text"><strong><?php echo $l30 ?></strong></p>
                        <h5 class="card-title">7 day likes</h5>
                        <p class="card-text"><strong><?php echo $l7 ?></strong></p>
                        <h5 class="card-title">24 hours likes</h5>
                        <p class="card-text"><strong><?php echo $l1 ?></strong></p>

                    </div>

                </div>
                <div class="card text-center">
                    <div class="card-header">
                        <h5> Invites </h5>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">All invite</h5>
                        <p class="card-text"><strong><?php echo $dall ?></strong></p>
                        <h5 class="card-title">30 day invites</h5>
                        <p class="card-text"><strong><?php echo $d30 ?></strong></p>
                        <h5 class="card-title">7 day invites</h5>
                        <p class="card-text"><strong><?php echo $d7 ?></strong></p>
                        <h5 class="card-title">24 hours invites</h5>
                        <p class="card-text"><strong><?php echo $d1 ?></strong></p>

                    </div>

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
