<?php
namespace Ispbox2;

use Ispbox2\Classes\Abstracts\Cliente;
use Ispbox2\Classes\Abstracts\Contrato;

class Contratos{
    private array $contratoList;

    public function __construct(Cliente $client){
        $this->contratoList = $client->contratos;        
    }

    public function takeAny(int $id) : Contrato{
        foreach($this->contratoList as $contrato){
            if($contrato->id == $id){
                return $contrato;
                break;
            }
        }
    }

    public function List() : array{
        return $this->contratoList;
    }
}