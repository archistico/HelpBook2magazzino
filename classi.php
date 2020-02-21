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
];

$movimenti = new \App\Movimenti();
$movimenti->addByArray($movimenti_array);
$movimenti->stampaLista();

?>

