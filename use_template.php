<!doctype html>
<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);
$ids = $_SESSION['ids'];
$sql = 'SELECT * FROM templates';
$qw = selectAll($sql);
session_start();
$_SESSION['ids'] = $ids;
if (!empty($_POST['use_t'])) {
    foreach ($ids as $i) {
        $sql = 'DELETE FROM task WHERE account =?';
        $args = [$i];
        $qw = delete($sql, $args);
        $sql = 'DELETE FROM temp_task WHERE account =?';
        $args = [$i];
        $qw = delete($sql, $args);
    }


    $template = $_POST['use_t'];
    $sql = 'SELECT * FROM template WHERE id_template = ?';
    $args = [$template];
    $atemp = selectAll($sql, $args);
    foreach ($atemp as $d) {
        foreach ($ids as $i) {


            $task = $d['task'];
            $setup = $d['setup'];
            $time = Time();
            $sql = 'INSERT INTO task (task, account, setup, created) VALUES (?,?,?,?)';
            $args = [$task, $i, $setup, $time];
            $qw = insert($sql, $args);

        }


    }
    session_start();
    $_SESSION['alert'] = 4;
    header('Location: accounts.php');
    exit();
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <title>FB Combo | Add task</title>
</head>
<body>
<?php
include_once 'inc/header.php';

?>
<main class="container-fluid ">
    <div class="row text-center">
        <h2>Add template</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">


            <div class="alert alert-info" role="alert">
                <?php echo $txttask1 ?>
            </div>


            <form method="post">


                <br>

                <table id="example" class="cell-border" style="width:100%">
                    <thead>
                    <tr>

                        <th>Name template</th>

                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    foreach ($qw as $b) {
                        $i++; ?>
                        <tr>

                            <td><?php $nam = $b['name'];
                                echo $nam ?></td>


                            <td>
                                <div class="col">


                                    <button type="submit" class="btn btn-success" id="use_t" name="use_t"
                                            value="<?php echo $b['id'] ?>">Success
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>


                    </tbody>
                    <tfoot>
                    <tr>

                        <th>Name template</th>

                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>

</main>


<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script src="js/jquery.js"></script>
<script src="js/dtjquery.js"></script>
<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->
<script>
    $('#all').click(function (e) {
        $('#example tbody :checkbox').prop('checked', $(this).is(':checked'));
        e.stopImmediatePropagation();
    });


    dr_table = $('#example').DataTable({

        "lengthMenu": [[100, 300, 500, -1], [30, 100, 200, "All"]],
        stateSave: true,


    });
</script>

</body>
</html>