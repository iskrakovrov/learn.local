<?php
$sql = 'SELECT * FROM lists WHERE cat = 5';
$qw = selectAll($sql);
$sql = 'SELECT * FROM lists WHERE cat = 10';
$qw1 = selectAll($sql);
$sql = 'SELECT * FROM lists WHERE cat = 11';
$qw2 = selectAll($sql);

?>

<main class="container-fluid ">
    <div class="row text-center">
        <h2>Posting to groups</h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">

                    If you select a mode where the list of groups is limited to a list, then to start working with groups again, make a reset - the yellow button on the Accounts page.
                    <br>
                    Massive posting - Endless posting around the list of groups
                    <br>
                    Posting once per. Group reset after 24 hours  - Repeated posting to the group within 24 hours is not possible. After a day, the groups are reset to resume posting.
                    <br>
                    Posting once per - Posting within this project is published strictly no more than 1 time
                    <br>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">
                    <label for="ntask">Index task</label>
                    <input type="number" name="ntask" id="ntask" class="form-control" value="1" required>
                    <br>
                    <!--                 <label for="day" class="control-label"><?php // echo $txtpgroup7 ?></label>
                    <select name="day" id="day" class="form-control">
                        <option value="2">NO</option>
                        <option value="1">YES</option>

                    </select> -->
                    <br>

                    <label for="mode3" class="control-label">Mode posting</label>
                    <select name="mode3" id="mode3" class="form-control">
                        <option value="4">Warm-up only </option>
                        <option value="1">Massive posting</option>
                        <option value="2">Posting once per.
                            Group reset after 24 hours</option>
                        <option value="3">Posting once per </option>

                    </select>
                    <br>
                    <label for="res">For the mode: limiting the number of groups where accounts will post within 24 hours. If without restrictions - 0.</label>
                    <input type="text" name="res" id="res" class="form-control" value="0" required>
                    <br>
                    <label for="type" class="control-label">Group list</label>
                    <select name="type" id="type" class="form-control">
                        <!--    <option value="1">Groups where the account is a member</option> -->
                        <?php
                        $i = 0;
                        foreach ($qw1 as $a) {
                            $i++; ?>
                            <option value="<?php echo $a['id'] ?>"><?php echo $a['name']; ?></option>
                        <?php } ?>
                    </select>
                    <br>

                    <label for="post" class="control-label">Post list</label>

                    <select name="post" id="post" class="form-control">
                        <?php
                        $i = 0;
                        foreach ($qw as $b) {
                            $i++; ?>
                            <option value="<?php echo $b['id'] ?>"><?php echo $b['name']; ?></option>
                        <?php } ?>
                    </select>

                    <br>


                    <label for="mod1" class="control-label">How to take groups?</label>
                    <select name="mod1" id="mod1" class="form-control">
                        <option value="2">One by one</option>
                        <option value="1">Random</option>

                    </select>
                    <br>

                    <!--             <label for="mod2" class="control-label">How to take groups?</label>
                                 <select name="mod2" id="mod2" class="form-control">
                                     <option value="2">One by one</option>
                                     <option value="1">Random</option>

                                 </select> -->
                    <br>

                    <label for="npost">How many posts should one account post per launch?</label>
                    <input type="text" name="npost" id="npost" class="form-control" value="2" required>
                    <br>

                    <label for="nday">How many days should I wait after joining a group?</label>
                    <input type="text" name="nday" id="nday" class="form-control" value="5" required>
                    <br>

                    <label for="nfr">If possible, how many people from the group should I invite as friends?</label>
                    <input type="text" name="nfr" id="nfr" class="form-control" value="5" required>
                    <br>


                    <label for="nl">If possible, how many likes should I put in the group?</label>
                    <input type="text" name="nl" id="nl" class="form-control" value="5" required>
                    <br>
                    <!--             <label for="mod3" class="control-label"></label>
                                 <select name="mod3" id="mod3" class="form-control">
                                     <option value="1">NO</option>
                                     <option value="2">YES</option>
                                 </select> -->
                    <br>
                    <label for="mod4" class="control-label">If the account is not in a group, then join the
                        group?</label>
                    <select name="mod4" id="mod4" class="form-control">
                        <option value="2">YES</option>
                        <option value="1">NO</option>

                    </select>
                    <br>
                    <label for="ng">How many groups should I join if I'm not in a group?</label>
                    <input type="text" name="ng" id="ng" class="form-control" value="3" required>
                    <br>
                    <label for="scr" class="control-label">Take screenshots of published posts</label>
                    <select name="scr" id="scr" class="form-control">
                        <option value="1">YES</option>
                        <option value="2">NO</option>

                    </select>
                    <br>

                    <label for="fname">Name folder for screenshots</label>
                    <input type="text" name="fname" id="fname" class="form-control" value="project" required>

                    <br>
                    <label for="spost" class="control-label">List for collecting URLs of posts for further work</label>

                    <select name="spost" id="spost" class="form-control">
                        <?php
                        $i = 0;
                        foreach ($qw2 as $c) {
                            $i++; ?>
                            <option value="<?php echo $c['id'] ?>"><?php echo $c['name']; ?></option>
                        <?php } ?>
                    </select>

                    <br>


                    <label for="f24"><?php echo $txtpost10 ?></label>
                    <input type="number" name="f24" id="f24" class="form-control" value="3" required>


                    <br>
                    <br>

                    <button class="btn btn-secondary" name="add_task" id="add_task" value="post_to_group">ACTIVATE
                    </button>


                </form>
            </div>
        </div>
    </div>


</main>
