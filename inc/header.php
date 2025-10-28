<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
require_once('inc/version.php');

// Создаем папку cache если ее нет
if (!file_exists('cache')) {
    mkdir('cache', 0755, true);
}

// Файлы для хранения данных
define('CHANGE_LOG_LAST_MODIFIED_FILE', 'cache/cl_last_modified.txt');
define('CHANGE_LOG_LAST_READ_FILE', 'cache/cl_last_read.txt');

// Функция проверки обновлений Change Log
function checkChangeLogUpdates() {
    $remoteUrl = 'http://soft.fbcombo.com/cl.txt';

    // Получаем заголовки с сервера
    $headers = @get_headers($remoteUrl, 1);

    if ($headers && isset($headers['Last-Modified'])) {
        $lastModified = strtotime($headers['Last-Modified']);

        // Сохраняем последнее время изменения
        file_put_contents(CHANGE_LOG_LAST_MODIFIED_FILE, $lastModified);

        // Получаем время последнего прочтения
        $lastRead = file_exists(CHANGE_LOG_LAST_READ_FILE)
            ? (int)file_get_contents(CHANGE_LOG_LAST_READ_FILE)
            : 0;

        // Если файл изменялся после последнего прочтения
        return $lastModified > $lastRead;
    }

    return false;
}

$hasChangeLogUpdates = checkChangeLogUpdates();

// Запросы к базе данных
$sql = 'SELECT * FROM servers';
$se = selectAll($sql);
$sql = 'SELECT COUNT(*) FROM accounts';
$acc = select($sql);
$sql = 'SELECT COUNT(*) FROM proxy';
$cpr = select($sql);
$sql = 'SELECT COUNT(*) FROM err';
$err = select($sql);
$a = $acc['COUNT(*)'];
$cp = $cpr['COUNT(*)'];
$er = $err['COUNT(*)'];
$sql = 'SELECT COUNT(*) FROM accounts where useacc = 1';
$wrk = select($sql);
$wo = $wrk['COUNT(*)'];
$sql = 'SELECT COUNT(DISTINCT `account`) FROM task';
$t = select($sql);
$tas = $t['COUNT(DISTINCT `account`)'];
$sql = 'SELECT COUNT(*) FROM templates';
$templ = select($sql);
$templ = $templ['COUNT(*)'];
$homepage = file_get_contents('https://soft.fbcombo.com/ver.php');

?>
<style>
    #navbarSupportedContent > ul > li > a > span {
        background-color: #0d6efd;
    }

    #navbarSupportedContent > ul > li:nth-child(1) > ul > li:nth-child(6) > a > span {
        background-color: #0d6efd;
    }

    #navbarSupportedContent > ul > li:nth-child(12) > a > strong {
        color: #27ff00;
    }

    #navbarSupportedContent > ul.nav.justify-content-end > li:nth-child(1) > a {
        color: aliceblue;
    }

    #navbarSupportedContent > ul.nav.justify-content-end > li:nth-child(2) > a {
        color: aliceblue;
    }

    .navbar-brand img {
        transition: transform 0.3s ease;
        margin-right: 10px;
        max-height: 40px;
    }
    .navbar-brand img:hover {
        transform: scale(1.05);
    }
    .navbar-brand {
        display: flex;
        align-items: center;
    }
    .brand-text {
        font-weight: bold;
        margin-left: 10px;
        color: white;
    }
    .change-log-updated {
        position: relative;
    }
    .change-log-updated::after {
        content: "";
        position: absolute;
        top: 5px;
        right: 5px;
        width: 8px;
        height: 8px;
        background-color: #ff0000;
        border-radius: 50%;
        animation: pulse 1.5s infinite;
    }
    @keyframes pulse {
        0% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.3); opacity: 0.7; }
        100% { transform: scale(1); opacity: 1; }
    }
