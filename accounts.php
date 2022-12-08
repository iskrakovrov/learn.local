<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);

$sql = "SELECT * FROM group_acc";
$gg = selectall($sql);
$sql = "SELECT * FROM servers";
$ss = selectAll($sql);

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
require_once 'inc/header.php'

?>

<main class="container-fluid ">
    <div class="row text-center">
        <h2><?php echo $txtacc ?></h2>
    </div>
    <div class="row">
        <div class="col text-center">

            <div class="row justify-content-center">
                <div class="col-6 text-center">
                    <div class="alert alert-info" role="alert">
                        <p><?php echo $txtacci ?></p>
                        <p> <?php echo $txtaccounts6 ?></p>
                        <p> <?php echo $txtaccounts7 ?></p>

                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="container-fluid">


        <br>

        <div class="input-group">
            <div class="row">
                <div class="col text-center">


                    <a class="btn btn-secondary" href="servers.php" role="button">Servers</a>
                    <a class="btn btn-secondary" href="groups.php" role="button">Account groups</a>

                    <a class="btn btn-success" href="add_acc2.php" role="button">Add accounts</a>
                </div>
            </div>
        </div>
        <br>


        <form method="post" action="add_t.php">
            <div class="input-group">
                <label for="add_task"></label>


                <select name="add_task" id="add_task" class="custom-select">
                    <option value="" selected>[Что делать с отмеченными]</option>
                    <option value="add_task.php"><?php echo $txtaccounts ?></option>
                    <option value="acc_free.php"><?php echo $txtaccounts1 ?></option>


                    <option value="clear_task.php"><?php echo $txtlogin16 ?></option>


                    <option value="" disabled="disabled">----------</option>
                    <option value="free_proxy.php"><?php echo $txtaccounts2 ?></option>
                    <option value="no_free_proxy.php"><?php echo $txtaccounts8 ?></option>


                    <option value="" disabled="disabled">----------</option>
                    <?php foreach ($gg as $g){ ?>
                    <option value="go_group.php?gr=<?php echo $g['id'] ?>"><?php echo $txtaccounts40 .$g['name_group'] ?></option>

                    <?php } ?>

                    <option value="" disabled="disabled">----------</option>
                    <?php foreach ($ss as $s){ ?>
                        <option value="go_server.php?se=<?php echo $s['id'] ?>"><?php echo $txtaccounts41 .$s['name_server'] ?></option>

                    <?php } ?>
                    <option value="" disabled="disabled">----------</option>

                    <option value="del">Удалить</option>
                </select>



                <div class="input-group-append">
                    <button class="btn btn-secondary" name="submit1" value="1" type="submit">&raquo;</button>
                </div>
                <br>

                <div class="row">
                    <div class="col text-center">
                        <a class="btn btn-secondary" href="all_proxy_free.php" role="button"
                           onClick="return confirm( '<?php echo $txtaccounts4 ?>' )">All accounts without proxy</a>
                        <a class="btn btn-secondary" href="all_proxy.php" role="button"
                           onClick="return confirm( '<?php echo $txtaccounts4 ?>' )">
                            Proxy for all accounts</a>
                        <button class="btn btn-success" name="add_task" id="add_task" value="add_task.php">ADD TASK
                        </button>
                        <button class="btn btn-info"
                                name="add_task" id="add_task" value="export_acc.php">EXPORT
                        </button>

                        <button class="btn btn-danger" onClick="return confirm( '<?php echo $txtaccounts5 ?>' )"
                                name="add_task" id="add_task" value="del_acc.php">DELETE ACCOUNTS
                        </button>
                    </div>
                </div>


            </div>
            <br>
            <table>
                <tbody>
                <tr>
                    <td>Minimum friends:</td>
                    <td><label for="min"></label><input type="text" id="min" name="min"></td>
                </tr>
                <tr>
                    <td>Maximum friends:</td>
                    <td><label for="max"></label><input type="text" id="max" name="max"></td>
                </tr>

                </tbody>
            </table>
            <br>

            <table id="dr_table" class="table table-responsive table-striped table-bordered table-hover"
                   style="width:100%">

                <thead>
                <tr>
                    <th class="check" style="text-align: center;">
                        <label for="all"></label>
                        <input type="checkbox" id="all" value=""/>
                    </th>
                    <th>Login</th>
                    <th>Mail</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Avatar</th>
                    <th>Proxy</th>
                    <th>Server</th>
                    <th>Group</th>
                    <th>Status</th>
                    <th>Task</th>
                    <th>Use</th>
                    <th>Create</th>
                    <th>Friends</th>
                    <th>Tocken</th>
                    <th>Adv</th>
                    <th>Last Start</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tfoot>
                <tr>
                    <th></th>
                    <th>Login</th>
                    <th>Mail</th>
                    <th>Phone</th>
                    <th>gender</th>
                    <th>Avatar</th>
                    <th>Proxy</th>
                    <th>Server</th>
                    <th>Group</th>
                    <th>Status</th>
                    <th>Task</th>
                    <th>Use</th>
                    <th>Create</th>
                    <th>Friends</th>
                    <th>Tocken</th>
                    <th>Adv</th>
                    <th>Last Start</th>
                    <th>Action</th>
                </tr>
                </tfoot>


            </table>
        </form>
    </div>


