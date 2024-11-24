<?php
include_once 'inc/init.php';
require_once 'inc/db.php';
require_once 'function/function.php';
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] . '.php' : 'default_lang.php';
if (!file_exists($lang)) {
    die('Language file not found.');
}
require_once $lang;

$sql = "SELECT * FROM group_acc";
$gg = selectAll($sql);
$sql = "SELECT * FROM servers";
$ss = selectAll($sql);
$sql = "SELECT * FROM group_proxy";
$pp = selectAll($sql);
$sql = "SELECT * FROM account_tags";
$at = selectAll($sql);
$sql = "SELECT DISTINCT(
    SUBSTRING_INDEX(SUBSTRING_INDEX(setup, '\"ntask\":\"', -1), '\"', 1)
) AS ntask
        FROM task
        WHERE task = 'post_to_group';";
$ntasks = selectall($sql);
?>
<!doctype html>
<html lang="en">
<head>

    <?php
    require_once 'inc/meta.php';
    ?>


    <title>FB Combo</title>
    <style>div.dataTables_length {

            padding-left: 2em;

        }

        div.dataTables_length,
        div.dataTables_filter {

            padding-top: 0.55em;

        }

        #settings-panel {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .toggle-column {
            margin-left: 10px;
        }
    </style>


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

    <div class="fixed-counter">
        Checked: <span id="checked">0</span> / Total: <span id="total">0</span>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="min">Min Friends:</label>
            <input type="number" id="min" class="form-control" placeholder="Min Friends">
        </div>
        <div class="col-md-6">
            <label for="max">Max Friends:</label>
            <input type="number" id="max" class="form-control" placeholder="Max Friends">
        </div>
    </div>
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
                    <th class="select-filter">gender</th>
                    <th class="select-filter">Avatar</th>
                    <th class="select-filter">Proxy</th>
                    <th class="select-filter">Server</th>
                    <th class="select-filter">Group</th>
                    <th class="select-filter">Tag</th>
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
                    <th
                    </th>
                    <th colspan="24" class="select-filter"></th>
                </tr>
                </tfoot>


            </table>
        </form>
    </div>


</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<!--<script src="js/bootstrap.bundle.min.js"</script> -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.js"></script>


<script src="js/dataTables.bootstrap.js"></script>




<script type="text/javascript" src="js/shCore.js"></script>

<link rel="stylesheet" type="text/css"
      href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">

<script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/ColumnFilterWidgets.js"></script>


