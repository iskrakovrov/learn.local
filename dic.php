<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dictator Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h1 class="text-center">Dictator Game</h1>
    <p class="text-muted text-center">Управляйте страной и удерживайте власть!</p>
    <hr>

    <?php
    session_start();

    if (!isset($_SESSION['groups'])) {
        $_SESSION['groups'] = [
            "Крестьяне" => 50,
            "Армия" => 50,
            "Партизаны" => 50,
            "Олигархи" => 50,
            "Тайная полиция" => 50,
            "США" => 50
        ];
        $_SESSION['resources'] = [
            "Казна" => 1000,
            "Репутация" => 50
        ];
        $_SESSION['turns'] = 0;
    }

    $groups = &$_SESSION['groups'];
    $resources = &$_SESSION['resources'];
    $turns = &$_SESSION['turns'];
    $maxTurns = 20;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $choice = $_POST['choice'];
        $event = $_POST['event'];
        $turns++;

        switch ($event) {
            case "Раздача продовольствия крестьянам":
                if ($choice == "1") {
                    $groups["Крестьяне"] += 20;
                    $groups["Олигархи"] -= 10;
                    $resources["Казна"] -= 100;
                } elseif ($choice == "2") {
                    $groups["Крестьяне"] -= 10;
                } elseif ($choice == "3") {
                    $groups["Крестьяне"] -= 20;
                    $groups["Тайная полиция"] += 10;
                }
                break;

            case "Закупка оружия для армии":
                if ($choice == "1") {
                    $groups["Армия"] += 20;
                    $resources["Казна"] -= 200;
                } elseif ($choice == "2") {
                    $groups["Армия"] -= 10;
                } elseif ($choice == "3") {
                    $groups["Армия"] += 10;
                    $groups["Крестьяне"] -= 5;
                }
                break;

            case "Принятие помощи от США":
                if ($choice == "1") {
                    $groups["США"] += 10;
                    $resources["Казна"] += 200;
                    $groups["Партизаны"] -= 10;
                } elseif ($choice == "2") {
                    $groups["США"] -= 10;
                } elseif ($choice == "3") {
                    $groups["США"] -= 20;
                    $groups["Тайная полиция"] += 10;
                }
                break;

            case "Военная помощь от США":
                if ($choice == "1") {
                    $groups["Армия"] += 20;
                    $groups["США"] += 10;
                    $resources["Казна"] -= 100;
                } elseif ($choice == "2") {
                    $groups["США"] -= 10;
                } elseif ($choice == "3") {
                    $groups["Партизаны"] += 10;
                    $groups["США"] -= 20;
                }
                break;

            case "Санкции США":
                if ($choice == "1") {
                    $groups["США"] += 10;
                    $resources["Казна"] -= 300;
                    $resources["Репутация"] -= 10;
                } elseif ($choice == "2") {
                    $groups["США"] -= 20;
                    $groups["Тайная полиция"] += 10;
                } elseif ($choice == "3") {
                    $resources["Репутация"] -= 20;
                    $groups["США"] -= 30;
                }
                break;

            case "Игнорирование текущих проблем":
                foreach ($groups as $group => $loyalty) {
                    $groups[$group] -= rand(1, 5);
                }
                break;
        }

        if ($resources["Казна"] <= 0 || $turns >= $maxTurns) {
            echo "<div class='alert alert-danger'>Казна пуста или ходов больше нет. Игра окончена.</div>";
            session_destroy();
        } else {
            foreach ($groups as $group => $loyalty) {
                if ($loyalty <= 0) {
                    echo "<div class='alert alert-danger'>$group подняли восстание! Игра окончена.</div>";
                    session_destroy();
                }
            }
        }
    }

    if (empty($_POST) || !isset($event)) {
        $events = [
            "Раздача продовольствия крестьянам",
            "Закупка оружия для армии",
            "Принятие помощи от США",
            "Военная помощь от США",
            "Санкции США",
            "Игнорирование текущих проблем"
        ];
        $event = $events[array_rand($events)];
    }
    ?>

    <div class="row">
        <div class="col-md-6">
            <h4>Состояние страны:</h4>
            <ul class="list-group">
                <?php foreach ($groups as $group => $loyalty): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= $group ?>
                        <span class="badge bg-primary"><?= $loyalty ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col-md-6">
            <h4>Ресурсы:</h4>
            <ul class="list-group">
                <li class="list-group-item">Казна: <?= $resources['Казна'] ?></li>
                <li class="list-group-item">Репутация: <?= $resources['Репутация'] ?></li>
                <li class="list-group-item">Ход: <?= $turns ?>/<?= $maxTurns ?></li>
            </ul>
        </div>
    </div>
    <hr>

    <h4>Текущее событие:</h4>
    <p class="alert alert-info"><?= $event ?></p>

    <form method="POST">
        <input type="hidden" name="event" value="<?= $event ?>">
        <div class="d-flex gap-2">
            <button type="submit" name="choice" value="1" class="btn btn-success">Поддержать</button>
            <button type="submit" name="choice" value="2" class="btn btn-secondary">Игнорировать</button>
            <button type="submit" name="choice" value="3" class="btn btn-danger">Подавить</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
