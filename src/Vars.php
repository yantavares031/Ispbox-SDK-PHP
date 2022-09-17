<?php
namespace Ispbox2;

class Vars{
    public static function dd(mixed $var){
        echo "<pre>";
        var_dump($var);
        exit();
    }
}
