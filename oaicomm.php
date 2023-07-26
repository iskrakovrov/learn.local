<?php

require_once('inc/db.php');
require_once('function/function.php');
//$text = 'Привет';
$pr = $_GET['pr'];
$text = $_GET['text'];
$argc = [0];
$sql = 'SELECT * FROM `oai` WHERE status = ?';
$qw1 = select($sql,$argc);
if ($qw1){
$sql = 'SELECT * FROM `oai` WHERE status = ? AND ( `working` <> 1 OR `working` IS NULL) ORDER BY used LIMIT 1';

$qw1 = select($sql,$argc);
if ($qw1) {
    $id = $qw1['id'];
    $sql = 'UPDATE oai SET working = 1 WHERE id = ?';
    $argc = [$id];
    $qw = update($sql, $argc);
    $t1 = Time() - $qw['used'];
    $t2 = $qw['used'];
    if (is_null($t2) || $t1 > 30) {
        $apioai = $qw1['code'];

        $sql = 'SELECT value FROM value_lists where list = ? ORDER BY rand() LIMIT 1';
        $argc = [$pr];
        $qw = select($sql,$argc);
        $ch = curl_init();
        $promt = $qw['value'];
        $promt .= '"';
        $promt .= $text;
        $promt .= '"';
        $data = [
            'model' => 'text-davinci-003',
            'prompt' => $promt,
            'max_tokens' => 1500,
            'temperature' => 1,
            'top_p' => 0.8,
            'frequency_penalty' => 0,
            'presence_penalty' => 0
        ];

        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $h = 'Authorization: Bearer ';
        $h .= $apioai;
        $headers[] = $h;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        curl_close($ch);


    } else {
        $result = 'time';

    }
}
else{
    $result = 'time';
}

}
else{
    $result = 'no key';
}
$time = Time();
$sql = 'UPDATE oai SET working = 0, used = ? WHERE id = ?';
    $argc = [$time,$id];
    $qw = update($sql, $argc);
echo $result;
