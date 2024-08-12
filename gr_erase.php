<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$sql = 'TRUNCATE TABLE selected_values;';
$qu = create($sql);

header('Location: accounts.php');
exit;
