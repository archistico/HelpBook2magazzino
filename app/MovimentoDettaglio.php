<?php

namespace App;

class MovimentoDettaglio
{
    private $id;
    private $idmovimento;
    private $idlibro;
    private $quantita;
    private $sconto;

    private $movimentoTipo;
    private $movimentoData;
    private $movimentoSoggettoNome;
    private $movimentoSoggettoId;
    private $titolo;

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

    public function getMovimentoTipo()
    {
        return $this->movimentoTipo;
    }

    public function setMovimentoTipo($movimentoTipo)
    {
        $this->movimentoTipo = $movimentoTipo;
    }

    public function getMovimentoData()
    {
        return $this->movimentoData;
    }

    public function setMovimentoData($movimentoData)
    {
        $this->movimentoData = $movimentoData;
    }

    public function getMovimentoSoggettoNome()
    {
        return $this->movimentoSoggettoNome;
    }

    public function setMovimentoSoggettoNome($movimentoSoggettoNome)
    {
        $this->movimentoSoggettoNome = $movimentoSoggettoNome;
    }

    public function getTitolo()
    {
        return $this->titolo;
    }

    public function setTitolo($titolo)
    {
        $this->titolo = $titolo;
    }

    public function getMovimentoSoggettoId()
    {
        return $this->movimentoSoggettoId;
    }

    public function setMovimentoSoggettoId($movimentoSoggettoId)
    {
        $this->movimentoSoggettoId = $movimentoSoggettoId;
    }
}