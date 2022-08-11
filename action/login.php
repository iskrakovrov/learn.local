<main class="container-fluid ">
    <div class="row text-center">
        <h2>Add task</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">


            <div class="alert alert-info" role="alert">
                <?echo $txtlogin?>
            </div>
            

            <div class="row d-flex justify-content-center">
                <form method="post">
                    <div class="form-group">
                        <div class="form-check col-sm-4 text-center">
                            <input class="form-check-input" name="action[0]" type="checkbox" value="sbor"
                                   id="action[0]">
                            <label class="form-check-label" for="action[0]">
                                <?echo $txtlogin1?>
                            </label>
                        </div>
                        <div class="form-check col-sm-4 text-center">
                            <input class="form-check-input" name="action[1]" type="checkbox" value="delphone"
                                   id="action[1]">
                            <label class="form-check-label" for="action[1]">
                                <?echo $txtlogin2?>
                            </label>
                        </div>
                        <div class="form-check col-sm-4 text-center">
                            <input class="form-check-input" name="action[2]" type="checkbox" value="smart"
                                   id="action[2]">
                            <label class="form-check-label" for="action[2]">
                                <?echo $txtlogin3?>
                            </label>
                        </div>
                        <div class="form-check col-sm-4 text-center">
                            <input class="form-check-input" name="action[3]" type="checkbox" value="tock"
                                   id="action[3]">
                            <label class="form-check-label" for="action[3]">
                                <?echo $txtlogin4?>
                            </label>
                        </div>
                        <div class="form-check col-sm-4 text-center">
                            <label class="form-check-label" for="action[4]">
                                <?echo $txtlogin5?>
                            </label>
                            <input class="form-control" name="action[4]" type="text" id="action[4]">

                        </div>
                        <div class="form-check col-sm-4 text-center">
                            <label class="form-check-label" for="action[5]">
                                <?echo $txtlogin6?>
                            </label>
                            <input class="form-control" name="action[5]" type="text" id="action[5]">

                        </div>
                        <div class="form-check col-sm-4 text-center">
                            <label class="form-check-label" for="action[6]">
                                <?echo $txtlogin7?>
                            </label>
                            <input class="form-control" name="action[6]" type="text" id="action[6]">

                        </div>
                        <div class="form-check col-sm-4 text-center">
                            <label class="form-check-label" for="action[7]">
                                <?echo $txtlogin8?>
                            </label>
                            <input class="form-control" name="action[7]" type="text" id="action[7]">

                        </div>
                        <div class="form-check col-sm-4 text-center">
                            <label class="form-check-label" for="action[8]">
                                <?echo $txtlogin9?>
                            </label>
                            <input class="form-control" name="action[8]" type="text" id="action[8]">

                        </div>
                        <br>


                        <button class="btn btn-secondary" name="add_task" id="add_task" value="login">ACTIVATE</button>


                </form>
            </div>


</main>
