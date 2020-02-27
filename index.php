<?php
require 'vendor/autoload.php';


\App\Html::head();

// -------------------
// Creazione libri
// -------------------

$libri_array = [
    [1, "Uno", 10],
    [2, "Due", 20],
    [3, "Tre", 30],
    [4, "Quattro", 40]
];

$libri = new \App\Libri();
$libri->addByArray($libri_array);

// -------------------
// Creazione soggetti
// -------------------

$soggetti_array = [
    [1, "Magazzino"],
    [2, "Distributore"],
    [3, "Libreria"],
    [4, "Autore"],
    [5, "Acquirente"]
];

$soggetti = new \App\Soggetti();
$soggetti->addByArray($soggetti_array);

// -------------------
// Creazione movimenti
// -------------------

$movimenti_array = [
    [1, 1, "01/01/2020", App\MovimentoTipo::STAMPA],
    [2, 5, "02/01/2020", App\MovimentoTipo::FATTURA],
    [3, 2, "03/01/2020", App\MovimentoTipo::DDT],
    [4, 2, "03/02/2020", App\MovimentoTipo::CONTODEPOSITO_FATTURA],
    [5, 2, "03/02/2020", App\MovimentoTipo::CONTODEPOSITO_RESO],
    [6, 5, "05/02/2020", App\MovimentoTipo::RICEVUTA],
    [7, 1, "06/02/2020", App\MovimentoTipo::INVENTARIO],
    [8, 5, "07/02/2020", App\MovimentoTipo::RICEVUTA],
    [9, 2, "03/02/2020", App\MovimentoTipo::INVENTARIO],
    [10, 5, "08/02/2020", App\MovimentoTipo::FATTURA],
];

$movimenti = new \App\Movimenti();
$movimenti->addByArray($movimenti_array);

// ----------------------------
// Creazione movimentodettaglio
// ----------------------------

// int $id, int $idmovimento, int $idlibro, int $quantita, float $sconto

$movimentidettaglio_array = [
    [1, 1, 1, 100, 0],
    [2, 2, 1, 15, 0],
    [3, 3, 1, 20, 30],
    [4, 4, 1, 15, 30],
    [5, 5, 1, 5, 0],
    [6, 6, 1, 5, 20],
    [7, 7, 1, 67, 0],
    [8, 6, 2, 5, 20],
    [9, 1, 2, 200, 0],
    [10, 8, 2, 10, 0],
    [11, 9, 1, 0, 0],
    [12, 10, 1, 22, 0],
];

$mdettaglio = new \App\MovimentiDettaglio();
$mdettaglio->addByArray($movimentidettaglio_array);

// Lista movimenti

\App\Html::printH1("Tabella Movimenti");
\App\MovimentiDettaglio::stampaTabellaMovimenti($libri, $soggetti, $movimenti, $mdettaglio);

// ----------------------------
// Creazione magazzino
// ----------------------------

\App\Html::printH1("Lista Giacenze");

$magazzino = new \App\Magazzino($libri, $soggetti, $movimenti, $mdettaglio);

/*
foreach ($soggetti->getSoggetti() as $s) {
    $magazzino->stampaListaByIdlibro2(1, $s->getId());
}
*/

$magazzino->stampaListaByIdlibro2(1, 1);

// TODO
// - Ordinare le giacenze in base all'ordine dei movimenti e non in base all'id del movimentodettaglio
// - Settare distribuzione carico e reso
// - funzione che ritorna la giacenza per un magazzino e un libro

\App\Html::foot();
?>

