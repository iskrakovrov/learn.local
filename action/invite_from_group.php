<?php
$sql = "SELECT * FROM lists WHERE cat = 2 OR cat = 9";
$geo = selectAll($sql);
$sql = "SELECT * FROM lists WHERE cat = 10 OR cat = 9";
$gr = selectAll($sql);
$sql = "SELECT * FROM lists WHERE cat = 1 OR cat = 9";
$bl = selectAll($sql);

?>
<main class="container-fluid ">
    <div class="row text-center">
        <h2><?php echo $txtifg1 ?></h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <div class="alert alert-info" role="alert">
                <?php echo $txtifg2 ?>
            </div>
        </div>
    </div>


    <div class="row d-flex justify-content-center">
        <form method="post">
            <div class="form-group">
                <div class="form-check col-sm-4 text-center">
                    <div class="form-floating">
                        <select class="form-select" id="groups" name="groups"
                                aria-label="<?php echo $txtgr ?>">

                            <?php foreach ($gr as $a) { ?>

                                <option value="<?php echo $a['id'] ?>"><?php echo $a['name'] ?></option>
                            <?php } ?>
                        </select>
                        <label for="groups"><?php echo $txtgr ?></label>
                    </div>
                </div>
                <br>
                <div class="form-check col-sm-4 text-center">
                    <div class="form-floating">
                        <select class="form-select" id="type" name="type"
                                aria-label="<?php echo $txtgr ?>">

                            <option value="1">ALL</option>
                            <option value="2">Active</option>
                        </select>
                        <label for="groups"><?php echo $txtigr ?></label>
                    </div>
                </div>
                <br>
                <div class="form-check col-sm-4 text-center">
                    <div class="form-floating">
                        <select class="form-select" id="type" name="type"
                                aria-label="<?php echo $txtgr ?>">
                            <option value="0">ALL</option>
                            <?php foreach ($geo as $g) { ?>
                                <option value="<?php echo $g['id'] ?>"><?php echo $g['name'] ?></option>
                            <?php } ?>
                        </select>
                        <label for="groups"><?php echo $txtgeo ?></label>
                    </div>
                </div>
                <br>
                <div class="form-check col-sm-4 text-center">
                    <div class="form-floating">
                        <select class="form-select" id="bl" name="bl"
                                aria-label="<?php echo $txtbl ?>">
                            <option value="0">No Black list</option>
                            <?php foreach ($bl as $b) { ?>
                                <option value="<?php echo $b['id'] ?>"><?php echo $b['name'] ?></option>
                            <?php } ?>
                        </select>
                        <label for="groups"><?php echo $txtbl ?></label>
                    </div>
                </div>
                <br>
                <div class="col-sm-4 text-center">
                    <div class="form-check">
                        <!-- Инвайтов в день -->
                        <label for="num_i"><?php echo $txtgri1 ?></label>
                        <input type="text" name="num_i" id="num_i" class="form-control" placeholder="50-80">
                    </div>
                </div>
                <br>
                <div class="col-sm-4 text-center">
                    <div class="form-check">
                        <!--                        Инвайтов за раз -->
                        <label for="num_i"><?php echo $txtgri1 ?></label>
                        <input type="text" name="num_i" id="num_i" class="form-control" placeholder="50-80">
                    </div>
                </div>
                <br>


                <button class="btn btn-secondary" name="add_task" id="add_task" value="invite_from_group">ACTIVATE
                </button>


        </form>

</main>


