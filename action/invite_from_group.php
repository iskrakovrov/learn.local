<?php
$taskFile = basename(__FILE__);
$setup = $_SESSION['setup'][$taskFile] ?? [];

// utils
function fv($name, $default = '') {
    global $setup;
    return htmlspecialchars($setup[$name] ?? $default);
}

function fsel($name, $value) {
    global $setup;
    return (isset($setup[$name]) && $setup[$name] == $value) ? 'selected' : '';
}

// Lists
$geo1 = selectAll('SELECT * FROM lists WHERE cat = 2 OR cat = 9');
$name1 = selectAll('SELECT * FROM lists WHERE cat = 3 OR cat = 9');
$bl1 = selectAll('SELECT * FROM lists WHERE cat = 1 OR cat = 9');
$gr1 = selectAll('SELECT * FROM lists WHERE cat = 10 OR cat = 9');
$me1 = selectAll('SELECT * FROM lists WHERE cat = 4');
?>

<main class="container-fluid">
    <div class="row text-center">
        <h2><?= $txtglobali19 ?></h2>
    </div>

    <div class="col align-center">
        <div class="row justify-content-center">
            <div class="col-6 text-center">
                <div class="alert alert-info" role="alert">
                    <?= $txtglobali17 ?>
                </div>
            </div>
        </div>
    </div>


    <div class="row justify-content-center">
        <div class="col-sm-2 text-center">

            <form method="post" onsubmit="return Complete();">

                <label for="gr"><?= $txtglobali20 ?></label>
                <select name="gr" id="gr" class="form-control">
                    <option value="in" <?= fsel('gr', 'in') ?>><?= $txtglobali18 ?></option>
                    <?php foreach ($gr1 as $r): ?>
                        <option value="<?= $r['id'] ?>" <?= fsel('gr', $r['id']) ?>>
                            <?= $r['name'] ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <br>

                <label for="num_i"><?= $txtnewacc4 ?></label>
                <input type="number" name="num_i" id="num_i"
                       class="form-control"
                       value="<?= fv('num_i', '20') ?>" required>

                <br>

                <label for="pause"><?= $txtnewacc5 ?></label>
                <input type="text" name="pause" id="pause"
                       class="form-control"
                       value="<?= fv('pause', '5-10') ?>"
                       pattern="([0-9]{1,3})-([0-9]{1,3})" required>

                <br>

                <label for="mode"><?= $txtglobali21 ?></label>
                <select name="mode" id="mode" class="form-control">
                    <option value="all" <?= fsel('mode', 'all') ?>>ALL</option>
                    <option value="post" <?= fsel('mode', 'post') ?>><?= $txtglobali14 ?></option>
                    <option value="nyou" <?= fsel('mode', 'nyou') ?>><?= $txtglobali15 ?></option>
                </select>

                <br>

                <label for="geo"><?= $txtinv31 ?> <?= $txtinvg1 ?></label>
                <select name="geo" id="geo" class="form-control">
                    <option value="all" <?= fsel('geo', 'all') ?>>ALL</option>
                    <?php foreach ($geo1 as $a): ?>
                        <option value="<?= $a['id'] ?>" <?= fsel('geo', $a['id']) ?>>
                            <?= $a['name'] ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <br>

                <label for="filter">Name filter</label>
                <select name="filter" id="filter" class="form-control">
                    <?php
                    $options_filter = [
                        "all" => "All", "cyr" => "Cyr", "lat" => "Lat", "cl" => "Cyr + Lat",
                        "black" => "Black", "white" => "White", "blackwhite" => "Black + White"
                    ];
                    foreach ($options_filter as $key => $label): ?>
                        <option value="<?= $key ?>" <?= fsel('filter', $key) ?>><?= $label ?></option>
                    <?php endforeach ?>
                </select>

                <br>

                <label for="wln"><?= $txtinv32 ?></label>
                <select name="wln" id="wln" class="form-control">
                    <option value="all" <?= fsel('wln', 'all') ?>>ALL</option>
                    <?php foreach ($name1 as $d): ?>
                        <option value="<?= $d['id'] ?>" <?= fsel('wln', $d['id']) ?>><?= $d['name'] ?></option>
                    <?php endforeach ?>
                </select>

                <br>

                <label for="bln"><?= $txtinv33 ?></label>
                <select name="bln" id="bln" class="form-control">
                    <option value="all" <?= fsel('bln', 'all') ?>>ALL</option>
                    <?php foreach ($name1 as $c): ?>
                        <option value="<?= $c['id'] ?>" <?= fsel('bln', $c['id']) ?>><?= $c['name'] ?></option>
                    <?php endforeach ?>
                </select>

                <br>

                <label for="gbl"><?= $txtinv34 ?></label>
                <select name="gbl" id="gbl" class="form-control">
                    <option value="no" <?= fsel('gbl', 'no') ?>>No black list</option>
                    <?php foreach ($bl1 as $b): ?>
                        <option value="<?= $b['id'] ?>" <?= fsel('gbl', $b['id']) ?>><?= $b['name'] ?></option>
                    <?php endforeach ?>
                </select>

                <br>

                <label for="confirm">Confirm or Cancel</label>
                <select name="confirm" id="confirm" class="form-control">
                    <option value="1" <?= fsel('confirm', '1') ?>>Confirm</option>
                    <option value="2" <?= fsel('confirm', '2') ?>>Cancel</option>
                </select>

                <br>

                <label for="num_co"><?= $txtnewacc6 ?></label>
                <input type="number" name="num_co" id="num_co"
                       class="form-control"
                       value="<?= fv('num_co', '5') ?>" required>

                <br>

                <label for="f24"><?= $txtfarmi11 ?></label>
                <input type="number" name="f24" id="f24"
                       class="form-control"
                       value="<?= fv('f24', '5') ?>" required>

                <br>

                <label for="parse">Parse member?</label>
                <select name="parse" id="parse" class="form-control">
                    <option value="no" <?= fsel('parse', 'no') ?>>No</option>
                    <?php foreach ($me1 as $s): ?>
                        <option value="<?= $s['id'] ?>" <?= fsel('parse', $s['id']) ?>>
                            <?= $s['name'] ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <br><br>

                <button class="btn btn-secondary" name="add_task" value="invite_from_group">
                    ✅ SAVE
                </button>

            </form>
        </div>
    </div>
</main>
