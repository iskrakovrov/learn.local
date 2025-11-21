<?php
$taskFile = basename(__FILE__);
$setup = $_SESSION['setup'][$taskFile] ?? [];

// value
function fv($index, $default = '') {
    global $setup;
    return htmlspecialchars($setup[$index] ?? $default);
}
// checkbox state
function fch($index) {
    global $setup;
    return (!empty($setup[$index])) ? 'checked' : '';
}
// select state
function fsel($index, $val) {
    global $setup;
    return (isset($setup[$index]) && $setup[$index] == $val) ? 'selected' : '';
}
?>

<main class="container-fluid">
    <div class="row text-center">
        <h2>LOGIN</h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <div class="alert alert-info" role="alert">
                <?= $txtlogin ?>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-2 text-center">
            <form method="post" onsubmit="return Complete();">

                <input type="checkbox" name="action[17]" id="action[17]" value="per" <?= fch(17) ?>>
                <label for="action[17]">
                    Switch the account language to English for the program to work correctly
                </label>

                <br><br>

                <input type="checkbox" name="action[16]" id="action[16]" value="hand" <?= fch(16) ?>>
                <label for="action[16]"><?= $txtlogin40 ?></label>

                <br><br>

                <input type="checkbox" name="action[0]" id="action[0]" value="sbor" <?= fch(0) ?>>
                <label for="action[0]"><?= $txtlogin1 ?></label>

                <br>

                <input type="checkbox" name="action[1]" id="action[1]" value="delphone" <?= fch(1) ?>>
                <label for="action[1]"><?= $txtlogin2 ?></label>

                <br>

                <input type="checkbox" name="action[2]" id="action[2]" value="smart" <?= fch(2) ?>>
                <label for="action[2]"><?= $txtlogin3 ?></label>

                <br>

                <input type="checkbox" name="action[3]" id="action[3]" value="tock" <?= fch(3) ?>>
                <label for="action[3]"><?= $txtlogin4 ?></label>

                <br><br>

                <label for="action[4]"><?= $txtlogin5 ?></label>
                <input type="number" class="form-control" name="action[4]" id="action[4]"
                       value="<?= fv(4, 150) ?>">

                <br>

                <label for="action[5]"><?= $txtlogin11 ?></label>
                <input type="number" class="form-control" name="action[5]" id="action[5]"
                       value="<?= fv(5, 200) ?>">

                <br>

                <label for="action[6]"><?= $txtlogin6 ?></label>
                <input type="number" class="form-control" name="action[6]" id="action[6]"
                       value="<?= fv(6, 50) ?>">

                <br>

                <label for="action[7]"><?= $txtlogin7 ?></label>
                <input type="number" class="form-control" name="action[7]" id="action[7]"
                       value="<?= fv(7, 50) ?>">

                <br>

                <label for="action[8]"><?= $txtlogin8 ?></label>
                <input type="number" class="form-control" name="action[8]" id="action[8]"
                       value="<?= fv(8, 20) ?>">

                <br>

                <label for="action[9]"><?= $txtlogin9 ?></label>
                <input type="number" class="form-control" name="action[9]" id="action[9]"
                       value="<?= fv(9, 180) ?>" required>

                <br>

                <input type="checkbox" name="action[10]" id="action[10]" style="display:none" <?= fch(10) ?>>

                <br>

                <label for="action[11]">GET</label>
                <input type="text" class="form-control" name="action[11]" id="action[11]"
                       value="<?= fv(11) ?>">

                <br>

                <input type="checkbox" name="action[12]" id="action[12]" value="bat" <?= fch(12) ?>>
                <label for="action[12]"><?= $txtlogin12 ?></label>

                <br>

                <input type="checkbox" name="action[13]" id="action[13]" value="ava" <?= fch(13) ?>>
                <label for="action[13]"><?= $txtlogin13 ?></label>

                <br><br>

                <label for="action[14]"><?= $txtlogin14 ?></label>
                <select class="form-select" name="action[14]" id="action[14]">
                    <option value="male" <?= fsel(14, 'male') ?>>Male</option>
                    <option value="female" <?= fsel(14, 'female') ?>>Female</option>
                </select>

                <br>

                <input type="checkbox" name="action[18]" id="action[18]" value="groups" <?= fch(18) ?>>
                <label for="action[18]">Collect the list of groups once</label>

                <br><br>

                <label for="action[15]"><?= $txtlogin15 ?></label>
                <input type="number" class="form-control" name="action[15]" id="action[15]"
                       value="<?= fv(15, 3) ?>" required>

                <br>

                <button class="btn btn-secondary" name="add_task" value="login">
                    ✅ SAVE
                </button>

            </form>
        </div>
    </div>
</main>
