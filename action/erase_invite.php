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
        <h2><?= $txterinv ?></h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <div class="alert alert-info" role="alert">
                <?= $txterinv1 ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">

                <form method="post" onsubmit="return Complete();">

                    <label for="num_e"><?= $txterinv2 ?></label>
                    <input type="number" name="num_e" id="num_e"
                           class="form-control"
                           value="<?= fv('num_e', '1000') ?>"
                           required>

                    <br><br>

                    <button class="btn btn-secondary" name="add_task" value="erase_invite">
                        ✅ SAVE
                    </button>

                </form>

            </div>
        </div>
    </div>
</main>
