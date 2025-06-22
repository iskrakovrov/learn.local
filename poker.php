<?php
session_start();

// Функция для генерации случайного значения кубика (1-6)
function rollDice() {
    return random_int(1, 6); // Криптографически безопасный генератор
}

// Обработка броска кубиков
if (isset($_POST['roll'])) {
    // Генерация конечных результатов ДО анимации
    $finalResults = [
        rollDice(),
        rollDice(),
        rollDice()
    ];

    // Сохраняем финальные результаты в сессию
    $_SESSION['finalResults'] = $finalResults;

    // Генерация шагов анимации (чисто визуальные)
    $animationSteps = 20;
    $animation = [];
    for ($i = 0; $i < $animationSteps; $i++) {
        $step = [
            $i < $animationSteps - 3 ? rollDice() : $finalResults[0],
            $i < $animationSteps - 2 ? rollDice() : $finalResults[1],
            $i < $animationSteps - 1 ? rollDice() : $finalResults[2]
        ];
        $animation[] = $step;
    }
    $_SESSION['animation'] = $animation;

    // Перенаправляем для предотвращения повторной отправки формы
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Проверяем, есть ли результаты для отображения
$showResults = isset($_SESSION['finalResults']);
$finalResults = $showResults ? $_SESSION['finalResults'] : [1, 1, 1]; // Начальное значение 1
$animation = $showResults ? $_SESSION['animation'] : null;

// Очищаем сессию после использования
unset($_SESSION['animation'], $_SESSION['finalResults']);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Игральные кости CSS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .dice-machine {
            background-color: #5bc0de;
            border-radius: 10px;
            padding: 20px;
            display: inline-block;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            max-width: 100%;
        }
        .dices {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 5px;
            padding: 15px;
            flex-wrap: wrap;
        }
        .dice {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 10px;
            border: 2px solid #333;
            position: relative;
            display: inline-block;
            margin: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .dot {
            width: 12px;
            height: 12px;
            background: black;
            border-radius: 50%;
            position: absolute;
        }
        /* Позиции точек для всех граней */
        .face-1 .dot { top: 50%; left: 50%; transform: translate(-50%, -50%); }
        .face-2 .dot:nth-child(1) { top: 20%; left: 20%; }
        .face-2 .dot:nth-child(2) { bottom: 20%; right: 20%; }
        .face-3 .dot:nth-child(1) { top: 20%; left: 20%; }
        .face-3 .dot:nth-child(2) { top: 50%; left: 50%; transform: translate(-50%, -50%); }
        .face-3 .dot:nth-child(3) { bottom: 20%; right: 20%; }
        .face-4 .dot:nth-child(1) { top: 20%; left: 20%; }
        .face-4 .dot:nth-child(2) { top: 20%; right: 20%; }
        .face-4 .dot:nth-child(3) { bottom: 20%; left: 20%; }
        .face-4 .dot:nth-child(4) { bottom: 20%; right: 20%; }
        .face-5 .dot:nth-child(1) { top: 20%; left: 20%; }
        .face-5 .dot:nth-child(2) { top: 20%; right: 20%; }
        .face-5 .dot:nth-child(3) { top: 50%; left: 50%; transform: translate(-50%, -50%); }
        .face-5 .dot:nth-child(4) { bottom: 20%; left: 20%; }
        .face-5 .dot:nth-child(5) { bottom: 20%; right: 20%; }
        .face-6 .dot:nth-child(1) { top: 20%; left: 20%; }
        .face-6 .dot:nth-child(2) { top: 20%; right: 20%; }
        .face-6 .dot:nth-child(3) { top: 50%; left: 20%; transform: translateY(-50%); }
        .face-6 .dot:nth-child(4) { top: 50%; right: 20%; transform: translateY(-50%); }
        .face-6 .dot:nth-child(5) { bottom: 20%; left: 20%; }
        .face-6 .dot:nth-child(6) { bottom: 20%; right: 20%; }

        /* Анимация вращения */
        @keyframes diceRoll {
            0% { transform: rotate(0deg) scale(1); }
            25% { transform: rotate(90deg) scale(0.9); }
            50% { transform: rotate(180deg) scale(1.1); }
            75% { transform: rotate(270deg) scale(0.95); }
            100% { transform: rotate(360deg) scale(1); }
        }
        .rolling {
            animation: diceRoll 0.5s infinite;
        }

        .result-container {
            opacity: 0;
            height: 0;
            overflow: hidden;
            transition: all 0.5s;
            margin-top: 0;
            font-size: 24px;
            font-weight: bold;
            color: #333;
            background-color: white;
            padding: 0 10px;
            border-radius: 5px;
        }
        .result-container.show {
            opacity: 1;
            height: auto;
            padding: 10px;
            margin-top: 20px;
        }
        button {
            background-color: #f0ad4e;
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
            margin: 10px 0;
        }
        button:hover {
            background-color: #ec971f;
            transform: scale(1.05);
        }
        button:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
            transform: none;
        }
        .sum {
            margin-top: 10px;
            font-size: 20px;
            color: #337ab7;
        }

        @media (max-width: 600px) {
            .dice {
                width: 60px;
                height: 60px;
                margin: 5px;
            }
            .dot {
                width: 10px;
                height: 10px;
            }
        }
    </style>
</head>
<body>
<h1>Игральные кости CSS</h1>

<div class="dice-machine">
    <div class="dices">
        <div class="dice face-1" id="dice1">
            <div class="dot"></div>
        </div>
        <div class="dice face-1" id="dice2">
            <div class="dot"></div>
        </div>
        <div class="dice face-1" id="dice3">
            <div class="dot"></div>
        </div>
    </div>

    <form method="post">
        <button type="submit" name="roll" id="rollBtn">Бросить кости</button>
    </form>

    <div class="result-container" id="resultContainer">
        Результат:
        <span id="result1">1</span>,
        <span id="result2">1</span>,
        <span id="result3">1</span>
        <div class="sum" id="sumEl"></div>
    </div>
</div>

<?php if ($animation): ?>
    <script>
        // Анимация броска кубиков
        const dices = [
            document.getElementById('dice1'),
            document.getElementById('dice2'),
            document.getElementById('dice3')
        ];

        const resultContainer = document.getElementById('resultContainer');
        const resultSpans = [
            document.getElementById('result1'),
            document.getElementById('result2'),
            document.getElementById('result3')
        ];
        const sumEl = document.getElementById('sumEl');
        const rollBtn = document.getElementById('rollBtn');

        rollBtn.disabled = true;

        // Добавляем класс анимации всем кубикам
        dices.forEach(dice => {
            dice.classList.add('rolling');
        });

        const animationSteps = <?= count($animation) ?>;
        const animationData = <?= json_encode($animation) ?>;
        const finalResults = <?= json_encode($finalResults) ?>;

        let currentStep = 0;
        const animationInterval = setInterval(() => {
            if (currentStep >= animationSteps) {
                clearInterval(animationInterval);

                // Устанавливаем финальные значения
                for (let i = 0; i < 3; i++) {
                    // Удаляем все точки
                    while (dices[i].firstChild) {
                        dices[i].removeChild(dices[i].firstChild);
                    }
                    // Добавляем нужное количество точек
                    for (let j = 0; j < finalResults[i]; j++) {
                        const dot = document.createElement('div');
                        dot.className = 'dot';
                        dices[i].appendChild(dot);
                    }
                    // Устанавливаем класс с правильным количеством точек
                    dices[i].className = 'dice face-' + finalResults[i];

                    // Обновляем текстовый результат
                    resultSpans[i].textContent = finalResults[i];
                }

                // Удаляем анимацию
                dices.forEach(dice => {
                    dice.classList.remove('rolling');
                });

                // Показываем сумму
                const sum = finalResults.reduce((a, b) => a + b, 0);
                sumEl.textContent = `Сумма: ${sum}`;

                // Показываем результаты с анимацией
                resultContainer.classList.add('show');

                // Разблокируем кнопку
                rollBtn.disabled = false;
                return;
            }

            // Анимация - меняем количество точек на кубиках
            for (let i = 0; i < 3; i++) {
                const value = animationData[currentStep][i];
                // Удаляем все точки
                while (dices[i].firstChild) {
                    dices[i].removeChild(dices[i].firstChild);
                }
                // Добавляем нужное количество точек
                for (let j = 0; j < value; j++) {
                    const dot = document.createElement('div');
                    dot.className = 'dot';
                    dices[i].appendChild(dot);
                }
                // Устанавливаем класс с правильным количеством точек
                dices[i].className = 'dice face-' + value + ' rolling';
            }

            currentStep++;
        }, 100);
    </script>
<?php endif; ?>
</body>
</html>