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

    public function stampaListaByIdlibro(int $idlibro, int $idsoggetto)
    {
        // Cerca il nome del soggetto
        \App\Html::printH1($this->so->searchById($idsoggetto)->getNome());
        \App\Html::printH2("Libro:".$this->li->searchById($idlibro)->getTitolo());

        $magazzini_principali = $idsoggetto == 1 or $idsoggetto == 2;
        if ($magazzini_principali) {
            // Cercare tutti i md con idlibro = idlibro
            $mdById = [];
            foreach ($this->md->getMovimenti() as $el) {
                if ($el->getIdlibro() == $idlibro) {
                    $mdById[] = ['tipo' => $this->mo->searchById($el->getIdmovimento())->getTipo(), 'quantita' => $el->getQuantita()];
                }
            }

            // Per ogni movimento dettaglio considerato trova segno, quantità, calcolo in base al tipo, giacenza
            $giacenza = 0;

            foreach ($mdById as $el) {
                if ($el['tipo'] == \App\MovimentoTipo::STAMPA) {
                    $quantita = $el['quantita'];
                    $giacenza = $giacenza + $quantita;
                    echo $el['tipo'] . " | " . $quantita . " | Giacenza: " . $giacenza . "</br>";
                }
                if ($el['tipo'] == \App\MovimentoTipo::FATTURA) {
                    $quantita = -$el['quantita'];
                    $giacenza = $giacenza + $quantita;
                    echo $el['tipo'] . " | " . $quantita . " | Giacenza: " . $giacenza . "</br>";
                }
                if ($el['tipo'] == \App\MovimentoTipo::RICEVUTA) {
                    $quantita = -$el['quantita'];
                    $giacenza = $giacenza + $quantita;
                    echo $el['tipo'] . " | " . $quantita . " | Giacenza: " . $giacenza . "</br>";
                }
                if ($el['tipo'] == \App\MovimentoTipo::DDT) {
                    $quantita = -$el['quantita'];
                    $giacenza = $giacenza + $quantita;
                    echo $el['tipo'] . " | " . $quantita . " | Giacenza: " . $giacenza . "</br>";
                }
                if ($el['tipo'] == \App\MovimentoTipo::CONTODEPOSITO_RESO) {
                    $quantita = +$el['quantita'];
                    $giacenza = $giacenza + $quantita;
                    echo $el['tipo'] . " | " . $quantita . " | Giacenza: " . $giacenza . "</br>";
                }
                if ($el['tipo'] == \App\MovimentoTipo::CONTODEPOSITO_FATTURA) {
                    $quantita = -$el['quantita'];
                    echo $el['tipo'] . " | " . $quantita . " | Giacenza: " . $giacenza . "</br>";
                }
                if ($el['tipo'] == \App\MovimentoTipo::INVENTARIO) {
                    $correzione = $el['quantita'] - $giacenza;
                    $giacenza = $el['quantita'];
                    echo $el['tipo'] . " | " . $correzione . " | Giacenza: " . $giacenza . "</br>";
                }
            }
        } else {
            // Cercare tutti i md con idlibro = idlibro
            $mdById = [];
            foreach ($this->md->getMovimenti() as $el) {
                if (($el->getIdlibro() == $idlibro) && ( $this->mo->searchById($el->getIdmovimento())->getIdsoggetto() == $idsoggetto )) {
                    $mdById[] = ['tipo' => $this->mo->searchById($el->getIdmovimento())->getTipo(), 'quantita' => $el->getQuantita()];
                }
            }

            // Per ogni movimento dettaglio considerato trova segno, quantità, calcolo in base al tipo, giacenza
            $giacenza = 0;

            foreach ($mdById as $el) {
                if ($el['tipo'] == \App\MovimentoTipo::DDT) {
                    $quantita = +$el['quantita'];
                    $giacenza = $giacenza + $quantita;
                    echo $el['tipo'] . " | " . $quantita . " | Giacenza: " . $giacenza . "</br>";
                }
                if ($el['tipo'] == \App\MovimentoTipo::CONTODEPOSITO_RESO) {
                    $quantita = -$el['quantita'];
                    $giacenza = $giacenza + $quantita;
                    echo $el['tipo'] . " | " . $quantita . " | Giacenza: " . $giacenza . "</br>";
                }
                if ($el['tipo'] == \App\MovimentoTipo::CONTODEPOSITO_FATTURA) {
                    $quantita = -$el['quantita'];
                    $giacenza = $giacenza + $quantita;
                    echo $el['tipo'] . " | " . $quantita . " | Giacenza: " . $giacenza . "</br>";
                }
            }
        }
    }
}