<?php
namespace Ispbox2;

use Exception;
use Ispbox2\Classes\Json;
use Ispbox2\Http\RestClient;
use Ispbox2\Classes\Abstracts\OS;

class Ordens{
    private array $ordens = [
        "Agendadas"    => [],
        "NaoAgendadas" => []
    ];

    public function __construct(){

        $agendadas    = $this->getAgendadas();
        $naoAgendadas = $this->getNaoAgendadas();
        $Merge        = array_merge($agendadas->rows, $naoAgendadas->rows);

        foreach($Merge as $key => $obj){
            $cell = $obj->cell;
            $os = (count($cell) == 14) ? new Agendadas() : new NaoAgendadas();
            $os->fromObject($cell);
            $arrKeyName = $this->ShortClass($os);
            array_push($this->ordens[$arrKeyName], $os);
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
            'agendada'         => 1,
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
            'agendada'         => 0,
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

    public function takeAll() : array{
        return $this->ordens; 
    }

    private function ShortClass($class) : string{
        $arrClass = explode('\\',get_class($class)); 
        return $arrClass[count($arrClass)-1];
    }
}