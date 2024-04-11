<main class="container-fluid ">
    <div class="row text-center">
        <h2>Collecting messages from the messenger</h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    Set the mode. Choose whether to mark messages as viewed.
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">


                    <label for="vm" class="control-label">Mark messages as read?</label>

                    <select name="vm" id="cat" class="form-control">
                        <option value="1">Yes</option>
                        <option value="2">No</option>
                                         </select>

                    <br>
                    <label for="f24"><?php echo $txtfarmi11 ?></label>
                    <input type="number" name="f24" id="f24" class="form-control"
                           value="1" required>


                    <br>



                    <button class="btn btn-secondary" name="add_task" id="add_task" value="mess_sbor">ACTIVATE
                    </button>



                </form>
            </div>
        </div>
    </div>


</main>

