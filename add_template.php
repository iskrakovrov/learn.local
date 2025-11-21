<!doctype html>
<?php
session_start();
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$lang = $_SESSION['lang'] . '.php';
require_once($lang);

// ✅ Создание шаблона
if (isset($_POST['action']) && $_POST['action'] === 'add') {
    $nameTemplate = trim($_POST['nameTemplate'] ?? '');

    if ($nameTemplate === '') {
        $_SESSION['msg'] = ['type' => 'danger', 'text' => 'Template name cannot be empty!'];
    } else {
        // Проверка дубля
        $check = select('SELECT id FROM templates WHERE name = ?', [$nameTemplate]);
        if ($check) {
            $_SESSION['msg'] = ['type' => 'warning', 'text' => 'Template already exists!'];
        } else {
            $sql = 'INSERT INTO templates (name) VALUE (?)';
            $insertId = insert($sql, [$nameTemplate]);

            $_SESSION['msg'] = ['type' => 'success', 'text' => 'Template added! ✅'];

            header('Location: add_task.php?template_id=' . $insertId);
            exit;
        }
    }
}

// ✅ Массовое удаление
if (isset($_POST['action']) && $_POST['action'] === 'delete' && !empty($_POST['ids'])) {
    $in = implode(',', array_fill(0, count($_POST['ids']), '?'));
    $sql = "DELETE FROM templates WHERE id IN ($in)";
    delete($sql, $_POST['ids']);

    $_SESSION['msg'] = ['type' => 'success', 'text' => 'Selected templates deleted ✅'];
    header("Location: add_template.php");
    exit;
}

// ✅ Получаем список шаблонов
$qw = selectAll("SELECT t.id, t.name,
GROUP_CONCAT(DISTINCT tp.task ORDER BY tp.step_order SEPARATOR ', ') AS tasks
FROM templates t
LEFT JOIN template tp ON t.id = tp.id_template
GROUP BY t.id
ORDER BY t.id DESC");
?>
<html lang="en">
<head>
    <?php require_once('inc/meta.php'); ?>
    <title>FB Combo | Add template</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/dtjq.css"/>
</head>
<body>

<?php require_once 'inc/header.php'; ?>

<main class="container-fluid">

    <?php if (!empty($_SESSION['msg'])): ?>
        <div class="alert alert-<?= $_SESSION['msg']['type'] ?>">
            <?= $_SESSION['msg']['text'] ?>
        </div>
        <?php unset($_SESSION['msg']); ?>
    <?php endif; ?>

    <h2 class="text-center mb-3">Templates</h2>

    <div class="row justify-content-center">
        <div class="col-8">

            <form method="post" class="mb-4">
                <input type="hidden" name="action" value="add">
                <label for="nameTemplate" class="form-label">Name template</label>
                <input type="text" name="nameTemplate" id="nameTemplate" class="form-control" required>
                <button class="btn btn-secondary mt-3">Create template</button>
            </form>

            <form id="bulkForm" method="post">
                <input type="hidden" name="action" value="delete">
                <button type="submit" class="btn btn-danger mb-3">Delete selected</button>

                <table id="example" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th><input type="checkbox" id="all"></th>
                        <th>Name template</th>
                        <th>Tasks</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($qw as $b): ?>
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="<?= $b['id'] ?>"></td>

                            <!-- Editable name -->
                            <td contenteditable="true" class="editable" data-id="<?= $b['id'] ?>">
                                <?= htmlspecialchars($b['name']) ?>
                            </td>

                            <!-- ✅ Tasks list -->
                            <td class="text-primary">
                                <?= $b['tasks'] ? htmlspecialchars($b['tasks']) : '<span class="text-muted">No tasks</span>' ?>
                            </td>

                            <td>
                                <a href="add_task.php?template_id=<?= $b['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

            </form>
        </div>
    </div>
</main>


<script src="js/jquery.js"></script>
<script src="js/dtjquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // ✅ Выделить все
    $('#all').click(function () {
        $('tbody input[type="checkbox"]').prop('checked', this.checked);
    });

    // ✅ DataTables
    $('#example').DataTable({
        "pageLength": 30,
        stateSave: true
    });

    // ✅ AJAX редактирование имён
    $('.editable').blur(function () {
        let newText = $(this).text().trim();
        let id = $(this).data('id');

        $.post('edit_template.php', {id: id, name: newText}, function (res) {
            console.log(res);
        });
    });
</script>

</body>
</html>
