<?php
namespace Ispbox2;
use Ispbox2\Configs\Credentials;
use Ispbox2\TestConnection;

class SDK
{
    public static Credentials $credentials;
    public static string $Host;
    
    public static function setCredentials( string $user, string $pass ){
        self::$credentials = new Credentials( $user, $pass );
    }

    public static function setHost($url){
        self::$Host = $url;
    }

    public static function testServer() : bool {
       return TestConnection::ValidateUrl(self::$Host); 
    }

    public static function AuthString() : string{
        return 'Basic '.self::$credentials->toAuthString();
    }

}
