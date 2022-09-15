<?php 
namespace Ispbox2\Configs;

class Credentials
{
    private string $user;
    private string $pass;

    function __construct( string $username, string $password ) {
        $this->user     = $username;
        $this->pass     = $password;
    }

    function getUser( bool $InBase64 = false ) {
        $value = $this->user;
        return ( !$InBase64 ) ? $value : base64_encode( $value );
    }

    function getPassword( bool $InBase64 = false ) {
        $value = $this->pass;
        return ( !$InBase64 ) ? $value : base64_encode( $value );
    }

    function toAuthString() {
        return base64_encode($this->getUser().':'.$this->getPassword());
    }
}