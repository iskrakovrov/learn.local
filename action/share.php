<?php
$sql = 'SELECT * FROM lists WHERE cat = 11';
$qw = selectAll($sql);
$sql = 'SELECT * FROM lists WHERE cat = 5';
$qw1 = selectAll($sql);

?>

<main class="container-fluid ">
    <div class="row text-center">
        <h2>Share</h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    <?php echo 'Share posts' ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">
                    <label for="one">Make it one time</label>
                    <select name="one" id="one" class="form-control">

                        <option value="1">
                            Yes
                        </option>
                        <option value="2">
                            No
                        </option>

                    </select>
                    <br>

                    <label for="url" class="control-label">URL of posts to share</label>

                    <select name="url" id="url" class="form-control">
                        <?php
                        $i = 0;
                        foreach ($qw as $a) {
                            $i++; ?>
                            <option value="<?php echo $a['id'] ?>"><?php echo $a['name']; ?></option>
                        <?php } ?>
                    </select>

                    <br>
                    <label for="stxt" class="control-label">Text for repost</label>

                    <select name="stxt" id="stxt" class="form-control">
                        <option value="no">No texts</option>
                        <?php
                        $i = 0;
                        foreach ($qw1 as $b) {
                            $i++; ?>
                            <option value="<?php echo $b['id'] ?>"><?php echo $b['name']; ?></option>
                        <?php } ?>
                    </select>
                    <br>

                    <label for="num_sd">The number of shares of the same post per day</label>
                    <input type="number" name="num_sd" id="num_sd" class="form-control" value="1" required>
                    <br>


                    <label for="num_cp">Number of reposts</label>
                    <input type="number" name="num_cp" id="num_cp" class="form-control" value="1" required>
                    <br>
                    <label for="pause"><?php echo $txtcomm6 ?></label>
                    <input type="text" name="pause" id="pause" class="form-control" value="3-5"
                           pattern="([0-9]{1,3})-([0-9]{1,3})" required>
                    <br>
                    <label for="like" class="control-label">Like post for share</label>

                    <select name="like" id="like" class="form-control">

                        <option value="1">
                            Yes
                        </option>
                        <option value="2">
                            No
                        </option>

                    </select>
                    <br>

                    <label for="prc">Repost probability in %</label>
                    <input type="number" name="prc" id="prc" class="form-control" value="100" required>

                    <br>
                    <label for="f24"><?php echo $txtfarmi11 ?></label>
                    <input type="number" name="f24" id="f24" class="form-control"
                           value="2">

                    <br>
                    <br>

                    <button class="btn btn-secondary" name="add_task" id="add_task" value="share">ACTIVATE
                    </button>


                </form>
            </div>
        </div>
    </div>


</main>

