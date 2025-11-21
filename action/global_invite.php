<?php
$taskFile = basename(__FILE__);
$setup = $_SESSION['setup'][$taskFile] ?? [];

function fsel($name, $value) {
    global $setup;
    return (isset($setup[$name]) && $setup[$name] == $value) ? 'selected' : '';
}
?>

<main class="container-fluid ">
    <div class="row text-center">
        <h2><?= $txtglobali ?></h2>
    </div>

    <div class="col align-center">
        <div class="row justify-content-center">
            <div class="col-6 text-center">
                <div class="alert alert-info" role="alert">
                    <?= $txtglobali1 ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">

                <form method="post" onsubmit="return Complete();">

                    <?php
                    $fields = [
                        "ti0" => $txtglobali2,
                        "ti1" => $txtglobali3,
                        "ti2" => $txtglobali4,
                        "ti3" => $txtglobali5,
                        "ti4" => "Fifth act"
                    ];

                    $options = [
                        "accept_friends" => $txttask21,
                        "invite_suggestions" => $txtglobali8,
                        "new_accounts" => $txtglobali11,
                        "invite_like" => "Invite from likes",
                        "invite_from_group" => $txtglobali9,
                        "stop" => $txtglobali13
                    ];

                    foreach ($fields as $name => $label): ?>
                        <label for="<?= $name ?>"><?= $label ?></label>
                        <select name="<?= $name ?>" id="<?= $name ?>" class="form-control">
                            <?php foreach ($options as $value => $text): ?>
                                <option value="<?= $value ?>" <?= fsel($name, $value) ?>>
                                    <?= $text ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                        <br>
                    <?php endforeach ?>

                    <br>

                    <button class="btn btn-secondary" name="add_task" value="global_invite">
                        ✅ SAVE
                    </button>

                </form>

            </div>
        </div>
    </div>
</main>
