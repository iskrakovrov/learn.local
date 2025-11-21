<?php
$taskFile = basename(__FILE__);
$setup = $_SESSION['setup'][$taskFile] ?? [];

function fv($name, $default = '') {
    global $setup;
    return htmlspecialchars($setup[$name] ?? $default);
}

function fsel($name, $value) {
    global $setup;
    return (isset($setup[$name]) && $setup[$name] == $value) ? 'selected' : '';
}

$qw = selectAll('SELECT * FROM lists WHERE cat = 5');
?>

<main class="container-fluid">
    <div class="row text-center">
        <h2>Happy birthday</h2>
    </div>

    <div class="col align-center">
        <div class="row justify-content-center">
            <div class="col-6 text-center">
                <div class="alert alert-info" role="alert">
                    <?= $txthappy ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-2 text-center">

            <form method="post" onsubmit="return Complete();">

                <label for="cat" class="control-label"><?= $txthappy1 ?></label>
                <select name="cat" id="cat" class="form-control">
                    <?php foreach ($qw as $a): ?>
                        <option value="<?= $a['id'] ?>" <?= fsel('cat', $a['id']) ?>>
                            <?= $a['name'] ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <br>

                <label for="none">Maximum number of congratulations per launch</label>
                <input type="number" name="none" id="none" class="form-control"
                       value="<?= fv('none', '15') ?>" required>

                <br>

                <label for="f24"><?= $txtfarmi11 ?></label>
                <input type="number" name="f24" id="f24" class="form-control"
                       value="<?= fv('f24', '1') ?>" required>

                <br><br>

                <button class="btn btn-secondary" name="add_task" value="happy">
                    ✅ SAVE
                </button>

            </form>

        </div>
    </div>
</main>
