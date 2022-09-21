<?php
namespace Ispbox2;

use Ispbox2\Abstracts\Boleto;
use Ispbox2\Classes\Json;

class Fatura extends Boleto{
    public string $referencia;
    
    public function __construct(){
        parent::__construct();
    }

    public function fromObject($stdobj){
        parent::fromObject($stdobj);
        $parseDate = fn($date) => date('d/m/Y',strtotime($date));

        $this->referencia = $parseDate($stdobj->referencia_mensalidade);
    }
}