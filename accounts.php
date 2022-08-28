<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);



?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>

    <?php
    require_once('inc/meta.php');
    ?>


    <title>FB Combo</title>

</head>
<?php
$sql = "SELECT * FROM accounts";
$query = selectAll($sql);
$s = 12;
?>
<body>
<?php
include_once 'inc/header.php'

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
                        <?php echo $txtacci ?>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="container-fluid">

        <table>
            <tbody>
            <tr>
                <td>Minimum friends:</td>
                <td><label for="min"></label><input type="text" id="min" name="min"></td>
            </tr>
            <tr>
                <td>Maximum friends:</td>
                <td><input type="text" id="max" name="max"></td>
            </tr>

            </tbody>
        </table>
        <br>
        <form method="post" action="add_t.php">
            <div class="input-group">
                <select name="add_task" class="custom-select">
                    <option value="" selected>[Что делать с отмеченными]</option>
                    <option value="add_t.php">Добавить задание</option>
                    <option value="acc_free.php">Установить состояние &quot;Свободен"</option>


                    <option value="clear_tasks.php">Удалить все задания</option>


                    <option value="" disabled="disabled">----------</option>
                    <option value="add_to_group_1">Добавить в группу "Киев"</option>
                    <option value="add_to_group_2">Добавить в группу &quot;Одесса&quot;</option>
                    <option value="add_to_group_3">Добавить в группу "Днепр"</option>
                    <option value="add_to_group_4">Добавить в группу "Харьков"</option>
                    <option value="add_to_group_5">Добавить в группу "FBCOMBO"</option>

                    <option value="del_from_group_1">Удалить из группы "Киев"</option>
                    <option value="del_from_group_2">Удалить из группы "Одесса"</option>
                    <option value="del_from_group_3">Удалить из группы "Днепр"</option>
                    <option value="del_from_group_4">Удалить из группы "Харьков"</option>
                    <option value="del_from_group_5">Удалить из группы "FBCOMBO"</option>

                    <option value="" disabled="disabled">----------</option>

                    <option value="del">Удалить</option>
                </select>


                <div class="input-group-append">
                    <button class="btn btn-secondary" name="submit1" value="1" type="submit">&raquo;</button>
                </div>
                <br>

                <div class="row">
                    <div class="col text-center">
                        <a class="btn btn-secondary" href="add_acc2.php" role="button">Add accounts</a>
                        <button class="btn btn-secondary" name="add_task" id="add_task" value="add_task.php">ADD TASK
                        </button>


                        <a class="btn btn-secondary" href="#" role="button">Check double</a>


                        <button class="btn btn-danger" onClick="return confirm( 'WARNING!!! DELETE ACCOUNT?' )"
                                name="del_accs" id="dell_accs">DELETE ACCOUNTS
                        </button>
                    </div>
                </div>


            </div>


            <table id="dr_table" class="table table-responsive table-striped table-bordered table-hover"
                   style="width:100%">

                <thead>
                <tr>
                    <th class="check" style="text-align: center;">
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


        stateSave: true,
        searching: true,

        serverSide: false,
        orderCellsTop: true,
        scrollX: true,
        iLeftWidth: 120,
        sLeftWidth: 'relative',

        "ajax": "/acc.php",
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
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                        .appendTo($(column.header()))
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

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
        var min = parseInt($('#min').val(), 10);
        var max = parseInt($('#max').val(), 10);
        var age = parseFloat(data[13]) || 0; // use data for the age column

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
        var table = $('#dr_table').DataTable();

        // Event listener to the two range filtering inputs to redraw on input
        $('#min, #max').keyup(function () {
            table.draw();
        });
    });


</script>
</body>
</html>