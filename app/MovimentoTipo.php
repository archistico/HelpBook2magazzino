<?php

namespace App;

abstract class MovimentoTipo
{
    const FATTURA = "Fattura";
    const RICEVUTA = "Ricevuta";
    const DDT = "DDT";
    const CONTODEPOSITO_FATTURA = "Fattura di conto deposito";
    const CONTODEPOSITO_RESO = "Reso da conto deposito";
    const DISTRIBUZIONE_CARICO = "Carico distribuzione";
    const DISTRIBUZIONE_RESO = "Reso distribuzione";
    const STAMPA = "Stampa";
    const INVENTARIO = "Inventario";
}