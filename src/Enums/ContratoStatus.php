<?php
namespace Ispbox2\Enums;

enum ContratoStatus : string{
    case Liberado        = "1";
    case Bloqueado       = "0";
    case SuspensoParcial = "3";
}