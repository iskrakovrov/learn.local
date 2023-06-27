<?php

require_once('inc/db.php');
require_once('function/function.php');
$sql = 'SELECT id_acc FROM friends WHERE (id_acc) IN (SELECT id  FROM accounts WHERE status = 1 OR status = 20 OR status =15 )';
$qw = selectall($sql);
foreach ($qw as $b){
    $id = $b['id_acc'];
    $sql = "SELECT friends FROM friends WHERE id_acc = $id ORDER BY created DESC LIMIT 1";
    $l = select($sql);
    $sum = $sum+$l['friends'];
}

//Привет Всем Хочу сказать, кто к нам с мечом придет, тот от меча и погибнет
//$sql = 'SELECT sum(friends) FROM friends WHERE (id_acc) IN (SELECT id  FROM accounts WHERE status = 1 OR status = 20 OR status =15 ) AND created = (SELECT max(created) FROM friends) ';

//$sql = 'SELECT  created , SUM(friends) FROM friends WHERE created >= unix_timestamp(current_date - interval 200 day) GROUP BY  date(from_unixtime(created)) AND (id_acc) IN (SELECT id  FROM accounts WHERE status = 1 OR status = 20 OR status =15 ) ORDER BY created;';

//$qwery = selectAll($sql);
echo $sum;
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