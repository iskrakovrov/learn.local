<?php
$sql = 'SELECT * FROM lists WHERE cat = 11';
$qw = selectAll($sql);

?>

<main class="container-fluid ">
    <div class="row text-center">
        <h2>Likes</h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    <?php echo $txtlike ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">

                    <label for="cat" class="control-label"><?php echo $txtlike1 ?></label>

                    <select name="cat" id="cat" class="form-control">
                        <?php
                        $i = 0;
                        foreach ($qw as $a) {
                            $i++; ?>
                            <option value="<?php echo $a['id'] ?>"><?php echo $a['name']; ?></option>
                        <?php } ?>
                    </select>

                    <br>


                    <label for="num_l"><?php echo $txtlike2 ?></label>
                    <input type="text" name="num_l" id="num_l" class="form-control" value="5" required>


                    <br>
                    <label for="pause"><?php echo $txtnewacc5 ?></label>
                    <input type="text" name="pause" id="pause" class="form-control" value="5-10"
                           pattern="([0-9]{1,3})-([0-9]{1,3})" required>
                    <br>
                    <label for="f24"><?php echo $txtfarmi11 ?></label>
                    <input type="number" name="f24" id="f24" class="form-control"
                           value="3" required>


                    <br>


                    <button class="btn btn-secondary" name="add_task" id="add_task" value="like">ACTIVATE
                    </button>


                </form>
            </div>
        </div>
    </div>


</main>

