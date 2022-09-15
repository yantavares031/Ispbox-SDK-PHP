<?php
namespace Ispbox2\Http;

class CurlStruct{
    public static function data($method, string $url, $headers, $data) : array{
        return array(
            CURLOPT_URL =>  $url,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => $headers,
        );
    }
}