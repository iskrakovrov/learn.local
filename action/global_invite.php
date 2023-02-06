<?php
$sql = "SELECT * FROM lists WHERE cat = 8 OR cat = 9";
$qw = selectAll($sql);

?>

<main class="container-fluid ">
    <div class="row text-center">
        <h2><?php echo $txtglobali ?></h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    <?php echo $txtglobali1 ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">

                    <label for="ti0" class="control-label"><?php echo $txtglobali2 ?></label>

                    <select name="ti0" id="ti0" class="form-control">
                        <option value="accept_friends"><?php echo $txttask21 ?></option>
                        <option value="invite_suggestions"><?php echo $txtglobali8 ?></option>
                        <option value="new_accounts"><?php echo $txtglobali11 ?></option>
                        <option value="invite_from_group"><?php echo $txtglobali9 ?></option>
                        <option value="stop"><?php echo $txtglobali13 ?></option>


                    </select>

                    <br>
                    <label for="ti1" class="control-label"><?php echo $txtglobali3 ?></label>

                    <select name="ti1" id="ti1" class="form-control">
                        <option value="accept_friends"><?php echo $txttask21 ?></option>
                        <option value="invite_suggestions"><?php echo $txtglobali8 ?></option>
                        <option value="new_accounts"><?php echo $txtglobali11 ?></option>
                        <option value="invite_from_group"><?php echo $txtglobali9 ?></option>
                        <option value="stop"><?php echo $txtglobali13 ?></option>

                    </select>

                    <br>
                    <label for="ti2" class="control-label"><?php echo $txtglobali4 ?></label>

                    <select name="ti2" id="ti2" class="form-control">
                        <option value="accept_friends"><?php echo $txttask21 ?></option>
                        <option value="invite_suggestions"><?php echo $txtglobali8 ?></option>
                        <option value="new_accounts"><?php echo $txtglobali11 ?></option>
                        <option value="invite_from_group"><?php echo $txtglobali9 ?></option>
                        <option value="stop"><?php echo $txtglobali13 ?></option>

                    </select>

                    <br>
                    <label for="ti3" class="control-label"><?php echo $txtglobali5 ?></label>

                    <select name="ti3" id="ti3" class="form-control">
                        <option value="accept_friends"><?php echo $txttask21 ?></option>
                        <option value="invite_suggestions"><?php echo $txtglobali8 ?></option>
                        <option value="new_accounts"><?php echo $txtglobali11 ?></option>
                        <option value="invite_from_group"><?php echo $txtglobali9 ?></option>
                        <option value="stop"><?php echo $txtglobali13 ?></option>

                    </select>





                    <br>
                    <br>

                    <button class="btn btn-secondary" name="add_task" id="add_task" value="global_invite">ACTIVATE
                    </button>


                </form>
            </div>
        </div>
    </div>


</main>