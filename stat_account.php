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

$sql = 'SELECT * FROM friends WHERE id_acc = ? ORDER BY created DESC LIMIT 20';
$args = [$id];
$statFriends = selectAll($sql, $args);

$sql = "SELECT login_fb FROM accounts WHERE id = ?";
$args = [$id];
$login = select($sql, $args);
$login = $login['login_fb'];
$sql = "SELECT COUNT(id) FROM stat_invite WHERE id_acc = ?";
$args = [$id];
$dall = select($sql, $args);
$sql = "SELECT COUNT(id) FROM stat_invite WHERE id_acc = ? AND  created >= unix_timestamp(now()-interval 30 day)";
$args = [$id];
$d30 = select($sql, $args);
$sql = "SELECT COUNT(id) FROM stat_invite WHERE id_acc = ? AND  created >= unix_timestamp(now()-interval 7 day)";
$args = [$id];
$d7 = select($sql, $args);
$sql = "SELECT COUNT(id) FROM stat_invite WHERE id_acc = ? AND  created >= unix_timestamp(now()-interval 1 day)";
$args = [$id];
$d1 = select($sql, $args);
$dall = $dall['COUNT(id)'];
$d30 = $d30['COUNT(id)'];
$d7 = $d7['COUNT(id)'];
$d1 = $d1['COUNT(id)'];
$sql = "SELECT COUNT(id) FROM stat_like WHERE id_acc = ?";
$args = [$id];
$lall = select($sql, $args);
$sql = "SELECT COUNT(id) FROM stat_like WHERE id_acc = ? AND  created >= unix_timestamp(now()-interval 30 day)";
$args = [$id];
$l30 = select($sql, $args);
$sql = "SELECT COUNT(id) FROM stat_like WHERE id_acc = ? AND  created >= unix_timestamp(now()-interval 7 day)";
$args = [$id];
$l7 = select($sql, $args);
$sql = "SELECT COUNT(id) FROM stat_like WHERE id_acc = ? AND  created >= unix_timestamp(now()-interval 1 day)";
$args = [$id];
$l1 = select($sql, $args);
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
                        <div id="container"></div>

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
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/modules/accessibility.js"></script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>



    let params = (new URL(document.location)).searchParams;
    id = params.get("id")
    console.log(params.get("id"));



    function ajaxRequest(callback) {
     //   var block = ("autocomplete_job");
        //alert("ajaxRequest");
        $.ajax({
            type: "GET",

            url: "ajax.php?id="+id,
            async:false,

            /* прочие настройки */
            success: function(data) {
                response = data;
                callback(response);
            }
        });
        return response;
    };

    dat1 = ajaxRequest(function(response){

    });

console.log(dat1)
    dat = $.parseJSON(dat1);

    const data = dat
    console.log(data);
    let parsedData = [];

    data.regtime.forEach((val, i) => {
        let x = parseInt(val) * 1000,
            y = data.delay[i]
        y = parseInt(y)
        parsedData.push([x, y]);
    });

    console.log(parsedData);

    Highcharts.chart('container', {

        xAxis: {
            type: 'datetime'
        },
        title: {
            text: 'Friends'
        },

        series: [{
            data: parsedData
        }]
    });



</script>
<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->
</body>
</html>
