<?php
// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["images"])) {
    // Проверяем наличие текста и URL
    $textList = isset($_POST["text_list"]) ? $_POST["text_list"] : [];
    $url = isset($_POST["url"]) ? $_POST["url"] : '';

    // Создаем папку для страниц
    $pagesDir = 'pages/';
    if (!file_exists($pagesDir)) {
        mkdir($pagesDir, 0777, true);
    }

    // Массив для хранения ссылок на созданные страницы
    $pageLinks = [];

    // Цикл по каждому файлу
    foreach ($_FILES["images"]["error"] as $key => $error) {
        // Проверяем наличие ошибок
        if ($error == UPLOAD_ERR_OK) {
            // Получаем информацию о файле
            $tmp_name = $_FILES["images"]["tmp_name"][$key];
            $name = basename($_FILES["images"]["name"][$key]);

            // Генерируем уникальное имя для файла
            $extension = pathinfo($name, PATHINFO_EXTENSION);
            $newFileName = 'image_' . uniqid() . '.' . $extension;

            // Генерируем уникальное имя для страницы
            $pageName = 'page_' . uniqid() . '.html';
            $pagePath = $pagesDir . $pageName;

            // Копируем файл на сервер
            move_uploaded_file($tmp_name, 'uploads/' . $newFileName);

            // Создаем HTML для страницы
            $html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Page</title>
    <meta property="og:title" content="Image Page">
    <meta property="og:image" content="../uploads/' . $newFileName . '">
    <meta property="og:description" content="' . ($key < count($textList) ? $textList[$key] : '') . '">
    <meta property="og:url" content="' . $url . '">
</head>
<body>
    <img src="../uploads/' . $newFileName . '" alt="Image">
    <p>' . ($key < count($textList) ? $textList[$key] : '') . '</p>
    <a href="' . $url . '">Link</a>
</body>
</html>';

            // Сохраняем HTML в файл
            file_put_contents($pagePath, $html);

            // Добавляем ссылку на страницу в массив
            $pageLinks[] = $pagePath;
        }
    }

    // Выводим ссылки на созданные страницы
    echo "<ul>";
    foreach ($pageLinks as $link) {
        echo "<li><a href=\"$link\">$link</a></li>";
    }
    echo "</ul>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Выбор картинок</title>
    <style>
        #file-input {
            display: none;
        }
        #select-images {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
        }
        #select-images:hover {
            background-color: #0056b3;
        }
        #upload-button, #clear-button {
            display: none;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        #upload-button:hover, #clear-button:hover {
            background-color: #0056b3;
        }
        #preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }
        .preview-image {
            width: 200px;
            height: 200px;
            overflow: hidden;
            position: relative;
        }
        .preview-image img {
            width: 100%;
            height: auto;
            display: block;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .remove-button {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: rgba(255, 255, 255, 0.7);
            border: none;
            border-radius: 50%;
            padding: 5px;
            cursor: pointer;
        }
        .remove-button:hover {
            background-color: rgba(255, 255, 255, 0.9);
        }
    </style>
</head>
<body>
<form id="upload-form" method="post" enctype="multipart/form-data">
    <label for="file-input" id="select-images">Выбрать картинки</label>
    <input id="file-input" type="file" name="images[]" multiple accept="image/jpeg, image/png">
    <div id="preview-container"></div>
    <button id="upload-button" type="submit">Загрузить</button>
    <button id="clear-button" type="button">Очистить</button>
</form>

<script>
    document.getElementById('file-input').addEventListener('change', function(event) {
        var files = event.target.files;
        var previewContainer = document.getElementById('preview-container');
        var uploadButton = document.getElementById('upload-button');
        var clearButton = document.getElementById('clear-button');

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.onload = function(e) {
                var img = document.createElement('img');
                img.src = e.target.result;

                var previewImage = document.createElement('div');
                previewImage.className = 'preview-image';
                previewImage.appendChild(img);

                var removeButton = document.createElement('button');
                removeButton.className = 'remove-button';
                removeButton.textContent = 'X';
                removeButton.addEventListener('click', function() {
                    previewContainer.removeChild(previewImage);
                    if (previewContainer.childElementCount === 0) {
                        uploadButton.style.display = 'none';
                        clearButton.style.display = 'none';
                    }
                });

                previewImage.appendChild(removeButton);

                previewContainer.appendChild(previewImage);
            };

            reader.readAsDataURL(file);
        }

        if (files.length > 0) {
            uploadButton.style.display = 'block';
            clearButton.style.display = 'block';
        } else {
            uploadButton.style.display = 'none';
            clearButton.style.display = 'none';
        }
    });

    document.getElementById('clear-button').addEventListener('click', function() {
        document.getElementById('file-input').value = ''; // Очистить выбранные файлы
        document.getElementById('preview-container').innerHTML = ''; // Очистить предпросмотр
        document.getElementById('upload-button').style.display = 'none'; // Скрыть кнопку "Загрузить"
        this.style.display = 'none'; // Скрыть кнопку "Очистить"
    });
</script>
</body>
</html>
