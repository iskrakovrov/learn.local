<?php
// Загружаем настройки, если редактируем шаблон
$taskFile = basename(__FILE__);
$setup = $_SESSION['setup'][$taskFile] ?? [];

// Универсальная функция для предзаполнения значений
function fv($name, $default = '') {
    global $setup;
    return htmlspecialchars($setup[$name] ?? $default);
}

// Данные списков
$sql = 'SELECT * FROM lists WHERE cat = 2 OR cat = 9';
$qw = selectAll($sql);

$sql = 'SELECT * FROM lists WHERE cat = 3 OR cat = 9';
$qw1 = selectAll($sql);
?>

<main class="container-fluid">
    <div class="row text-center">
        <h2><?= $txtass ?></h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <div class="alert alert-info" role="alert">
                <?= $txtass1 ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-3 text-center">
                <form method="post" onsubmit="return Complete();">

                    <!-- Гео список -->
                    <label for="cat"><?= $txtgeo ?></label>
                    <select name="cat" id="cat" class="form-control">
                        <option value="0">All</option>
                        <?php foreach ($qw as $a): ?>
                            <option value="<?= $a['id'] ?>" <?= fv('cat') == $a['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($a['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <br>

                    <!-- Фильтр -->
                    <label for="filter"><?= $txtfilter2 ?></label>
                    <select class="form-select" id="filter" name="filter">
                        <?php
                        $filterOptions = [
                            'all' => 'All',
                            'cyr' => 'Cyr',
                            'lat' => 'Lat',
                            'cl' => 'Cyr + Lat',
                            'black' => 'Black',
                            'white' => 'White',
                            'blackwhite' => 'Black + White'
                        ];
                        foreach ($filterOptions as $v => $txt):
                            ?>
                            <option value="<?= $v ?>" <?= fv('filter') == $v ? 'selected' : '' ?>>
                                <?= $txt ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <br>

                    <!-- Black list -->
                    <label for="black">Black list</label>
                    <select name="black" id="black" class="form-control">
                        <option value="0">No</option>
                        <?php foreach ($qw1 as $b): ?>
                            <option value="<?= $b['id'] ?>" <?= fv('black') == $b['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($b['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <br>

                    <!-- White list -->
                    <label for="white">White list</label>
                    <select name="white" id="white" class="form-control">
                        <option value="0">No</option>
                        <?php foreach ($qw1 as $c): ?>
                            <option value="<?= $c['id'] ?>" <?= fv('white') == $c['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($c['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <br>

                    <label for="one_s"><?= $txtass2 ?></label>
                    <input type="text" name="one_s" id="one_s" class="form-control"
                           value="<?= fv('one_s', '20') ?>" required>
                    <br>

                    <label for="pause"><?= $txtpause ?></label>
                    <input type="text" name="pause" id="pause" class="form-control"
                           value="<?= fv('pause', '3-4') ?>"
                           pattern="([0-9]{1,3})-([0-9]{1,3})" required>
                    <br>

                    <label for="f24"><?= $txtfarmi11 ?></label>
                    <input type="number" name="f24" id="f24" class="form-control"
                           value="<?= fv('f24', '3') ?>" required>
                    <br><br>

                    <button class="btn btn-secondary" name="add_task" value="accept_friends">
                        ✅ SAVE
                    </button>

                </form>
            </div>
        </div>
    </div>
</main>
