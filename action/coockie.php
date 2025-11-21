<?php
$taskFile = basename(__FILE__);
$setup = $_SESSION['setup'][$taskFile] ?? [];

function fv($name, $default = '') {
    global $setup;
    return htmlspecialchars($setup[$name] ?? $default);
}

$sql = 'SELECT * FROM lists WHERE cat = 8 OR cat = 9';
$qw = selectAll($sql);
?>

<main class="container-fluid">
    <div class="row text-center">
        <h2>Farm cookies</h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <div class="alert alert-info" role="alert">
                <?= $txtcook ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">

                <form method="post" onsubmit="return Complete();">

                    <label for="cat" class="control-label"><?= $txtcook3 ?></label>
                    <select name="cat" id="cat" class="form-control">
                        <?php foreach ($qw as $a): ?>
                            <option value="<?= $a['id'] ?>" <?= fv('cat') == $a['id'] ? 'selected' : '' ?>>
                                <?= $a['name'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>

                    <br>

                    <label for="num_s"><?= $txtcook2 ?></label>
                    <input type="text" name="num_s" id="num_s"
                           class="form-control"
                           pattern="([0-9]{1,3})-([0-9]{1,3})"
                           value="<?= fv('num_s', '2-4') ?>" required>

                    <br><br>

                    <button class="btn btn-secondary" name="add_task" value="coockie">
                        ✅ SAVE
                    </button>

                </form>

            </div>
        </div>
    </div>
</main>
