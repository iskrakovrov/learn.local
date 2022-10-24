<main class="container-fluid ">
    <div class="row text-center">
        <h2><?php echo $txterinv ?></h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    <?php echo $txterinv1 ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">


                    <br>


                    <label for="num_s"><?php echo $txterinv2 ?></label>
                    <input type="number" name="num_e" id="num_e" class="form-control" value="1000" required>


                    <br>
                    <br>

                    <button class="btn btn-secondary" name="add_task" id="add_task" value="erase_invite">ACTIVATE
                    </button>



                </form>
            </div>
        </div>
    </div>


</main>
