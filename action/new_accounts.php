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
    return (!empty($setup[$name]) && $setup[$name] == $value) ? 'selected' : '';
}

$qw   = selectAll('SELECT * FROM lists WHERE cat = 4 OR cat = 9');
$geol = selectAll('SELECT * FROM lists WHERE cat = 2 OR cat = 9');
?>

<main class="container-fluid">
    <div class="row text-center">
        <h2><?= $txtnewacc ?></h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <div class="alert alert-info" role="alert">
                <?= $txtnewacc1 ?>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-2 text-center">

            <form method="post" onsubmit="return Complete();">

                <label for="listid"><?= $txtnewacc2 ?></label>
                <select name="listid" id="listid" class="form-control">
                    <?php foreach ($qw as $a): ?>
                        <option value="<?= $a['id'] ?>" <?= fsel('listid', $a['id']) ?>>
                            <?= $a['name'] ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <br>

                <label for="geo"><?= $txtnewacc3 ?></label>
                <select name="geo" id="geo" class="form-control">
                    <?php foreach ($geol as $a): ?>
                        <option value="<?= $a['id'] ?>" <?= fsel('geo', $a['id']) ?>>
                            <?= $a['name'] ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <br>

                <label for="num_i"><?= $txtnewacc4 ?></label>
                <input type="number" name="num_i" id="num_i" class="form-control"
                       value="<?= fv('num_i', 5) ?>" required>

                <br>

                <label for="pause"><?= $txtnewacc5 ?></label>
                <input type="text" name="pause" id="pause" class="form-control"
                       value="<?= fv('pause', '5-10') ?>"
                       pattern="([0-9]{1,3})-([0-9]{1,3})" required>

                <br>

                <label for="confirm">Confirm or Cancel</label>
                <select name="confirm" id="confirm" class="form-select">
                    <option value="1" <?= fsel('confirm', '1') ?>>Confirm</option>
                    <option value="2" <?= fsel('confirm', '2') ?>>Cancel</option>
                </select>

                <br>

                <label for="num_co"><?= $txtnewacc6 ?></label>
                <input type="number" name="num_co" id="num_co" class="form-control"
                       value="<?= fv('num_co', 5) ?>" required>

                <br>

                <label for="f24"><?= $txtfarmi11 ?></label>
                <input type="number" name="f24" id="f24" class="form-control"
                       value="<?= fv('f24', 3) ?>" required>

                <br><br>

                <button class="btn btn-secondary" name="add_task" value="new_accounts">
                    ✅ SAVE
                </button>

            </form>

        </div>
    </div>
</main>
