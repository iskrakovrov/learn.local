<?php
?>
<main class="container-fluid ">
    <div class="row text-center">
        <h2>Reg Instagram</h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    Instagram
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">


                    <br>

                    <label for="сm">Change mail?</label>


                    <select class="form-select" id="cm" name="cm" aria-label="Floating label select example">

                        <option value="yes">Change mail</option>
                        <option value="no">No change mail</option>

                    </select>



                    <br>
                    <label for="f24"><?php echo $txtfarmi11 ?></label>
                    <input type="number" name="f24" id="f24" class="form-control"
                           value = "1">

                    <br>
                    <br>

                    <button class="btn btn-secondary" name="add_task" id="add_task" value="instagram">ACTIVATE
                    </button>



                </form>
            </div>
        </div>
    </div>


</main>
