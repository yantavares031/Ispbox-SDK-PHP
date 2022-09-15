<?php
namespace Ispbox2;

use Exception;

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
}

