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
        <div class="col-12 col-md-8 text-center">  <!-- Центрируем колонку -->
            <div class="alert alert-info" role="alert">
                Setting up the account creator
                <br>
            </div>

            <!-- Форма выбора -->
            <form method="POST">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6 mb-3">
                        <label for="dropdown" class="form-label">Proxy group. Attention! Use SOCKS5 proxy.</label>
                        <select class="form-select" id="dropdown" name="mode" aria-label="Dropdown">
                            <option selected>Select option</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="dropdown" class="form-label">Server for accounts</label>
                        <select class="form-select" id="dropdown" name="mode" aria-label="Dropdown">
                            <option selected>Select option</option>
                            <option value="1">Server 1</option>
                            <option value="2">Server 2</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="dropdown" class="form-label">Group accounts</label>
                        <select class="form-select" id="dropdown" name="mode" aria-label="Dropdown">
                            <option selected>Select option</option>
                            <option value="1">Group accounts 1</option>
                            <option value="2">Group accounts 2</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="dropdown" class="form-label">Email</label>
                        <select class="form-select" id="dropdown" name="mode" aria-label="Dropdown">
                            <option value="0">No email</option>>
                            <option value="1">Email list 1</option>
                            <option value="2">Email list 2</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="dropdown" class="form-label">What do we use for registration?</label>
                        <select class="form-select" id="dropdown" name="mode" aria-label="Dropdown">
                            <option selected>Select option</option>
                            <option value="1">Phone</option>
                            <option value="2">Mail</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <label for="dropdown" class="form-label">After registering using a phone, should I link my email?</label>
                        <select class="form-select" id="dropdown" name="mode" aria-label="Dropdown">
                            <option selected>Select option</option>
                            <option value="1">No</option>
                            <option value="2">Yes</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <label for="dropdown" class="form-label">Gender of accounts?</label>
                        <select class="form-select" id="dropdown" name="mode" aria-label="Dropdown">
                            <option selected>Select option</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <label for="dropdown" class="form-label">Set an avatar for your account? Photos in folder Working folder/ava</label>
                        <select class="form-select" id="dropdown" name="mode" aria-label="Dropdown">
                            <option selected>Select option</option>
                            <option value="1">No</option>
                            <option value="2">Yes</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <label for="dropdown" class="form-label">Set the account's city of residence?</label>
                        <select class="form-select" id="dropdown" name="mode" aria-label="Dropdown">
                            <option selected>Select option</option>
                            <option value="1">No</option>
                            <option value="2">Geo list 1</option>
                            <option value="3">Geo list 2</option>
                            <option value="4">Geo list 3</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <label for="dropdown" class="form-label">First names</label>
                        <select class="form-select" id="dropdown" name="mode" aria-label="Dropdown">
                            <option selected>Select option</option>
                            <option value="1">Addition list 1</option>
                            <option value="2">Addition list 2</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <label for="dropdown" class="form-label">Last names</label>
                        <select class="form-select" id="dropdown" name="mode" aria-label="Dropdown">
                            <option selected>Select option</option>
                            <option value="1">Addition list 1</option>
                            <option value="2">Addition list 2</option>
                        </select>
                    </div>


                    <!-- Кнопка выбора -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Activate</button>
                    </div>
                </div>
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
