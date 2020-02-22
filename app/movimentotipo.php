<?php

namespace App;

abstract class MovimentoTipo
{
    const FATTURA = "Fattura";
    const RICEVUTA = "Ricevuta";
    const DDT = "DDT";
    const CONTODEPOSITO_FATTURA = "Conto deposito - Fattura";
    const CONTODEPOSITO_RESO = "Conto deposito - Reso";
    const DISTRIBUZIONE_CARICO = "Distribuzione - Carico";
    const DISTRIBUZIONE_RESO = "Distribuzione - Reso";
    const STAMPA = "Stampa";
    const INVENTARIO = "Inventario";
}