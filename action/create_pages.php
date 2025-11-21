<?php
$taskFile = basename(__FILE__);
$setup = $_SESSION['setup'][$taskFile] ?? [];

function fv($name, $default = '') {
    global $setup;
    return htmlspecialchars($setup[$name] ?? $default);
}

$sql = 'SELECT * FROM lists WHERE cat = 9';
$names = selectAll($sql);
?>

<main class="container-fluid">
    <div class="row text-center">
        <h2>Create pages</h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <div class="alert alert-info" role="alert">
                Avatars in <strong>work folder\AVA_P</strong> . Cover in <strong>work folder\COVER_P</strong> .
                Page names in <strong>Additional Lists</strong>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">

                <form method="post" onsubmit="return Complete();">

                    <label for="mode">How to create pages</label>
                    <select class="form-select" id="mode" name="mode">
                        <option value="1" <?= fv('mode') == '1' ? 'selected' : '' ?>>Ordinary</option>
                        <option value="2" <?= fv('mode') == '2' ? 'selected' : '' ?>>ADS manager</option>
                    </select>

                    <br>

                    <label for="names">List names for pages</label>
                    <select name="names" id="names" class="form-control">
                        <?php foreach ($names as $a): ?>
                            <option value="<?= $a['id'] ?>" <?= fv('names') == $a['id'] ? 'selected' : '' ?>>
                                <?= $a['name'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>

                    <br>

                    <label for="num_p">Number of pages created in one run</label>
                    <input type="number" name="num_p" id="num_p" class="form-control"
                           value="<?= fv('num_p', '2') ?>" required>

                    <br><br>

                    <button class="btn btn-secondary" name="add_task" value="create_pages">
                        ✅ SAVE
                    </button>

                </form>

            </div>
        </div>
    </div>

</main>
