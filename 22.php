<script>

    $(document).ready(function () {
        $('#example').DataTable({
            processing: true,
            serverSide: false,
            ajax: 'acc.php',
        });
    });


</script>



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

        "ajax": "acc.php",
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