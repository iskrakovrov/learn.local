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

// Lists
$csity = selectAll('SELECT * FROM lists WHERE cat = 2 OR cat = 9 LIMIT 500');
$edu   = selectAll('SELECT * FROM lists WHERE cat = 9 LIMIT 500');
$work  = selectAll('SELECT * FROM lists WHERE cat = 9 LIMIT 500');
$fnames = selectAll('SELECT * FROM lists WHERE cat = 3 LIMIT 500');
$lnames = selectAll('SELECT * FROM lists WHERE cat = 3 LIMIT 500');
$apost = selectAll('SELECT * FROM lists WHERE cat = 5 LIMIT 500');
?>

<main class="container-fluid">
    <div class="row text-center">
        <h2><?= $txtmen ?></h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <div class="alert alert-info" role="alert">
                <?= $txtfill ?>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-2 text-center">

            <form method="post" onsubmit="return Complete();">

                <!-- Город -->
                <label for="currc"><?= $txtfill2 ?></label>
                <select name="currc" id="currc" class="form-control">
                    <option value="no" <?= fsel('currc', 'no') ?>><?= $txtfill5 ?></option>
                    <?php foreach ($csity as $a): ?>
                        <option value="<?= $a['id'] ?>" <?= fsel('currc', $a['id']) ?>>
                            <?= $a['name'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
                <br>

                <!-- Учёба -->
                <label for="edu"><?= $txtfill4 ?></label>
                <select name="edu" id="edu" class="form-control">
                    <option value="no" <?= fsel('edu', 'no') ?>><?= $txtfill5 ?></option>
                    <?php foreach ($edu as $b): ?>
                        <option value="<?= $b['id'] ?>" <?= fsel('edu', $b['id']) ?>>
                            <?= $b['name'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
                <br>

                <!-- Работа -->
                <label for="work"><?= $txtfill3 ?></label>
                <select name="work" id="work" class="form-control">
                    <option value="no" <?= fsel('work', 'no') ?>><?= $txtfill5 ?></option>
                    <?php foreach ($work as $c): ?>
                        <option value="<?= $c['id'] ?>" <?= fsel('work', $c['id']) ?>>
                            <?= $c['name'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
                <br>

                <!-- Имя -->
                <label for="fname">First name</label>
                <select name="fname" id="fname" class="form-control">
                    <option value="no" <?= fsel('fname', 'no') ?>><?= $txtfill5 ?></option>
                    <?php foreach ($fnames as $e): ?>
                        <option value="<?= $e['id'] ?>" <?= fsel('fname', $e['id']) ?>>
                            <?= $e['name'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
                <br>

                <!-- Фамилия -->
                <label for="lname">Last name</label>
                <select name="lname" id="lname" class="form-control">
                    <option value="no" <?= fsel('lname', 'no') ?>><?= $txtfill5 ?></option>
                    <?php foreach ($lnames as $d): ?>
                        <option value="<?= $d['id'] ?>" <?= fsel('lname', $d['id']) ?>>
                            <?= $d['name'] ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <br>

                <!-- Cover -->
                <label for="cover">Install cover</label>
                <select class="form-select" id="cover" name="cover">
                    <option value="no" <?= fsel('cover', 'no') ?>>No</option>
                    <option value="yes" <?= fsel('cover', 'yes') ?>>Yes</option>
                </select>

                <br>

                <!-- Avatar -->
                <label for="ava">Install avatar</label>
                <select class="form-select" id="ava" name="ava">
                    <option value="no" <?= fsel('ava', 'no') ?>>No</option>
                    <option value="yes" <?= fsel('ava', 'yes') ?>>Yes</option>
                </select>

                <br>

                <!-- Текст для аватарки -->
                <label for="apost">Text for avatar</label>
                <select name="apost" id="apost" class="form-control">
                    <option value="no" <?= fsel('apost', 'no') ?>>No text for avatar</option>
                    <?php foreach ($apost as $t): ?>
                        <option value="<?= $t['id'] ?>" <?= fsel('apost', $t['id']) ?>>
                            <?= $t['name'] ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <br>

                <!-- Privacy -->
                <label for="priv">Setup privacy</label>
                <select class="form-select" id="priv" name="priv">
                    <option value="no" <?= fsel('priv', 'no') ?>>No</option>
                    <option value="yes" <?= fsel('priv', 'yes') ?>>Yes</option>
                </select>

                <br>
                <br>

                <button class="btn btn-secondary" name="add_task" value="filling_accounts">
                    ✅ SAVE
                </button>

            </form>

        </div>
    </div>
</main>
