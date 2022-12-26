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
$id = $_REQUEST['id'];
$sql = "SELECT COUNT(id) FROM stat_invite WHERE id_acc = $id ";
$dall = select($sql);
$sql = "SELECT COUNT(id) FROM stat_invite WHERE id_acc = $id AND  created >= unix_timestamp(now()-interval 30 day)";
$d30 = select($sql);
$sql = "SELECT COUNT(id) FROM stat_invite WHERE id_acc = $id AND  created >= unix_timestamp(now()-interval 7 day)";
$d7 = select($sql);
$sql = "SELECT COUNT(id) FROM stat_invite WHERE id_acc = $id AND  created >= unix_timestamp(now()-interval 1 day)";
$d1 = select($sql);
$dall = $dall['COUNT(id)'];
$d30 = $d30['COUNT(id)'];
$d7 = $d7['COUNT(id)'];
$d1 = $d1['COUNT(id)'];
$sql = "SELECT COUNT(id) FROM stat_like WHERE id_acc = $id ";
$lall = select($sql);
$sql = "SELECT COUNT(id) FROM stat_like WHERE id_acc = $id AND  created >= unix_timestamp(now()-interval 30 day)";
$l30 = select($sql);
$sql = "SELECT COUNT(id) FROM stat_like WHERE id_acc = $id AND  created >= unix_timestamp(now()-interval 7 day)";
$l7 = select($sql);
$sql = "SELECT COUNT(id) FROM stat_like WHERE id_acc = $id AND  created >= unix_timestamp(now()-interval 1 day)";
$l1 = select($sql);
$lall = $lall['COUNT(id)'];
$l30 = $l30['COUNT(id)'];
$l7 = $l7['COUNT(id)'];
$l1 = $l1['COUNT(id)'];
?>





<main class="container-fluid ">
    <div class="row text-center">
        <h2>Statistic</h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-8 text-center">


                <div class="alert alert-info" role="alert">
                    <?php echo $txtindex1 ?>
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