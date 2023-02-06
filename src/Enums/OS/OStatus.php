<?php
namespace Ispbox2\Enums\OS;

enum OStatus : string{
    case Aberta           = "0|1";
    case Fechada          = "1|1";
    case Executada        = "2|1";
    case Cancelada        = "3|1";
}