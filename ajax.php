<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$id = $_GET['id'];
$sql = 'SELECT id_acc, created , friends FROM friends WHERE id_acc = ? AND created >= unix_timestamp(current_date - interval 200 day) GROUP BY id_acc, date(from_unixtime(created)) ';
$args = [$id];
$qwery = selectAll($sql, $args);

foreach ($qwery as $a) {
    $da = $a['created'];
    $fr = $a['friends'];
    $mysql_data[] = array(

        $da,


    );
}

$d1 = array(

    'regtime' => $mysql_data,
);


foreach ($qwery as $a) {
    $da = $a['created'];
    $fr = $a['friends'];
    $mysql_data1[] = array(

        $fr,


    );
}

$d2 = array(

    'delay' => $mysql_data1,
);

$result = array_merge($d1, $d2);
$json_data = json_encode($result, JSON_UNESCAPED_UNICODE);
// Convert PHP array to JSON array
//$json_data1 = json_encode($d1, JSON_UNESCAPED_UNICODE);
//$json_data2 = json_encode($d2, JSON_UNESCAPED_UNICODE);
//print $json_data1;
print $json_data;
//print_r ($data);
