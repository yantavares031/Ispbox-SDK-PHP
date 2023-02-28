<?php
namespace Ispbox2\Classes\Abstracts;
use Ispbox2\Classes\Endereco;
use Ispbox2\Classes\Json;
use Ispbox2\Enums\OS\OStatus;

abstract class OS{
    
    public bool     $agendada;
    public int      $os_id;
    public int      $cliente_id;
    public string   $cliente_nome;
    public string   $tipo;
    public string   $hora_agendamento;
    public string   $hora_abertura;
    public string   $hora_fechamento;
    public string   $responsavel;
    public string   $status;
    public Endereco $endereco;

    function __construct(){
        $this->endereco = new Endereco();
    }

    function fromObject($stdobj){
        $parseDate = fn($date) => date('d/m/Y',strtotime($date));

        $this->os_id               = $stdobj[2];
        $this->cliente_nome        = ($stdobj[3] != null) ? $stdobj[3] : '';
        $this->tipo                = $stdobj[6];
        $this->endereco->bairro    = ($stdobj[5] != null) ? $stdobj[5] : '';
        $this->endereco->cidade    = $stdobj[4];
    }
    function splitAbertFechamento($text){
        $sprtd = explode('<br />', $text);
        $abertura = $sprtd[0];
        $fechamento = explode(': ',$sprtd[1])[1];

        return [$abertura, $fechamento];
    }
    
}