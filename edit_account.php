<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$id = $_REQUEST['id'];
$sql = "SELECT * FROM accounts WHERE id = '$id'";
$qu = select($sql);
if (!empty($_POST)) {
    $login = $_POST['login'];
    $pass = $_POST['pass'];
    $group = $_POST['group'];
    $server = $_POST['server'];
    $id_phone = $qu['$id_phone'];
    $ph = $_POST['phone'];


    if (isset($ph) && $ph !== '' && $ph !== 'null') {


        $sql = "SELECT phone_id FROM phones WHERE phone = $ph";
        $q1 = select($sql);
        if (empty($q1)) {
            $sql = "INSERT INTO phones (phone) VALUES ('$ph')";
            $q1 = insert($sql);
            $sql = "SELECT phone_id FROM phones WHERE phone = $ph";
            $q1 = insert($sql);
        }
        else
        {
            $pid = $q1['phone_id'];
           $sql = "UPDATE phones SET phone = $ph WHERE phone_id = $pid ";
           $q1 = update($sql);
            $sql = "UPDATE accounts SET id_phone = $pid WHERE id_acc = $id";
            $q1 = update($sql);
        }

    }
    else {

        $sql = "UPDATE accounts SET id_phone = NULL WHERE id_acc = $id";
        $q1 = update($sql);
    }










 //  header('Location: /edit_account.php?=' . $id);
  //  exit();
}


?>
<!doctype html>

<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap"
          rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="css/dt.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <title>FB Combo | Edit Account</title>
</head>
<body>
<?php
include_once 'inc/header.php';

