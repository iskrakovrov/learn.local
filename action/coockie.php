<?php
$sql = 'SELECT * FROM lists WHERE cat = 8 OR cat = 9';
$qw = selectAll($sql);

?>

<main class="container-fluid ">
    <div class="row text-center">
        <h2>Farm cookies</h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    <?php echo $txtcook ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">


                    <label for="cat" class="control-label"><?php echo $txtcook3 ?></label>

                        <select name="cat" id="cat" class="form-control">
                            <?php
                            $i = 0;
                            foreach ($qw as $a) {
                                $i++; ?>
                                <option value="<?php echo $a['id'] ?>"><?php echo $a['name']; ?></option>
                            <?php } ?>
                        </select>

                        <br>


                        <label for="num_s"><?php echo $txtcook2 ?></label>
                        <input type="text" name="num_s" id="num_s" class="form-control" placeholder="10-20" pattern="([0-9]{1,3})-([0-9]{1,3})" required>


                        <br>
                        <br>

                            <button class="btn btn-secondary" name="add_task" id="add_task" value="coockie">ACTIVATE
                            </button>



                </form>
            </div>
        </div>
    </div>


</main>
