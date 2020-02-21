<?php

namespace App;

class MovimentoDettaglio
{
    private $id;
    private $idmovimento;
    private $idlibro;
    private $quantita;
    private $sconto;

    public function __construct(int $id, int $idmovimento, int $idlibro, int $quantita, float $sconto)
    {
        $this->id = $id;
        $this->idmovimento = $idmovimento;
        $this->idlibro = $idlibro;
        $this->quantita = $quantita;
        $this->sconto = $sconto;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getIdmovimento(): int
    {
        return $this->idmovimento;
    }

    public function getIdlibro(): int
    {
        return $this->idlibro;
    }

    public function getQuantita(): int
    {
        return $this->quantita;
    }

    public function getSconto(): int
    {
        return $this->sconto;
    }

    public function identifica() : String
    {
        return "MovimentoDettaglio | Id: #" . $this->getId() . " | Movimento: #" . $this->getIdmovimento() . " | Libro: #" . $this->getIdlibro() . " | Quantita: " . $this->getQuantita() . " | Sconto: " . $this->getSconto();
    }
}