?>
<main class="container-fluid ">
    <div class="row text-center">
        <h2>Edit <?php echo $qu['login_fb'] ?></h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">


            <div class="alert alert-info" role="alert">
                Формат в котором должны быть записаны аккаунты<br/><strong>login;password</strong><br>
                Если не создана группа <br>
                <a class="btn btn-secondary" href="#" role="button" data-placement="right"
                   title="Если не указали группу">Add account group</a>
                <br>
                Если не создан сервер
                <br>
                <a class="btn btn-secondary" href="#" role="button" data-toggle="tooltip" data-placement="right"
                   title="Если не указали сервер">Add Server</a>
                <br>
            </div>

            <br>

            <div class="container">
                <div class="row">
                    <div class="col-sm">


                        <img src="<?echo $_POST["avatar"]?>" class="img-fluid img-thumbnail" style="width: 200px ">


                    </div>
                </div>
            </div>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <button type="button" class="btn btn-secondary btn-lg">Change Avatar</button>
                    </div>
                    <div class="col-sm">
                        <button type="button" class="btn btn-secondary btn-lg">Add posts</button>
                    </div>
                    <div class="col-sm">
                        <button type="button" class="btn btn-secondary btn-lg">Add comment</button>
                    </div>
                </div>
            </div>
            <br>

            <form method="post">
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <label for="login">Login</label>
                            <input type="text" class="form-control" placeholder="Login" id="login" name="login"
                                   value="<?php echo $qu['login_fb'] ?>">
                        </div>
                        <div class="col-sm">
                            <label for="pass">Password</label>
                            <input type="text" class="form-control" placeholder="Password" id="pass" name="pass"
                                   value="<?php echo $qu['pass_fb'] ?>">
                        </div>
                        <div class="col-sm">
                            <label for="phone">Phone</label>
                            <?php
                            $idm = $qu['id_phone'];
                            if (!empty($idm)) {
                                $sql = "SELECT * FROM phones WHERE phone_id = $idm";
                                $query = select($sql);
                                $phone = $query['phone'];
                            } else {
                                $phone = 'null';
                            }
                            ?>
                            <input type="text" class="form-control" placeholder="Phone" id="phone" name="phone"
                                   value="<?php echo $phone ?>">
                        </div>
                    </div>
                </div>
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <label for="mail">Mail</label>
                            <?php
                            $idm = $qu['id_mail'];
                            $sql = "SELECT * FROM mail WHERE id_mail = $idm";
                            $query = select($sql);
                            $mail = $query['mail'];
                            $passmail = $query['pass_mail'];
                            if (!empty($query)) {
                                $mail = $query['mail'];
                                $passmail = $query['pass_mail'];
                            } else {
                                $mail = 'null';
                                $passmail = 'null';
                            }
                            ?>
                            <input type="text" class="form-control" placeholder="Mail" id="mail" name="mail"
                                   value="<?php echo $mail ?>">
                        </div>
                        <div class="col-sm">
                            <label for="pass_mail">Password Mail</label>
                            <input type="text" class="form-control" placeholder="Password mail" id="pass_mail"
                                   name="pass_mail"
                                   value="<?php echo $passmail ?>">
                        </div>
                        <div class="col-sm">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" placeholder="Name" id="name"
                                   value="<?php echo $qu['name'] ?>" disabled>
                        </div>
                    </div>
                </div>
                <br>
                <div class="container">
                    <div class="row">


                        <div class="col-sm-2">
                            <label for="day">Birthday</label>
                            <input type="text" class="form-control" placeholder="Birthday" id="day"
                                   value="<?php echo $qu['bd'] ?>" disabled>
                        </div>
                        <div class="col-sm-2">
                            <label for="mon">Мonth of birth</label>
                            <input type="text" class="form-control" placeholder="Мonth of birth" id="mon"
                                   value="<?php echo $qu['mb'] ?>" disabled>
                        </div>
                        <div class="col-sm-2">
                            <label for="year">Year of birth</label>
                            <input type="text" class="form-control" placeholder="Year of birth" id="year"
                                   value="<?php echo $qu['yb'] ?>" disabled>
                        </div>

                        <div class="col-sm-2">
                            <label for="gender">Sex</label>
                            <input type="text" class="form-control" placeholder="Gender" id="gender"
                                   value="<?php echo $qu['gender'] ?>" disabled>
                        </div>
                        <div class="col-sm">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" placeholder="Name" id="name"
                                   value="<?php echo $qu['name'] ?>" disabled>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <label for="add_date">Add date</label>
                            <input type="text" class="form-control" placeholder="Date add acc" id="add_date"
                                   value="<?php echo date('d/m/Y', $qu['created']) ?>" disabled>
                        </div>
                        <div class="col-sm">
                            <label for="last_start">Last start</label>
                            <input type="text" class="form-control" placeholder="Last start" id="last_start"
                                   value="<?php echo date('d/m/Y', $qu['last_start']) ?>" disabled>
                        </div>
                        <div class="col-sm">

                            <?php
                            $sql = "SELECT * FROM status";
                            $q1 = selectAll($sql);
                            ?>
                            <label for="status">Status</label>


                            <select class="form-select" aria-label="Default select example" name="status">
                                <?php
                                $st = $qu['status'];
                                $sql = "SELECT * FROM status WHERE id_status = $st";
                                $q2 = select($sql);

                                ?>
                                <option selected
                                        value="<?php echo $q2['id_status'] ?>"><?php echo $q2['status'] ?></option>
                                <?php
                                $i = 0;
                                foreach ($q1 as $a) {
                                    $i++; ?>


                                    <option value="<?php echo $a['id_status'] ?>"><?php echo $a['status'] ?></option>

                                    <?php
                                }
                                ?>
                            </select>
                        </div>


                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <label for="acc_group">Account Group</label>
                            <?php
                            $sql = "SELECT * FROM group_acc";
                            $q2 = selectAll($sql);
                            $id_gr = $qu['group_acc'];
                            $sql1 = "SELECT * FROM group_acc WHERE id_gr = $id_gr";
                            $query1 = select($sql1);
                            $gr = $query1['name_group'];
                            $id_gr = $query1['id_gr'];
                            ?>


                            <select class="form-select" aria-label="Default select example" name="group">
                                <option selected value="<?php echo $id_gr ?>"><?php echo $gr ?></option>
                                <?php
                                $i = 0;
                                foreach ($q2 as $a) {
                                    $i++; ?>


                                    <option value="<?php echo $a['id_gr'] ?>"><?php echo $a['name_group'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>


                        </div>
                        <div class="col-sm">
                            <label for="server">Server</label>
                            <?php
                            $sql = "SELECT * FROM servers";
                            $q2 = selectAll($sql);
                            $id_ser = $qu['server'];
                            $sql1 = "SELECT * FROM servers WHERE id_server = $id_ser";
                            $query1 = select($sql1);
                            $ser = $query1['name_server'];
                            $id_ser = $query1['id_server'];
                            ?>


                            <select class="form-select" aria-label="Default select example" name="server">

                                <option selected value="<?php echo $id_ser ?>"><?php echo $ser ?></option>

                                <?php
                                $i = 0;
                                foreach ($q2 as $a) {
                                    $i++; ?>
                                    <option value="<?php echo $a['id_server'] ?>"><?php echo $a['name_server'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <label for="coock">Coockies</label>
                        <input type="text" class="form-control" placeholder="Status" id="coock"
                               value='<?php echo $qu["coockie"] ?>' disabled>
                    </div>

                </div>
                <div class="container">
                    <div class="row">
                        <label for="tocken">Tocken</label>
                        <input type="text" class="form-control" placeholder="Tocken" id="tocken"
                               value="<?php echo $qu['tocken'] ?>" disabled>
                    </div>

                </div>
                <div class="container">
                    <div class="row">
                        <label for="ua">User agent</label>
                        <input type="text" class="form-control" placeholder="User agent" id="ua"
                               value='<?php echo $qu['ua'] ?>' disabled>
                    </div>

                </div>
                <div class="container">
                    <div class="row">
                        <label for="comment">Comment</label>
                        <input type="text" class="form-control" placeholder="Comment" id="comment" name="comm"
                               value="<?php echo $qu['comm'] ?>">
                    </div>

                </div>
                <br>
                <button type="submit" class="btn btn-secondary btn-lg">Save</button>
            </form>
</main>


<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>


<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->

</body>
</html>
