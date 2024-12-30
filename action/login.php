<main class="container-fluid ">
    <div class="row text-center">
        <h2>LOGIN</h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    <?php echo $txtlogin ?>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">

               <input class="form-check-input" name="action[17]" type="checkbox" value="per"
                             id="action[17]">
                    <label class="form-check-label" for="action[17]">
                        Switch the account language to English for the program to work correctly
                    </label>


                    <!-- Ручной режим -->

                    <br>


                    <input class="form-check-input" name="action[16]" type="checkbox" value="hand"
                           id="action[16]">
                    <label class="form-check-label" for="action[16]">
                        <?php echo $txtlogin40 ?>
                    </label>

                    <br>

            <!-- Сбор информации одноразово -->

                    <input class="form-check-input" name="action[0]" type="checkbox" value="sbor"
                           id="action[0]">
                    <label class="form-check-label" for="action[0]">
                        <?php echo $txtlogin1 ?>
                    </label>

                <br>
                <!-- Удалять телефон -->

                    <input class="form-check-input" name="action[1]" type="checkbox" value="delphone"
                           id="action[1]">
                    <label class="form-check-label" for="action[1]">
                        <?php echo $txtlogin2 ?>
                    </label>

                <br>
                <!-- Быстрый логин -->

                    <input class="form-check-input" name="action[2]" type="checkbox" value="smart"
                           id="action[2]">
                    <label class="form-check-label" for="action[2]">
                        <?php echo $txtlogin3 ?>
                    </label>

                <br>
                <!-- Собрать Токен -->

                    <input class="form-check-input" name="action[3]" type="checkbox"
                           id="action[3]" value="tock">
                    <label class="form-check-label" for="action[3]">
                        <?php echo $txtlogin4 ?>
                    </label>

                <br>
                <!-- Макс инвайтов -->

                    <label class="form-check-label" for="action[4]">
                        <?php echo $txtlogin5 ?>
                    </label>
                    <input class="form-control" name="action[4]" type="number" id="action[4]" value ="150">

                <br>
                <!-- Макс принятий -->

                    <label class="form-check-label" for="action[5]">
                        <?php echo $txtlogin11 ?>
                    </label>
                    <input class="form-control" name="action[5]" type="number" id="action[5]" value="200">

                <br>
                <!-- Макс лайков -->

                    <label class="form-check-label" for="action[6]">
                        <?php echo $txtlogin6 ?>
                    </label>
                    <input class="form-control" name="action[6]" type="number" id="action[6]" value="50">

                <br>
                <!-- Макс комментариев -->

                    <label class="form-check-label" for="action[7]">
                        <?php echo $txtlogin7 ?>
                    </label>
                    <input class="form-control" name="action[7]" type="number" id="action[7]" value="50">

                <br>
                <!-- Макс лички -->

                    <label class="form-check-label" for="action[8]">
                        <?php echo $txtlogin8 ?>
                    </label>
                    <input class="form-control" name="action[8]" type="number" id="action[8]" value="20">

                <br>
                <!-- Время до запуска -->

                    <label class="form-check-label" for="action[9]">
                        <?php echo $txtlogin9 ?>
                    </label>
                    <input class="form-control" name="action[9]" type="number" id="action[9]" value="180" required>

                <br>

                <!-- Можно без прокси -->


                    <input class="form-check-input" name="action[10]" type="checkbox"
                           id="action[10]" style="display:none">


                    <br>

                <!-- GET -->

                    <label class="form-check-label" for="action[11]">
                        GET
                    </label>
                    <input class="form-control" name="action[11]" type="text" id="action[11]">

                <br>
                <!-- bat -->

                    <input class="form-check-input" name="action[12]" type="checkbox"
                           id="action[12]">
                    <label class="form-check-label" for="action[12]">
                        <?php echo $txtlogin12 ?>
                    </label>

                    <br>
                    <!-- ava -->

                    <input class="form-check-input" name="action[13]" type="checkbox"
                           id="action[13]">
                    <label class="form-check-label" for="action[13]">
                        <?php echo $txtlogin13 ?>
                    </label>
                <br>
                    <br>

                            <label for="floatingSelect"><?php echo $txtlogin14 ?></label>
                            <select class="form-select" id="action[14]" name="action[14]" aria-label="Floating label select example">

                                <option value="male">Male</option>
                                <option value="female">Female</option>


                            </select>

                    <br>

                    <input class="form-check-input" name="action[18]" type="checkbox"
                           id="action[18]" value="groups">
                    <label class="form-check-label" for="action[18]">
                        Collect the list of groups once
                    </label>
                    <br>
                    <!-- Время после работы -->

                    <label class="form-check-label" for="action[15]">
                        <?php echo $txtlogin15 ?>
                    </label>
                    <input class="form-control" name="action[15]" type="number" id="action[15]" value="3" required>

                    <br>

                <button class="btn btn-secondary" name="add_task" id="add_task" value="login">ACTIVATE</button>


                </form>
            </div>
        </div>
    </div>

</main>
