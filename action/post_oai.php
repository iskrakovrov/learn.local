<?php
$sql = 'SELECT * FROM lists WHERE cat = 11';
$qw = selectAll($sql);
$sql = 'SELECT * FROM lists WHERE cat = 12';
$qw1 = selectAll($sql);

?>

<main class="container-fluid ">
    <div class="row text-center">
        <h2>Posting Open_AI</h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    <?php echo 'Posting Open_AI' ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">



                    <label for="promt" class="control-label"><?php echo 'Promts list' ?></label>

                    <select name="promt" id="promt" class="form-control">
                        <?php
                        $i = 0;
                        foreach ($qw1 as $b) {
                            $i++; ?>
                            <option value="<?php echo $b['id'] ?>"><?php echo $b['name']; ?></option>
                        <?php } ?>
                    </select>

                    <br>
                    <label for="img"><?php echo 'Folder random IMG' ?></label>
                    <input type="text" name="img" id="img" class="form-control">
                    <br>

                    <br>
                    <label for="f24"><?php echo $txtfarmi11 ?></label>
                    <input type="number" name="f24" id="f24" class="form-control"
                           value = "5">

                    <br>
                    <br>

                    <button class="btn btn-secondary" name="add_task" id="add_task" value="post_oai">ACTIVATE
                    </button>


                </form>
            </div>
        </div>
    </div>


</main>