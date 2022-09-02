<main class="container-fluid ">
    <div class="row text-center">
        <h2>Add task</h2>
    </div>
    <?php
    $sql = "SELECT * FROM lists WHERE cat = 7 OR cat = 9";
    $qw = selectAll($sql);
    if (empty($qw)) {
        echo "нет";

    }
    ?>


    <div class="row d-flex justify-content-center">
        <div class="col-6 text-center">


            <div class="alert alert-info" role="alert">
                <?php echo $txtfarmi1 ?>
            </div>


            <form method="post">
                <div class="form-row justify-content-center">

                    <label for="cat" class="col-sm-6 control-label"><?php echo $txtfarmi2 ?></label>
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
                            <input class="form-check-input" name="like_page" type="checkbox" value="like_page"
                                   id="like_page">
                            <label class="form-check-label" for="like_page">
                                <?php echo $txtfarmi3 ?>
                            </label>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-4 text-center">
                        <div class="form-check">
                            <label for="num_lp"><?php echo $txtfarmi4 ?></label>
                            <input type="text" name="num_lp" id="num_lp" class="form-control" placeholder="2-3">
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-4 text-center">
                        <div class="form-check">
                            <input class="form-check-input" name="like_gr" type="checkbox" value="like_gr"
                                   id="like_gr">
                            <label class="form-check-label" for="like_gr">
                                <?php echo $txtfarmi5 ?>
                            </label>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-4 text-center">
                        <div class="form-check">
                            <label for="num_gr"><?php echo $txtfarmi6 ?></label>
                            <input type="text" name="num_gr" id="num_gr" class="form-control" placeholder="2-3">
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-4 text-center">
                        <div class="form-check">
                            <input class="form-check-input" name="feed" type="checkbox" value="feed"
                                   id="feed">
                            <label class="form-check-label" for="feed">
                                <?php echo $txtfarmi7 ?>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-4 text-center">
                        <div class="form-check">
                            <label for="num_l"><?php echo $txtfarmi8 ?></label>
                            <input type="text" name="num_l" id="num_l" class="form-control" placeholder="4-5">
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-4 text-center">
                        <div class="form-check">
                            <input class="form-check-input" name="like_adv" type="checkbox" value="like_adv"
                                   id="like_adv">
                            <label class="form-check-label" for="like_adv">
                                <?php echo $txtfarmi9 ?>
                            </label>
                        </div>
                    </div>

                    <div class="col-sm-4 text-center">
                        <div class="form-check">
                            <label for="p_like_adv"><?php echo $txtfarmi10 ?></label>
                            <input type="text" name="p_like_adv" id="p_like_adv" class="form-control"
                                   placeholder="30">
                        </div>
                    </div>
                    <div class="col-sm-4 text-center">
                        <div class="form-check">
                            <label for="f24"><?php echo $txtfarmi11 ?></label>
                            <input type="text" name="f24" id="f24" class="form-control"
                                   placeholder="3">
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-4 text-center">
                        <button class="btn btn-secondary" name="add_task" id="add_task" value="farm">ACTIVATE
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>


</main>
