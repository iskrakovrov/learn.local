<?php
$sql = 'SELECT * FROM lists WHERE cat = 10 OR cat = 9';
$qw = selectAll($sql);
$sql = 'SELECT * FROM lists WHERE cat = 7 OR cat = 9';
$qw1 = selectAll($sql);

?>

<main class="container-fluid ">
    <div class="row text-center">
        <h2><?php echo $$txttask30 ?></h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    <?php echo $txtparcegr1 ?>
                    <br>
                    One account processes up to 5 keywords per launch
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">

<br>
                    <label for="cat" class="control-label"><?php echo $txtparcegr1 ?></label>

                    <select name="cat" id="cat" class="form-control">
                        <?php
                        $i = 0;
                        foreach ($qw1 as $a) {
                            $i++; ?>
                            <option value="<?php echo $a['id'] ?>"><?php echo $a['name']; ?></option>
                        <?php } ?>
                    </select>
                    <br>
                    <label for="cat1" class="control-label"><?php echo $txtparcegr2 ?></label>

                    <select name="cat1" id="cat1" class="form-control">
                        <?php
                        $i = 0;
                        foreach ($qw as $b) {
                            $i++; ?>
                            <option value="<?php echo $b['id'] ?>"><?php echo $b['name']; ?></option>
                        <?php } ?>
                    </select>
                    <br>
                    <label for="num">Number of groups with one keyword</label>
                    <input type="number" name="num" id="num" class="form-control" value="1000"
                           max = 1500 required>
                    <br>
                    <br>
                    <button class="btn btn-secondary" name="add_task" id="add_task" value="parse_group">ACTIVATE
                    </button>



                </form>
            </div>
        </div>
    </div>


</main>

