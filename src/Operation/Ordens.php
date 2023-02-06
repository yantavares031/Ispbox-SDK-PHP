<?php
namespace Ispbox2;

use Exception;
use Ispbox2\Classes\Json;
use Ispbox2\Http\RestClient;
use Ispbox2\Classes\Abstracts\OS;

class Ordens{
    private array $ordens = [];

    public function __construct(){

        $agendadas    = $this->getAgendadas();
        echo "<pre>";
        var_dump($agendadas);
        exit();

        $naoAgendadas = $this->getNaoAgendadas();
        $Merge        = array_merge($agendadas, $naoAgendadas);

        foreach($Merge as $key => $obj){
            $os = ($obj->referencia_mensalidade != NULL) ? new Fatura() : new BoletoAvulso();
            $os->fromObject($obj);
            $arrKeyName = $this->ShortClass($os);

            array_push($this->ordens[$arrKeyName][$os->status->name], $os);
        }
    }

    private function getAgendadas() : Json{
        $Rest     = new RestClient(SDK::$host);
        $Rest->setBasicAuth(SDK::authString());
        $Agendadas = $Rest->Post('/ordensservicos/index',[
            '_search'           => 'false',
            'rows'              => '999999',
            'page'              => 1,
            'sidx'              => 'data',
            'sord'              => 'desc',
            'agendadas'         => 1,
            'numero_os'         => '',
            'data_inicial'      => '01/01/2022',
            'data_final'        => '31/12/2023',
            'agendamento_final' => '',
            'status'            => '-1',
            'origem_tipo'       => 'todas',
            'setores_id'        => -1,
            'tecnico_id'        => -1,
            'clientes_id'       => '',
            'ordens_servicos_tipos_id' => -1,
            'motivo_contrato_id'       => -1,
            'solucao_id'        => -1,
            'condominios_id'    => ''
        ]);

        return $Agendadas;
    }

    private function getNaoAgendadas() : Json{
        $Rest     = new RestClient(SDK::$host);
        $Rest->setBasicAuth(SDK::authString());
        $NAgendadas = $Rest->Post('/ordensservicos/index',[
            '_search'           => 'false',
            'rows'              => '999999',
            'page'              => 1,
            'sidx'              => 'data',
            'sord'              => 'desc',
            'agendadas'         => 0,
            'numero_os'         => '',
            'data_inicial'      => '01/01/2022',
            'data_final'        => '31/12/2023',
            'agendamento_final' => '',
            'status'            => '-1',
            'origem_tipo'       => 'todas',
            'setores_id'        => -1,
            'tecnico_id'        => -1,
            'clientes_id'       => '',
            'ordens_servicos_tipos_id' => -1,
            'motivo_contrato_id'       => -1,
            'solucao_id'        => -1,
            'condominios_id'    => ''
        ]);

        return $NAgendadas;
    }

    // public function takeAll(DocTipo $tboleto=null, DocStatus $status=null) : array{
    //     $key = $this->boletosLista[$tboleto->value];
        
    //     if($tboleto == null && $status == null){
    //         $arrFatura = $this->boletosLista["Fatura"];
    //         $arrAvulso = $this->boletosLista["BoletoAvulso"];
    //         $saida = array_merge($arrFatura["Pago"], $arrFatura["Aberto"], $arrAvulso["Aberto"], $arrAvulso["Pago"]);
    //         return $saida;
    //     }

    //     if($tboleto != null && $status == null){
    //         $saida = array_merge($key["Pago"], $key["Aberto"]);
    //         return $saida;
    //     }
        
    //     if($tboleto == null && $status != null){
    //         $arrFatura = $this->boletosLista["Fatura"];
    //         $arrAvulso = $this->boletosLista["BoletoAvulso"];
    //         $saida = array_merge($arrFatura[$status->name], $arrAvulso[$status->name]);
    //         return $saida;
    //     }

    //     $arr = $key[$status->name];
    //     return $arr; 
    // }

    private function ShortClass($class) : string{
        $arrClass = explode('\\',get_class($class));
        return $arrClass[count($arrClass)-1];
    }
}