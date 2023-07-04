<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);
if ($_POST['cls'] == '1'){
    $sql= 'delete from `note`';
    $qw = delete($sql);
}
if (!empty ($_REQUEST['txt'])) {
    $txt = $_REQUEST['txt'];
$t = Time();

    $sql = "INSERT INTO `note` (id,created,text) VALUES (1, $t ,?) ON DUPLICATE KEY UPDATE text = ?";


    $argc = [$txt, $txt];
    $qw = insert($sql, $argc);
}
if ($_POST['cls'] == '1'){
    $sql= 'delete from `note`';
    $qw = delete($sql);
}
$sql = 'SELECT * FROM note';
$gg = select($sql);
?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>

    <?php
    require_once('inc/meta.php');
    ?>


    <title>Note</title>


</head>

<body>
<?php
require_once 'inc/header.php';

?>

<div class="container">
    <div class="row clearfix">
        <br>
        <div class="alert alert-warning" role="alert">
            <div style="text-align: center;">Notes</div>
        </div>
        <br>
        <form method="post">
            <textarea class="form-control rounded-0" id="txt" name="txt" rows="10"><?php echo $gg['text'] ?></textarea>
            <br>
            <br>

            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="submit" name = "cls" id = "cls" value="1" class="btn btn-danger">Clear</button>
            <br>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>