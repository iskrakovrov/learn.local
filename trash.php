<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="css/dt.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <title>FB Combo | Trash</title>
</head>
<?php
$sql = 'SELECT * FROM trash';
$query = selectAll($sql);

?>
<body>
<?php
include_once 'inc/header.php'

?>

<main class="container-fluid ">
    <div class="row text-center">
        <h2>Trash</h2>
    </div>
    <div class="row">
        <div class="col text-center">

            <div class="row justify-content-center">
                <div class="col-6 text-center">
                    <div class="alert alert-info" role="alert">
                        Инструкция
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="container-fluid">


        <br>
        <form>
            <div class="input-group">
                <select name="act" class="custom-select">
                    <option value="" selected>[Что делать с отмеченными]</option>
                    <option value="add_task">Добавить задание</option>
                    <option value="set_state_free">Установить состояние "Свободен"</option>


                    <option value="clear_tasks">Удалить все задания</option>


                    <option value="" disabled="disabled">----------</option>
                    <option value="add_to_group_1">Добавить в группу "Киев"</option>
                    <option value="add_to_group_2">Добавить в группу "Одесса"</option>
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
                        <a class="btn btn-secondary" href="add_accounts_mode.php" role="button">Add accounts</a>
                        <a class="btn btn-secondary" href="#" role="button">Add task</a>

                        <a class="btn btn-danger" href="#" role="button">Empty Trash</a>
                    </div>
                </div>


            </div>
            <br>
            <table id="dr_table" class="cell-border" style="width:100%">
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
                    <th>Proxy On</th>
                    <th>Server</th>
                    <th>Group</th>
                    <th>Status</th>
                    <th>Task</th>
                    <th>Use</th>
                    <th>Create</th>
                    <th>Friends</th>
                    <th>Tocken</th>
                    <th>ADV</th>
                    <th>Last Start</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                foreach ($query as $a) {
                    $i++; ?>
                    <tr>
                        <td style="text-align: center;"><input type="checkbox" name="a[]"
                                                               value="<?php echo $a['id_acc'] ?>">
                        </td>
                        <td><?php echo $a['login_fb'] ?></td>
                        <td><?php
                            $id_acc = $a['id_acc'];
                            $sql1 = "SELECT * FROM mail WHERE id_acc = ?";
                            $args1 = [$id_acc];
                            $query1 = select($sql1, $args1);
                            $mail = $query1['mail'];
                            echo $mail ?></td>
                        <td><?php
                            $id_acc = $a['id_acc'];
                            $sql1 = "SELECT * FROM phones WHERE id_acc = ?";
                            $args1 = [$id_acc];
                            $query1 = select($sql1, $args1);
                            $mail = $query1['phone'];
                            echo $mail ?></td>

                        <td><?php echo $a['gender'] ?></td>
                        <td><?php echo $a['avatar'] ?></td>
                        <td><?php
                            $id_acc = $a['id_acc'];
                            $proxy = $a['proxy'];
                            $sql1 = "SELECT id_proxy FROM accounts WHERE id_acc = ?";
                            $args1 = [$id_acc];
                            $query1 = select($sql1, $args1);
                            if (empty($query1['proxy'])) {
                                $pr = "OFF";
                            } else {
                                $pr = "ON";
                            }
                            echo $pr ?></td>
                        <td><?php
                            $id_serv = $a['server'];
                            $sql1 = "SELECT * FROM servers WHERE id_server = ?";
                            $args1 = [$id_serv];
                            $query1 = select($sql1, $args1);
                            $serv = $query1['name_server'];
                            echo $serv ?></td>
                        <td><?php
                            $id_gr = $a['group_acc'];
                            $sql1 = "SELECT * FROM group_acc WHERE id_gr = ?";
                            $args1 = [$id_gr];
                            $query1 = select($sql1, $args1);
                            $gr = $query1['name_group'];
                            echo $gr ?></td>
                        <td><?php
                            $id_st = $a['status'];
                            if (empty($id_st)) {
                                $id_st = 0;
                            }
                            $sql1 = "SELECT * FROM status WHERE id_status = ?";
                            $args1 = [$id_st];
                            $query1 = select($sql1, $args1);
                            $stat = $query1['status'];
                            echo $stat ?></td>
                        <td>17</td>
                        <td><?php echo $a['useacc'] ?></td>


                        <td><?php echo date ('d/m/Y',$a['created']) ?></td>
                        <td><?php echo $a['friends'] ?></td>
                        <td>OFF</td>
                        <td>OFF</td>
                        <td><?php echo $a['last_start'] ?></td>


                        <td>
                            <div class="col">
                                <a href="edit_account.php?id=<?php echo $a['id_acc'] ?>" class="btn btn-success" title="Edit" ><i class="bi bi-pencil-square"></i></a>
                                <a href="stat_account.php?id=<?php echo $a['id_acc'] ?>" class="btn btn-success" title="Statistics"><i class="bi bi-star"></i></a>
                                <a href="del_account.php?id=<?php echo $a['id_acc'] ?>" class="btn btn-danger" title="Delete Account" onClick="return confirm( 'WARNING!!! DELETE ACCOUNT?' )"><i class="bi bi-x-circle-fill"></i></a>



                            </div>
                        </td>
                    </tr>

                <?php } ?>


                </tbody>
                <tfoot>
                <tr>
                    <th></th>
                    <th>Login</th>
                    <th>Mail</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Avatar</th>
                    <th>Proxy On</th>
                    <th>Server</th>
                    <th>Group</th>
                    <th>Status</th>
                    <th></th>
                    <th>Use</th>
                    <th></th>
                    <th></th>
                    <th>Tocken</th>
                    <th>ADV</th>
                    <th></th>
                    <th></th>

                </tr>
                </tfoot>
            </table>
        </form>
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
        $('#dr_table tbody :checkbox').prop('checked', $(this).is(':checked'));
        e.stopImmediatePropagation();
    });


    let dr_table;

    function add_dd(column) {
        let select = $('<select class="form-control-sm"><option value=""Search</option></select>')
            .appendTo($(column.footer()).empty())
            .on('change', function () {
                var val = $(this).val();
                column.search(val ? val : '', true, false).draw();
            });

        column.data().unique().sort().each(function (d, j) {
            select.append('<option value="' + d + '">' + d + '</option>')
        });
    }

    $(function () {
        $('#dr_table tfoot th').each(function () {
            let title = $('#dr_table thead th').eq($(this).index()).text();

            if (title == "Login") {
                $(this).html('<input type="text" class="form-control-sm datatable-filter" placeholder="Search" size="10" />');
            } else if (title == "Mail") {
                $(this).html('<input type="text" class="form-control-sm datatable-filter" placeholder="Search" size="10" />');
            } else if (title == "Phone") {
                $(this).html('<input type="text" class="form-control-sm datatable-filter" placeholder="Search" size="10" />');
            } else if (title == "Name") {
                $(this).html('<input type="text" class="form-control-sm datatable-filter" placeholder="Search" size="10" />');
            }
        });

        dr_table = $('#dr_table').DataTable({

            "lengthMenu": [[100, 300, 500, 1000, 3000, -1], [100, 300, 500, 1000, 3000, "All"]],
            stateSave: true,
            //       scrollX: true,
            fixedColumns: {
                leftColumns: 1
            },


            "initComplete": function () {
                // Enable search box
                let r = $('#dr_table tfoot tr');
                r.find('th').each(function () {
                    $(this).css('padding', 8);
                });
                $('#dr_table thead').append(r);

                let api = this.api();

                // Add dd search box
                add_dd(api.column(4));
                add_dd(api.column(5));
                add_dd(api.column(6));
                add_dd(api.column(7));
                add_dd(api.column(8));
                add_dd(api.column(9));
                add_dd(api.column(11));
                add_dd(api.column(14));
                add_dd(api.column(15));

            }
        });

        // Apply the search
        dr_table.columns().eq(0).each(function (colIdx) {
            $('input', dr_table.column(colIdx).footer()).on('keyup change', function () {
                let search_text = this.value;
                dr_table.column(colIdx).search(search_text).draw();
            });
        });
    });


</script>
</body>
</html>
