<?php
namespace Ispbox2;
use Ispbox2\Classes\Abstracts\Contrato;

class InternetService extends Contrato{
    public string $tipo = "INTERNET";
    public string  $ppoeLogin;
    
    public function fromObject($stdobj){
        parent::fromObject($stdobj);

        $this->ppoeLogin = $stdobj->pl_pppoe_login;
    }
}