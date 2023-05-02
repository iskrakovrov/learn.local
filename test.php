<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/completions");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{
  "model": "text-davinci-003", 
  "prompt": "Я хочу, чтобы ты написал текст по моему заданию, как мотивационный коуч. Текст должен вызывать желание следовать вашему тексту. Первое задание: Не отступать!",
  "max_tokens": 1500,
  "temperature": 1,
  "top_p": 0.8,
  "frequency_penalty": 0,
  "presence_penalty": 0
}');
curl_setopt($ch, CURLOPT_POST, 1);

$headers = array();
$headers[] = "Content-Type: application/json";
$headers[] = "Authorization: Bearer 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";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);

echo $result;


