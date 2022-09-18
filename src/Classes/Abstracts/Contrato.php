<?php 
namespace Ispbox2\Classes\Abstracts;

use Ispbox2\Contratos;
use Ispbox2\Enums\ContratoStatus;
use Ispbox2\Vars;

abstract class Contrato{
    public int     $id;
    public int     $clienteId;
    public string  $plano;
    public float   $valor;
    public string  $dataInstalacao;
    public string  $planoStatus;
    public bool    $active;
    public ContratoStatus $planoStatusEnum; 

    public function __construct(){

    }

    public function fromObject($stdobj){
        $parseDate   = fn($date) => date('d/m/Y',strtotime($date));
        $parseStatus = ContratoStatus::from($stdobj->pl_status);

        $this->id              = $stdobj->pl_id;
        $this->clienteId       = $stdobj->cli_id;
        $this->plano           = $stdobj->plan_nome;
        $this->valor           = $stdobj->plan_valor;
        $this->clienteId       = $stdobj->cli_id;
        $this->dataInstalacao  = $parseDate($stdobj->pl_data_instalacao);
        $this->planoStatus     = $parseStatus->name;
        $this->planoStatusEnum = $parseStatus;
        $this->active          = ($stdobj->pl_ativo == "1") ? true : false;
    }
}