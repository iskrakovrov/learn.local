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

$qw  = selectAll("SELECT * FROM lists WHERE cat = 5");
$qw2 = selectAll("SELECT * FROM lists WHERE cat = 11");
$qw3 = selectAll("SELECT * FROM lists WHERE cat = 9");
?>

<main class="container-fluid">
    <div class="row text-center">
        <h2>Posting to profile</h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <div class="alert alert-info">
                <?= $txtpost8 ?>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-2 text-center">
            <form method="post" onsubmit="return Complete();">

                <label for="cat"><?= $txtpost9 ?></label>
                <select name="cat" id="cat" class="form-control">
                    <?php foreach ($qw as $a): ?>
                        <option value="<?= $a['id'] ?>" <?= fsel('cat', $a['id']) ?>>
                            <?= htmlspecialchars($a['name']) ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <br>

                <label for="tag">Tagging Friends. Dictionary.</label>
                <select name="tag" id="tag" class="form-control">
                    <option value="0" <?= fsel('tag', '0') ?>>Don't tag</option>
                    <?php foreach ($qw3 as $t): ?>
                        <option value="<?= $t['id'] ?>" <?= fsel('tag', $t['id']) ?>>
                            <?= htmlspecialchars($t['name']) ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <br>

                <label for="tag1">Keep tag history?</label>
                <select name="tag1" id="tag1" class="form-control">
                    <option value="1" <?= fsel('tag1', '1') ?>>YES</option>
                    <option value="2" <?= fsel('tag1', '2') ?>>NO</option>
                </select>

                <br>

                <label for="mtag">Maximum number of tags</label>
                <input type="number" name="mtag" id="mtag" class="form-control"
                       value="<?= fv('mtag', 20) ?>" required>

                <br>

                <label for="day"><?= $txtpost11 ?></label>
                <select name="day" id="day" class="form-control">
                    <option value="1" <?= fsel('day', '1') ?>>Once</option>
                    <option value="2" <?= fsel('day', '2') ?>>Every day</option>
                </select>

                <br>

                <label for="multi1"><?= $txtpost12 ?></label>
                <select name="multi1" id="multi1" class="form-control">
                    <option value="1" <?= fsel('multi1', '1') ?>>YES</option>
                    <option value="2" <?= fsel('multi1', '2') ?>>NO</option>
                </select>

                <br>

                <label for="multi2"><?= $txtpost13 ?></label>
                <select name="multi2" id="multi2" class="form-control">
                    <option value="1" <?= fsel('multi2', '1') ?>>YES</option>
                    <option value="2" <?= fsel('multi2', '2') ?>>NO</option>
                </select>

                <br>

                <label for="spost"><?= $txtpgroup9 ?></label>
                <select name="spost" id="spost" class="form-control">
                    <?php foreach ($qw2 as $c): ?>
                        <option value="<?= $c['id'] ?>" <?= fsel('spost', $c['id']) ?>>
                            <?= htmlspecialchars($c['name']) ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <br>

                <label for="prc">Post probability in %</label>
                <input type="number" name="prc" id="prc" class="form-control"
                       value="<?= fv('prc', 100) ?>" required>

                <br>

                <label for="f24"><?= $txtpost10 ?></label>
                <input type="text" name="f24" id="f24" class="form-control"
                       value="<?= fv('f24', 1) ?>" required>

                <br><br>

                <button class="btn btn-secondary" name="add_task" value="post_to_profile">
                    ✅ SAVE
                </button>

            </form>
        </div>
    </div>

</main>
