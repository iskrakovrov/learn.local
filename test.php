<?php

require_once('inc/db.php');
require_once('function/function.php');
//$text = 'Привет';
$text = $_GET['text'];
$sql = 'SELECT code FROM oai WHERE status = ? LIMIT 1';
$argc = [0];
$qw1 = select($sql,$argc);
$apioai = $qw1['code'];
$sql = 'SELECT value FROM value_lists where list = 60 ORDER BY rand() LIMIT 1';
$argc = 60;
$qw = select($sql);
$ch = curl_init();
$promt = $qw['value'];
$promt.= '"';
$promt.= $text;
$promt.= '"';
$data = [
    'model' => 'text-davinci-003',
    'prompt'=> $promt,
    'max_tokens' => 1500,
    'temperature'=> 1,
    'top_p'=> 0.8,
    'frequency_penalty' => 0,
    'presence_penalty'=> 0
];

curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/completions");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_POST, 1);

$headers = array();
$headers[] = "Content-Type: application/json";
$h = 'Authorization: Bearer ';
$h .= $apioai;
$headers[] = $h;
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);

echo $result;


