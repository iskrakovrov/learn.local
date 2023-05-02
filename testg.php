<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/images/generations");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{

  "prompt": "Нарисуй мою дочку Полину, это девочка, какую я очень люблю. Она красивая. С фиолетовыми волосами",
  "n": 2,
    "size": "1024x1024"
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


