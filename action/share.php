<?php
$taskFile = basename(__FILE__);
$setup = $_SESSION['setup'][$taskFile] ?? [];

// Helpers
function fv($name, $default = '') {
    global $setup;
    return htmlspecialchars($setup[$name] ?? $default);
}
function fsel($name, $val) {
    global $setup;
    return (isset($setup[$name]) && $setup[$name] == $val) ? 'selected' : '';
}

$qw  = selectAll("SELECT * FROM lists WHERE cat = 11");
$qw1 = selectAll("SELECT * FROM lists WHERE cat = 5");
$at1 = selectAll("SELECT * FROM account_tags");
?>

<main class="container-fluid">
    <div class="row text-center">
        <h2>Share</h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <div class="alert alert-info" role="alert">
                Share posts
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-2 text-center">

            <form method="post" onsubmit="return Complete();">

                <label for="one">Make it one time</label>
                <select name="one" id="one" class="form-control">
                    <option value="1" <?= fsel('one', '1') ?>>Yes</option>
                    <option value="2" <?= fsel('one', '2') ?>>No</option>
                </select>

                <br>

                <label for="url">URL of posts or Pages to share</label>
                <select name="url" id="url" class="form-control">
                    <option value="0" <?= fsel('url', '0') ?>>Your accounts</option>
                    <?php foreach ($qw as $a): ?>
                        <option value="<?= $a['id'] ?>" <?= fsel('url', $a['id']) ?>>
                            <?= htmlspecialchars($a['name']) ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <br>

                <label for="acc">Accounts for share</label>
                <select name="acc" id="acc" class="form-control">
                    <?php foreach ($at1 as $c): ?>
                        <option value="<?= $c['id'] ?>" <?= fsel('acc', $c['id']) ?>>
                            <?= htmlspecialchars($c['tag']) ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <br>

                <label for="stxt">Text for repost</label>
                <select name="stxt" id="stxt" class="form-control">
                    <option value="no" <?= fsel('stxt', 'no') ?>>No texts</option>
                    <?php foreach ($qw1 as $b): ?>
                        <option value="<?= $b['id'] ?>" <?= fsel('stxt', $b['id']) ?>>
                            <?= htmlspecialchars($b['name']) ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <br>

                <label for="num_sd">The number of shares of the same post per day</label>
                <input type="number" name="num_sd" id="num_sd" class="form-control"
                       value="<?= fv('num_sd', 1) ?>" required>

                <br>

                <label for="num_cp">Number of reposts</label>
                <input type="number" name="num_cp" id="num_cp" class="form-control"
                       value="<?= fv('num_cp', 1) ?>" required>

                <br>

                <label for="pause"><?= $txtcomm6 ?></label>
                <input type="text" name="pause" id="pause" class="form-control"
                       value="<?= fv('pause', '3-5') ?>"
                       pattern="([0-9]{1,3})-([0-9]{1,3})" required>

                <br>

                <label for="like">Like post for share</label>
                <select name="like" id="like" class="form-control">
                    <option value="1" <?= fsel('like', '1') ?>>Yes</option>
                    <option value="2" <?= fsel('like', '2') ?>>No</option>
                </select>

                <br>

                <label for="prc">Repost probability in %</label>
                <input type="number" name="prc" id="prc" class="form-control"
                       value="<?= fv('prc', 100) ?>" required>

                <br>

                <label for="f24"><?= $txtfarmi11 ?></label>
                <input type="number" name="f24" id="f24" class="form-control"
                       value="<?= fv('f24', 2) ?>">

                <br><br>

                <button class="btn btn-secondary" name="add_task" value="share">
                    ✅ SAVE
                </button>

            </form>

        </div>
    </div>
</main>
