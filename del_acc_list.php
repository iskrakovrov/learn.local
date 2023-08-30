<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);


if (!empty($_REQUEST['key'])) {
    $key = addslashes($_REQUEST['key']);
    $array1 = explode("\r\n", $key);
$array = array_diff($array1, array(''));

    $batchSize = 500;
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




        $placeholders = implode(',', array_fill(0, count($values), '?'));
        $val = [];
        foreach ($values as $dat) {
            $val[] = $dat;

        }
        $sql = "DELETE FROM accounts WHERE login_fb IN ($placeholders)";

        $args = $val;
        delete($sql, $args);

    }


    header('Location: repair.php');
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
?>
<main class="container-fluid ">
    <div class="row text-center">
        <h2>Deleting accounts by login </h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">


            <div class="alert alert-info" role="alert">

                Enter a list of logins and click delete. These accounts will be removed from the database

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



            </form>

        </div>
    </div>






</main>


<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

</body>
</html>
