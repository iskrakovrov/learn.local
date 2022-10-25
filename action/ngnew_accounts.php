<?php
$sql = "SELECT * FROM lists WHERE cat = 4 OR cat = 9";
$qw = selectAll($sql);
$sql = "SELECT * FROM lists WHERE cat = 2 OR cat = 9";
$geol = selectAll($sql);

?>

<main class="container-fluid ">
    <div class="row text-center">
        <h2><?php echo $txtnewacc ?></h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    <?php echo $txtnewacc1 ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">


                    <label for="listid" class="control-label"><?php echo $txtnewacc2 ?></label>

                    <select name="listid" id="listid" class="form-control">
                        <?php
                        $i = 0;
                        foreach ($qw as $a) {
                            $i++; ?>
                            <option value="<?php echo $a['id'] ?>"><?php echo $a['name']; ?></option>
                        <?php } ?>
                    </select>

                    <br>
                    <label for="geo" class="control-label"><?php echo $txtnewacc3 ?></label>

                    <select name="geo" id="geo" class="form-control">
                        <?php
                        $i = 0;
                        foreach ($geol as $a) {
                            $i++; ?>
                            <option value="<?php echo $a['id'] ?>"><?php echo $a['name']; ?></option>
                        <?php } ?>
                    </select>
                    <br>


                    <label for="num_i"><?php echo $txtnewacc4 ?></label>
                    <input type="number" name="num_i" id="num_i" class="form-control" value="5"
                           required>

                    <br>
                    <label for="pause"><?php echo $txtnewacc5 ?></label>
                    <input type="text" name="pause" id="pause" class="form-control" value="5-10"
                           pattern="([0-9]{1,3})-([0-9]{1,3})" required>

                    <br>
                    <label for="confirm">Confirm or Cancel</label>
                    <select class="form-select" id="confirm" name="confirm" >

                        <option value="1">Confirm</option>
                        <option value="2">Cancel</option>

                    </select>
                    <br>


                    <label for="num_co"><?php echo $txtnewacc6 ?></label>
                    <input type="number" name="num_co" id="num_co" class="form-control" value="5"
                           required>



                    <br>
                    <label for="f24"><?php echo $txtfarmi11 ?></label>
                    <input type="number" name="f24" id="f24" class="form-control"
                           value="3" required>


                    <br>
                    <br>


                    <button class="btn btn-secondary" name="add_task" id="add_task" value="new_accounts">ACTIVATE
                    </button>


                </form>
            </div>
        </div>
    </div>


</main>