<?php
$sql = 'SELECT * FROM lists WHERE cat = 10 OR cat = 9';
$qw = selectAll($sql);

?>

<main class="container-fluid ">
    <div class="row text-center">
        <h2><?php echo $txtipage ?></h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    <?php echo $txtipage1 ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">


                    <label for="cat" class="control-label"><?php echo $txtipage2 ?></label>

                    <select name="cat" id="cat" class="form-control">
                        <?php
                        $i = 0;
                        foreach ($qw as $a) {
                            $i++; ?>
                            <option value="<?php echo $a['id'] ?>"><?php echo $a['name']; ?></option>
                        <?php } ?>
                    </select>

                    <br>

                    <label for="mode" class="control-label"><?php echo $txtipage3 ?></label>
                    <select class="form-select" id="mode" name="mode" aria-label="mode">

                        <option value="all">All</option>
                        <option value="obo">One by one</option>

                    </select>
                    <br>
                    <label for="num_i"><?php echo $txtipage4 ?></label>
                    <input type="number" name="num_i" id="num_i" class="form-control"
                           placeholder="100">

                    <br>

                    <label for="f24"><?php echo $txtfarmi11 ?></label>
                    <input type="number" name="f24" id="f24" class="form-control"
                           placeholder="3" required>

                    <br>


                    <button class="btn btn-secondary" name="add_task" id="add_task" value="page_invite">ACTIVATE
                    </button>



                </form>
            </div>
        </div>
    </div>


</main>

