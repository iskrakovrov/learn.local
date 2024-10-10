<?php

// Server info
$vst_hostname   = '172.83.53.7';
$vst_username   = 'admin';
$vst_password   = 'Kamel1979!';
$vst_returncode = 'yes';
$vst_command    = 'v-add-mail-account';

// New account info
$username       = 'admin';
$domain         = 'yourdomain.com';
$acount         = 'info'; //info@yourdomain.com
$password       = 'emailpassword';


// Prepare POST query
$postvars = array(
    'user'       => $vst_username,
    'password'   => $vst_password,
    'returncode' => $vst_returncode,
    'cmd'        => $vst_command,
    'arg1'       => $username,
    'arg2'       => $domain,
    'arg3'       => $acount,
    'arg4'       => $password
);

$postdata = http_build_query($postvars);
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, 'https://' . $vst_hostname . ':8083/api/');
curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);

$data = curl_exec($curl);

if($data == 0) {
    echo "User account has been successfuly";
} elseif($data == 4) {
    echo "Duplicate account";
} else {
    echo "Error: " . $data;
}