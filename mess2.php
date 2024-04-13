<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);

$server = $_POST['server'];
$ser = [$server];
$sql = 'SELECT mess.*
FROM mess
JOIN accounts ON mess.id_acc = accounts.id
WHERE accounts.server = ?
ORDER BY mess.id_acc, mess.data_mess;';
$qw = selectAll($sql,$ser);

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="css/style.css" rel="stylesheet">
    <title>FB Combo Servers</title>

</head>
<body>
<?php
include_once 'inc/header.php';
?>
<main class="container-fluid ">
    <div class="row text-center">
        <h2>Messages</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">


            <div class="alert alert-info" role="alert">
                <?php echo $txtserver ?>
            </div>
        </div>
    </div>
    <table id="example" class="cell-border" style="width:100%">
        <thead>
        <tr>
            <th class="check" style="text-align: center;">
                <input type="checkbox" id="all" value=""/>
            </th>
            <th>Account</th>
            <th>Data</th>
            <th>Name</th>
            <th>Message</th>
            <th>Answer</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i = 0;
        foreach ($qw as $a) {
            $i++; ?>
            <tr>
                <td style="text-align: center;"><input type="checkbox" name="a[]"
                                                       value="<?php echo $a['id'] ?>">
                </td>
                <td><?php echo $a['id_acc'] ?></td>
                <td><?php echo date('d.m.Y', $a['data_mess']); ?></td>
                <td><?php echo $a['name'] ?></td>
                <td><?php echo $a['text_mess'] ?></td>
                <td> <input type="text" class="form-control" id="answer" name="an[]" value=" <?php echo $a['answer'] ?>"></td>


                <td>
                    <div class="col">
                        <button type="button" class="btn btn-success">Save answer</button>

                        <a href="del_server.php?id=<?php echo $a['id'] ?>" class="btn btn-danger"
                           title="Delete Server"
                           onClick="return confirm( 'WARNING!!! DELETE SERVER? <?php echo $txtserver1 ?>' )">Delete
                            Server <i class="bi bi-x-circle-fill"></i></a>
                    </div>
                </td>
            </tr>
        <?php } ?>


        </tbody>
        <tfoot>
        <tr>
            <th></th>
            <th>Account</th>
            <th>Data</th>
            <th>Name</th>
            <th>Message</th>
            <th>Answer</th>
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
        columnDefs: [{ width: 400, targets: 4 },
        { width: 400, targets: 5 }],
        fixedColumns: true,

        "lengthMenu": [[100, 300, 500, -1], [30, 100, 200, "All"]],
        stateSave: true,


    });
</script>
</body>
</html>
