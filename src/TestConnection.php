<?php
namespace Ispbox2;

use Exception;
use Ispbox2\Configs\Credentials;
use Ispbox2\Http\RestClient;

class TestConnection
{
    public static function ValidateUrl(string $erp_url) : bool {
        $retorno = false;

        try{
            $header_check  = get_headers($erp_url);
            $response_code = $header_check[0];
            
            if($response_code == "HTTP/1.1 302 Found")
                $retorno = true;
                
        }finally{
            return $retorno;
        }
    }

    public static function ValidateAuth(string $BaseUrl, Credentials $credenciais) : bool {
        $retorno = false;

        $Rest = new RestClient($BaseUrl);
        $result = $Rest->Post('/usuarios/login',[
            "login"       => $credenciais->getUser(),
            "senha"       => $credenciais->getPassword(),
            "cmdweblogin" => "Acessar"
        ]);
        if($result->erro == 0)
            $retorno = true;

        return $retorno;
    }
}

