<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Таблица с данными</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Таблица с данными</h1>

    <!-- Здесь будет отображаться количество записей -->
    <div id="recordsCount" style="font-weight: bold; margin-bottom: 10px;"></div>

    <table id="myTable" class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>
                Имя
                <select id="nameFilter" class="form-control form-control-sm">
                    <option value="">Все</option>
                    <!-- Опции будут загружаться с сервера -->
                </select>
            </th>
            <th>Друзья</th>
            <th>Сервер</th>
            <th>Время</th>
        </tr>
        </thead>
        <tbody>
        <!-- Данные таблицы будут загружаться сюда -->
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables.net@1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        // Инициализация DataTable с AJAX
        var table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: 'ajax_handler.php',  // Адрес обработчика
                type: 'GET',
                dataSrc: function(json) {
                    // Пишем количество записей рандомным цветом
                    var randomColor = getRandomColor();
                    $('#recordsCount').text('Records fetched: ' + json.recordsTotal)
                        .css('color', randomColor);
                    return json.data;
                }
            },
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'friends' },
                { data: 'server' },
                { data: 'time' }
            ],
            order: [[0, 'asc']],  // Сортировка по первому столбцу по умолчанию
            pageLength: 10,  // Количество записей на странице
            columnDefs: [
                {
                    targets: [1], // Столбец "Имя"
                    orderable: false // Отключаем сортировку для столбца "Имя"
                }
            ]
        });

        // Функция для генерации случайного цвета
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        // Загружаем уникальные значения для фильтра "Имя" в выпадающий список
        $.ajax({
            url: 'ajax_handler.php',  // Запрос к серверу для получения уникальных имен
            type: 'GET',
            data: { action: 'getNames' },
            success: function(data) {
                // Проверка на правильный формат данных
                console.log('Полученные данные:', data);  // Проверяем, что именно приходит с сервера

                // Если данные корректны (массив 'names' существует и является массивом)
                if (data && data.names && Array.isArray(data.names)) {
                    var nameFilter = $('#nameFilter');
                    nameFilter.empty();  // Очищаем старые опции
                    nameFilter.append('<option value="">Все</option>');  // Добавляем "Все" по умолчанию

                    // Добавляем каждое имя в выпадающий список
                    data.names.forEach(function(name) {
                        nameFilter.append('<option value="' + name + '">' + name + '</option>');
                    });
                } else {
                    console.error('Не удалось получить имена или неправильный формат данных', data);
                    alert('Ошибка при получении данных для фильтра "Имя". Проверьте консоль для подробностей.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Ошибка запроса:', error);
                alert('Ошибка при загрузке данных с сервера.');
            }
        });

        // Обновляем таблицу при изменении фильтра в столбце
        $('#nameFilter').change(function() {
            table.ajax.reload();
        });
    });
</script>
</body>
</html>
