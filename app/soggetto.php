<?php

namespace App;

class Soggetto
{
    private $id;
    private $nome;

    public function __construct(int $id, String $nome)
    {
        $this->id = $id;
        $this->nome = $nome;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): String
    {
        return $this->nome;
    }

    public function identifica(): String
    {
        return "#" . $this->getId() . " | Soggetto: " . $this->getNome();
    }
}