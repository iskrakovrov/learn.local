<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);

if (!empty($_REQUEST['proxy'])){
    $proxy = $_REQUEST['proxy'];
    $change_proxy = $_REQUEST['change_proxy'];
    $sql = 'UPDATE options SET proxy = ?, change_proxy = ?';
    $args = [$proxy, $change_proxy];
    $query = update($sql, $args);
    header('Location: ' .$_SERVER['HTTP_REFERER']);
    exit;
}



$sql = 'SELECT * FROM options';

$options = select($sql);
$pr = $options['proxy'];
$c_pr = $options['change_proxy'];
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
    <title>FB Combo options</title>
</head>
<body>
<?php
include_once 'inc/header.php'
?>
<main class="container-fluid ">
    <div class="row text-center">
        <h2>Options</h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    <?php echo $txtoptions ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">


                    <label for="num_s"><?php echo $txtoptions1 ?></label>
                    <input type="number" name="proxy" id="proxy" class="form-control" value="<?php echo $pr ?>"  required>

                    <br>
                    <label for="change_proxy"><?php echo $txtoptions3 ?></label>
                    <br>
                    <select id="change_proxy" name="change_proxy">
                        <option value="0"<?php if ($c_pr == 0) echo ' selected';?>>YES</option>
                        <option value="1"<?php if ($c_pr == 1) echo ' selected';?>>NO</option>



                    </select>
                    <br>
 <!--                   <label for="num_s"><?php echo $txtoptions2 ?></label>
                    <input type="text" name="num_s" id="num_s" class="form-control" placeholder="10-20"  required> -->


                    <br>
                    <br>

                    <button class="btn btn-secondary" name="opt" id="opt" value="opt">ACTIVATE
                    </button>



                </form>
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
