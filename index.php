<?php
require 'vendor/autoload.php';

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
$libri->stampaLista();

// -------------------
// Creazione soggetti
// -------------------

$soggetti_array = [
    [1, "Magazzino principale"],
    [2, "Magazzino secondario"],
    [3, "Distributore"],
    [4, "Libreria"],
    [5, "Autore"],
    [6, "Acquirente"]
];

$soggetti = new \App\Soggetti();
$soggetti->addByArray($soggetti_array);
$soggetti->stampaLista();

// -------------------
// Creazione movimenti
// -------------------

$movimenti_array = [
    [1, 1, "01/01/2020", App\MovimentoTipo::STAMPA],
    [2, 6, "02/01/2020", App\MovimentoTipo::FATTURA],
    [3, 3, "03/01/2020", App\MovimentoTipo::DDT],
    [4, 3, "03/02/2020", App\MovimentoTipo::CONTODEPOSITO_VENDITA],
    [5, 3, "03/02/2020", App\MovimentoTipo::CONTODEPOSITO_RESO],
    [6, 6, "05/02/2020", App\MovimentoTipo::RICEVUTA],
    [7, 6, "06/02/2020", App\MovimentoTipo::INVENTARIO],
    [8, 6, "07/02/2020", App\MovimentoTipo::RICEVUTA],
];

$movimenti = new \App\Movimenti();
$movimenti->addByArray($movimenti_array);
$movimenti->stampaLista();


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
    [8, 6, 1, 5, 20]

];

$mdettaglio = new \App\MovimentiDettaglio();
$mdettaglio->addByArray($movimentidettaglio_array);
$mdettaglio->stampaLista();

// var_dump($libri->searchById($mdettaglio->getMovimenti()[1]->getIdlibro())->getTitolo());

// ----------------------------
// Creazione magazzino
// ----------------------------

$magazzino = new \App\Magazzino($libri, $soggetti, $movimenti, $mdettaglio);
$magazzino->stampaListaByIdlibro(1);

// TODO
// - Ordinare i movimenti in base a data e id per poter fare i calcoli correttamente
// - Manca per quale soggetto il magazzino
?>

