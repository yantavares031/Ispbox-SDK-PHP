<?php
namespace Ispbox2;

use Ispbox2\Classes\Endereco;
use Ispbox2\Enums\ClientSidx;
use Ispbox2\Http\RestClient;

class Cliente{
    
    public string   $id;
    public string   $nome;
    public string   $nascimento;
    public string   $dataCadastro;
    public Endereco $endereco;

    function __construct(){

    }

    public static function findOne(string $sidx, $value) : Cliente{
        RestClient::Post('/clientes/index?json',[
            'servico_internet'             => 1,
            $sidx                          => $value,
            'tipo_servico'                 => 'INTERNET',
            'revendas_id'                  => -1,
            'vendedor_id'                  => -1,
            'pontos_autenticacao_pppoe_id' => -1,
            'tipo_vencimento'              => 100,
            'forma_cobranca'               => 'TODOS',
            'sidx'                         => $sidx
        ]);
        return new Cliente();
    }
}