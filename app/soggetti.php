<?php

namespace App;

class Soggetti
{
    private $soggetti;

    public function __construct()
    {
        $this->soggetti = [];
    }

    public function getSoggetti()
    {
        return $this->soggetti;
    }

    public function searchById(int $id)
    {
        foreach ($this->soggetti as $el) {
            if ($el->getId() == $id)
            {
                return $el;
            }
        }
    }

    public function add(\App\Soggetto $soggetti)
    {
        $this->soggetti[] = $soggetti;
    }

    public function addByArray(array $arr)
    {
        foreach ($arr as $el) {
            $this->add(new \App\Soggetto((int)$el[0], $el[1]));
        }
    }

    public function stampaLista()
    {
        foreach ($this->soggetti as $el) {
            echo $el->identifica() . "</br>";
        }
    }
}