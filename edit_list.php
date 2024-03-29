<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);
$cat = $_REQUEST['id'];
$sql = 'SELECT cat FROM lists WHERE id=?';
$args = [$cat];
$qw = select($sql, $args);
if ($qw['cat'] == 5) {
    header('Location: edit_list_posts.php?id=' . $cat);
    exit();
}

if (!empty($_REQUEST['key'])) {
    $key = addslashes($_REQUEST['key']);
    $array = explode("\r\n", $key);


    $batchSize = 4000;
    $batches = array_chunk($array, $batchSize);

    // Перебор и обработка каждого пакета данных
    foreach ($batches as $batch) {
        // Создание пустого массива для значений
        $values = [];

        // Формирование строки значений для пакетной вставки
        foreach ($batch as $data) {
            // Экранирование значений и добавление в массив
     //       $escapedData = escapeString($data);
            $values[] = $data;
        }


        $placeholders = implode(',', array_fill(0, count($values), '(?, ?)'));
        $val = [];
        foreach ($values as $dat) {
            $val[] = $dat;
            $val[] = $cat;
        }
        $sql = "INSERT INTO value_lists (value, list) VALUES $placeholders";
        $args = $val;
        insert($sql, $args);

    }


    header('Refresh: 0');
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
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap"
        rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="css/dt.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="css/style.css" rel="stylesheet">
    <title>FB Combo Edit list</title>
</head>
<body>
<?php
include_once 'inc/header.php';
//$cat = $_REQUEST['id'];
$sql = 'SELECT COUNT(*) FROM value_lists WHERE list = ?';
$args = [$cat];
$count = select($sql, $args);
$cc = $count['COUNT(*)'];

$sql = 'SELECT * FROM lists WHERE id = ?';
$args = [$cat];
$nn = select($sql, $args);
$n = $nn['name'];

$sql = 'SELECT * FROM value_lists WHERE list = ? LIMIT 1000';
$args = [$cat];
$ser = selectAll($sql, $args);

?>
<main class="container-fluid ">
    <div class="row text-center">
        <h2>Edit list <?php echo $n ?> </h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">


            <div class="alert alert-info" role="alert">
                <?php echo $txtedlist ?>

                <br>
            </div>
        </div>
    </div>

    <br>
    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <form method="post">
                <textarea class="form-control rounded-0" id="key" name="key" rows="10"></textarea>
                <br>
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
                <br>

                <br>

                <a class="btn btn-primary" href="del_all_val.php?id=<?php echo $cat ?>" role="button">DELETE ALL
                    VALUES</a>
                <br>
                <br>
                <a class="btn btn-info" href="export_list.php?id=<?php echo $cat ?>" role="button">

                    EXPORT LIST</a>


            </form>
            <br>
            Загрузить из файла
            <form method="POST" action="upload_val.php?id=<?php echo $cat ?>" enctype="multipart/form-data">
                <div>
                    <span>Upload a File:</span>
                    <input type="file" name="uploadedFile"/>
                </div>


                <br>
                <input type="submit" name="uploadBtn" value="Upload"/>
            </form>
        </div>
    </div>
    <br>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-6 text-center">

                <label for="example"><strong><?php echo $cc ?><?php echo $txtedlist2 ?> </strong> </label>
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
                            <td style="text-align: center;"><input type="checkbox" name="a[]"
                                                                   value="<?php echo $a['id'] ?>">
                            </td>
                            <td><?php echo $a['value'] ?></td>


                            <td>
                                <div class="col">
                                    <a href="del_val.php?id=<?php echo $a['id'] ?>" class="btn btn-danger"
                                       title="Delete value"
                                       onClick="return confirm( 'WARNING!!! DELETE VALUE?' )">Delete
                                        Value <i class="bi bi-x-circle-fill"></i></a>
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
            </div>
        </div>
        </form>
    </div>

    <br>
    <br>


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

        "lengthMenu": [[30, 100, 200, -1], [30, 100, 200, "All"]],
        stateSave: true,


    });
</script>
</body>
</html>
