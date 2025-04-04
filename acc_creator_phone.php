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
    <?php
    require_once('inc/meta.php');
    ?>
    <title>Mobile phones</title>
    <!-- Подключаем Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
require_once 'inc/header.php';
?>

<main class="container-fluid">
    <div class="row text-center">
        <h2 class="my-4">Setting up uniqueness of mobile devices</h2>
    </div>

    <div class="container">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                <tr>
                    <th>Brand</th>
                    <th>Product Line</th>
                    <th>Model Name</th>
                    <th>Codename</th>
                </tr>
                </thead>
                <tbody>
                <?php
                // Запросы для каждой таблицы устройств
                $brands = [
                    'Google' => ['table' => 'google_devices', 'has_codename' => true],
                    'Huawei' => ['table' => 'huawei_devices', 'has_codename' => true],
                    'OnePlus' => ['table' => 'oneplus_devices', 'has_codename' => true],
                    'Oppo' => ['table' => 'oppo_devices', 'has_codename' => true],
                    'Samsung' => ['table' => 'samsung_devices', 'has_codename' => false],
                    'Xiaomi' => ['table' => 'xiaomi_devices', 'has_codename' => true]
                ];

                foreach ($brands as $brand => $data) {
                    // Для Samsung используем model_group вместо product_line
                    $productLineField = ($brand === 'Samsung') ? 'model_group' : 'product_line';

                    // Формируем список полей для выборки
                    $fields = "$productLineField AS product_line, model_name";
                    if ($data['has_codename']) {
                        $fields .= ", codename";
                    } else {
                        $fields .= ", 'N/A' AS codename";
                    }

                    $sql = "SELECT $fields FROM {$data['table']}";
                    $stmt = $pdo->query($sql);

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($brand) . '</td>';
                        echo '<td>' . htmlspecialchars($row['product_line']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['model_name']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['codename']) . '</td>';
                        echo '</tr>';
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Подключаем Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>