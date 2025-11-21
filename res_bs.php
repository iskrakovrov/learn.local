<?php
session_start();
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

// Проверка подключения к БД
if (!isset($pdo)) {
    die("Database connection failed");
}

$lang = $_SESSION['lang'] . '.php';
require_once($lang);

// Обработка очистки всех записей Bluestacks
if (isset($_POST['free_bluestacks'])) {
    try {
        $sql = "DELETE FROM `vm_work`";
        $q = create($sql);
        $_SESSION['success_message'] = "All emulator instances have been cleared from the work queue!";
        header("Location: " . htmlspecialchars($_SERVER['PHP_SELF']));
        exit();
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Error clearing emulator instances: " . $e->getMessage();
        header("Location: " . htmlspecialchars($_SERVER['PHP_SELF']));
        exit();
    }
}

// Обработка удаления одной записи
if (isset($_POST['free_single'])) {
    try {
        $id = (int)$_POST['id'];
        $sql = "DELETE FROM `vm_work` WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $_SESSION['success_message'] = "Emulator instance #$id has been freed!";
        header("Location: " . htmlspecialchars($_SERVER['PHP_SELF']));
        exit();
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Error freeing emulator instance: " . $e->getMessage();
        header("Location: " . htmlspecialchars($_SERVER['PHP_SELF']));
        exit();
    }
}

// Получение текущих записей в очереди
$vm_work_items = [];
try {
    $sql = "SELECT id, name_vm FROM `vm_work`";
    if (function_exists('selectAll')) {
        $vm_work_items = selectAll($sql);
    }
} catch (PDOException $e) {
    $_SESSION['error_message'] = "Error fetching work queue: " . $e->getMessage();
}

// Получаем сообщения из сессии
$success_message = $_SESSION['success_message'] ?? null;
$error_message = $_SESSION['error_message'] ?? null;

// Очищаем сообщения из сессии после их получения
unset($_SESSION['success_message']);
unset($_SESSION['error_message']);
?>
<!doctype html>
<html lang="en">
<head>
    <?php require_once('inc/meta.php'); ?>
    <title>Bluestacks Manager</title>
    <style>
        .action-card {
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .requirement-card {
            background: #f8f9fa;
            border-left: 4px solid #007bff;
        }
        .requirement-item {
            padding: 10px 15px;
            border-bottom: 1px solid #dee2e6;
        }
        .requirement-item:last-child {
            border-bottom: none;
        }
        .slider-container {
            padding: 15px;
            background: #e9ecef;
            border-radius: 5px;
        }
        .table-responsive {
            margin-top: 20px;
        }
        .download-section {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background: #f8f9fa;
        }
        .download-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<?php require_once('inc/header.php'); ?>

<main class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Уведомления -->
            <?php if (isset($success_message)): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <?= htmlspecialchars($success_message) ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <?= htmlspecialchars($error_message) ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <!-- Основные инструменты -->
            <div class="card action-card">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0"><i class="fas fa-tools mr-2"></i>Emulators Tools</h3>
                </div>
                <div class="card-body">
                    <!-- 1. Download DLL Libraries -->
                    <div class="download-section">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-2"><i class="fas fa-file-archive mr-2"></i>Additional DLL Libraries</h4>
                                <p class="mb-0">Required for proper Emulators functioning</p>
                            </div>
                            <a href="https://soft.fbcombo.com/dll.zip" class="btn btn-success">
                                <i class="fas fa-download mr-2"></i> Download
                            </a>
                        </div>
                    </div>

                    <!-- 2. Download Bluestacks -->
                    <div class="download-section">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-2"><i class="fas fa-download mr-2"></i>Emulator Installer</h4>
                                <p class="mb-0">Custom configured version of emulator</p>
                            </div>
                            <a href="https://soft.fbcombo.com/reg.zip" class="btn btn-primary">
                                <i class="fas fa-download mr-2"></i> Download
                            </a>
                        </div>
                    </div>

                    <!-- 3. Clear All Bluestacks Instances -->
                    <div class="download-section">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-2"><i class="fas fa-trash-alt mr-2"></i>Clear Work Queue</h4>
                                <p class="mb-0">Remove all instances from the work queue</p>
                                <small class="text-muted">Executes: DELETE FROM `vm_work`</small>
                            </div>
                            <form method="POST" onsubmit="return confirm('WARNING: This will delete ALL records from the work queue. Continue?');">
                                <button type="submit" name="free_bluestacks" class="btn btn-danger">
                                    <i class="fas fa-trash-alt mr-2"></i> Clear All
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Таблица с записями vm_work -->
                    <div class="table-responsive mt-4">
                        <h4><i class="fas fa-list mr-2"></i>Current Work Queue</h4>
                        <?php if (!empty($vm_work_items)): ?>
                            <table class="table table-striped table-bordered">
                                <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Instance Info</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($vm_work_items as $item): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item['id']) ?></td>
                                        <td><?= htmlspecialchars($item['name_vm'] ?? 'N/A') ?></td>
                                        <td>
                                            <span class="badge badge-warning">Busy</span>
                                        </td>
                                        <td>
                                            <form method="POST" onsubmit="return confirm('Are you sure you want to free this instance?');">
                                                <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']) ?>">
                                                <button type="submit" name="free_single" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash-alt mr-1"></i> Free
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle mr-2"></i> The work queue is currently empty.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once('inc/footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script src="js/jquery.js"></script>
<script src="js/dtjquery.js"></script>
</body>
</html>