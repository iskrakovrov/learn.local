<!doctype html>
<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);
$sql = 'SELECT * FROM templates';
$qw = selectAll($sql);

?>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
   <?php
   require_once ('inc/meta.php');
   ?>
    <title>FB Combo | Add task</title>
</head>
<body>
<?php

$ids = array('t');
$i = 0;
$nameTemplate = $_POST['nameTemplate'];
if (!empty($nameTemplate)) {
    $sql = 'INSERT INTO templates (name) VALUE (?)';
    $args = [$nameTemplate];
    $qwe = insert($sql, $args);
    $sql = 'SELECT LAST_INSERT_ID()';
    $qwert = select($sql);
    $numberTemplate = $qwert['LAST_INSERT_ID()'];
    session_start();
    $_SESSION['ids'] = $ids;
    $_SESSION['numberTemplate'] = $numberTemplate;
    header('Location: add_task.php');
}
require_once 'inc/header.php';
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
                <label for="nameTemplate">Name template</label>
                <input type="text" name="nameTemplate" id="nameTemplate" class="form-control"  required>
                <br>


                <br>
                <button class="btn btn-secondary">Create template
                </button>
            </form>
<br>

            <table id="example" class="cell-border" style="width:100%">
                <thead>
                <tr>
                    <th class="check" style="text-align: center;">
                        <input type="checkbox" id="all" value=""/>
                    </th>
                    <th>Name template</th>

                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                foreach ($qw as $b) {
                    $i++; ?>
                    <tr>
                        <td style="text-align: center;"><input type="checkbox" name="a[]"
                                                               value="<?php echo $b['id'] ?>">
                        </td>
                        <td><?php $nam = $b['name'];
                        echo $nam ?></td>


                        <td>
                            <div class="col">


                                <a href="del_template.php?id=<?php echo $b['id'] ?>" class="btn btn-danger"
                                   title="Delete Server"
                                   onClick="return confirm( 'WARNING!!! DELETE Template? ' )">Delete
                                    Template <i class="bi bi-x-circle-fill"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>


                </tbody>
                <tfoot>
                <tr>
                    <th></th>
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