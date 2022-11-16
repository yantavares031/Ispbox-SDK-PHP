<?php

namespace Ispbox2;

use Ispbox2\Abstracts\Boleto;
use Ispbox2\Classes\Json;

class BoletoAvulso extends Boleto
{
    public string $referencia;

    public function __construct()
    {
        parent::__construct();
    }

    public function fromObject($stdobj)
    {
        parent::fromObject($stdobj);
        $this->referencia = $stdobj->referencia;
    }
}
