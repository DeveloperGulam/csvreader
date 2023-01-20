<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://zorang-technologies-bbe5899be4.trial.akeneo.cloud/api/oauth/v1/token',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "username" : "erp_0569",
    "password" : "d1ad0367d",
    "grant_type": "password"
 }',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Basic MTBfMjF2Zmk2cWpianI0NGdrOHc4ODBvMGtzazhrMGc0a2NvZzRnb2drMGtjNHdnMDQwb2c6NjlybGNlZTlpMWdjazBnNHc0a2s4a2Nvd3NzbzR3azQ0NDBzY3c4d2tzMGNrNDBrdw=='
  ),
));
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($curl);

curl_close($curl);
echo $response;
