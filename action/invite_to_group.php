<?php
$sql = 'SELECT * FROM lists WHERE cat = 11';
$qw = selectAll($sql);

?>

<main class="container-fluid ">
    <div class="row text-center">
        <h2>Group invitations</h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    Select groups where to invite friends. The number of groups to invite at one time. The number of invitations to one group per run.
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">


                    <label for="cat" class="control-label">Groups to invite</label>

                    <select name="cat" id="cat" class="form-control">
                        <?php
                        $i = 0;
                        foreach ($qw as $a) {
                            $i++; ?>
                            <option value="<?php echo $a['id'] ?>"><?php echo $a['name']; ?></option>
                        <?php } ?>
                    </select>


                    <br>

                    <label for="n_gr">How many invitations to make in one run</label>
                    <input type="number" name="n_gr" id="n_gr" class="form-control"
                           value="1">
                    <br>


                    <label for="n_inv">How many invitations to make in one run</label>
                    <input type="number" name="n_inv" id="n_inv" class="form-control"
                           value="40">
                    <br>

                    <label for="f24"><?php echo $txtfarmi11 ?></label>
                    <input type="number" name="f24" id="f24" class="form-control"
                           placeholder="3" required>

                    <br>


                    <button class="btn btn-secondary" name="add_task" id="add_task" value="invite_to_group">ACTIVATE
                    </button>



                </form>
            </div>
        </div>
    </div>


</main>

