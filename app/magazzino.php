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

    public function stampaListaByIdlibro(int $idlibro)
    {
        // Cercare tutti i md con idlibro = idlibro
        $mdById = [];
        foreach ($this->md->getMovimenti() as $el) {
            if($el->getIdlibro() == $idlibro)
            {
                $mdById[] = [ 'tipo' => $this->mo->searchById($el->getIdmovimento())->getTipo(), 'quantita' => $el->getQuantita()];
            }
        }

        // Per ogni movimento dettaglio considerato trova segno, quantità, calcolo in base al tipo, giacenza
        $giacenza = 0;

        foreach ($mdById as $el) {
            if($el['tipo'] == \App\MovimentoTipo::STAMPA) {
                $quantita = $el['quantita'];
                $giacenza = $giacenza + $quantita;
                echo $el['tipo']." | ".$quantita." | Giacenza: ".$giacenza ."</br>";
            }
            if($el['tipo'] == \App\MovimentoTipo::FATTURA) {
                $quantita = -$el['quantita'];
                $giacenza = $giacenza + $quantita;
                echo $el['tipo']." | ".$quantita." | Giacenza: ".$giacenza ."</br>";
            }
            if($el['tipo'] == \App\MovimentoTipo::RICEVUTA) {
                $quantita = -$el['quantita'];
                $giacenza = $giacenza + $quantita;
                echo $el['tipo']." | ".$quantita." | Giacenza: ".$giacenza ."</br>";
            }
            if($el['tipo'] == \App\MovimentoTipo::DDT) {
                $quantita = -$el['quantita'];
                $giacenza = $giacenza + $quantita;
                echo $el['tipo']." | ".$quantita." | Giacenza: ".$giacenza ."</br>";
            }
            if($el['tipo'] == \App\MovimentoTipo::CONTODEPOSITO_RESO) {
                $quantita = +$el['quantita'];
                $giacenza = $giacenza + $quantita;
                echo $el['tipo']." | ".$quantita." | Giacenza: ".$giacenza ."</br>";
            }
            if($el['tipo'] == \App\MovimentoTipo::CONTODEPOSITO_VENDITA) {
                $quantita = -$el['quantita'];
                $giacenza = $giacenza;
                echo $el['tipo']." | ".$quantita." | Giacenza: ".$giacenza ."</br>";
            }
            if($el['tipo'] == \App\MovimentoTipo::INVENTARIO) {
                $correzione = $el['quantita'] - $giacenza;
                $giacenza = $el['quantita'];
                echo $el['tipo']." | ".$correzione." | Giacenza: ".$giacenza ."</br>";
            }
        }
    }
}