<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');

$sql = 'SELECT id_acc, created , friends FROM friends WHERE id_acc = 31251 AND created >= unix_timestamp(current_date - interval 200 day) GROUP BY id_acc, date(from_unixtime(created))';
$qwery = selectAll($sql);

foreach ($qwery as $a) {
    $da = $a['created'];
    $fr = $a['friends'];
    $mysql_data[] = array(

        $da,
        $fr,


    );
}


$data = array(

  'a' => $mysql_data,
);

// Convert PHP array to JSON array
$json_data = json_encode($data, JSON_UNESCAPED_UNICODE);
print $json_data;
//print_r ($data);
