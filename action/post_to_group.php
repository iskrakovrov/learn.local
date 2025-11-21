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
$qw1 = selectAll("SELECT * FROM lists WHERE cat = 10");
$qw2 = selectAll("SELECT * FROM lists WHERE cat = 11");
?>

<main class="container-fluid">
    <div class="row text-center">
        <h2>Posting to groups</h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <div class="alert alert-info">
                If you select a mode where the list of groups is limited to a list, then to start working with groups again, make a reset - the yellow button on the Accounts page.<br>
                Massive posting - Endless posting around the list of groups<br>
                Posting once per. Group reset after 24 hours<br>
                Posting once per - Strictly no more than 1 time<br>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-2 text-center">

            <form method="post" onsubmit="return Complete();">

                <label for="ntask">Index task</label>
                <input type="number" name="ntask" id="ntask" class="form-control"
                       value="<?= fv('ntask', 1) ?>" required>
                <br>

                <label for="mode3">Mode posting</label>
                <select name="mode3" id="mode3" class="form-control">
                    <option value="4" <?= fsel('mode3', '4') ?>>Warm-up only</option>
                    <option value="1" <?= fsel('mode3', '1') ?>>Massive posting</option>
                    <option value="2" <?= fsel('mode3', '2') ?>>Posting once per + reset 24h</option>
                    <option value="3" <?= fsel('mode3', '3') ?>>Posting once per</option>
                </select>
                <br>

                <label for="res">Limit groups per 24h (0 = unlimited)</label>
                <input type="text" name="res" id="res" class="form-control"
                       value="<?= fv('res', 0) ?>" required>
                <br>

                <label for="type">Group list</label>
                <select name="type" id="type" class="form-control">
                    <?php foreach ($qw1 as $a): ?>
                        <option value="<?= $a['id'] ?>" <?= fsel('type', $a['id']) ?>>
                            <?= htmlspecialchars($a['name']) ?>
                        </option>
                    <?php endforeach ?>
                </select>
                <br>

                <label for="post">Post list</label>
                <select name="post" id="post" class="form-control">
                    <?php foreach ($qw as $b): ?>
                        <option value="<?= $b['id'] ?>" <?= fsel('post', $b['id']) ?>>
                            <?= htmlspecialchars($b['name']) ?>
                        </option>
                    <?php endforeach ?>
                </select>
                <br>

                <label for="mod1">How to take groups?</label>
                <select name="mod1" id="mod1" class="form-control">
                    <option value="2" <?= fsel('mod1', '2') ?>>One by one</option>
                    <option value="1" <?= fsel('mod1', '1') ?>>Random</option>
                </select>
                <br>

                <label for="npost">Posts per launch</label>
                <input type="text" name="npost" id="npost" class="form-control"
                       value="<?= fv('npost', 2) ?>" required>
                <br>

                <label for="nday">Days to wait after joining group</label>
                <input type="text" name="nday" id="nday" class="form-control"
                       value="<?= fv('nday', 5) ?>" required>
                <br>

                <label for="nfr">Invites per group</label>
                <input type="text" name="nfr" id="nfr" class="form-control"
                       value="<?= fv('nfr', 5) ?>" required>
                <br>

                <label for="nl">Likes per group</label>
                <input type="text" name="nl" id="nl" class="form-control"
                       value="<?= fv('nl', 5) ?>" required>
                <br>

                <label for="mod4">Join if not a member?</label>
                <select name="mod4" id="mod4" class="form-control">
                    <option value="2" <?= fsel('mod4', '2') ?>>YES</option>
                    <option value="1" <?= fsel('mod4', '1') ?>>NO</option>
                </select>
                <br>

                <label for="ng">Max groups to join</label>
                <input type="text" name="ng" id="ng" class="form-control"
                       value="<?= fv('ng', 3) ?>" required>
                <br>

                <label for="scr">Screenshots?</label>
                <select name="scr" id="scr" class="form-control">
                    <option value="1" <?= fsel('scr', '1') ?>>YES</option>
                    <option value="2" <?= fsel('scr', '2') ?>>NO</option>
                </select>
                <br>

                <label for="fname">Screenshots folder</label>
                <input type="text" name="fname" id="fname" class="form-control"
                       value="<?= fv('fname', 'project') ?>" required>
                <br>

                <label for="spost">Collect post URLs to list</label>
                <select name="spost" id="spost" class="form-control">
                    <?php foreach ($qw2 as $c): ?>
                        <option value="<?= $c['id'] ?>" <?= fsel('spost', $c['id']) ?>>
                            <?= htmlspecialchars($c['name']) ?>
                        </option>
                    <?php endforeach ?>
                </select>
                <br>

                <label for="f24"><?= $txtpost10 ?></label>
                <input type="number" name="f24" id="f24" class="form-control"
                       value="<?= fv('f24', 3) ?>" required>
                <br><br>

                <button class="btn btn-secondary" name="add_task" value="post_to_group">
                    ✅ SAVE
                </button>

            </form>

        </div>
    </div>
</main>
