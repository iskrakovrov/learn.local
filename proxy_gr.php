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
    <title>FB Combo Proxies group</title>
</head>
<body>
<?php
include_once 'inc/header.php';
$sql = 'SELECT * FROM group_proxy';
$gr = selectAll($sql);

?>
<main class="container-fluid ">
    <div class="row text-center">
        <h2>Proxies Groups</h2>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col text-center">
                                <a class="btn btn-secondary" href="add_proxy_group.php" role="button">Add proxies
                                    group</a>

               <!--                 <a class="btn btn-danger" href="#" role="button">Delete group</a> -->
                            </div>
                        </div>

                        <div class="container-fluid">

                                        <table id="example" class="cell-border" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th class="check" style="text-align: center;">
                                                    <input type="checkbox" id="all" value=""/>
                                                </th>
                                                <th>Name proxies group</th>
                                                <th>Comments</th>
                                                <th>Count</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($gr as $a) {
                                                $i++; ?>
                                                <tr>
                                                    <td style="text-align: center;"><input type="checkbox" name="a[]"
                                                                                           value="<?php echo $a['id'] ?>">
                                                    </td>
                                                    <td><?php echo $a['name_group'] ?></td>
                                                    <td><?php echo $a['comment'] ?></td>
                                                    <?php
                                                    $idg = $a['id'];
                                                    $sql = 'SELECT COUNT(id) FROM accounts WHERE gpoup_proxy = ?';
                                                    $args = [$idg];
                                                    $qc = select($sql, $args);

                                                    ?>
                                                    <td><?php echo $qc['COUNT(id)'] ?></td>
                                                    <td>
                                                        <div class="col">

                                                            <a href="del_gr_pr.php?id=<?php echo $a['id'] ?>"
                                                               class="btn btn-danger"
                                                               title="Delete group"
                                                               onClick="return confirm( 'WARNING!!! DELETE Group? <?php $txtdelgroup ?>' )">Delete
                                                                group <i class="bi bi-x-circle-fill"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>


                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th></th>
                                                <th>Name proxies group</th>
                                                <th>Comment</th>
                                                <th>Count</th>
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

        "lengthMenu": [[30, 100, -1], [30, 100, "All"]],
        stateSave: true,


    });
</script>
</body>
</html>

