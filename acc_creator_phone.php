<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);

// Обработка нажатия кнопки
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_list'])) {
    try {
        // Удаление содержимого таблиц
        $tables = ['google_devices', 'huawei_devices', 'oppo_devices', 'oneplus_devices', 'samsung_devices', 'xiaomi_devices'];
        foreach ($tables as $table) {
            $pdo->exec("DROP TABLE IF EXISTS $table");
        }

        // Подключение файлов для пересоздания таблиц
        require 'phone/google.php';
        require 'phone/oppo.php';
        require 'phone/oneplus.php';
        require 'phone/huawei.php';
        require 'phone/samsung.php';
        require 'phone/xiaomi.php';

        $message = 'Phone list updated successfully!';
    } catch (PDOException $e) {
        $message = 'Error updating phone list: ' . $e->getMessage();
        error_log($message);
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <?php require_once('inc/meta.php'); ?>
    <title>Mobile phones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php require_once 'inc/header.php'; ?>

<main class="container-fluid">
    <div class="row text-center">
        <h2 class="my-4">Setting up uniqueness of mobile devices</h2>
        <form method="POST" class="d-flex justify-content-center mb-4">
            <button type="submit" name="update_list" class="btn btn-primary">Update Phone List</button>
        </form>

        <?php if (isset($message)): ?>
            <div class="alert alert-info">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>
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
                $brands = [
                    'Google' => ['table' => 'google_devices', 'has_codename' => true, 'product_line_field' => 'product_line'],
                    'Huawei' => ['table' => 'huawei_devices', 'has_codename' => true, 'product_line_field' => 'product_line'],
                    'OnePlus' => ['table' => 'oneplus_devices', 'has_codename' => true, 'product_line_field' => 'product_line'],
                    'Oppo' => ['table' => 'oppo_devices', 'has_codename' => true, 'product_line_field' => 'product_line'],
                    'Samsung' => ['table' => 'samsung_devices', 'has_codename' => true, 'product_line_field' => 'product_line'],
                    'Xiaomi' => ['table' => 'xiaomi_devices', 'has_codename' => true, 'product_line_field' => 'product_line']
                ];

                foreach ($brands as $brand => $data) {
                    $fields = "{$data['product_line_field']} AS product_line, model_name";
                    $fields .= $data['has_codename'] ? ", codename" : ", 'N/A' AS codename";

                    $sql = "SELECT $fields FROM {$data['table']}";

                    try {
                        // Проверка существования таблицы
                        $tableCheck = $pdo->query("SHOW TABLES LIKE '{$data['table']}'")->rowCount();
                        if (!$tableCheck) {
                            echo '<tr><td colspan="4" class="text-danger">Table ' . htmlspecialchars($data['table']) . ' does not exist for ' . htmlspecialchars($brand) . '</td></tr>';
                            error_log("Table {$data['table']} does not exist for {$brand}.");
                            continue;
                        }

                        // Проверка существования колонок
                        $columnCheck = $pdo->query("SHOW COLUMNS FROM {$data['table']} LIKE '{$data['product_line_field']}'")->rowCount();
                        if (!$columnCheck) {
                            echo '<tr><td colspan="4" class="text-danger">Column ' . htmlspecialchars($data['product_line_field']) . ' not found in table ' . htmlspecialchars($data['table']) . '</td></tr>';
                            error_log("Column {$data['product_line_field']} not found in table {$data['table']}");
                            continue;
                        }

                        $stmt = $pdo->query($sql);
                        if ($stmt->rowCount() === 0) {
                            echo '<tr><td colspan="4" class="text-warning">No data found for ' . htmlspecialchars($brand) . '</td></tr>';
                            error_log("No data found for table {$data['table']}.");
                            continue;
                        }

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($brand) . '</td>';
                            echo '<td>' . htmlspecialchars($row['product_line']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['model_name']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['codename']) . '</td>';
                            echo '</tr>';
                        }
                    } catch (PDOException $e) {
                        echo '<tr><td colspan="4" class="text-danger">Error loading data for ' . htmlspecialchars($brand) . ': ' . htmlspecialchars($e->getMessage()) . '</td></tr>';
                        error_log("SQL Error for {$brand}: " . $e->getMessage() . " | Query: " . $sql);
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>