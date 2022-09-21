<?php
namespace Ispbox2\Enums\Clientes;

enum EstadoCivil : string{
    case NaoInformado  = '0';
    case Solteiro      = '1';
    case Casado        = '2';
    case Divorciado    = '3';
    case Viuvo         = '4';
    case Separado      = '5';
    case UniaoEstavel  = '6';
}