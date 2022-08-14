<main class="container-fluid ">
    <div class="row text-center">
        <h2>Add task Farm cookies</h2>
    </div>
    <?php
    $sql = "SELECT * FROM lists WHERE cat = 8 OR cat = 9";
    $qw = selectAll($sql);

    ?>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    <?php echo $txtcook?>
                </div>


                <form method="post">
                    <div class="form-row justify-content-center">

                        <label for="cat" class="col-sm-6 control-label"><?php echo $txtcook3?></label>
                        <div class="col-sm-4 text-center">

                            <select name="cat" id="cat" class="form-control">
                                <?php
                                $i = 0;
                                foreach ($qw as $a) {
                                    $i++; ?>
                                    <option value="<?php echo $a['id'] ?>"><?php echo $a['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <br>
                        <div class="col-sm-4 text-center">
                            <div class="form-check">
                                <label for="num_s"><? echo $txtcook2?></label>
                                <input type="text" name="num_s" id="num_s" class="form-control" placeholder="5-10 required">
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="col-sm-4 text-center">
                            <button class="btn btn-secondary" name="add_task" id="add_task" value="coockie">ACTIVATE
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>


</main>
