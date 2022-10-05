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
                    <?php echo $txtmail1 ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">





                    <select class="form-select" id="am" name="am" aria-label="Floating label select example">

                        <option value="yes">Yes</option>
                        <option value="no">No</option>

                    </select>
                    <label for="am"><?php echo $txtmail2 ?></label>

                        <br>
                        <br>

                            <button class="btn btn-secondary" name="add_task" id="add_task" value="add_mail">ACTIVATE
                            </button>



                </form>
            </div>
        </div>
    </div>


</main>