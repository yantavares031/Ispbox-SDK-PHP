<?php
namespace Ispbox2\Http;
use Ispbox2\SDK;

class RestClient{

    private static array $default_header = [
        "Content-Type: multipart/form-data",
        "X-Requested-With: XMLHttpRequest",
        "Accept: application/json"
    ];

    private static function addHeader(string $indice, string $value){
        array_push(self::$default_header, $indice.": ".$value);
    }

    public static function Post(string $route, array $data){
        
        self::addHeader("Authorization", SDK::AuthString());
        $host   = new TreatedURL(SDK::$Host);
        $rota   = $host->withPath($route);
        $header = self::$default_header;
         
        $ch = curl_init();
        curl_setopt_array($ch, CurlStruct::data("POST", $rota, $header, $data));
        $response = curl_exec($ch);
        curl_close($ch);
        echo "<pre>";
        var_dump(json_decode($response));
    }
}