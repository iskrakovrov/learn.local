<?php
$taskFile = basename(__FILE__);
$setup = $_SESSION['setup'][$taskFile] ?? [];

function fv($name, $default = '') {
    global $setup;
    return htmlspecialchars($setup[$name] ?? $default);
}
?>

<main class="container-fluid">
    <div class="row text-center">
        <h2>Add mail</h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <div class="alert alert-info" role="alert">
                <?= $txtmail1 ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onsubmit="return Complete();">

                    <label for="am"><?= $txtmail2 ?></label>
                    <select class="form-select" id="am" name="am">
                        <option value="yes" <?= fv('am') == 'yes' ? 'selected' : '' ?>>Yes</option>
                        <option value="no"  <?= fv('am') == 'no'  ? 'selected' : '' ?>>No</option>
                    </select>

                    <br><br>

                    <label for="cm">Check mail</label>
                    <select class="form-select" id="cm" name="cm">
                        <option value="yes" <?= fv('cm') == 'yes' ? 'selected' : '' ?>>Yes</option>
                        <option value="no"  <?= fv('cm') == 'no'  ? 'selected' : '' ?>>No</option>
                    </select>

                    <br><br>

                    <button class="btn btn-secondary" name="add_task" value="add_mail">✅ SAVE</button>

                </form>
            </div>
        </div>
    </div>
</main>
