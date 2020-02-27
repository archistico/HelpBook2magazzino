<?php

namespace App;

class Movimenti
{
    private $movimenti;

    public function __construct()
    {
        $this->movimenti = [];
    }

    public function getMovimenti()
    {
        return $this->movimenti;
    }

    public function getMovimentiOrdered()
    {
        $mov = $this->movimenti;

        usort($mov, function($a, $b) {
            $ad = $a->getData();
            $bd = $b->getData();

            if ($ad == $bd) {
                $ai = $a->getId();
                $bi = $b->getId();
                return $ai < $bi ? -1 : 1;
            }

            return $ad < $bd ? -1 : 1;
        });

        return $mov;
    }

    public function searchById(int $id)
    {
        foreach ($this->movimenti as $el) {
            if ($el->getId() == $id)
            {
                return $el;
            }
        }
    }

    public function add(\App\Movimento $movimenti)
    {
        $this->movimenti[] = $movimenti;
    }

    public function addByArray(array $arr)
    {
        foreach ($arr as $el) {
            $this->add(new \App\Movimento((int)$el[0], (int)$el[1], $el[2], $el[3]));
        }
    }

    public function stampaLista()
    {
        foreach ($this->movimenti as $el) {
            echo $el->identifica() . "</br>";
        }
    }
}