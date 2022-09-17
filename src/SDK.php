<?php
namespace Ispbox2;

use Exception;
use Ispbox2\Configs\Credentials;
use Ispbox2\TestConnection;

class SDK
{
    public static Credentials $payload;
    public static string $Host;
    
    public static function Configure(string $url, string $user, string $pass){

        if(TestConnection::ValidateUrl($url))
        {
            if(TestConnection::ValidateAuth($url, new Credentials($user,$pass))){
                self::$Host        = $url;
                self::$payload     = new Credentials( $user, $pass );
            }else{
                throw new Exception("Falha na autenticação, verifique o usuário e senha informados");
            }
        }
    }
    
    public static function AuthString() : string{
        return 'Basic '.self::$payload->toAuthString();
    }

}
