<main class="container-fluid ">
    <div class="row text-center">
        <h2>Add task</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">


            <div class="alert alert-info" role="alert">
                <?php echo $txtlogin ?>
            </div>


            <div class="row d-flex justify-content-center">
                <form method="post">

                    <!-- Сбор информации одноразово -->
                    <div class="form-group">
                        <div class="form-check col-sm-4 text-center">
                            <input class="form-check-input" name="action[0]" type="checkbox" value="sbor"
                                   id="action[0]">
                            <label class="form-check-label" for="action[0]">
                                <?php echo $txtlogin1 ?>
                            </label>
                        </div>
                        <!-- Удалять телефон -->
                        <div class="form-check col-sm-4 text-center">
                            <input class="form-check-input" name="action[1]" type="checkbox" value="delphone"
                                   id="action[1]">
                            <label class="form-check-label" for="action[1]">
                                <?php echo $txtlogin2 ?>
                            </label>
                        </div>
                        <!-- Быстрый логин -->
                        <div class="form-check col-sm-4 text-center">
                            <input class="form-check-input" name="action[2]" type="checkbox" value="smart"
                                   id="action[2]">
                            <label class="form-check-label" for="action[2]">
                                <?php echo $txtlogin3 ?>
                            </label>
                        </div>
                        <!-- Собрать Токен -->
                        <div class="form-check col-sm-4 text-center">
                            <input class="form-check-input" name="action[3]" type="checkbox" value="tock"
                                   id="action[3]">
                            <label class="form-check-label" for="action[3]">
                                <?php echo $txtlogin4 ?>
                            </label>
                        </div>
                        <!-- Макс инвайтов -->
                        <div class="form-check col-sm-4 text-center">
                            <label class="form-check-label" for="action[4]">
                                <?php echo $txtlogin5 ?>
                            </label>
                            <input class="form-control" name="action[4]" type="number" id="action[4]">

                        </div>
                        <!-- Макс инвайтов -->
                        <div class="form-check col-sm-4 text-center">
                            <label class="form-check-label" for="action[4]">
                                <?php echo $txtlogin5 ?>
                            </label>
                            <input class="form-control" name="action[4]" type="number" id="action[4]">

                        </div>
                        <!-- Макс лайков -->
                        <div class="form-check col-sm-4 text-center">
                            <label class="form-check-label" for="action[5]">
                                <?php echo $txtlogin6 ?>
                            </label>
                            <input class="form-control" name="action[5]" type="number" id="action[5]">

                        </div>
                        <!-- Макс комментариев -->
                        <div class="form-check col-sm-4 text-center">
                            <label class="form-check-label" for="action[6]">
                                <?php echo $txtlogin7 ?>
                            </label>
                            <input class="form-control" name="action[6]" type="number" id="action[6]">

                        </div>
                        <!-- Макс лички -->
                        <div class="form-check col-sm-4 text-center">
                            <label class="form-check-label" for="action[7]">
                                <?php echo $txtlogin8 ?>
                            </label>
                            <input class="form-control" name="action[7]" type="number" id="action[7]">

                        </div>
                        <!-- Время до запуска -->
                        <div class="form-check col-sm-4 text-center">
                            <label class="form-check-label" for="action[8]">
                                <?php echo $txtlogin9 ?>
                            </label>
                            <input class="form-control" name="action[8]" type="number" id="action[8]">

                        </div>

                        <!-- Можно без прокси -->

                            <div class="form-check col-sm-4 text-center">
                                <input class="form-check-input" name="action[9]" type="checkbox" value="noproxy"
                                       id="action[9]">
                                <label class="form-check-label" for="action[9]">
                                    <?php echo $txtlogin10 ?>
                                </label>
                            </div>




                        <!-- GET -->
                        <div class="form-check col-sm-4 text-center">
                            <label class="form-check-label" for="action[10]">
                                <?php echo $txtlogin11 ?>
                            </label>
                            <input class="form-control" name="action[10]" type="text" id="action[10]">

                        </div>
                        <!-- bat -->
                        <div class="form-check col-sm-4 text-center">
                            <input class="form-check-input" name="action[11]" type="checkbox" value="bat"
                                   id="action[11]">
                            <label class="form-check-label" for="action[11]">
                                <?php echo $txtlogin12 ?>
                            </label>
                        </div>

                        <br>


                        <button class="btn btn-secondary" name="add_task" id="add_task" value="login">ACTIVATE</button>


                </form>
            </div>


</main>
