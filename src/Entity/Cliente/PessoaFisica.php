<?php
namespace Ispbox2;
use Ispbox2\Classes\Abstracts\Cliente;
use Ispbox2\Enums\Clientes\EstadoCivil;

class PessoaFisica extends Cliente{
    public string $primeiroNome;
    public string $cpf;
    public string $rg;
    public string $sexo;
    public string $dataNascimento;
    public string $nomePai;
    public string $nomeMae;
    public string $profissao;
    public string $tipoPessoa = "Fisica";
    public string $estadoCivil;
    public EstadoCivil $estadoCivilEnum;

    public function __construct() {
        parent::__construct();
        $this->exists = true;
    }

    public function fromObject($stdobj){
        parent::fromObject($stdobj);
        $firstName = fn($nomeCompleto) => explode(" ", $nomeCompleto)[0];
        $parseDate = fn($date)         => date('d/m/Y',strtotime($date));
        
        $this->primeiroNome    = $firstName($stdobj->nome);
        $this->cpf             = $stdobj->cpf;
        $this->rg              = $stdobj->rg;
        $this->sexo            = $stdobj->sexo;
        $this->dataNascimento  = $parseDate($stdobj->data_nascimento);
        $this->estadoCivil     = EstadoCivil::from($stdobj->estado_civil)->name;
        $this->estadoCivilEnum = EstadoCivil::from($stdobj->estado_civil);
        $this->nomePai         = $stdobj->nome_pai;
        $this->nomeMae         = $stdobj->nome_mae;
        $this->profissao       = $stdobj->profissao;
        
    }
}