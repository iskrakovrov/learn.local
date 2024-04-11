<?php
require_once('inc/db.php');
require_once('function/function.php');

$sql = 'SHOW GRANTS';
$qw = create($sql);

tt($qw);