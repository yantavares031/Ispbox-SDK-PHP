<?php

namespace Ispbox2;
use Ispbox2\Classes\Abstracts\OS;
use Ispbox2\Enums\OS\OStatus;

class Agendadas extends OS
{
    public function __construct()
    {
        parent::__construct();
    }

    public function fromObject($stdobj)
    {
        parent::fromObject($stdobj);
        $status_converted = str_replace(['0|0','1|0','3|0'],'0|1',$stdobj[10]);
        $parseStatus = OStatus::from($status_converted);
        $abertFechamento = $this->splitAbertFechamento($stdobj[9]);
        
        $this->agendada = true;
        $this->hora_agendamento = $stdobj[7];
        $this->status           = $parseStatus->name;
        $this->hora_abertura    = $abertFechamento[0];
        $this->cliente_id       = $stdobj[13];
        $this->responsavel      = $stdobj[8];

        if($this->status == 'Fechada'){
            $this->hora_fechamento = $abertFechamento[1];
        }
    }
}