<?php
    namespace Akeneo;
    require_once __DIR__ . '/constants.php';
    class Akeneo {
        private static $akeneo_url;
        private static $bearer;
        private static $productId;
        
        public function __construct($akeneo_url = null, $bearer = null, $productId = null) {
            self::$akeneo_url = $akeneo_url;
            self::$bearer = $bearer;
            self::$productId = $productId;
        }

        public function getAuthToken($data = null) {
            if(!empty($data)) {
                $this->akeneo_url = $data['akeneo_url'];
                $this->clientId = $data['client_id'];
                $this->secret = $data['secret'];
                $this->username = $data['username'];
                $this->password = $data['password'];
                $this->endPoint = '/api/oauth/v1/token';
                $this->url = $this->akeneo_url . $this->endPoint;
                $this->auth = $this->clientId.':'.$this->secret;
                $this->basicAuth = base64_encode($this->auth);
                $this->postData = array(
                    "username" => $this->username,
                    "password" => $this->password,
                    "grant_type" => "password"
                );

                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => $this->url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($this->postData),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Basic '.$this->basicAuth
                ),
                ));
                $response = curl_exec($curl);
                if($response){
                    $result = json_decode($response, true);
                    return $result;
                } else return false;
            } else return false;
        }

        public function getProduct() {
            if(!empty(self::$bearer) && !empty(self::$akeneo_url)) {
                $endPoint = '/api/rest/v1/products/' . self::$productId;
                $url = self::$akeneo_url . $endPoint;
                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . self::$bearer,
                    'Cookie: '
                ),
                ));
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                $response = curl_exec($curl);
                if($response){
                    $result = json_decode($response, true);
                    return $result;
                } else return false;
            } else return false;
        }
    }
?>