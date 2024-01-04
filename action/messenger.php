<?php
?>
<main class="container-fluid ">
    <div class="row text-center">
        <h2>Messenger</h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    Messenger
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" name = "pm" id="pm">
                        <label class="form-check-label" for="pm">
                            Parse messages
                        </label>
                    </div>
                    <br>


                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" name = "fa" id="fa">
                        <label class="form-check-label" for="fa">
                            Fast answer
                        </label>
                    </div>
                    <br>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" name = "mess_f" id="mess_f">
                        <label class="form-check-label" for="mess_f">
                            Message for friends
                        </label>
                    </div>
                    <br>
                    <br>
                    <label for="n_mess_f">Number messages</label>
                    <input type="n_mess_f" name="f24" id="f24" class="form-control"
                           value = "5">

                    <br>


                    <select class="form-select" id="mess_act" name="mess" aria-label="mess">

                        <option value="yes">Yes</option>
                        <option value="no">No</option>

                    </select>
                    <label for="2fa">Mode</label>

                    <br>
                    <br>

                    <button class="btn btn-secondary" name="add_task" id="add_task" value="2fa">ACTIVATE
                    </button>



                </form>
            </div>
        </div>
    </div>


</main>