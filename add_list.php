<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);


if (!empty($_REQUEST['name'])) {
    $name = $_REQUEST['name'];
    $cat = $_REQUEST['cat'];
    $sql = "SELECT * FROM lists WHERE cat = $cat AND name = '$name'";
    $query = select($sql);
    if (empty($query)) {
        $sql = "INSERT INTO lists (cat, name) VALUES ($cat, '$name')";
        $query = select($sql);
        header('Location: add_list.php');
    }
}
if (!empty($_REQUEST['catedit'])) {
    $catedit = $_REQUEST['catedit'];
    if ($catedit === 3) {
        $url = 'edit_list_name.php';
        header("Location: $url");
        exit();
    }
    if ($catedit === 5) {
        $url = 'edit_list_posts.php';
        header("Location: $url");
        exit();
    }
    if ($catedit === 6) {
        $url = 'edit_list_comm.php';
        header("Location: $url");
        exit();
    }
    if ($catedit === 1) {
        $url = 'edit_list_bl.php';
        header("Location: $url");
        exit();
    }

    $url = 'e_list.php?cat=' . $catedit;
    header("Location: $url");
    exit();
}

?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>

    <?php
    require_once('inc/meta.php');
    ?>


    <title>FB Combo</title>

</head>

<body>
<?php
include_once 'inc/header.php'

?>

<main class="container-fluid ">
    <div class="row text-center">
        <h2>Lists</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">


            <div class="alert alert-info" role="alert">
                Создайте нужные вам списки
                <br>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-4 text-center">
            <form>
                <div class="form-row">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name list">
                    </div>
                    <label for="cat" class="col-sm-2 control-label">Category</label>
                    <div class="col">
                        <select name="cat" id="cat" class="form-control">
                            <option value="1">Black lists</option>
                            <option value="2">Geo lists</option>
                            <option value="3">Name lists</option>
                            <option value="4">ID lists</option>
                            <option value="5">Post lists</option>
                            <option value="6">Comments lists</option>
                            <option value="7">Keywords lists</option>
                            <option value="8">Site lists</option>
                            <option value="10">Lists Groups</option>
                            <option value="9">Additional lists</option>
                        </select>
                    </div>
                    <br>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">ADD List</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <br>
    <br>

    <div class="row justify-content-center">
        <div class="col-4 text-center">
            <form>
                <div class="form-row">

                    <label for="catedit" class="col-sm-2 control-label">Category</label>
                    <div class="col">
                        <select name="catedit" id="cat" class="form-control">
                            <option value="1">Black lists</option>
                            <option value="2">Geo lists</option>
                            <option value="3">Name lists</option>
                            <option value="4">ID lists</option>
                            <option value="5">Post lists</option>
                            <option value="6">Comments lists</option>
                            <option value="7">Keywords lists</option>
                            <option value="8">Site lists</option>
                            <option value="10">Lists Groups</option>
                            <option value="9">Другие lists</option>
                        </select>
                    </div>
                    <br>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">EDIT List</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</main>


<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script src="js/jquery.js"></script>
<script src="js/dtjquery.js"></script>
<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->
<script>
    $('#all').click(function (e) {
        $('#example tbody :checkbox').prop('checked', $(this).is(':checked'));
        e.stopImmediatePropagation();
    });


    dr_table = $('#example').DataTable({

        "lengthMenu": [[100, 300, 500, -1], [30, 100, 200, "All"]],
        stateSave: true,


    });
</script>
</body>
</html>
