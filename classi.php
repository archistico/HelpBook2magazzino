<?php

$libri_array = [
    [1, "Uno", 10],
    [2, "Due", 20],
    [3, "Tre", 30],
    [4, "Quattro", 40]
];

$soggetti_array = [
    [1, "Magazzino principale"],
    [2, "Magazzino secondario"],
    [3, "Distributore"],
    [4, "Libreria"],
    [5, "Autore"],
    [6, "Acquirente"]
];

$tipologie_documenti_array = [
    [1, "Fattura"],
    [2, "Ricevuta"],
    [3, "DDT"],
    [4, "Vendita da conto deposito"],
    [5, "Reso da conto deposito"],
    [6, "Distribuzione Reso"],
    [7, "Distribuzione Carico"],
    [8, "Stampa"]
];

class Libro
{
    private $id;
    private $titolo;
    private $prezzo;

    public function __construct(int $id, String $titolo, float $prezzo)
    {
        $this->id = $id;
        $this->titolo = $titolo;
        $this->prezzo = $prezzo;
    }

    public function identifica(): String
    {
        return "#" . $this->getId() . " | Libro: " . $this->getTitolo() . " | Prezzo: " . $this->getPrezzo();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitolo(): String
    {
        return $this->titolo;
    }

    public function getPrezzo(): String
    {
        return number_format($this->prezzo, 2);
    }
}

class Soggetto
{
    private $id;
    private $nome;

    public function __construct(int $id, String $nome)
    {
        $this->id = $id;
        $this->nome = $nome;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): String
    {
        return $this->nome;
    }

    public function identifica(): String
    {
        return "#" . $this->getId() . " | Soggetto: " . $this->getNome();
    }
}

// Creazione libri

$libri = [];
foreach ($libri_array as $el) {
    $libri[] = new Libro((int)$el[0], $el[1], (float)$el[2]);
}

foreach ($libri as $el) {
    echo $el->identifica() . "</br>";
}

// Creazione soggetti

$soggetti = [];
foreach ($soggetti_array as $el) {
    $soggetti[] = new Soggetto((int)$el[0], $el[1]);
}

foreach ($soggetti as $el) {
    echo $el->identifica() . "</br>";
}


?>

