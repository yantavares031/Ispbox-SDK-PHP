<?php
namespace Ispbox2;
use Ispbox2\Classes\Abstracts\Cliente;

class PessoaJuridica extends Cliente{
    public string $cnpj;
    public string $nomeFantasia;
    public string $responsavel;
    public string $inscricaoEstadual;
    public string $tipoPessoa = "Juridica";

    public function __construct() {
        parent::__construct();
        $this->exists = true; 
    }

    public function fromObject($stdobj){
        parent::fromObject($stdobj);
        $this->cnpj              = $stdobj->cnpj;
        $this->nomeFantasia      = $stdobj->nome_fantasia;
        $this->responsavel       = $stdobj->responsavel;
        $this->inscricaoEstadual = $stdobj->inscricao_estadual;
        
    }
}