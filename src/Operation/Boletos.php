<?php
namespace Ispbox2;

use Exception;
use Ispbox2\Classes\Abstracts\Contrato;
use Ispbox2\Classes\Json;
use Ispbox2\Enums\Contratos\Status;
use Ispbox2\Enums\financeiro\BoletoStatus;
use Ispbox2\Enums\financeiro\DocStatus;
use Ispbox2\Enums\financeiro\DocTipo;
use Ispbox2\Http\RestClient;

class Boletos{
    private array $boletosLista = [
        "Fatura" => [
            "Pago"   => [],
            "Aberto" => []
        ],
        "BAvulso" => [
            "Pago"   => [],
            "Aberto" => []
        ]
    ];

    public function __construct(Contrato $contrato){

        $Mensalidades = $this->getMensalidades($contrato);
        $BAvulsos     = $this->getBAvulsos($contrato);
        $Merge        = array_merge($Mensalidades->rows, $BAvulsos->rows);

        foreach($Merge as $key => $obj){
            $boleto = ($obj->referencia_mensalidade != NULL) ? new Fatura() : new BAvulso();
            $boleto->fromObject($obj);
            $arrKeyName = $this->ShortClass($boleto);

            array_push($this->boletosLista[$arrKeyName][$boleto->status->name], $boleto);
        }
    }

    public function takeAll(DocTipo $tboleto=null, DocStatus $status=null) : array{
        $key = $this->boletosLista[$tboleto->value];
        
        if($tboleto == null && $status == null){
            $arrFatura = $this->boletosLista["Fatura"];
            $arrAvulso = $this->boletosLista["BAvulso"];
            $saida = array_merge($arrFatura["Pago"], $arrFatura["Aberto"], $arrAvulso["Aberto"], $arrAvulso["Pago"]);
            return $saida;
        }

        if($tboleto != null && $status == null){
            $key   = $this->boletosLista[$tboleto->value];
            $saida = array_merge($key["Pago"], $key["Aberto"]);
            return $saida;
        }
        
        if($tboleto == null && $status != null){
            $arrFatura = $this->boletosLista["Fatura"];
            $arrAvulso = $this->boletosLista["BAvulso"];
            $saida = array_merge($arrFatura[$status->name], $arrAvulso[$status->name]);
            return $saida;
        }

        $key   = $this->boletosLista[$tboleto->value];
        $arr = $key[$status->name];
        return $arr; 
    }

    private function getMensalidades(Contrato $contrato) : Json{
        $this->verifyService($contrato);

        $Rest     = new RestClient(SDK::$Host);
        $Rest->setBasicAuth(SDK::AuthString());
        $Mensalidades = $Rest->Post('/clientes_cobrancas/pesquisa',[
            'origem_tipo' => $contrato->tipo,
            'status_tipo' => 'nao_cancelado',
            'tipo'        => 1,
            'origem_id'   => $contrato->id,
            'rows'        => 99999,
            'page'        => 1,
            'sidx'        => 'referencia_mensalidade',
            'sord'        => 'desc',
        ]);

        return $Mensalidades;
    }

    private function getBAvulsos(Contrato $contrato) : Json{
        $this->verifyService($contrato);
        
        $Rest     = new RestClient(SDK::$Host);
        $Rest->setBasicAuth(SDK::AuthString());
        $Avulsos = $Rest->Post('/clientes_cobrancas/pesquisa',[
            'origem_tipo' => $contrato->tipo,
            'status_tipo' => 'nao_cancelado',
            'tipo'        => 'nao_mensal',
            'origem_id'   => $contrato->id,
            'rows'        => 99999,
            'page'        => 1,
            'sidx'        => 'data_vencimento',
            'sord'        => 'desc',
        ]);

        return $Avulsos;
    }

    private function ShortClass($class) : string{
        $arrClass = explode('\\',get_class($class));
        return $arrClass[count($arrClass)-1];
    }

    private function verifyService($contrato){
        if($this->ShortClass($contrato) == 'NullService')
            return throw new Exception('Não é possivel obter mensalidades de um serviço inexistente');
    }
}