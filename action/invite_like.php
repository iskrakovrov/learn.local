<?php
$sql = 'SELECT * FROM lists WHERE cat = 11';
$qw = selectAll($sql);

// Проверка существования необходимых POST-данных
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = array_map('trim', $_POST);
}
?>

<main class="container-fluid">
    <div class="row text-center">
        <h2>Invite with reactions</h2>
    </div>
    <div class="col align-center">
        <div class="row justify-content-center">
            <div class="col-6 text-center">
                <div class="alert alert-info" role="alert">
                    <p>In the "URL list" specify the addresses of posts with a large number of likes from the people you want.</p>
                    <p>В списке URL list укажите адреса постов с большим количеством лайков нужных вам людей.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post">
                    <!-- количество инвайтов -->
                    <br>
                    <label for="num_i"><?php echo htmlspecialchars($txtnewacc4 ?? 'Number of invites'); ?></label>
                    <input type="number" name="num_i" id="num_i" class="form-control" value="<?= isset($_POST['num_i']) ? (int)$_POST['num_i'] : 50 ?>" required>

                    <br>
                    <!-- Pause -->
                    <label for="pause"><?php echo htmlspecialchars($txtnewacc5 ?? 'Pause'); ?></label>
                    <input type="text" name="pause" id="pause" class="form-control" value="<?= isset($_POST['pause']) ? htmlspecialchars($_POST['pause']) : '5-10' ?>" pattern="([0-9]{1,3})-([0-9]{1,3})" required>

                    <br>
                    <!-- ГЕО -->
                    <label for="posts" class="control-label">URL's</label>
                    <select name="posts" id="posts" class="form-control">
                        <?php foreach ($qw as $a): ?>
                            <option value="<?= (int)$a['id'] ?>" <?= isset($_POST['posts']) && $_POST['posts'] == $a['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($a['name'] ?? '') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <br>
                    <!-- конфирм -->
                    <label for="confirm">Confirm or Cancel</label>
                    <select class="form-select" id="confirm" name="confirm">
                        <option value="1" <?= isset($_POST['confirm']) && $_POST['confirm'] == 1 ? 'selected' : '' ?>>Confirm</option>
                        <option value="2" <?= isset($_POST['confirm']) && $_POST['confirm'] == 2 ? 'selected' : '' ?>>Cancel</option>
                    </select>

                    <br>
                    <!-- количество конфирмов -->
                    <label for="num_co"><?php echo htmlspecialchars($txtnewacc6 ?? 'Confirmations'); ?></label>
                    <input type="number" name="num_co" id="num_co" class="form-control" value="<?= isset($_POST['num_co']) ? (int)$_POST['num_co'] : 5 ?>" required>

                    <br>
                    <!-- раз в день -->
                    <label for="f24"><?php echo htmlspecialchars($txtfarmi11 ?? 'Per day'); ?></label>
                    <input type="number" name="f24" id="f24" class="form-control" value="<?= isset($_POST['f24']) ? (int)$_POST['f24'] : 5 ?>" required>

                    <br>
                    <button class="btn btn-secondary" name="add_task" value="invite_like">ACTIVATE</button>
                </form>
            </div>
        </div>
    </div>
</main>