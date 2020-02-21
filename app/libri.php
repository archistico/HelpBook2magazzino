<?php

namespace App;

class Libri
{
    private $libri;

    public function __construct()
    {
        $this->libri = [];
    }

    public function getLibri()
    {
        return $this->libri;
    }

    public function searchById(int $id)
    {
        foreach ($this->libri as $el) {
            if ($el->getId() == $id)
            {
                return $el;
            }
        }
    }

    public function add(\App\Libro $libro)
    {
        $this->libri[] = $libro;
    }

    public function addByArray(array $arr)
    {
        foreach ($arr as $el) {
            $this->add(new \App\Libro((int)$el[0], $el[1], (float)$el[2]));
        }
    }

    public function stampaLista()
    {
        foreach ($this->libri as $el) {
            echo $el->identifica() . "</br>";
        }
    }
}