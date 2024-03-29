<?php

include_once ('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
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
    <title>FB Combo Servers</title>
</head>
<body>
<?php
include_once 'inc/header.php';
$sql = 'SELECT * FROM group_acc';
$gr=selectAll($sql);

?>
<main class="container-fluid ">
    <div class="row text-center">
        <h2>Account Groups</h2>
    </div>
    <div class="row">
        <div class="col text-center">
            <a class="btn btn-secondary" href="add_group.php" role="button">Add group</a>

            <a class="btn btn-danger" href="#" role="button">Delete group</a>
        </div>
    </div>

    <div class="container-fluid">

        <table id="example" class="cell-border" style="width:100%">
            <thead>
            <tr>
                <th class="check" style="text-align: center;">
                    <input type="checkbox" id="all" value=""/>
                </th>
                <th>Name group</th>
                <th>Comments</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 0;
            foreach ($gr as $a) {
            $i++; ?>
            <tr>
                <td style="text-align: center;"><input type="checkbox" name="a[]" value="<?php echo $a['id_gr'] ?>">
                </td>
                <td><?php echo $a['name_group'] ?></td>
                <td><?php echo $a['comment'] ?></td>

                <td>
                    <div class="col">
                        <button type="button" class="btn btn-success">Good proxy</button>
                        <button type="button" class="btn btn-danger">Delete server</button>
                    </div>
                </td>
            </tr>
            <?php } ?>


            </tbody>
            <tfoot>
            <tr>
                <th></th>
                <th>Name group</th>
                <th>Comment</th>

                <th>Action</th>
            </tr>
            </tfoot>
        </table>

    </div>


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

        "lengthMenu": [[10, 30, 100, -1], [10, 30, 100, "All"]],
        stateSave: true,


    });
</script>
</body>
</html>