<?php

namespace App;

class Magazzino
{
    private $li;
    private $so;
    private $mo;
    private $md;

    public function __construct(\App\Libri $li, \App\Soggetti $so, \App\Movimenti $mo, \App\MovimentiDettaglio $md)
    {
        $this->li = $li;
        $this->so = $so;
        $this->mo = $mo;
        $this->md = $md;
    }

    private function printQuantitaGiacenza($tipo, $id, $quantita, $giacenza)
    {
        if($quantita >0) {
            $quantita = '+'.strval($quantita);
        }
        echo $tipo . " #" . $id . " | " . $quantita . " | Giacenza: " . $giacenza . "</br>";
    }

    public function stampaListaByIdlibro(int $idlibro, int $idsoggetto)
    {
        $magazzini_principali = $idsoggetto == 1;

        if ($magazzini_principali) {
            // Cercare tutti i md con idlibro = idlibro
            $mdById = [];
            foreach ($this->md->getMovimentiDettaglio() as $el) {
                if ($el->getIdlibro() == $idlibro) {
                    $mdById[] = ['tipo' => $this->mo->searchById($el->getIdmovimento())->getTipo(), 'quantita' => $el->getQuantita(), 'idmovimento' => $el->getIdmovimento(), 'idmd' =>$el->getId()];
                }
            }

            if(count($mdById)>0) {
                \App\Html::printH2($this->so->searchById($idsoggetto)->getNome()." #".$idsoggetto);
                \App\Html::println("Libro:".$this->li->searchById($idlibro)->getTitolo());
            }

            $giacenza = 0;

            foreach ($mdById as $el) {
                $quantita = 0;
                if ($el['tipo'] == \App\MovimentoTipo::STAMPA) {
                    $quantita = $el['quantita'];
                    $giacenza = $giacenza + $quantita;
                    $this->printQuantitaGiacenza($el['tipo'], $el['idmovimento'], $quantita, $giacenza);
                }
                if ($el['tipo'] == \App\MovimentoTipo::FATTURA) {
                    $quantita = -$el['quantita'];
                    $giacenza = $giacenza + $quantita;
                    $this->printQuantitaGiacenza($el['tipo'], $el['idmovimento'], $quantita, $giacenza);
                }
                if ($el['tipo'] == \App\MovimentoTipo::RICEVUTA) {
                    $quantita = -$el['quantita'];
                    $giacenza = $giacenza + $quantita;
                    $this->printQuantitaGiacenza($el['tipo'], $el['idmovimento'], $quantita, $giacenza);
                }
                if ($el['tipo'] == \App\MovimentoTipo::DDT) {
                    $quantita = -$el['quantita'];
                    $giacenza = $giacenza + $quantita;
                    $this->printQuantitaGiacenza($el['tipo'], $el['idmovimento'], $quantita, $giacenza);
                }
                if ($el['tipo'] == \App\MovimentoTipo::CONTODEPOSITO_RESO) {
                    $quantita = +$el['quantita'];
                    $giacenza = $giacenza + $quantita;
                    $this->printQuantitaGiacenza($el['tipo'], $el['idmovimento'], $quantita, $giacenza);
                }
                if ($el['tipo'] == \App\MovimentoTipo::CONTODEPOSITO_FATTURA) {
                    $quantita = -$el['quantita'];
                    $this->printQuantitaGiacenza($el['tipo'], $el['idmovimento'], $quantita, $giacenza);
                }
                if (($el['tipo'] == \App\MovimentoTipo::INVENTARIO) && ( $this->mo->searchById($el['idmovimento'])->getIdsoggetto() == $idsoggetto )) {
                    $quantita = $el['quantita'] - $giacenza;
                    $giacenza = $el['quantita'];
                    $this->printQuantitaGiacenza($el['tipo'], $el['idmovimento'], $quantita, $giacenza);
                }
            }
        } else {
            // Cercare tutti i md con idlibro = idlibro
            $mdById = [];
            foreach ($this->md->getMovimentiDettaglio() as $el) {
                if (($el->getIdlibro() == $idlibro) and ( $this->mo->searchById($el->getIdmovimento())->getIdsoggetto() == $idsoggetto )) {
                    $mdById[] = ['tipo' => $this->mo->searchById($el->getIdmovimento())->getTipo(), 'quantita' => $el->getQuantita(), 'idmovimento' => $el->getIdmovimento(), 'idmd' =>$el->getId()];
                }
            }

            if(count($mdById)>0) {
                \App\Html::printH2($this->so->searchById($idsoggetto)->getNome()." #".$idsoggetto);
                \App\Html::println("Libro:".$this->li->searchById($idlibro)->getTitolo());
            }

            $giacenza = 0;

            foreach ($mdById as $el) {
                $quantita = 0;

                if ($el['tipo'] == \App\MovimentoTipo::FATTURA) {
                    $quantita = $el['quantita'];
                    $this->printQuantitaGiacenza($el['tipo'], $el['idmovimento'], $quantita, $giacenza);
                }
                if ($el['tipo'] == \App\MovimentoTipo::RICEVUTA) {
                    $quantita = $el['quantita'];
                    $this->printQuantitaGiacenza($el['tipo'], $el['idmovimento'], $quantita, $giacenza);
                }
                if ($el['tipo'] == \App\MovimentoTipo::DDT) {
                    $quantita = +$el['quantita'];
                    $giacenza = $giacenza + $quantita;
                    $this->printQuantitaGiacenza($el['tipo'], $el['idmovimento'], $quantita, $giacenza);
                }
                if ($el['tipo'] == \App\MovimentoTipo::CONTODEPOSITO_RESO) {
                    $quantita = -$el['quantita'];
                    $giacenza = $giacenza + $quantita;
                    $this->printQuantitaGiacenza($el['tipo'], $el['idmovimento'], $quantita, $giacenza);
                }
                if ($el['tipo'] == \App\MovimentoTipo::CONTODEPOSITO_FATTURA) {
                    $quantita = -$el['quantita'];
                    $giacenza = $giacenza + $quantita;
                    $this->printQuantitaGiacenza($el['tipo'], $el['idmovimento'], $quantita, $giacenza);
                }
                if (($el['tipo'] == \App\MovimentoTipo::INVENTARIO) && ( $this->mo->searchById($el['idmovimento'])->getIdsoggetto() == $idsoggetto )) {
                    $quantita = $el['quantita'] - $giacenza;
                    $giacenza = $el['quantita'];
                    $this->printQuantitaGiacenza($el['tipo'], $el['idmovimento'], $quantita, $giacenza);
                }
            }
        }
    }
}