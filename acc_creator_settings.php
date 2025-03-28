<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);

// Проверка выбора и перенаправление на соответствующую страницу
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $selectedValue = $_POST['mode'];

    if ($selectedValue == '1') {
        header('Location: account_creator_page.php');  // Переход на страницу "Account creator"
        exit;
    } elseif ($selectedValue == '2') {
        header('Location: fbcombo_page.php');  // Переход на страницу "FBCOMBO"
        exit;
    } else {
        $error = "Please select a valid mode.";
    }
}
?>

<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <!-- Required meta tags -->
    <?php
    require_once('inc/meta.php');
    ?>
    <title>FB Combo </title>
</head>
<body>
<?php
require_once 'inc/header.php';
?>

<main class="container-fluid">
    <div class="row text-center">
        <h2>Setting mobile mode.</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-3 text-center">
            <div class="alert alert-info" role="alert">
                Select FB combo mobile module mode
                <br>
            </div>

            <!-- Форма выбора -->
            <form method="POST">
                <!-- Dropdown 1 -->
                <div class="mb-3">
                    <label for="dropdown1" class="form-label">Mode</label>
                    <select class="form-select" id="dropdown1" name="mode" aria-label="Dropdown 1">
                        <option selected>Select mode</option>
                        <option value="1">Account creator</option>
                        <option value="2">FBCOMBO</option>
                    </select>
                </div>

                <!-- Кнопка выбора -->
                <button type="submit" class="btn btn-primary">Выбор</button>
            </form>

            <?php
            // Показать ошибку, если не выбран режим
            if (isset($error)) {
                echo '<div class="alert alert-danger mt-3" role="alert">' . $error . '</div>';
            }
            ?>

        </div>
    </div>
</main>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

</body>
</html>
