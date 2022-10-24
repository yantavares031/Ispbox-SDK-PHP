<?php
namespace Ispbox2;

use Exception;
use Ispbox2\Classes\Abstracts\Cliente;
use Ispbox2\Classes\Abstracts\Contrato;
use Ispbox2\Enums\Contratos\Status;
use Ispbox2\Enums\Contratos\Tipo;
use Ispbox2\InternetService;
use Ispbox2\TelefoniaService;

class Contratos{
    private array $contratoList;

    public function __construct(Cliente $client){
        if(!$client->exists)
            throw new Exception("Não é possivel obter serviços de um objeto (Cliente) vazio");
        
        foreach($client->contratos as $contrato)
            $this->contratoList[$contrato->id] = $contrato;
    }

    public function takeAny(int $id) : Contrato{
        if(!array_key_exists($id, $this->contratoList))
            throw new Exception("Contrato Id ".$id." não existe para este cliente");
            
        return $this->contratoList[$id];
    }

    public function toList(Tipo $tipo = null, Status $status = null) :  array{
        if($tipo == null && $status == null)
            return $this->contratoList;

        $contratos = [];
        foreach($this->contratoList as $list_id => $contrato){
            
            if($tipo != null && $status == null)
                if($this->ShortClass($contrato) == $tipo->value)
                    array_push($contratos, $contrato);

            if($tipo == null && $status != null)
                if($contrato->planoStatusEnum == $status)
                    array_push($contratos, $contrato);
                    
            if($tipo != null && $status != null)
                if($this->ShortClass($contrato) == $tipo->value)
                    if($contrato->planoStatusEnum == $status)
                        array_push($contratos, $contrato);
        }
          
        return $contratos;
    }

    public function Take(Tipo $tipo, int $id=0) : Contrato{
        foreach($this->contratoList as $list_id => $contrato){
            if($this->ShortClass($contrato) == $tipo->value){
                
                if($id == 0){
                    return $contrato;
                    break;
                }

                if($id == $list_id){
                    return $contrato;
                    break;
                }

            }
        }

        return new NullService();
    }

    private function ShortClass($class) : string{
        $arrClass = explode('\\',get_class($class));
        return $arrClass[count($arrClass)-1];
    }
}