</style>
<div class="outer">
    <header class="container-fluid bg-secondary">
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <img src="images/logo.png" alt="FB Combo Logo" height="40">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link active dropdown-toggle" href="#" id="settings" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                Settings
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="settings">
                                <li><a class="dropdown-item" href="servers.php">Servers</a></li>
                                <li><a class="dropdown-item" href="groups.php">Accounts group</a></li>
                                <li><a class="dropdown-item" href="tags.php">Accounts tags</a></li>
                                <li><a class="dropdown-item" href="open_ai.php">OpenAi</a></li>
                                <li><a class="dropdown-item" href="options.php">Options</a></li>
                                <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="error.php">Errors <span
                                                class="badge badge-danger"><?php echo $er ?></span></a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="repair.php">Database repair</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="del_acc_list.php">Deleting accounts by login</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="accounts.php">Accounts <span
                                        class="badge badge-primary"><?php echo $a ?></span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link active dropdown-toggle" href="#" id="proxy" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                Proxy <span class="badge badge-primary"><?php echo $cp ?></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="proxy">
                                <li><a class="dropdown-item" href="proxy_gr.php">Proxy group</a></li>
                                <li><a class="dropdown-item" href="add_proxy_group.php">Add Proxy group</a></li>
                                <li><a class="dropdown-item" href="proxy.php">Proxy</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link active active dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                Lists
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="add_list.php">Add new list</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="edit_list_bl.php">Black lists ID</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="e_list.php?cat=2">Geo lists</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="e_list.php?cat=13">Email Lists</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="e_list.php?cat=3">Name Lists</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="e_list.php?cat=4">ID lists</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="e_list.php?cat=5">Post & comments lists</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="e_list.php?cat=7">Keywords lists</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="e_list.php?cat=8">Site lists</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="e_list.php?cat=9">Additional lists</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="e_list.php?cat=10">Lists Groups</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="e_list.php?cat=11">URL lists</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="e_list.php?cat=12">Chat GPT Prompts</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Lists service</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="add_template.php">Task Templates <span
                                        class="badge badge-primary"><?php echo $templ ?></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="e_list.php?cat=5">Posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="messenger.php">Messenger</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link active active dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                STATISTIC
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="all_stat.php">All Statistic</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <?php foreach ($se as $s) { ?>
                                    <li><a class="dropdown-item" href="stat_s.php?id=<?php echo $s['id'] ?>"><?php echo 'Statistic ' . $s['name_server'] . ' server' ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="sms_services.php">SMS Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="note.php"><strong>Note</strong></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="spin.php">Spintax</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active <?php echo $hasChangeLogUpdates ? 'change-log-updated' : '' ?>"
                               href="change_log.php">
                                Change Log
                                <?php if ($hasChangeLogUpdates): ?>
                                    <span class="badge bg-danger ms-1">New!</span>
                                <?php endif; ?>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
    <span class="text-white bg-danger px-2 py-1 rounded"
          style="background-color: #ff0000 !important;
                 text-shadow: 0 0 3px rgba(0,0,0,0.5);
                 box-shadow: 0 0 5px rgba(255,0,0,0.5);
                 font-weight: bold;">
        MOBILE
    </span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="acc_creator.php">About the account creator</a></li>
                                <li><a class="dropdown-item" href="acc_creator_settings.php">Settings</a></li>
                                <li><a class="dropdown-item" href="res_bs.php">Blustacks service</a></li>
                                <li><a class="dropdown-item" href="acc_creator_phone.php">Phone settings</a></li>
                            </ul>
                        </li>
                        <?php if ($homepage != $vers) {
                            $m = '<span style="background-color: #555; color: #ff0; padding: 2px 5px; border-radius: 3px; font-weight: bold;">UPDATE PANEL!!!</span>';
                            $lm = 'index.php';
                        } else {
                            $m = 'Panel vers.' . $vers;
                            $lm = '#';
                        } ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="/"><strong><?php echo $m ?></strong></a>
                        </li>
                    </ul>
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <a class="nav-item" aria-current="page">Accounts Work <span
                                        class="badge badge-primary"><?php echo $wo ?></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-item" aria-current="page">Accounts with task <span
                                        class="badge badge-primary"><?php echo $tas ?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</div>