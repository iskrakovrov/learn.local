<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);
$nr = $_REQUEST['accs'];
$serv = $_REQUEST['server'];
$group = $_REQUEST['group'];
$comm = $_REQUEST['comms1'];


if (!empty($nr) && !empty($serv) && !empty($group) && isset($_POST['accs'])) {
    $array = explode("\r\n", $_POST['accs']);

    for ($i = 0, $iMax = count($array); $i <= $iMax; $i++) {
        $c = (trim($array[$p]) . '<br/>');
    }
    $c = preg_replace('/<br[^>]*>/', '', $c);
    $i = 0;
    foreach ($array as $pr) {
        $i++;
        $res = parse_acc2($pr, $comm, $serv, $group, $cock,$pg);
        $sql = $res[0];

        if (!empty($sql)) {
            $ins = insert($sql);

        }


    }
    session_start();
    $_SESSION['alert'] = 2;
    header('Location: accounts.php');
    exit();

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
    <title>FB Combo | Add accounts</title>
</head>
<body>
<?php
include_once 'inc/header.php';
$sql = 'SELECT * FROM servers';
$ser = selectAll($sql);
$sql = 'SELECT * FROM group_acc';
$gr = selectAll($sql);
$sql = 'SELECT * FROM group_proxy';
$pr_gr = selectall($sql);
?>
<main class="container-fluid ">
    <div class="row text-center">
        <h2><?php echo $txtaddacc ?></h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">


            <div class="alert alert-info" role="alert">
                <?php echo $txtaddacc1 ?>
                <a class="btn btn-secondary" href="gr.php" role="button" data-placement="right"
                   title="<?php echo $txtaddacc1 ?>">Add account group</a>
                <br>
                <?php echo $txtaddacc2 ?>
                <br>
                <a class="btn btn-secondary" href="servers.php" role="button" data-toggle="tooltip"
                   data-placement="right"
                   title="<?php echo $txtaddacc2 ?>">Add Server</a>
                <br>
            </div>
            <form method="post">
                <div class="form-group">
                    <br>
                    <strong><label><?php echo $txtaddacc3 ?></label></strong>
                    <select class="form-select" name="server">
                        <option disabled selected value>Open this select menu</option>
                        <?php
                        $i = 0;
                        foreach ($ser as $a) {
                            $i++; ?>
                            <option value="<?php echo $a['id'] ?>"><?php echo $a['name_server'] ?></option>
                        <?php }
                        ?>
                    </select>

                    <strong><label><?php echo $txtaddacc4 ?></label></strong>
                    <select class="form-select" name="group">
                        <option disabled selected value>Open this select menu</option>
                        <?php
                        $i = 0;
                        foreach ($gr as $b) {
                            $i++; ?>
                            <option value="<?php echo $b['id'] ?>"><?php echo $b['name_group'] ?></option>
                        <?php }
                        ?>

                    </select>
                    <br>

                    <strong><label><?php echo $txtacc ?></label></strong>
                    <textarea class="form-control rounded-0" id="accs" name="accs" rows="10"
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

                    <strong><label><?php echo $txtnoreq ?></label></strong>
                    <input type="text" class="form-control" id="comms1" name="comms1"
                           placeholder="<?php echo $txtcomm ?>">


                    <br>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <br>
                </div>
            </form>
            <br>
Загрузить файл
            <br>
            <?php
            if (isset($_SESSION['message']) && $_SESSION['message'])
            {
                printf('<b>%s</b>', $_SESSION['message']);
                unset($_SESSION['message']);
            }
            ?>
            <form method="POST" action="upload_acc.php" enctype="multipart/form-data">
                <div>
                    <span>Upload a File:</span>
                    <input type="file" name="uploadedFile" />
                </div>
                <strong><label><?php echo $txtaddacc3 ?></label></strong>
                <select class="form-select" name="s1">
                    <option disabled selected value>Open this select menu</option>
                    <?php
                    $i = 0;
                    foreach ($ser as $a) {
                        $i++; ?>
                        <option value="<?php echo $a['id'] ?>"><?php echo $a['name_server'] ?></option>
                    <?php }
                    ?>
                </select>
                <strong><label><?php echo $txtaddacc4 ?></label></strong>
                <select class="form-select" name="g1">
                    <option disabled selected value>Open this select menu</option>
                    <?php
                    $i = 0;
                    foreach ($gr as $b) {
                        $i++; ?>
                        <option value="<?php echo $b['id'] ?>"><?php echo $b['name_group'] ?></option>
                    <?php }
                    ?>

                </select>
                <br>
                <strong><label><?php echo $txtnoreq ?></label></strong>
                <input type="text" class="form-control" id="c1" name="c1"
                       placeholder="<?php echo $txtcomm ?>">


                <br>
                <input type="submit" name="uploadBtn" value="Upload" />
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