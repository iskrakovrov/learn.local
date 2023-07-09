<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);
$nr = $_REQUEST['proxy1'];
$comm = $_REQUEST['comms1'];
$pg = $_REQUEST['pg'];
$sql = 'SELECT * FROM group_proxy';
$pr_gr = selectall($sql);

if (isset($_POST['proxy1'])) {
    $array = explode("\r\n", $_POST['proxy1']);

    for ($i = 0, $iMax = count($array); $i <= $iMax; $i++) {
        $c = (trim($array[$p]) . '<br/>');
    }
    $c = preg_replace('/<br[^>]*>/', '', $c);
    $i = 0;
    foreach ($array as $pr) {
        $i++;
        $res = parse_proxy($pr, $comm, $pg);
        $sql = $res[1];
        if (!empty($sql)) {
            $sel = select($res[1]);
            if (empty($sel)) {
                $ins = insert($res[0]);

            }
        }


    }
    header('Location: proxy.php');
}
?>


<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap"
        rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="css/dt.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">
    <title>FB Combo</title>
</head>
<body>
<?php
include_once 'inc/header.php'
?>
<main class="container-fluid ">
    <div class="row text-center">
        <h2><?php echo $txtaddpr ?></h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">


            <div class="alert alert-info" role="alert">
                <?php echo $txtaddpr1 ?>
            </div>
            <form method="post">
                <div class="form-group">


                 <textarea class="form-control rounded-0" id="proxy" name="proxy1" rows="10"
                           placeholder="<?php echo $txtnewline ?>"></textarea>
                    <br>
                    <label class="form-control" for="pg">Select a proxy group</label>
                    <select class="form-select" id="pg" name="pg" aria-label="Floating label select example">

                        <option value="0">No group</option>
                        <?php foreach ($pr_gr as $br) {


                            ?>
                            <option value="<?php echo $br['id'] ?>"><?php echo $br['name_group']?></option>
                        <?php } ?>
                    </select>
                    <br>
                    <label class="form-control" for="comms">Write a comment if you need</label>

                    <input type="text" class="form-control" id="comms" name="comms1"
                           placeholder="<?php echo $txtcomm ?>">


                    <br>

                    <button type="submit" name="proxy" class="btn btn-primary">Submit</button>
                    <br>
                </div>
            </form>
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