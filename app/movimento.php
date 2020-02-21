<?php

namespace App;

class Movimento
{
    private $id;
    private $idsoggetto;
    private $data;
    private $tipo;

    public function __construct(int $id, int $idsoggetto, \DateTime $data, String $tipo)
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

    public function getIdsoggetto()
    {
        return $this->idsoggetto;
    }

    public function getTipo()
    {
        return $this->tipo;
    }
}