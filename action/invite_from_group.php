<?php
$sql = "";
$qw = selectAll($sql);

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
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label for="groups"><?php echo $txtgr ?></label>
                    </div>
                </div>
                <br>


                <br>


                <button class="btn btn-secondary" name="add_task" id="add_task" value="login">ACTIVATE</button>


        </form>
    </div>


</main>
