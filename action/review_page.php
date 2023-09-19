<?php
$sql = 'SELECT * FROM lists WHERE cat = 11';
$qw = selectAll($sql);
$sql = 'SELECT * FROM lists WHERE cat = 5';
$qw1 = selectAll($sql);

?>

<main class="container-fluid ">
    <div class="row text-center">
        <h2>Pages Review</h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    Pages Review
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">


                    <label for="url" class="control-label">Url pages</label>

                    <select name="url" id="url" class="form-control">
                        <?php
                        $i = 0;
                        foreach ($qw as $a) {
                            $i++; ?>
                            <option value="<?php echo $a['id'] ?>"><?php echo $a['name']; ?></option>
                        <?php } ?>
                    </select>

                    <br>
                    <label for="coml" class="control-label">Text Review</label>

                    <select name="coml" id="coml" class="form-control">
                        <?php
                        $i = 0;
                        foreach ($qw1 as $b) {
                            $i++; ?>
                            <option value="<?php echo $b['id'] ?>"><?php echo $b['name']; ?></option>
                        <?php } ?>
                    </select>

                    <br>

                    <label for="num_cp">The number of pages on which the account posts a review per launch</label>
                    <input type="number" name="num_cp" id="num_cp" class="form-control" value="1" required>

                    <br>
                    <label for="like" class="control-label">Should I post a review if this page has already received a review from another account within 24 hours?</label>

                    <select name="like" id="like" class="form-control">

                        <option value="1">
                            Yes
                        </option>
                        <option value="2">
                            No
                        </option>

                    </select>
                    <br>

                    <label for="f24"><?php echo $txtfarmi11 ?></label>
                    <input type="number" name="f24" id="f24" class="form-control"
                           value = "5">

                    <br>
                    <br>

                    <button class="btn btn-secondary" name="add_task" id="add_task" value="review_page">ACTIVATE
                    </button>


                </form>
            </div>
        </div>
    </div>


</main>