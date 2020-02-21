<?php

namespace App;

class MovimentiDettaglio
{
    private $mdettaglio;

    public function __construct()
    {
        $this->mdettaglio = [];
    }

    public function getMovimenti()
    {
        return $this->mdettaglio;
    }

    public function searchById(int $id)
    {
        foreach ($this->mdettaglio as $el) {
            if ($el->getId() == $id)
            {
                return $el;
            }
        }
    }

    public function add(\App\MovimentoDettaglio $movimenti)
    {
        $this->mdettaglio[] = $movimenti;
    }

    public function addByArray(array $arr)
    {
        foreach ($arr as $el) {
            $this->add(new \App\MovimentoDettaglio((int)$el[0], (int)$el[1], (int)$el[2], (int)$el[3], (float)$el[4]));
        }
    }

    public function stampaLista()
    {
        foreach ($this->mdettaglio as $el) {
            echo $el->identifica() . "</br>";
        }
    }
}