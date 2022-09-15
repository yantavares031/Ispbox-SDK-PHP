<?php
namespace Ispbox2\Http;

class TreatedURL
{

    private CompleteURL $Url;
    private string      $domain;
    private bool        $is_ssl;
    private string      $http_prefix;

    function __construct($_url) {
        $this->domain = rtrim($_url, '/');
        $this->ValidatePrefix();
        $this->MakeDomain();
        $this->MakeURL();
    }

    function withPath($path): string {
        return $this->Url->Path($path);
    }

    function toString(): string {
        return $this->Url->toString();
    }

    private function ValidatePrefix() : void {
        $this->is_ssl       = (str_contains("https://", $this->domain)) ? true : false;
        $this->http_prefix  = ($this->is_ssl) ? "https://" : "http://";
    }

    private function MakeURL() : void {
        $this->Url = new CompleteURL($this->http_prefix . $this->domain);
    }

    private function MakeDomain() : void {
        $this->domain = str_replace($this->http_prefix, "", $this->domain);
    }
}
