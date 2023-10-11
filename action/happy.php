<?php
$sql = 'SELECT * FROM lists WHERE cat = 5';
$qw = selectAll($sql);

?>

<main class="container-fluid ">
    <div class="row text-center">
        <h2>Happy birthday</h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    <?php echo $txthappy ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">


                    <label for="cat" class="control-label"><?php echo $txthappy1 ?></label>

                    <select name="cat" id="cat" class="form-control">
                        <?php
                        $i = 0;
                        foreach ($qw as $a) {
                            $i++; ?>
                            <option value="<?php echo $a['id'] ?>"><?php echo $a['name']; ?></option>
                        <?php } ?>
                    </select>

                    <br>

                    <label for="none">Maximum number of congratulations per launch</label>
                    <input type="number" name="none" id="none" class="form-control"
                           value="15" required>


                    <br>

                    <label for="f24"><?php echo $txtfarmi11 ?></label>
                    <input type="number" name="f24" id="f24" class="form-control"
                           value="1" required>


                    <br>


                    <button class="btn btn-secondary" name="add_task" id="add_task" value="happy">ACTIVATE
                    </button>



                </form>
            </div>
        </div>
    </div>


</main>
