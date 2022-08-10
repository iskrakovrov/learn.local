<?php
include_once ('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
if (!empty($_REQUEST['key'])){

        $array = explode("\r\n", $_REQUEST['key']);

        for ($i = 0; $i <= count($array); $i++)
            $c = (trim($array[$p]) . "<br/>");
        $c = preg_replace('/<br[^>]*>/', '', $c);
        $i = 0;
        foreach ($array as $key) {
            $i++;
            $res = parse_key($key);
            $sql = $res[0];

            if (!empty($sql)) {
                $ins = insert($sql);

            }


        }



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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="css/style.css" rel="stylesheet">
    <title>FB Combo Servers</title>
</head>
<body>
<?php
include_once 'inc/header.php';
$cat = $_REQUEST['cat'];
$sql = "SELECT * FROM value_lists WHERE list = $cat";
$ser=selectAll($sql);

?>
<main class="container-fluid ">
    <div class="row text-center">
        <h2>Edit </h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">


            <div class="alert alert-info" role="alert">
                <strong>Каждая запись с новой строки</strong><br>

                <br>
            </div>
        </div>
    </div>

    <br>
    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <form method="post">
    <textarea class="form-control rounded-0" id="key" name="key" rows="10"
              placeholder="Введите нужные записи"></textarea>
            <br>
            <br>
            <button type="submit"  class="btn btn-primary">Submit</button>
            <br>
            </form>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col text-center">
            <form>
                <a class="btn btn-secondary" href="add_server.php" role="button">Add server</a>
                <a class="btn btn-danger"  href="del_server.php" role="button">Delete servers</a>
        </div>
    </div>
    <div class="container-fluid">



        <table id="example" class="cell-border" style="width:100%">
            <thead>
            <tr>
                <th class="check" style="text-align: center;">
                    <input type="checkbox" id="all" value=""/>
                </th>
                <th>Value</th>

                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 0;
            foreach ($ser as $a) {
                $i++; ?>
                <tr>
                    <td style="text-align: center;"><input type="checkbox" name="a[]" value="<?php echo $a['id'] ?>">
                    </td>
                    <td><?php echo $a['value'] ?></td>


                    <td>
                        <div class="col">
                            <button type="button" class="btn btn-success">Edit server</button>

                            <a href="del_server.php?id=<?php echo $a['id'] ?>" class="btn btn-danger" title="Delete value" onClick="return confirm( 'WARNING!!! DELETE SERVER? Аккаунты привязанные к данному серверу будут свободными, пока вы не привяжете их к новому серверу' )">Delete Server <i class="bi bi-x-circle-fill"></i></a>
                        </div>
                    </td>
                </tr>
            <?php } ?>


            </tbody>
            <tfoot>
            <tr>
                <th></th>
                <th>Value</th>

                <th>Action</th>
            </tr>
            </tfoot>
        </table>
        </form>
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

        "lengthMenu": [[100, 300, 500, -1], [30, 100, 200, "All"]],
        stateSave: true,


    });
</script>
</body>
</html>
