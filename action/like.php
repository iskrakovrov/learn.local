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

$qw = selectAll('SELECT * FROM lists WHERE cat = 11');
?>

<main class="container-fluid">
    <div class="row text-center">
        <h2>Likes</h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <div class="alert alert-info" role="alert">
                <?= $txtlike ?>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-2 text-center">

            <form method="post" onsubmit="return Complete();">

                <label for="cat"><?= $txtlike1 ?></label>
                <select name="cat" id="cat" class="form-control">
                    <?php foreach ($qw as $a): ?>
                        <option value="<?= $a['id'] ?>" <?= fsel('cat', $a['id']) ?>>
                            <?= $a['name'] ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <br>

                <label for="num_l"><?= $txtlike2 ?></label>
                <input type="text" name="num_l" id="num_l" class="form-control"
                       value="<?= fv('num_l', '5') ?>" required>

                <br>

                <label for="pause"><?= $txtnewacc5 ?></label>
                <input type="text" name="pause" id="pause" class="form-control"
                       value="<?= fv('pause', '5-10') ?>"
                       pattern="([0-9]{1,3})-([0-9]{1,3})" required>

                <br>

                <label for="f24"><?= $txtfarmi11 ?></label>
                <input type="number" name="f24" id="f24" class="form-control"
                       value="<?= fv('f24', 3) ?>" required>

                <br><br>

                <button class="btn btn-secondary" name="add_task" value="like">
                    ✅ SAVE
                </button>

            </form>

        </div>
    </div>
</main>
