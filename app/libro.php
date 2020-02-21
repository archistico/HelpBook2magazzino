<?php

namespace App;

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
        return "Libro | Id: #" . $this->getId() . " | Titolo: " . $this->getTitolo() . " | Prezzo: " . $this->getPrezzo();
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