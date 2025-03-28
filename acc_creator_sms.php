<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

// Включаем отображение ошибок для отладки
error_reporting(E_ALL);
ini_set('display_errors', 1);

$lang = $_SESSION['lang'] . '.php';
require_once($lang);

// Обработка добавления нового сервиса
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sms_name'])) {
    $data = [
        'service' => trim($_POST['sms_name']),
        'domain' => trim($_POST['sms_domain']),
        'apikey' => trim($_POST['api_key']),
        'type' => (int)$_POST['service_type']
    ];

    try {
        $stmt = $pdo->prepare("INSERT INTO `smsService` (`service`, `domain`, `apikey`, `type`) VALUES (:service, :domain, :apikey, :type)");
        $result = $stmt->execute($data);

        if ($result) {
            $_SESSION['message'] = 'Service added successfully';
            header('Location: '.$_SERVER['PHP_SELF']);
            exit;
        }
    } catch (PDOException $e) {
        $error = 'Database error: '.$e->getMessage();
    }
}

// Обработка удаления сервиса
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    try {
        $stmt = $pdo->prepare("DELETE FROM `smsService` WHERE `id` = ?");
        $result = $stmt->execute([$id]);

        if ($result) {
            $_SESSION['message'] = 'Service deleted successfully';
            header('Location: '.$_SERVER['PHP_SELF']);
            exit;
        }
    } catch (PDOException $e) {
        $error = 'Database error: '.$e->getMessage();
    }
}

// Обработка обновления сервиса
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $id = (int)$_POST['edit_id'];
    $data = [
        'service' => trim($_POST['edit_name']),
        'domain' => trim($_POST['edit_domain']),
        'apikey' => trim($_POST['edit_api_key']),
        'type' => (int)$_POST['edit_service_type'],
        'id' => $id
    ];

    try {
        $stmt = $pdo->prepare("UPDATE `smsService` SET `service` = :service, `domain` = :domain, `apikey` = :apikey, `type` = :type WHERE `id` = :id");
        $result = $stmt->execute($data);

        if ($result) {
            $_SESSION['message'] = 'Service updated successfully';
            header('Location: '.$_SERVER['PHP_SELF']);
            exit;
        }
    } catch (PDOException $e) {
        $error = 'Database error: '.$e->getMessage();
    }
}

// Получаем все сервисы из базы
try {
    $stmt = $pdo->query("SELECT * FROM `smsService` ORDER BY `service`");
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = 'Failed to load services: '.$e->getMessage();
    $services = [];
}

// Получаем данные для редактирования (если передан ID)
$editData = [];
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    try {
        $stmt = $pdo->prepare("SELECT * FROM `smsService` WHERE `id` = ?");
        $stmt->execute([$id]);
        $editData = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $error = 'Failed to load service: '.$e->getMessage();
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <?php require_once('inc/meta.php'); ?>
    <title>SMS Services Management</title>
    <style>
        .api-key {
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        /* Стиль для формы редактирования */
        .edit-form {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: <?= !empty($editData) ? 'block' : 'none' ?>;
        }
    </style>
</head>
<body>
<?php require_once('inc/header.php'); ?>

<main class="container mt-4">
    <h2 class="text-center mb-4">Manage SMS Services</h2>
    <div class="row justify-content-center">
        <div class="col-6 text-center">


            <div class="alert alert-info" role="alert">
               КАК ДОБАВЛЯТЬ СЕРВИСЫ
            </div>
        </div>
    </div>


    <!-- Вывод сообщений -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['message']) ?></div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <!-- Форма редактирования (показывается только при редактировании) -->
    <div class="edit-form">
        <h3>Edit Service</h3>
        <form method="post">
            <input type="hidden" name="edit_id" value="<?= $editData['id'] ?? '' ?>">
            <div class="mb-3">
                <label class="form-label">Service Name</label>
                <input type="text" name="edit_name" class="form-control"
                       value="<?= htmlspecialchars($editData['service'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Domain</label>
                <input type="text" name="edit_domain" class="form-control"
                       value="<?= htmlspecialchars($editData['domain'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">API Key</label>
                <input type="text" name="edit_api_key" class="form-control"
                       value="<?= htmlspecialchars($editData['apikey'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Service Type</label>
                <input type="number" name="edit_service_type" class="form-control"
                       value="<?= htmlspecialchars($editData['type'] ?? '0') ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="?" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <!-- Форма добавления -->
    <form method="post" class="mb-5">
        <h3>Add New Service</h3>
        <div class="mb-3">
            <label class="form-label">SMS Service Name</label>
            <input type="text" name="sms_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Domain</label>
            <input type="text" name="sms_domain" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">API Key</label>
            <input type="text" name="api_key" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Service Type</label>
            <input type="number" name="service_type" class="form-control" value="0" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Service</button>
    </form>

    <!-- Таблица сервисов -->
    <?php if (!empty($services)): ?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Domain</th>
                <th>API Key</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($services as $service): ?>
                <tr>
                    <td><?= htmlspecialchars($service['id']) ?></td>
                    <td><?= htmlspecialchars($service['service']) ?></td>
                    <td><?= htmlspecialchars($service['domain']) ?></td>
                    <td class="api-key"><?= htmlspecialchars($service['apikey']) ?></td>
                    <td><?= htmlspecialchars($service['type'] ?? '0') ?></td>
                    <td>
                        <a href="?edit=<?= $service['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="?delete=<?= $service['id'] ?>" class="btn btn-sm btn-danger"
                           onclick="return confirm('Delete this service?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">No SMS services found</div>
    <?php endif; ?>
</main>
</body>
</html>