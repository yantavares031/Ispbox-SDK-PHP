<?php
namespace Ispbox2\Enums\financeiro;

enum DocTipo : string{
    case Mensalidade = 'Fatura';
    case Avulso      = 'BAvulso';
}