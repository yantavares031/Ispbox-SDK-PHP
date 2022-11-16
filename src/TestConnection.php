<?php

namespace Ispbox2;

use Exception;
use Ispbox2\Configs\Credentials;
use Ispbox2\Http\RestClient;

class TestConnection
{
    public static function validateUrl(string $erp_url): bool
    {
        $retorno = false;
        try {
            file_get_contents($erp_url);
            $retorno = true;
        } finally {
            return $retorno;
        }
    }

    public static function validateAuth(string $BaseUrl, Credentials $credenciais): bool
    {
        $retorno = false;
        $Rest = new RestClient($BaseUrl);
        $result = $Rest->Post('/usuarios/login', [
            "login"       => $credenciais->getUser(),
            "senha"       => $credenciais->getPassword(),
            "cmdweblogin" => "Acessar"
        ]);
        if ($result->erro == 0) {
            $retorno = true;
        }

        return $retorno;
    }
}
