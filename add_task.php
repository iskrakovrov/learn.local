<!doctype html>
<?php
session_start();
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);
?>
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
    <link href="css/dt.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <title>FB Combo | Add task</title>
</head>
<body>
<?php
include_once 'inc/header.php';
$ids = $_SESSION['ids'];
$numberTemplate = $_SESSION['numberTemplate'];
$i = 0;

$_SESSION['ids'] = $ids;
$_SESSION['numberTemplate'] = $numberTemplate;

// Массив задач для удобного управления
$tasks = [
    // Обязательные задачи (скрытые)
    [
        'value' => 'login.php',
        'label' => '&#9989; Login',
        'type' => 'hidden'
    ],
    [
        'value' => 'global_invite.php',
        'label' => '&#9989; ' . $txtglobali,
        'type' => 'hidden'
    ],

    // Обычные задачи (чекбоксы)
    [
        'value' => 'coockie.php',
        'label' => $txttask2,
        'id' => 'coo'
    ],
    [
        'value' => 'farm.php',
        'label' => $txttask3,
        'id' => 'farm'
    ],
    [
        'value' => '2fa.php',
        'label' => $txttasks5,
        'id' => '2fa'
    ],
    [
        'value' => 'add_mail.php',
        'label' => $txttask30,
        'id' => 'add_mail'
    ],
    [
        'value' => 'filling_accounts.php',
        'label' => $txttask16,
        'id' => 'filling_accounts'
    ],
    [
        'value' => 'new_accounts.php',
        'label' => $txttask4,
        'id' => 'new_accounts'
    ],
    [
        'value' => 'share.php',
        'label' => 'Share',
        'id' => 'share'
    ],
    [
        'value' => 'invite_like.php',
        'label' => 'Invite with reactions',
        'id' => 'invite_like'
    ],
    [
        'value' => 'invite_suggestions.php',
        'label' => $txttask5,
        'id' => 'invite_suggestions'
    ],
    [
        'value' => 'invite_from_group.php',
        'label' => $txttask6,
        'id' => 'invite_from_group'
    ],
    [
        'value' => 'erase_invite.php',
        'label' => $txttask31,
        'id' => 'erase_invite'
    ],
    [
        'value' => '',
        'label' => $txttask7,
        'id' => 'task4',
        'disabled' => true
    ],
    [
        'value' => 'page_invite.php',
        'label' => $txttask8,
        'id' => 'page_invite'
    ],
    [
        'value' => 'invite_to_group.php',
        'label' => $txttask9,
        'id' => 'invite_to_group'
    ],
    [
        'value' => '',
        'label' => $txttask10,
        'id' => 'task6',
        'disabled' => true
    ],
    [
        'value' => 'post_to_profile.php',
        'label' => $txttask11,
        'id' => 'post_to_profile'
    ],
    [
        'value' => 'join_group.php',
        'label' => $txttask12,
        'id' => 'join_group'
    ],
    [
        'value' => 'post_to_group.php',
        'label' => $txttask13,
        'id' => 'post_to_group'
    ],
    [
        'value' => 'a_post_to_group.php',
        'label' => 'Advanced spam in Facebook group (Purchase and activation required)',
        'id' => 'a_post_to_group'
    ],
    [
        'value' => 'commenting.php',
        'label' => 'Like + comments',
        'id' => 'commenting'
    ],

    [
        'value' => '',
        'label' => $txttask17,
        'id' => 'task6',
        'disabled' => true
    ],
    [
        'value' => '',
        'label' => $txttask18,
        'id' => 'task6',
        'disabled' => true
    ],
    [
        'value' => '',
        'label' => $txttask19,
        'id' => 'task6',
        'disabled' => true
    ],
    [
        'value' => 'accept_friends.php',
        'label' => $txttask21,
        'id' => 'accept_friends'
    ],
    [
        'value' => 'comoai.php',
        'label' => 'Comments OpenAi',
        'id' => 'comoai'
    ],
    [
        'value' => 'post_oai.php',
        'label' => 'Posting profile OpenAi',
        'id' => 'post_oai'
    ],
    [
        'value' => '',
        'label' => $txttask22,
        'id' => 'task6',
        'disabled' => true
    ],
    [
        'value' => 'review_page.php',
        'label' => 'Page Review',
        'id' => 'review_page'
    ],
    [
        'value' => 'rss_post.php',
        'label' => 'Rss posting',
        'id' => 'rss_post'
    ],
    [
        'value' => 'create_pages.php',
        'label' => $txttask23,
        'id' => 'create_pages'
    ],
    [
        'value' => 'mess_sbor.php',
        'label' => $txttask24,
        'id' => 'mess_sbor'
    ],
    [
        'value' => '',
        'label' => $txttask25,
        'id' => 'task6',
        'disabled' => true
    ],
    [
        'value' => 'happy.php',
        'label' => $txttask26,
        'id' => 'happy'
    ],
    [
        'value' => '',
        'label' => $txttask27,
        'id' => 'task6',
        'disabled' => true
    ],
    [
        'value' => 'banhammer.php',
        'label' => $txttask28,
        'id' => 'banhammer'
    ],
    [
        'value' => 'parse_group.php',
        'label' => $txttask40,
        'id' => 'parse_group'
    ],
    [
        'value' => 'parse_active.php',
        'label' => 'Parse active users',
        'id' => 'parse_active'
    ]
];
?>
<main class="container-fluid ">
    <div class="row text-center">
        <h2>Add task</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <div class="alert alert-info" role="alert">
                <?php echo $txttask1?>
            </div>

            <form method="post" action="tasks.php">
                <div class="row justify-content-md-center">
                    <div class="col-sm-4">
                        <?php foreach ($tasks as $task): ?>
                            <div class="form-check">
                                <?php if ($task['type'] === 'hidden'): ?>
                                    <div style="align-content: flex-start"><?php echo $task['label'] ?></div>
                                    <input type="hidden" name="task[]" value="<?php echo $task['value'] ?>">
                                <?php else: ?>
                                    <input class="form-check-input"
                                           name="task[]"
                                           type="checkbox"
                                           value="<?php echo $task['value'] ?>"
                                           id="<?php echo $task['id'] ?>"
                                        <?php echo isset($task['disabled']) && $task['disabled'] ? 'disabled' : '' ?>>
                                    <label class="form-check-label" for="<?php echo $task['id'] ?>">
                                        <?php echo $task['label'] ?>
                                    </label>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <br>
                <button class="btn btn-secondary" name="i" value="0">ADD TASK</button>
            </form>
        </div>
    </div>
</main>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>