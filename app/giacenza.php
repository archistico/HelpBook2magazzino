<?php

namespace App;

class Giacenza
{
    private $quantita;
    private $giacenza;

    public function setQuantita(int $quantita)
    {
        $this->quantita = $quantita;
    }

    public function setGiacenza(int $giacenza)
    {
        $this->giacenza = $giacenza;
    }

    public function getQuantita()
    {
        return $this->quantita;
    }

    public function getGiacenza()
    {
        return $this->giacenza;
    }
}