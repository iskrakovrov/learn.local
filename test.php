<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/completions");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{
  "model": "text-davinci-003", 
  "prompt": "Я хочу, чтобы вы выступили в роли продавца в соцсети. Попробуйте продать мне программу FBcombo, но сделайте так, чтобы то, что вы пытаетесь продать, выглядело более ценным, чем оно есть на самом деле, и убедите меня купить это. Представлять себя не надо. А теперь я представлю, что ты мне написал в месенджер, и спрошу, зачем ты написал. Привет, слушаю вас?",
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