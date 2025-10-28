<?php
$sql = 'SELECT * FROM lists WHERE cat = 5';
$qw = selectAll($sql);
$sql = 'SELECT * FROM lists WHERE cat = 11';
$qw2 = selectAll($sql);
$sql = 'SELECT * FROM lists WHERE cat = 9';
$qw3 = selectAll($sql);
?>

<main class="container-fluid ">
    <div class="row text-center">
        <h2>Posting to profile</h2>
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

                    <label for="tag" class="control-label">Tagging Friends. Dictionary.</label>

                    <select name="tag" id="tag" class="form-control">
                        <option value="0">Don't tag</option>
                        <?php
                        $i = 0;
                        foreach ($qw3 as $t) {
                            $i++; ?>
                            <option value="<?php echo $t['id'] ?>"><?php echo $t['name']; ?></option>
                        <?php } ?>
                    </select>
                    <br>
                    <label for="tag1" class="control-label">Keep tag history?</label>
                    <select name="tag1" id="tag1" class="form-control">
                        <option value="1">YES</option>
                        <option value="2">NO</option>
                    </select>
                    <br>




                    <label for="mtag">Maximum number of tags</label>
                    <input type="number" name="mtag" id="mtag" class="form-control" value="20" required>


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
                    <br>
                    <label for="spost" class="control-label"><?php echo $txtpgroup9  ?></label>

                    <select name="spost" id="spost" class="form-control">
                        <?php
                        $i = 0;
                        foreach ($qw2 as $c) {
                            $i++; ?>
                            <option value="<?php echo $c['id'] ?>"><?php echo $c['name']; ?></option>
                        <?php } ?>
                    </select>
                    <br>

                    <label for="prc">Post probability in %</label>
                    <input type="number" name="prc" id="prc" class="form-control" value="100" required>

                    <br>
                    <br>



                    <label for="f24"><?php echo $txtpost10 ?></label>
                    <input type="text" name="f24" id="f24" class="form-control" value="1" required>


                    <br>
                    <br>

                    <button class="btn btn-secondary" name="add_task" id="add_task" value="post_to_profile">ACTIVATE
                    </button>



                </form>
            </div>
        </div>
    </div>


</main>

