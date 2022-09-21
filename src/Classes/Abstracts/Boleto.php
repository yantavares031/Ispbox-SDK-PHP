<?php
namespace Ispbox2\Abstracts;
use Ispbox2\Classes\Json;
use Ispbox2\Enums\Contratos\Tipo;
use Ispbox2\Enums\financeiro\DocStatus;

abstract class Boleto{
    public string  $documentoId;
    public string  $clienteId;
    public string  $contratoId;
    public string  $descricao;
    public string  $dataGeracao;
    public string  $vencimento;
    public string  $valor;
    public float   $valorFloat;
    public string  $valorPago;
    public string  $dataPagamento;
    public Tipo    $tipoContrato;
    public DocStatus  $status;
    public bool    $atrasado;

    public function __construct(){

    }

    public function fromObject($stdobj){
        $parseDate = fn($date) => date('d/m/Y',strtotime($date));

        $this->documentoId   = $stdobj->documento_id;
        $this->clienteId     = $stdobj->cadastro_id;
        $this->contratoId    = $stdobj->origem_id;
        $this->tipoContrato  = ($stdobj->origem_tipo == "INTERNET") ? Tipo::Internet : Tipo::Telefonia;
        $this->descricao     = $stdobj->descricao;
        $this->vencimento    = $stdobj->data_vencimento;
        $this->dataGeracao   = $parseDate($stdobj->data_lancamento);
        $this->valor         = $stdobj->valor;
        $this->valorFloat    = $stdobj->{'19'};
        $this->valorPago     = $stdobj->valor_pago;
        $this->status        = DocStatus::from($stdobj->status);
        $this->atrasado      = ($stdobj->vencido == 0) ? false : true;
        $this->dataPagamento = ($this->status == DocStatus::Pago) ? $parseDate($stdobj->data_pagamento) : '';
    }
}