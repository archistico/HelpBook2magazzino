<?php

namespace App;

class MovimentiDettaglio
{
    private $mdettaglio;

    public function __construct()
    {
        $this->mdettaglio = [];
    }

    public function getMovimentiDettaglio()
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

    public static function stampaTabellaMovimenti(\App\Libri $li, \App\Soggetti $so, \App\Movimenti $mo, \App\MovimentiDettaglio $md)
    {
        foreach ($mo->getMovimentiOrdered() as $movimento) {

            // Dati del movimento

            $id = $movimento->getId();
            $idsoggetto = $movimento->getIdsoggetto();
            $data = $movimento->getDataFormatted();
            $tipo = $movimento->getTipo();

            // Cerco i dati del soggetto

            $nome = $so->searchById($idsoggetto)->getNome();

            \App\Html::printH4($data . " " .$tipo ." a '".$nome."'");

            // Cerco tutti i movimentidettaglio che hanno $idmovimento = $id

            $md_array = [];
            foreach ($md->getMovimentiDettaglio() as $el) {
                if ($el->getIdmovimento() == $id)
                {
                    $idmovimentodettaglio = $el->getId();
                    $idlibro = $el->getIdlibro();
                    $quantita = $el->getQuantita();
                    $sconto = $el->getSconto();

                    // Cerco titolo del libro
                    $titolo = $li->searchById($idlibro)->getTitolo();

                    $md_array[] = ['#'.$idmovimentodettaglio, $titolo, $quantita, $sconto];
                }
            }

            \App\Html::tableBordered(['Id', 'Titolo', 'Quantita', 'Sconto'],$md_array);

        }
    }
}