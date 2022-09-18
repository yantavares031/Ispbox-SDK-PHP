<?php 
namespace Ispbox2\Classes\Abstracts;

use Ispbox2\Enums\ContratoStatus;
use Ispbox2\Vars;

abstract class Contrato{
    public string  $id;
    public string  $clienteId;
    public string  $plano;
    public string  $valor;
    public string  $dataInstalacao;
    private ContratoStatus $planoStatus;
    private bool   $active;

    public function __construct(){

    }

    public function fromObject($stdobj){
        $parseDate   = fn($date) => date('d/m/Y',strtotime($date));
        $parseStatus = ContratoStatus::from($stdobj->pl_status);

        $this->id             = $stdobj->pl_id;
        $this->clienteId      = $stdobj->cli_id;
        $this->plano          = $stdobj->plan_nome;
        $this->valor          = $stdobj->plan_valor;
        $this->clienteId      = $stdobj->cli_id;
        $this->dataInstalacao = $parseDate($stdobj->pl_data_instalacao);
        $this->planoStatus    = $parseStatus;
        $this->active         = ($stdobj == "1") ? true : false;
    }
}