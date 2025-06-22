<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Создаем папку tmp если не существует
if (!file_exists('tmp')) {
    mkdir('tmp', 0755, true);
}

// Очистка файлов старше 24 часов
foreach (glob("tmp/saved_spintax_*.txt") as $file) {
    if (filemtime($file) < time() - 86400) {
        unlink($file);
    }
}

include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);

function processSpintax($text, $count = 10, $shingle = 1) {
    $results = [];
    $usedCombinations = [];

    // Восстанавливаем переносы строк из макроса
    $text = str_replace('{-String.Enter-}', "\n", $text);

    for ($i = 0; $i < $count; $i++) {
        $result = $text;
        $combination = [];

        // Обрабатываем вложенные структуры
        while (preg_match('/\{([^{}]*)\}/', $result)) {
            $result = preg_replace_callback(
                '/\{([^{}]*)\}/',
                function($matches) use (&$combination, $shingle, &$usedCombinations) {
                    $options = explode('|', $matches[1]);

                    if ($shingle == 1) {
                        return $options[array_rand($options)];
                    }

                    $prevSelections = array_slice($combination, -($shingle-1));
                    $availableOptions = $options;

                    $attempts = 0;
                    do {
                        $selected = $availableOptions[array_rand($availableOptions)];
                        $newCombination = array_merge($prevSelections, [$selected]);
                        $newCombinationKey = implode('|', $newCombination);
                        $attempts++;

                        if ($attempts > count($options) * 2) {
                            return $options[array_rand($options)];
                        }
                    } while (isset($usedCombinations[$newCombinationKey]) && count($availableOptions) > 1);

                    $combination[] = $selected;
                    $usedCombinations[$newCombinationKey] = true;
                    return $selected;
                },
                $result
            );
        }

        // Форматируем результат
        $result = preg_replace('/\n+/', '{-String.Enter-}', trim($result));
        $result = preg_replace('/\s*\{-String\.Enter-\}\s*/', '{-String.Enter-}', $result);
        $results[] = $result;
    }

    return $results;
}

// Обработка POST-запроса
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $spintaxText = $_POST['spintax_text'] ?? '';
    $count = min(50, max(1, (int)($_POST['count'] ?? 10)));
    $shingle = min(5, max(1, (int)($_POST['shingle'] ?? 1)));

    // Определяем тип действия
    $isCheckNewlines = isset($_POST['check_newlines']);
    $isPreview = isset($_POST['preview']);
    $isSave = isset($_POST['save']);

    if ($isCheckNewlines) {
        // Обработка проверки переносов строки
        $normalizedText = str_replace(["\r\n", "\r"], "\n", $spintaxText);
        $processedText = preg_replace('/\n/', '{-String.Enter-}', $normalizedText);

        // Сохраняем обработанный текст
        $variants = [$processedText];
        $action = 'check_newlines';

        $_SESSION['message'] = [
            'type' => 'info',
            'text' => "Переносы строк заменены на макрос {-String.Enter-}"
        ];
    }
    elseif (!empty($spintaxText)) {
        // Обычная обработка спинтакса
        $variants = processSpintax($spintaxText, $count, $shingle);
        $action = $isSave ? 'save' : 'preview';

        if ($isSave && !empty($variants)) {
            $filename = 'tmp/saved_spintax_'.date('Ymd_His').'.txt';
            $content = implode("\n\n", $variants);
            file_put_contents($filename, $content);

            $_SESSION['message'] = [
                'type' => 'success',
                'text' => "Файл сохранен: <a href='$filename' download class='alert-link'>".basename($filename)."</a> (вариантов: $count, shingle: $shingle)",
                'filename' => $filename
            ];
        }
    }
}

