<?php
$sql = 'SELECT * FROM lists WHERE cat = 8 OR cat = 9';
$qw = selectAll($sql);

?>


<main class="container-fluid ">
    <div class="row text-center">
        <h2><?php echo $txtfilter ?></h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">


            <div class="alert alert-info" role="alert">
                <?php echo $txtfilter1 ?>>
                <br>
            </div>
        </div>
    </div>
    <form method="post">
        <div class="row justify-content-center">
            <div class="col-6 text-center">

                <div class="form-group">
                    <div class="form-floating">
                        <select class="form-select" id="filter" name="filter"
                                aria-label="Floating label select example">

                            <option value="all">All</option>
                            <option value="cyr">Cyr</option>
                            <option value="lat">Lat</option>
                            <option value="cl">Cyr + Lat</option>
                            <option value="black">Black</option>
                            <option value="white">White</option>
                            <option value="blackwhite">Black + White</option>
                        </select>
                        <label for="floatingSelect"><?php echo $txtfilter2 ?></label>
                    </div>

                </div>

                <br>
                <div class="form-group">
                    <div class="form-floating">
                        <select class="form-select" id="black" name="black" aria-label="Floating label select example">
                            <option selected>Black_list</option>
                            <option value="1">Список</option>
                            <option value="2">Список</option>

                        </select>
                        <label for="black">Select Black list</label>
                    </div>


                </div>
                <br>
                <div class="form-group">
                    <div class="form-floating">
                        <select class="form-select" id="white" name="white" aria-label="Floating label select example">

                            <option value="1">Список</option>
                            <option value="2">Список</option>

                        </select>
                        <label for="white">Select White list</label>
                    </div>


                </div>
                <br>
                <div class="form-group">
                    <div class="form-floating">
                        <select class="form-select" id="confirm" name="confirm"
                                aria-label="Floating label select example">

                            <option value="1">Confirm</option>
                            <option value="2">Cancel</option>

                        </select>
                        <label for="confirm">Confirm or Cancel</label>
                    </div>


                </div>

                <br>
                <div class="form-group">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="n_confirm" name="n_confirm" placeholder="">
                        <label for="n_confirm"><?php echo $txtfilter4 ?></label>
                    </div>

                    <br>
                    <br>
                    <div class="col-sm-4 text-center">
                        <button class="btn btn-secondary" name="add_task" id="add_task" value="filter">ACTIVATE
                        </button>
                    </div>
                </div>
    </form>


</main>