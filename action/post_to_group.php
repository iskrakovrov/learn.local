<?php
$sql = "SELECT * FROM lists WHERE cat = 5";
$qw = selectAll($sql);
$sql = "SELECT * FROM lists WHERE cat = 10";
$qw1 = selectAll($sql);
?>

<main class="container-fluid ">
    <div class="row text-center">
        <h2>Posting to groups</h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    <?php echo $txtpost8  ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">


                    <label for="cat" class="control-label"><?php echo $txtpost9 ?></label>

                    <select name="cat" id="cat" class="form-control">
                        <?php
                        $i = 0;
                        foreach ($qw as $a) {
                            $i++; ?>
                            <option value="<?php echo $a['id'] ?>"><?php echo $a['name']; ?></option>
                        <?php } ?>
                    </select>

                    <br>
                    <label for="cat" class="control-label"><?php echo $txtpost9 ?></label>

                    <select name="cat" id="cat" class="form-control">
                        <?php
                        $i = 0;
                        foreach ($qw1 as $b) {
                            $i++; ?>
                            <option value="<?php echo $b['id'] ?>"><?php echo $b['name']; ?></option>
                        <?php } ?>
                    </select>

                    <br>

                    <label for="day" class="control-label"><?php echo $txtpost11 ?></label>
                    <select name="day" id="day" class="form-control">
                        <option value="1">Once</option>
                        <option value="2">Every day</option>
                    </select>
                    <br>

                    <label for="multi1" class="control-label"><?php echo $txtpost12 ?></label>
                    <select name="multi1" id="multi1" class="form-control">
                        <option value="1">YES</option>
                        <option value="2">NO</option>
                    </select>
                    <br>

                    <label for="multi2" class="control-label"><?php echo $txtpost13 ?></label>
                    <select name="multi2" id="multi2" class="form-control">
                        <option value="1">YES</option>
                        <option value="2">NO</option>
                    </select>
                    <br>



                    <label for="f24"><?php echo $txtpost10 ?></label>
                    <input type="text" name="f24" id="f24" class="form-control" value="1" required>


                    <br>
                    <br>

                    <button class="btn btn-secondary" name="add_task" id="add_task" value="post_to_group">ACTIVATE
                    </button>



                </form>
            </div>
        </div>
    </div>


</main>
