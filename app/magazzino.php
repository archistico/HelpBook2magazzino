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

    private function printQuantitaGiacenza($md, $quantita, $giacenza)
    {
        if($quantita >0) {
            $quantita = '+'.strval($quantita);
        }
        echo $md->getMovimentoData(). " | #" . $md->getIdMovimento() . " " . $md->getMovimentoTipo() . " | " . $quantita . " | Giacenza: " . $giacenza . "</br>";
    }

    public function stampaMovimentiGiacenzeByIdlibro(int $idlibro, int $idsoggetto)
    {
        $magazzini_principali = $idsoggetto == 1;
        $soggettoNome = $this->so->searchById($idsoggetto)->getNome();
        $libroTitolo = $this->li->searchById($idlibro)->getTitolo();

        // raggruppamento di tutti i md ordinati per data e id del solo libro con idlibro desiderato
        $movimentidettaglio = [];

        foreach ($this->mo->getMovimentiOrdered() as $mov) {

            $movimentoId = $mov->getId();
            $movimentoTipo = $mov->getTipo();
            $movimentoData = $mov->getDataFormatted();
            $movimentoIdsoggetto = $mov->getIdsoggetto();
            $movimentoSoggettoNome = $this->so->searchById($movimentoIdsoggetto)->getNome();

            $md_array_each_mov = $this->md->getMovimentiDettaglioById($movimentoId, $idlibro);

            foreach ($md_array_each_mov as $md) {

                $md->setMovimentoTipo($movimentoTipo);
                $md->setMovimentoData($movimentoData);
                $md->setMovimentoSoggettoNome($movimentoSoggettoNome);
                $md->setMovimentoSoggettoId($movimentoIdsoggetto);
                $md->setTitolo($libroTitolo);
                $movimentidettaglio[] = $md;
            }
        }

        if ($magazzini_principali) {

            // Calcola Giacenza
            if(count($movimentidettaglio)>0) {
                \App\Html::printH3($soggettoNome);

                $giacenza = 0;

                foreach ($movimentidettaglio as $md) {

                    $quantita = 0;
                    if ($md->getMovimentoTipo() == \App\MovimentoTipo::STAMPA) {
                        $quantita = $md->getQuantita();
                        $giacenza = $giacenza + $quantita;
                        $this->printQuantitaGiacenza($md, $quantita, $giacenza);
                    }
                    if ($md->getMovimentoTipo() == \App\MovimentoTipo::FATTURA) {
                        $quantita = -$md->getQuantita();
                        $giacenza = $giacenza + $quantita;
                        $this->printQuantitaGiacenza($md, $quantita, $giacenza);
                    }
                    if ($md->getMovimentoTipo() == \App\MovimentoTipo::RICEVUTA) {
                        $quantita = -$md->getQuantita();
                        $giacenza = $giacenza + $quantita;
                        $this->printQuantitaGiacenza($md, $quantita, $giacenza);
                    }
                    if ($md->getMovimentoTipo() == \App\MovimentoTipo::DDT) {
                        $quantita = -$md->getQuantita();
                        $giacenza = $giacenza + $quantita;
                        $this->printQuantitaGiacenza($md, $quantita, $giacenza);
                    }
                    if ($md->getMovimentoTipo() == \App\MovimentoTipo::CONTODEPOSITO_RESO) {
                        $quantita = +$md->getQuantita();
                        $giacenza = $giacenza + $quantita;
                        $this->printQuantitaGiacenza($md, $quantita, $giacenza);
                    }
                    if ($md->getMovimentoTipo() == \App\MovimentoTipo::CONTODEPOSITO_FATTURA) {
                        $quantita = -$md->getQuantita();
                        $this->printQuantitaGiacenza($md, $quantita, $giacenza);
                    }
                    if (($md->getMovimentoTipo() == \App\MovimentoTipo::INVENTARIO) && ( $this->mo->searchById($md->getIdmovimento())->getIdsoggetto() == $idsoggetto )) {
                        $quantita = $md->getQuantita() - $giacenza;
                        $giacenza = $md->getQuantita();
                        $this->printQuantitaGiacenza($md, $quantita, $giacenza);
                    }
                } // fine foreach
            } // fine if count($movimentidettaglio)>0

        } else {
            // Se non è magazzino principale

            // Calcola Giacenza
            if(count($movimentidettaglio)>0) {

                $stampatoSoggettoNome = false;
                $giacenza = 0;

                foreach ($movimentidettaglio as $md) {

                    // Rispetto a prima devo eliminare i movimenti che non riguardano il soggetto considerato
                    if($md->getMovimentoSoggettoId() == $idsoggetto) {

                        if(!$stampatoSoggettoNome) {
                            \App\Html::printH3($soggettoNome);
                            $stampatoSoggettoNome = true;
                        }
                        $quantita = 0;
                        if ($md->getMovimentoTipo() == \App\MovimentoTipo::FATTURA) {
                            $quantita = $md->getQuantita();
                            $this->printQuantitaGiacenza($md, $quantita, $giacenza);
                        }
                        if ($md->getMovimentoTipo() == \App\MovimentoTipo::RICEVUTA) {
                            $quantita = $md->getQuantita();
                            $this->printQuantitaGiacenza($md, $quantita, $giacenza);
                        }
                        if ($md->getMovimentoTipo() == \App\MovimentoTipo::DDT) {
                            $quantita = $md->getQuantita();
                            $giacenza = $giacenza + $quantita;
                            $this->printQuantitaGiacenza($md, $quantita, $giacenza);
                        }
                        if ($md->getMovimentoTipo() == \App\MovimentoTipo::CONTODEPOSITO_RESO) {
                            $quantita = -$md->getQuantita();
                            $giacenza = $giacenza + $quantita;
                            $this->printQuantitaGiacenza($md, $quantita, $giacenza);
                        }
                        if ($md->getMovimentoTipo() == \App\MovimentoTipo::CONTODEPOSITO_FATTURA) {
                            $quantita = -$md->getQuantita();
                            $giacenza = $giacenza + $quantita;
                            $this->printQuantitaGiacenza($md, $quantita, $giacenza);
                        }
                        if (($md->getMovimentoTipo() == \App\MovimentoTipo::INVENTARIO) && ( $this->mo->searchById($md->getIdmovimento())->getIdsoggetto() == $idsoggetto )) {
                            $quantita = $md->getQuantita() - $giacenza;
                            $giacenza = $md->getQuantita();
                            $this->printQuantitaGiacenza($md, $quantita, $giacenza);
                        }
                    }
                } // fine foreach
            } // fine if count($movimentidettaglio)>0


        }
    }
}