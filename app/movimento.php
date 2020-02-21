<?php

namespace App;

class Movimento
{
    private $id;
    private $idsoggetto;
    private $data;
    private $tipo;

    public function __construct(int $id, int $idsoggetto, String $data, String $tipo)
    {
        $this->id = $id;
        $this->idsoggetto = $idsoggetto;
        $this->data = \DateTime::createFromFormat('d/m/Y', $data);
        $this->tipo = $tipo;
    }

    public function getDataFormatted()
    {
        return $this->data->format('d/m/Y');
    }

    public function getData()
    {
        return $this->data;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdsoggetto()
    {
        return $this->idsoggetto;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function identifica() : String
    {
        return "#" . $this->getId() . " | Movimento | Soggetto: " . $this->getIdsoggetto() . " | Data: " . $this->getDataFormatted() . " | Tipo: " . $this->getTipo();
    }
}