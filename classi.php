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

// Classe movimento

abstract class MovimentoTipo
{
    const FATTURA = "Fattura";
    const RICEVUTA = "Ricevuta";
    const DDT = "DDT";
    const CONTODEPOSITO_VENDITA = "Conto deposito - Vendita";
    const CONTODEPOSITO_RESO = "Conto deposito - Reso";
    const DISTRIBUZIONE_CARICO = "Distribuzione - Carico";
    const DISTRIBUZIONE_RESO = "Distribuzione - Reso";
    const STAMPA = "Stampa";
}

class Movimento
{
    private $id;
    private $idsoggetto;
    private $data;
    private $tipo;

    public function __construct(int $id, int $idsoggetto, DateTime $data, String $tipo)
    {
        $this->id = $id;
        $this->idsoggetto = $idsoggetto;
        $this->data = $data;
        $this->tipo = $tipo;
    }

    public function getData()
    {
        return $this->data->format('d/m/Y');
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

// Creazione movimenti

$movimenti = [];
$movimenti[] = new Movimento(1, 1, DateTime::createFromFormat('d/m/Y', '01/01/2020'), MovimentoTipo::STAMPA);
$movimenti[] = new Movimento(2, 6, DateTime::createFromFormat('d/m/Y', '02/01/2020'), MovimentoTipo::FATTURA);

?>

