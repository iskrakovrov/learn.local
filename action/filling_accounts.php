<?php
$sql = "SELECT * FROM lists WHERE cat = 2 OR cat = 9 LIMIT 500";
$csity = selectAll($sql);
$sql = "SELECT * FROM lists WHERE  cat = 9 LIMIT 500";
$edu = selectAll($sql);
$sql = "SELECT * FROM lists WHERE  cat = 9 LIMIT 500";
$work = selectAll($sql);
$sql = "SELECT * FROM lists WHERE  cat = 3 LIMIT 500";
$fname = selectAll($sql);
$sql = "SELECT * FROM lists WHERE  cat = 3 LIMIT 500";
$lname = selectAll($sql);
?>
<main class="container-fluid ">
    <div class="row text-center">
        <h2><?php echo $txtmen ?></h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    <?php echo $txtfill ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">

<!-- Город рождения и проживания -->
                    <label for="currc" class="control-label"><?php echo $txtfill2 ?></label>

                    <select name="currc" id="currc" class="form-control">
                        <option value="no"><?php echo $txtfill5 ?></option>
                        <?php
                        $i = 0;
                        foreach ($csity as $a) {
                            $i++; ?>
                            <option value="<?php echo $a['id'] ?>"><?php echo $a['name']; ?></option>
                        <?php } ?>
                    </select>

                    <br>
                    <label for="cat" class="control-label"><?php echo $txtfill4 ?></label>

                    <!-- Место учебы -->
                    <select name="edu" id="edu" class="form-control">
                        <option value="no"><?php echo $txtfill5 ?></option>
                        <?php
                        $i = 0;
                        foreach ($edu as $b) {
                            $i++; ?>
                            <option value="<?php echo $b['id'] ?>"><?php echo $b['name']; ?></option>
                        <?php } ?>
                    </select>
                    <br>
                    <label for="work" class="control-label"><?php echo $txtfill3 ?></label>
                    <!-- Место работы -->
                    <select name="work" id="work" class="form-control">
                        <option value="no"><?php echo $txtfill5 ?></option>
                        <?php
                        $i = 0;
                        foreach ($work as $c) {
                            $i++; ?>
                            <option value="<?php echo $c['id'] ?>"><?php echo $c['name']; ?></option>
                        <?php } ?>
                    </select>
                    <label for="fname" class="control-label">First name</label>
                    <!-- Имя -->
                    <select name="fname" id="fname" class="form-control">
                        <option value="no"><?php echo $txtfill5 ?></option>
                        <?php
                        $i = 0;
                        foreach ($fname as $e) {
                            $i++; ?>
                            <option value="<?php echo $e['id'] ?>"><?php echo $e['name']; ?></option>
                        <?php } ?>
                    </select>
                    <label for="lname" class="control-label">Last name</label>
                    <!-- Фамилия -->
                    <select name="lname" id="work" class="form-control">
                        <option value="no"><?php echo $txtfill5 ?></option>
                        <?php
                        $i = 0;
                        foreach ($lname as $d) {
                            $i++; ?>
                            <option value="<?php echo $d['id'] ?>"><?php echo $d['name']; ?></option>
                        <?php } ?>
                    </select>

                    <br>
                    <br>

                    <button class="btn btn-secondary" name="add_task" id="add_task" value="filling_accounts">ACTIVATE
                    </button>



                </form>
            </div>
        </div>
    </div>


</main>
