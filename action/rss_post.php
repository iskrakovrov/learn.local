<?php

$sql = 'SELECT * FROM lists WHERE cat = 8';
$qw = selectAll($sql);
$sql = 'SELECT * FROM lists WHERE cat = 5';
$qw1 = selectAll($sql);
$sql = 'SELECT * FROM lists WHERE cat = 11';
$qw2 = selectAll($sql);
?>

<main class="container-fluid ">
    <div class="row text-center">
        <h2>Posting to profile from RSS feed</h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    Posting to profile from RSS feed
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">


                    <label for="cat" class="control-label">RSS feeds</label>

                    <select name="cat" id="cat" class="form-control">
                        <?php
                        $i = 0;
                        foreach ($qw as $a) {
                            $i++; ?>
                            <option value="<?php echo $a['id'] ?>"><?php echo $a['name']; ?></option>
                        <?php } ?>
                    </select>

                    <br>
                    <label for="mode" class="control-label">Mode posting</label>
                    <select name="mode" id="mode" class="form-control">
                        <option value="1">Only link</option>
                        <option value="2">Title + link</option>
                        <option value="3">Text + link</option>
                    </select>
                    <br>
                    <label for="txt" class="control-label">RSS feeds</label>

                    <select name="txt" id="txt" class="form-control">
                        <option value="0">No text</option>
                        <?php
                        $i = 0;
                        foreach ($qw1 as $b) {
                            $i++; ?>
                            <option value="<?php echo $b['id'] ?>"><?php echo $b['name']; ?></option>
                        <?php } ?>
                    </select>

                    <br>

                    <label for="uniq" class="control-label">One account can only post a link once</label>
                    <select name="uniq" id="uniq" class="form-control">
                        <option value="1">YES</option>
                        <option value="2">NO</option>
                    </select>
                    <br>

                    <br>

                    <label for="prc">Post probability in %</label>
                    <input type="number" name="prc" id="prc" class="form-control" value="100" required>

                    <br>

                    <label for="save" class="control-label">Save posts in DB</label>

                    <select name="save" id="save" class="form-control">
                        <option value="0">No save</option>
                        <?php
                        $i = 0;
                        foreach ($qw2 as $c) {
                            $i++; ?>
                            <option value="<?php echo $c['id'] ?>"><?php echo $c['name']; ?></option>
                        <?php } ?>
                    </select>

                    <label for="f24"><?php echo $txtpost10 ?></label>
                    <input type="text" name="f24" id="f24" class="form-control" value="2" required>


                    <br>
                    <br>

                    <button class="btn btn-secondary" name="add_task" id="add_task" value="rss_post">ACTIVATE
                    </button>



                </form>
            </div>
        </div>
    </div>


</main>