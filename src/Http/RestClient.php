<?php
namespace Ispbox2\Http;

use Exception;
use Ispbox2\Classes\Json;
use Ispbox2\Configs\Credentials;
use Ispbox2\SDK;
use Ispbox2\Vars;

class RestClient{

    private array $default_header = [
        "Content-Type: multipart/form-data",
        "X-Requested-With: XMLHttpRequest",
        "Accept: application/json"
    ];
    private string $host;

    public function __construct($baseUrl){
        $this->host = $baseUrl;
    }

    private function addHeader(string $indice, string $value){
        array_push($this->default_header, $indice.": ".$value);
    }

    public function setBasicAuth(string $credenciais){
        $this->addHeader("Authorization", $credenciais);
    }

    public function Post(string $route, array $data) : Json{
        
        $host   = new TreatedURL($this->host);
        $rota   = $host->withPath($route);
        $header = $this->default_header;
        
        $ch = curl_init();
        curl_setopt_array($ch, CurlStruct::data("POST", $rota, $header, $data));
        $response = curl_exec($ch);
        curl_close($ch);
        
        $json = new Json($response);
        return ($json->isJson()) ? $json : throw new Exception("A saída não é um JSON válido");

    }
}