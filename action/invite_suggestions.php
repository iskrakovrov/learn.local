<?php

?>
<main class="container-fluid ">
    <div class="row text-center">
        <h2>Add task</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">


            <div class="alert alert-info" role="alert">
                Выберите опции инвайта предложенных.
            </div>

            <form method="post">
                <div class="form-group">
                    <div class="form-check">
                        <label for="num">Number of invitations from and to</label>
                        <input type="text" name="act1[0]" id="num" class="form-control" placeholder="100-150" required>
                    </div>
                    <div class="form-check">
                        <label for="num2">The number of invitations from and to in one run</label>
                        <input type="text" name="act1[1]" id="num2" class="form-control" placeholder="10-20" required>
                    </div>
                    <div class="form-check">
                        <label for="num3">Pause between prompts from and to</label>
                        <input type="text" name="act1[2]" id="num3" class="form-control" placeholder="10-20" required>
                    </div>






                    <button class="btn btn-secondary" name="add_task" id="add_task" value="invite_suggestions">ACTIVATE</button>


            </form>


</main>
