<main class="container-fluid ">
    <div class="row text-center">
        <h2>Add task</h2>
    </div>
    <?php
    $sql = "SELECT * FROM lists WHERE cat = 7";
    $qw = selectAll($sql);
if (empty($qw)) {
    echo "нет";

}
    ?>


        <div class="row d-flex justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    Выберите опции для фарма кук
                </div>


                <form method="post">
                    <div class="form-row justify-content-center">

                        <label for="cat" class="col-sm-6 control-label">Your keywords</label>
                        <div class="col-sm-4 text-center">

                            <select name="cat" id="cat" class="form-control">
                                <?php
                                $i = 0;
                                foreach ($qw as $a) {
                                    $i++; ?>
                                    <option value="<?php echo $a['id'] ?>"><?php echo $a['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <br>
                        <div class="col-sm-4 text-center">
                            <div class="form-check">
                                <input class="form-check-input" name="like_page" type="checkbox" value="like_page"
                                       id="like_page">
                                <label class="form-check-label" for="like_page">
                                    Подписываться на страницы
                                </label>
                            </div>
                        </div>
                        <br>
                        <div class="col-sm-4 text-center">
                            <div class="form-check">
                                <label for="num_lp">Количество страниц</label>
                                <input type="text" name="num_lp" id="num_lp" class="form-control" placeholder="2-3">
                            </div>
                        </div>
                        <br>
                        <div class="col-sm-4 text-center">
                            <div class="form-check">
                                <input class="form-check-input" name="like_gr" type="checkbox" value="like_gr"
                                       id="like_gr">
                                <label class="form-check-label" for="like_gr">
                                    Вступить в группы
                                </label>
                            </div>
                        </div>
                        <br>
                        <div class="col-sm-4 text-center">
                            <div class="form-check">
                                <label for="num">Number group</label>
                                <input type="text" name="num_gr" id="num_gr" class="form-control" placeholder="2-3">
                            </div>
                        </div>
                        <br>
                        <div class="col-sm-4 text-center">
                            <div class="form-check">
                                <input class="form-check-input" name="like_feed" type="checkbox" value="like_feed"
                                       id="like_feed">
                                <label class="form-check-label" for="like_feed">
                                    Подписываться на страницы
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-4 text-center">
                            <div class="form-check">
                                <label for="num_l">Number like_feed</label>
                                <input type="text" name="num_l" id="num_l" class="form-control" placeholder="4-5">
                            </div>
                        </div>
                        <br>
                        <div class="col-sm-4 text-center">
                            <div class="form-check">
                                <input class="form-check-input" name="like_adv" type="checkbox" value="like_adv"
                                       id="like_adv">
                                <label class="form-check-label" for="like_adv">
                                    Лайк рекламы
                                </label>
                            </div>
                        </div>

                        <div class="col-sm-4 text-center">
                            <div class="form-check">
                                <label for="p_like_adv">Procent like adv</label>
                                <input type="text" name="p_like_adv" id="p_like_adv" class="form-control"
                                       placeholder="30">
                            </div>
                        </div>
                        <div class="col-sm-4 text-center">
                            <div class="form-check">
                                <label for="num">Запуск не чаще раз в сутки</label>
                                <input type="text" name="f24" id="f24" class="form-control"
                                       placeholder="3">
                            </div>
                        </div>
                        <br>
                        <div class="col-sm-4 text-center">
                            <button class="btn btn-secondary" name="add_task" id="add_task" value="farm">ACTIVATE
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>



</main>
