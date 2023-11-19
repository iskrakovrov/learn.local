<?php
$sql = 'SELECT * FROM lists WHERE cat = 5';
$qw = selectAll($sql);

?>

<main class="container-fluid ">
    <div class="row text-center">
        <h2>Follow profiles</h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    Follow profiles.  Select URL list
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">


                    <label for="cat" class="control-label">List accounts for following</label>

                    <select name="cat" id="cat" class="form-control">
                        <?php
                        $i = 0;
                        foreach ($qw as $a) {
                            $i++; ?>
                            <option value="<?php echo $a['id'] ?>"><?php echo $a['name']; ?></option>
                        <?php } ?>
                    </select>

                    <br>


                    <button class="btn btn-secondary" name="add_task" id="add_task" value="follow_profile">ACTIVATE
                    </button>



                </form>
            </div>
        </div>
    </div>


</main>

