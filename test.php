<? function openAI()
{
    $OPENAI_API_KEY = "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";
    $user_id = "1";  //  users id optional

    $prompt = "Можно с тобой говорить на русском языке?";
    $temperature = 0.5;  // 1 adds complete randomness  0 no randomness 0.0
    $max_tokens = 30;


    $data = array('model' => 'text-davinci-003',
        'prompt' => $prompt,
        'temperature' => $temperature,
        'max_tokens' => $max_tokens,
        'top_p' => 1.0,
        'stream' => TRUE,// stream back response
        'frequency_penalty' => 0.0,
        'presence_penalty' => 0.0,
        'user' => $user_id);

    $post_json = json_encode($data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_json);
    curl_setopt($ch, CURLOPT_WRITEFUNCTION, function ($curl, $data, $arr) {
        # str_repeat(' ',1024*8) is needed to fill the buffer and will make streaming the data possible
        echo $data . str_repeat(' ', 1024 * 8);
        $arr .= $data . str_repeat(' ', 1024 * 8);



        return strlen($data);
    });

    $headers = array();
    $headers[] = 'Content-Type: application/json';
// $headers[] = 'Content-Type: text/event-stream';
    $headers[] = "Authorization: Bearer $OPENAI_API_KEY";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    return $result;

    curl_close($ch);
}

$txt = OpenAI();
