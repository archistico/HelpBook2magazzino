<?php
require 'vendor/autoload.php';

// Creazione libri

$libri_array = [
    [1, "Uno", 10],
    [2, "Due", 20],
    [3, "Tre", 30],
    [4, "Quattro", 40]
];

$libri = new \App\Libri();
$libri->addByArray($libri_array);
$libri->stampaLista();


// Creazione soggetti

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

// Creazione movimenti

$movimenti = [];
$movimenti[] = new \App\Movimento(1, 1, DateTime::createFromFormat('d/m/Y', '01/01/2020'), App\MovimentoTipo::STAMPA);
$movimenti[] = new \App\Movimento(2, 6, DateTime::createFromFormat('d/m/Y', '02/01/2020'), App\MovimentoTipo::FATTURA);
$movimenti[] = new \App\Movimento(3, 3, DateTime::createFromFormat('d/m/Y', '03/01/2020'), App\MovimentoTipo::DDT);
$movimenti[] = new \App\Movimento(4, 3, DateTime::createFromFormat('d/m/Y', '03/02/2020'), App\MovimentoTipo::CONTODEPOSITO_VENDITA);
$movimenti[] = new \App\Movimento(5, 3, DateTime::createFromFormat('d/m/Y', '03/02/2020'), App\MovimentoTipo::CONTODEPOSITO_RESO);
$movimenti[] = new \App\Movimento(5, 6, DateTime::createFromFormat('d/m/Y', '05/02/2020'), App\MovimentoTipo::RICEVUTA);

?>

