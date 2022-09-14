<?php
namespace Ispbox2;

class SDK
{
    private static \Ispbox2\Credentials $credentials;
    private static string $HOST;
    
    static function setCredentials( string $user, string $pass ){
        self::$credentials = new \Ispbox2\Credentials( $user, $pass );
    }
    
    static function setHost($url){
        self::$HOST = $url;
    }



    // function Save() : bool{

    // }

}