if (isset($_GET['download'])) {
    $filename = 'tmp/' . basename($_GET['download']);
    if (file_exists($filename)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filename).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filename));
        readfile($filename);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Генератор спинтакса</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        /* Стили только для этой страницы */
        .spintax-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .spintax-template-preview {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            font-family: Consolas, monospace;
            white-space: pre-wrap;
            border: 1px solid #dee2e6;
        }
        .spintax-btn-check-newlines {
            background-color: #ffc107;
            border-color: #ffc107;
        }
        .spintax-btn-check-newlines:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
        .spintax-result-text {
            white-space: pre-line;
        }
        .spintax-card {
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
<?php include_once 'inc/header.php'; ?>

<div class="container py-4 spintax-container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-<?= $_SESSION['message']['type'] ?> alert-dismissible fade show">
                    <?= $_SESSION['message']['text'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['message']); endif; ?>

            <div class="card spintax-card">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Генератор спинтакса</h2>
                </div>
                <div class="card-body">
                    <form method="post" id="spintaxForm">
                        <div class="mb-3">
                            <label for="spintaxText" class="form-label">Текст со спинтаксом:</label>
                            <textarea class="form-control" id="spintaxText" name="spintax_text" rows="10" required><?=
                                htmlspecialchars($_POST['spintax_text'] ??
                                    'Введите ваш спинтакс.')
                                ?></textarea>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-3">
                                <label for="count" class="form-label">Количество вариантов:</label>
                                <input type="number" class="form-control" id="count" name="count" min="1" max="50" value="<?= $_POST['count'] ?? 10 ?>">
                            </div>
                            <div class="col-md-3">
                                <label for="shingle" class="form-label">Уровень shingle:</label>
                                <input type="number" class="form-control" id="shingle" name="shingle" min="1" max="5" value="<?= $_POST['shingle'] ?? 1 ?>">
                            </div>
                            <div class="col-md-6 d-flex align-items-end">
                                <div class="btn-group w-100">
                                    <button type="submit" name="preview" value="1" class="btn btn-primary">
                                        <i class="bi bi-eye"></i> Превью
                                    </button>
                                    <button type="submit" name="save" value="1" class="btn btn-success">
                                        <i class="bi bi-save"></i> Сохранить
                                    </button>
                                    <button type="submit" name="check_newlines" value="1" class="btn spintax-btn-check-newlines">
                                        <i class="bi bi-text-paragraph"></i> Переносы
                                    </button>
                                    <button type="button" id="resetForm" class="btn btn-secondary">
                                        <i class="bi bi-arrow-counterclockwise"></i> Сброс
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <?php if (isset($variants) && !empty($variants)): ?>
                <div class="card spintax-card">
                    <div class="card-header bg-white">
                        <h4 class="mb-0">
                            <?php if ($action === 'check_newlines'): ?>
                                <i class="bi bi-code-slash"></i> Шаблон с макросами
                            <?php else: ?>
                                <i class="bi bi-list-check"></i> Результаты (<?= count($variants) ?>)
                            <?php endif; ?>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php if ($action === 'check_newlines'): ?>
                            <div class="spintax-template-preview mb-3"><?= htmlspecialchars($variants[0]) ?></div>
                            <button onclick="copyToClipboard()" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-clipboard"></i> Копировать шаблон
                            </button>
                        <?php else: ?>
                            <?php foreach ($variants as $index => $variant): ?>
                                <div class="mb-3 p-3 bg-light rounded">
                                    <h5>Вариант <?= $index + 1 ?></h5>
                                    <div class="spintax-result-text"><?= nl2br(htmlspecialchars($variant)) ?></div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Сброс формы
    document.getElementById('resetForm').addEventListener('click', function() {
        document.getElementById('spintaxForm').reset();
        document.getElementById('spintaxText').value = '';
        document.getElementById('count').value = 10;
        document.getElementById('shingle').value = 1;
    });

    // Копирование шаблона
    function copyToClipboard() {
        const text = document.querySelector('.spintax-template-preview').innerText;
        navigator.clipboard.writeText(text).then(() => {
            const btn = document.querySelector('[onclick="copyToClipboard()"]');
            btn.innerHTML = '<i class="bi bi-check"></i> Скопировано!';
            setTimeout(() => {
                btn.innerHTML = '<i class="bi bi-clipboard"></i> Копировать шаблон';
            }, 2000);
        });
    }
</script>
</body>
</html>