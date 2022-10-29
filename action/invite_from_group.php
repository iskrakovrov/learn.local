<?php
$sql = "SELECT * FROM lists WHERE cat = 2 OR cat = 9";
$geo1 = selectAll($sql);
$sql = "SELECT * FROM lists WHERE cat = 3 OR cat = 9";
$name1 = selectAll($sql);
$sql = "SELECT * FROM lists WHERE cat = 1 OR cat = 9";
$bl1 = selectAll($sql);
$sql = "SELECT * FROM lists WHERE cat = 10 OR cat = 9";
$gr1 = selectAll($sql);
?>

<main class="container-fluid ">
    <div class="row text-center">
        <h2><?php echo $txtglobali19 ?></h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    <?php echo $txtglobali17 ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">
                    <br>
                    <!-- Список групп -->
                    <label for="geo" class="control-label"><?php echo $txtinv31 ?></label>

                    <select name="gr" id="gr" class="form-control">
<option value="in"><?php echo $txtglobali18  ?></option>
                        <?php
                        $i = 0;
                        foreach ($gr1 as $r) {
                            $i++; ?>
                            <option value="<?php echo $r['id'] ?>"><?php echo $r['name']; ?></option>
                        <?php } ?>
                    </select>

                    <br>
                    <!-- количество инвайтов -->
                    <br>


                    <label for="num_i"><?php echo $txtnewacc4 ?></label>
                    <input type="number" name="num_i" id="num_i" class="form-control" value="20"
                           required>

                    <br>

                    <!-- Pause  -->

                    <label for="pause"><?php echo $txtnewacc5 ?></label>
                    <input type="text" name="pause" id="pause" class="form-control" value="5-10"
                           pattern="([0-9]{1,3})-([0-9]{1,3})" required>

                    <br>
<!-- Вид инвайтов-->
                    <label for="mode" class="control-label"><?php echo $txtinv31 ?></label>

                    <select name="mode" id="mode" class="form-control">
                        <option value="all">ALL</option>
                        <option value="post"><?php echo $txtglobali14 ?></option>
                        <option value="nyou"><?php echo $txtglobali15 ?></option>


                    </select>

                    <br>
                    <!-- ГЕО -->
                    <label for="geo" class="control-label"><?php echo $txtinv31 ?></label>

                    <select name="geo" id="geo" class="form-control">
                        <option value="all">ALL</option>
                        <?php
                        $i = 0;
                        foreach ($geo1 as $a) {
                            $i++; ?>
                            <option value="<?php echo $a['id'] ?>"><?php echo $a['name']; ?></option>
                        <?php } ?>
                    </select>

                    <br>

                    <!-- Фильтры -->

                    <label for="filter">Name filter</label>
                    <select class="form-select" id="filter" name="filter"
                            aria-label="Floating label select example">

                        <option value="all">All</option>
                        <option value="cyr">Cyr</option>
                        <option value="lat">Lat</option>
                        <option value="cl">Cyr + Lat</option>
                        <option value="black">Black</option>
                        <option value="white">White</option>
                        <option value="blackwhite">Black + White</option>
                    </select>
                    <br>
                    <!-- WL -->
                    <label for="wln" class="control-label"><?php echo $txtinv32 ?></label>

                    <select name="wln" id="wln" class="form-control">
                        <option value="all">ALL</option>
                        <?php
                        $i = 0;
                        foreach ($name1 as $d) {
                            $i++; ?>
                            <option value="<?php echo $d['id'] ?>"><?php echo $d['name']; ?></option>
                        <?php } ?>
                    </select>
                    <br>
                    <!-- BL -->
                    <label for="bln" class="control-label"><?php echo $txtinv33 ?></label>

                    <select name="bln" id="bln" class="form-control">
                        <option value="all">ALL</option>
                        <?php
                        $i = 0;
                        foreach ($name1 as $c) {
                            $i++; ?>
                            <option value="<?php echo $c['id'] ?>"><?php echo $c['name']; ?></option>
                        <?php } ?>
                    </select>
                    <br>
                    <!-- GBL -->
                    <label for="gbl" class="control-label"><?php echo $txtinv34 ?></label>

                    <select name="gbl" id="gbl" class="form-control">
                        <option value="no">No black list</option>
                        <?php
                        $i = 0;
                        foreach ($bl1 as $b) {
                            $i++; ?>
                            <option value="<?php echo $b['id'] ?>"><?php echo $b['name']; ?></option>
                        <?php } ?>
                    </select>
                    <br>


                    <!-- конфирм -->
                    <label for="confirm">Confirm or Cancel</label>
                    <select class="form-select" id="confirm" name="confirm">

                        <option value="1">Confirm</option>
                        <option value="2">Cancel</option>

                    </select>
                    <br>

                    <!-- количество конфирмов -->
                    <label for="num_co"><?php echo $txtnewacc6 ?></label>
                    <input type="number" name="num_co" id="num_co" class="form-control" value="5"
                           required>


                    <br>
                    <!-- раз в день -->
                    <label for="f24"><?php echo $txtfarmi11 ?></label>
                    <input type="number" name="f24" id="f24" class="form-control"
                           value="5" required>


                    <br>
                    <br>

                    <button class="btn btn-secondary" name="add_task" id="add_task" value="invite_from_group">ACTIVATE
                    </button>


                </form>
            </div>
        </div>
    </div>


</main>