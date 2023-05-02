<?php
?>
<main class="container-fluid ">
    <div class="row text-center">
        <h2>Add mail</h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    <?php echo $txttasks5 ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">





                    <select class="form-select" id="2fa" name="2fa" aria-label="2fa">

                        <option value="yes">Yes</option>
                        <option value="no">No</option>

                    </select>
                    <label for="2fa"><?php echo $txttasks6 ?></label>

                    <br>
                    <br>

                    <button class="btn btn-secondary" name="add_task" id="add_task" value="2fa">ACTIVATE
                    </button>



                </form>
            </div>
        </div>
    </div>


</main>
