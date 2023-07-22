<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);

$sql = "SELECT * FROM group_acc";
$gg = selectAll($sql);
$sql = "SELECT * FROM servers";
$ss = selectAll($sql);
$sql = "SELECT * FROM group_proxy";
$pp = selectAll($sql);

?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>

    <?php
    require_once('inc/meta.php');
    ?>


    <title>FB Combo</title>
    <style>div.dataTables_length {

            padding-left: 2em;

        }

        div.dataTables_length,
        div.dataTables_filter {

            padding-top: 0.55em;

        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <style>
        .select2-container--default .select2-selection--single .select2-selection__clear {
            margin-right: -5px;
            margin-top: -10px;
        }
    </style>

</head>

<body>
<?php
require_once 'inc/header.php';
require_once 'inc/alerts.php';
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
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <a class="btn btn-outline-primary" href="all_free_acc.php" role="button"
                       onClick="return confirm( 'SET FREE STATUS for ALL ACCOUNT???' )">All accounts have free
                        status</a>
                    <a class="btn btn-outline-primary" href="all_clear_task.php" role="button"
                       onClick="return confirm( 'CLEAR ALL TASKs for ALL ACCOUNT???' )">Clear tasks for all accounts</a>

                </div>
            </div>
        </div>
        <br>


        <form method="post" action="add_t.php">
            <div class="input-group">
                <label for="add_task"></label>


                <select name="add_task" id="add_task" class="custom-select">
                    <option value="" selected>[<?php echo $txtmenu ?>]</option>
                    <option value="add_task.php"><?php echo $txtaccounts ?></option>
                    <option value="acc_free.php"><?php echo $txtaccounts1 ?></option>
                    <option value="clear_task.php"><?php echo $txtlogin16 ?></option>
                    <option value="" disabled="disabled">----------</option>
                    <option
                        value="acc_go_proxy.php?gr=0"><?php echo 'Account without proxy' ?></option>
                    <?php foreach ($pp as $p) { ?>
                        <option
                            value="acc_go_proxy.php?gr=<?php echo $p['id'] ?>"><?php echo 'Add account to proxy group ' . $p['name_group'] ?></option>

                    <?php } ?>

                    <option value="" disabled="disabled">----------</option>
                    <option value="free_proxy.php"><?php echo $txtaccounts2 ?></option>
                    <option value="no_free_proxy.php"><?php echo $txtaccounts8 ?></option>


                    <option value="" disabled="disabled">----------</option>
                    <?php foreach ($gg as $g) { ?>
                        <option
                            value="go_group.php?gr=<?php echo $g['id'] ?>"><?php echo $txtaccounts40 . $g['name_group'] ?></option>

                    <?php } ?>

                    <option value="" disabled="disabled">----------</option>
                    <?php foreach ($ss as $s) { ?>
                        <option
                            value="go_server.php?se=<?php echo $s['id'] ?>"><?php echo $txtaccounts41 . $s['name_server'] ?></option>

                    <?php } ?>
                    <option value="" disabled="disabled">----------</option>

                    <option value="del_acc.php">Delete</option>
                </select>


                <div class="input-group-append">
                    <button class="btn btn-primary" name="submit1" value="1" type="submit">&raquo;</button>
                </div>
                <br>

                <div class="row">
                    <div class="col text-center">
                        <a class="btn btn-secondary" href="all_proxy_free.php" role="button"
                           onClick="return confirm( '<?php echo $txtaccounts4 ?>' )">All accounts without proxy</a>
                        <a class="btn btn-secondary" href="all_proxy.php" role="button"
                           onClick="return confirm( '<?php echo $txtaccounts4 ?>' )">
                            Proxy for all accounts</a>
                        <button class="btn btn-success" name="add_task" id="add_task" value="task2.php">ADD TASK
                        </button>

                        <button class="btn btn-info"
                                name="add_task" id="add_task" value="export_acc.php">EXPORT
                        </button>

                        <button class="btn btn-danger" onClick="return confirm( '<?php echo $txtaccounts5 ?>' )"
                                name="add_task" id="add_task" value="del_acc.php">DELETE ACCOUNTS
                        </button>
                        &nbsp; &nbsp; &nbsp;
                        <button id="clearFiltersBtn" class="btn btn-primary">Clear Filters</button>

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
                    <th class="select-filter">Name</th>
                    <th class="select-filter">Login</th>
                    <th class="select-filter">Mail</th>
                    <th class="select-filter">Phone</th>
                    <th class="select-filter">Gender</th>
                    <th class="select-filter">Avatar</th>
                    <th class="select-filter">Proxy</th>
                    <th class="select-filter">Server</th>
                    <th class="select-filter">Group</th>
                    <th class="select-filter">Status</th>
                    <th class="select-filter">Task</th>
                    <th class="select-filter">Use</th>
                    <th class="select-filter">Life</th>
                    <th class="select-filter">Friends</th>
                    <th class="select-filter">Tocken</th>
                    <th class="select-filter">Adv</th>
                    <th class="select-filter">Last Start</th>

                    <th class="select-filter">AR</th>
                    <th class="select-filter">!</th>
                    <th class="select-filter">2fa</th>
                    <th class="select-filter">ig</th>
                    <th class="select-filter">Created acc</th>


                    <th class="select-filter">Action</th>
                </tr>
                </thead>

                <tfoot>
                <tr>
                    <th class="select-filter"></th>
                    <th class="select-filter">Name</th>
                    <th class="select-filter">Login</th>
                    <th class="select-filter">Mail</th>
                    <th class="select-filter">Phone</th>
                    <th class="select-filter">gender</th>
                    <th class="select-filter">Avatar</th>
                    <th class="select-filter">Proxy</th>
                    <th class="select-filter">Server</th>
                    <th class="select-filter">Group</th>
                    <th class="select-filter">Status</th>
                    <th class="select-filter">Task</th>
                    <th class="select-filter">Use</th>
                    <th class="select-filter">Life</th>
                    <th class="select-filter">Friends</th>
                    <th class="select-filter">Tocken</th>
                    <th class="select-filter">Adv</th>
                    <th class="select-filter">Last Start</th>

                    <th class="select-filter">AR</th>
                    <th class="select-filter">!</th>
                    <th class="select-filter">2fa</th>
                    <th class="select-filter">ig</th>
                    <th class="select-filter">Created acc</th>


                    <th class="select-filter">Action</th>

                </tr>
                </tfoot>


            </table>
        </form>
    </div>


</main>

<!--<script src="js/bootstrap.bundle.min.js"</script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script src="js/jquery.js"></script>
<script src="js/dtjquery.js"></script>


<script src="js/dataTables.bootstrap.js"></script>
<script type="text/javascript" charset="utf-8" src="js/ColumnFilterWidgets.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $('#alert').delay(5000).fadeOut('slow');

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
        scrollX: false,
        iLeftWidth: 120,
        sLeftWidth: 'relative',
        "lengthMenu": [[30, 100, 250, 500, 1000], [30, 100, 250, 500, 1000]],
        dom: '<"top"lpif<"clear">>rt<"bottom"lpif<"clear">>',


        "ajax": "acc.php",
        "deferRender": true,

        "columns": [

            {mData: 'ids'},
            {mData: 'name'},
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
            {
                mData: 'life'
                //,

                //             render: function (data, type, row) {
                // If display or filter data is requested, format the date
                //                if (type === 'display' || type === 'filter') {
                //                  var d = new Date(data * 1000);

                //                  return d.getDate() + '.' + (d.getMonth() + 1) + '.' + d.getFullYear() + ' - ' + d.getHours() + ':' + d.getMinutes();
            },

            // Otherwise the data type requested (`type`) is type detection or
            // sorting data, for which we want to use the integer, so just return
            // that, unaltered
            //              return data;
            //          }
            //      },
            {mData: 'friends'},
            {mData: 'tocken'},
            {mData: 'adv'},
            {
                mData: 'last_start',
                render: function (data, type, row) {
                    // If display or filter data is requested, format the date
                    if (type === 'display' || type === 'filter') {
                        var d = new Date(data * 1000);

                        return d.getDate() + '.' + (d.getMonth() + 1) + '.' + d.getFullYear() + ' - ' + d.getHours() + ':' + d.getMinutes();
                    }

                    // Otherwise the data type requested (`type`) is type detection or
                    // sorting data, for which we want to use the integer, so just return
                    // that, unaltered
                    return data;
                }
            },

            {mData: 'ar'},
            {mData: 'spst'},
            {mData: 'fa'},
            {mData: 'ig'},
            {
                mData: 'created_acc',
                render: function (data, type, row) {
                    // If display or filter data is requested, format the date
                    if (type === 'display' || type === 'filter') {
                        var d = new Date(data * 1000);

                        return d.getDate() + '.' + (d.getMonth() + 1) + '.' + d.getFullYear();
                    }

                    // Otherwise the data type requested (`type`) is type detection or
                    // sorting data, for which we want to use the integer, so just return
                    // that, unaltered
                    return data;
                }
            },

            {mData: 'action'},

        ],


        "aoColumnDefs":
            [
                {"bSortable": false, "aTargets": [-1]}
            ],


        "sLengthMenu":
            "Records per page: _MENU_",
        "sInfo":
            "Total of _TOTAL_ records (showing _START_ to _END_)",
        "sInfoFiltered":
            "(filtered from _MAX_ total records)",


        'columnDefs':
            [{
                'targets': [0, 5, 6, 7, 8, 9, 10, 12, 13, 15, 16], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
            }],


        initComplete: function () {

            const table = this.api();
            const filterColumns = [5, 6, 8, 12,  15, 16];
            const filterColumnsMultiple = [13, 10, 9, 7];

            table.columns(filterColumns).every(function () {
                const column = this;
                const select = $('<select><option value=""></option></select>')
                    .appendTo($(column.header()))
                    .on('change', function () {
                        const selectedValue = $(this).val();
                        const escapedValue = $.fn.dataTable.util.escapeRegex(selectedValue);

                        column.search(escapedValue ? '^' + escapedValue + '$' : '', true, false).draw();
                        // Save the state of this Select2 widget.
                        localStorage.setItem('select2-' + column.index(), selectedValue);
                    });

                column.data()
                    .unique()
                    .sort()
                    .each(function (d) {
                        select.append($('<option></option>').attr('value', d).text(d));
                    });
                select.select2({
                    placeholder: 'Filter',
                    allowClear: true
                }); // Initialize Select2 on the select element
                // Restore the state of this Select2 widget.
                const savedValue = localStorage.getItem('select2-' + column.index());
                if (savedValue !== null) {
                    select.val(savedValue).trigger('change');
                }
            });

            table.columns(filterColumnsMultiple).every(function () {
                const column = this;
                const select = $('<select multiple></select>')
                    .appendTo($(column.header()))
                    .on('change', function () {
                        const selectedValues = $(this).val();

                        if (!selectedValues || selectedValues.length === 0 || (selectedValues.length === 1 && selectedValues[0] === '')) {
                            column.search('').draw(); // Clear the filter
                            localStorage.removeItem('select2-' + column.index()); // Clear the saved state
                            return;
                        }

                        column.search(selectedValues ? '^(' + selectedValues.join('|') + ')$' : '', true, false).draw(); // Use regex to search for multiple values
                        // Save the state of this Select2 widget.
                        localStorage.setItem('select2-' + column.index(), selectedValues.join(','));
                    });

                column.data()
                    .unique()
                    .sort()
                    .each(function (d) {
                        select.append($('<option></option>').attr('value', d).text(d));
                    });
                select.select2({
                    placeholder: 'Filter',
                    allowClear: true
                }); // Initialize Select2 on the select element
                // Restore the state of this Select2 widget.
                const savedValues = localStorage.getItem('select2-' + column.index());
                if (savedValues !== null) {
                    select.val(savedValues.split(',')).trigger('change');
                }
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

        // Event listener to the Clear Filters button
        $('#clearFiltersBtn').on('click', function () {
            event.preventDefault();

            table.search('').columns().search('').draw(); // Clear the search and column filters
            table.columns().every(function () {
                const column = this;
                const header = $(column.header());
                header.find('select').val(null).trigger('change'); // Clear any select filters
                localStorage.removeItem('select2-' + column.index()); // Clear the saved state
            });
        });

        // Event listener to the two range filtering inputs to redraw on input
        $('#min, #max').keyup(function () {
            table.draw();
        });
    });


</script>

</body>
</html>
