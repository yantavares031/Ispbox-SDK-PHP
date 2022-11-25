<?php 
namespace Ispbox2;

use Exception;
use Ispbox2\Http\RestClient;
USE Ispbox2\Classes\Abstracts\Cliente;
use Ispbox2\Classes\Json;
use Ispbox2\Enums\Clientes\Sidx;

class Clientes{
    public static function findOne(Sidx $sidx, $value) : Cliente{

        if($sidx != Sidx::ID and $sidx != Sidx::CNPJ and $sidx != Sidx::CPF)
            throw new Exception("Formato de Sidx não permitido para este método",);

        $Rest = new RestClient(SDK::$host);
        $Rest->setBasicAuth(SDK::authString());
        $response = $Rest->Post('/clientes/index?json',[
            'servico_internet'             => 1,
            $sidx->value                   => $value,
            'tipo_servico'                 => 'TODOS',
            'revendas_id'                  => -1,
            'vendedor_id'                  => -1,
            'pontos_autenticacao_pppoe_id' => -1,
            'tipo_vencimento'              => 100,
            'forma_cobranca'               => 'TODOS',
        ]);

        if($response->count == 0)
            return new PessoaNullable();

        $tipoPessoa = $response->registros[0]->tipo_pessoa;
        $pessoa     = ($tipoPessoa == "F") ? new PessoaFisica() : new PessoaJuridica();
        $pessoa->fromObject($response->registros[0]);
        self::inserirContratos($pessoa, $response);
        
        return $pessoa;
    }

    private static function  inserirContratos(Cliente &$cliente, Json $regs){
        foreach($regs->registros as $reg){
            $tipoContrato = $reg->tipo_servico; 
            $contrato     = ($tipoContrato == "INTERNET") ? new InternetService() : new TelefoniaService();
            $contrato->fromObject($reg);
            ($cliente->id == $reg->id) ? $cliente->addContrato($contrato) : '';
        }
    }
}   