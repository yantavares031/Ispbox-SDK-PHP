<?php
namespace Ispbox2\Classes\Abstracts;
use Ispbox2\Classes\Endereco;
use Ispbox2\Classes\Json;
use Ispbox2\Enums\OS\OStatus;

abstract class OS{
    
    public bool     $agendada;
    public int      $os_id;
    public string   $cliente_nome;
    public string   $tipo;
    public string   $hora_agendamento;
    public string   $hora_abertura;
    public string   $hora_fechamento;
    public string   $responsavel;
    public OStatus  $status;
    public Endereco $endereco;

    function __construct(){
        $this->endereco = new Endereco();
    }

    function fromObject($stdobj){
        $parseDate = fn($date) => date('d/m/Y',strtotime($date));
        
        // $this->os_id                 = $stdobj->id;
        // $this->nome                  = $stdobj->nome;
        // $this->dataCadastro          = $parseDate($stdobj->data_cadastro);
        // $this->telefone              = $stdobj->telefone;
        // $this->celular               = $stdobj->celular;
        // $this->email                 = $stdobj->email;
        // $this->emailSecundario       = $stdobj->email2;
        // $this->endereco->logradouro  = $stdobj->endereco;
        // $this->endereco->numero      = $stdobj->endereco_numero;
        // $this->endereco->bairro      = $stdobj->endereco_bairro;
        // $this->endereco->cidade      = $stdobj->cidade;
        // $this->endereco->estado      = $stdobj->uf;
        // $this->endereco->complemento = $stdobj->endereco_complemento;
        // $this->endereco->cep         = $stdobj->cep;
    }
}