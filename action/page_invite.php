<?php
$taskFile = basename(__FILE__);
$setup = $_SESSION['setup'][$taskFile] ?? [];

// Helpers
function fv($name, $default = '') {
    global $setup;
    return htmlspecialchars($setup[$name] ?? $default);
}
function fsel($name, $value) {
    global $setup;
    return (isset($setup[$name]) && $setup[$name] == $value) ? 'selected' : '';
}

$qw = selectAll('SELECT * FROM lists WHERE cat = 11');
?>

<main class="container-fluid">
    <div class="row text-center">
        <h2><?= $txtipage ?></h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <div class="alert alert-info" role="alert">
                <?= $txtipage1 ?>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-2 text-center">

            <form method="post" onsubmit="return Complete();">

                <label for="cat"><?= $txtipage2 ?></label>
                <select name="cat" id="cat" class="form-control">
                    <?php foreach ($qw as $a): ?>
                        <option value="<?= $a['id'] ?>" <?= fsel('cat', $a['id']) ?>>
                            <?= htmlspecialchars($a['name']) ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <br>

                <label for="inv">Invite type</label>
                <select name="inv" id="inv" class="form-control">
                    <option value="0" <?= fsel('inv', '0') ?>>40 invites at a time</option>
                    <option value="1" <?= fsel('inv', '1') ?>>All</option>
                </select>

                <br>

                <label for="n_inv">How many times if the mode is 40 invites</label>
                <input type="number" name="n_inv" id="n_inv" class="form-control"
                       value="<?= fv('n_inv', 2) ?>">

                <br>

                <label for="f24"><?= $txtfarmi11 ?></label>
                <input type="number" name="f24" id="f24" class="form-control"
                       value="<?= fv('f24', 3) ?>" required>

                <br><br>

                <button class="btn btn-secondary" name="add_task" value="page_invite">
                    ✅ SAVE
                </button>

            </form>

        </div>
    </div>
</main>
