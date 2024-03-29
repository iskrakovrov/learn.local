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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <title>FB Combo</title>
</head>
<body>
<?php
include_once 'inc/header.php';

$sql = 'SELECT * FROM proxy';
$pr = selectAll($sql);
$sql = 'SELECT * FROM group_proxy';
$pg = selectall($sql);


?>
<main class="container-fluid ">
    <div class="row text-center">
        <h2>Proxy</h2>
    </div>
    <form method="post" action="proxy_action.php">
    <div class="row">

        <div class="col text-center">


            <a class="btn btn-secondary" href="add_multi_proxy.php" role="button">Add proxy</a>

            <a class="btn btn-secondary" href="all_no_work_proxy.php" role="button">Multy FREE proxy</a>
            <a class="btn btn-success" href="chk_proxy.php" role="button">Check ALL proxy</a>

                <button type="submit" class="btn btn-danger" id="del" name="del" value="del_pr.php" title="Delete proxy"
                        onClick="return confirm( 'WARNING!!! DELETE PROXY? ' )">Delete Proxy <i
                        class="bi bi-x-circle-fill"></i></button>


        </div>
    </div>
    <br>
    <br>

    <div class="container-fluid">


        <div class="input-group">
            <label for="pa"></label>


            <select name="pa" id="pa" class="custom-select">
                <option value="" selected>[<?php echo $txtmenu ?>]</option>
                <?php foreach ($pg as $g) { ?>
                    <option
                        value="go_group_p.php?gr=<?php echo $g['id'] ?>"><?php echo 'Proxy add to group ' . $g['name_group'] ?></option>

                <?php } ?>


                <option value="" disabled="disabled">----------</option>

                <option value="del_pr.php">Delete</option>
            </select>


            <div class="input-group-append">
                <button class="btn btn-primary" name="submit1" value="1" type="submit">&raquo;</button>
            </div>

        </div>
        <br>
        <br>
        <table id="example" class="cell-border" style="width:100%">
            <thead>
            <tr>
                <th class="check" style="text-align: center;">
                    <input type="checkbox" id="all" value=""/>
                </th>
                <th>Protocol</th>
                <th>Proxy</th>
                <th>Link</th>
                <th>USE</th>
                <th>Status</th>
                <th>Group</th>
                <th>Comment</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 0;
            foreach ($pr as $a) {
                $i++; ?>
                <tr>
                    <td style="text-align: center;"><input type="checkbox" name="a[]"
                                                           value="<?php echo $a['id'] ?>">
                    </td>
                    <td><?php echo $a['protocol'] ?></td>
                    <td><?php echo $a['proxy'] ?></td>
                    <td><?php echo $a['link_proxy'] ?></td>

                    <td><?php echo $a['use_proxy'] ?></td>
                    <td><?php echo $a['status'] ?></td>
                    <?php
                    if (empty($a['group_proxy'])) {
                        $prt = 'FREE';
                    } else {
                        $argc = $a['group_proxy'];
                        $sql = "SELECT * FROM group_proxy WHERE id = $argc";
                        $pgt = select($sql);
                        $prt = $pgt['name_group'];
                    }

                    ?>
                    <td><?php echo $prt ?></td>
                    <td><?php echo $a['comment'] ?></td>
                    <td>
                        <div class="col">
                            <a href="chk_proxy.php?id=<?php echo $a['id'] ?>" class="btn btn-success"
                            >Check Proxy<i class="bi bi-x-circle-fill"></i></a>
                            <a href="f_proxy.php?id=<?php echo $a['id'] ?>" class="btn btn-secondary">FREE Proxy</a>

                            <a href="del_proxy.php?id=<?php echo $a['id'] ?>" class="btn btn-danger"
                               title="Delete proxy" onClick="return confirm( 'WARNING!!! DELETE PROXY? ' )">Delete
                                Proxy
                                <i class="bi bi-x-circle-fill"></i></a>
                        </div>
                    </td>
                </tr>
            <?php } ?>


            </tbody>
            <tfoot>
            <tr>
                <th></th>
                <th>Protocol</th>
                <th>Proxy</th>
                <th>Link</th>
                <th>USE</th>
                <th>Status</th>
                <th>Group</th>
                <th>Comment</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>

        </form>

</main>


<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script src="js/jquery.js"></script>
<script src="js/dtjquery.js"></script>


<script src="js/dataTables.bootstrap.js"></script>
<script type="text/javascript" charset="utf-8" src="js/ColumnFilterWidgets.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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

        "lengthMenu": [[30, 100, 200, -1], [30, 100, 200, "All"]],


    });
</script>
</body>
</html>