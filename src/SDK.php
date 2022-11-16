<?php

namespace Ispbox2;

use Exception;
use Ispbox2\Configs\Credentials;
use Ispbox2\TestConnection;

class SDK
{
    public static Credentials $payload;
    public static string $host;
    public static function configure(string $url, string $user, string $pass)
    {
        if (TestConnection::validateAuth($url, new Credentials($user, $pass))) {
            self::$host        = $url;
            self::$payload     = new Credentials($user, $pass);
        } else {
            throw new Exception("Falha na autenticação, verifique o usuário e senha informados");
        }
    }

    public static function authString(): string
    {
        return 'Basic ' . self::$payload->toauthString();
    }
}
