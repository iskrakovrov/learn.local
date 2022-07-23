<main class="container-fluid ">
    <div class="row text-center">
        <h2>Add task</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">


            <div class="alert alert-info" role="alert">
                Выберите опции логина.
            </div>
            

            <div class="row d-flex justify-content-center">
                <form method="post">
                    <div class="form-group">
                        <div class="form-check col-sm-4 text-center">
                            <input class="form-check-input" name="action[0]" type="checkbox" value="sbor"
                                   id="action[0]">
                            <label class="form-check-label" for="action[0]">
                                Сбор информации одноразово
                            </label>
                        </div>
                        <div class="form-check col-sm-4 text-center">
                            <input class="form-check-input" name="action[1]" type="checkbox" value="delphone"
                                   id="action[1]">
                            <label class="form-check-label" for="action[1]">
                                Удалять телефон если подключена почта
                            </label>
                        </div>
                        <div class="form-check col-sm-4 text-center">
                            <input class="form-check-input" name="action[2]" type="checkbox" value="smart"
                                   id="action[2]">
                            <label class="form-check-label" for="action[2]">
                                Быстрый логин (без определения и прохождения бана)
                            </label>
                        </div>
                        <div class="form-check col-sm-4 text-center">
                            <input class="form-check-input" name="action[3]" type="checkbox" value="tock"
                                   id="action[3]">
                            <label class="form-check-label" for="action[3]">
                                Сбор токена
                            </label>
                        </div>
                        <div class="form-check col-sm-4 text-center">
                            <label class="form-check-label" for="action[4]">
                                Максимум invite за 24 часа
                            </label>
                            <input class="form-control" name="action[4]" type="text" id="action[4]">

                        </div>
                        <div class="form-check col-sm-4 text-center">
                            <label class="form-check-label" for="action[5]">
                                Максимум like за 24 часа
                            </label>
                            <input class="form-control" name="action[5]" type="text" id="action[5]">

                        </div>
                        <div class="form-check col-sm-4 text-center">
                            <label class="form-check-label" for="action[6]">
                                Максимум комментариев за 24 часа
                            </label>
                            <input class="form-control" name="action[6]" type="text" id="action[6]">

                        </div>
                        <div class="form-check col-sm-4 text-center">
                            <label class="form-check-label" for="action[7]">
                                Максимум личных сообщений за 24 часа
                            </label>
                            <input class="form-control" name="action[7]" type="text" id="action[7]">

                        </div>
                        <div class="form-check col-sm-4 text-center">
                            <label class="form-check-label" for="action[8]">
                                Ззапуск задач не раньше чем через секунд после предыдущей
                            </label>
                            <input class="form-control" name="action[8]" type="text" id="action[8]">

                        </div>
                        <br>


                        <button class="btn btn-secondary" name="add_task" id="add_task" value="login">ACTIVATE</button>


                </form>
            </div>


</main>
