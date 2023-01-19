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
                    <?php echo $txtpgroup  ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">

                    <label for="day" class="control-label"><?php echo $txtpgroup7 ?></label>
                    <select name="mod1" id="mod1" class="form-control">
                        <option value="1">YES</option>
                        <option value="2">NO</option>
                    </select>
                    <br>
                    <label for="type" class="control-label"><?php echo $txtpgroup1 ?></label>
                    <select name="type" id="type" class="form-control">
                        <option value="1">Groups where the account is a member</option>
                        <?php
                        $i = 0;
                        foreach ($qw1 as $a) {
                            $i++; ?>
                            <option value="<?php echo $a['id'] ?>"><?php echo $a['name']; ?></option>
                        <?php } ?>
                    </select>
                    <br>

                    <label for="post" class="control-label"><?php echo $txtpgroup3  ?></label>

                    <select name="post" id="post" class="form-control">
                        <?php
                        $i = 0;
                        foreach ($qw as $b) {
                            $i++; ?>
                            <option value="<?php echo $b['id'] ?>"><?php echo $b['name']; ?></option>
                        <?php } ?>
                    </select>

                    <br>


                    <label for="mod1" class="control-label"><?php echo $txtpgroup4 ?></label>
                    <select name="mod1" id="mod1" class="form-control">
                        <option value="1">NO</option>
                        <option value="2">YES</option>
                    </select>
                    <br>

                    <label for="mod2" class="control-label"><?php echo $txtpgroup2 ?></label>
                    <select name="mod2" id="mod2" class="form-control">
                        <option value="1">NO</option>
                        <option value="2">YES</option>
                    </select>
                    <br>

                    <label for="npost"><?php echo $txtpgroup5 ?></label>
                    <input type="text" name="npost" id="npost" class="form-control" value="5" required>
                    <br>
                    <label for="mod3" class="control-label"><?php echo $txtpgroup6 ?></label>
                    <select name="mod3" id="mod3" class="form-control">
                        <option value="1">NO</option>
                        <option value="2">YES</option>
                    </select>
                    <br>



                    <label for="f24"><?php echo $txtpost10 ?></label>
                    <input type="text" name="f24" id="f24" class="form-control" value="3" required>


                    <br>
                    <br>

                    <button class="btn btn-secondary" name="add_task" id="add_task" value="post_to_group">ACTIVATE
                    </button>



                </form>
            </div>
        </div>
    </div>


</main>
