<?php
$sql = "SELECT * FROM lists WHERE cat = 7 OR cat = 9";
$qw = selectAll($sql);
?>

<main class="container-fluid ">
    <div class="row text-center">
        <h2><?php echo $txtfarmi0 ?></h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    <?php echo $txtfarmi1 ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">


                    <label for="cat" class="control-label"><?php echo $txtfarmi2 ?></label>


                    <select name="cat" id="cat" class="form-control">
                        <?php
                        $i = 0;
                        foreach ($qw as $a) {
                            $i++; ?>
                            <option value="<?php echo $a['id'] ?>"><?php echo $a['name']; ?></option>
                        <?php } ?>
                    </select>

                    <br>

                    <input class="form-check-input" name="like_page" type="checkbox" value="like_page"
                           id="like_page">
                    <label class="form-check-label" for="like_page">
                        <?php echo $txtfarmi3 ?>
                    </label>
                    <br>
                    <br>

                    <label for="num_lp"><?php echo $txtfarmi4 ?></label>
                    <input type="text" name="num_lp" id="num_lp" class="form-control" value = "2-3" pattern="([0-9]{1,3})-([0-9]{1,3})" >

                    <br>

                    <input class="form-check-input" name="like_gr" type="checkbox" value="like_gr"
                           id="like_gr">
                    <label class="form-check-label" for="like_gr">
                        <?php echo $txtfarmi5 ?>
                    </label>
                    <br>
                    <br>

                    <label for="num_gr"><?php echo $txtfarmi6 ?></label>
                    <input type="text" name="num_gr" id="num_gr" class="form-control" value = "2-3" pattern="([0-9]{1,3})-([0-9]{1,3})" >

                    <br>


                    <input class="form-check-input" name="feed" type="checkbox" value="feed"
                           id="feed">
                    <label class="form-check-label" for="feed">
                        <?php echo $txtfarmi7 ?>
                    </label>
                    <br>
                    <br>
                    <label for="num_l"><?php echo $txtfarmi8 ?></label>
                    <input type="text" name="num_l" id="num_l" class="form-control" value = "4-5" pattern="([0-9]{1,3})-([0-9]{1,3})" >

                    <br>

                    <input class="form-check-input" name="like_adv" type="checkbox" value="like_adv"
                           id="like_adv">
                    <label class="form-check-label" for="like_adv">
                        <?php echo $txtfarmi9 ?>
                    </label>
                    <br>

                    <br>
                    <label for="p_like_adv"><?php echo $txtfarmi10 ?></label>
                    <input type="number" name="p_like_adv" id="p_like_adv" class="form-control"
                           value = "30" required>

                    <br>
                    <label for="f24"><?php echo $txtfarmi11 ?></label>
                    <input type="number" name="f24" id="f24" class="form-control"
                           value = "5">

                    <br>

                    <button class="btn btn-secondary" name="add_task" id="add_task" value="farm">ACTIVATE
                    </button>


                </form>
            </div>
        </div>


</main>
