<?php
$taskFile = basename(__FILE__);
$setup = $_SESSION['setup'][$taskFile] ?? [];

function fv($name, $default = '') {
    global $setup;
    return htmlspecialchars($setup[$name] ?? $default);
}

$sql = 'SELECT * FROM lists WHERE cat = 11';
$qw = selectAll($sql);

$sql = 'SELECT * FROM lists WHERE cat = 5';
$qw1 = selectAll($sql);
?>

<main class="container-fluid">
    <div class="row text-center">
        <h2>Commenting</h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <div class="alert alert-info" role="alert">
                <?= $txtcomm1 ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">

                <form method="post" onsubmit="return Complete();">

                    <label for="url"><?= $txtcomm2 ?></label>
                    <select name="url" id="url" class="form-control">
                        <?php foreach ($qw as $a): ?>
                            <option value="<?= $a['id'] ?>" <?= fv('url') == $a['id'] ? 'selected' : '' ?>>
                                <?= $a['name'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <br>

                    <label for="coml"><?= $txtcomm3 ?></label>
                    <select name="coml" id="coml" class="form-control">
                        <?php foreach ($qw1 as $b): ?>
                            <option value="<?= $b['id'] ?>" <?= fv('coml') == $b['id'] ? 'selected' : '' ?>>
                                <?= $b['name'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <br>

                    <label for="num_cp"><?= $txtcomm4 ?></label>
                    <input type="number" name="num_cp" id="num_cp"
                           class="form-control"
                           value="<?= fv('num_cp', '1') ?>" required>
                    <br>

                    <label for="num_cd"><?= $txtcomm5 ?></label>
                    <input type="number" name="num_cd" id="num_cd"
                           class="form-control"
                           value="<?= fv('num_cd', '5') ?>" required>
                    <br>

                    <label for="pause"><?= $txtcomm6 ?></label>
                    <input type="text" name="pause" id="pause"
                           class="form-control"
                           value="<?= fv('pause', '3-5') ?>"
                           pattern="([0-9]{1,3})-([0-9]{1,3})" required>
                    <br>

                    <label for="like"><?= $txtcomm7 ?></label>
                    <select name="like" id="like" class="form-control">
                        <option value="1" <?= fv('like') == '1' ? 'selected' : '' ?>>Yes</option>
                        <option value="2" <?= fv('like') == '2' ? 'selected' : '' ?>>No</option>
                    </select>
                    <br>

                    <label for="f24"><?= $txtfarmi11 ?></label>
                    <input type="number" name="f24" id="f24"
                           class="form-control"
                           value="<?= fv('f24', '5') ?>" required>
                    <br><br>

                    <button class="btn btn-secondary" name="add_task" value="comm_public">
                        ✅ SAVE
                    </button>

                </form>

            </div>
        </div>
    </div>

</main>
