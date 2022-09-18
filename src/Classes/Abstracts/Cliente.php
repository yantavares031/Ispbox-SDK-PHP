<?php
namespace Ispbox2\Classes\Abstracts;
use Ispbox2\Classes\Endereco;
use Ispbox2\Classes\Json;
use Ispbox2\Enums\ContratoStatus;
use stdClass;

abstract class Cliente{
    
    public int      $id;
    public string   $nome;
    public string   $dataCadastro;
    public string   $email;
    public string   $emailSecundario;
    public array    $contratos = [];
    public Endereco $endereco;
    public bool     $exists = false;

    function __construct(){
        $this->endereco = new Endereco();
    }

    function addContrato(Contrato $contrato){
        array_push($this->contratos, $contrato);
    }

    function fromObject($stdobj){
        Json::removeNull($stdobj);
        $parseDate = fn($date) => date('d/m/Y',strtotime($date));
        
        $this->id                    = $stdobj->id;
        $this->nome                  = $stdobj->nome;
        $this->dataCadastro          = $parseDate($stdobj->data_cadastro);
        $this->email                 = $stdobj->email;
        $this->emailSecundario       = $stdobj->email2;
        $this->endereco->logradouro  = $stdobj->endereco;
        $this->endereco->numero      = $stdobj->endereco_numero;
        $this->endereco->bairro      = $stdobj->endereco_bairro;
        $this->endereco->cidade      = $stdobj->cidade;
        $this->endereco->estado      = $stdobj->uf;
        $this->endereco->complemento = $stdobj->endereco_complemento;
        $this->endereco->cep         = $stdobj->cep;
    }
}