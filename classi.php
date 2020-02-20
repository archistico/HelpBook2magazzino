<?php

$libri_array = [
    [1, "Due non è il doppio di uno"],
    [2, "Sogni inquinati"],
    [3, "Riflessi imperfetti"],
    [4, "Al di la del fiume"]
];

$soggetti_array = [
    [1, "Elettra Groppo"],
    [2, "Emilie Rollandin"],
    [3, "Libro Co"],
    [4, "Libreria Superpiù"],
    [5, "Casa dell'autore"]
];

$tipologie_documenti_array = [
    [1, "Fattura"],
    [2, "Conto deposito"],
    [3, "Ricevuta"],
    [4, "Reso"],
    [5, "Distribuzione Reso"],
    [6, "Distribuzione Carico"],
    [7, "Stampa"]
];

class Libro
{
    private $id;
    private $titolo;

    public function __construct(int $id, String $titolo)
    {
        $this->id = $id;
        $this->titolo = $titolo;
    }

    public function identifica() : String
    {
        return "#".$this->id." | Titolo: ".$this->titolo;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getTitolo() : String
    {
        return $this->titolo;
    }
}

$libri = [];
foreach ($libri_array as $l) {
    $libri[] = new Libro($l[0], $l[1]);
}

foreach ($libri as $l) {
    echo $l->identifica()."</br>";
}

var_dump($_POST);

?>

