<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$sql = "SELECT COUNT(*) FROM accounts";
$acc = select($sql);
$sql = "SELECT COUNT(*) FROM proxy";
$cpr = select($sql);
$sql = "SELECT COUNT(*) FROM err";
$err = select($sql);
$a = $acc['COUNT(*)'];
$cp = $cpr['COUNT(*)'];
$er = $err['COUNT(*)'];

?>

<div class="outer">
    <header class="container-fluid bg-secondary" >

    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">FB Combo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Settings
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="servers.php">Servers</a></li>
                            <li><a class="dropdown-item" href="groups.php">Accounts group</a></li>
                            <li><a class="dropdown-item" href="options.php">Options</a></li>
                            <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="error.php">Errors <span class="badge badge-danger"><?php echo $er?></span></a></li>
                            <li>
                                <hr class="dropdown-divider">

                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Database repair</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="accounts.php">Accounts <span class="badge badge-primary"><?php echo $a ?></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="proxy.php">Proxy <span class="badge badge-primary"><?php echo $cp ?></span></a>
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
                            <li><a class="dropdown-item" href="edit_list_name.php">Name Lists</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="e_list.php?cat=4">ID lists</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="e_list.php?cat=5">Post lists</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="e_list.php?cat=5">Comments lists</a></li>
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
                            <li><a class="dropdown-item" href="#">Lists IMG</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Lists service</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="posts" href="e_list.php?cat=5">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="comm" href="e_list.php?cat=6">Comments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Messenger</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="all_stat.php">Statistic</a>
                    </li>
                    

                    <li class="nav-item dropdown">
                        <a class="nav-link active active dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Trash
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="add_list.php">View trash</a></li>

                            <li><a class="dropdown-item" href="edit_list_bl.php">Delete Trash</a></li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="logout.php">Exit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="new.php"><strong>UPDATE</strong></a>
                    </li>


                </ul>

            </div>
        </div>
    </nav>

</header>
</div>
