<?php
namespace Ispbox2\Enums\Contratos;

enum Status : string{
    case Bloqueado        = "0";
    case Liberado         = "1";
    case ContratoSuspenso = "2";
    case SuspensoParcial  = "3";
}