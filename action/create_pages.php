<?php
$sql = 'SELECT * FROM lists WHERE cat = 9';
$names = selectAll($sql);

?>

<main class="container-fluid ">
    <div class="row text-center">
        <h2>Create pages</h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">

                    Avatars in <strong>work folder\AVA_P</strong> . Cover in <strong>work folder\COVER_P</strong> .
                    Page names in <strong>Additional Lists</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">

                    <label for="mode">How to create pages</label>


                    <select class="form-select" id="mode" name="mode" aria-label="Floating label select example">

                        <option value="1">Ordinary</option>
                        <option value="2">ADS manager</option>

                    </select>
                    <label for="names" class="control-label">List names for pages</label>

                    <select name="names" id="names" class="form-control">
                        <?php

                        foreach ($names as $a) {
                             ?>
                            <option value="<?php echo $a['id'] ?>"><?php echo $a['name']; ?></option>
                        <?php } ?>
                    </select>

                    <br>
 <!--                   <label for="cat">Category pages</label>
                    <select class="form-select" id="cat" name="cat" aria-label="Floating label select example">

                        <option value="1">Ordinary</option>
                        <option value="no">ADS manager</option>

                    </select>
               </br>  -->

                    <label for="num_p">Number of pages created in one run</label>
                    <input type="number" name="num_p" id="num_p" class="form-control" value="2"  required>


                    <br>
                    <br>

                    <button class="btn btn-secondary" name="add_task" id="add_task" value="create_pages">ACTIVATE
                    </button>



                </form>
            </div>
        </div>
    </div>


</main>
