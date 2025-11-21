<?php
$taskFile = basename(__FILE__);
$setup = $_SESSION['setup'][$taskFile] ?? [];

function fv($name, $default = '') {
    global $setup;
    return htmlspecialchars($setup[$name] ?? $default);
}

function fch($name) {
    global $setup;
    return isset($setup[$name]) && $setup[$name] != '' ? 'checked' : '';
}

$sql = 'SELECT * FROM lists WHERE cat = 7 OR cat = 9';
$qw = selectAll($sql);

$sql = 'SELECT * FROM lists WHERE cat = 10';
$qw1 = selectAll($sql);
?>

<main class="container-fluid">
    <div class="row text-center">
        <h2><?= $txtfarmi0 ?></h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <div class="alert alert-info" role="alert">
                <?= $txtfarmi1 ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">

                <form method="post" onsubmit="return Complete();">

                    <label for="cat"><?= $txtfarmi2 ?></label>
                    <select name="cat" id="cat" class="form-control">
                        <?php foreach ($qw as $a): ?>
                            <option value="<?= $a['id'] ?>" <?= fv('cat') == $a['id'] ? 'selected' : '' ?>>
                                <?= $a['name'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <br>

                    <input class="form-check-input" name="like_page" type="checkbox"
                           value="like_page" id="like_page" <?= fch('like_page') ?>>
                    <label class="form-check-label" for="like_page">
                        <?= $txtfarmi3 ?>
                    </label>
                    <br><br>

                    <label for="num_lp"><?= $txtfarmi4 ?></label>
                    <input type="text" name="num_lp" id="num_lp" class="form-control"
                           value="<?= fv('num_lp','2-3') ?>" pattern="([0-9]{1,3})-([0-9]{1,3})">
                    <br>

                    <input class="form-check-input" name="like_gr" type="checkbox"
                           value="like_gr" id="like_gr" <?= fch('like_gr') ?>>
                    <label class="form-check-label" for="like_gr">
                        <?= $txtfarmi5 ?>
                    </label>
                    <br><br>

                    <label for="num_gr"><?= $txtfarmi6 ?></label>
                    <input type="text" name="num_gr" id="num_gr" class="form-control"
                           value="<?= fv('num_gr','2-3') ?>" pattern="([0-9]{1,3})-([0-9]{1,3})">
                    <br>

                    <input class="form-check-input" name="like_gr1" type="checkbox"
                           value="like_gr1" id="like_gr1" <?= fch('like_gr1') ?>>
                    <label class="form-check-label" for="like_gr1">
                        Подписываться по списку групп и страниц
                    </label>
                    <br><br>

                    <label for="num_gr1">Количество подписок за раз</label>
                    <input type="text" name="num_gr1" id="num_gr1" class="form-control"
                           value="<?= fv('num_gr1','2-3') ?>" pattern="([0-9]{1,3})-([0-9]{1,3})">
                    <br>

                    <label for="cat1" class="control-label">Список групп и страниц (URL Groups)</label>
                    <select name="cat1" id="cat1" class="form-control">
                        <?php foreach ($qw1 as $b): ?>
                            <option value="<?= $b['id'] ?>" <?= fv('cat1') == $b['id'] ? 'selected' : '' ?>>
                                <?= $b['name'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <br><br>

                    <input class="form-check-input" name="feed" type="checkbox"
                           value="feed" id="feed" <?= fch('feed') ?>>
                    <label class="form-check-label" for="feed">
                        <?= $txtfarmi7 ?>
                    </label>
                    <br><br>

                    <label for="num_l"><?= $txtfarmi8 ?></label>
                    <input type="text" name="num_l" id="num_l" class="form-control"
                           value="<?= fv('num_l','4-5') ?>" pattern="([0-9]{1,3})-([0-9]{1,3})">
                    <br>

                    <input class="form-check-input" name="like_adv" type="checkbox"
                           value="like_adv" id="like_adv" <?= fch('like_adv') ?>>
                    <label class="form-check-label" for="like_adv">
                        <?= $txtfarmi9 ?>
                    </label>
                    <br><br>

                    <label for="p_like_adv"><?= $txtfarmi10 ?></label>
                    <input type="number" name="p_like_adv" id="p_like_adv" class="form-control"
                           value="<?= fv('p_like_adv','30') ?>" required>
                    <br>

                    <label for="f24"><?= $txtfarmi11 ?></label>
                    <input type="number" name="f24" id="f24" class="form-control"
                           value="<?= fv('f24','5') ?>">
                    <br>

                    <button class="btn btn-secondary" name="add_task" value="farm">
                        ✅ SAVE
                    </button>

                </form>

            </div>
        </div>
    </div>
</main>