<script>
    $('#alert').delay(5000).fadeOut('slow');





    $('#all').click(function (e) {
        $('#dr_table tbody :checkbox').prop('checked', $(this).is(':checked'));
        e.stopImmediatePropagation();
    });


    let dr_table;

    dr_table = $('#dr_table').DataTable({
        select: {
            style: 'multi' // Включаем множественный выбор
        },
        orderClasses: false,
        stateSave: true,
        searching: true,
        "processing": true, // Показывать индикатор загрузки
        "serverSide": true, // Включаем серверную обработку
        orderCellsTop: true,
        scrollX: false,
        "lengthMenu": [[30, 100, 250, 500, 1500, 5000], [30, 100, 250, 500, 1500, 5000]],
        dom: '<"top"lpif<"clear">>rt<"bottom"lpif<"clear">>',

        // Указываем URL для сервера, который будет обрабатывать запрос
        ajax: {
            url: 'acc3.php', // Ваш серверный скрипт
            type: 'POST',
            "deferRender": true,
            data: function (d) {
                // Параметры для серверной обработки
                d.min = $('#min').val();
                d.max = $('#max').val();
                d.orderColumn = d.order[0].column; // Номер столбца для сортировки
                d.orderDir = d.order[0].dir; // Направление сортировки
            }
        },

        "columns": [
            {
                mData: 'ids',
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    return '<div style="text-align: center;"><input class="chk" type="checkbox" name="a[]" value="' + row.action + '"></div>';
                }
            },
            {mData: 'name', orderable: true},
            {
                mData: 'login',
                orderable: true,
                render: function (data, type, row) {
                    var lfb;

                    if (row.idf !== '') {
                        lfb = '<a href="https://facebook.com/' + row.idf + '" target="_blank">' + data + '</a>';
                    } else {
                        lfb = data;
                    }

                    return lfb;
                }
            },
            {mData: 'mail', orderable: true},
            {
                mData: 'phone',
                orderable: true,
                render: function (data, type, row) {
                    // Если значение данных равно NULL, вернуть пустую строку
                    if (data === 'NULL') {
                        return '';
                    } else {
                        return data; // Вернуть исходное значение данных
                    }
                }
            },
            {mData: 'gender', orderable: false},
            {mData: 'avatar', orderable: false},
            {mData: 'proxy', orderable: false},
            {mData: 'server', orderable: false},
            {mData: 'group', orderable: false},
            {mData: 'tag', orderable: false},
            {
                mData: 'status',
                orderable: false,
            },
            {mData: 'task', orderable: false},
            {mData: 'use', orderable: false},
            {mData: 'life', orderable: false},
            {
                mData: 'friends',
                orderable: true,
                render: function (data, type, row) {
                    var friends1 = row.friends1;
                    var fd = (data !== null) ? data - friends1 : 0;
                    var displayedData = (data !== null) ? data : 0;

                    if (fd > 0) {
                        // Если friends больше friends1
                        return '<span style="font-weight: bold; color: #50dd24;">' + displayedData + '</span>';
                    } else if (fd < 0) {
                        // Если friends меньше friends1
                        return '<span style="font-weight: bold; color: red;">' + displayedData + '</span>';
                    } else {
                        // Если friends равно friends1
                        return '<span style="font-weight: bold;">' + displayedData + '</span>';
                    }
                }
            },
            {mData: 'tocken', orderable: false},
            {mData: 'adv', orderable: false},
            {
                mData: 'last_start',
                orderable: true,
                render: function (data, type, row) {
                    // If display or filter data is requested, format the date
                    if (type === 'display' || type === 'filter') {
                        var d = new Date(data * 1000);

                        return d.getDate() + '.' + (d.getMonth() + 1) + '.' + d.getFullYear() + ' - ' + d.getHours() + ':' + d.getMinutes();
                    }

                    // Otherwise the data type requested (type) is type detection or
                    // sorting data, for which we want to use the integer, so just return
                    // that, unaltered
                    return data;
                }
            },
            {mData: 'ar', orderable: false},
            {mData: 'spst', orderable: false},
            {mData: 'fa', orderable: false},
            {mData: 'ig', orderable: false},
            {
                mData: 'created_acc',
                orderable: true,
                render: function (data, type, row) {
                    // If display or filter data is requested, format the date
                    if (type === 'display' || type === 'filter') {
                        var d = new Date(data * 1000);

                        return d.getDate() + '.' + (d.getMonth() + 1) + '.' + d.getFullYear();
                    }

                    // Otherwise the data type requested (type) is type detection or
                    // sorting data, for which we want to use the integer, so just return
                    // that, unaltered
                    return data;
                }
            },
            {
                mData: 'action',
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    return '<div class="btn-group">' +
                        '<a href="edit_account.php?id=' + data + '" class="btn btn-success" title="Edit"><i class="bi bi-pencil-square"></i></a>' +
                        '<a href="stat_account.php?id=' + data + '" class="btn btn-success" title="Stat"><i class="bi bi-star"></i></a>' +
                        '<a href="del_account.php?id=' + data + '" class="btn btn-danger" title="Del"><i class="bi bi-x-circle-fill"></i></a>' +
                        '</div>';
                }
            }
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


        // Show or hide columns based on DataTables saved state
        var state = dr_table.state.loaded();
        if (state) {
            // Apply the visibility settings from the saved state
            $.each(state.columns, function (index, column) {
                dr_table.column(index).visible(column.visible);
                $('#settings-panel .toggle-column[data-column="' + index + '"]').prop('checked', column.visible);
            });
        } else {
            // If no saved state, use default behavior
            $('#settings-panel .toggle-column').prop('checked', true);
        }

        // Toggle columns when checkbox is clicked
        $('#settings-panel .toggle-column').on('change', function () {
            var column = dr_table.column($(this).data('column'));
            column.visible($(this).prop('checked'));
        });
        $('#showAllBtn').on('click', function () {
            event.preventDefault();
            localStorage.removeItem('tableSettings'); // Clear the saved columns state
            dr_table.columns().visible(true);
            $('#settings-panel .toggle-column').prop('checked', true);
        });
    });


</script>




</body>
</html>