<main class="container-fluid ">
    <div class="row text-center">
        <h2><?php echo $txtifg1 ?></h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">


            <div class="alert alert-info" role="alert">
                <?php echo $txtifg2 ?>
            </div>


            <div class="row d-flex justify-content-center">
                <form method="post">
                    <div class="form-group">
                        <div class="form-check col-sm-4 text-center">
                            <input class="form-check-input" name="action[0]" type="checkbox" value="sbor"
                                   id="action[0]">
                            <label class="form-check-label" for="action[0]">
                                <?php echo $txtlogin1 ?>
                            </label>
                        </div>
                        <br>



                        <br>


                        <button class="btn btn-secondary" name="add_task" id="add_task" value="login">ACTIVATE</button>


                </form>
            </div>


</main>
