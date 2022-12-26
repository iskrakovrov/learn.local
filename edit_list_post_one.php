<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);
$cat = $_REQUEST['id'];


if (!empty($_REQUEST['key'])) {
    $key = addslashes($_REQUEST['key']);
    $folder = addslashes($_REQUEST['folder']);
    $array = explode("\r\n", $key);

    for ($i = 0, $iMax = count($array); $i <= $iMax; $i++) {
        $c = (trim($array[$p]) . "<br/>");
    }
    $c = preg_replace('/<br[^>]*>/', '', $c);
    $i = 0;
    foreach ($array as $key) {
        $i++;
        $res = parse_post($key,$folder);
        $sql = $res[0];

        if (!empty($sql)) {
            $ins = insert($sql);

        }


    }

    header("Refresh: 0");
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
    <title>FB Combo Edit post</title>
</head>
<body>
<?php
if (!empty($_REQUEST['text']) ||!empty($_FILES['myfile'])) {
    $myfile = $_FILES['myfile'];
    $size = $myfile['size'];

if($size > 100) {
        $path = 'upload/'; // директория для загрузки
        $ext = array_pop(explode('.', $_FILES['myfile']['name'])); // расширение
        $new_name = time() . '.' . $ext; // новое имя с расширением
        $full_path = $path . $new_name; // полный путь с новым именем и расширением

        if ($_FILES['myfile']['error'] == 0) {
            if (move_uploaded_file($_FILES['myfile']['tmp_name'], $full_path)) {
$img = $full_path;
                // Если фа$imйл успешно загружен, то вносим в БД (надеюсь, что вы знаете как)
                // Можно сохранить $full_path (полный путь) или просто имя файла - $new_name
            }
        }
    }
else {
    $img = 'NULL';
}
if (!empty($_REQUEST['text'])){
    $text = $_REQUEST['text'];
}
else {
    $text = 'NULL';
}
if (($text == 'NULL') && ($img == 'NULL')) {

    header("Refresh:0");
}
else {
    $sql = "INSERT INTO posts (id, cat, txt, img, tipe) VALUES (NULL, $cat, '$text', '$img', 2)";
    $qw = insert($sql);
    header("Refresh:0");
}
}
?>
<script>
    document.addEventListener('DOMContentLoaded', e => {
        let file = document.querySelector('#myfile'),        // Выбираем нужные
            preview = document.querySelector('#preview');  // элементы

        file.addEventListener('change', e => { // При изменении input
            if(file.files.length === 0) // Если ничего не выбрано - выходим
                return;

            let f = file.files[0],     // Берём первый файл
                fr = new FileReader(); // Создаём объект чтения файлов

            // В свойсте type mime (что-то типа image/png)
            if(f.type.indexOf('image') === -1) // Если файл не является изображением - выходим
                return;

            fr.onload = e => {
                if(getComputedStyle(preview, null).display === 'none') // Если нужно - показываем img
                    preview.style.display = 'block';

                preview.src = e.target.result; // В src будет что-то типа data:image/jpeg;base64,....
            }
            fr.readAsDataURL(f); // Читаем blob выбранного файла
        });
    });
</script>
<?php
include_once 'inc/header.php';
//$cat = $_REQUEST['id'];
$sql = "SELECT COUNT(*) FROM posts WHERE cat = $cat";
$count = select($sql);
$cc = $count['COUNT(*)'];
$sql = "SELECT * FROM lists WHERE id = $cat";
$nn = select($sql);
$n = $nn['name'];

$sql = "SELECT * FROM posts WHERE cat = $cat LIMIT 1000";
$ser = selectAll($sql);

?>
<main class="container-fluid ">
    <div class="row text-center">
        <h2>Edit list posts <?php echo $n ?> </h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">


            <div class="alert alert-info" role="alert">

                <?php echo $txtpost3 ?>
                <br>
                <a href="edit_list_posts.php?id=<?php echo $cat ?>"
                   class="btn btn-primary"><?php echo $txtpost2 ?></a>
            </div>
        </div>
    </div>

    <br>
    <div class="row justify-content-center">
        <div class="col-6 text-center">

                <form method="post" enctype="multipart/form-data">
                    <label for="text"><?php echo $txtpost5 ?></label>
                    <br>
                    <br>
                    <textarea name="text" id="text" class="form-control"></textarea>
                    <br>
                    <label for="myfile"><?php echo $txtpost6 ?></label>
                    <br>
                    <br>
                    <input type='file' id='myfile' name='myfile' /><br /><br />
                    <br>
                    <img src='' id='preview' width="150" height="150"   alt=""  onerror="this.onerror=null;this.src='images/none.png';">
                    <br>
                    <br>
                    <button class="btn btn-primary" type='submit'>ADD POST</button>
                </form>

        </div>
    </div>
    <br>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col text-center">

                <label for="example"><strong><?php echo $cc ?><?php echo $txtedlist2 ?> </strong> </label>
                <table id="example" class="cell-border" style="width:100%">
                    <thead>
                    <tr>
                        <th class="check" style="text-align: center;">
                            <input type="checkbox" id="all" value=""/>
                        </th>
                        <th>Text</th>
                        <th>Img</th>
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
                            <td><?php echo $a['txt'] ?></td>
                            <?php
                            if ($a['tipe'] == '1') {
                                if ($a['img'] == 'NULL'){
                                    $img = "images/none.png";
                                } else {
                                    $img = "images/folder.png";
                                }

                            }else {
                                if ($a['img'] == 'NULL'){
                                    $img = "images/none.png";
                                } else {
                                    $img = $a['img'];
                                }
           //                   $img = 'uploads/' . $a['img'];
                            }


                            ?>

                            <td><img src="<?php echo $img ?>"  width="150" height="150"></td>

                            <td>
                                <div class="col">


                                    <a href="del_post.php?id=<?php echo $a['id'] ?>" class="btn btn-danger"
                                       title="Delete value"
                                       onClick="return confirm( 'WARNING!!! DELETE POST?' )">Delete
                                        POST <i class="bi bi-x-circle-fill"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>


                    </tbody>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th>Text</th>
                        <th>Img</th>
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