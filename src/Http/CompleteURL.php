<?php
namespace Ispbox2\Http;

class CompleteURL{
    private $url;

    public function __construct(string $url) {
        $this->url = $url;
    }

    public function Path(string $path) : string{
        return $this->url.$path;
    }
    
    public function toString() : string{
        return $this->url;
    }
}