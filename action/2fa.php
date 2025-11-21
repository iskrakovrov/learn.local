<?php
// Имя текущего файла задачи
$taskFile = basename(__FILE__);

// Загружаем ранее сохраненные настройки (если редактируем шаблон)
$setup = $_SESSION['setup'][$taskFile] ?? [];

// Универсальная функция предзаполнения полей
function fv($name, $default = '') {
    global $setup;
    return htmlspecialchars($setup[$name] ?? $default);
}
?>

<main class="container-fluid">
    <div class="row text-center">
        <h2>ADD 2FA</h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <div class="alert alert-info" role="alert">
                <?= $txttasks5 ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onsubmit="return Complete();">

                    <label for="fa_select"><?= $txttasks6 ?></label>
                    <select class="form-select" id="fa_select" name="2fa" aria-label="2fa">
                        <option value="yes" <?= fv('2fa') == 'yes' ? 'selected' : '' ?>>Yes</option>
                        <option value="no"  <?= fv('2fa') == 'no'  ? 'selected' : '' ?>>No</option>
                    </select>

                    <br><br>

                    <button class="btn btn-secondary" name="add_task" id="add_task" value="2fa">
                        ✅ SAVE
                    </button>

                </form>
            </div>
        </div>
    </div>
</main>