</main>


<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="js/jquery.js"></script>
<script src="js/dtjquery.js"></script>
<script src="js/dataTables.bootstrap.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf-8" src="js/ColumnFilterWidgets.js"></script>


<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->
<script>


    $('#all').click(function (e) {
        $('#dr_table tbody :checkbox').prop('checked', $(this).is(':checked'));
        e.stopImmediatePropagation();
    });


    let dr_table;

    dr_table = $('#dr_table').DataTable({


        bProcessing: false,



        searching: true,

        serverSide: false,
        orderCellsTop: true,
        scrollX: false,
        iLeftWidth: 120,
        sLeftWidth: 'relative',
        "lengthMenu": [[30, 100, 250, 500, 1000, -1], [30, 100, 250, 500, 1000, "All"]],


        "ajax": "acc.php",
        "deferRender": true,
        "columns": [

            {mData: 'ids'},
            {mData: 'login'},
            {mData: 'mail'},
            {mData: 'phone'},
            {mData: 'gender'},
            {mData: 'avatar'},
            {mData: 'proxy'},
            {mData: 'server'},
            {mData: 'group'},
            {mData: 'status'},
            {mData: 'task'},
            {mData: 'use'},
            {mData: 'create'},
            {mData: 'friends'},
            {mData: 'tocken'},
            {mData: 'adv'},
            {mData: 'last_start'},
            {mData: 'action'}],
        "aoColumnDefs": [
            {"bSortable": false, "aTargets": [-1]}
        ],

        "sLengthMenu": "Records per page: _MENU_",
        "sInfo": "Total of _TOTAL_ records (showing _START_ to _END_)",
        "sInfoFiltered": "(filtered from _MAX_ total records)",


        'columnDefs': [{
            'targets': [0, 4, 5, 6, 7, 8, 9, 11, 14, 15], // column index (start from 0)
            'orderable': false, // set orderable false for selected columns
        }],


        initComplete: function () {
            this.api()
                .columns([4, 5, 6, 7, 8, 9, 11, 14, 15])
                .every(function () {
                    const column = this;
                    const select = $('<select><option value=""></option></select>')
                        .appendTo($(column.header()))
                        .on('change', function () {
                            const val = $.fn.dataTable.util.escapeRegex($(this).val());

                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });

                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                        });
                });
        },
    });


    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
        const min = parseInt($('#min').val(), 10);
        const max = parseInt($('#max').val(), 10);
        const age = parseFloat(data[13]) || 0; // use data for the age column

        if (
            (isNaN(min) && isNaN(max)) ||
            (isNaN(min) && age <= max) ||
            (min <= age && isNaN(max)) ||
            (min <= age && age <= max)
        ) {
            return true;
        }
        return false;
    });

    $(document).ready(function () {
        const table = $('#dr_table').DataTable();

        // Event listener to the two range filtering inputs to redraw on input
        $('#min, #max').keyup(function () {
            table.draw();
        });
    });


</script>
</body>
</html>