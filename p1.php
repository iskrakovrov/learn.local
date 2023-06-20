<?php



curl --location --request POST 'https://graph.facebook.com/graphql' \
--form 'access_token="ТОКЕНАККА"' \
--form 'doc_id="3797389657004143"' \
--form 'variables="{\"assetOwnerId\":\"ТУТ_ID_ЮЗЕРА\"}"'


$ch = curl_init();
$graph_url= 'https://graph.facebook.com/graphql';


$res = curl_exec($ch);
curl_close($ch);