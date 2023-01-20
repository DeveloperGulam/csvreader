<?php
// $username = "admin";
// $apiKey   = "79fadafa61723d34582f591586d63cee33199216";
// $salt     = "2lmnle11aeucsgc0cw0go0o0gcow8sw";

// $nonce   = uniqid();
// $created = date('c');

// $digest  = base64_encode(sha1(base64_decode($nonce) . $created . $apiKey.'{'.$salt.'}', true));

// $headers = array();
// $headers[] = 'CONTENT_TYPE: application/json';
// $headers[] = 'Authorization: WSSE profile="UsernameToken"';
// $headers[] =
//     sprintf(
//         'X-WSSE: UsernameToken Username="%s", PasswordDigest="%s", Nonce="%s", Created="%s"',
//         $username,
//         $digest,
//         $nonce,
//         $created
//     );

// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, 'https://zorang-technologies-bbe5899be4.trial.akeneo.cloud/api/rest/products');
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// $result = curl_exec($ch);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://zorang-technologies-bbe5899be4.trial.akeneo.cloud/api/rest/v1/products/10660721',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Bearer MzNlYjdkZDM1MjQzNGE0ODk1NmU3MWVlY2JhZjFjMmQ3N2FkNmMxMTU1NmNiZjllNWM5NTViYmY1MGUzMzEzYQ',
    'Cookie: '
  ),
));
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$response = curl_exec($curl);

// echo "HTTP Return code:".$httpStatus."\n";

// if (false === $response) {
//     echo "ERROR:".curl_error($curl)."\n";
// } else {
//     echo "RESULT:$response\n";
// }
$result = json_decode($response, true);
curl_close($curl);
echo "<pre>";
print_r($result);
