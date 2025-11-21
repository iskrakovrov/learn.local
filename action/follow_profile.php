<?php
$taskFile = basename(__FILE__);
$setup = $_SESSION['setup'][$taskFile] ?? [];

function fsel($name, $value) {
    global $setup;
    return (isset($setup[$name]) && $setup[$name] == $value) ? 'selected' : '';
}

$qw = selectAll('SELECT * FROM lists WHERE cat = 11');
?>

<main class="container-fluid">
    <div class="row text-center">
        <h2>Follow profiles</h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <div class="alert alert-info" role="alert">
                Follow profiles. Select URL list
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-2 text-center">

            <form method="post" onsubmit="return Complete();">

                <label for="cat" class="control-label">List accounts for following</label>
                <select name="cat" id="cat" class="form-control">
                    <?php foreach ($qw as $a): ?>
                        <option value="<?= $a['id'] ?>" <?= fsel('cat', $a['id']) ?>>
                            <?= $a['name'] ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <br>

                <button class="btn btn-secondary" name="add_task" value="follow_profile">
                    ✅ SAVE
                </button>

            </form>

        </div>
    </div>
</main>
