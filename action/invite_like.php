<?php
$taskFile = basename(__FILE__);
$setup = $_SESSION['setup'][$taskFile] ?? [];

// helpers
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
        <h2>Invite with reactions</h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <div class="alert alert-info" role="alert">
                <p>In the "URL list" specify the addresses of posts with a large number of likes from the people you want.</p>
                <p>В списке URL list укажите адреса постов с большим количеством лайков нужных вам людей.</p>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-2 text-center">

            <form method="post" onsubmit="return Complete();">

                <label for="num_i"><?= $txtnewacc4 ?? 'Number of invites' ?></label>
                <input type="number" name="num_i" id="num_i"
                       class="form-control"
                       value="<?= fv('num_i', 50) ?>" required>

                <br>
                <label for="pause"><?= $txtnewacc5 ?? 'Pause' ?></label>
                <input type="text" name="pause" id="pause"
                       class="form-control"
                       value="<?= fv('pause', '5-10') ?>"
                       pattern="([0-9]{1,3})-([0-9]{1,3})" required>

                <br>
                <label for="posts">URL list</label>
                <select name="posts" id="posts" class="form-control">
                    <?php foreach ($qw as $a): ?>
                        <option value="<?= $a['id'] ?>" <?= fsel('posts', $a['id']) ?>>
                            <?= htmlspecialchars($a['name']) ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <br>
                <label for="confirm">Confirm or Cancel</label>
                <select name="confirm" id="confirm" class="form-control">
                    <option value="1" <?= fsel('confirm', '1') ?>>Confirm</option>
                    <option value="2" <?= fsel('confirm', '2') ?>>Cancel</option>
                </select>

                <br>
                <label for="num_co"><?= $txtnewacc6 ?? 'Confirmations' ?></label>
                <input type="number" name="num_co" id="num_co"
                       class="form-control"
                       value="<?= fv('num_co', 5) ?>" required>

                <br>
                <label for="f24"><?= $txtfarmi11 ?? 'Per day' ?></label>
                <input type="number" name="f24" id="f24"
                       class="form-control"
                       value="<?= fv('f24', 5) ?>" required>

                <br><br>

                <button class="btn btn-secondary" name="add_task" value="invite_like">
                    ✅ SAVE
                </button>

            </form>

        </div>
    </div>
</main>
