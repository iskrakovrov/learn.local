<?php
$sql = "SELECT * FROM lists WHERE cat = 2 OR cat = 9";
$qw = selectAll($sql);

$sql = "SELECT * FROM lists WHERE cat = 3 OR cat = 9";
$qw1 = selectAll($sql);

?>


<main class="container-fluid ">
    <div class="row text-center">
        <h2><?php echo $txtass ?> </h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    <?php echo $txtass1 ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">
                    <label for="cat" class="control-label"><?php echo $txtgeo ?></label> <!-- Выбрать ГЕО -->
                    <select name="cat" id="cat" class="form-control">
                        <option value="0">All</option>
                        <?php
                        $i = 0;
                        foreach ($qw as $a) {
                            $i++; ?>
                            <option value="<?php echo $a['id'] ?>"><?php echo $a['name']; ?></option>
                        <?php } ?>
                    </select>
                    <br>
                    <label for="filter" class="control-label"><?php echo $txtfilter2 ?></label>
                    <select class="form-select" id="filter" name="filter" aria-label="filter">

                        <option value="all">All</option>
                        <option value="cyr">Cyr</option>
                        <option value="lat">Lat</option>
                        <option value="cl">Cyr + Lat</option>
                        <option value="black">Black</option>
                        <option value="white">White</option>
                        <option value="blackwhite">Black + White</option>
                    </select>
                    <br>
                    <label for="black" class="control-label">Black list</label> <!-- Блек -->
                    <select name="black" id="cat" class="form-control">
                        <option value="0">No</option>
                        <?php
                        $i = 0;
                        foreach ($qw1 as $b) {
                            $i++; ?>
                            <option value="<?php echo $b['id'] ?>"><?php echo $b['name']; ?></option>
                        <?php } ?>
                    </select>
                    <br>
                    <label for="white" class="control-label">White list</label> <!-- Вайт -->
                    <select name="white" id="white" class="form-control">
                        <option value="0">No</option>
                        <?php
                        $i = 0;
                        foreach ($qw1 as $c) {
                            $i++; ?>
                            <option value="<?php echo $c['id'] ?>"><?php echo $c['name']; ?></option>
                        <?php } ?>
                    </select>
                    <br>


                    <label for="one_s"><?php echo $txtass2 ?></label>
                    <input type="text" name="one_s" id="one_s" class="form-control"
                           placeholder="10-20" pattern="([0-9]{1,3})-([0-9]{1,3})" required>
                    <br>
                    <label for="pause"><?php echo $txtpause ?></label>
                    <input type="text" name="pause" id="pause" class="form-control"
                           placeholder="3-4" pattern="([0-9]{1,3})-([0-9]{1,3})" required>
                    <br>


                    <label for="f24"><?php echo $txtfarmi11 ?></label>
                    <input type="number" name="f24" id="f24" class="form-control"
                           placeholder="3" required>


                    <br>

                    <button class="btn btn-secondary" name="add_task" id="add_task" value="accept_friend">ACTIVATE
                    </button>


            </div>

            </form>

        </div>
    </div>
</main>
