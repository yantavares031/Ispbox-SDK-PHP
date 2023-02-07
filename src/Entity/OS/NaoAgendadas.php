<?php

namespace Ispbox2;
use Ispbox2\Classes\Abstracts\OS;
use Ispbox2\Enums\OS\OStatus;

class NaoAgendadas extends OS
{
    public function __construct()
    {
        parent::__construct();
    }

    public function fromObject($stdobj)
    {
        parent::fromObject($stdobj);
        $status_converted = '';

        if($stdobj[9] == '0') 
            $status_converted = '0|1';
        elseif($stdobj[9] == '3') 
            $status_converted = '3|1';
        elseif($stdobj[9] == '1')
            $status_converted = '1|1';
        else $status_converted = $stdobj[9];


        $parseStatus = OStatus::from($status_converted);
        $abertFechamento = $this->splitAbertFechamento($stdobj[8]);
        
        $this->agendada = false;
        $this->hora_agendamento = 'S/N';
        $this->status           = $parseStatus->name;
        $this->hora_abertura    = $abertFechamento[0];
        $this->cliente_id       = $stdobj[12];
        $this->responsavel      = ($stdobj[7] != null) ? $stdobj[7] : '';

        if($this->status == 'Fechada'){
            $this->hora_fechamento = $abertFechamento[1];
        }

    }
}